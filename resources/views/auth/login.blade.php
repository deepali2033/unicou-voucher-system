@extends('layouts.auth')

@section('title', 'Login')

@section('content')
<div class="login-wrapper">
    <!-- LEFT IMAGE -->
    <div class="login-image">
        <img src="https://static.vecteezy.com/system/resources/thumbnails/003/689/228/small/online-registration-or-sign-up-login-for-account-on-smartphone-app-user-interface-with-secure-password-mobile-application-for-ui-web-banner-access-cartoon-people-illustration-vector.jpg" alt="Login Image">
    </div>

    <!-- RIGHT FORM -->
    <div class="login-form">
        <h2>Login</h2>
        <p>Sign in to your account</p>

        @if(session('success'))
            <div style="color: green; margin-bottom: 15px; font-size: 14px;">{{ session('success') }}</div>
        @endif

        <form action="{{ route('login.post') }}" method="POST">
            @csrf
            
            <div class="field">
                <label>Email Address</label>
                <input type="email" name="email" value="{{ old('email') }}" placeholder="Enter email" required>
                @error('email')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="field">
                <label>Password</label>
                <input type="password" name="password" placeholder="Enter password" required>
                @error('password')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="login_btn">Login</button>

            <p class="bottom-text">
                Don't have an account?
                <a href="{{ route('register') }}" class="link">Create new account</a>
            </p>
        </form>
    </div>
</div>
@endsection
