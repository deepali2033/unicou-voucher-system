@extends('layouts.app')

@section('title', 'Service Areas - CleanyCo')
@section('meta_description', 'Explore CleanyCo service areas including Atlanta, Boston, Chicago, and New York City.')

@section('content')
<section class="page-header">
    <div class="container">
        <div class="page-header-content text-center">
            <h1>Service Areas</h1>
            <p>We proudly serve major metropolitan areas</p>
        </div>
    </div>
</section>
<section class="section">
    <div class="container">
        <div class="areas-grid">
            <div class="area-card">
                <h4><a href="{{ route('service-areas.atlanta') }}">Atlanta, GA</a></h4>
            </div>
            <div class="area-card">
                <h4><a href="{{ route('service-areas.boston') }}">Boston, MA</a></h4>
            </div>
            <div class="area-card">
                <h4><a href="{{ route('service-areas.chicago') }}">Chicago, IL</a></h4>
            </div>
            <div class="area-card">
                <h4><a href="{{ route('service-areas.new-york-city') }}">New York City, NY</a></h4>
            </div>
        </div>
    </div>
</section>
@endsection