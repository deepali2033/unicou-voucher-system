<?php

namespace App\Http\Controllers;

use App\Models\BookService;
use App\Models\Service;
use App\Models\User;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class AjaxController extends Controller
{
    /**
     * Handle WordPress-style AJAX requests from Elementor/theme scripts
     * This replaces wp-admin/admin-ajax.php functionality
     */
    public function handle(Request $request)
    {
        // Get the action parameter (WordPress convention)
        $action = $request->input('action');

        // Log the request for debugging
        Log::info('AJAX Request', [
            'action' => $action,
            'data' => $request->all()
        ]);

        // Handle specific actions if needed
        switch ($action) {
            case 'elementor_pro_forms_send_form':
                return $this->handleElementorFormSubmission($request);

            case 'elementor_ajax':
                return $this->handleElementorAjax($request);

            case 'search':
            case 'live_search':
                return $this->handleSearch($request);

            default:
                // Return success response for unhandled actions
                return response()->json([
                    'success' => true,
                    'message' => 'Request processed successfully'
                ]);
        }
    }

    /**
     * Handle Elementor-specific AJAX requests
     */
    protected function handleElementorAjax(Request $request)
    {
        return response()->json([
            'success' => true,
            'data' => []
        ]);
    }

    /**
     * Handle Elementor Pro Forms submission (Book Service)
     */
    protected function handleElementorFormSubmission(Request $request)
    {
        Log::info('Processing Elementor form submission', $request->all());

        // Check if this is a booking form submission (has form_fields)
        $formFields = $request->input('form_fields');
        if (!$formFields || !isset($formFields['service_booking_form'])) {
            // This might be a different form (like contact form), just return success
            return response()->json([
                'success' => true,
                'message' => 'Form submitted successfully'
            ]);
        }

        try {
            // Validate the booking form data
            $validator = Validator::make($formFields, [
                'service_booking_form' => 'required|string',
                'bedrooms_booking_form' => 'required|integer',
                'bathrooms_booking_form' => 'required|integer',
                'extras_booking_form' => 'required|string',
                'frequency_booking_form' => 'required|string',
                'area_booking_form' => 'required|string',
                'date_booking_form' => 'required|date',
                'time_booking_form' => 'required',
                'name_booking_form' => 'required|string|max:255',
                'tel_booking_form' => 'required|string|max:20',
                'email_booking_form' => 'required|email|max:255',
                'street_booking_form' => 'required|string|max:500',
                'city_booking_form' => 'required|string|max:255',
                'states_booking_form' => 'required|string',
                'zip_code_booking_form' => 'required|string|max:10',
                'where_to_park_booking_form' => 'required|string',
                'flexible_time_booking_form' => 'required|string',
                'entrance_info_booking_form' => 'required|string',
                'pets_booking_form' => 'required|string',
                'message_booking_form' => 'nullable|string',
            ]);

            if ($validator->fails()) {
                Log::error('Elementor booking validation failed', $validator->errors()->toArray());
                return response()->json([
                    'success' => false,
                    'message' => 'Please fill all required fields correctly.',
                    'errors' => $validator->errors()
                ], 422);
            }

            // Get service_id if the service name matches
            $service = Service::where('name', $formFields['service_booking_form'])->first();

            // Create the booking
            $booking = BookService::create([
                'user_id' => Auth::check() ? Auth::id() : null,
                'service_id' => $service ? $service->id : null,
                'service_name' => $formFields['service_booking_form'],
                'customer_name' => $formFields['name_booking_form'],
                'email' => $formFields['email_booking_form'],
                'phone' => $formFields['tel_booking_form'],
                'street_address' => $formFields['street_booking_form'],
                'city' => $formFields['city_booking_form'],
                'state' => $formFields['states_booking_form'],
                'zip_code' => $formFields['zip_code_booking_form'],
                'bedrooms' => $formFields['bedrooms_booking_form'],
                'bathrooms' => $formFields['bathrooms_booking_form'],
                'extras' => $formFields['extras_booking_form'],
                'frequency' => $formFields['frequency_booking_form'],
                'square_feet' => $formFields['area_booking_form'],
                'booking_date' => $formFields['date_booking_form'],
                'booking_time' => $formFields['time_booking_form'],
                'parking_info' => $formFields['where_to_park_booking_form'],
                'flexible_time' => $formFields['flexible_time_booking_form'],
                'entrance_info' => $formFields['entrance_info_booking_form'],
                'pets' => $formFields['pets_booking_form'],
                'special_instructions' => $formFields['message_booking_form'] ?? null,
                'status' => 'pending',
            ]);

            Log::info('Booking created successfully via Elementor form', ['booking_id' => $booking->id]);

            // Notify all admins
            $admins = User::where('account_type', 'admin')->get();
            foreach ($admins as $admin) {
                Notification::create([
                    'user_id' => $admin->id,
                    'title' => 'New Service Booking',
                    'description' => "New booking from {$booking->customer_name} for {$booking->service_name}",
                    'type' => 'service',
                    'action' => route('admin.book-services.show', $booking->id),
                    'related_id' => $booking->id,
                    'is_read' => false,
                ]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Thank you for booking a service! We will contact you soon to confirm your appointment.',
                'booking_id' => $booking->id
            ]);

        } catch (\Exception $e) {
            Log::error('Elementor booking submission error: ' . $e->getMessage(), [
                'exception' => $e,
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'An error occurred while submitting your booking. Please try again.'
            ], 500);
        }
    }

    /**
     * Handle search requests
     */
    protected function handleSearch(Request $request)
    {
        $query = $request->input('s', $request->input('query', ''));

        // Return empty results for now
        // You can implement actual search functionality here if needed
        return response()->json([
            'success' => true,
            'data' => [
                'results' => [],
                'found' => 0
            ]
        ]);
    }
}
