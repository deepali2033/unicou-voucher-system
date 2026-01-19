@extends('layouts.master')

@section('title', 'Revenue Overview')

@section('navbar-title', '📊 Revenue Overview')

@section('content')
<div style="display: grid; gap: 30px;">
    <!-- Summary Cards -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px;">
        <div style="background: white; padding: 20px; border-radius: 8px; border-left: 4px solid #667eea; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
            <h4 style="color: #666; margin-bottom: 10px; font-size: 14px;">Total Sales</h4>
            <h2 style="color: #333;">${{ number_format($totalSales, 2) }}</h2>
        </div>
        <div style="background: white; padding: 20px; border-radius: 8px; border-left: 4px solid #28a745; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
            <h4 style="color: #666; margin-bottom: 10px; font-size: 14px;">Credit Added</h4>
            <h2 style="color: #333;">${{ number_format($totalCreditAdd, 2) }}</h2>
        </div>
        <div style="background: white; padding: 20px; border-radius: 8px; border-left: 4px solid #dc3545; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
            <h4 style="color: #666; margin-bottom: 10px; font-size: 14px;">Total Refunds</h4>
            <h2 style="color: #333;">${{ number_format($totalRefunds, 2) }}</h2>
        </div>
        <div style="background: white; padding: 20px; border-radius: 8px; border-left: 4px solid #ffc107; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
            <h4 style="color: #666; margin-bottom: 10px; font-size: 14px;">Net Revenue</h4>
            <h2 style="color: #333;">${{ number_format($netRevenue, 2) }}</h2>
        </div>
    </div>

    <!-- Recent Transactions Table -->
    <div style="background: white; padding: 25px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
        <h3 style="margin-bottom: 20px; color: #2c3e50;">Recent Revenue Transactions</h3>
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="text-align: left; background: #f8f9fa;">
                    <th style="padding: 12px; border-bottom: 1px solid #eee;">Date</th>
                    <th style="padding: 12px; border-bottom: 1px solid #eee;">User</th>
                    <th style="padding: 12px; border-bottom: 1px solid #eee;">Type</th>
                    <th style="padding: 12px; border-bottom: 1px solid #eee;">Amount</th>
                    <th style="padding: 12px; border-bottom: 1px solid #eee;">Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentTransactions as $transaction)
                <tr style="border-bottom: 1px solid #fcfcfc;">
                    <td style="padding: 12px;">{{ $transaction->created_at->format('Y-m-d H:i') }}</td>
                    <td style="padding: 12px;">{{ $transaction->user->name }}</td>
                    <td style="padding: 12px;">
                        <span style="text-transform: capitalize; padding: 2px 6px; border-radius: 4px; font-size: 12px; 
                            background: {{ $transaction->type == 'purchase' ? '#e7f3ff' : ($transaction->type == 'credit_add' ? '#f0fff4' : '#fff5f5') }};
                            color: {{ $transaction->type == 'purchase' ? '#0056b3' : ($transaction->type == 'credit_add' ? '#2f855a' : '#c53030') }};">
                            {{ str_replace('_', ' ', $transaction->type) }}
                        </span>
                    </td>
                    <td style="padding: 12px; font-weight: 600;">${{ number_format($transaction->amount, 2) }}</td>
                    <td style="padding: 12px;">
                        <span style="padding: 2px 6px; border-radius: 4px; font-size: 12px; background: #f1f3f5; color: #495057;">
                            {{ ucfirst($transaction->status) }}
                        </span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="padding: 20px; text-align: center; color: #999;">No recent transactions found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <div style="margin-top: 20px; text-align: right;">
            <a href="{{ route('admin.revenue.sales') }}" style="color: #667eea; text-decoration: none; font-weight: 600;">View All Sales →</a>
        </div>
    </div>
</div>
@endsection
