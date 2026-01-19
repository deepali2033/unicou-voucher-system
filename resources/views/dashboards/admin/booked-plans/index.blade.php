@extends('admin.layouts.app')

@section('title', 'Booked Plans Management')
@section('page-title', 'Booked Plans Management')

@section('content')
    <div class="card shadow-sm border-0 koa-tb-card">
        <div class="card-header border-0">
            <div class="d-flex justify-content-between align-items-center p-3">
                <h3 class="card-title mb-0 text-dark fs-4">All Booked Plans</h3>
                <div class="card-tools d-flex align-items-center gap-3">
                    <span class="badge koa-badge-green fw-bold px-3 py-2">
                        {{ $bookedPlans->total() }} Total Bookings
                    </span>
                </div>
            </div>
        </div>

        <!-- Search and Filter Section -->
        <div class="card-body border-bottom p-4" style="background-color: #f8f9fa;">
            <form method="GET" action="{{ route('admin.booked-plans.index') }}" class="row g-3">
                <div class="col-md-3">
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0">
                            <i class="fas fa-user text-muted"></i>
                        </span>
                        <input type="text"
                               name="user_search"
                               class="form-control border-start-0"
                               placeholder="Search by user name..."
                               value="{{ request('user_search') }}"
                               style="border-left: none !important;">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0">
                            <i class="fas fa-wallet text-muted"></i>
                        </span>
                        <input type="text"
                               name="plan_search"
                               class="form-control border-start-0"
                               placeholder="Search by plan name..."
                               value="{{ request('plan_search') }}"
                               style="border-left: none !important;">
                    </div>
                </div>
                <div class="col-md-2">
                    <select name="status" class="form-select">
                        <option value="">All Status</option>
                        <option value="success" {{ request('status') === 'success' ? 'selected' : '' }}>Success</option>
                        <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="failed" {{ request('status') === 'failed' ? 'selected' : '' }}>Failed</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <select name="payment_method" class="form-select">
                        <option value="">All Payment Methods</option>
                        <option value="credit_card" {{ request('payment_method') === 'credit_card' ? 'selected' : '' }}>Credit Card</option>
                        <option value="paypal" {{ request('payment_method') === 'paypal' ? 'selected' : '' }}>PayPal</option>
                        <option value="bank_transfer" {{ request('payment_method') === 'bank_transfer' ? 'selected' : '' }}>Bank Transfer</option>
                        <option value="cash" {{ request('payment_method') === 'cash' ? 'selected' : '' }}>Cash</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn koa-badge-green fw-medium px-3">
                            <i class="fas fa-filter me-1"></i>Filter
                        </button>
                        @if(request()->hasAny(['user_search', 'plan_search', 'status', 'payment_method']))
                            <a href="{{ route('admin.booked-plans.index') }}" class="btn btn-outline-secondary fw-medium px-3">
                                <i class="fas fa-times me-1"></i>Clear
                            </a>
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row g-2">
                        <!-- <div class="col-6">
                            <input type="date"
                                   name="date_from"
                                    class="form-control"
                                    placeholder="From Date"
                                    value="{{ request('date_from') }}">
                        </div> -->
                        <!-- <div class="col-6">
                            <input type="date"
                                   name="date_to"
                                    class="form-control"
                                    placeholder="To Date"
                                    value="{{ request('date_to') }}">
                        </div> -->
                    </div>
                </div>
            </form>
        </div>

        <div class="card-body p-4 koa-tb-cnt">
            @if($bookedPlans->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover table-borderless align-middle">
                        <thead>
                            <tr>
                                <th class="ps-4">User Name</th>
                                <th>Plan Name</th>
                                <th>Amount</th>
                                <th>Payment Method</th>
                                <th>Transaction ID</th>
                                <th>Booking Date</th>
                                <th>Status</th>
                                <th class="text-end pe-4">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($bookedPlans as $booking)
                                <tr>
                                    <td class="ps-4">
                                        <div class="d-flex align-items-center">
                                            <div class="rounded-circle d-flex align-items-center justify-content-center me-3"
                                                style="width: 40px; height: 40px; background-color: #E8F5D3;">
                                                <i class="fas fa-user text-success"></i>
                                            </div>
                                            <div>
                                                <strong class="text-dark">{{ $booking->user->name }}</strong>
                                                <br>
                                                <small class="text-muted">{{ $booking->user->email }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <strong class="text-dark">{{ $booking->plan->name }}</strong>
                                            <br>
                                            <small class="text-muted">{{ Str::limit($booking->plan->description, 30) }}</small>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge koa-badge-light-green fw-normal px-3 py-2">
                                            {{ $booking->formatted_amount }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="text-capitalize">
                                            {{ str_replace('_', ' ', $booking->payment_method) }}
                                        </span>
                                    </td>
                                    <td>
                                        @if($booking->transaction_id)
                                            <code class="bg-light px-2 py-1 rounded">{{ $booking->transaction_id }}</code>
                                        @else
                                            <span class="text-muted">N/A</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div>
                                            <strong>{{ $booking->formatted_booking_date }}</strong>
                                            <br>
                                            <small class="text-muted">{{ $booking->booking_date->diffForHumans() }}</small>
                                        </div>
                                    </td>
                                    <td>
                                        @php
                                            $statusClasses = [
                                                'success' => 'koa-badge-green',
                                                'pending' => 'koa-badge-yellow',
                                                'failed' => 'koa-badge-red'
                                            ];
                                            $statusIcons = [
                                                'success' => 'fa-check',
                                                'pending' => 'fa-clock',
                                                'failed' => 'fa-times'
                                            ];
                                        @endphp
                                        <span class="btn btn-sm fw-medium rounded-pill text-nowrap px-3 {{ $statusClasses[$booking->status] }}">
                                            <i class="fas {{ $statusIcons[$booking->status] }} me-1"></i>
                                            {{ ucfirst($booking->status) }}
                                        </span>
                                    </td>
                                    <td class="text-end pe-4">
                                        <div class="btn-group" role="group" style="gap: 8px;">
                                            <a href="{{ route('admin.booked-plans.show', $booking) }}"
                                                class="btn btn-sm rounded-circle action-btns koa-badge-light-green" title="View Details">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            @if($booking->status === 'pending')
                                                <form action="{{ route('admin.booked-plans.update-status', $booking) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="hidden" name="status" value="success">
                                                    <button type="submit" class="btn btn-sm rounded-circle action-btns koa-badge-green"
                                                            title="Mark as Success"
                                                            onclick="return confirm('Mark this booking a s successful?')">
                                                        <i class="fas fa-check"></i>
                                                    </button>
                                                </form>
                                                <form action="{{ route('admin.booked-plans.update-status', $booking) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="hidden" name="status" value="failed">
                                                    <button type="submit" class="btn btn-sm rounded-circle action-btns koa-badge-red-outline"
                                                            title="Mark as Failed"
                                                            onclick="return confirm('Mark this booking as failed?') ">
                                                        <i class="fas fa-times"></i>
                                                    </button>
                                                </form>
                                            @endif
                                            <form action="{{ route('admin.booked-plans.destroy', $booking) }}" method="POST"
                                                class="d-inline"
                                                onsubmit="return confirm('Are you sure you want to delete this booking record?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm rounded-circle action-btns koa-badge-red-outline"
                                                    title="Delete">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-center mt-4">
                    {{ $bookedPlans->links('pagination::bootstrap-5') }}
                </div>
            @else
                <div class="text-center py-5">
                    @if(request()->hasAny(['user_search', 'plan_search', 'status', 'payment_method', 'date_from', 'date_to']))
                        <i class="fas fa-search fa-3x text-muted mb-3"></i>
                        <h4 class="text-dark">No Bookings Match Your Search</h4>
                        <p class="text-muted">
                            Try adjusting your search criteria or
                            <a href="{{ route('admin.booked-plans.index') }}" class="text-decoration-none">clear all filters</a>
                        </p>
                    @else
                        <i class="fas fa-tasks fa-3x text-muted mb-3"></i>
                        <h4 class="text-dark">No Booked Plans Found</h4>
                        <p class="text-muted">No users have booked any plans yet. Bookings will appear here once users start purchasing plans.</p>
                    @endif
                </div>
            @endif
        </div>
    </div>
@endsection
