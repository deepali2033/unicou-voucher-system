@extends('layouts.master')

@section('title', 'Coupons')

@section('navbar-title', '🎟️ Manage Coupons')

@section('content')
<div style="background: white; padding: 20px; border-radius: 8px;">
    <div style="display: flex; justify-content: space-between; margin-bottom: 20px;">
        <h2>Coupons</h2>
        <a href="{{ route('admin.coupons.create') }}" style="background: #667eea; color: white; padding: 10px 20px; border-radius: 5px; text-decoration: none;">+ Create Coupon</a>
    </div>

    @if(session('success'))
        <div style="background: #d4edda; color: #155724; padding: 12px; border-radius: 5px; margin-bottom: 20px;">
            {{ session('success') }}
        </div>
    @endif

    <div style="margin-bottom: 20px;">
        <form method="GET" style="display: grid; grid-template-columns: 1fr 1fr 1fr 1fr; gap: 10px;">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search code or campaign..." style="padding: 8px; border: 1px solid #ddd; border-radius: 5px;">
            <select name="status" style="padding: 8px; border: 1px solid #ddd; border-radius: 5px;">
                <option value="">All Status</option>
                <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Active</option>
                <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Inactive</option>
            </select>
            <button type="submit" style="padding: 8px; background: #667eea; color: white; border: none; border-radius: 5px; cursor: pointer;">Filter</button>
            <a href="{{ route('admin.coupons.index') }}" style="padding: 8px; background: #6c757d; color: white; text-decoration: none; border-radius: 5px; text-align: center;">Reset</a>
        </form>
    </div>

    <table style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr style="background: #f8f9fa;">
                <th style="padding: 12px; text-align: left; border-bottom: 1px solid #ddd;">Code</th>
                <th style="padding: 12px; text-align: left; border-bottom: 1px solid #ddd;">Campaign</th>
                <th style="padding: 12px; text-align: left; border-bottom: 1px solid #ddd;">Voucher</th>
                <th style="padding: 12px; text-align: left; border-bottom: 1px solid #ddd;">Quantity</th>
                <th style="padding: 12px; text-align: left; border-bottom: 1px solid #ddd;">Status</th>
                <th style="padding: 12px; text-align: left; border-bottom: 1px solid #ddd;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($coupons as $coupon)
                <tr style="border-bottom: 1px solid #eee;">
                    <td style="padding: 12px;">{{ $coupon->code }}</td>
                    <td style="padding: 12px;">{{ $coupon->campaign_name ?? '-' }}</td>
                    <td style="padding: 12px;">{{ $coupon->voucher->code }}</td>
                    <td style="padding: 12px;">{{ $coupon->redeemed_count }}/{{ $coupon->quantity }}</td>
                    <td style="padding: 12px;">
                        <span style="background: {{ $coupon->status === 'active' ? '#d4edda' : '#f8d7da' }}; color: {{ $coupon->status === 'active' ? '#155724' : '#721c24' }}; padding: 4px 8px; border-radius: 3px; font-size: 12px;">
                            {{ ucfirst($coupon->status) }}
                        </span>
                    </td>
                    <td style="padding: 12px;">
                        <a href="{{ route('admin.coupons.show', $coupon) }}" style="color: #667eea; text-decoration: none; margin-right: 10px;">View</a>
                        <a href="{{ route('admin.coupons.edit', $coupon) }}" style="color: #667eea; text-decoration: none; margin-right: 10px;">Edit</a>
                        <form action="{{ route('admin.coupons.destroy', $coupon) }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure?');">
                            @csrf @method('DELETE')
                            <button type="submit" style="color: #dc3545; border: none; background: none; cursor: pointer; text-decoration: underline;">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="padding: 20px; text-align: center; color: #999;">No coupons found</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div style="margin-top: 20px;">
        {{ $coupons->links() }}
    </div>
</div>
@endsection
