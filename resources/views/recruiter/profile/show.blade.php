@extends('recruiter.layouts.app')

@section('title', 'My Profile')
@section('page-title', 'My Profile')

@section('page-actions')
<a href="{{ route('recruiter.dashboard') }}" class="btn btn-t-g">
    <i class="fas fa-arrow-left me-1"></i> Back to Dashboard
</a>
@endsection

@section('content')
<div class="row">

    <div class="col-12">
        <div class="card shadow-sm border-0 koa-tb-card" style="background-color: #f4f6f0;">
            <div class="card-header border-0 koa-card-header">
                <h5 class="card-title">Profile Information</h5>
            </div>
            <div class="card-body p-4 koa-tb-cnt">
                <form method="POST" action="{{ route('recruiter.profile.update') }}">
                    @csrf

                    <!-- Profile Information -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="name" name="name" value="{{ Auth::user()->name }}"  readonly>
                                @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    id="email" name="email" value="{{ Auth::user()->email }}" readonly>
                                @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Phone <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                        id="phone" name="phone" value="{{ old('phone', $user->phone) }}" required>
                                    @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Address Information -->
                    <div class="row">
                        <div class="col-12 ">
                            <div class="card shadow-sm border-0 koa-tb-card" style="background-color: #f4f6f0;">
                                <div class="card-header border-0 koa-card-header">
                                    <h5 class="card-title">Address Information</h5>
                                </div>
                                <div class="card-body p-4 koa-tb-cnt">
                                    <div class="row">
                                        <div class="col-12 mb-3">
                                            <label for="address" class="form-label">Street Address</label>
                                            <textarea class="form-control @error('address') is-invalid @enderror"
                                                id="address" name="address" rows="2">{{ old('address', $user->address) }}</textarea>
                                            @error('address')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="city" class="form-label">City</label>
                                            <input type="text" class="form-control @error('city') is-invalid @enderror"
                                                id="city" name="city" value="{{ old('city', $user->city) }}">
                                            @error('city')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="state" class="form-label">State</label>
                                            <input type="text" class="form-control @error('state') is-invalid @enderror"
                                                id="state" name="state" value="{{ old('state', $user->state) }}">
                                            @error('state')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="zip_code" class="form-label">ZIP Code</label>
                                            <input type="text" class="form-control @error('zip_code') is-invalid @enderror"
                                                id="zip_code" name="zip_code" value="{{ old('zip_code', $user->zip_code) }}">
                                            @error('zip_code')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between gap-3">
                        <a href="{{ route('recruiter.dashboard') }}" class="btn koa-badge-green-outline fw-medium px-4 py-2">
                            <i class="fas fa-times me-2"></i>Cancel
                        </a>
                        <button type="submit" class="btn koa-badge-green fw-medium px-4 py-2">
                            <i class="fas fa-save me-2"></i>Update Profile
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
