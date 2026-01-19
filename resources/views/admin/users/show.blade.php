@extends('admin.layouts.app')

@section('title', 'View User')
@section('page-title', 'User Details: ' . $user->name)

@section('page-actions')
<div class="d-flex gap-2">
    <!-- <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-t-y">
        <i class="fas fa-edit me-2"></i>Edit User
    </a> -->
    <a href="{{ route('admin.users.index') }}" class="btn btn-t-g">
        <i class="fas fa-arrow-left me-2"></i>Back to Users
    </a>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card shadow-sm border-0 koa-tb-card bg-grey">
            <div class="card-header border-0 koa-card-header">
                <h3 class="card-title mb-0 text-dark fs-4 py-2">User Information</h3>
            </div>
            <div class="card-body p-4 koa-tb-cnt">
                <div class="row mb-3">
                    <div class="col-sm-3"><strong>Name:</strong></div>
                    <div class="col-sm-9 text-dark">{{ $user->name }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-3"><strong>Email:</strong></div>
                    <div class="col-sm-9 text-dark">{{ $user->email }}</div>
                </div>
                @if($user->phone)
                <div class="row mb-3">
                    <div class="col-sm-3"><strong>Phone Number:</strong></div>
                    <div class="col-sm-9 text-dark">{{ $user->phone }}</div>
                </div>
                @endif
                @if($user->company_name)
                <div class="row mb-3">
                    <div class="col-sm-3"><strong>Company Name:</strong></div>
                    <div class="col-sm-9 text-dark">{{ $user->company_name }}</div>
                </div>
                @endif
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card shadow-sm border-0 koa-tb-card bg-grey">
            <div class="card-header border-0 koa-card-header">
                <h3 class="card-title mb-0 text-dark fs-4 py-2">User Details</h3>
            </div>
            <div class="card-body p-4 koa-tb-cnt">
                <div class="row mb-2">
                    <div class="col-6"><strong>Account Type:</strong></div>
                    <div class="col-6">
                        <span class="badge fw-normal px-3 py-2 text-nowrap
                        @if($user->account_type === 'admin') koa-badge-green
                        @elseif($user->account_type === 'recruiter') koa-badge-yellow
                        @elseif($user->account_type === 'freelancer') koa-badge-yellow
                        @elseif($user->account_type === 'User') koa-badge-yellow
                        @else badge-secondary
                        @endif">
                            <!-- {{ ucfirst($user->account_type ?? 'User')  }} -->
                        </span>
                    </div>
                </div>

                <!-- <div class="row mb-2">
                    <div class="col-6"><strong></strong>Profile Status:</strong></div>
                    <div class="col-6">
                        <span class="badge fw-normal px-3 py-2 text-nowrap
                        @if($user->profile_verification_status === 'verified') koa-badge-green
                        @elseif($user->profile_verification_status === 'pending') koa-badge-yellow
                        @else koa-badge-red-outline
                        @endif">
                            {{ ucfirst($user->profile_verification_status) }}
                        </span>
                    </div>
                </div> -->

                <div class="row mb-2">
                    <div class="col-6"><strong>Email Status:</strong></div>
                    <div class="col-6">
                        <span class="badge fw-normal px-3 py-2 text-nowrap
                        @if($user->email_verified_at) koa-badge-green
                        @else koa-badge-red-outline
                        @endif">
                            {{ $user->email_verified_at ? 'Email Approved' : 'Email Disapproved' }}
                        </span>
                    </div>
                </div>

                <div class="row mb-2">
                    <div class="col-6"><strong>Created:</strong></div>
                    <div class="col-6">
                        <small class="text-muted">{{ $user->created_at->format('M d, Y H:i') }}</small>
                    </div>
                </div>

                <div class="row mb-2">
                    <div class="col-6"><strong>Updated:</strong></div>
                    <div class="col-6">
                        <small class="text-muted">{{ $user->updated_at->format('M d, Y H:i') }}</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow-sm border-0 koa-tb-card mt-4 bg-grey">
            <div class="card-header border-0 koa-card-header">
                <h3 class="card-title mb-0 text-dark fs-4 py-2">Quick Actions</h3>
            </div>
            <div class="card-body p-4 koa-tb-cnt">
                <div class="d-grid gap-2">
                    @if($user->profile_verification_status === 'pending')
                    <form action="{{ route('admin.users.verify-profile', $user) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn fw-medium px-4 py-2 koa-badge-green w-100">
                            <i class="fas fa-check me-2"></i>Verify Profile
                        </button>
                    </form>

                    <form action="{{ route('admin.users.reject-profile', $user) }}" method="POST"
                        onsubmit="return handleReject(this)">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="notes" id="rejection-notes">
                        <button type="submit" class="btn fw-medium px-4 py-2 koa-badge-red-outline w-100">
                            <i class="fas fa-times me-2"></i>Reject Profile
                        </button>
                    </form>

                    <script>
                        function handleReject(form) {
                            var reason = prompt('Please provide a reason for rejection:');
                            if (reason !== null && reason.trim() !== '') {
                                form.querySelector('#rejection-notes').value = reason;
                                return true;
                            }
                            return false;
                        }
                    </script>
                    @endif

                    <!-- <a href="{{ route('admin.users.edit', $user) }}" class="btn fw-medium px-4 py-2 koa-badge-green w-100">
                        <i class="fas fa-edit me-2"></i>Edit User
                    </a> -->

                    <!-- <form action="{{ route('admin.users.destroy', $user) }}" method="POST"
                        onsubmit="return confirm('Are you sure you want to delete this user? This action cannot be undone.')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn fw-medium px-4 py-2 koa-badge-red-outline w-100">
                            <i class="fas fa-trash me-2"></i>Delete User
                        </button>
                    </form> -->

                    @if($user->email_verified_at)
                    <form action="{{ route('admin.users.disapprove-email', $user) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn fw-medium px-4 py-2 koa-badge-yellow w-100">
                            <i class="fas fa-times me-2"></i>Disapprove Email
                        </button>
                    </form>
                    @else
                    <form action="{{ route('admin.users.approve-email', $user) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn fw-medium px-4 py-2 koa-badge-green w-100">
                            <i class="fas fa-check me-2"></i>Approve Email
                        </button>
                    </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
