@extends('admin.layouts.app')

@section('title', $job->title)
@section('page-title', $job->title)

@section('page-actions')
    <div class="d-flex gap-2">
    <a href="{{ route('admin.jobs.index') }}" class="btn btn-t-g">
        <i class="fas fa-arrow-left me-1"></i> Back to Jobs
    </a>
    <!-- <a href="{{ route('admin.jobs.edit', $job) }}" class="btn btn-t-y">
        <i class="fas fa-edit me-1"></i> Edit Job
    </a> -->
    <!-- <form action="{{ route('admin.jobs.destroy', $job) }}" method="POST" class="d-inline"
        onsubmit="return confirm('Are you sure you want to delete this job listing?')">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-t-r">
            <i class="fas fa-trash me-1"></i> Delete
        </button>
    </form> -->
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card shadow-sm border-0 koa-tb-card bg-grey">
                <div class="card-header border-0 koa-card-header">
                    <h5 class="card-title mb-0 text-dark fs-4 py-2">Job Details</h5>
                </div>
                <div class="card-body p-4 koa-tb-cnt">
                    <div class="mb-4">
                        <h3>{{ $job->title }}</h3>
                        @if($job->image)
                        <img src="{{ asset('storage/' . $job->image) }}" alt="{{ $job->title }}" style="width: 100%; max-height: 300px; object-fit: cover; margin-bottom: 15px;">
                        @endif
                        <div class="d-flex flex-wrap gap-2 mb-3">
                            <span class="badge koa-badge-blue text-nowrap fw-normal ">{{ $job->category }}</span>
                            <span
                                class="badge koa-badge-green-outline text-nowrap fw-normal ">{{ ucfirst(str_replace('-', ' ', $job->employment_type)) }}</span>
                            @if($job->is_featured)
                                <span class="badge koa-badge-yellow text-nowrap fw-normal "><i
                                        class="fas fa-star me-1"></i>Featured</span>
                            @endif
                            <span
                                class="badge {{ $job->is_active ? 'koa-badge-green' : 'koa-badge-red-outline' }} text-nowrap fw-normal ">
                                {{ $job->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </div>
                    </div>

                    <div class="mb-4">
                        <h5>Short Description</h5>
                        <p class="text-muted">{{ $job->short_description }}</p>
                    </div>

                    <div class="mb-4">
                        <h5>Full Description</h5>
                        <div class="border p-3 rounded bg-white">
                            {!! nl2br(e($job->description)) !!}
                        </div>
                    </div>

                    @if($job->requirements && count($job->requirements) > 0)
                        <div class="mb-4">
                            <h5>Requirements</h5>
                            <ul class="list-group list-group-flush">
                                @foreach($job->requirements as $requirement)
                                    <li class="list-group-item px-0" style="background-color: transparent;">
                                        <i class="fas fa-check-circle text-green me-2"></i>
                                        {{ $requirement }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if($job->benefits && count($job->benefits) > 0)
                        <div class="mb-4">
                            <h5>Benefits</h5>
                            <ul class="list-group list-group-flush">
                                @foreach($job->benefits as $benefit)
                                    <li class="list-group-item px-0" style="background-color: transparent;">
                                        <i class="fas fa-gift text-green me-2"></i>
                                        {{ $benefit }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm border-0 koa-tb-card" style="background-color: #f4f6f0;">
                <div class="card-header border-0 koa-card-header">
                    <h5 class="card-title">Job Information</h5>
                </div>
                <div class="card-body p-4 koa-tb-cnt">
                    <div class="mb-3">
                        <strong>Location:</strong>
                        <div>{{ $job->location ?: 'Not specified' }}</div>
                    </div>

                    <div class="mb-3">
                        <strong>Employment Type:</strong>
                        <div>{{ ucfirst(str_replace('-', ' ', $job->employment_type)) }}</div>
                    </div>

                    <div class="mb-3">
                        <strong>Salary:</strong>
                        <div>{{ $job->salary_range }}</div>
                    </div>

                    @if($job->application_deadline)
                        <div class="mb-3">
                            <strong>Application Deadline:</strong>
                            <div>{{ $job->application_deadline->format('M d, Y') }}</div>
                        </div>
                    @endif

                    @if($job->contact_email)
                        <div class="mb-3">
                            <strong>Contact Email:</strong>
                            <div><a class="text-green text-decoration-none" href="mailto:{{ $job->contact_email }}">{{ $job->contact_email }}</a></div>
                        </div>
                    @endif

                    @if($job->contact_phone)
                        <div class="mb-3">
                            <strong>Contact Phone:</strong>
                            <div><a class="text-green text-decoration-none" href="tel:{{ $job->contact_phone }}">{{ $job->contact_phone }}</a></div>
                        </div>
                    @endif

                    <div class="mb-3">
                        <strong>Sort Order:</strong>
                        <div>{{ $job->sort_order }}</div>
                    </div>

                    <div class="mb-3">
                        <strong>Created:</strong>
                        <div>{{ $job->created_at->format('M d, Y g:i A') }}</div>
                    </div>

                    <div class="mb-3">
                        <strong>Last Updated:</strong>
                        <div>{{ $job->updated_at->format('M d, Y g:i A') }}</div>
                    </div>
                </div>
            </div>

            @if($job->meta_title || $job->meta_description)
                <div class="card shadow-sm border-0 koa-tb-card mt-3" style="background-color: #f4f6f0;">
                    <div class="card-header border-0 koa-card-header">
                        <h5 class="card-title">SEO Information</h5>
                    </div>
                    <div class="card-body p-4 koa-tb-cnt">
                        @if($job->meta_title)
                            <div class="mb-3">
                                <strong>Meta Title:</strong>
                                <div>{{ $job->meta_title }}</div>
                            </div>
                        @endif

                        @if($job->meta_description)
                            <div class="mb-3">
                                <strong>Meta Description:</strong>
                                <div>{{ $job->meta_description }}</div>
                            </div>
                        @endif
                    </div>
                </div>
            @endif

            <div class="card shadow-sm border-0 koa-tb-card mt-3" style="background-color: #f4f6f0;">
                <div class="card-header border-0 koa-card-header">
                    <h5 class="card-title">Quick Actions</h5>
                </div>
                <div class="card-body p-4 koa-tb-cnt">
                    <form action="{{ route('admin.jobs.toggle-status', $job) }}" method="POST" class="mb-2">
                        @csrf
                        @method('PATCH')
                        <button type="submit"
                            class="btn koa-badge-green fw-medium w-100 {{ $job->is_active ? 'koa-badge-red-outline' : 'koa-badge-green' }}">
                            {{ $job->is_active ? 'Deactivate' : 'Activate' }} Job
                        </button>
                    </form>

                    <form action="{{ route('admin.jobs.toggle-featured', $job) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <button type="submit"
                            class="btn koa-badge-yellow fw-medium w-100 {{ $job->is_featured ? 'koa-badge-yellow-outline' : 'koa-badge-yellow' }}">
                            {{ $job->is_featured ? 'Remove from Featured' : 'Mark as Featured' }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
