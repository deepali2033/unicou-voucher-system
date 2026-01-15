<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bonus;
use App\Models\User;
use App\Models\Voucher;
use Illuminate\Http\Request;

class BonusController extends Controller
{
    public function index(Request $request)
    {
        $query = Bonus::with(['user', 'voucher']);

        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->whereHas('user', function ($q) use ($search) {
                $q->where('email', 'like', "%$search%")
                  ->orWhere('name', 'like', "%$search%");
            });
        }

        if ($request->has('status') && !empty($request->status)) {
            $query->where('status', $request->status);
        }

        $bonuses = $query->latest()->paginate(10);
        return view('admin.bonuses.index', compact('bonuses'));
    }

    public function create()
    {
        $users = User::orderBy('name')->get();
        $vouchers = Voucher::where('extended_status', 'active')->get();
        return view('admin.bonuses.create', compact('users', 'vouchers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'voucher_id' => 'required|exists:vouchers,id',
            'bonus_points' => 'nullable|integer|min:0',
            'bonus_amount' => 'nullable|numeric|min:0',
            'reason' => 'required|string|max:255',
            'expires_at' => 'nullable|date_format:Y-m-d H:i',
            'status' => 'required|in:active,expired,redeemed',
        ]);

        Bonus::create([
            'user_id' => $validated['user_id'],
            'voucher_id' => $validated['voucher_id'],
            'bonus_points' => $validated['bonus_points'] ?? 0,
            'bonus_amount' => $validated['bonus_amount'],
            'reason' => $validated['reason'],
            'expires_at' => $validated['expires_at'],
            'status' => $validated['status'],
        ]);

        return redirect()->route('admin.bonuses.index')->with('success', 'Bonus assigned successfully!');
    }

    public function show(Bonus $bonus)
    {
        $bonus->load(['user', 'voucher', 'redemption']);
        return view('admin.bonuses.show', compact('bonus'));
    }

    public function edit(Bonus $bonus)
    {
        $users = User::orderBy('name')->get();
        $vouchers = Voucher::where('extended_status', 'active')->get();
        return view('admin.bonuses.edit', compact('bonus', 'users', 'vouchers'));
    }

    public function update(Request $request, Bonus $bonus)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'voucher_id' => 'required|exists:vouchers,id',
            'bonus_points' => 'nullable|integer|min:0',
            'bonus_amount' => 'nullable|numeric|min:0',
            'reason' => 'required|string|max:255',
            'expires_at' => 'nullable|date_format:Y-m-d H:i',
            'status' => 'required|in:active,expired,redeemed',
        ]);

        $bonus->update([
            'user_id' => $validated['user_id'],
            'voucher_id' => $validated['voucher_id'],
            'bonus_points' => $validated['bonus_points'] ?? 0,
            'bonus_amount' => $validated['bonus_amount'],
            'reason' => $validated['reason'],
            'expires_at' => $validated['expires_at'],
            'status' => $validated['status'],
        ]);

        return redirect()->route('admin.bonuses.index')->with('success', 'Bonus updated successfully!');
    }

    public function destroy(Bonus $bonus)
    {
        $bonus->delete();
        return redirect()->route('admin.bonuses.index')->with('success', 'Bonus deleted successfully!');
    }
}
