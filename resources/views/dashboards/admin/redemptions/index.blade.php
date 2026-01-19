@extends('layouts.master')

@section('title', 'Redemptions')

@section('navbar-title', '💰 Voucher Redemptions')

@section('content')
<div style="background: white; padding: 20px; border-radius: 8px;">
    <h2 style="margin-bottom: 20px;">Redemption History</h2>

    <div style="margin-bottom: 20px;">
        <form method="GET" style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 10px;">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search user or voucher..." style="padding: 8px; border: 1px solid #ddd; border-radius: 5px;">
            <input type="date" name="date_from" value="{{ request('date_from') }}" style="padding: 8px; border: 1px solid #ddd; border-radius: 5px;">
            <input type="date" name="date_to" value="{{ request('date_to') }}" style="padding: 8px; border: 1px solid #ddd; border-radius: 5px;">
            <button type="submit" style="padding: 8px; background: #667eea; color: white; border: none; border-radius: 5px; cursor: pointer;">Filter</button>
        </form>
    </div>

    <table style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr style="background: #f8f9fa;">
                <th style="padding: 12px; text-align: left; border-bottom: 1px solid #ddd;">User</th>
                <th style="padding: 12px; text-align: left; border-bottom: 1px solid #ddd;">Voucher</th>
                <th style="padding: 12px; text-align: left; border-bottom: 1px solid #ddd;">Type</th>
                <th style="padding: 12px; text-align: left; border-bottom: 1px solid #ddd;">Value</th>
                <th style="padding: 12px; text-align: left; border-bottom: 1px solid #ddd;">Date</th>
                <th style="padding: 12px; text-align: left; border-bottom: 1px solid #ddd;">Status</th>
                <th style="padding: 12px; text-align: left; border-bottom: 1px solid #ddd;">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($redemptions as $redemption)
                <tr style="border-bottom: 1px solid #eee;">
                    <td style="padding: 12px;">{{ $redemption->user->name }}</td>
                    <td style="padding: 12px;">{{ $redemption->voucher->code }}</td>
                    <td style="padding: 12px;">{{ ucfirst($redemption->user_type) }}</td>
                    <td style="padding: 12px;">{{ number_format($redemption->value_redeemed, 2) }}</td>
                    <td style="padding: 12px;">{{ $redemption->redeemed_at->format('M d, Y H:i') }}</td>
                    <td style="padding: 12px;">
                        <span style="background: #d4edda; color: #155724; padding: 4px 8px; border-radius: 3px; font-size: 12px;">
                            {{ ucfirst($redemption->status) }}
                        </span>
                    </td>
                    <td style="padding: 12px;">
                        <a href="{{ route('admin.redemptions.show', $redemption) }}" style="color: #667eea; text-decoration: none;">View</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" style="padding: 20px; text-align: center; color: #999;">No redemptions found</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div style="margin-top: 20px;">
        {{ $redemptions->links() }}
    </div>
</div>
@endsection
