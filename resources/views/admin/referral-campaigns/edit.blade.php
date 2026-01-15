@extends('layouts.master')

@section('title', 'Edit Referral Campaign')

@section('navbar-title', '🌟 Edit Referral Campaign')

@section('content')
<div style="background: white; padding: 20px; border-radius: 8px; max-width: 800px;">
    <h2 style="margin-bottom: 20px;">Edit Campaign</h2>

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

    <form action="{{ route('admin.referral-campaigns.update', $referralCampaign) }}" method="POST">
        @csrf @method('PUT')

        <div class="form-group">
            <label for="campaign_name">Campaign Name *</label>
            <input type="text" id="campaign_name" name="campaign_name" value="{{ $referralCampaign->campaign_name }}" required placeholder="e.g., Invite & Earn January">
            @error('campaign_name')
                <div style="color: #c33; font-size: 12px; margin-top: 5px;">{{ $message }}</div>
            @enderror
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
            <div class="form-group">
                <label for="reward_type">Reward Type *</label>
                <select id="reward_type" name="reward_type" required onchange="updateRewardLabel()">
                    <option value="">-- Select Type --</option>
                    <option value="voucher" {{ $referralCampaign->reward_type === 'voucher' ? 'selected' : '' }}>Voucher</option>
                    <option value="bonus_points" {{ $referralCampaign->reward_type === 'bonus_points' ? 'selected' : '' }}>Bonus Points</option>
                    <option value="discount" {{ $referralCampaign->reward_type === 'discount' ? 'selected' : '' }}>Discount (%)</option>
                </select>
                @error('reward_type')
                    <div style="color: #c33; font-size: 12px; margin-top: 5px;">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="reward_value"><span id="reward-label">Reward Value</span> *</label>
                <input type="number" id="reward_value" name="reward_value" value="{{ $referralCampaign->reward_value }}" required step="0.01" min="0.01" placeholder="e.g., 5">
                @error('reward_value')
                    <div style="color: #c33; font-size: 12px; margin-top: 5px;">{{ $message }}</div>
                @enderror
                <div style="color: #666; font-size: 12px; margin-top: 5px;" id="reward-hint">USD reward per referral</div>
            </div>
        </div>

        <div class="form-group">
            <label for="max_reward">Maximum Reward (Optional)</label>
            <input type="number" id="max_reward" name="max_reward" value="{{ $referralCampaign->max_reward }}" step="0.01" min="0" placeholder="e.g., 300">
            @error('max_reward')
                <div style="color: #c33; font-size: 12px; margin-top: 5px;">{{ $message }}</div>
            @enderror
            <div style="color: #666; font-size: 12px; margin-top: 5px;">Maximum reward per user for this campaign</div>
        </div>

        <div class="form-group">
            <label>Applicable User Types</label>
            <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 10px;">
                <label style="display: flex; align-items: center; font-weight: normal;">
                    <input type="checkbox" name="applicable_user_types[]" value="student" {{ in_array('student', $referralCampaign->applicable_user_types ?? []) ? 'checked' : '' }}>
                    <span style="margin-left: 5px;">Student</span>
                </label>
                <label style="display: flex; align-items: center; font-weight: normal;">
                    <input type="checkbox" name="applicable_user_types[]" value="agent" {{ in_array('agent', $referralCampaign->applicable_user_types ?? []) ? 'checked' : '' }}>
                    <span style="margin-left: 5px;">Agent</span>
                </label>
                <label style="display: flex; align-items: center; font-weight: normal;">
                    <input type="checkbox" name="applicable_user_types[]" value="reseller" {{ in_array('reseller', $referralCampaign->applicable_user_types ?? []) ? 'checked' : '' }}>
                    <span style="margin-left: 5px;">Reseller</span>
                </label>
            </div>
            <div style="color: #666; font-size: 12px; margin-top: 5px;">Leave unchecked to apply to all user types</div>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
            <div class="form-group">
                <label for="start_date">Start Date *</label>
                <input type="date" id="start_date" name="start_date" value="{{ $referralCampaign->start_date->format('Y-m-d') }}" required>
                @error('start_date')
                    <div style="color: #c33; font-size: 12px; margin-top: 5px;">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="end_date">End Date *</label>
                <input type="date" id="end_date" name="end_date" value="{{ $referralCampaign->end_date->format('Y-m-d') }}" required>
                @error('end_date')
                    <div style="color: #c33; font-size: 12px; margin-top: 5px;">{{ $message }}</div>
                @enderror
                <div style="color: #666; font-size: 12px; margin-top: 5px;">Must be after the start date</div>
            </div>
        </div>

        <div class="form-group">
            <label for="status">Status *</label>
            <select id="status" name="status" required>
                <option value="active" {{ $referralCampaign->status === 'active' ? 'selected' : '' }}>Active</option>
                <option value="inactive" {{ $referralCampaign->status === 'inactive' ? 'selected' : '' }}>Inactive</option>
                <option value="frozen" {{ $referralCampaign->status === 'frozen' ? 'selected' : '' }}>Frozen</option>
            </select>
            @error('status')
                <div style="color: #c33; font-size: 12px; margin-top: 5px;">{{ $message }}</div>
            @enderror
        </div>

        <div style="display: flex; gap: 10px; margin-top: 30px;">
            <button type="submit" style="background: #667eea; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;">Update Campaign</button>
            <a href="{{ route('admin.referral-campaigns.index') }}" style="background: #6c757d; color: white; padding: 10px 20px; border-radius: 5px; text-decoration: none; display: flex; align-items: center;">Cancel</a>
        </div>
    </form>

    <style>
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #2c3e50;
        }
        .form-group input[type="text"],
        .form-group input[type="date"],
        .form-group input[type="number"],
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
            font-family: inherit;
        }
    </style>

    <script>
        function updateRewardLabel() {
            const rewardType = document.getElementById('reward_type').value;
            const label = document.getElementById('reward-label');
            const hint = document.getElementById('reward-hint');
            
            switch(rewardType) {
                case 'voucher':
                    label.textContent = 'Voucher Value';
                    hint.textContent = 'USD amount per referral';
                    break;
                case 'bonus_points':
                    label.textContent = 'Bonus Points';
                    hint.textContent = 'Points per referral';
                    break;
                case 'discount':
                    label.textContent = 'Discount Percentage';
                    hint.textContent = 'Percentage discount per referral';
                    break;
                default:
                    label.textContent = 'Reward Value';
                    hint.textContent = 'Reward per referral';
            }
        }

        document.getElementById('start_date').addEventListener('change', function() {
            const startDate = new Date(this.value);
            const tomorrow = new Date(startDate);
            tomorrow.setDate(tomorrow.getDate() + 1);
            
            const endDateInput = document.getElementById('end_date');
            endDateInput.min = tomorrow.toISOString().split('T')[0];
        });

        if (document.getElementById('reward_type').value) {
            updateRewardLabel();
        }
    </script>
</div>
@endsection
