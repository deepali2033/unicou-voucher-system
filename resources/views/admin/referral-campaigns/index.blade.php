@extends('layouts.master')

@section('title', 'Referral Campaigns')

@section('navbar-title', '🌟 Referral Campaigns')

@section('content')
<div style="background: white; padding: 20px; border-radius: 8px;">
    <div style="display: flex; justify-content: space-between; margin-bottom: 20px;">
        <h2>Referral Campaigns</h2>
        <a href="{{ route('admin.referral-campaigns.create') }}" style="background: #28a745; color: white; padding: 10px 20px; border-radius: 5px; text-decoration: none;">+ Create Campaign</a>
    </div>

    @if(session('success'))
        <div style="background: #d4edda; color: #155724; padding: 12px; border-radius: 5px; margin-bottom: 20px;">
            {{ session('success') }}
        </div>
    @endif

    <div style="margin-bottom: 20px;">
        <form method="GET" style="display: grid; grid-template-columns: 1fr 1fr 1fr 1fr; gap: 10px;">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search campaign name or code..." style="padding: 8px; border: 1px solid #ddd; border-radius: 5px;">
            <select name="status" style="padding: 8px; border: 1px solid #ddd; border-radius: 5px;">
                <option value="">All Status</option>
                <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Active</option>
                <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Inactive</option>
                <option value="frozen" {{ request('status') === 'frozen' ? 'selected' : '' }}>Frozen</option>
            </select>
            <select name="reward_type" style="padding: 8px; border: 1px solid #ddd; border-radius: 5px;">
                <option value="">All Reward Types</option>
                <option value="voucher" {{ request('reward_type') === 'voucher' ? 'selected' : '' }}>Voucher</option>
                <option value="bonus_points" {{ request('reward_type') === 'bonus_points' ? 'selected' : '' }}>Bonus Points</option>
                <option value="discount" {{ request('reward_type') === 'discount' ? 'selected' : '' }}>Discount</option>
            </select>
            <div style="display: flex; gap: 5px;">
                <button type="submit" style="flex: 1; padding: 8px; background: #667eea; color: white; border: none; border-radius: 5px; cursor: pointer;">Filter</button>
                <a href="{{ route('admin.referral-campaigns.index') }}" style="flex: 1; padding: 8px; background: #6c757d; color: white; text-decoration: none; border-radius: 5px; text-align: center; display: flex; align-items: center; justify-content: center;">Reset</a>
            </div>
        </form>
    </div>

    <table style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr style="background: #f8f9fa;">
                <th style="padding: 12px; text-align: left; border-bottom: 1px solid #ddd;">Campaign Name</th>
                <th style="padding: 12px; text-align: left; border-bottom: 1px solid #ddd;">Code</th>
                <th style="padding: 12px; text-align: left; border-bottom: 1px solid #ddd;">Reward Type</th>
                <th style="padding: 12px; text-align: left; border-bottom: 1px solid #ddd;">Reward Value</th>
                <th style="padding: 12px; text-align: left; border-bottom: 1px solid #ddd;">Status</th>
                <th style="padding: 12px; text-align: left; border-bottom: 1px solid #ddd;">Date Range</th>
                <th style="padding: 12px; text-align: left; border-bottom: 1px solid #ddd;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($campaigns as $campaign)
                <tr style="border-bottom: 1px solid #eee;">
                    <td style="padding: 12px; font-weight: 600;">{{ $campaign->campaign_name }}</td>
                    <td style="padding: 12px;">
                        <code style="background: #f0f0f0; padding: 4px 8px; border-radius: 3px; font-size: 12px;">{{ $campaign->unique_code }}</code>
                    </td>
                    <td style="padding: 12px;">
                        <span style="background: #e7f3ff; color: #0056b3; padding: 4px 8px; border-radius: 3px; font-size: 12px;">
                            {{ ucfirst(str_replace('_', ' ', $campaign->reward_type)) }}
                        </span>
                    </td>
                    <td style="padding: 12px;">
                        {{ $campaign->reward_value }}
                        {{ $campaign->reward_type === 'bonus_points' ? 'pts' : ($campaign->reward_type === 'discount' ? '%' : '') }}
                    </td>
                    <td style="padding: 12px;">
                        <span style="background: {{ $campaign->status === 'active' && !$campaign->isExpired() ? '#d4edda' : '#fff3cd' }}; color: {{ $campaign->status === 'active' && !$campaign->isExpired() ? '#155724' : '#856404' }}; padding: 4px 8px; border-radius: 3px; font-size: 12px;">
                            {{ ucfirst($campaign->status) }}
                            @if($campaign->isExpired())
                                <small>(Expired)</small>
                            @endif
                        </span>
                    </td>
                    <td style="padding: 12px; font-size: 13px; color: #666;">
                        {{ $campaign->start_date->format('M d') }} - {{ $campaign->end_date->format('M d, Y') }}
                    </td>
                    <td style="padding: 12px;">
                        <a href="{{ route('admin.referral-campaigns.show', $campaign) }}" style="color: #667eea; text-decoration: none; font-size: 13px; margin-right: 10px;">View</a>
                        <a href="{{ route('admin.referral-campaigns.edit', $campaign) }}" style="color: #667eea; text-decoration: none; font-size: 13px; margin-right: 10px;">Edit</a>
                        @if($campaign->status !== 'frozen')
                            <form action="{{ route('admin.referral-campaigns.freeze', $campaign) }}" method="POST" style="display: inline;" onsubmit="return confirm('Freeze this campaign?');">
                                @csrf
                                <button type="submit" style="color: #ffc107; border: none; background: none; cursor: pointer; text-decoration: underline; font-size: 13px; margin-right: 10px;">Freeze</button>
                            </form>
                        @else
                            <form action="{{ route('admin.referral-campaigns.unfreeze', $campaign) }}" method="POST" style="display: inline;" onsubmit="return confirm('Unfreeze this campaign?');">
                                @csrf
                                <button type="submit" style="color: #28a745; border: none; background: none; cursor: pointer; text-decoration: underline; font-size: 13px; margin-right: 10px;">Unfreeze</button>
                            </form>
                        @endif
                        <form action="{{ route('admin.referral-campaigns.destroy', $campaign) }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure?');">
                            @csrf @method('DELETE')
                            <button type="submit" style="color: #dc3545; border: none; background: none; cursor: pointer; text-decoration: underline; font-size: 13px;">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" style="padding: 20px; text-align: center; color: #999;">No campaigns found</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div style="margin-top: 20px;">
        {{ $campaigns->links() }}
    </div>
</div>
@endsection
