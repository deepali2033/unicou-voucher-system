@extends('admin.layouts.app')

@section('title', 'Job Listings')
@section('page-title', 'Job Listings')

@section('page-actions')
    <!-- <a href="{{ route('admin.jobs.create') }}" class="btn btn-t-y">
        <i class="fas fa-plus me-1"></i> Add New Job
    </a> -->
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm border-0 koa-tb-card">
                <div class="card-header border-0">
                    <div class="d-flex justify-content-between align-items-center p-3">
                        <h5 class="card-title mb-0 text-dark fs-4">All Job Listings</h5>
                        <div class="card-tools d-flex align-items-center gap-3">
                            <!-- <a href="{{ route('admin.analytics') }}" class="btn btn-outline-primary btn-sm">
                                <i class="fas fa-chart-bar me-1"></i>
                                Reports & Analytics
                            </a> -->
                            <span class="badge koa-badge-green fw-bold px-3 py-2">
                                {{ $jobs->total() }} Total Jobs
                            </span>
                        </div>
                    </div>
                </div>
                <div class="card-body p-4 koa-tb-cnt">
                    <!-- Search and Filter Form -->
                    <form method="GET" action="{{ route('admin.jobs.index') }}" class="mb-4">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-0">
                                        <i class="fas fa-search text-muted"></i>
                                    </span>
                                    <input type="text"
                                           name="search"
                                           class="form-control border-0 bg-light"
                                           placeholder="Search by title or category..."
                                           value="{{ request('search') }}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <select name="employment_type" class="form-select border-0 bg-light">
                                    <option value="">All Employment Types</option>
                                    @foreach(\App\Models\JobListing::getEmploymentTypes() as $key => $label)
                                        <option value="{{ $key }}" {{ request('employment_type') == $key ? 'selected' : '' }}>
                                            {{ $label }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <select name="status" class="form-select border-0 bg-light">
                                    <option value="">All Status</option>
                                    <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                                    <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <div class="d-flex gap-2">
                                    <button type="submit" class="btn koa-badge-green fw-medium px-3">
                                        <i class="fas fa-filter me-1"></i>Filter
                                    </button>
                                    @if(request()->hasAny(['search', 'employment_type', 'status']))
                                        <a href="{{ route('admin.jobs.index') }}" class="btn btn-outline-secondary px-3" title="Clear filters">
                                            <i class="fas fa-times"></i>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </form>

                    @if(request()->hasAny(['search', 'employment_type', 'status']))
                        <div class="alert alert-info d-flex align-items-center mb-3" role="alert">
                            <i class="fas fa-info-circle me-2"></i>
                            <div>
                                Showing filtered results
                                @if(request('search'))
                                    for "<strong>{{ request('search') }}</strong>"
                                @endif
                                @if(request('employment_type'))
                                    with employment type "<strong>{{ \App\Models\JobListing::getEmploymentTypes()[request('employment_type')] }}</strong>"
                                @endif
                                @if(request('status'))
                                    with status "<strong>{{ ucfirst(request('status')) }}</strong>"
                                @endif
                                ({{ $jobs->total() }} {{ Str::plural('result', $jobs->total()) }} found)
                            </div>
                        </div>
                    @endif

                    @if($jobs->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover table-borderless align-middle">
                                <thead class="koa-thead">
                                    <tr>
                                        <th class="ps-4">Title</th>
                                        <th>Category</th>
                                        <th>Location</th>
                                        <th>Employment Type</th>
                                        <th>Salary Range</th>
                                        <th>Status</th>
                                        <th>Featured</th>
                                        <th class="text-end pe-4">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($jobs as $job)
                                        <tr style="transition: background-color 0.2s;">
                                            <td class="ps-4">
                                                <div>
                                                    <strong class="text-dark">{{ $job->title }}</strong>
                                                    <br>
                                                    @if($job->image)
                                                    <img src="{{ asset('storage/' . $job->image) }}" alt="{{ $job->title }}" style="width: 100px; height: auto;">
                                                    @endif
                                                    <small class="text-muted">{{ Str::limit($job->short_description, 50) }}</small>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="badge koa-badge-light-green fw-normal px-3 py-2">
                                                    {{ $job->category }}
                                                </span>
                                            </td>
                                            <td class="text-muted">
                                                {{ $job->location ?: 'Not specified' }}
                                            </td>
                                            <td>
                                                <span class="badge koa-badge-light-green fw-normal px-3 py-2">
                                                    {{ ucfirst(str_replace('-', ' ', $job->employment_type)) }}
                                                </span>
                                            </td>
                                            <td class="text-muted">
                                                {{ $job->salary_range }}
                                            </td>
                                            <td>
                                                <form action="{{ route('admin.jobs.toggle-status', $job) }}" method="POST"
                                                    class="d-inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit"
                                                        class="btn btn-sm fw-medium rounded-pill text-nowrap px-3 {{ $job->is_active ? 'koa-badge-green' : 'koa-badge-green-outline' }}">
                                                        <i class="fas {{ $job->is_active ? 'fa-check' : 'fa-times' }} me-1"></i>
                                                        {{ $job->is_active ? 'Active' : 'Inactive' }}
                                                    </button>
                                                </form>
                                            </td>
                                            <td>
                                                <form action="{{ route('admin.jobs.toggle-featured', $job) }}" method="POST"
                                                    class="d-inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit"
                                                        class="btn btn-sm fw-medium rounded-pill text-nowrap px-3 {{ $job->is_featured ? 'koa-badge-yellow' : 'koa-badge-yellow-outline' }}">
                                                        <i class="fas fa-star me-1"></i>
                                                        {{ $job->is_featured ? 'Featured' : 'Not Featured' }}
                                                    </button>
                                                </form>
                                            </td>
                                            <td class="text-end pe-4">
                                                <div class="btn-group" role="group" style="gap: 8px;">
                                                    <a href="{{ route('admin.jobs.show', $job) }}"
                                                        class="btn btn-sm rounded-circle action-btns koa-badge-light-green"
                                                        title="View">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <!-- <a href="{{ route('admin.jobs.edit', $job) }}"
                                                        class="btn btn-sm rounded-circle action-btns koa-badge-green" title="Edit">
                                                        <i class="fas fa-edit"></i>
                                                    </a> -->
                                                    <!-- <form action="{{ route('admin.jobs.destroy', $job) }}" method="POST"
                                                        class="d-inline"
                                                        onsubmit="return confirm('Are you sure you want to delete this job listing?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="btn btn-sm rounded-circle action-btns koa-badge-red-outline"
                                                            title="Delete">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form> -->
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="d-flex justify-content-center mt-4">
                            {{ $jobs->links('pagination::bootstrap-5') }}
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-briefcase fa-3x text-muted mb-3"></i>
                            @if(request()->hasAny(['search', 'employment_type', 'status']))
                                <h5 class="text-dark">No Job Listings Found</h5>
                                <p class="text-muted">Try adjusting your search or filter criteria.</p>
                                <a href="{{ route('admin.jobs.index') }}" class="btn btn-outline-secondary">
                                    <i class="fas fa-times me-2"></i>Clear Filters
                                </a>
                            @else
                                <h5 class="text-dark">No Job Listings Found</h5>
                                <p class="text-muted">Get started by creating your first job listing.</p>
                                <a href="{{ route('admin.jobs.create') }}" class="btn fw-medium px-4 py-2"
                                    style="background-color: #3ca200; color: #fff;">
                                    <i class="fas fa-plus me-2"></i>Add New Job
                                </a>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
