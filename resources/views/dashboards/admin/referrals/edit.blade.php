@extends('layouts.master')

@section('title', 'Edit Referral')

@section('navbar-title', '🔗 Edit Referral')

@section('content')
<div style="background: white; padding: 20px; border-radius: 8px; max-width: 700px;">
    <h2 style="margin-bottom: 20px;">Edit Referral</h2>

    @if ($errors->any())
        <div style="background: #fee; border: 1px solid #fcc; color: #c33; padding: 15px; border-radius: 5px; margin-bottom: 20px;">
            <strong>Validation Errors:</strong>
            <ul style="margin: 10px 0 0 20px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.referrals.update', $referral) }}" method="POST">
        @csrf @method('PUT')

        <div style="margin-bottom: 20px;">
            <label for="referrer_id" style="display: block; margin-bottom: 8px; font-weight: 600;">Referrer (Inviter) *</label>
            <select id="referrer_id" name="referrer_id" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px;">
                <option value="">-- Select Referrer --</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ $referral->referrer_id == $user->id ? 'selected' : '' }}>
                        {{ $user->name }} ({{ $user->email }})
                    </option>
                @endforeach
            </select>
            @error('referrer_id')
                <div style="color: #c33; font-size: 12px; margin-top: 5px;">{{ $message }}</div>
            @enderror
        </div>

        <div style="margin-bottom: 20px;">
            <label for="referred_user_id" style="display: block; margin-bottom: 8px; font-weight: 600;">Referred User *</label>
            <select id="referred_user_id" name="referred_user_id" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px;">
                <option value="">-- Select User --</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ $referral->referred_user_id == $user->id ? 'selected' : '' }}>
                        {{ $user->name }} ({{ $user->email }})
                    </option>
                @endforeach
            </select>
            @error('referred_user_id')
                <div style="color: #c33; font-size: 12px; margin-top: 5px;">{{ $message }}</div>
            @enderror
        </div>

        <div style="margin-bottom: 20px;">
            <label for="voucher_id" style="display: block; margin-bottom: 8px; font-weight: 600;">Voucher *</label>
            <select id="voucher_id" name="voucher_id" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px;">
                <option value="">-- Select Voucher --</option>
                @foreach($vouchers as $voucher)
                    <option value="{{ $voucher->id }}" {{ $referral->voucher_id == $voucher->id ? 'selected' : '' }}>
                        {{ $voucher->name }} ({{ $voucher->code }})
                    </option>
                @endforeach
            </select>
            @error('voucher_id')
                <div style="color: #c33; font-size: 12px; margin-top: 5px;">{{ $message }}</div>
            @enderror
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-bottom: 20px;">
            <div>
                <label for="reward_amount" style="display: block; margin-bottom: 8px; font-weight: 600;">Reward Amount (USD)</label>
                <input type="number" id="reward_amount" name="reward_amount" value="{{ $referral->reward_amount }}" step="0.01" min="0" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px;">
                @error('reward_amount')
                    <div style="color: #c33; font-size: 12px; margin-top: 5px;">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label for="reward_points" style="display: block; margin-bottom: 8px; font-weight: 600;">Reward Points</label>
                <input type="number" id="reward_points" name="reward_points" value="{{ $referral->reward_points }}" step="1" min="0" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px;">
                @error('reward_points')
                    <div style="color: #c33; font-size: 12px; margin-top: 5px;">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div style="margin-bottom: 20px;">
            <label for="status" style="display: block; margin-bottom: 8px; font-weight: 600;">Status *</label>
            <select id="status" name="status" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px;">
                <option value="pending" {{ $referral->status === 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="completed" {{ $referral->status === 'completed' ? 'selected' : '' }}>Completed</option>
                <option value="cancelled" {{ $referral->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
            </select>
            @error('status')
                <div style="color: #c33; font-size: 12px; margin-top: 5px;">{{ $message }}</div>
            @enderror
        </div>

        <div style="margin-bottom: 20px;">
            <label for="completed_at" style="display: block; margin-bottom: 8px; font-weight: 600;">Completed At</label>
            <input type="datetime-local" id="completed_at" name="completed_at" value="{{ $referral->completed_at ? $referral->completed_at->format('Y-m-d\TH:i') : '' }}" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px;">
            @error('completed_at')
                <div style="color: #c33; font-size: 12px; margin-top: 5px;">{{ $message }}</div>
            @enderror
        </div>

        <div style="margin-bottom: 20px;">
            <label for="notes" style="display: block; margin-bottom: 8px; font-weight: 600;">Notes</label>
            <textarea id="notes" name="notes" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; min-height: 80px;">{{ $referral->notes }}</textarea>
            @error('notes')
                <div style="color: #c33; font-size: 12px; margin-top: 5px;">{{ $message }}</div>
            @enderror
        </div>

        <div style="display: flex; gap: 10px;">
            <button type="submit" style="background: #667eea; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;">Update Referral</button>
            <a href="{{ route('admin.referrals.index') }}" style="background: #6c757d; color: white; padding: 10px 20px; border-radius: 5px; text-decoration: none; display: flex; align-items: center;">Cancel</a>
        </div>
    </form>
</div>
@endsection
