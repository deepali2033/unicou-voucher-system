<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Models\Plan;
use App\Models\Payment;
use App\Models\BookService;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Services\NotificationService;


// Load Stripe library manually
require_once __DIR__ . '/../../../bootstrap/stripe.php';

use Stripe\Stripe;
use Stripe\Checkout\Session;
use Stripe\Webhook;

class PaymentController extends Controller
{
    public function __construct()
    {
        Stripe::setApiKey(config('services.stripe.secret'));
    }

    /**
     * Create a Stripe Checkout Session for a plan
     */
    public function createCheckoutSession(Request $request)
    {

        try {
            if($request->plan_check == 'yes'){
                $plan = Plan::where('id', $request->plan_id );
                $session = Session::create([
                    'payment_method_types' => ['card'],
                    'line_items' => [[
                        'price_data' => [
                            'currency' => 'usd',
                            'product_data' => [
                                'name' => $plan->name,
                                'description' => $plan->description,
                            ],
                            'unit_amount' => intval($plan->price * 100), // Convert to cents
                        ],
                        'quantity' => 1,
                    ]],
                    'mode' => 'payment',
                    'success_url' => route('payment.success') . '?session_id={CHECKOUT_SESSION_ID}',
                    'cancel_url' => route('pricing.index'),
                    'metadata' => [
                        'plan_id' => $plan->id,
                        'plan_name' => $plan->name,
                    ]
                ]);
            }else{
                $session = Session::create([
                    'payment_method_types' => ['card'],
                    'line_items' => [[
                        'price_data' => [
                            'currency' => 'usd',
                            'product_data' => [
                                'name' => 'Registration fee',
                                'description' => 'For Valid user',
                            ],
                            'unit_amount' => intval(25 * 100), // Convert to cents
                        ],
                        'quantity' => 1,
                    ]],
                    'mode' => 'payment',
                    'success_url' => route('payment.success') . '?session_id={CHECKOUT_SESSION_ID}',
                    'cancel_url' => route('pricing.index'),
                    'metadata' => [
                        'plan_id' => 123,
                        'plan_name' => 'Registration fee',
                    ]
                ]);
            }

            return response()->json(['checkout_url' => $session->url]);

        } catch (\Exception $e) {
            Log::error('Stripe checkout session creation failed: ' . $e->getMessage());
            return response()->json(['error' => 'Unable to create payment session'], 500);
        }
    }

    /**
     * Handle successful payment
     */
    public function success(Request $request)
    {
        $session_id = $request->get('session_id');

        if (!$session_id) {
            return redirect()->route('pricing.index')->with('error', 'Invalid payment session');
        }

        // FIXED: get actual session data instead of boolean
        $registrationfee = session('user_register_session');

        // If no logged-in user AND no registration session → reject
        if (!Auth::user() && !$registrationfee) {
            return redirect()->route('pricing.index')->with('error', 'Unauthorized payment session');
        }

        // Prepare preuser data
        $preuser = new \stdClass();

        if ($registrationfee) {
            $validated = $registrationfee;
            $preuser->email = $validated['email'];
            $preuser->name  = trim(($validated['first_name'] ?? '') . ' ' . ($validated['last_name'] ?? ''));
        } else {
            $preuser->email = Auth::user()->email;
            $preuser->name  = Auth::user()->name;
        }

        try {
            $session = Session::retrieve($session_id);

            if ($session->payment_status === 'paid') {

                if ($registrationfee) {
                    // Create the user
                    $user = User::create([
                        'name' => $preuser->name,
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
                }

                $userId = $registrationfee ? $user->id : Auth::id();

                $payment = Payment::create([
                    'plan_id' => $userId,
                    'uid' => $userId,
                    'stripe_session_id' => $session_id,
                    'stripe_payment_intent_id' => $session->payment_intent,
                    'amount' => $session->amount_total / 100,
                    'currency' => strtoupper($session->currency),
                    'status' => 'completed',
                    'customer_email' => $preuser->email,
                    'customer_name' => $preuser->name,
                ]);

                return view('payments.success', [
                    'payment' => $payment,
                    'plan_name' => $session->metadata->plan_name
                ]);
            }

            return redirect()->route('pricing.index')->with('error', 'Payment was not completed');

        } catch (\Exception $e) {
            Log::error('Payment success handling failed: ' . $e->getMessage());
            return redirect()->route('pricing.index')->with('error', 'Unable to verify payment status');
        }
    }


    /**
     * Create a Stripe Checkout Session for booking service
     */
    public function createBookingCheckout(Request $request, BookService $booking)
    {
        try {
            $session = Session::create([
                'payment_method_types' => ['card'],
                'line_items' => [[
                    'price_data' => [
                        'currency' => 'eur',
                        'product_data' => [
                            'name' => $booking->service_name,
                            'description' => 'Booking for ' . $booking->customer_name . ' - ' . $booking->booking_date,
                        ],
                        'unit_amount' => intval($booking->price * 100),
                    ],
                    'quantity' => 1,
                ]],
                'mode' => 'payment',
                'success_url' => route('payment.book-service-success', ['booking' => $booking->id]) . '?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => route('book-services.index'),
                'metadata' => [
                    'booking_id' => $booking->id,
                    'service_name' => $booking->service_name,
                ]
            ]);

            return redirect($session->url);

        } catch (\Exception $e) {
            Log::error('Stripe checkout session creation failed for booking: ' . $e->getMessage());
            return redirect()->route('book-services.index')->with('error', 'Unable to create payment session');
        }
    }

    /**
     * Handle booking payment success
     */
    public function bookingPaymentSuccess(Request $request, BookService $booking)
    {
        $session_id = $request->get('session_id');

        if (!$session_id) {
            return redirect()->route('book-services.index')->with('error', 'Invalid payment session');
        }

        try {
            $session = Session::retrieve($session_id);

            if ($session->payment_status === 'paid') {
                $booking->update([
                    'status' => 'confirmed',
                    'is_booking_confirmed' => true,
                ]);

                return view('payments.booking-success', [
                    'booking' => $booking,
                ]);
            }

            return redirect()->route('book-services.index')->with('error', 'Payment was not completed');

        } catch (\Exception $e) {
            Log::error('Booking payment success handling failed: ' . $e->getMessage());
            return redirect()->route('book-services.index')->with('error', 'Unable to verify payment status');
        }
    }

    /**
     * Handle Stripe webhooks
     */
    public function handleWebhook(Request $request)
    {
        $payload = $request->getContent();
        $sig_header = $request->header('Stripe-Signature');
        $endpoint_secret = config('services.stripe.webhook_secret');

        if (!Auth::user()) {
            return redirect()->route('pricing.index')->with('error', 'Unauthorized payment session');
        }

        try {
            $event = Webhook::constructEvent($payload, $sig_header, $endpoint_secret);
        } catch (\UnexpectedValueException $e) {
            // Invalid payload
            Log::error('Invalid webhook payload: ' . $e->getMessage());
            return response('Invalid payload', 400);
        } catch (\Stripe\Exception\SignatureVerificationException $e) {
            // Invalid signature
            Log::error('Invalid webhook signature: ' . $e->getMessage());
            return response('Invalid signature', 400);
        }

        // Handle the event
        switch ($event['type']) {
            case 'checkout.session.completed':
                $session = $event['data']['object'];
                $this->handleCheckoutCompleted($session);
                break;

            case 'payment_intent.payment_failed':
                $payment_intent = $event['data']['object'];
                $this->handlePaymentFailed($payment_intent);
                break;

            default:
                Log::info('Received unknown event type ' . $event['type']);
        }

        return response('Webhook handled', 200);
    }

    /**
     * Handle completed checkout session
     */
    private function handleCheckoutCompleted($session)
    {
        if (!Auth::user()) {
            return redirect()->route('pricing.index')->with('error', 'Unauthorized payment session');
        }

        try {
            $payment = Payment::where('stripe_session_id', $session['id'])->first();

            if (!$payment) {
                // Create payment record if it doesn't exist
                Payment::create([
                    'plan_id' => $session['metadata']['plan_id'] ?? null,
                    'stripe_session_id' => $session['id'],
                    'stripe_payment_intent_id' => $session['payment_intent'],
                    'amount' => $session['amount_total'] / 100,
                    'currency' => strtoupper($session['currency']),
                    'status' => 'completed',
                    'customer_email' => $session['customer_details']['email'] ?? null,
                    'customer_name' => $session['customer_details']['name'] ?? null,
                ]);
            } else {
                // Update existing payment record
                $payment->update([
                    'status' => 'completed',
                    'stripe_payment_intent_id' => $session['payment_intent'],
                ]);
            }

            Log::info('Checkout completed for session: ' . $session['id']);
        } catch (\Exception $e) {
            Log::error('Error handling checkout completion: ' . $e->getMessage());
        }
    }

    /**
     * Handle failed payment
     */
    private function handlePaymentFailed($payment_intent)
    {
        try {
            $payment = Payment::where('stripe_payment_intent_id', $payment_intent['id'])->first();

            if ($payment) {
                $payment->update(['status' => 'failed']);
                Log::info('Payment failed for intent: ' . $payment_intent['id']);
            }
        } catch (\Exception $e) {
            Log::error('Error handling payment failure: ' . $e->getMessage());
        }
    }
}
