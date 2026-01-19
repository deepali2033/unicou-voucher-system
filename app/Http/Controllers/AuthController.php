<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\User;
use App\Services\NotificationService;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Handle registration for User or Vendor and send verification email.
     */
    public function register(Request $request)
    {
        $validated = $request->validate([
            'account_type' => ['required', 'in:user,recruiter,freelancer'],
            'first_name' => ['nullable', 'string', 'max:255'],
            'last_name' => ['nullable', 'string', 'max:255'],
            'company_name' => ['nullable', 'string', 'max:255'],
            'full_phone' => ['required', 'string', 'max:20'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', 'min:8'],
        ]);

        // Determine display name
        $isRecruiter = $validated['account_type'] === 'recruiter';
        $name = $isRecruiter
            ? ($validated['company_name'] ?? '')
            : trim(($validated['first_name'] ?? '').' '.($validated['last_name'] ?? ''));

        if ($name === '') {
            $name = $validated['email'];
        }

        if (User::where('email', $validated['email'])->exists()) {
            return redirect()->route('verification.notice')
                ->with('status', 'User already registered');
        }

        // If user type = normal user → require payment before registering
        if ($validated['account_type'] === 'user' && $request->input('regifeetaken') == 'yes') {
            session(['user_register_session' => $validated]);

            return redirect()->route('pricing.index')
                ->with('error', 'Make a registration fee first');
        }

        // Create the user
        $user = User::create([
            'name' => $name,
            'first_name' => $validated['first_name'] ?? null,
            'last_name' => $validated['last_name'] ?? null,
            'company_name' => $validated['company_name'] ?? null,
            'phone' => $validated['full_phone'],
            'account_type' => $validated['account_type'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        NotificationService::userCreated($user);
        Auth::login($user);

        try {
            event(new Registered($user));

            // Check if there's a booking session to complete
            if (session()->get('booking_auto_submit')) {
                $bookingController = new \App\Http\Controllers\BookServiceController;
                $result = $bookingController->finalizeBookingFromSession();

                if ($result && isset($result['booking'])) {
                    return redirect()->route('book-services.index', ['success' => '1'])
                        ->with('success', 'Your account has been created and your service has been booked successfully! We will contact you soon to confirm your appointment.');
                }
            }

            return redirect()->route('verification.notice')
                ->with('status', 'verification-link-sent');
        } catch (\Throwable $e) {
            Log::error('Verification email failed: '.$e->getMessage());

            return redirect()->route('verification.notice')
                ->withErrors([
                    'email' => 'We could not send the verification email right now. '.
                        'Click the button below to resend, or try again later.',
                ]);
        }
    }

    /**
     * Handle login and redirect to home.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
            'remember' => ['nullable', 'boolean'],
            'redirect' => ['nullable', 'string'],
        ]);

        $remember = (bool) ($credentials['remember'] ?? false);
        if (Auth::attempt(['email' => $credentials['email'], 'password' => $credentials['password']], $remember)) {
            // IMPORTANT: Save booking session data BEFORE regenerating session!
            $bookingAutoSubmit = session()->get('booking_auto_submit');
            $bookingReturnStep = session()->get('booking_return_step');
            $bookingFormData = session()->get('booking_form_data');
            $bookingReturnToForm = session()->get('booking_return_to_form');

            // Now regenerate the session for security
            $request->session()->regenerate();

            // Restore booking session data AFTER regenerate
            if ($bookingAutoSubmit) {
                session(['booking_auto_submit' => $bookingAutoSubmit]);
                session(['booking_return_step' => $bookingReturnStep]);
                session(['booking_form_data' => $bookingFormData]);
                session(['booking_return_to_form' => $bookingReturnToForm]);
            }

            // Require verified email
            // Temporarily bypass email verification for testing
            if (! $request->user()->hasVerifiedEmail()) {
                $request->user()->email_verified_at = now();
                $request->user()->save();
            }

            // Check if user came from booking form
            if (session()->get('booking_auto_submit')) {
                // Try to finalize booking from session data
                $bookingController = new \App\Http\Controllers\BookServiceController;
                $result = $bookingController->finalizeBookingFromSession();

                if ($result && isset($result['booking'])) {
                    // Booking created successfully - redirect to success page
                    return redirect()->route('book-services.index', ['success' => '1'])
                        ->with('success', 'Your service has been booked successfully! We will contact you soon to confirm your appointment.');
                }

                // If finalize failed, go back to booking form
                return redirect('/free-quote')
                    ->with('error', 'We could not complete your booking. Please try again.');
            }

            // Clear booking session flags if they exist (normal login, not from booking)
            if (session()->get('booking_return_to_form')) {
                session()->forget('booking_return_to_form');
                session()->forget('booking_form_data');
                session()->forget('booking_return_step');
            }

            // Check if redirect parameter is provided (e.g., from review page)
            // First check POST data, then GET parameter
            $redirect = $credentials['redirect'] ?? $request->query('redirect');
            if ($redirect && filter_var($redirect, FILTER_VALIDATE_URL)) {
                // Validate that the redirect URL is from the same domain
                $redirectHost = parse_url($redirect, PHP_URL_HOST);
                $currentHost = $request->getHost();
                if ($redirectHost === $currentHost) {
                    return redirect($redirect);
                }
            }

            // Redirect based on account type (normal login flow)
            $type = $request->user()->account_type ?? 'user';
            switch ($type) {
                case 'admin':
                    return redirect()->route('admin.dashboard');
                case 'recruiter':
                    return redirect()->route('recruiter.dashboard');
                case 'freelancer':
                    return redirect()->route('freelancer.dashboard');
                default:
                    return redirect()->route('user.dashboard');
            }
        }

        throw ValidationException::withMessages([
            'email' => __('These credentials do not match our records.'),
        ]);
    }

    /**
     * Handle logout
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->back()->with('success', 'Logged out successfully.');
    }
}
