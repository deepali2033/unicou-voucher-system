@extends('admin.layouts.app')

@section('title', 'Users Management')
@section('page-title', 'Users Management')

@section('page-actions')
    <!-- <a href="{{ route('admin.users.create') }}" class="btn btn-t-y">
        <i class="fas fa-plus me-2"></i>Add New User
    </a> -->
@endsection

@section('content')
    <div class="card shadow-sm border-0 koa-tb-card">
        <div class="card-header border-0">
            <div class="d-flex justify-content-between align-items-center p-3">
                <h3 class="card-title mb-0 text-dark fs-4">All Users</h3>
                <div class="card-tools d-flex align-items-center gap-3">
                    <!-- <a href="{{ route('admin.analytics') }}" class="btn btn-outline-primary btn-sm">
                        <i class="fas fa-chart-bar me-1"></i>
                        Reports & Analytics
                    </a> -->
                    <span class="badge koa-badge-green fw-bold px-3 py-2">
                        {{ $users->total() }} Total users
                    </span>
                </div>
            </div>
        </div>
        <div class="card-body p-4 koa-tb-cnt">
            <!-- Search and Filter Form -->
            <form method="GET" action="{{ route('admin.users.index') }}" class="mb-4">
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="input-group">
                            <span class="input-group-text bg-light border-0">
                                <i class="fas fa-search text-muted"></i>
                            </span>
                            <input type="text"
                                   name="search"
                                   class="form-control border-0 bg-light"
                                   placeholder="Search by name or email..."
                                   value="{{ request('search') }}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <select name="account_type" class="form-select border-0 bg-light">
                            <option value="">All Account Types</option>
                            <option value="user" {{ request('account_type') == 'user' ? 'selected' : '' }}>User</option>
                            <option value="freelancer" {{ request('account_type') == 'freelancer' ? 'selected' : '' }}>Freelancer</option>
                            <option value="recruiter" {{ request('account_type') == 'recruiter' ? 'selected' : '' }}>Recruiter</option>
                            <option value="admin" {{ request('account_type') == 'admin' ? 'selected' : '' }}>Admin</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn koa-badge-green fw-medium px-3">
                                <i class="fas fa-filter me-1"></i>Filter
                            </button>
                            @if(request()->hasAny(['search', 'account_type']))
                                <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary px-3" title="Clear filters">
                                    <i class="fas fa-times"></i>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </form>

            @if(request()->hasAny(['search', 'account_type']))
                <div class="alert alert-info d-flex align-items-center mb-3" role="alert">
                    <i class="fas fa-info-circle me-2"></i>
                    <div>
                        Showing filtered results
                        @if(request('search'))
                            for "<strong>{{ request('search') }}</strong>"
                        @endif
                        @if(request('account_type'))
                            with account type "<strong>{{ ucfirst(request('account_type')) }}</strong>"
                        @endif
                        ({{ $users->total() }} {{ Str::plural('result', $users->total()) }} found)
                    </div>
                </div>
            @endif

            @if($users->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover table-borderless align-middle">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Account Type</th>
                                <th>Verification Status</th>
                                <th class="text-end pe-4">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>
                                        <div>
                                            <strong class="text-dark">{{ $user->first_name }} {{ $user->last_name }}</strong>
                                            @if($user->company_name)
                                                <br>
                                                <small class="text-muted">{{ Str::limit($user->company_name, 50) }}</small>
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        <span class="text-dark fw-medium">{{ $user->email }}</span>
                                    </td>
                                    <td>
                                        @if($user->phone)
                                            <span class="badge koa-badge-light-green fw-normal px-3 py-2">
                                                {{ $user->phone }}
                                            </span>
                                        @else
                                            <span class="text-muted">N/A</span>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="badge
                                            @if($user->account_type === 'admin') koa-badge-yellow
                                            @elseif($user->account_type === 'recruiter') koa-badge-light-green
                                            @elseif($user->account_type === 'freelancer')koa-badge-light-green
                                            @else koa-badge-light-green @endif
                                            fw-normal px-3 py-2">
                                            {{ ucfirst($user->account_type ?? 'user') }}
                                        </span>
                                    </td>
                                    <td>
                                        @if($user->account_type === 'freelancer')
                                            <span class="badge
                                                @if($user->profile_verification_status === 'verified') koa-badge-green
                                                @elseif($user->profile_verification_status === 'pending') koa-badge-yellow
                                                @elseif($user->profile_verification_status === 'rejected') koa-badge-red
                                                @else koa-badge-light-grey @endif
                                                fw-normal px-3 py-2">
                                                @if($user->profile_verification_status === 'verified') Verified
                                                @elseif($user->profile_verification_status === 'pending') Pending
                                                @elseif($user->profile_verification_status === 'rejected') Rejected
                                                @else Unverified @endif
                                            </span>
                                        @else
                                            <span class="text-muted">N/A</span>
                                        @endif
                                    </td>
                                    <td class="text-end">
                                        <div class="btn-group" role="group" aria-label="User actions">
                                            <a href="{{ route('admin.users.show', $user) }}"
                                               class="btn btn-sm rounded-circle action-btns koa-badge-light-green"
                                               title="View">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <!-- <a href="{{ route('admin.users.edit', $user) }}"
                                               class="btn btn-sm btn-primary" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a> -->
                                            @if($user->id !== auth()->id())
                                                <!-- <form action="{{ route('admin.users.destroy', $user) }}"
                                                      method="POST" class="d-inline"
                                                      onsubmit="return confirm('Are you sure you want to delete this user?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" title="Delete">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form> -->
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-center mt-4">
                    {{ $users->links('pagination::bootstrap-5') }}
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-users fa-3x text-muted mb-3"></i>
                    @if(request()->hasAny(['search', 'account_type']))
                        <h4 class="text-dark">No Users Found</h4>
                        <p class="text-muted">Try adjusting your search or filter criteria.</p>
                        <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-times me-2"></i>Clear Filters
                        </a>
                    @else
                        <h4 class="text-dark">No Users Found</h4>
                        <!-- <p class="text-muted">Get started by creating your first user.</p> -->
                        <!-- <a href="{{ route('admin.users.create') }}" class="btn fw-medium px-4 py-2"
                            style="background-color: #3ca200; color: #fff;">
                            <i class="fas fa-plus me-2"></i>Add Your First User
                        </a> -->
                    @endif
                </div>
            @endif
        </div>
    </div>
@endsection
