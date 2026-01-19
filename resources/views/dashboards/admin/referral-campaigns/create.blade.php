@extends('layouts.app')

@section('content')
<div style="margin-left: 250px; padding: 30px; background: #f5f5f5; min-height: calc(100vh - 60px);">
    <div style="max-width: 800px; background: white; padding: 30px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
        <h1 style="color: #2c3e50; margin-bottom: 30px; font-size: 28px;">🔗 Create Referral Campaign</h1>

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

        @if (session('success'))
            <div style="background: #efe; border: 1px solid #cfc; color: #3c3; padding: 15px; border-radius: 5px; margin-bottom: 20px;">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('admin.referral-campaigns.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="campaign_name">Campaign Name *</label>
                <input type="text" id="campaign_name" name="campaign_name" value="{{ old('campaign_name') }}" required placeholder="e.g., Invite & Earn January">
                @error('campaign_name')
                    <div class="error-message">{{ $message }}</div>
                @enderror
                <div class="help-text">Name to identify the referral campaign</div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                <div class="form-group">
                    <label for="reward_type">Reward Type *</label>
                    <select id="reward_type" name="reward_type" required onchange="updateRewardLabel()">
                        <option value="">-- Select Type --</option>
                        <option value="voucher" {{ old('reward_type') === 'voucher' ? 'selected' : '' }}>Voucher</option>
                        <option value="bonus_points" {{ old('reward_type') === 'bonus_points' ? 'selected' : '' }}>Bonus Points</option>
                        <option value="discount" {{ old('reward_type') === 'discount' ? 'selected' : '' }}>Discount (%)</option>
                    </select>
                    @error('reward_type')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="reward_value"><span id="reward-label">Reward Value</span> *</label>
                    <input type="number" id="reward_value" name="reward_value" value="{{ old('reward_value') }}" required step="0.01" min="0.01" placeholder="e.g., 5">
                    @error('reward_value')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                    <div class="help-text" id="reward-hint">USD reward per referral</div>
                </div>
            </div>

            <div class="form-group">
                <label for="max_reward">Maximum Reward (Optional)</label>
                <input type="number" id="max_reward" name="max_reward" value="{{ old('max_reward') }}" step="0.01" min="0" placeholder="e.g., 300">
                @error('max_reward')
                    <div class="error-message">{{ $message }}</div>
                @enderror
                <div class="help-text">Maximum reward per user for this campaign</div>
            </div>

            <div class="form-group">
                <label>Applicable User Types</label>
                <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 10px;">
                    <label style="display: flex; align-items: center; font-weight: normal;">
                        <input type="checkbox" name="applicable_user_types[]" value="student" {{ in_array('student', old('applicable_user_types', [])) ? 'checked' : '' }}>
                        <span style="margin-left: 5px;">Student</span>
                    </label>
                    <label style="display: flex; align-items: center; font-weight: normal;">
                        <input type="checkbox" name="applicable_user_types[]" value="agent" {{ in_array('agent', old('applicable_user_types', [])) ? 'checked' : '' }}>
                        <span style="margin-left: 5px;">Agent</span>
                    </label>
                    <label style="display: flex; align-items: center; font-weight: normal;">
                        <input type="checkbox" name="applicable_user_types[]" value="reseller" {{ in_array('reseller', old('applicable_user_types', [])) ? 'checked' : '' }}>
                        <span style="margin-left: 5px;">Reseller</span>
                    </label>
                </div>
                <div class="help-text">Leave unchecked to apply to all user types</div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                <div class="form-group">
                    <label for="start_date">Start Date *</label>
                    <input type="date" id="start_date" name="start_date" value="{{ old('start_date') }}" required>
                    @error('start_date')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                    <div class="help-text">Cannot be before today ({{ date('M d, Y') }})</div>
                </div>

                <div class="form-group">
                    <label for="end_date">End Date *</label>
                    <input type="date" id="end_date" name="end_date" value="{{ old('end_date') }}" required>
                    @error('end_date')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                    <div class="help-text">Must be after the start date</div>
                </div>
            </div>

            <button type="submit" style="background: #28a745; color: white; padding: 12px 30px; border: none; border-radius: 5px; cursor: pointer; font-size: 16px; margin-top: 20px;">🎁 Create Campaign</button>
        </form>
    </div>

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
        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #28a745;
            box-shadow: 0 0 5px rgba(40, 167, 69, 0.3);
        }
        .error-message {
            color: #c33;
            font-size: 12px;
            margin-top: 5px;
        }
        .help-text {
            color: #666;
            font-size: 12px;
            margin-top: 5px;
        }
        button {
            font-size: 16px;
            padding: 12px 30px;
            border-radius: 5px;
            border: none;
            cursor: pointer;
            transition: background 0.3s;
        }
        button:hover {
            background: #218838 !important;
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

        const today = new Date();
        const todayStr = today.toISOString().split('T')[0];
        document.getElementById('start_date').min = todayStr;

        document.getElementById('start_date').addEventListener('change', function() {
            const startDate = new Date(this.value);
            const tomorrow = new Date(startDate);
            tomorrow.setDate(tomorrow.getDate() + 1);
            
            const endDateInput = document.getElementById('end_date');
            endDateInput.min = tomorrow.toISOString().split('T')[0];
            
            if (endDateInput.value && new Date(endDateInput.value) <= startDate) {
                endDateInput.value = '';
            }
        });

        const startDateInput = document.getElementById('start_date');
        if (startDateInput.value) {
            const event = new Event('change', { bubbles: true });
            startDateInput.dispatchEvent(event);
        }

        if (document.getElementById('reward_type').value) {
            updateRewardLabel();
        }
    </script>
</div>
@endsection
