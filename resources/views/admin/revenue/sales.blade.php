@extends('layouts.master')

@section('title', 'Sales Transactions')

@section('navbar-title', '🛍️ Sales Transactions')

@section('content')
<div style="background: white; padding: 25px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h3 style="color: #2c3e50; margin: 0;">Sales History</h3>
    </div>

    <table style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr style="text-align: left; background: #f8f9fa;">
                <th style="padding: 12px; border-bottom: 1px solid #eee;">Date</th>
                <th style="padding: 12px; border-bottom: 1px solid #eee;">User</th>
                <th style="padding: 12px; border-bottom: 1px solid #eee;">Voucher</th>
                <th style="padding: 12px; border-bottom: 1px solid #eee;">Amount</th>
                <th style="padding: 12px; border-bottom: 1px solid #eee;">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($sales as $sale)
            <tr style="border-bottom: 1px solid #fcfcfc;">
                <td style="padding: 12px;">{{ $sale->created_at->format('Y-m-d H:i') }}</td>
                <td style="padding: 12px;">
                    <div>{{ $sale->user->name }}</div>
                    <div style="font-size: 11px; color: #999;">{{ $sale->user->email }}</div>
                </td>
                <td style="padding: 12px;">
                    @if($sale->voucher)
                        {{ $sale->voucher->code }}
                    @else
                        <span style="color: #999;">N/A</span>
                    @endif
                </td>
                <td style="padding: 12px; font-weight: 600;">${{ number_format($sale->amount, 2) }}</td>
                <td style="padding: 12px;">
                    <span style="padding: 2px 8px; border-radius: 12px; font-size: 12px; 
                        background: {{ $sale->status == 'completed' ? '#f0fff4' : '#fff5f5' }};
                        color: {{ $sale->status == 'completed' ? '#2f855a' : '#c53030' }};">
                        {{ ucfirst($sale->status) }}
                    </span>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" style="padding: 20px; text-align: center; color: #999;">No sales transactions found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div style="margin-top: 20px;">
        {{ $sales->links() }}
    </div>
</div>
@endsection
