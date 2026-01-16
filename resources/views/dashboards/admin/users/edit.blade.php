@extends('layouts.master')

@section('title', 'Edit User')

@section('navbar-title', '✏️ Edit User')

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
    input[type="email"],
    input[type="password"],
    select {
        width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 5px;
        font-size: 14px;
        transition: border-color 0.3s;
        font-family: inherit;
    }

    input:focus, select:focus {
        outline: none;
        border-color: #667eea;
        box-shadow: 0 0 5px rgba(102, 126, 234, 0.3);
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

    button, .btn-cancel {
        padding: 12px 20px;
        border: none;
        border-radius: 5px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: transform 0.2s;
        text-decoration: none;
        display: inline-block;
        text-align: center;
    }

    .btn-submit {
        flex: 2;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
    }

    .btn-cancel {
        flex: 1;
        background: #6c757d;
        color: white;
    }

    button:hover, .btn-cancel:hover {
        transform: translateY(-2px);
        opacity: 0.9;
    }
@endsection

@section('content')
    <div class="form-container">
        <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="form-group">
                <label for="name">Full Name</label>
                <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                @error('name')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                @error('email')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="phone">Phone Number</label>
                <input type="text" id="phone" name="phone" value="{{ old('phone', $user->phone) }}" required>
                @error('phone')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Password (Leave blank to keep current)</label>
                <input type="password" id="password" name="password" placeholder="Min. 8 characters">
                <div class="help-text">Only fill this if you want to change the user's password.</div>
                @error('password')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="role">User Role</label>
                <select id="role" name="role" required>
                    <option value="manager" {{ old('role', $user->role) == 'manager' ? 'selected' : '' }}>Manager</option>
                    <option value="agent" {{ old('role', $user->role) == 'agent' ? 'selected' : '' }}>Agent</option>
                    <option value="support" {{ old('role', $user->role) == 'support' ? 'selected' : '' }}>Support</option>
                </select>
                @error('role')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="status">Account Status</label>
                <select id="status" name="status" required>
                    <option value="active" {{ old('status', $user->status) == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="pending" {{ old('status', $user->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="frozen" {{ old('status', $user->status) == 'frozen' ? 'selected' : '' }}>Frozen</option>
                </select>
                @error('status')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-buttons">
                <a href="{{ route('admin.users.index') }}" class="btn-cancel">Cancel</a>
                <button type="submit" class="btn-submit">💾 Update User</button>
            </div>
        </form>
    </div>
@endsection
