<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Voucher;
use App\Models\Transaction;
use App\Models\Refund;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function admin()
    {
        $totalPurchases = Transaction::where('type', 'purchase')->sum('amount');
        $totalRefunds = Refund::where('status', 'approved')->sum('amount');
        
        $monthlyPurchases = Transaction::where('type', 'purchase')
            ->whereMonth('created_at', Carbon::now()->month)
            ->sum('amount');
        $monthlyRefunds = Refund::where('status', 'approved')
            ->whereMonth('created_at', Carbon::now()->month)
            ->sum('amount');

        $dailyPurchases = Transaction::where('type', 'purchase')
            ->whereDate('created_at', Carbon::today())
            ->sum('amount');
        $dailyRefunds = Refund::where('status', 'approved')
            ->whereDate('created_at', Carbon::today())
            ->sum('amount');

        $stats = [
            'total_users' => User::where('role', '!=', 'admin')->count(),
            'active_vouchers' => Voucher::where('status', 'active')->count(),
            'total_revenue' => $totalPurchases - $totalRefunds,
            'monthly_revenue' => $monthlyPurchases - $monthlyRefunds,
            'daily_revenue' => $dailyPurchases - $dailyRefunds,
            'low_stock_vouchers' => Voucher::whereColumn('stock', '<=', 'low_stock_threshold')->count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }

    public function manager()
    {
        return view('dashboards.manager');
    }

    public function agent()
    {
        return view('dashboards.agent');
    }

    public function support()
    {
        return view('dashboards.support');
    }

    public function student()
    {
        return view('dashboards.student');
    }

    public function reseller_agent()
    {
        return view('dashboards.reseller_agent');
    }
}
