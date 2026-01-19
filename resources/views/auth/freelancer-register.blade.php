@extends('layouts.auth')

@section('title', 'Register - KAO services for Professional Cleaning Services')
@section('meta_description', 'Register with KAO services for professional cleaning services. Fill out our form for a quick response.')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css" />
<style>
    .iti__flag-container {
        pointer-events: none;
        /* disable click */
        cursor: not-allowed;
    }

    .iti--separate-dial-code {
        width: 100% !important;
    }
</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
@section('content')
    <div class="register-container">
        <h2 class="text-center mt-2 mb-4" id="formTitle">Register as Jobseeker</h2>

        @if (session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Toggle: Freelancer Only -->
        {{-- <div class="text-center">
            <div class="toggle-wrapper-auth mb-4 text-center" role="tablist" aria-label="Freelancer Registration">
                <button type="button" class="toggle-btn active" id="btnFreelancer" aria-selected="true">Jobseeker</button>
            </div>
        </div> --}}

        <!-- Registration Form -->
        <form id="registerForm" method="POST" action="{{ route('auth.register') }}">
            @csrf
            <input type="hidden" name="account_type" id="accountType" value="freelancer">

            <!-- Freelancer-only fields -->
            <div id="freelancerFields">
                <div class="row">
                    <div class="col-md  mb-md-0 mb-3">
                        <label for="firstName" class="form-label">First Name</label>
                        <input name="first_name" type="text" class="form-control" id="firstName"
                            placeholder="Enter your first name" required>
                    </div>
                    <div class="col-md  mb-md-0 mb-3">
                        <label for="lastName" class="form-label">Last Name</label>
                        <input name="last_name" type="text" class="form-control" id="lastName"
                            placeholder="Enter your last name" required>
                    </div>
                </div>
            </div>

            <!-- Shared fields -->
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input name="email" type="email" class="form-control" id="email" placeholder="Enter your email" required>
            </div>
            <div class="mb-3 ">
                <label for="phone" class="form-label d-block">Phone</label>
                <input type="tel" id="phone" name="phone" class="form-control d-block" required>
                <input type="hidden" id="full_phone" name="full_phone">
            </div>
            <script>
                // ✅ Allow only numbers & max 10 digits for Netherlands
                document.addEventListener("DOMContentLoaded", function () {
                    const phoneInput = document.querySelector("#phone");

                    phoneInput.addEventListener("input", function () {
                        // Only digits allowed
                        this.value = this.value.replace(/[^0-9]/g, '');

                        // Limit to 10 digits (Netherlands mobile format = 06xxxxxxxx)
                        if (this.value.length > 10) {
                            this.value = this.value.slice(0, 10);
                        }
                    });
                });

            </script>
            <div class="row mb-3">
                <div class="col-md  mb-md-0 mb-3">
                    <label for="password" class="form-label">Password</label>
                    <div class="password-container">
                        <input name="password" type="password" class="form-control" id="password"
                            placeholder="Enter your password" required>
                        <i class="fas fa-eye password-toggle" data-target="password"></i>
                    </div>
                </div>
                <div class="col-md  mb-md-0 mb-3">
                    <label for="confirmPassword" class="form-label">Confirm Password</label>
                    <div class="password-container">
                        <input name="password_confirmation" type="password" class="form-control" id="confirmPassword"
                            placeholder="Confirm your password" required>
                        <i class="fas fa-eye password-toggle" data-target="confirmPassword"></i>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-auth w-100" id="submitBtn">Register as Freelancer</button>

            <div class="signin-link">
                Already have an account? <a href="{{ route('login') }}">Login</a>
            </div>
        </form>

    </div>
@endsection

@push('styles')
    <style>
        .register-container {
            max-width: 600px;
            margin: 10px auto;
            padding: 50px 30px;
            background-image: linear-gradient(142deg, var(--e-global-color-vamtam_accent_1) 0%, var(--e-global-color-vamtam_accent_3) 60%);
            -webkit-clip-path: polygon(32.2492676px 0, calc(100% - 29.883191px) 14.1670774px, calc(100% - 29.883191px) 14.1670774px, calc(100% - 24.96109729px) 14.87537046px, calc(100% - 20.31945472px) 16.29591632px, calc(100% - 16.01424199px) 18.36886116px, calc(100% - 12.1014378px) 21.03435113px, calc(100% - 8.63702087px) 24.23253242px, calc(100% - 5.67696992px) 27.9035512px, calc(100% - 3.27726365px) 31.98755362px, calc(100% - 1.49388076px) 36.42468587px, calc(100% - 0.38279998px) 41.1550941px, calc(100% - 5.68434189e-14px) 46.1189245px, calc(100% - 0px) calc(100% - 32.02092px), calc(100% - 0px) calc(100% - 32.02092px), calc(100% - 0.41860061px) calc(100% - 26.8269604px), calc(100% - 1.63050344px) calc(100% - 21.89983258px), calc(100% - 3.56985995px) calc(100% - 17.30546357px), calc(100% - 6.1708216px) calc(100% - 13.10978045px), calc(100% - 9.36753988px) calc(100% - 9.37871025px), calc(100% - 13.09416624px) calc(100% - 6.17818003px), calc(100% - 17.28485217px) calc(100% - 3.57411685px), calc(100% - 21.87374912px) calc(100% - 1.63244774px), calc(100% - 26.79500858px) calc(100% - 0.41909978px), calc(100% - 31.982782px) calc(100% - 5.68434189e-14px), 31.9827822px calc(100% - 0px), 31.9827822px calc(100% - 0px), 26.79500879px calc(100% - 0.41909978px), 21.87374934px calc(100% - 1.63244774px), 17.28485237px calc(100% - 3.57411685px), 13.09416641px calc(100% - 6.17818003px), 9.36754001px calc(100% - 9.37871025px), 6.1708217px calc(100% - 13.10978045px), 3.56986001px calc(100% - 17.30546357px), 1.63050347px calc(100% - 21.89983258px), 0.41860062px calc(100% - 26.8269604px), 5.29492535e-31px calc(100% - 32.02092px), 0 32.0209204px, 0 32.0209204px, 0.41860062px 26.82696079px, 1.63050347px 21.89983293px, 3.56986001px 17.30546389px, 6.1708217px 13.10978071px, 9.36754001px 9.37871045px, 13.09416641px 6.17818017px, 17.28485237px 3.57411693px, 21.87374934px 1.63244779px, 26.79500879px 0.41909979px, 31.9827822px 5.30123935e-31px, 31.9827822px 0, 32.11152455px 0, 32.2175794px 0, 32.30094672px 0, 32.36162654px 0, 32.39961884px 0, 32.41492362px 0, 32.40754089px 0, 32.37747064px 0, 32.32471288px 0, 32.2492676px 0);
            clip-path: polygon(32.2492676px 0, calc(100% - 29.883191px) 14.1670774px, calc(100% - 29.883191px) 14.1670774px, calc(100% - 24.96109729px) 14.87537046px, calc(100% - 20.31945472px) 16.29591632px, calc(100% - 16.01424199px) 18.36886116px, calc(100% - 12.1014378px) 21.03435113px, calc(100% - 8.63702087px) 24.23253242px, calc(100% - 5.67696992px) 27.9035512px, calc(100% - 3.27726365px) 31.98755362px, calc(100% - 1.49388076px) 36.42468587px, calc(100% - 0.38279998px) 41.1550941px, calc(100% - 5.68434189e-14px) 46.1189245px, calc(100% - 0px) calc(100% - 32.02092px), calc(100% - 0px) calc(100% - 32.02092px), calc(100% - 0.41860061px) calc(100% - 26.8269604px), calc(100% - 1.63050344px) calc(100% - 21.89983258px), calc(100% - 3.56985995px) calc(100% - 17.30546357px), calc(100% - 6.1708216px) calc(100% - 13.10978045px), calc(100% - 9.36753988px) calc(100% - 9.37871025px), calc(100% - 13.09416624px) calc(100% - 6.17818003px), calc(100% - 17.28485217px) calc(100% - 3.57411685px), calc(100% - 21.87374912px) calc(100% - 1.63244774px), calc(100% - 26.79500858px) calc(100% - 0.41909978px), calc(100% - 31.982782px) calc(100% - 5.68434189e-14px), 31.9827822px calc(100% - 0px), 31.9827822px calc(100% - 0px), 26.79500879px calc(100% - 0.41909978px), 21.87374934px calc(100% - 1.63244774px), 17.28485237px calc(100% - 3.57411685px), 13.09416641px calc(100% - 6.17818003px), 9.36754001px calc(100% - 9.37871025px), 6.1708217px calc(100% - 13.10978045px), 3.56986001px calc(100% - 17.30546357px), 1.63050347px calc(100% - 21.89983258px), 0.41860062px calc(100% - 26.8269604px), 5.29492535e-31px calc(100% - 32.02092px), 0 32.0209204px, 0 32.0209204px, 0.41860062px 26.82696079px, 1.63050347px 21.89983293px, 3.56986001px 17.30546389px, 6.1708217px 13.10978071px, 9.36754001px 9.37871045px, 13.09416641px 6.17818017px, 17.28485237px 3.57411693px, 21.87374934px 1.63244779px, 26.79500879px 0.41909979px, 31.9827822px 5.30123935e-31px, 31.9827822px 0, 32.11152455px 0, 32.2175794px 0, 32.30094672px 0, 32.36162654px 0, 32.39961884px 0, 32.41492362px 0, 32.40754089px 0, 32.37747064px 0, 32.32471288px 0, 32.2492676px 0);
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .toggle-wrapper-auth {
            display: inline-flex;
            gap: 8px;
            background: #e8f5d3c2;
            padding: 6px;
            border-radius: 999px;
        }

        .toggle-btn {
            background: transparent;
            border: 0;
            padding: 8px 16px;
            border-radius: 999px;
            color: #000;
            font-weight: 600;
            cursor: pointer;
        }

        .toggle-btn.active {
            background: #000;
            color: #fff;
        }

        .google-btn {
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 4px;
            padding: 10px;
            text-align: center;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn-auth {
            background-color: #000000;
            border: none;
        }

        .btn-auth:hover {
            background-color: #000000;
            color: #fff;
        }

        .password-container {
            position: relative;
        }

        .password-toggle {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #6c757d;
        }

        .signin-link {
            margin-top: 25px;
            text-align: center;
        }

        .d-none {
            display: none !important;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel='stylesheet' id='elementor-post-66-css'
        href='{{ asset("wp-content/uploads/elementor/css/post-66.css") }}?ver=1752678329' type='text/css' media='all'>
    <link rel='stylesheet' id='elementor-post-142-css'
        href='{{ asset("wp-content/uploads/elementor/css/post-142.css") }}?ver=1752677976' type='text/css' media='all'>
    <link rel='stylesheet' id='elementor-post-1007-css'
        href='{{ asset("wp-content/uploads/elementor/css/post-1007.css") }}?ver=1752677976' type='text/css' media='all'>
    <link rel='stylesheet' id='elementor-post-3145-css'
        href='{{ asset("wp-content/uploads/elementor/css/post-3145.css") }}?ver=1752677976' type='text/css' media='all'>
    <link rel='stylesheet' id='elementor-post-156-css'
        href='{{ asset("wp-content/uploads/elementor/css/post-156.css") }}?ver=1752677977' type='text/css' media='all'>
@endpush

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const registerForm = document.getElementById('registerForm');
            if (registerForm) {
                registerForm.addEventListener('submit', function () {
                    const submitBtn = document.getElementById('submitBtn');
                    if (submitBtn) {
                        submitBtn.disabled = true;
                        submitBtn.textContent = 'Submitting...';
                    }
                });
            }

            // Auto-hide alerts after 5 seconds
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                setTimeout(() => {
                    alert.style.opacity = '0';
                    setTimeout(() => alert.remove(), 300);
                }, 5000);
            });
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const phoneInput = document.querySelector("#phone");

            const iti = window.intlTelInput(phoneInput, {
                initialCountry: "nl",          // Netherlands default
                onlyCountries: ["nl"],         // Only NL allowed
                separateDialCode: true,
                nationalMode: true,            // Show NL format without +31 prefix
                allowDropdown: false,          // 🚫 No dropdown
                utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js"
            });

            // Validate NL number
            phoneInput.addEventListener("blur", function () {
                if (!iti.isValidNumber()) {
                    phoneInput.setCustomValidity("Valid Netherlands phone number required");
                } else {
                    phoneInput.setCustomValidity("");
                }
            });

            // Submit full E.164 format
            document.querySelector("form").addEventListener("submit", function () {
                document.querySelector("#full_phone").value = iti.getNumber();
            });
        });

        document.addEventListener('DOMContentLoaded', function () {
            const toggles = document.querySelectorAll('.password-toggle');

            toggles.forEach(toggle => {
                toggle.addEventListener('click', function () {
                    const targetId = this.getAttribute('data-target');
                    const input = document.getElementById(targetId);

                    if (input.type === 'password') {
                        input.type = 'text';
                        this.classList.remove('fa-eye');
                        this.classList.add('fa-eye-slash');
                    } else {
                        input.type = 'password';
                        this.classList.remove('fa-eye-slash');
                        this.classList.add('fa-eye');
                    }
                });
            });
        });
    </script>

@endpush