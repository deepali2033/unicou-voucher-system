@extends('layouts.master')

@section('title', 'Seller Agent Dashboard')

@section('navbar-title', '🤝 Seller Agent Dashboard')

@section('custom-css')
    .navbar {
        background: linear-gradient(135deg, #ae3ec9 0%, #862e9c 100%);
    }
    
    .card h3 {
        color: #ae3ec9;
    }
@endsection

@section('content')
    <div class="welcome">
        <h1>Welcome, {{ Auth::user()->name }}!</h1>
        <p>You are logged in as <strong>Seller Agent</strong></p>
    </div>
    
    <div class="dashboard-grid">
        <div class="card">
            <div class="card-icon">💰</div>
            <h3>Total Sales</h3>
            <p>Monitor your sales performance and total revenue generated.</p>
        </div>
        
        <div class="card">
            <div class="card-icon">📈</div>
            <h3>Commission</h3>
            <p>Track your earned commissions and pending payouts.</p>
        </div>
        
        <div class="card">
            <div class="card-icon">🎟️</div>
            <h3>My Vouchers</h3>
            <p>Manage and distribute your assigned vouchers.</p>
        </div>
        
        <div class="card">
            <div class="card-icon">👥</div>
            <h3>My Referrals</h3>
            <p>View your referral network and conversion rates.</p>
        </div>
        
        <div class="card">
            <div class="card-icon">📢</div>
            <h3>Campaigns</h3>
            <p>Access active marketing campaigns and promotional tools.</p>
        </div>
        
        <div class="card">
            <div class="card-icon">📄</div>
            <h3>Reports</h3>
            <p>Generate detailed reports on your sales activities.</p>
        </div>
    </div>
@endsection
