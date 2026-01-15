<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\Voucher;
use App\Models\VoucherAuditLog;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
        $settings = Setting::all()->pluck('value', 'key');
        $systemPaused = Setting::get('voucher_system_paused', '0') === '1';
        $pausedBy = Setting::get('voucher_system_paused_by');
        $pausedAt = Setting::get('voucher_system_paused_at');
        
        return view('admin.settings.index', compact('settings', 'systemPaused', 'pausedBy', 'pausedAt'));
    }

    public function toggleVoucherSystem(Request $request)
    {
        $currentStatus = Setting::get('voucher_system_active', '1');
        $newStatus = $currentStatus === '1' ? '0' : '1';
        Setting::set('voucher_system_active', $newStatus);

        $message = $newStatus === '1' ? 'Voucher system activated.' : 'Voucher system deactivated.';
        return back()->with('success', $message);
    }

    public function pauseVoucherSystem(Request $request)
    {
        $isPaused = Setting::get('voucher_system_paused', '0') === '1';
        
        if ($isPaused) {
            return back()->with('warning', 'Voucher system is already paused.');
        }

        Setting::set('voucher_system_paused', '1');
        Setting::set('voucher_system_paused_by', auth()->id());
        Setting::set('voucher_system_paused_at', now());

        Voucher::query()->update(['is_system_paused' => true]);

        $this->logSystemAction('paused', 'Voucher system paused - all vouchers cannot be redeemed');

        return back()->with('success', 'Voucher system paused successfully. No vouchers can be redeemed until resumed.');
    }

    public function resumeVoucherSystem(Request $request)
    {
        $isPaused = Setting::get('voucher_system_paused', '0') === '0';
        
        if ($isPaused) {
            return back()->with('warning', 'Voucher system is already active.');
        }

        Setting::set('voucher_system_paused', '0');
        Setting::set('voucher_system_paused_by', null);
        Setting::set('voucher_system_paused_at', null);

        Voucher::query()->update(['is_system_paused' => false]);

        $this->logSystemAction('resumed', 'Voucher system resumed - vouchers can be redeemed again');

        return back()->with('success', 'Voucher system resumed successfully.');
    }

    public function update(Request $request)
    {
        foreach ($request->except('_token') as $key => $value) {
            Setting::set($key, $value);
        }

        return back()->with('success', 'Settings updated successfully.');
    }

    private function logSystemAction(string $action, string $description)
    {
        VoucherAuditLog::create([
            'voucher_id' => null,
            'admin_id' => auth()->id(),
            'action' => "system_$action",
            'old_values' => null,
            'new_values' => null,
            'ip_address' => request()->ip(),
            'description' => $description,
        ]);
    }
}
