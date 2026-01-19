@extends('layouts.app')

@section('title', 'Short-Term Rentals Cleaning - CleanyCo')
@section('meta_description', 'Fast, reliable cleaning tailored for short-term rentals and hosts.')

@section('content')
<section class="page-header">
    <div class="container">
        <div class="page-header-content text-center">
            <h1>Short-Term Rentals</h1>
            <p>Turnover services that keep your listing competitive</p>
        </div>
    </div>
</section>
<section class="section service-details">
    <div class="container">
        <div class="row">
            <div class="col service-content">
                <h2>Services for Hosts</h2>
                <ul>
                    <li>Flexible scheduling and rapid response</li>
                    <li>Inventory checks and restocking</li>
                    <li>Damage reporting</li>
                </ul>
            </div>
            <div class="col service-sidebar">
                <div class="pricing-card">
                    <h3>Get a Quote</h3>
                    <a href="{{ route('quote.index') }}" class="btn btn-primary">Get Free Quote</a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection