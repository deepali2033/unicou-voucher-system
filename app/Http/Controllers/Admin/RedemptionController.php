<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Redemption;
use Illuminate\Http\Request;

class RedemptionController extends Controller
{
    public function index(Request $request)
    {
        $query = Redemption::with(['voucher', 'user', 'coupon']);

        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->whereHas('user', function ($q) use ($search) {
                $q->where('email', 'like', "%$search%")
                  ->orWhere('name', 'like', "%$search%");
            })->orWhereHas('voucher', function ($q) use ($search) {
                $q->where('code', 'like', "%$search%");
            });
        }

        if ($request->has('status') && !empty($request->status)) {
            $query->where('status', $request->status);
        }

        if ($request->has('date_from') && !empty($request->date_from)) {
            $query->whereDate('redeemed_at', '>=', $request->date_from);
        }

        if ($request->has('date_to') && !empty($request->date_to)) {
            $query->whereDate('redeemed_at', '<=', $request->date_to);
        }

        $redemptions = $query->latest('redeemed_at')->paginate(15);
        return view('admin.redemptions.index', compact('redemptions'));
    }

    public function show(Redemption $redemption)
    {
        $redemption->load(['voucher', 'user', 'coupon', 'bonus', 'referral']);
        return view('admin.redemptions.show', compact('redemption'));
    }
}
