@extends('layouts.master')

@section('title', 'Support Dashboard')

@section('navbar-title', '🎧 Support Dashboard')

@section('custom-css')
    .navbar {
        background: linear-gradient(135deg, #fd7e14 0%, #e07000 100%);
    }
    
    .card h3 {
        color: #fd7e14;
    }
@endsection

@section('content')
    <div class="welcome">
        <h1>Welcome, {{ Auth::user()->name }}!</h1>
        <p>You are logged in as <strong>Support Staff</strong></p>
    </div>
    
    <div class="dashboard-grid">
        <div class="card">
            <div class="card-icon">📋</div>
            <h3>Support Requests</h3>
            <p>View all incoming support requests and assign them to appropriate agents.</p>
        </div>
        
        <div class="card">
            <div class="card-icon">🔍</div>
            <h3>Ticket Search</h3>
            <p>Search and track ticket history for better customer service insights.</p>
        </div>
        
        <div class="card">
            <div class="card-icon">📈</div>
            <h3>Team Statistics</h3>
            <p>Monitor overall team performance, ticket resolution times, and customer satisfaction.</p>
        </div>
        
        <div class="card">
            <div class="card-icon">🛠️</div>
            <h3>Issue Resolution</h3>
            <p>Help resolve escalated issues and provide technical support guidance.</p>
        </div>
        
        <div class="card">
            <div class="card-icon">📞</div>
            <h3>Customer Feedback</h3>
            <p>Review customer feedback and satisfaction ratings for continuous improvement.</p>
        </div>
        
        <div class="card">
            <div class="card-icon">⚙️</div>
            <h3>System Health</h3>
            <p>Monitor system status and resolve technical issues affecting service.</p>
        </div>
    </div>
@endsection
