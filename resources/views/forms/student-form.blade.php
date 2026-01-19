@extends('layouts.auth')

@section('title', 'Login')

@section('content')
   <div class="sat-view-container">
  <div class="sat-card">

    <div class="sat-header">
      <h2>STUDENT ADMISSION TERMINAL</h2>
      <p>
        Establish your identity node according to global standards.
        Official processing via <b>connect@unicou.uk</b>
      </p>
    </div>

<form id="satForm" action="{{ route('student.store') }}" method="POST" enctype="multipart/form-data">
@csrf

<!-- ================= PERSONAL ================= -->
<section class="sat-section">
  <h4><span>01</span> Personal Information</h4>

  <div class="sat-grid-2">
    <div class="sat-field">
      <label>Full Name *</label>
      <input type="text" name="full_name" placeholder="e.g. Muhammad Ali Khan" required>
    </div>

    <div class="sat-field">
      <label>Date of Birth (as per ID) *</label>
      <input type="date" name="dob" required>
    </div>

    <div class="sat-field">
      <label>ID Document Type *</label>
      <select name="id_type" required>
        <option value="">Select document type</option>
        <option>National ID Card</option>
        <option>Passport</option>
        <option>Driving License</option>
      </select>
    </div>

    <div class="sat-field">
      <label>ID Document No *</label>
      <input type="text" name="id_no" placeholder="e.g. CNIC / Passport Number" required>
    </div>
  </div>
</section>

<!-- ================= CONTACT ================= -->
<section class="sat-section">
  <h4><span>02</span> Contact Information</h4>

  <div class="sat-grid-2">
    <div class="sat-field">
      <label>Primary Contact No *</label>
      <input type="tel" name="phone" placeholder="+92 3XX XXX XXXX" required>
    </div>

    <div class="sat-field">
      <label>Email (Voucher Delivery) *</label>
      <input type="email" name="email" placeholder="e.g. student@email.com" required>
    </div>

    <div class="sat-field">
      <label>WhatsApp No *</label>
      <input type="tel" name="whatsapp" placeholder="+92 3XX XXX XXXX" required>
    </div>
  </div>
</section>

<!-- ================= ADDRESS ================= -->
<section class="sat-section">
  <h4><span>03</span> Address Details</h4>

  <div class="sat-grid-2">
    <div class="sat-field sat-full">
      <label>Detailed Address *</label>
      <input type="text" name="address" placeholder="House, Street, Area, Sector" required>
    </div>

    <div class="sat-field">
      <label>City *</label>
      <input type="text" name="city" placeholder="e.g. Lahore" required>
    </div>

    <div class="sat-field">
      <label>State / Province *</label>
      <input type="text" name="state" placeholder="e.g. Punjab" required>
    </div>

    <div class="sat-field">
      <label>Country *</label>
      <input type="text" name="country" placeholder="e.g. Pakistan" required>
    </div>

    <div class="sat-field">
      <label>Post Code *</label>
      <input type="text" name="post_code" placeholder="e.g. 54000" required>
    </div>
  </div>
</section>

<!-- ================= DOCUMENT UPLOAD ================= -->
<section class="sat-section">
  <h4><span>04</span> Upload Documents</h4>

  <div class="sat-grid-2">
    <div class="sat-field sat-full">
      <label>Upload ID Document *</label>
      <input type="file" name="id_document" required>
    </div>
  </div>
</section>

<!-- ================= EXAM PURPOSE ================= -->
<section class="sat-section">
  <h4><span>05</span> English Exam Purpose</h4>

  <div class="sat-grid-2">
    <div class="sat-field">
      <select name="exam_purpose" required>
        <option value="">Select exam purpose</option>
        <option>Education</option>
        <option>Migration</option>
        <option>Other</option>
      </select>
    </div>
  </div>
</section>

<!-- ================= EDUCATION ================= -->
<section class="sat-section">
  <h4><span>06</span> Education Details</h4>

  <div class="sat-grid-2">
    <div class="sat-field">
      <label>Highest Education *</label>
      <input type="text" name="highest_education" placeholder="e.g. Bachelor of Science" required>
    </div>

    <div class="sat-field">
      <label>Passing Year *</label>
      <input type="number" name="passing_year" placeholder="e.g. 2022" min="1990" max="2035" required>
    </div>
  </div>
</section>

<!-- ================= COUNTRIES ================= -->
<section class="sat-section">
  <h4><span>07</span> Preferred Countries</h4>

  <div class="sat-grid-2 Preferred-Country">
    <label class="sat-consent Preferred-Country_checkbox"><input type="checkbox" name="preferred_countries[]" value="United Kingdom"> United Kingdom</label>
    <label class="sat-consent Preferred-Country_checkbox"><input type="checkbox" name="preferred_countries[]" value="United States"> United States</label>
    <label class="sat-consent Preferred-Country_checkbox"><input type="checkbox" name="preferred_countries[]" value="Canada"> Canada</label>
    <label class="sat-consent Preferred-Country_checkbox"><input type="checkbox" name="preferred_countries[]" value="Australia"> Australia</label>
  </div>
</section>

<!-- ================= BANK ================= -->
<section class="sat-section">
  <h4><span>08</span> Bank Account Details</h4>

  <div class="sat-grid-2">
    <div class="sat-field">
      <label>Bank Name *</label>
      <input type="text" name="bank_name" placeholder="e.g. Standard Chartered Bank" required>
    </div>

    <div class="sat-field">
      <label>Bank Country *</label>
      <input type="text" name="bank_country" placeholder="e.g. Pakistan" required>
    </div>

    <div class="sat-field sat-full">
      <label>IBAN / BSB / Account No *</label>
      <input type="text" name="account_no" placeholder="e.g. PK36SCBL0000001123456702" required>
    </div>
  </div>
</section>

<!-- ================= FINAL UPLOAD ================= -->
<section class="sat-section">
  <h4><span>09</span> Final Verification Upload</h4>

  <div class="sat-grid-2">
    <div class="sat-field sat-full">
      <label>Re-Upload ID Document *</label>
      <input type="file" name="re_upload_id_document" required>
    </div>
  </div>
</section>

<!-- ================= CONSENT ================= -->
<div class="sat-consent">
  <input type="checkbox" name="consent" required>
  <p>
    I accept Terms & Conditions, confirm email verification,
    and allow identity verification via <b>ShuftiPro</b>.
  </p>
</div>

<button type="submit" class="sat-btn">
  INITIALIZE REGISTRY SYNC →
</button>

</form>

  </div>
</div>
@endsection