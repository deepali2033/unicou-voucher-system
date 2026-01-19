@extends('layouts.master')

@section('title', 'Credit Transactions')

@section('navbar-title', '💳 Credit Transactions')

@section('content')
<div style="background: white; padding: 25px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h3 style="color: #2c3e50; margin: 0;">Credit Addition History</h3>
        <a href="{{ route('admin.revenue.balance') }}" style="background: #667eea; color: white; text-decoration: none; padding: 8px 15px; border-radius: 5px; font-size: 14px;">+ Add New Credit</a>
    </div>

    <table style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr style="text-align: left; background: #f8f9fa;">
                <th style="padding: 12px; border-bottom: 1px solid #eee;">Date</th>
                <th style="padding: 12px; border-bottom: 1px solid #eee;">User</th>
                <th style="padding: 12px; border-bottom: 1px solid #eee;">Amount</th>
                <th style="padding: 12px; border-bottom: 1px solid #eee;">Description</th>
                <th style="padding: 12px; border-bottom: 1px solid #eee;">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($credits as $credit)
            <tr style="border-bottom: 1px solid #fcfcfc;">
                <td style="padding: 12px;">{{ $credit->created_at->format('Y-m-d H:i') }}</td>
                <td style="padding: 12px;">
                    <div>{{ $credit->user->name }}</div>
                    <div style="font-size: 11px; color: #999;">{{ $credit->user->email }}</div>
                </td>
                <td style="padding: 12px; font-weight: 600; color: #28a745;">+${{ number_format($credit->amount, 2) }}</td>
                <td style="padding: 12px; color: #666; font-size: 13px;">{{ $credit->description ?? 'Manual Credit Addition' }}</td>
                <td style="padding: 12px;">
                    <span style="padding: 2px 8px; border-radius: 12px; font-size: 12px; background: #f0fff4; color: #2f855a;">
                        {{ ucfirst($credit->status) }}
                    </span>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" style="padding: 20px; text-align: center; color: #999;">No credit transactions found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div style="margin-top: 20px;">
        {{ $credits->links() }}
    </div>
</div>
@endsection
