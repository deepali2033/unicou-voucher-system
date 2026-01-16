@extends('layouts.master')

@section('title', 'Bonuses')

@section('navbar-title', '⭐ Manage Bonuses')

@section('content')
<div style="background: white; padding: 20px; border-radius: 8px;">
    <div style="display: flex; justify-content: space-between; margin-bottom: 20px;">
        <h2>Bonuses & Rewards</h2>
        <a href="{{ route('admin.bonuses.create') }}" style="background: #667eea; color: white; padding: 10px 20px; border-radius: 5px; text-decoration: none;">+ Assign Bonus</a>
    </div>

    @if(session('success'))
        <div style="background: #d4edda; color: #155724; padding: 12px; border-radius: 5px; margin-bottom: 20px;">
            {{ session('success') }}
        </div>
    @endif

    <div style="margin-bottom: 20px;">
        <form method="GET" style="display: grid; grid-template-columns: 1fr 1fr 1fr 1fr; gap: 10px;">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search user..." style="padding: 8px; border: 1px solid #ddd; border-radius: 5px;">
            <select name="status" style="padding: 8px; border: 1px solid #ddd; border-radius: 5px;">
                <option value="">All Status</option>
                <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Active</option>
                <option value="expired" {{ request('status') === 'expired' ? 'selected' : '' }}>Expired</option>
                <option value="redeemed" {{ request('status') === 'redeemed' ? 'selected' : '' }}>Redeemed</option>
            </select>
            <button type="submit" style="padding: 8px; background: #667eea; color: white; border: none; border-radius: 5px; cursor: pointer;">Filter</button>
            <a href="{{ route('admin.bonuses.index') }}" style="padding: 8px; background: #6c757d; color: white; text-decoration: none; border-radius: 5px; text-align: center;">Reset</a>
        </form>
    </div>

    <table style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr style="background: #f8f9fa;">
                <th style="padding: 12px; text-align: left; border-bottom: 1px solid #ddd;">User</th>
                <th style="padding: 12px; text-align: left; border-bottom: 1px solid #ddd;">Points</th>
                <th style="padding: 12px; text-align: left; border-bottom: 1px solid #ddd;">Amount</th>
                <th style="padding: 12px; text-align: left; border-bottom: 1px solid #ddd;">Reason</th>
                <th style="padding: 12px; text-align: left; border-bottom: 1px solid #ddd;">Status</th>
                <th style="padding: 12px; text-align: left; border-bottom: 1px solid #ddd;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($bonuses as $bonus)
                <tr style="border-bottom: 1px solid #eee;">
                    <td style="padding: 12px;">{{ $bonus->user->name }}</td>
                    <td style="padding: 12px;">{{ $bonus->bonus_points }}</td>
                    <td style="padding: 12px;">{{ $bonus->bonus_amount ? '$' . number_format($bonus->bonus_amount, 2) : '-' }}</td>
                    <td style="padding: 12px;">{{ $bonus->reason }}</td>
                    <td style="padding: 12px;">
                        <span style="background: {{ in_array($bonus->status, ['active']) ? '#d4edda' : '#fff3cd' }}; color: {{ in_array($bonus->status, ['active']) ? '#155724' : '#856404' }}; padding: 4px 8px; border-radius: 3px; font-size: 12px;">
                            {{ ucfirst($bonus->status) }}
                        </span>
                    </td>
                    <td style="padding: 12px;">
                        <a href="{{ route('admin.bonuses.edit', $bonus) }}" style="color: #667eea; text-decoration: none; margin-right: 10px;">Edit</a>
                        <form action="{{ route('admin.bonuses.destroy', $bonus) }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure?');">
                            @csrf @method('DELETE')
                            <button type="submit" style="color: #dc3545; border: none; background: none; cursor: pointer; text-decoration: underline;">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="padding: 20px; text-align: center; color: #999;">No bonuses found</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div style="margin-top: 20px;">
        {{ $bonuses->links() }}
    </div>
</div>
@endsection
