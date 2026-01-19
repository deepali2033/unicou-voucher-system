@extends('layouts.master')

@section('title', 'Referral Campaign Details')

@section('navbar-title', '🌟 Campaign Details')

@section('content')
<div style="background: white; padding: 20px; border-radius: 8px; max-width: 800px;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
        <h2>Campaign Details</h2>
        <div style="display: flex; gap: 10px;">
            <a href="{{ route('admin.referral-campaigns.edit', $referralCampaign) }}" style="background: #667eea; color: white; padding: 10px 15px; border-radius: 5px; text-decoration: none; font-size: 14px;">Edit</a>
            <a href="{{ route('admin.referral-campaigns.index') }}" style="background: #6c757d; color: white; padding: 10px 15px; border-radius: 5px; text-decoration: none; font-size: 14px;">Back</a>
        </div>
    </div>

    <div style="display: grid; gap: 20px;">
        <div style="border-bottom: 1px solid #eee; padding-bottom: 15px;">
            <label style="color: #666; font-size: 12px; text-transform: uppercase; font-weight: 600;">Campaign Name</label>
            <p style="margin: 5px 0; font-size: 20px; font-weight: 600;">{{ $referralCampaign->campaign_name }}</p>
        </div>

        <div style="border-bottom: 1px solid #eee; padding-bottom: 15px;">
            <label style="color: #666; font-size: 12px; text-transform: uppercase; font-weight: 600;">Campaign Code</label>
            <p style="margin: 5px 0; font-size: 16px; font-weight: 600;">
                <code style="background: #f0f0f0; padding: 4px 8px; border-radius: 3px;">{{ $referralCampaign->unique_code }}</code>
            </p>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px; border-bottom: 1px solid #eee; padding-bottom: 15px;">
            <div>
                <label style="color: #666; font-size: 12px; text-transform: uppercase; font-weight: 600;">Reward Type</label>
                <p style="margin: 5px 0; font-size: 16px; font-weight: 600;">{{ ucfirst(str_replace('_', ' ', $referralCampaign->reward_type)) }}</p>
            </div>
            <div>
                <label style="color: #666; font-size: 12px; text-transform: uppercase; font-weight: 600;">Reward Value</label>
                <p style="margin: 5px 0; font-size: 16px; font-weight: 600;">
                    {{ $referralCampaign->reward_value }}
                    {{ $referralCampaign->reward_type === 'bonus_points' ? 'pts' : ($referralCampaign->reward_type === 'discount' ? '%' : '') }}
                </p>
            </div>
        </div>

        @if($referralCampaign->max_reward)
            <div style="border-bottom: 1px solid #eee; padding-bottom: 15px;">
                <label style="color: #666; font-size: 12px; text-transform: uppercase; font-weight: 600;">Maximum Reward</label>
                <p style="margin: 5px 0; font-size: 16px; font-weight: 600;">${{ number_format($referralCampaign->max_reward, 2) }}</p>
            </div>
        @endif

        <div style="border-bottom: 1px solid #eee; padding-bottom: 15px;">
            <label style="color: #666; font-size: 12px; text-transform: uppercase; font-weight: 600;">Status</label>
            <p style="margin: 5px 0;">
                <span style="background: {{ $referralCampaign->status === 'active' && !$referralCampaign->isExpired() ? '#d4edda' : '#fff3cd' }}; color: {{ $referralCampaign->status === 'active' && !$referralCampaign->isExpired() ? '#155724' : '#856404' }}; padding: 6px 12px; border-radius: 3px; font-size: 14px; font-weight: 600;">
                    {{ ucfirst($referralCampaign->status) }}
                    @if($referralCampaign->isExpired())
                        <small>(Expired)</small>
                    @endif
                </span>
            </p>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px; border-bottom: 1px solid #eee; padding-bottom: 15px;">
            <div>
                <label style="color: #666; font-size: 12px; text-transform: uppercase; font-weight: 600;">Start Date</label>
                <p style="margin: 5px 0; font-size: 16px;">{{ $referralCampaign->start_date->format('M d, Y') }}</p>
            </div>
            <div>
                <label style="color: #666; font-size: 12px; text-transform: uppercase; font-weight: 600;">End Date</label>
                <p style="margin: 5px 0; font-size: 16px;">{{ $referralCampaign->end_date->format('M d, Y') }}</p>
            </div>
        </div>

        @if(!empty($referralCampaign->applicable_user_types))
            <div style="border-bottom: 1px solid #eee; padding-bottom: 15px;">
                <label style="color: #666; font-size: 12px; text-transform: uppercase; font-weight: 600;">Applicable User Types</label>
                <div style="margin: 10px 0;">
                    @foreach($referralCampaign->applicable_user_types as $type)
                        <span style="background: #e7f3ff; color: #0056b3; padding: 4px 8px; border-radius: 3px; font-size: 12px; margin-right: 5px; display: inline-block;">
                            {{ ucfirst($type) }}
                        </span>
                    @endforeach
                </div>
            </div>
        @endif

        <div style="border-bottom: 1px solid #eee; padding-bottom: 15px;">
            <label style="color: #666; font-size: 12px; text-transform: uppercase; font-weight: 600;">Created By</label>
            <p style="margin: 5px 0; color: #666;">{{ $referralCampaign->createdBy->name ?? 'System' }}</p>
            <p style="margin: 0; color: #999; font-size: 12px;">{{ $referralCampaign->created_at->format('M d, Y H:i') }}</p>
        </div>

        <div style="padding-bottom: 15px;">
            <label style="color: #666; font-size: 12px; text-transform: uppercase; font-weight: 600;">Last Modified By</label>
            <p style="margin: 5px 0; color: #666;">{{ $referralCampaign->modifiedBy->name ?? 'System' }}</p>
            <p style="margin: 0; color: #999; font-size: 12px;">{{ $referralCampaign->updated_at->format('M d, Y H:i') }}</p>
        </div>
    </div>

    @if($referralCampaign->referrals->count() > 0)
        <div style="background: #f0f0f0; padding: 15px; border-radius: 5px; margin-top: 30px;">
            <h3 style="margin-bottom: 15px;">Associated Referrals</h3>
            <p style="margin-bottom: 10px;">Total Referrals: <strong>{{ $referralCampaign->referrals->count() }}</strong></p>
            <p style="color: #666; font-size: 14px;">This campaign has {{ $referralCampaign->referrals->where('status', 'completed')->count() }} completed referrals and {{ $referralCampaign->referrals->where('status', 'pending')->count() }} pending referrals.</p>
        </div>
    @endif
</div>
@endsection
