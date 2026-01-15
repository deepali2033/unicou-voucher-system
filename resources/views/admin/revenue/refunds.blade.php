@extends('layouts.master')

@section('title', 'Refund Transactions')

@section('navbar-title', '💸 Refund Transactions')

@section('content')
<div style="background: white; padding: 25px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h3 style="color: #2c3e50; margin: 0;">Refund History</h3>
        <a href="{{ route('admin.refunds.index') }}" style="background: #f8f9fa; color: #333; text-decoration: none; padding: 8px 15px; border-radius: 5px; font-size: 14px; border: 1px solid #ddd;">Manage Requests</a>
    </div>

    <table style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr style="text-align: left; background: #f8f9fa;">
                <th style="padding: 12px; border-bottom: 1px solid #eee;">Date</th>
                <th style="padding: 12px; border-bottom: 1px solid #eee;">User</th>
                <th style="padding: 12px; border-bottom: 1px solid #eee;">Amount</th>
                <th style="padding: 12px; border-bottom: 1px solid #eee;">Reason</th>
                <th style="padding: 12px; border-bottom: 1px solid #eee;">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($refunds as $refund)
            <tr style="border-bottom: 1px solid #fcfcfc;">
                <td style="padding: 12px;">{{ $refund->created_at->format('Y-m-d H:i') }}</td>
                <td style="padding: 12px;">
                    <div>{{ $refund->user->name }}</div>
                    <div style="font-size: 11px; color: #999;">{{ $refund->user->email }}</div>
                </td>
                <td style="padding: 12px; font-weight: 600; color: #dc3545;">-${{ number_format($refund->amount, 2) }}</td>
                <td style="padding: 12px; color: #666; font-size: 13px;">{{ Str::limit($refund->reason, 40) }}</td>
                <td style="padding: 12px;">
                    <span style="padding: 2px 8px; border-radius: 12px; font-size: 12px; 
                        background: {{ $refund->status == 'approved' ? '#f0fff4' : ($refund->status == 'pending' ? '#fffaf0' : '#fff5f5') }};
                        color: {{ $refund->status == 'approved' ? '#2f855a' : ($refund->status == 'pending' ? '#c05621' : '#c53030') }};">
                        {{ ucfirst($refund->status) }}
                    </span>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" style="padding: 20px; text-align: center; color: #999;">No refund transactions found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div style="margin-top: 20px;">
        {{ $refunds->links() }}
    </div>
</div>
@endsection
