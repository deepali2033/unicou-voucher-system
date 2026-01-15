<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Voucher;
use App\Models\VoucherAuditLog;
use Illuminate\Http\Request;
use Carbon\Carbon;

class VoucherController extends Controller
{
    public function create()
    {
        return view('admin.vouchers.create');
    }

    public function store(Request $request)
    {
        $today = Carbon::today();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|unique:vouchers,code|max:50',
            'description' => 'nullable|string|max:500',
            'type' => 'required|in:discount,fixed_amount,free_item',
            'discount_percent' => 'nullable|numeric|min:0|max:100',
            'fixed_amount' => 'nullable|numeric|min:0',
            'free_item_name' => 'nullable|string|max:255',
            'price' => 'required|numeric|min:0.01',
            'stock' => 'nullable|integer|min:0',
            'low_stock_threshold' => 'nullable|integer|min:0',
            'start_date' => 'required|date|date_format:Y-m-d|after_or_equal:' . $today->format('Y-m-d'),
            'end_date' => 'required|date|date_format:Y-m-d|after:start_date',
            'per_user_limit' => 'nullable|integer|min:1',
            'total_limit' => 'nullable|integer|min:1',
            'applicable_user_types' => 'nullable|array',
            'applicable_user_types.*' => 'string',
        ]);

        $voucher = Voucher::create([
            'name' => $validated['name'],
            'code' => strtoupper($validated['code']),
            'description' => $validated['description'],
            'type' => $validated['type'],
            'discount_percent' => $validated['discount_percent'] ?? 0,
            'fixed_amount' => $validated['fixed_amount'],
            'free_item_name' => $validated['free_item_name'],
            'price' => $validated['price'],
            'stock' => $validated['stock'] ?? 0,
            'low_stock_threshold' => $validated['low_stock_threshold'] ?? 5,
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'per_user_limit' => $validated['per_user_limit'],
            'total_limit' => $validated['total_limit'],
            'applicable_user_types' => $validated['applicable_user_types'],
            'extended_status' => 'active',
            'last_modified_by' => auth()->id(),
        ]);

        $this->logAudit($voucher, 'created', null, $voucher->toArray());

        return redirect()->route('admin.vouchers.index')->with('success', 'Voucher created successfully!');
    }

    public function index(Request $request)
    {
        $query = Voucher::query();

        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where('name', 'like', "%$search%")
                  ->orWhere('code', 'like', "%$search%");
        }

        if ($request->has('status') && !empty($request->status)) {
            $query->where('extended_status', $request->status);
        }

        if ($request->has('type') && !empty($request->type)) {
            $query->where('type', $request->type);
        }

        if ($request->has('sort')) {
            $sort = $request->sort;
            switch ($sort) {
                case 'newest':
                    $query->latest();
                    break;
                case 'oldest':
                    $query->oldest();
                    break;
                case 'name_asc':
                    $query->orderBy('name');
                    break;
                case 'name_desc':
                    $query->orderByDesc('name');
                    break;
            }
        } else {
            $query->latest();
        }

        $vouchers = $query->paginate(10);
        return view('admin.vouchers.index', compact('vouchers'));
    }

    public function show(Voucher $voucher)
    {
        $voucher->load(['coupons', 'redemptions', 'bonuses', 'referrals', 'auditLogs']);
        return view('admin.vouchers.show', compact('voucher'));
    }

    public function edit(Voucher $voucher)
    {
        return view('admin.vouchers.edit', compact('voucher'));
    }

    public function update(Request $request, Voucher $voucher)
    {
        $today = Carbon::today();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:vouchers,code,' . $voucher->id,
            'description' => 'nullable|string|max:500',
            'type' => 'required|in:discount,fixed_amount,free_item',
            'discount_percent' => 'nullable|numeric|min:0|max:100',
            'fixed_amount' => 'nullable|numeric|min:0',
            'free_item_name' => 'nullable|string|max:255',
            'price' => 'required|numeric|min:0.01',
            'stock' => 'nullable|integer|min:0',
            'low_stock_threshold' => 'nullable|integer|min:0',
            'start_date' => 'required|date|date_format:Y-m-d',
            'end_date' => 'required|date|date_format:Y-m-d|after:start_date',
            'per_user_limit' => 'nullable|integer|min:1',
            'total_limit' => 'nullable|integer|min:1',
            'applicable_user_types' => 'nullable|array',
            'applicable_user_types.*' => 'string',
            'extended_status' => 'required|in:active,inactive,frozen',
        ]);

        $oldValues = $voucher->toArray();

        $voucher->update([
            'name' => $validated['name'],
            'code' => strtoupper($validated['code']),
            'description' => $validated['description'],
            'type' => $validated['type'],
            'discount_percent' => $validated['discount_percent'] ?? 0,
            'fixed_amount' => $validated['fixed_amount'],
            'free_item_name' => $validated['free_item_name'],
            'price' => $validated['price'],
            'stock' => $validated['stock'] ?? 0,
            'low_stock_threshold' => $validated['low_stock_threshold'] ?? 5,
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'per_user_limit' => $validated['per_user_limit'],
            'total_limit' => $validated['total_limit'],
            'applicable_user_types' => $validated['applicable_user_types'],
            'extended_status' => $validated['extended_status'],
            'last_modified_by' => auth()->id(),
        ]);

        $this->logAudit($voucher, 'updated', $oldValues, $voucher->toArray());

        return redirect()->route('admin.vouchers.index')->with('success', 'Voucher updated successfully!');
    }

    public function destroy(Voucher $voucher)
    {
        $this->logAudit($voucher, 'deleted', $voucher->toArray(), null);
        $voucher->delete();
        return redirect()->route('admin.vouchers.index')->with('success', 'Voucher deleted successfully!');
    }

    public function freeze(Voucher $voucher)
    {
        $oldValues = $voucher->toArray();
        $voucher->update([
            'extended_status' => 'frozen',
            'last_freeze_unfreeze_at' => now(),
        ]);
        $this->logAudit($voucher, 'frozen', $oldValues, $voucher->toArray());

        return redirect()->route('admin.vouchers.index')->with('success', 'Voucher frozen successfully!');
    }

    public function unfreeze(Voucher $voucher)
    {
        $oldValues = $voucher->toArray();
        $voucher->update([
            'extended_status' => 'active',
            'last_freeze_unfreeze_at' => now(),
        ]);
        $this->logAudit($voucher, 'unfrozen', $oldValues, $voucher->toArray());

        return redirect()->route('admin.vouchers.index')->with('success', 'Voucher unfrozen successfully!');
    }

    private function logAudit(Voucher $voucher, string $action, ?array $oldValues, ?array $newValues)
    {
        VoucherAuditLog::create([
            'voucher_id' => $voucher->id,
            'admin_id' => auth()->id(),
            'action' => $action,
            'old_values' => $oldValues,
            'new_values' => $newValues,
            'ip_address' => request()->ip(),
            'description' => "Voucher {$action}: {$voucher->code}",
        ]);
    }
}
