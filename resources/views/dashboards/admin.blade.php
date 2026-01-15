@extends('layouts.master')

@section('title', 'Admin Dashboard')

@section('navbar-title', '👨‍💼 Admin Dashboard')

@section('content')
    <div class="welcome">
        <h1>Welcome, {{ Auth::user()->name }}!</h1>
        <p>You are logged in as <strong>Administrator</strong></p>
    </div>
    
    <div class="dashboard-grid">
        <div class="card">
            <div class="card-icon">👥</div>
            <h3>User Management</h3>
            <p>Manage all system users, assign roles, and control permissions across the platform.</p>
        </div>
        
        <div class="card">
            <div class="card-icon">📊</div>
            <h3>System Analytics</h3>
            <p>View detailed analytics and reports about system usage and performance metrics.</p>
        </div>
        
        <div class="card">
            <div class="card-icon">⚙️</div>
            <h3>Settings</h3>
            <p>Configure system settings, email templates, and general application preferences.</p>
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
        
        <div class="card">
            <div class="card-icon">📞</div>
            <h3>Support Tickets</h3>
            <p>Review and manage all support tickets from across the organization.</p>
        </div>
    </div>
@endsection
