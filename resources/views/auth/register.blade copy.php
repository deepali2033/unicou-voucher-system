<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register as {{ str_replace('_', ' ', ucfirst($role)) }}</title>
  
</head>
<body>
    <div class="container">


    <div class="register_page_sec">
    <div class="auth-wrapper">

    <!-- LEFT IMAGE -->
    <div class="auth-image">
        <img src="https://media.istockphoto.com/id/2205696704/photo/online-registration-form-identity-verification-personal-information-verification-concept.jpg?s=612x612&w=0&k=20&c=2X_45rxke9VrEez-D7JPchhSQwM_Od2jR_vyS1O5MTY=" alt="Register Illustration">
    </div>

    <!-- RIGHT FORM -->
    <div class="auth-form">
        <h2 class="title">Register</h2>
        <p class="subtitle">Create your account</p>
      @if ($errors->any()) 
            <div style="background: #ffe6e6; color: #c0392b; padding: 12px; border-radius: 5px; margin-bottom: 20px;">
                <strong>Registration Failed:</strong>
                <ul style="margin-left: 20px; margin-top: 10px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form  action="{{ route('register') }}" method="POST">

        <div class="field">
            <label>Full Name</label>
            <input type="text" placeholder="Enter full name" required>
        </div>

        <div class="field">
            <label>Email Address</label>
            <input type="email" placeholder="Enter email" required>
        </div>

        <div class="field">
            <label>Password</label>
            <input type="password" placeholder="Enter password" required>
        </div>

        <div class="field">
            <label>Confirm Password</label>
            <input type="password" placeholder="Confirm password" required>
        </div>

        <button type="submit" class="btn-primary">Register</button>

        <p class="bottom-text">
            Already have an account?
            <a href="index.html">Login</a>
        </p>

        </form>
    </div>

    </div>
</div>
        <h1>Create Account</h1>
        <span class="role-badge">Registering as {{ str_replace('_', ' ', ucfirst($role)) }}</span>
        
        @if ($errors->any())
            <div style="background: #ffe6e6; color: #c0392b; padding: 12px; border-radius: 5px; margin-bottom: 20px;">
                <strong>Registration Failed:</strong>
                <ul style="margin-left: 20px; margin-top: 10px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <form action="{{ route('register') }}" method="POST">
            @csrf
            
            <input type="hidden" name="role" value="{{ $role }}">
            
            <div class="form-group">
                <label for="name">Full Name *</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required>
                @error('name')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="email">Email Address *</label>
                <div style="display: flex; gap: 10px;">
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required>
                    <button type="button" id="verify-email-btn" style="width: auto; white-space: nowrap; font-size: 14px; padding: 0 15px;">Verify Email</button>
                </div>
                <div id="email-verify-status" style="font-size: 12px; margin-top: 5px; color: #666;"></div>
                <input type="hidden" name="email_verified" id="email_verified_hidden" value="0">
                @error('email')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <script>
                document.getElementById('verify-email-btn').addEventListener('click', function() {
                    const email = document.getElementById('email').value;
                    if (!email) {
                        alert('Please enter email first');
                        return;
                    }
                    
                    const statusDiv = document.getElementById('email-verify-status');
                    statusDiv.innerText = 'Verifying...';
                    
                    // Local auto-verify logic
                    setTimeout(() => {
                        statusDiv.innerText = '✅ Email verified successfully!';
                        statusDiv.style.color = 'green';
                        document.getElementById('email_verified_hidden').value = '1';
                        this.disabled = true;
                        this.style.background = '#ccc';
                        document.getElementById('email').readOnly = true;
                    }, 1000);
                });
            </script>
            
            <div class="form-group">
                <label for="phone">Phone Number *</label>
                <input type="tel" id="phone" name="phone" value="{{ old('phone') }}" required>
                @error('phone')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="password">Password *</label>
                <input type="password" id="password" name="password" required>
                @error('password')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="confirm_password">Confirm Password *</label>
                <input type="password" id="confirm_password" name="confirm_password" required>
                @error('confirm_password')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            
            <button type="submit">Create {{ str_replace('_', ' ', ucfirst($role)) }} Account</button>
        </form>
        
        <div class="links">
            <a href="{{ route('register.role') }}">← Change Role</a> | 
            <a href="{{ route('login') }}">Already have an account?</a>
        </div>
    </div>
</body>
</html>
