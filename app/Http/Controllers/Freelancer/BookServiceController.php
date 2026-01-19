<?php

namespace App\Http\Controllers\Freelancer;

use App\Http\Controllers\Controller;
use App\Models\BookService;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookServiceController extends Controller
{
    /**
     * Display a listing of bookings for freelancer's services.
     */
    public function index(Request $request)
    {
        // Get services created by the authenticated freelancer
        $freelancerServiceIds = Service::where('user_id', Auth::id())->pluck('id');

        // Get bookings for the freelancer's services
        $bookServices = BookService::whereIn('service_id', $freelancerServiceIds)
            ->with(['service', 'user'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('freelancer.book-services.index', compact('bookServices'));
    }

    /**
     * Display the specified booking.
     */
    public function show(BookService $bookService)
    {
        // Check if this booking is for a service created by the authenticated freelancer
        if (!$bookService->service || $bookService->service->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access to booking.');
        }

        return view('freelancer.book-services.show', compact('bookService'));
    }

    /**
     * Freelancers cannot create new bookings (they receive them)
     */
    public function create()
    {
        return redirect()->route('freelancer.book-services.index')
            ->with('error', 'As a freelancer, you receive bookings for your services. You cannot create new bookings.');
    }

    /**
     * Freelancers cannot store new bookings (they receive them)
     */
    public function store(Request $request)
    {
        return redirect()->route('freelancer.book-services.index')
            ->with('error', 'As a freelancer, you receive bookings for your services. You cannot create new bookings.');
    }

    /**
     * Show the form for editing the specified booking (status updates only).
     */
    public function edit(BookService $bookService)
    {
        // Check if this booking is for a service created by the authenticated freelancer
        if (!$bookService->service || $bookService->service->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access to booking.');
        }

        return view('freelancer.book-services.edit', compact('bookService'));
    }

    /**
     * Update the specified booking (freelancers can update status and pricing).
     */
    public function update(Request $request, BookService $bookService)
    {
        // Check if this booking is for a service created by the authenticated freelancer
        if (!$bookService->service || $bookService->service->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access to booking.');
        }

        $request->validate([
            'status' => 'required|in:pending,confirmed,completed,cancelled',
            'price' => 'nullable|numeric|min:0|max:999999.99',
        ]);

        try {
            $bookService->update([
                'status' => $request->input('status'),
                'price' => $request->input('price'),
            ]);

            return redirect()->route('freelancer.book-services.show', $bookService)
                ->with('success', 'Booking updated successfully!');
        } catch (\Exception $e) {
            \Log::error('Freelancer booking update error: ' . $e->getMessage(), [
                'booking_id' => $bookService->id,
                'freelancer_id' => Auth::id()
            ]);

            return back()->withErrors(['error' => 'Failed to update booking. Please try again.'])
                ->withInput();
        }
    }

    /**
     * Freelancers cannot delete bookings (they can only update status)
     */
    public function destroy(BookService $bookService)
    {
        return redirect()->route('freelancer.book-services.index')
            ->with('error', 'Bookings cannot be deleted. You can update the status to "cancelled" instead.');
    }
}
