@extends('admin.layouts.app')

@section('title', 'Edit Notification')
@section('page-title', 'Edit Notification')

@section('page-actions')
    <a href="{{ route('admin.notifications.index') }}" class="btn btn-outline-secondary">
        <i class="fas fa-arrow-left me-2"></i>Back to Notifications
    </a>
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm border-0">
                <div class="card-header" style="background-color: #f8f9fa;">
                    <h5 class="mb-0 text-dark">Edit Notification Details</h5>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('admin.notifications.update', $notification) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="title" class="form-label fw-semibold">Title <span class="text-danger">*</span></label>
                            <input type="text"
                                   class="form-control @error('title') is-invalid @enderror"
                                   id="title"
                                   name="title"
                                   value="{{ old('title', $notification->title) }}"
                                   required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label fw-semibold">Description <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('description') is-invalid @enderror"
                                      id="description"
                                      name="description"
                                      rows="4"
                                      required>{{ old('description', $notification->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="type" class="form-label fw-semibold">Type</label>
                            <select class="form-select @error('type') is-invalid @enderror" id="type" name="type">
                                <option value="">None</option>
                                <option value="user" {{ old('type', $notification->type) == 'user' ? 'selected' : '' }}>User</option>
                                <option value="service" {{ old('type', $notification->type) == 'service' ? 'selected' : '' }}>Service</option>
                                <option value="job" {{ old('type', $notification->type) == 'job' ? 'selected' : '' }}>Job</option>
                                <option value="plan" {{ old('type', $notification->type) == 'plan' ? 'selected' : '' }}>Plan</option>
                            </select>
                            @error('type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="is_read" name="is_read" value="1"
                                       {{ old('is_read', $notification->is_read) ? 'checked' : '' }}>
                                <label class="form-check-label fw-semibold" for="is_read">
                                    Mark as Read
                                </label>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center">
                            <a href="{{ route('admin.notifications.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-times me-2"></i>Cancel
                            </a>
                            <button type="submit" class="btn btn-t-g">
                                <i class="fas fa-save me-2"></i>Update Notification
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Notification Preview -->
            <div class="card shadow-sm border-0 mt-4">
                <div class="card-header" style="background-color: #f8f9fa;">
                    <h5 class="mb-0 text-dark">Current Notification Info</h5>
                </div>
                <div class="card-body">
                    <table class="table table-borderless mb-0">
                        <tr>
                            <th width="30%">Created:</th>
                            <td>{{ $notification->created_at->format('M d, Y \a\t g:i A') }}</td>
                        </tr>
                        <tr>
                            <th>Last Updated:</th>
                            <td>{{ $notification->updated_at->format('M d, Y \a\t g:i A') }}</td>
                        </tr>
                        <tr>
                            <th>Action Type:</th>
                            <td>
                                @if($notification->action)
                                    <span class="badge bg-info">{{ ucfirst($notification->action) }}</span>
                                @else
                                    <span class="text-muted">N/A</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Related ID:</th>
                            <td>{{ $notification->related_id ?? 'N/A' }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
