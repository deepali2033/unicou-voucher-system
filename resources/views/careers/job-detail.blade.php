@extends('layouts.app')

@section('title', ($job['title'] ?? 'Job') . ' - CleanyCo')
@section('meta_description', 'Apply for the ' . ($job['title'] ?? 'job') . ' position at CleanyCo.')

@section('content')
<section class="page-header">
    <div class="container">
        <div class="page-header-content text-center">
            <h1>{{ $job['title'] ?? 'Job Opening' }}</h1>
            <p>{{ $job['location'] ?? '' }} &middot; {{ $job['type'] ?? '' }}</p>
        </div>
    </div>
</section>
<section class="section">
    <div class="container">
        <div class="type-card">
            <p><strong>Salary:</strong> {{ $job['salary'] ?? '' }}</p>
            <h3>Description</h3>
            <p>{{ $job['description'] ?? '' }}</p>
            <h3>Requirements</h3>
            <ul>
                @foreach(($job['requirements'] ?? []) as $req)
                    <li>{{ $req }}</li>
                @endforeach
            </ul>
        </div>
    </div>
</section>
@endsection