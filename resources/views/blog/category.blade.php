@extends('layouts.app')

@section('title', 'Category - ' . (ucwords(str_replace('-', ' ', request()->segment(3))) ?? 'Blog') . ' - CleanyCo')
@section('meta_description', 'Browse blog posts by category at CleanyCo.')

@section('content')
<section class="page-header">
    <div class="container">
        <div class="page-header-content text-center">
            <h1>Category: {{ ucwords(str_replace('-', ' ', request()->segment(3))) }}</h1>
        </div>
    </div>
</section>
<section class="section">
    <div class="container">
        <p>Category posts listing.</p>
    </div>
</section>
@endsection