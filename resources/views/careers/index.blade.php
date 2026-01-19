@extends('layouts.app')

@section('title', 'Careers - CleanyCo')
@section('meta_description', 'Join CleanyCo — view current job openings and apply to be part of our team.')

@section('content')
<section class="page-header">
    <div class="container">
        <div class="page-header-content text-center">
            <h1>Careers</h1>
            <p>Join our growing team</p>
        </div>
    </div>
</section>
<section class="section">
    <div class="container">
        <div class="jobs-list">
            @foreach(($jobOpenings ?? []) as $job)
                <div class="type-card" style="margin-bottom:20px;">
                    <h3>{{ $job['title'] }}</h3>
                    <p><strong>Location:</strong> {{ $job['location'] }} | <strong>Type:</strong> {{ $job['type'] }}</p>
                    @php
                        $route = match($job['slug']) {
                            'executive-housekeeper' => route('careers.executive-housekeeper'),
                            'full-time-housekeeper' => route('careers.full-time-housekeeper'),
                            'inbound-sales-representative-and-customer-support' => route('careers.sales-representative'),
                            'team-leader' => route('careers.team-leader'),
                            default => '#'
                        };
                    @endphp
                    <p><a class="btn btn-primary" href="{{ $route }}">View Details</a></p>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endsection