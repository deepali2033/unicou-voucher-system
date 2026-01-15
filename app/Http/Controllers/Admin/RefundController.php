<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Refund;
use App\Models\Transaction;
use Illuminate\Http\Request;

class RefundController extends Controller
{
    public function index()
    {
        $refunds = Refund::with(['user', 'transaction'])->latest()->paginate(10);
        return view('admin.refunds.index', compact('refunds'));
    }

    public function approve(Refund $refund)
    {
        if ($refund->status !== 'pending') {
            return back()->with('error', 'This refund has already been processed.');
        }

        // Process refund logic (e.g., return credit to user)
        $user = $refund->user;
        $user->credit += $refund->amount;
        $user->save();

        // Mark transaction as refunded
        $refund->transaction->update(['status' => 'refunded']);

        // Create a refund transaction entry
        Transaction::create([
            'user_id' => $user->id,
            'amount' => $refund->amount,
            'type' => 'refund',
            'status' => 'completed',
            'description' => 'Refund for transaction #' . $refund->transaction_id,
            'voucher_id' => $refund->transaction->voucher_id
        ]);

        $refund->update(['status' => 'approved']);

        return back()->with('success', 'Refund approved and credit returned to user.');
    }

    public function reject(Request $request, Refund $refund)
    {
        if ($refund->status !== 'pending') {
            return back()->with('error', 'This refund has already been processed.');
        }

        $refund->update([
            'status' => 'rejected',
            'admin_note' => $request->admin_note
        ]);

        return back()->with('success', 'Refund request rejected.');
    }
}
