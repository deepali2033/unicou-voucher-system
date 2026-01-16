<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Profile Completion</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', sans-serif; background: #f4f7f6; padding: 20px; }
        .container { max-width: 800px; margin: 0 auto; background: white; padding: 30px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        h1 { margin-bottom: 20px; color: #333; text-align: center; }
        .section-title { background: #667eea; color: white; padding: 10px; margin: 20px 0 15px 0; border-radius: 4px; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; color: #555; }
        input[type="text"], input[type="email"], input[type="date"], select, textarea {
            width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px;
        }
        .grid { display: grid; grid-template-columns: 1fr 1fr; gap: 15px; }
        .checkbox-group { display: flex; flex-wrap: wrap; gap: 10px; }
        .checkbox-item { display: flex; align-items: center; gap: 5px; }
        button { 
            display: block; width: 100%; padding: 15px; background: #667eea; color: white; 
            border: none; border-radius: 4px; font-size: 18px; cursor: pointer; margin-top: 20px;
        }
        button:hover { background: #764ba2; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Complete Your Student Profile</h1>
        
        <form action="{{ route('profile.student.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="section-title">Personal Information</div>
            <div class="form-group">
                <label>Full Name (as per ID Document)</label>
                <input type="text" name="full_name" value="{{ auth()->user()->name }}" required>
            </div>
            
            <div class="grid">
                <div class="form-group">
                    <label>Date of Birth</label>
                    <input type="date" name="dob" required>
                </div>
                <div class="form-group">
                    <label>Email ID (For Vouchers Delivery)</label>
                    <input type="email" name="email" value="{{ auth()->user()->email }}" required>
                </div>
            </div>

            <div class="grid">
                <div class="form-group">
                    <label>ID Document Type</label>
                    <select name="id_document_type" required>
                        <option value="National ID Card">National ID Card</option>
                        <option value="Passport">Passport</option>
                        <option value="Driving License">Driving License</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>ID Document No.</label>
                    <input type="text" name="id_document_no" required>
                </div>
            </div>

            <div class="grid">
                <div class="form-group">
                    <label>Contact No.</label>
                    <input type="text" name="contact_no" value="{{ auth()->user()->phone }}" required>
                </div>
                <div class="form-group">
                    <label>Whatsapp No. (Include Country Code)</label>
                    <input type="text" name="whatsapp_no" placeholder="+1234567890" required>
                </div>
            </div>

            <div class="section-title">Address Details</div>
            <div class="form-group">
                <label>Detail Address</label>
                <textarea name="detail_address" rows="2" required></textarea>
            </div>
            <div class="grid">
                <div class="form-group">
                    <label>City</label>
                    <input type="text" name="city" required>
                </div>
                <div class="form-group">
                    <label>State/Province</label>
                    <input type="text" name="state" required>
                </div>
            </div>
            <div class="grid">
                <div class="form-group">
                    <label>Country</label>
                    <input type="text" name="country" required>
                </div>
                <div class="form-group">
                    <label>Post Code</label>
                    <input type="text" name="post_code" required>
                </div>
            </div>

            <div class="section-title">Academic & Purpose</div>
            <div class="grid">
                <div class="form-group">
                    <label>Highest Education</label>
                    <input type="text" name="highest_education" required>
                </div>
                <div class="form-group">
                    <label>Passing Year</label>
                    <input type="text" name="passing_year" required>
                </div>
            </div>
            <div class="form-group">
                <label>Purpose of English Exam</label>
                <select name="purpose_of_exam" required>
                    <option value="Education">Education</option>
                    <option value="Migration">Migration</option>
                    <option value="Other">Other</option>
                </select>
            </div>

            <div class="form-group">
                <label>Preferred Country(ies)</label>
                <div class="checkbox-group">
                    @foreach(['UK', 'USA', 'Canada', 'Australia', 'Germany', 'Other'] as $country)
                        <div class="checkbox-item">
                            <input type="checkbox" name="preferred_countries[]" value="{{ $country }}" id="c_{{ $country }}">
                            <label for="c_{{ $country }}">{{ $country }}</label>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="section-title">Bank Details</div>
            <div class="form-group">
                <label>Bank Name</label>
                <input type="text" name="bank_name">
            </div>
            <div class="form-group">
                <label>Bank Address & Country</label>
                <textarea name="bank_address" rows="2"></textarea>
            </div>
            <div class="form-group">
                <label>IBAN/BAB/Account No.</label>
                <input type="text" name="bank_account_no">
            </div>

            <div class="section-title">Upload Documents</div>
            <div class="form-group">
                <label>ID Document (Upload Image/PDF)</label>
                <input type="file" name="id_document" accept="image/*,.pdf" required>
            </div>

            <button type="submit">Submit Profile & Activate Account</button>
        </form>
    </div>
</body>
</html>