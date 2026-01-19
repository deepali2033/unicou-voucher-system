<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\BookService;
use App\Models\Service;
use App\Models\User;
use App\Models\Notification;
use App\Services\NotificationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class BookServiceController extends Controller
{
    /**
     * Display a listing of user's book services.
     */
    public function index(Request $request)
    {
        // Get the authenticated user's bookings
        $bookings = BookService::where('user_id', Auth::id())
            ->with(['service'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        // Fetch all active services for new booking form
        $services = Service::where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get(['id', 'name']);

        // Check if redirected with success parameter
        $showSuccess = $request->get('success') === '1';

        return view('user.book-services.index', compact('bookings', 'services', 'showSuccess'));
    }

    /**
     * Show the form for creating a new booking.
     */
    public function create()
    {
        // Fetch all active services from the database
        $services = Service::where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get(['id', 'name']);

        return view('user.book-services.create', compact('services'));
    }

    /**
     * Store a new booking.
     */
    public function store(Request $request)
    {
        // Log the incoming request for debugging
        Log::info('User booking form submission', $request->all());

        // Validate the request
        $validator = Validator::make($request->all(), [
            'service_name' => 'required|string',
            'bedrooms' => 'required|integer',
            'bathrooms' => 'required|integer',
            'extras' => 'required|string',
            'frequency' => 'required|string',
            'square_feet' => 'required|string',
            'booking_date' => 'required|date',
            'booking_time' => 'required',
            'customer_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'street_address' => 'required|string|max:500',
            'city' => 'required|string|max:255',
            'state' => 'required|string',
            'zip_code' => 'required|string|max:10',
            'parking_info' => 'required|string',
            'flexible_time' => 'required|string',
            'entrance_info' => 'required|string',
            'pets' => 'required|string',
            'special_instructions' => 'nullable|string',
        ]);

        // Handle validation failure
        if ($validator->fails()) {
            \Log::error('User booking validation failed', $validator->errors()->toArray());

            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Please fill all required fields correctly.');
        }

        try {
            // Get service_id if the service name matches
            $service = Service::where('name', $request->input('service_name'))->first();

            // Create the booking
            $booking = BookService::create([
                'user_id' => Auth::id(),
                'service_id' => $service ? $service->id : null,
                'service_name' => $request->input('service_name'),
                'customer_name' => $request->input('customer_name'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
                'street_address' => $request->input('street_address'),
                'city' => $request->input('city'),
                'state' => $request->input('state'),
                'zip_code' => $request->input('zip_code'),
                'bedrooms' => $request->input('bedrooms'),
                'bathrooms' => $request->input('bathrooms'),
                'extras' => $request->input('extras'),
                'frequency' => $request->input('frequency'),
                'square_feet' => $request->input('square_feet'),
                'booking_date' => $request->input('booking_date'),
                'booking_time' => $request->input('booking_time'),
                'parking_info' => $request->input('parking_info'),
                'flexible_time' => $request->input('flexible_time'),
                'entrance_info' => $request->input('entrance_info'),
                'pets' => $request->input('pets'),
                'special_instructions' => $request->input('special_instructions'),
                'status' => 'pending',
            ]);

            \Log::info('User booking created successfully', ['booking_id' => $booking->id]);

            // Create notifications for service booking
            NotificationService::serviceBooked($booking);
            // Also create a notification for the user who created the booking
            NotificationService::bookingCreated($booking);

            // Redirect with success message
            return redirect()->route('user.book-services.index')
                ->with('success', 'Thank you for booking a service! We will contact you soon to confirm your appointment.');
        } catch (\Exception $e) {
            \Log::error('User booking submission error: ' . $e->getMessage(), [
                'exception' => $e,
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()->back()
                ->with('error', 'An error occurred while submitting your booking. Please try again.')
                ->withInput();
        }
    }

    /**
     * Display the specified booking.
     */
    public function show(BookService $bookService)
    {
        // Ensure the booking belongs to the authenticated user
        if ($bookService->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access to booking.');
        }

        return view('user.book-services.show', compact('bookService'));
    }

    /**
     * Show the form for editing the specified booking.
     */
    public function edit(BookService $bookService)
    {
        // Ensure the booking belongs to the authenticated user
        if ($bookService->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access to booking.');
        }

        // Only allow editing of pending bookings
        if ($bookService->status !== 'pending') {
            return redirect()->route('user.book-services.show', $bookService)
                ->with('error', 'You can only edit pending bookings.');
        }

        // Fetch all active services from the database
        $services = Service::where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get(['id', 'name']);

        return view('user.book-services.edit', compact('bookService', 'services'));
    }

    /**
     * Update the specified booking.
     */
    public function update(Request $request, BookService $bookService)
    {
        // Ensure the booking belongs to the authenticated user
        if ($bookService->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access to booking.');
        }

        // Only allow editing of pending bookings
        if ($bookService->status !== 'pending') {
            return redirect()->route('user.book-services.show', $bookService)
                ->with('error', 'You can only edit pending bookings.');
        }

        // Validate the request
        $validator = Validator::make($request->all(), [
            'service_name' => 'required|string',
            'bedrooms' => 'required|integer',
            'bathrooms' => 'required|integer',
            'extras' => 'required|string',
            'frequency' => 'required|string',
            'square_feet' => 'required|string',
            'booking_date' => 'required|date',
            'booking_time' => 'required',
            'customer_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'street_address' => 'required|string|max:500',
            'city' => 'required|string|max:255',
            'state' => 'required|string',
            'zip_code' => 'required|string|max:10',
            'parking_info' => 'required|string',
            'flexible_time' => 'required|string',
            'entrance_info' => 'required|string',
            'pets' => 'required|string',
            'special_instructions' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Please fill all required fields correctly.');
        }

        try {
            // Get service_id if the service name matches
            $service = Service::where('name', $request->input('service_name'))->first();

            // Update the booking
            $bookService->update([
                'service_id' => $service ? $service->id : null,
                'service_name' => $request->input('service_name'),
                'customer_name' => $request->input('customer_name'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
                'street_address' => $request->input('street_address'),
                'city' => $request->input('city'),
                'state' => $request->input('state'),
                'zip_code' => $request->input('zip_code'),
                'bedrooms' => $request->input('bedrooms'),
                'bathrooms' => $request->input('bathrooms'),
                'extras' => $request->input('extras'),
                'frequency' => $request->input('frequency'),
                'square_feet' => $request->input('square_feet'),
                'booking_date' => $request->input('booking_date'),
                'booking_time' => $request->input('booking_time'),
                'parking_info' => $request->input('parking_info'),
                'flexible_time' => $request->input('flexible_time'),
                'entrance_info' => $request->input('entrance_info'),
                'pets' => $request->input('pets'),
                'special_instructions' => $request->input('special_instructions'),
            ]);

            return redirect()->route('user.book-services.show', $bookService)
                ->with('success', 'Booking updated successfully!');
        } catch (\Exception $e) {
            \Log::error('User booking update error: ' . $e->getMessage(), [
                'exception' => $e,
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()->back()
                ->with('error', 'An error occurred while updating your booking. Please try again.')
                ->withInput();
        }
    }

    /**
     * Remove the specified booking.
     */
    public function destroy(BookService $bookService)
    {
        // Ensure the booking belongs to the authenticated user
        if ($bookService->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access to booking.');
        }

        // Only allow deletion of pending bookings
        if ($bookService->status !== 'pending') {
            return redirect()->route('user.book-services.index')
                ->with('error', 'You can only delete pending bookings.');
        }

        try {
            $bookService->delete();

            return redirect()->route('user.book-services.index')
                ->with('success', 'Booking deleted successfully.');
        } catch (\Exception $e) {
            \Log::error('User booking deletion error: ' . $e->getMessage(), [
                'exception' => $e,
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()->back()
                ->with('error', 'An error occurred while deleting your booking. Please try again.');
        }
    }

    /**
     * Update the status of the booking.
     */
    public function updateStatus(Request $request, BookService $bookService)
    {
        // Ensure the booking belongs to the authenticated user
        if ($bookService->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access to booking.');
        }

        $request->validate([
            'status' => 'required|in:pending,confirmed,in_progress,completed,cancelled'
        ]);

        try {
            $oldStatus = $bookService->status;

            $bookService->update([
                'status' => $request->status
            ]);

            // Create notification for status change
            NotificationService::bookingStatusChanged($bookService, $oldStatus, $request->status);

            return redirect()->route('user.book-services.show', $bookService)
                ->with('success', 'Booking status updated successfully.');
        } catch (\Exception $e) {
            Log::error('User booking status update error: ' . $e->getMessage(), [
                'exception' => $e,
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()->back()
                ->with('error', 'An error occurred while updating the status. Please try again.');
        }
    }

    /**
     * Save form data to session
     */
    public function saveSession(Request $request)
    {
        $formData = $request->all();
        session()->put('booking_form_data', $formData);
        
        return response()->json(['success' => true]);
    }

    /**
     * Submit booking from wizard form
     */
    public function submitBooking(Request $request)
    {
        try {
            // Get form data from request
            $data = $request->all();
            
            // Validate the collected data
            $validator = Validator::make($data, [
                'street_address' => 'required|string|max:500',
                'service_name' => 'required|string',
                'frequency' => 'required|string',
                'duration' => 'required|string',
                'extras' => 'nullable|string',
                'pets' => 'required|string',
                'booking_date' => 'required|date',
                'booking_time' => 'required|string',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 422,
                    'success' => false,
                    'message' => 'Please fill all required fields.',
                    'errors' => $validator->errors()
                ], 422);
            }

            // Check if user is authenticated
            if (!Auth::check()) {
                // User not logged in - redirect to login
                return response()->json([
                    'status' => 401,
                    'success' => false,
                    'redirect' => route('login'),
                    'message' => 'Please log in to complete your booking.'
                ], 401);
            }

            // User is authenticated - create the booking
            $user = Auth::user();
            $service = Service::where('name', $data['service_name'])->first();

            $booking = BookService::create([
                'user_id' => Auth::id(),
                'service_id' => $service ? $service->id : null,
                'service_name' => $data['service_name'],
                'customer_name' => $user->name,
                'email' => $user->email,
                'phone' => $user->phone ?? '',
                'street_address' => $data['street_address'],
                'city' => $user->city ?? '',
                'state' => $user->state ?? '',
                'zip_code' => $user->zip_code ?? '',
                'bedrooms' => 0,
                'bathrooms' => 0,
                'extras' => $data['extras'] ?? '',
                'frequency' => $data['frequency'],
                'square_feet' => $data['duration'],
                'booking_date' => $data['booking_date'],
                'booking_time' => $data['booking_time'],
                'parking_info' => '',
                'flexible_time' => 'no',
                'entrance_info' => '',
                'pets' => $data['pets'],
                'special_instructions' => '',
                'status' => 'pending',
            ]);

            \Log::info('Booking created from wizard', ['booking_id' => $booking->id]);

            // Create notifications
            NotificationService::serviceBooked($booking);
            NotificationService::bookingCreated($booking);

            // Redirect to payment gateway
            return response()->json([
                'status' => 200,
                'success' => true,
                'redirect' => route('payment.create-checkout-session', ['plan' => 'booking']),
                'message' => 'Booking created successfully. Redirecting to payment...'
            ]);

        } catch (\Exception $e) {
            \Log::error('Booking submission error: ' . $e->getMessage(), [
                'exception' => $e,
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'status' => 500,
                'success' => false,
                'message' => 'An error occurred while processing your booking. Please try again.'
            ], 500);
        }
    }
}
