@extends('layouts.master')

@section('title', 'My Profile')

@section('navbar-title', '👤 My Profile')

@section('custom-css')
    .profile-container {
        max-width: 800px;
        margin: 0 auto;
        display: grid;
        grid-template-columns: 250px 1fr;
        gap: 30px;
    }

    .profile-card {
        background: white;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        text-align: center;
        height: fit-content;
    }

    .avatar-large {
        width: 120px;
        height: 120px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 50px;
        font-weight: bold;
        margin: 0 auto 20px;
    }

    .profile-role {
        display: inline-block;
        padding: 5px 15px;
        background: #e9ecef;
        color: #495057;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        margin-top: 10px;
    }

    .form-card {
        background: white;
        padding: 40px;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
    }

    .form-section {
        margin-bottom: 30px;
    }

    .form-section h3 {
        margin-bottom: 20px;
        padding-bottom: 10px;
        border-bottom: 1px solid #eee;
        color: #333;
        font-size: 18px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    label {
        display: block;
        color: #666;
        font-weight: 600;
        margin-bottom: 8px;
        font-size: 14px;
    }

    input {
        width: 100%;
        padding: 12px;
        border: 1px solid #ddd;
        border-radius: 8px;
        font-size: 14px;
        transition: all 0.3s;
    }

    input:focus {
        outline: none;
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    }

    .btn-save {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 12px 30px;
        border: none;
        border-radius: 8px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: transform 0.2s;
    }

    .btn-save:hover {
        transform: translateY(-2px);
    }

    .alert {
        padding: 15px;
        margin-bottom: 20px;
        border-radius: 8px;
    }

    .alert-success {
        background: #d4edda;
        color: #155724;
    }
@endsection

@section('content')
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="profile-container">
        <div class="profile-card">
            <div class="avatar-large">{{ strtoupper(substr($user->name, 0, 1)) }}</div>
            <h2 style="margin:0; color:#333;">{{ $user->name }}</h2>
            <p style="color:#666; margin:5px 0;">{{ $user->email }}</p>
            <span class="profile-role">{{ $user->role }}</span>
            <p style="margin-top: 20px; font-size: 13px; color: #999;">Member since {{ $user->created_at->format('M Y') }}</p>
        </div>

        <div class="form-card">
            <form action="{{ route('profile.update') }}" method="POST">
                @csrf
                <div class="form-section">
                    <h3>Personal Information</h3>
                    <div class="form-group">
                        <label>Full Name</label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}" required>
                        @error('name') <small style="color:red">{{ $message }}</small> @enderror
                    </div>
                    <div class="form-group">
                        <label>Email Address</label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}" required>
                        @error('email') <small style="color:red">{{ $message }}</small> @enderror
                    </div>
                    <div class="form-group">
                        <label>Phone Number</label>
                        <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" required>
                        @error('phone') <small style="color:red">{{ $message }}</small> @enderror
                    </div>
                </div>

                <div class="form-section">
                    <h3>Security Settings</h3>
                    <p style="font-size: 13px; color:#999; margin-bottom:15px;">Leave blank if you don't want to change password.</p>
                    <div class="form-group">
                        <label>New Password</label>
                        <input type="password" name="password">
                        @error('password') <small style="color:red">{{ $message }}</small> @enderror
                    </div>
                    <div class="form-group">
                        <label>Confirm Password</label>
                        <input type="password" name="password_confirmation">
                    </div>
                </div>

                <div style="text-align: right;">
                    <button type="submit" class="btn-save">Update Profile</button>
                </div>
            </form>
        </div>
    </div>
@endsection
