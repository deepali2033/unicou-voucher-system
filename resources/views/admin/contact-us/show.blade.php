@extends('admin.layouts.app')

@section('title', 'Contact Submission Details')
@section('page-title', 'Contact Submission Details')

@section('page-actions')
<div class="d-flex gap-2">
    <a href="{{ route('admin.contact-us.index') }}" class="btn btn-t-g">
        <i class="fas fa-arrow-left me-2"></i>Back to Submissions
    </a>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card shadow-sm border-0 koa-tb-card bg-grey">
            <div class="card-header border-0 koa-card-header">
                <h3 class="card-title mb-0 text-dark fs-4 py-2">Message Details</h3>
            </div>
            <div class="card-body p-4 koa-tb-cnt">
                <div class="row mb-4">
                    <div class="col-sm-2"><strong>Subject:</strong></div>
                    <div class="col-sm-10">
                        <p class="fs-5 text-dark mb-0">{{ $contactUs->subject }}</p>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-sm-2"><strong>Message:</strong></div>
                    <div class="col-sm-10">
                        <div class="bg-light p-3 rounded">
                            <p class="mb-0 text-dark" style="white-space: pre-wrap;">{{ $contactUs->message }}</p>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-2"><strong>Submitted At:</strong></div>
                    <div class="col-sm-10">
                        <small class="text-muted">{{ $contactUs->created_at->format('F d, Y \a\t h:i A') }}</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card shadow-sm border-0 koa-tb-card bg-grey">
            <div class="card-header border-0 koa-card-header">
                <h3 class="card-title mb-0 text-dark fs-4 py-2">Contact Information</h3>
            </div>
            <div class="card-body p-4 koa-tb-cnt">
                <div class="row mb-3">
                    <div class="col-5"><strong>Name:</strong></div>
                    <div class="col-7">
                        <span class="text-dark">{{ $contactUs->name }}</span>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-5"><strong>Email:</strong></div>
                    <div class="col-7">
                        <a href="mailto:{{ $contactUs->email }}" class="text-decoration-none text-dark">
                            <i class="fas fa-envelope me-1"></i>
                            {{ $contactUs->email }}
                        </a>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-5"><strong>Phone:</strong></div>
                    <div class="col-7">
                        <a href="tel:{{ $contactUs->phone }}" class="text-decoration-none text-dark">
                            <i class="fas fa-phone me-1"></i>
                            {{ $contactUs->phone }}
                        </a>
                    </div>
                </div>

                @if($contactUs->user)
                <div class="row mb-3">
                    <div class="col-5"><strong>User:</strong></div>
                    <div class="col-7">
                        <a href="{{ route('admin.users.show', $contactUs->user->id) }}" class="text-decoration-none text-dark">
                            <i class="fas fa-user me-1"></i>
                            {{ $contactUs->user->name }}
                        </a>
                        <br>
                        <span class="badge koa-badge-green fw-normal px-3 py-2 mt-1">
                            {{ ucfirst($contactUs->user->account_type) }}
                        </span>
                    </div>
                </div>
                @else
                <div class="row mb-3">
                    <div class="col-5"><strong>User Status:</strong></div>
                    <div class="col-7">
                        <span class="badge koa-badge-light-grey fw-normal px-3 py-2">Guest User</span>
                    </div>
                </div>
                @endif
            </div>
        </div>

        <div class="card shadow-sm border-0 koa-tb-card mt-4 bg-grey">
            <div class="card-header border-0 koa-card-header">
                <h3 class="card-title mb-0 text-dark fs-4 py-2">Quick Actions</h3>
            </div>
            <div class="card-body p-4 koa-tb-cnt">
                <div class="d-grid gap-2">
                    <a href="mailto:{{ $contactUs->email }}" class="btn fw-medium px-4 py-2 koa-badge-green w-100">
                        <i class="fas fa-reply me-2"></i>Reply via Email
                    </a>
                    <form action="{{ route('admin.contact-us.destroy', $contactUs->id) }}"
                          method="POST"
                          onsubmit="return confirm('Are you sure you want to delete this contact submission?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn fw-medium px-4 py-2 koa-badge-red-outline w-100">
                            <i class="fas fa-trash me-2"></i>Delete Submission
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
