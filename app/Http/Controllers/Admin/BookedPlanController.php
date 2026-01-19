<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BookedPlan;
use App\Models\User;
use App\Models\Plan;
use Illuminate\Http\Request;

class BookedPlanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = BookedPlan::with(['user', 'plan']);

        // Search by user name or email
        if ($request->filled('user_search')) {
            $userSearch = $request->get('user_search');
            $query->whereHas('user', function ($q) use ($userSearch) {
                $q->where('name', 'LIKE', '%' . $userSearch . '%')
                  ->orWhere('first_name', 'LIKE', '%' . $userSearch . '%')
                  ->orWhere('last_name', 'LIKE', '%' . $userSearch . '%')
                  ->orWhere('email', 'LIKE', '%' . $userSearch . '%');
            });
        }

        // Search by plan name
        if ($request->filled('plan_search')) {
            $planSearch = $request->get('plan_search');
            $query->whereHas('plan', function ($q) use ($planSearch) {
                $q->where('name', 'LIKE', '%' . $planSearch . '%');
            });
        }

        // Filter by status
        if ($request->filled('status') && $request->get('status') !== '') {
            $query->where('status', $request->get('status'));
        }

        // Filter by payment method
        if ($request->filled('payment_method') && $request->get('payment_method') !== '') {
            $query->where('payment_method', $request->get('payment_method'));
        }

        // Filter by date range
        if ($request->filled('date_from')) {
            $query->whereDate('booking_date', '>=', $request->get('date_from'));
        }
        if ($request->filled('date_to')) {
            $query->whereDate('booking_date', '<=', $request->get('date_to'));
        }

        $bookedPlans = $query->orderBy('booking_date', 'desc')->paginate(15);

        // Preserve query parameters in pagination
        $bookedPlans->appends($request->query());

        // Get unique payment methods for filter dropdown
        $paymentMethods = BookedPlan::select('payment_method')
            ->distinct()
            ->whereNotNull('payment_method')
            ->pluck('payment_method')
            ->sort();

        return view('admin.booked-plans.index', compact('bookedPlans', 'paymentMethods'));
    }

    /**
     * Display the specified resource.
     */
    public function show(BookedPlan $bookedPlan)
    {
        $bookedPlan->load(['user', 'plan']);
        return view('admin.booked-plans.show', compact('bookedPlan'));
    }

    /**
     * Update the booking status.
     */
    public function updateStatus(Request $request, BookedPlan $bookedPlan)
    {
        $request->validate([
            'status' => 'required|in:success,pending,failed'
        ]);

        $bookedPlan->update([
            'status' => $request->status
        ]);

        return redirect()->back()->with('success', 'Booking status updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BookedPlan $bookedPlan)
    {
        $bookedPlan->delete();

        return redirect()->route('admin.booked-plans.index')
            ->with('success', 'Booked plan deleted successfully.');
    }
}
