@extends('layouts.master')

@section('title', 'Agent Dashboard')

@section('navbar-title', '👤 Agent Dashboard')

@section('custom-css')
    .navbar {
        background: linear-gradient(135deg, #28a745 0%, #1e7e34 100%);
    }
    
    .card h3 {
        color: #28a745;
    }
@endsection

@section('content')
    <div class="welcome">
        <h1>Welcome, {{ Auth::user()->name }}!</h1>
        <p>You are logged in as <strong>Agent</strong></p>
    </div>
    
    <div class="dashboard-grid">
        <div class="card">
            <div class="card-icon">📞</div>
            <h3>Active Tickets</h3>
            <p>View and respond to your active support tickets and customer inquiries.</p>
        </div>
        
        <div class="card">
            <div class="card-icon">💬</div>
            <h3>Customer Chat</h3>
            <p>Engage in real-time conversations with customers for quick support.</p>
        </div>
        
        <div class="card">
            <div class="card-icon">📊</div>
            <h3>My Performance</h3>
            <p>Track your personal performance metrics, ticket resolution rates, and ratings.</p>
        </div>
        
        <div class="card">
            <div class="card-icon">📝</div>
            <h3>Knowledge Base</h3>
            <p>Access helpful articles and solutions for common customer issues.</p>
        </div>
        
        <div class="card">
            <div class="card-icon">⏰</div>
            <h3>Shift Schedule</h3>
            <p>View your work schedule, breaks, and upcoming shifts.</p>
        </div>
        
        <div class="card">
            <div class="card-icon">🎓</div>
            <h3>Training Materials</h3>
            <p>Access training resources and documentation for product knowledge.</p>
        </div>
    </div>
@endsection
