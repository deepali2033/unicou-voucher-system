@extends('layouts.app')

@section('title', $blog->meta_title ?: $blog->name . ' - KOA Service')
@section('meta_description', $blog->meta_description ?: $blog->short_description)

@section('content')
    <article id="post-39" class="full post-39 page type-page status-publish has-post-thumbnail hentry">
        <div data-elementor-type="single-page" data-elementor-id="3642"
            class="elementor elementor-3642 elementor-location-single post-39 page type-page status-publish has-post-thumbnail hentry"
            data-elementor-post-type="elementor_library">
            <div class="elementor-element elementor-element-e16be9f e-con-full e-flex e-con e-parent" data-id="e16be9f"
                data-element_type="container">
                <div class="elementor-element elementor-element-a5cd914 margin-set e-flex e-con-boxed e-con e-child"
                    data-id="a5cd914" data-element_type="container"
                    data-settings="{&quot;background_background&quot;:&quot;gradient&quot;}">
                    <div class="e-con-inner">
                        <div class="elementor-element elementor-element-1e29583 e-con-full e-flex e-con e-child"
                            data-id="1e29583" data-element_type="container">
                            <!-- Main Blog Content -->
                            <div class="">

                                <!-- Blog Meta -->
                                <div class="d-flex align-items-center mb-3 text-muted">
                                    <small class="me-3 elementor-post-info__terms-list">
                                        <a>
                                            <i class="far fa-calendar-alt me-1"></i>
                                            {{ $blog->published_at ? $blog->published_at->format('F j, Y') : $blog->created_at->format('F j, Y') }}
                                        </a>

                                    </small>
                                    {{-- <small>
                                        <i class="far fa-comments me-1"></i>
                                        0 Comments
                                    </small> --}}
                                </div>

                                <!-- Blog Title -->
                                <h1 class=" mb-4" style="font-size: 2rem;">
                                    {{ $blog->title }}
                                </h1>

                                <!-- Featured Image -->
                                @if($blog->featured_image)
                                    <div class="mb-4">

                                        <img loading="lazy" decoding="async" width="400" height="250"
                                            src="{{ asset($blog->featured_image) }}" class="img-fluid rounded shadow-sm w-100"
                                            style="object-fit: cover; height: 400px;" alt="{{ $blog->title ?? 'Blog Image' }}"
                                            onerror="this.onerror=null;this.src='{{ asset('images/default-blog.jpg') }}';">
                                    </div>

                                @endif

                                <!-- Blog Content -->
                                <div class="blog-content mb-4">
                                    {!! $blog->content !!}
                                </div>

                                <!-- Tags & Share Section -->
                                {{-- <div
                                    class="d-flex flex-wrap align-items-center justify-content-between border-top pt-3 mt-4">
                                    <div class="mb-3">
                                        @if($blog->tags)
                                        @foreach(explode(',', $blog->tags) as $tag)
                                        <span class="badge bg-light text-dark border me-2 mb-2">#{{ trim($tag) }}</span>
                                        @endforeach
                                        @endif
                                    </div>
                                    <div class="d-flex align-items-center gap-2">
                                        <span class="text-muted small fw-bold">Share:</span>
                                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}"
                                            target="_blank" class="text-primary"><i class="fab fa-facebook-f"></i></a>
                                        <a href="https://twitter.com/intent/tweet?url={{ url()->current() }}&text={{ urlencode($blog->title) }}"
                                            target="_blank" class="text-info"><i class="fab fa-twitter"></i></a>
                                        <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ url()->current() }}"
                                            target="_blank" class="text-primary"><i class="fab fa-linkedin-in"></i></a>
                                        <a href="https://wa.me/?text={{ urlencode($blog->title . ' ' . url()->current()) }}"
                                            target="_blank" class="text-success"><i class="fab fa-whatsapp"></i></a>
                                    </div>
                                </div> --}}

                            </div>

                        </div>
                        <div class="elementor-element elementor-element-fbcdb4c e-con-full e-flex e-con e-child"
                            data-id="fbcdb4c" data-element_type="container">


                            <!-- Sidebar -->
                            <div class="">
                                <div class="p-4 bg-light rounded shadow-sm">
                                    <h5 class=" mb-3">Recent Posts</h5>

                                    @php
                                        $recentBlogs = \App\Models\Blog::where('is_active', true)
                                            ->latest('published_at')
                                            ->take(5)
                                            ->get();
                                    @endphp

                                    @foreach($recentBlogs as $recent)
                                        <a href="{{ route('blog.show', $recent->slug) }}"
                                            class="text-decoration-none recent-blog-item">
                                            <div class="d-flex align-items-center mb-3 border-bottom pb-3">
                                                <div class="me-3" style="width: 60px; height: 60px; flex-shrink: 0;">
                                                    <img loading="lazy" decoding="async" width="400" height="250"
                                                        src="{{ asset($recent->featured_image) }}" class="img-fluid rounded"
                                                        style="object-fit: cover; width: 60px; height: 60px;"
                                                        alt="{{ $recent->title ?? 'Blog Image' }}"
                                                        onerror="this.onerror=null;this.src='{{ asset('images/default-blog.jpg') }}';">
                                                </div>
                                                <div>
                                                    <div class="fw-semibold text-dark mb-1">
                                                        {{ Str::limit($recent->title, 60) }}
                                                    </div>
                                                    <small
                                                        class="text-muted">{{ $recent->published_at?->format('F j, Y') }}</small>
                                                </div>
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </article>
@endsection

@push('styles')
    <!-- Service-specific Elementor styles -->
    <link rel='stylesheet' id='elementor-post-39-css'
        href='{{ asset("wp-content/uploads/elementor/css/post-39.css") }}?ver=1752678329' type='text/css' media='all'>
    <link rel='stylesheet' id='elementor-post-142-css'
        href='{{ asset("wp-content/uploads/elementor/css/post-142.css") }}?ver=1752677976' type='text/css' media='all'>
    <link rel='stylesheet' id='elementor-post-1007-css'
        href='{{ asset("wp-content/uploads/elementor/css/post-1007.css") }}?ver=1752677976' type='text/css' media='all'>
    <link rel='stylesheet' id='elementor-post-3642-css'
        href='{{ asset("wp-content/uploads/elementor/css/post-3642.css") }}?ver=1752677976' type='text/css' media='all'>
    <link rel='stylesheet' id='elementor-post-156-css'
        href='{{ asset("wp-content/uploads/elementor/css/post-156.css") }}?ver=1752677977' type='text/css' media='all'>

    <!-- Recent Blog Items Hover Effects -->
    <style>
        .recent-blog-item {
            transition: all 0.3s ease;
            border-radius: 8px;
            display: block;
        }

        .recent-blog-item:hover {
            background-color: rgba(40, 167, 69, 0.05);
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .recent-blog-item:hover .fw-semibold {
            color: #28a745 !important;
        }

        .recent-blog-item:hover img {
            transform: scale(1.05);
            transition: transform 0.3s ease;
        }

        .recent-blog-item img {
            transition: transform 0.3s ease;
        }

        .recent-blog-item .border-bottom {
            border: none !important;
        }

        .recent-blog-item .border-bottom:hover {
            border-bottom: 1px solid #dee2e6 !important;
        }
    </style>

    <!-- Dynamic background image for service hero section -->
    @if($blog->image && file_exists(public_path('storage/' . $blog->image)))
        <style id="service-{{ $blog->id }}-dynamic-styles">
            .elementor-3642 .elementor-element.elementor-element-e0d0d06:not(.elementor-motion-effects-element-type-background),
            .elementor-3642 .elementor-element.elementor-element-e0d0d06>.elementor-motion-effects-container>.elementor-motion-effects-layer {
                background-image: url("{{ asset('storage/' . $blog->image) }}");
            }
        </style>
    @endif
@endpush