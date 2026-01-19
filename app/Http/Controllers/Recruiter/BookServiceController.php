<?php

namespace App\Http\Controllers\Recruiter;

use App\Http\Controllers\Controller;
use App\Models\BookService;
use App\Models\Service;
use App\Models\User;
use App\Models\Notification;
use App\Services\NotificationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class BookServiceController extends Controller
{
    /**
     * Display a listing of recruiter's book services.
     */
    public function index(Request $request)
    {
        $query = BookService::with(['service']);

        // Apply search filter
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('customer_name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        // Apply status filter
        if ($request->has('status') && !empty($request->status)) {
            $query->where('status', $request->status);
        }

        $bookServices = $query->orderBy('created_at', 'desc')->paginate(15);

        return view('recruiter.book-services.index', compact('bookServices'));
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

        return view('recruiter.book-services.create', compact('services'));
    }

    /**
     * Store a new booking.
     */
    public function store(Request $request)
    {
        // Log the incoming request for debugging
        \Log::info('Recruiter booking form submission', $request->all());

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
            \Log::error('Recruiter booking validation failed', $validator->errors()->toArray());

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

            \Log::info('Recruiter booking created successfully', ['booking_id' => $booking->id]);

            // Create notifications for service booking
            NotificationService::serviceBooked($booking);

            // Redirect with success message
            return redirect()->route('recruiter.book-services.index')
                ->with('success', 'Thank you for booking a service! We will contact you soon to confirm your appointment.');
        } catch (\Exception $e) {
            \Log::error('Recruiter booking submission error: ' . $e->getMessage(), [
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
        // Recruiters can see all bookings (not limited to their own)
        return view('recruiter.book-services.show', compact('bookService'));
    }

    /**
     * Show the form for editing the specified booking.
     */
    public function edit(BookService $bookService)
    {
        // Fetch all active services from the database
        $services = Service::where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get(['id', 'name']);

        return view('recruiter.book-services.edit', compact('bookService', 'services'));
    }

    /**
     * Update the specified booking.
     */
    public function update(Request $request, BookService $bookService)
    {
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
            'status' => 'required|string|in:pending,confirmed,in_progress,completed,cancelled',
            'price' => 'nullable|numeric|min:0',
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
                'status' => $request->input('status'),
                'price' => $request->input('price'),
            ]);

            return redirect()->route('recruiter.book-services.show', $bookService)
                ->with('success', 'Booking updated successfully!');
        } catch (\Exception $e) {
            \Log::error('Recruiter booking update error: ' . $e->getMessage(), [
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
        try {
            $bookService->delete();

            return redirect()->route('recruiter.book-services.index')
                ->with('success', 'Booking deleted successfully.');
        } catch (\Exception $e) {
            \Log::error('Recruiter booking deletion error: ' . $e->getMessage(), [
                'exception' => $e,
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()->back()
                ->with('error', 'An error occurred while deleting your booking. Please try again.');
        }
    }

    /**
     * Update the status of a booking.
     */
    public function updateStatus(Request $request, BookService $bookService)
    {
        $request->validate([
            'status' => 'required|string|in:pending,confirmed,in_progress,completed,cancelled',
        ]);

        try {
            $bookService->update([
                'status' => $request->input('status'),
            ]);

            return redirect()->route('recruiter.book-services.show', $bookService)
                ->with('success', 'Booking status updated successfully!');
        } catch (\Exception $e) {
            \Log::error('Recruiter booking status update error: ' . $e->getMessage(), [
                'exception' => $e,
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()->back()
                ->with('error', 'An error occurred while updating the booking status. Please try again.');
        }
    }
}
