<?php

namespace App\Http\Controllers;

use App\Models\Quote;
use App\Models\Notification;
use App\Models\User;
use App\Models\Service;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class QuoteController extends Controller
{
    /**
     * Display the free quote page.
     */
    public function index()
    {
        $categories = Category::where('is_active', true)->get() ?? collect();
        
        $services = Service::where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get() ?? collect();

        $servicesByCategory = $services->groupBy('category_id');
        
        $showSuccess = request()->get('success') === '1';

        return view('book-services.index', [
            'categories' => $categories,
            'services' => $services,
            'servicesByCategory' => $servicesByCategory,
            'showSuccess' => $showSuccess
        ]);
    }

    /**
     * Handle quote form submission.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:500',
            'service_type' => 'required|string',
            'frequency' => 'nullable|string',
            'bedrooms' => 'nullable|integer|min:0',
            'bathrooms' => 'nullable|integer|min:0',
            'square_feet' => 'nullable|integer|min:0',
            'additional_services' => 'nullable|array',
            'preferred_date' => 'nullable|date',
            'preferred_time' => 'nullable|string',
            'special_instructions' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Here you would typically save the quote request to database
        // and send notifications to admin

        return redirect()->back()->with('success', 'Thank you for your quote request! We will contact you within 24 hours with a personalized estimate.');
    }

    /**
     * Handle quote form submission from home page
     */
    public function submitQuote(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'total_square_footage' => 'required|string|max:50',
            'service' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Please fill all required fields correctly.',
                    'errors' => $validator->errors()
                ], 422);
            }

            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Please fill all required fields correctly.');
        }

        try {
            // Create the quote
            $quote = Quote::create([
                'user_id' => Auth::check() ? Auth::id() : null,
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'total_square_footage' => $request->total_square_footage,
                'service' => $request->service,
            ]);

            // Create notification for admin
            $admins = User::where('account_type', 'admin')->get();
            foreach ($admins as $admin) {
                Notification::create([
                    'user_id' => $admin->id,
                    'title' => 'New Quote Submitted',
                    'description' => "New quote request from {$quote->name} for {$quote->total_square_footage} sq ft",
                    'type' => 'quote',
                    'action' => route('admin.quotes.show', $quote->id),
                    'related_id' => $quote->id,
                    'is_read' => false,
                ]);
            }

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Submitted successfully',
                    'data' => [
                        'quote_id' => $quote->id,
                        'name' => $quote->name
                    ]
                ], 200);
            }

            return redirect()->back()->with('success', 'Thank you for your quote request! We will contact you within 24 hours with a personalized estimate.');
        } catch (\Exception $e) {
            \Log::error('Quote submission error: ' . $e->getMessage());

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'An error occurred while submitting your quote. Please try again.'
                ], 500);
            }

            return redirect()->back()
                ->with('error', 'An error occurred while submitting your quote. Please try again.')
                ->withInput();
        }
    }
}
