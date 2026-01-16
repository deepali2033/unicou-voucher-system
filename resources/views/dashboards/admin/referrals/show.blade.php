@extends('layouts.master')

@section('title', 'Referral Details')

@section('navbar-title', '🔗 Referral Details')

@section('content')
<div style="background: white; padding: 20px; border-radius: 8px; max-width: 700px;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
        <h2>Referral Details</h2>
        <div style="display: flex; gap: 10px;">
            <a href="{{ route('admin.referrals.edit', $referral) }}" style="background: #667eea; color: white; padding: 10px 15px; border-radius: 5px; text-decoration: none; font-size: 14px;">Edit</a>
            <a href="{{ route('admin.referrals.index') }}" style="background: #6c757d; color: white; padding: 10px 15px; border-radius: 5px; text-decoration: none; font-size: 14px;">Back</a>
        </div>
    </div>

    <div style="display: grid; gap: 20px;">
        <div style="border-bottom: 1px solid #eee; padding-bottom: 15px;">
            <label style="color: #666; font-size: 12px; text-transform: uppercase; font-weight: 600;">Referrer</label>
            <p style="margin: 5px 0; font-size: 16px; font-weight: 600;">{{ $referral->referrer->name }}</p>
            <p style="margin: 0; color: #999; font-size: 14px;">{{ $referral->referrer->email }}</p>
        </div>

        <div style="border-bottom: 1px solid #eee; padding-bottom: 15px;">
            <label style="color: #666; font-size: 12px; text-transform: uppercase; font-weight: 600;">Referred User</label>
            <p style="margin: 5px 0; font-size: 16px; font-weight: 600;">{{ $referral->referredUser->name }}</p>
            <p style="margin: 0; color: #999; font-size: 14px;">{{ $referral->referredUser->email }}</p>
        </div>

        <div style="border-bottom: 1px solid #eee; padding-bottom: 15px;">
            <label style="color: #666; font-size: 12px; text-transform: uppercase; font-weight: 600;">Voucher</label>
            <p style="margin: 5px 0; font-size: 16px; font-weight: 600;">{{ $referral->voucher->name }}</p>
            <p style="margin: 0; color: #999; font-size: 14px;">Code: {{ $referral->voucher->code }}</p>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px; border-bottom: 1px solid #eee; padding-bottom: 15px;">
            <div>
                <label style="color: #666; font-size: 12px; text-transform: uppercase; font-weight: 600;">Reward Amount</label>
                <p style="margin: 5px 0; font-size: 16px; font-weight: 600;">{{ $referral->reward_amount ? '$' . number_format($referral->reward_amount, 2) : 'N/A' }}</p>
            </div>
            <div>
                <label style="color: #666; font-size: 12px; text-transform: uppercase; font-weight: 600;">Reward Points</label>
                <p style="margin: 5px 0; font-size: 16px; font-weight: 600;">{{ $referral->reward_points ?? 0 }} pts</p>
            </div>
        </div>

        <div style="border-bottom: 1px solid #eee; padding-bottom: 15px;">
            <label style="color: #666; font-size: 12px; text-transform: uppercase; font-weight: 600;">Status</label>
            <p style="margin: 5px 0;">
                <span style="background: {{ $referral->status === 'completed' ? '#d4edda' : ($referral->status === 'pending' ? '#fff3cd' : '#f8d7da') }}; color: {{ $referral->status === 'completed' ? '#155724' : ($referral->status === 'pending' ? '#856404' : '#721c24') }}; padding: 6px 12px; border-radius: 3px; font-size: 14px; font-weight: 600;">
                    {{ ucfirst($referral->status) }}
                </span>
            </p>
        </div>

        @if($referral->completed_at)
            <div style="border-bottom: 1px solid #eee; padding-bottom: 15px;">
                <label style="color: #666; font-size: 12px; text-transform: uppercase; font-weight: 600;">Completed At</label>
                <p style="margin: 5px 0; font-size: 16px; font-weight: 600;">{{ $referral->completed_at->format('M d, Y H:i') }}</p>
            </div>
        @endif

        @if($referral->notes)
            <div style="border-bottom: 1px solid #eee; padding-bottom: 15px;">
                <label style="color: #666; font-size: 12px; text-transform: uppercase; font-weight: 600;">Notes</label>
                <p style="margin: 5px 0; line-height: 1.6;">{{ $referral->notes }}</p>
            </div>
        @endif

        <div style="padding-bottom: 15px;">
            <label style="color: #666; font-size: 12px; text-transform: uppercase; font-weight: 600;">Created At</label>
            <p style="margin: 5px 0; color: #999;">{{ $referral->created_at->format('M d, Y H:i') }}</p>
        </div>
    </div>

    @if($referral->redemption)
        <div style="background: #f0f0f0; padding: 15px; border-radius: 5px; margin-top: 30px;">
            <h3 style="margin-bottom: 15px;">Associated Redemption</h3>
            <a href="{{ route('admin.redemptions.show', $referral->redemption) }}" style="color: #667eea; text-decoration: none;">View Redemption Details →</a>
        </div>
    @endif
</div>
@endsection
