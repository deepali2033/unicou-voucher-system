<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personal Information</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', sans-serif; background: #f4f7f6; padding: 20px; }
        .container { max-width: 800px; margin: 0 auto; background: white; padding: 30px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        h1 { margin-bottom: 20px; color: #333; text-align: center; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; color: #555; }
        input[type="text"], input[type="email"], input[type="date"], select {
            width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px;
        }
        .grid { display: grid; grid-template-columns: 1fr 1fr; gap: 15px; }
        button { 
            display: block; width: 100%; padding: 15px; background: #667eea; color: white; 
            border: none; border-radius: 4px; font-size: 18px; cursor: pointer; margin-top: 20px;
        }
        button:hover { background: #764ba2; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Personal Information</h1>
        <p style="text-align: center; color: #666; margin-bottom: 20px;">Please provide your basic details to continue.</p>
        
        @if ($errors->any())
            <div style="background: #ffe6e6; color: #c0392b; padding: 12px; border-radius: 5px; margin-bottom: 20px;">
                <strong>Please fix the following errors:</strong>
                <ul style="margin-left: 20px; margin-top: 10px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if(session('error'))
            <div style="background: #ffe6e6; color: #c0392b; padding: 12px; border-radius: 5px; margin-bottom: 20px;">
                {{ session('error') }}
            </div>
        @endif
        
        <form action="{{ route('profile.personal.store') }}" method="POST">
            @csrf
            
            <div class="grid">
                <div class="form-group">
                    <label>First Name</label>
                    <input type="text" name="first_name">
                </div>
                <div class="form-group">
                    <label>Last Name</label>
                    <input type="text" name="last_name">
                </div>
            </div>

          
            <div class="grid">
                <div class="form-group">
                    <label>Date of Birth</label>
                    <input type="date" name="date_of_birth">
                </div>
                <div class="form-group">
                    <label>Email *</label>
                    <input type="email" name="email" value="{{ auth()->user()->email }}" required>
                </div>
            </div>

            <div class="grid">
                <div class="form-group">
                    <label>Phone</label>
                    <input type="text" name="phone" value="{{ auth()->user()->phone }}">
                </div>
                <div class="form-group">
                    <label>WhatsApp</label>
                    <input type="text" name="whatsapp">
                </div>
            </div>

            <div class="form-group">
                <label>Address Line 1</label>
                <input type="text" name="address_line1">
            </div>

            <div class="form-group">
                <label>Address Line 2</label>
                <input type="text" name="address_line2">
            </div>

            <div class="grid">
                <div class="form-group">
                    <label>City</label>
                    <input type="text" name="city">
                </div>
                <div class="form-group">
                    <label>State / Province</label>
                    <input type="text" name="state_province">
                </div>
            </div>

            <div class="grid">
                <div class="form-group">
                    <label>Country</label>
                    <input type="text" name="country">
                </div>
                <div class="form-group">
                    <label>Postal Code</label>
                    <input type="text" name="postal_code">
                </div>
            </div>

            <button type="submit">Save & Continue</button>
        </form>
    </div>
</body>
</html>