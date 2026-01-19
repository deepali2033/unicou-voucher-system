<?php

namespace App\Http\Controllers;

use App\Models\BookService;
use App\Models\Category;
use App\Models\Service;
use App\Services\NotificationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class BookServiceController extends Controller
{
    /**
     * Display the book services form.
     */
    public function index(Request $request)
    {
        $services = Service::where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get() ?? collect();

        $servicesByCategory = $services->groupBy('category_id');

        // Get only categories that have at least one active service
        $categories = Category::where('is_active', true)
            ->whereIn('id', $servicesByCategory->keys())
            ->get() ?? collect();

        $showSuccess = request()->get('success') === '1';

        return view('book-services.index', [
            'categories' => $categories,
            'services' => $services,
            'servicesByCategory' => $servicesByCategory,
            'showSuccess' => $showSuccess,
            'currentStep' => 1,
            'formData' => session('booking_form_data', []),
        ]);
    }

    /**
     * Display a specific step of the booking wizard.
     */
    public function step(Request $request, $step)
    {
        // Map step URL to step number (9 total steps)
        $stepMap = [
            'address' => 1,
            'category' => 2,
            'services' => 3,
            'frequency' => 4,
            'duration' => 5,
            'extras' => 6,
            'pets' => 7,
            'date' => 8,
            'time' => 9,
        ];

        $stepNumber = $stepMap[$step] ?? 1;

        \Log::info('📍 Step URL Navigation', [
            'step_slug' => $step,
            'step_number' => $stepNumber,
            'user_id' => Auth::id(),
        ]);

        $services = Service::where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get() ?? collect();
        $servicesByCategory = $services->groupBy('category_id');

        // Get only categories that have at least one active service
        $categories = Category::where('is_active', true)
            ->whereIn('id', $servicesByCategory->keys())
            ->get() ?? collect();

        return view('book-services.index', [
            'categories' => $categories,
            'services' => $services,
            'servicesByCategory' => $servicesByCategory,
            'showSuccess' => false,
            'currentStep' => $stepNumber,
            'formData' => session('booking_form_data', []),
        ]);
    }

    /**
     * Handle AJAX persistence for the booking wizard steps.
     */
    public function nextStep(Request $request)
    {
        try {
            $currentStep = max(1, (int) $request->input('current_step', 1));
            $formData = $request->input('form_data', []);

            \Log::info('📝 Next Step - Saving current step data', [
                'current_step' => $currentStep,
                'user_id' => Auth::id(),
                'keys' => array_keys($formData),
            ]);

            $normalizedData = [
                'street_address' => $formData['street_address'] ?? null,
                'category_name' => $formData['category_name'] ?? null,
                'service_name' => $formData['service_name'] ?? null,
                'frequency' => $formData['frequency'] ?? null,
                'duration' => $formData['duration'] ?? null,
                'extras' => $formData['extras'] ?? null,
                'bedrooms' => $formData['bedrooms'] ?? null,
                'bathrooms' => $formData['bathrooms'] ?? null,
                'area' => $formData['area'] ?? null,
                'pets' => $formData['pets'] ?? null,
                'booking_date' => $formData['booking_date'] ?? null,
                'booking_time' => $formData['booking_time'] ?? null,
                'customer_name' => $formData['customer_name'] ?? null,
                'phone' => $formData['phone'] ?? null,
                'email' => $formData['email'] ?? null,
                'city' => $formData['city'] ?? null,
                'state' => $formData['state'] ?? null,
                'zip_code' => $formData['zip_code'] ?? null,
                'parking_info' => $formData['parking_info'] ?? null,
                'flexible_time' => $formData['flexible_time'] ?? null,
                'entrance_info' => $formData['entrance_info'] ?? null,
                'special_instructions' => $formData['special_instructions'] ?? null,
                'calculated_price' => $formData['calculated_price'] ?? null,
                'skip_frequency' => (bool) ($formData['skip_frequency'] ?? false),
                'current_step' => $currentStep,
            ];

            if (! empty($formData['extras']) && is_array($formData['extras'])) {
                $normalizedData['extras'] = $formData['extras'];
            }

            $sessionData = session('booking_form_data', []);
            $sessionData = array_merge($sessionData, array_filter($normalizedData, function ($value) {
                return $value !== null;
            }));

            session([
                'booking_form_data' => $sessionData,
                'booking_return_step' => $currentStep,
            ]);

            \Log::info('✅ Wizard progress saved', [
                'session_keys' => array_keys($sessionData),
                'return_step' => session('booking_return_step'),
            ]);

            return response()->json([
                'success' => true,
                'current_step' => $currentStep,
                'data' => $sessionData,
            ]);
        } catch (\Exception $e) {
            \Log::error('❌ Error in nextStep: '.$e->getMessage(), [
                'trace' => $e->getTraceAsString(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Error saving progress',
            ], 500);
        }
    }

    /**
     * Get services by category (API endpoint)
     */
    public function getServicesByCategory(Request $request)
    {
        $categoryId = $request->input('category_id');

        $services = Service::where('is_active', true)
            ->when($categoryId, function ($query) use ($categoryId) {
                return $query->where('category_id', $categoryId);
            })
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get(['id', 'name', 'slug', 'price_from', 'price_to', 'duration', 'short_description']);

        return response()->json(['success' => true, 'data' => $services]);
    }

    /**
     * Get service details (API endpoint)
     */
    public function getServiceDetails(Request $request)
    {
        $serviceId = $request->input('service_id');

        $service = Service::where('is_active', true)
            ->where('id', $serviceId)
            ->first(['id', 'name', 'slug', 'price_from', 'price_to', 'duration', 'short_description', 'description']);

        if (! $service) {
            return response()->json(['success' => false, 'message' => 'Service not found'], 404);
        }

        return response()->json(['success' => true, 'data' => $service]);
    }

    /**
     * Store the booking data.
     */
    public function store(Request $request)
    {
        // Log the incoming request for debugging
        \Log::info('Booking form submission', $request->all());

        // Validate the request
        $validator = Validator::make($request->all(), [
            'form_fields.category_booking_form' => 'required|string',
            'form_fields.service_booking_form' => 'required|string',
            'form_fields.bedrooms_booking_form' => 'required|integer',
            'form_fields.bathrooms_booking_form' => 'required|integer',
            'form_fields.extras_booking_form' => 'required|string',
            'form_fields.frequency_booking_form' => 'required|string',
            'form_fields.area_booking_form' => 'required|string',
            'form_fields.date_booking_form' => 'required|date',
            'form_fields.time_booking_form' => 'required',
            'form_fields.name_booking_form' => 'required|string|max:255',
            'form_fields.tel_booking_form' => 'required|string|max:20',
            'form_fields.email_booking_form' => 'required|email|max:255',
            'form_fields.street_booking_form' => 'required|string|max:500',
            'form_fields.city_booking_form' => 'required|string|max:255',
            'form_fields.states_booking_form' => 'required|string',
            'form_fields.zip_code_booking_form' => 'required|string|max:10',
            'form_fields.where_to_park_booking_form' => 'required|string',
            'form_fields.flexible_time_booking_form' => 'required|string',
            'form_fields.entrance_info_booking_form' => 'required|string',
            'form_fields.pets_booking_form' => 'required|string',
            'form_fields.message_booking_form' => 'nullable|string',
        ]);

        // Handle validation failure
        if ($validator->fails()) {
            \Log::error('Booking validation failed', $validator->errors()->toArray());

            $responseData = [
                'success' => false,
                'data' => [
                    'message' => 'Please fill all required fields correctly.',
                    'errors' => $validator->errors(),
                ],
            ];

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json($responseData, 422);
            }

            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', $responseData['data']['message']);
        }

        try {
            $formFields = $request->input('form_fields');

            // Get service_id if the service name matches
            $service = Service::where('name', $formFields['service_booking_form'])->first();

            // Create the booking
            $booking = BookService::create([
                'user_id' => Auth::check() ? Auth::id() : null,
                'service_id' => $service ? $service->id : null,
                'category_name' => $formFields['category_booking_form'] ?? null,
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

            \Log::info('Booking created successfully', ['booking_id' => $booking->id]);

            // Create notifications for service booking
            NotificationService::serviceBooked($booking);

            // Return JSON response for AJAX or redirect for normal form submission
            $responseData = [
                'success' => true,
                'data' => [
                    'message' => 'Thank you for booking a service! We will contact you soon to confirm your appointment.',
                    'booking_id' => $booking->id,
                ],
            ];

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json($responseData);
            }

            // For regular form submission, stay on same page with success flag
            return redirect()->route('book-services.index', ['success' => '1']);
        } catch (\Exception $e) {
            \Log::error('Booking submission error: '.$e->getMessage(), [
                'exception' => $e,
                'trace' => $e->getTraceAsString(),
            ]);

            $responseData = [
                'success' => false,
                'data' => [
                    'message' => 'An error occurred while submitting your booking. Please try again.',
                    'error' => $e->getMessage(),
                ],
            ];

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json($responseData, 500);
            }

            return redirect()->back()
                ->with('error', $responseData['data']['message'])
                ->withInput();
        }
    }

    /**
     * Save booking form data to session - Called as user fills out form step by step.
     */
    public function saveSession(Request $request)
    {
        try {
            $formData = $request->input('form_data', []);

            \Log::info('📝 Saving booking form data to session', [
                'category' => $formData['category_name'] ?? null,
                'service' => $formData['service_name'] ?? null,
                'timestamp' => now(),
            ]);

            session([
                'booking_form_data' => [
                    'category_name' => $formData['category_name'] ?? null,
                    'service_name' => $formData['service_name'] ?? null,
                    'bedrooms' => $formData['bedrooms'] ?? null,
                    'bathrooms' => $formData['bathrooms'] ?? null,
                    'extras' => $formData['extras'] ?? null,
                    'frequency' => $formData['frequency'] ?? null,
                    'area' => $formData['area'] ?? null,
                    'booking_date' => $formData['booking_date'] ?? null,
                    'booking_time' => $formData['booking_time'] ?? null,
                    'customer_name' => $formData['customer_name'] ?? null,
                    'phone' => $formData['phone'] ?? null,
                    'email' => $formData['email'] ?? null,
                    'street_address' => $formData['street_address'] ?? null,
                    'city' => $formData['city'] ?? null,
                    'state' => $formData['state'] ?? null,
                    'zip_code' => $formData['zip_code'] ?? null,
                    'parking_info' => $formData['parking_info'] ?? null,
                    'flexible_time' => $formData['flexible_time'] ?? null,
                    'entrance_info' => $formData['entrance_info'] ?? null,
                    'pets' => $formData['pets'] ?? null,
                    'special_instructions' => $formData['special_instructions'] ?? null,
                ],
            ]);

            \Log::info('✅ Session saved successfully', ['session_key' => 'booking_form_data']);

            return response()->json([
                'success' => true,
                'message' => 'Form data saved to session',
            ]);
        } catch (\Exception $e) {
            \Log::error('❌ Error saving booking to session: '.$e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Error saving form data',
            ], 500);
        }
    }

    /**
     * Get service price based on service name.
     */
    private function getServicePrice($serviceName)
    {
        $prices = [
            'Regular Cleaning' => 25.00,
            'Deep Cleaning' => 28.00,
            'Holiday Rental Cleaning' => 22.50,
        ];

        return $prices[$serviceName] ?? 25.00;
    }

    /**
     * Submit booking and handle payment redirection.
     */
    public function submitBooking(Request $request)
    {
        try {
            \Log::info('🔄 submitBooking called - Checking authentication', [
                'user_authenticated' => Auth::check(),
                'user_id' => Auth::id(),
                'timestamp' => now(),
            ]);

            if (! Auth::check()) {
                \Log::warning('⚠️ User NOT authenticated for booking submission - Saving to session and redirecting to login');

                // Save all form data to session before redirecting to login
                $data = $request->all();
                $currentStep = (int) ($data['current_step'] ?? 9);  // Default to step 9 (final step)

                session([
                    'booking_form_data' => [
                        'category_name' => $data['category_name'] ?? null,
                        'service_name' => $data['service_name'] ?? null,
                        'bedrooms' => $data['bedrooms'] ?? null,
                        'bathrooms' => $data['bathrooms'] ?? null,
                        'extras' => $data['extras'] ?? null,
                        'frequency' => $data['frequency'] ?? null,
                        'duration' => $data['duration'] ?? null,
                        'area' => $data['area'] ?? null,
                        'booking_date' => $data['booking_date'] ?? null,
                        'booking_time' => $data['booking_time'] ?? null,
                        'customer_name' => $data['customer_name'] ?? null,
                        'phone' => $data['phone'] ?? null,
                        'email' => $data['email'] ?? null,
                        'street_address' => $data['street_address'] ?? null,
                        'city' => $data['city'] ?? null,
                        'state' => $data['state'] ?? null,
                        'zip_code' => $data['zip_code'] ?? null,
                        'parking_info' => $data['parking_info'] ?? null,
                        'flexible_time' => $data['flexible_time'] ?? null,
                        'entrance_info' => $data['entrance_info'] ?? null,
                        'pets' => $data['pets'] ?? null,
                        'special_instructions' => $data['special_instructions'] ?? null,
                        'calculated_price' => $data['calculated_price'] ?? null,
                    ],
                    'booking_return_to_form' => true,
                    'booking_auto_submit' => true,
                    'booking_return_step' => $currentStep,  // Store the step they were on
                ]);

                \Log::info('✅ Form data saved to session - Redirecting to login', [
                    'current_step' => $currentStep,
                    'redirect_url' => route('login', ['redirect' => route('book-services.index')]),
                ]);

                return response()->json([
                    'status' => 401,
                    'redirect' => route('login', ['redirect' => route('book-services.index')]),
                    'message' => 'Please log in to complete your booking.',
                ], 401);
            }

            $data = $request->all();
            \Log::info('✅ User authenticated - Processing booking submission', [
                'user_id' => Auth::id(),
                'data_keys' => array_keys($data),
                'timestamp' => now(),
            ]);

            try {
                $service = Service::where('name', $data['service_name'] ?? '')->first();
                $price = !empty($data['calculated_price']) ? (float) $data['calculated_price'] : $this->getServicePrice($data['service_name'] ?? '');

                $bookingTime = $data['booking_time'] ?? '';
                if (is_array($bookingTime)) {
                    $bookingTime = reset($bookingTime);
                } elseif (is_string($bookingTime) && strpos($bookingTime, ',') !== false) {
                    $times = array_map('trim', explode(',', $bookingTime));
                    $bookingTime = reset($times);
                }

                $extras = $data['extras'] ?? '';
                if (is_array($extras)) {
                    $extras = implode(', ', $extras);
                }

                $bookingData = [
                    'user_id' => Auth::id(),
                    'service_id' => $service ? $service->id : null,
                    'category_name' => $data['category_name'] ?? null,
                    'service_name' => $data['service_name'] ?? '',
                    'customer_name' => $data['customer_name'] ?? '',
                    'email' => $data['email'] ?? '',
                    'phone' => $data['phone'] ?? '',
                    'street_address' => $data['street_address'] ?? '',
                    'city' => $data['city'] ?? '',
                    'state' => $data['state'] ?? '',
                    'zip_code' => $data['zip_code'] ?? '',
                    'bedrooms' => isset($data['bedrooms']) ? (int) $data['bedrooms'] : 0,
                    'bathrooms' => isset($data['bathrooms']) ? (int) $data['bathrooms'] : 0,
                    'extras' => $extras,
                    'frequency' => $data['frequency'] ?? '',
                    'square_feet' => $data['area'] ?? '',
                    'booking_date' => $data['booking_date'] ?? null,
                    'booking_time' => $bookingTime,
                    'parking_info' => $data['parking_info'] ?? '',
                    'flexible_time' => $data['flexible_time'] ?? '',
                    'entrance_info' => $data['entrance_info'] ?? '',
                    'pets' => $data['pets'] ?? '',
                    'special_instructions' => $data['special_instructions'] ?? null,
                    'status' => 'pending',
                    'price' => $price,
                ];

                \Log::info('📋 Booking data prepared - Creating record', $bookingData);

                $booking = BookService::create($bookingData);

                \Log::info('✨ Booking created successfully!', [
                    'booking_id' => $booking->id,
                    'user_id' => Auth::id(),
                    'service' => $data['service_name'] ?? 'Unknown',
                ]);

                NotificationService::serviceBooked($booking);

                // Clear ALL session data after successful booking confirmation
                session()->forget(['booking_form_data', 'booking_return_to_form', 'booking_auto_submit', 'booking_return_step']);
                \Log::info('🗑️ Session data cleaned up - Booking complete', [
                    'booking_id' => $booking->id,
                    'cleared_keys' => ['booking_form_data', 'booking_return_to_form', 'booking_auto_submit', 'booking_return_step'],
                ]);

                return response()->json([
                    'status' => 200,
                    'redirect' => route('book-services.index', ['success' => '1']),
                    'message' => 'Your service has been booked successfully! We will contact you soon to confirm your appointment.',
                ]);

            } catch (\Exception $createError) {
                \Log::error('Error creating booking record', [
                    'message' => $createError->getMessage(),
                    'trace' => $createError->getTraceAsString(),
                    'data' => $bookingData ?? $data,
                ]);

                return response()->json([
                    'status' => 500,
                    'message' => 'Database error: '.$createError->getMessage(),
                ], 500);
            }
        } catch (\Exception $e) {
            \Log::error('Booking submission error: '.$e->getMessage(), [
                'exception' => $e,
                'trace' => $e->getTraceAsString(),
                'request' => $request->all(),
            ]);

            return response()->json([
                'status' => 500,
                'message' => 'Error: '.$e->getMessage(),
            ], 500);
        }
    }

 public function finalizeBookingFromSession(): ?array
    {
        if (! Auth::check()) {
            \Log::warning('⚠️ Cannot auto-submit booking - User not authenticated');

            return null;
        }

        if (! session()->get('booking_auto_submit')) {
            return null;
        }

        $formData = session('booking_form_data', []);
        if (empty($formData) || empty($formData['service_name'])) {
            \Log::warning('⚠️ Auto submission skipped - Missing session data', [
                'has_form_data' => ! empty($formData),
                'service_name' => $formData['service_name'] ?? null,
            ]);

            return null;
        }

        try {
            $service = Service::where('name', $formData['service_name'])->first();
            $price = $this->getServicePrice($formData['service_name'] ?? '');

            $extras = $formData['extras'] ?? '';
            if (is_array($extras)) {
                $extras = implode(', ', array_filter($extras));
            }

            $bookingTime = $formData['booking_time'] ?? '';
            if (is_array($bookingTime)) {
                $bookingTime = reset($bookingTime);
            } elseif (is_string($bookingTime) && strpos($bookingTime, ',') !== false) {
                $times = array_map('trim', explode(',', $bookingTime));
                $bookingTime = reset($times);
            }

            $bookingData = [
                'user_id' => Auth::id(),
                'service_id' => $service ? $service->id : null,
                'category_name' => $formData['category_name'] ?? null,
                'service_name' => $formData['service_name'] ?? '',
                'customer_name' => $formData['customer_name'] ?? ($formData['name'] ?? ''),
                'email' => $formData['email'] ?? '',
                'phone' => $formData['phone'] ?? '',
                'street_address' => $formData['street_address'] ?? '',
                'city' => $formData['city'] ?? '',
                'state' => $formData['state'] ?? '',
                'zip_code' => $formData['zip_code'] ?? '',
                'bedrooms' => isset($formData['bedrooms']) ? (int) $formData['bedrooms'] : 0,
                'bathrooms' => isset($formData['bathrooms']) ? (int) $formData['bathrooms'] : 0,
                'extras' => $extras,
                'frequency' => $formData['frequency'] ?? '',
                'square_feet' => $formData['area'] ?? ($formData['square_feet'] ?? ''),
                'booking_date' => $formData['booking_date'] ?? null,
                'booking_time' => $bookingTime,
                'parking_info' => $formData['parking_info'] ?? '',
                'flexible_time' => $formData['flexible_time'] ?? '',
                'entrance_info' => $formData['entrance_info'] ?? '',
                'pets' => $formData['pets'] ?? '',
                'special_instructions' => $formData['special_instructions'] ?? null,
                'status' => 'pending',
                'price' => $price,
            ];

            \Log::info('🚀 Auto-submitting booking from session', [
                'user_id' => Auth::id(),
                'data_keys' => array_keys($formData),
            ]);

            $booking = BookService::create($bookingData);

            NotificationService::serviceBooked($booking);

            session()->forget(['booking_form_data', 'booking_return_to_form', 'booking_auto_submit', 'booking_return_step']);

            $redirect = route('book-services.index', ['success' => '1']);

            \Log::info('✨ Auto submission complete - Service booked successfully', [
                'booking_id' => $booking->id,
                'redirect' => $redirect,
            ]);

            return [
                'booking' => $booking,
                'redirect' => $redirect,
            ];
        } catch (\Throwable $e) {
            \Log::error('❌ Failed to auto-submit booking from session', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'user_id' => Auth::id(),
            ]);

            return null;
        }
    }
}
