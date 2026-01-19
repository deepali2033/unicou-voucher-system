@extends('user.layouts.app')

@section('title', 'Received Applications')
@section('page-title', 'Received Applications')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h2>Received Job Applications</h2>
            </div>
        </div>
    </div>

    <!-- Filter Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-body">
                    <form method="GET" action="{{ route('user.applications.index') }}" class="row g-3">
                        <div class="col-md-4">
                            <label for="search" class="form-label">Search</label>
                            <input type="text" class="form-control" id="search" name="search"
                                   value="{{ request('search') }}" placeholder="Search by name, job title...">
                        </div>
                        <div class="col-md-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" id="status" name="status">
                                <option value="">All Statuses</option>
                                @foreach($statuses as $key => $label)
                                    <option value="{{ $key }}" {{ request('status') == $key ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3 d-flex align-items-end">
                            <button type="submit" class="btn btn-primary me-2">Filter</button>
                            <a href="{{ route('user.applications.index') }}" class="btn btn-outline-secondary">Clear</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Applications List -->
    <div class="row">
        @if($applications->count() > 0)
            @foreach($applications as $application)
                <div class="col-lg-6 col-xl-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <h5 class="card-title mb-0">{{ $application->freelancer->name }}</h5>
                                <span class="badge {{ $application->status_badge }}">
                                    {{ ucfirst(str_replace('_', ' ', $application->status)) }}
                                </span>
                            </div>

                            <div class="mb-2">
                                <strong>Job:</strong> {{ $application->jobListing->title }}
                            </div>

                            <div class="mb-2">
                                <strong>Applied:</strong> {{ $application->created_at->format('M d, Y') }}
                                <small class="text-muted">({{ $application->created_at->diffForHumans() }})</small>
                            </div>

                            @if($application->candidate)
                                <div class="mb-2">
                                    <strong>Email:</strong> {{ $application->candidate->email }}
                                </div>
                                @if($application->candidate->phone)
                                    <div class="mb-2">
                                        <strong>Phone:</strong> {{ $application->candidate->phone }}
                                    </div>
                                @endif
                            @endif

                            <div class="mt-3 d-flex justify-content-between">
                                <a href="{{ route('user.applications.show', $application) }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-eye"></i> View Details
                                </a>

                                @if($application->status !== 'rejected' && $application->status !== 'selected')
                                    <div class="dropdown">
                                        <button class="btn btn-outline-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                            Update Status
                                        </button>
                                        <ul class="dropdown-menu">
                                            @foreach($statuses as $key => $label)
                                                @if($key !== $application->status)
                                                    <li>
                                                        <form method="POST" action="{{ route('user.applications.update-status', $application) }}">
                                                            @csrf
                                                            @method('PATCH')
                                                            <input type="hidden" name="status" value="{{ $key }}">
                                                            <button type="submit" class="dropdown-item">{{ $label }}</button>
                                                        </form>
                                                    </li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="col-12">
                <div class="alert alert-info text-center">
                    <i class="fas fa-info-circle me-2"></i>
                    No applications received yet. Applications will appear here when freelancers apply to your job postings.
                </div>
            </div>
        @endif
    </div>

    <!-- Pagination -->
    @if($applications->hasPages())
        <div class="row mt-4">
            <div class="col-12 d-flex justify-content-center">
                {{ $applications->withQueryString()->links() }}
            </div>
        </div>
    @endif
</div>
@endsection
