@extends('layouts.master')

@section('title', 'System Settings')

@section('navbar-title', '⚙️ System Settings')

@section('custom-css')
    .settings-container {
        max-width: 900px;
        margin: 0 auto;
    }

    .settings-card {
        background: white;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        margin-bottom: 30px;
    }

    .settings-card h3 {
        margin-bottom: 25px;
        color: #333;
        font-size: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .toggle-section {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 20px;
        background: #f8f9fa;
        border-radius: 8px;
        border: 1px solid #eee;
    }

    .toggle-info h4 {
        margin: 0;
        color: #333;
    }

    .toggle-info p {
        margin: 5px 0 0;
        color: #666;
        font-size: 14px;
    }

    .btn-toggle {
        padding: 10px 25px;
        border-radius: 5px;
        font-weight: 700;
        cursor: pointer;
        border: none;
        transition: all 0.3s;
    }

    .btn-active {
        background: #28a745;
        color: white;
    }

    .btn-inactive {
        background: #dc3545;
        color: white;
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

    <div class="settings-container">
        <!-- Voucher System Control -->
        <div class="settings-card">
            <h3>🎟️ Voucher System Control</h3>
            <div class="toggle-section">
                <div class="toggle-info">
                    <h4>Enable/Disable Voucher Sales</h4>
                    <p>When disabled, users cannot purchase or redeem new vouchers. Existing vouchers remain in the system.</p>
                </div>
                <form action="{{ route('admin.settings.toggle-voucher') }}" method="POST">
                    @csrf
                    @php $isActive = \App\Models\Setting::get('voucher_system_active', '1') === '1'; @endphp
                    <button type="submit" class="btn-toggle {{ $isActive ? 'btn-active' : 'btn-inactive' }}">
                        {{ $isActive ? '✅ SYSTEM ON' : '🛑 SYSTEM OFF' }}
                    </button>
                </form>
            </div>
        </div>

        <!-- System Configuration -->
        <div class="settings-card">
            <h3>⚙️ General Configuration</h3>
            <form action="{{ route('admin.settings.update') }}" method="POST">
                @csrf
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                    <div class="form-group" style="margin-bottom: 20px;">
                        <label style="display:block; margin-bottom:8px; font-weight:600;">Business Name</label>
                        <input type="text" name="business_name" value="{{ \App\Models\Setting::get('business_name', 'Business Portal') }}" style="width:100%; padding:10px; border:1px solid #ddd; border-radius:5px;">
                    </div>
                    <div class="form-group" style="margin-bottom: 20px;">
                        <label style="display:block; margin-bottom:8px; font-weight:600;">Contact Email</label>
                        <input type="email" name="contact_email" value="{{ \App\Models\Setting::get('contact_email', 'admin@example.com') }}" style="width:100%; padding:10px; border:1px solid #ddd; border-radius:5px;">
                    </div>
                </div>
                
                <div style="margin-top: 10px;">
                    <button type="submit" style="background: #667eea; color:white; border:none; padding:12px 30px; border-radius:5px; font-weight:600; cursor:pointer;">Save Configuration</button>
                </div>
            </form>
        </div>
    </div>
@endsection
