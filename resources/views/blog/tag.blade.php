@extends('layouts.app')

@section('title', 'Tag - ' . (ucwords(str_replace('-', ' ', request()->segment(3))) ?? 'Blog') . ' - CleanyCo')
@section('meta_description', 'Browse blog posts by tag at CleanyCo.')

@section('content')
<section class="page-header">
    <div class="container">
        <div class="page-header-content text-center">
            <h1>Tag: {{ ucwords(str_replace('-', ' ', request()->segment(3))) }}</h1>
        </div>
    </div>
</section>
<section class="section">
    <div class="container">
        <p>Tag posts listing.</p>
    </div>
</section>
@endsection