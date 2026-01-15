<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Transaction;
use App\Models\Refund;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RevenueController extends Controller
{
    public function overview()
    {
        $totalSales = Transaction::where('type', 'purchase')->where('status', 'completed')->sum('amount');
        $totalRefunds = Refund::where('status', 'approved')->sum('amount');
        $totalCreditAdd = Transaction::where('type', 'credit_add')->sum('amount');
        
        $netRevenue = $totalSales - $totalRefunds;

        $recentTransactions = Transaction::with('user')->latest()->limit(10)->get();

        return view('admin.revenue.overview', compact(
            'totalSales',
            'totalRefunds',
            'totalCreditAdd',
            'netRevenue',
            'recentTransactions'
        ));
    }

    public function balance()
    {
        $totalUserCredit = User::sum('credit');
        $balancesByRole = User::select('role', DB::raw('SUM(credit) as total_credit'))
            ->groupBy('role')
            ->get();
            
        $totalSales = Transaction::where('type', 'purchase')->where('status', 'completed')->sum('amount');
        $totalRefunds = Refund::where('status', 'approved')->sum('amount');
        
        $netBalance = $totalSales - $totalRefunds;

        $topCreditUsers = User::orderByDesc('credit')->limit(5)->get();

        return view('admin.revenue.balance', compact(
            'totalUserCredit',
            'balancesByRole',
            'netBalance',
            'topCreditUsers'
        ));
    }

    public function sales()
    {
        $sales = Transaction::where('type', 'purchase')
            ->with('user')
            ->latest()
            ->paginate(15);

        return view('admin.revenue.sales', compact('sales'));
    }

    public function credit()
    {
        $credits = Transaction::where('type', 'credit_add')
            ->with('user')
            ->latest()
            ->paginate(15);

        return view('admin.revenue.credit', compact('credits'));
    }

    public function refunds()
    {
        $refunds = Refund::with(['user', 'transaction'])
            ->latest()
            ->paginate(15);

        return view('admin.revenue.refunds', compact('refunds'));
    }

    public function financial()
    {
        // Simple monthly aggregation
        $monthlyRevenue = Transaction::where('type', 'purchase')
            ->where('status', 'completed')
            ->select(
                DB::raw('SUM(amount) as total'),
                DB::raw("DATE_FORMAT(created_at, '%Y-%m') as month")
            )
            ->groupBy('month')
            ->orderBy('month', 'desc')
            ->get();

        return view('admin.revenue.financial', compact('monthlyRevenue'));
    }
}
