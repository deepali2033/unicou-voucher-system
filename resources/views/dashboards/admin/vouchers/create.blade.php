@extends('layouts.master')

@section('title', 'Create Voucher')

@section('navbar-title', '🎟️ Create New Voucher')

@section('custom-css')
    .form-container {
        background: white;
        padding: 30px;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        max-width: 600px;
        margin: 0 auto;
    }

    .form-group {
        margin-bottom: 20px;
    }

    label {
        display: block;
        color: #333;
        font-weight: 600;
        margin-bottom: 8px;
        font-size: 14px;
    }

    input[type="text"],
    input[type="date"],
    input[type="number"],
    input[type="checkbox"],
    select,
    textarea {
        font-family: inherit;
    }

    input[type="text"],
    input[type="date"],
    input[type="number"],
    select,
    textarea {
        width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 5px;
        font-size: 14px;
        transition: border-color 0.3s;
    }

    input[type="text"]:focus,
    input[type="date"]:focus,
    input[type="number"]:focus,
    select:focus,
    textarea:focus {
        outline: none;
        border-color: #667eea;
        box-shadow: 0 0 5px rgba(102, 126, 234, 0.3);
    }

    textarea {
        resize: vertical;
        min-height: 80px;
    }

    .error-message {
        color: #dc3545;
        font-size: 13px;
        margin-top: 5px;
    }

    .help-text {
        color: #999;
        font-size: 12px;
        margin-top: 5px;
    }

    button {
        width: 100%;
        padding: 12px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border: none;
        border-radius: 5px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: transform 0.2s;
    }

    button:hover {
        transform: translateY(-2px);
    }

    .success-message {
        background: #d4edda;
        color: #155724;
        padding: 12px;
        border-radius: 5px;
        margin-bottom: 20px;
        border: 1px solid #c3e6cb;
    }
@endsection

@section('content')
    <div class="form-container">
        <h2 style="color: #333; margin-bottom: 25px;">Create New Voucher</h2>

        @if ($errors->any())
            <div style="background: #f8d7da; color: #721c24; padding: 12px; border-radius: 5px; margin-bottom: 20px; border: 1px solid #f5c6cb;">
                <strong>Validation Errors:</strong>
                <ul style="margin-left: 20px; margin-top: 10px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('success'))
            <div class="success-message">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('admin.vouchers.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="name">Voucher Name *</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required placeholder="e.g., Summer Sale 2026">
                @error('name')
                    <div class="error-message">{{ $message }}</div>
                @enderror
                <div class="help-text">Display name for the voucher</div>
            </div>

            <div class="form-group">
                <label for="code">Voucher Code *</label>
                <input type="text" id="code" name="code" value="{{ old('code') }}" required placeholder="e.g., SUMMER2026">
                @error('code')
                    <div class="error-message">{{ $message }}</div>
                @enderror
                <div class="help-text">Unique code that customers will use (no spaces)</div>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" name="description" placeholder="Add details about this voucher">{{ old('description') }}</textarea>
                @error('description')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="type">Voucher Type *</label>
                <select id="type" name="type" required onchange="updateTypeFields()">
                    <option value="">-- Select Type --</option>
                    <option value="discount" {{ old('type') === 'discount' ? 'selected' : '' }}>Discount Percentage</option>
                    <option value="fixed_amount" {{ old('type') === 'fixed_amount' ? 'selected' : '' }}>Fixed Amount</option>
                    <option value="free_item" {{ old('type') === 'free_item' ? 'selected' : '' }}>Free Item</option>
                </select>
                @error('type')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div id="discount-field" class="form-group" style="display: none;">
                <label for="discount_percent">Discount Percentage (%)</label>
                <input type="number" id="discount_percent" name="discount_percent" value="{{ old('discount_percent') }}" step="0.01" min="0" max="100" placeholder="e.g., 15.00">
                @error('discount_percent')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div id="fixed-amount-field" class="form-group" style="display: none;">
                <label for="fixed_amount">Fixed Amount (USD) *</label>
                <input type="number" id="fixed_amount" name="fixed_amount" value="{{ old('fixed_amount') }}" step="0.01" min="0" placeholder="e.g., 25.00">
                @error('fixed_amount')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div id="free-item-field" class="form-group" style="display: none;">
                <label for="free_item_name">Free Item Name *</label>
                <input type="text" id="free_item_name" name="free_item_name" value="{{ old('free_item_name') }}" placeholder="e.g., T-Shirt">
                @error('free_item_name')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="price">Base Price / Value (USD) *</label>
                <input type="number" id="price" name="price" value="{{ old('price') }}" required step="0.01" min="0.01" placeholder="e.g., 50.00">
                @error('price')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                <div class="form-group">
                    <label for="stock">Initial Stock</label>
                    <input type="number" id="stock" name="stock" value="{{ old('stock', 0) }}" min="0">
                    @error('stock')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="low_stock_threshold">Low Stock Alert</label>
                    <input type="number" id="low_stock_threshold" name="low_stock_threshold" value="{{ old('low_stock_threshold', 5) }}" min="0">
                    @error('low_stock_threshold')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                <div class="form-group">
                    <label for="per_user_limit">Per User Limit</label>
                    <input type="number" id="per_user_limit" name="per_user_limit" value="{{ old('per_user_limit') }}" min="1" placeholder="e.g., 3">
                    @error('per_user_limit')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                    <div class="help-text">Max uses per user (leave empty for unlimited)</div>
                </div>
                <div class="form-group">
                    <label for="total_limit">Total Usage Limit</label>
                    <input type="number" id="total_limit" name="total_limit" value="{{ old('total_limit') }}" min="1" placeholder="e.g., 100">
                    @error('total_limit')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                    <div class="help-text">Max total uses (leave empty for unlimited)</div>
                </div>
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

            <button type="submit">🎟️ Create Voucher</button>
        </form>
    </div>

    <script>
        function updateTypeFields() {
            const type = document.getElementById('type').value;
            document.getElementById('discount-field').style.display = type === 'discount' ? 'block' : 'none';
            document.getElementById('fixed-amount-field').style.display = type === 'fixed_amount' ? 'block' : 'none';
            document.getElementById('free-item-field').style.display = type === 'free_item' ? 'block' : 'none';
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

        if (document.getElementById('type').value) {
            updateTypeFields();
        }
    </script>
@endsection
