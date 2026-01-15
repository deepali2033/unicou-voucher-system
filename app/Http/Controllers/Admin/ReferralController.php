<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Referral;
use App\Models\User;
use App\Models\Voucher;
use Illuminate\Http\Request;

class ReferralController extends Controller
{
    public function index(Request $request)
    {
        $query = Referral::with(['referrer', 'referredUser', 'voucher']);

        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->whereHas('referrer', function ($q) use ($search) {
                $q->where('email', 'like', "%$search%")
                  ->orWhere('name', 'like', "%$search%");
            })->orWhereHas('referredUser', function ($q) use ($search) {
                $q->where('email', 'like', "%$search%")
                  ->orWhere('name', 'like', "%$search%");
            });
        }

        if ($request->has('status') && !empty($request->status)) {
            $query->where('status', $request->status);
        }

        $referrals = $query->latest()->paginate(10);
        return view('admin.referrals.index', compact('referrals'));
    }

    public function create()
    {
        $users = User::orderBy('name')->get();
        $vouchers = Voucher::where('extended_status', 'active')->get();
        return view('admin.referrals.create', compact('users', 'vouchers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'voucher_id' => 'required|exists:vouchers,id',
            'referrer_id' => 'required|exists:users,id|different:referred_user_id',
            'referred_user_id' => 'required|exists:users,id|different:referrer_id',
            'reward_amount' => 'nullable|numeric|min:0',
            'reward_points' => 'nullable|integer|min:0',
            'status' => 'required|in:pending,completed,cancelled',
            'notes' => 'nullable|string|max:500',
        ]);

        Referral::create([
            'voucher_id' => $validated['voucher_id'],
            'referrer_id' => $validated['referrer_id'],
            'referred_user_id' => $validated['referred_user_id'],
            'reward_amount' => $validated['reward_amount'],
            'reward_points' => $validated['reward_points'] ?? 0,
            'status' => $validated['status'],
            'notes' => $validated['notes'],
        ]);

        return redirect()->route('admin.referrals.index')->with('success', 'Referral created successfully!');
    }

    public function show(Referral $referral)
    {
        $referral->load(['referrer', 'referredUser', 'voucher', 'redemption']);
        return view('admin.referrals.show', compact('referral'));
    }

    public function edit(Referral $referral)
    {
        $users = User::orderBy('name')->get();
        $vouchers = Voucher::where('extended_status', 'active')->get();
        return view('admin.referrals.edit', compact('referral', 'users', 'vouchers'));
    }

    public function update(Request $request, Referral $referral)
    {
        $validated = $request->validate([
            'voucher_id' => 'required|exists:vouchers,id',
            'referrer_id' => 'required|exists:users,id|different:referred_user_id',
            'referred_user_id' => 'required|exists:users,id|different:referrer_id',
            'reward_amount' => 'nullable|numeric|min:0',
            'reward_points' => 'nullable|integer|min:0',
            'status' => 'required|in:pending,completed,cancelled',
            'completed_at' => 'nullable|date_format:Y-m-d H:i',
            'notes' => 'nullable|string|max:500',
        ]);

        $referral->update([
            'voucher_id' => $validated['voucher_id'],
            'referrer_id' => $validated['referrer_id'],
            'referred_user_id' => $validated['referred_user_id'],
            'reward_amount' => $validated['reward_amount'],
            'reward_points' => $validated['reward_points'] ?? 0,
            'status' => $validated['status'],
            'completed_at' => $validated['completed_at'],
            'notes' => $validated['notes'],
        ]);

        return redirect()->route('admin.referrals.index')->with('success', 'Referral updated successfully!');
    }

    public function destroy(Referral $referral)
    {
        $referral->delete();
        return redirect()->route('admin.referrals.index')->with('success', 'Referral deleted successfully!');
    }
}
