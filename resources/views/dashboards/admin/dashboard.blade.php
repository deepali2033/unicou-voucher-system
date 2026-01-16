@extends('layouts.master')

@section('title', 'Admin Dashboard')

@section('navbar-title', '👨‍💼 Admin Dashboard')

@section('content')
    <div class="welcome">
        <h1>Welcome, {{ Auth::user()->name }}!</h1>
        <p>You are logged in as <strong>Administrator</strong></p>
    </div>

    <style>
        .stats-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        .stat-box {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
            border-left: 5px solid #667eea;
        }
        .stat-box h4 { color: #666; font-size: 14px; margin-bottom: 10px; }
        .stat-box .value { font-size: 24px; font-weight: 700; color: #333; }
        .stat-warning { border-left-color: #dc3545; }
        .stat-success { border-left-color: #28a745; }
    </style>

    <div class="stats-row">
        <div class="stat-box stat-success">
            <h4>Total Revenue</h4>
            <div class="value">${{ number_format($stats['total_revenue'], 2) }}</div>
        </div>
        <div class="stat-box">
            <h4>Monthly Income</h4>
            <div class="value">${{ number_format($stats['monthly_revenue'], 2) }}</div>
        </div>
        <div class="stat-box">
            <h4>Today's Income</h4>
            <div class="value">${{ number_format($stats['daily_revenue'], 2) }}</div>
        </div>
        <div class="stat-box {{ $stats['low_stock_vouchers'] > 0 ? 'stat-warning' : '' }}">
            <h4>Low Stock Alerts</h4>
            <div class="value">{{ $stats['low_stock_vouchers'] }}</div>
        </div>
    </div>
    
    <div class="dashboard-grid">
        <div class="card">
            <div class="card-icon">👥</div>
            <h3>User Management</h3>
            <p>Manage all system users, assign roles, and control permissions across the platform.</p>
        </div>
        
        <div class="card">
            <div class="card-icon">🎟️</div>
            <h3>Voucher Management</h3>
            <p>Create, edit, and manage vouchers for your business.</p>
        </div>
        
        <div class="card">
            <div class="card-icon">📊</div>
            <h3>System Analytics</h3>
            <p>View detailed analytics and reports about system usage and performance metrics.</p>
        </div>
        
        <div class="card">
            <div class="card-icon">💰</div>
            <h3>Financial Reports</h3>
            <p>Manage refunds, credits, and financial transactions.</p>
        </div>
        
        <div class="card">
            <div class="card-icon">🔐</div>
            <h3>Security</h3>
            <p>Monitor security logs, manage access tokens, and handle security configurations.</p>
        </div>
        
        <div class="card">
            <div class="card-icon">📋</div>
            <h3>Audit Logs</h3>
            <p>View comprehensive audit logs of all user activities and system changes.</p>
        </div>
    </div>
@endsection
