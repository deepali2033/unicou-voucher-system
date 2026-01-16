@extends('layouts.auth')

@section('title', 'Register')

@section('content')
<div class="auth-wrapper">
    <!-- LEFT IMAGE -->
    <div class="auth-image">
        <img src="https://media.istockphoto.com/id/2205696704/photo/online-registration-form-identity-verification-personal-information-verification-concept.jpg?s=612x612&w=0&k=20&c=2X_45rxke9VrEez-D7JPchhSQwM_Od2jR_vyS1O5MTY=" alt="Register Illustration">
    </div>

    <!-- RIGHT FORM -->
    <div class="auth-form">
        <h2 class="title">Register</h2>
        <p class="subtitle">Create your account</p>

        <form action="{{ route('register.post') }}" method="POST" id="registerForm">
            @csrf
            
            <div class="field">
                <label>Full Name</label>
                <input type="text" name="name" value="{{ old('name') }}" placeholder="Enter full name" required>
                @error('name')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="field">
                <label>Email Address</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="Enter email" required>
                @error('email')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="field">
                <label>Phone Number</label>
                <input type="tel" id="phone_input" name="phone_dummy" value="{{ old('phone_dummy') }}" placeholder="Enter phone number" required style="width: 100%;">
                <input type="hidden" name="phone" id="full_phone">
                <input type="hidden" name="country_code" id="country_code">
                @error('phone')
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

            <div class="field">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" placeholder="Confirm password" required>
            </div>

            <button type="submit" id="submit-btn" class="btn-primary">Register</button>

            <p class="bottom-text">
                Already have an account?
                <a href="{{ route('login') }}">Login</a>
            </p>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    const phoneInputField = document.querySelector("#phone_input");
    const phoneInput = window.intlTelInput(phoneInputField, {
        preferredCountries: ["in", "us", "gb", "pk", "bd", "ae"],
        utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
    });

    const form = document.querySelector("#registerForm");
    form.addEventListener("submit", function(e) {
        const fullPhone = phoneInput.getNumber();
        const countryData = phoneInput.getSelectedCountryData();
        document.querySelector("#full_phone").value = fullPhone;
        document.querySelector("#country_code").value = "+" + countryData.dialCode;
    });
</script>
@endpush

@push('styles')
<style>
    .iti { width: 100%; }
    .iti__flag-container { z-index: 10; }
</style>
@endpush
