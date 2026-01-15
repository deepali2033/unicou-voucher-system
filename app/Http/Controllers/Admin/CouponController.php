<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Voucher;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function index(Request $request)
    {
        $query = Coupon::with('voucher');

        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where('code', 'like', "%$search%")
                  ->orWhere('campaign_name', 'like', "%$search%");
        }

        if ($request->has('status') && !empty($request->status)) {
            $query->where('status', $request->status);
        }

        $coupons = $query->latest()->paginate(10);
        return view('admin.coupons.index', compact('coupons'));
    }

    public function create()
    {
        $vouchers = Voucher::where('extended_status', 'active')->get();
        return view('admin.coupons.create', compact('vouchers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'voucher_id' => 'required|exists:vouchers,id',
            'code' => 'required|string|unique:coupons,code|max:50',
            'campaign_name' => 'nullable|string|max:255',
            'start_date' => 'required|date_format:Y-m-d H:i',
            'end_date' => 'required|date_format:Y-m-d H:i|after:start_date',
            'quantity' => 'required|integer|min:1',
            'status' => 'required|in:active,inactive',
        ]);

        Coupon::create([
            'voucher_id' => $validated['voucher_id'],
            'code' => strtoupper($validated['code']),
            'campaign_name' => $validated['campaign_name'],
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'quantity' => $validated['quantity'],
            'status' => $validated['status'],
        ]);

        return redirect()->route('admin.coupons.index')->with('success', 'Coupon created successfully!');
    }

    public function show(Coupon $coupon)
    {
        $coupon->load(['voucher', 'redemptions']);
        return view('admin.coupons.show', compact('coupon'));
    }

    public function edit(Coupon $coupon)
    {
        $vouchers = Voucher::where('extended_status', 'active')->get();
        return view('admin.coupons.edit', compact('coupon', 'vouchers'));
    }

    public function update(Request $request, Coupon $coupon)
    {
        $validated = $request->validate([
            'voucher_id' => 'required|exists:vouchers,id',
            'code' => 'required|string|max:50|unique:coupons,code,' . $coupon->id,
            'campaign_name' => 'nullable|string|max:255',
            'start_date' => 'required|date_format:Y-m-d H:i',
            'end_date' => 'required|date_format:Y-m-d H:i|after:start_date',
            'quantity' => 'required|integer|min:1',
            'status' => 'required|in:active,inactive',
        ]);

        $coupon->update([
            'voucher_id' => $validated['voucher_id'],
            'code' => strtoupper($validated['code']),
            'campaign_name' => $validated['campaign_name'],
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'quantity' => $validated['quantity'],
            'status' => $validated['status'],
        ]);

        return redirect()->route('admin.coupons.index')->with('success', 'Coupon updated successfully!');
    }

    public function destroy(Coupon $coupon)
    {
        $coupon->delete();
        return redirect()->route('admin.coupons.index')->with('success', 'Coupon deleted successfully!');
    }
}
