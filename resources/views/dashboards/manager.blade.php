@extends('layouts.master')

@section('title', 'Manager Dashboard')

@section('navbar-title', '📊 Manager Dashboard')

@section('custom-css')
    .navbar {
        background: linear-gradient(135deg, #17a2b8 0%, #138496 100%);
    }
    
    .card h3 {
        color: #17a2b8;
    }
@endsection

@section('content')
    <div class="welcome">
        <h1>Welcome, {{ Auth::user()->name }}!</h1>
        <p>You are logged in as <strong>Manager</strong></p>
    </div>
    
    <div class="dashboard-grid">
        <div class="card">
            <div class="card-icon">👥</div>
            <h3>Team Management</h3>
            <p>View and manage your team members, assign tasks, and monitor performance.</p>
        </div>
        
        <div class="card">
            <div class="card-icon">📈</div>
            <h3>Team Analytics</h3>
            <p>Track team performance metrics, productivity reports, and individual achievements.</p>
        </div>
        
        <div class="card">
            <div class="card-icon">📋</div>
            <h3>Task Management</h3>
            <p>Create, assign, and track tasks for your team members with progress updates.</p>
        </div>
        
        <div class="card">
            <div class="card-icon">💼</div>
            <h3>Project Overview</h3>
            <p>Monitor project status, deadlines, and team allocation across projects.</p>
        </div>
        
        <div class="card">
            <div class="card-icon">📞</div>
            <h3>Support Tickets</h3>
            <p>Review and manage support tickets assigned to your team.</p>
        </div>
        
        <div class="card">
            <div class="card-icon">📅</div>
            <h3>Team Calendar</h3>
            <p>View team schedules, leave requests, and important dates at a glance.</p>
        </div>
    </div>
@endsection
