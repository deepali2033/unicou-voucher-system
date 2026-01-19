@extends('layouts.master')

@section('title', 'Edit Voucher')

@section('navbar-title', '✏️ Edit Voucher')

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
    textarea,
    select {
        width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 5px;
        font-size: 14px;
        transition: border-color 0.3s;
        font-family: inherit;
    }

    input[type="text"]:focus,
    input[type="date"]:focus,
    input[type="number"]:focus,
    textarea:focus,
    select:focus {
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

    .form-buttons {
        display: flex;
        gap: 10px;
        margin-top: 30px;
    }

    button, .btn {
        padding: 12px 20px;
        border: none;
        border-radius: 5px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: transform 0.2s;
        text-decoration: none;
        display: inline-block;
    }

    .btn-submit {
        flex: 1;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
    }

    .btn-submit:hover {
        transform: translateY(-2px);
    }

    .btn-cancel {
        flex: 1;
        background: #6c757d;
        color: white;
        text-align: center;
    }

    .btn-cancel:hover {
        transform: translateY(-2px);
        color: white;
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
        <h2 style="color: #333; margin-bottom: 25px;">Edit Voucher: <strong>{{ $voucher->code }}</strong></h2>

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

        <form action="{{ route('admin.vouchers.update', $voucher->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Voucher Name *</label>
                <input type="text" id="name" name="name" value="{{ old('name', $voucher->name) }}" required>
                @error('name')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="code">Voucher Code *</label>
                <input type="text" id="code" name="code" value="{{ old('code', $voucher->code) }}" required>
                @error('code')
                    <div class="error-message">{{ $message }}</div>
                @enderror
                <div class="help-text">Unique code that customers will use</div>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" name="description">{{ old('description', $voucher->description) }}</textarea>
                @error('description')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="price">Price / Discount Amount (USD) *</label>
                <input type="number" id="price" name="price" value="{{ old('price', $voucher->price) }}" required step="0.01" min="0">
                @error('price')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                <div class="form-group">
                    <label for="stock">Current Stock *</label>
                    <input type="number" id="stock" name="stock" value="{{ old('stock', $voucher->stock) }}" required min="0">
                    @error('stock')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="low_stock_threshold">Low Stock Alert *</label>
                    <input type="number" id="low_stock_threshold" name="low_stock_threshold" value="{{ old('low_stock_threshold', $voucher->low_stock_threshold) }}" required min="0">
                    @error('low_stock_threshold')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="start_date">Start Date *</label>
                <input type="date" id="start_date" name="start_date" value="{{ old('start_date', $voucher->start_date->format('Y-m-d')) }}" required>
                @error('start_date')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="end_date">End Date *</label>
                <input type="date" id="end_date" name="end_date" value="{{ old('end_date', $voucher->end_date->format('Y-m-d')) }}" required>
                @error('end_date')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="status">Status *</label>
                <select id="status" name="status" required>
                    <option value="active" {{ old('status', $voucher->status) === 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ old('status', $voucher->status) === 'inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
                @error('status')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-buttons">
                <button type="submit" class="btn-submit">💾 Update Voucher</button>
                <a href="{{ route('admin.vouchers.index') }}" class="btn btn-cancel">❌ Cancel</a>
            </div>
        </form>
    </div>
@endsection
