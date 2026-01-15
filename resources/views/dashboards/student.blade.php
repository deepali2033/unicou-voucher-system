@extends('layouts.master')

@section('title', 'Student Dashboard')

@section('navbar-title', '🎓 Student Dashboard')

@section('custom-css')
    .navbar {
        background: linear-gradient(135deg, #20c997 0%, #087f5b 100%);
    }
    
    .card h3 {
        color: #20c997;
    }
@endsection

@section('content')
    <div class="welcome">
        <h1>Welcome, {{ Auth::user()->name }}!</h1>
        <p>You are logged in as <strong>Student</strong></p>
    </div>
    
    <div class="dashboard-grid">
        <div class="card">
            <div class="card-icon">📚</div>
            <h3>My Courses</h3>
            <p>Access your enrolled courses and learning materials.</p>
        </div>
        
        <div class="card">
            <div class="card-icon">📝</div>
            <h3>Assignments</h3>
            <p>View and submit your pending assignments and projects.</p>
        </div>
        
        <div class="card">
            <div class="card-icon">📊</div>
            <h3>My Progress</h3>
            <p>Track your learning journey and performance statistics.</p>
        </div>
        
        <div class="card">
            <div class="card-icon">🏅</div>
            <h3>Certificates</h3>
            <p>View and download your earned course certificates.</p>
        </div>
        
        <div class="card">
            <div class="card-icon">💬</div>
            <h3>Discussion</h3>
            <p>Interact with mentors and fellow students in the forum.</p>
        </div>
        
        <div class="card">
            <div class="card-icon">📅</div>
            <h3>Schedule</h3>
            <p>View your upcoming classes and live sessions.</p>
        </div>
    </div>
@endsection
