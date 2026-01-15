@extends('layouts.master')

@section('title', 'Vouchers')

@section('navbar-title', '🎟️ Voucher Management')

@section('custom-css')
    .vouchers-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
    }

    .create-btn {
        background: linear-gradient(135deg, #28a745 0%, #1e7e34 100%);
        color: white;
        padding: 12px 20px;
        border-radius: 5px;
        text-decoration: none;
        font-weight: 600;
        transition: transform 0.3s;
    }

    .create-btn:hover {
        transform: translateY(-2px);
        color: white;
    }

    .vouchers-table {
        width: 100%;
        background: white;
        border-collapse: collapse;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .vouchers-table thead {
        background: #f8f9fa;
        border-bottom: 2px solid #dee2e6;
    }

    .vouchers-table th {
        padding: 15px;
        text-align: left;
        font-weight: 600;
        color: #333;
        font-size: 14px;
    }

    .vouchers-table td {
        padding: 15px;
        border-bottom: 1px solid #dee2e6;
        color: #666;
    }

    .vouchers-table tbody tr:hover {
        background: #f8f9fa;
    }

    .status-badge {
        display: inline-block;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
    }

    .status-active {
        background: #d4edda;
        color: #155724;
    }

    .status-inactive {
        background: #f8d7da;
        color: #721c24;
    }

    .status-expired {
        background: #e2e3e5;
        color: #383d41;
    }

    .action-buttons {
        display: flex;
        gap: 8px;
    }

    .btn-small {
        padding: 6px 12px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 12px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s;
        display: inline-block;
    }

    .btn-edit {
        background: #667eea;
        color: white;
    }

    .btn-edit:hover {
        background: #5568d3;
        color: white;
    }

    .btn-delete {
        background: #dc3545;
        color: white;
    }

    .btn-delete:hover {
        background: #c82333;
        color: white;
    }

    .empty-state {
        text-align: center;
        padding: 50px 20px;
        background: white;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .empty-state-icon {
        font-size: 60px;
        margin-bottom: 20px;
    }

    .empty-state h3 {
        color: #333;
        margin-bottom: 10px;
    }

    .empty-state p {
        color: #999;
        margin-bottom: 20px;
    }

    .success-message {
        background: #d4edda;
        color: #155724;
        padding: 12px;
        border-radius: 5px;
        margin-bottom: 20px;
        border: 1px solid #c3e6cb;
    }

    .pagination {
        display: flex;
        justify-content: center;
        gap: 5px;
        margin-top: 30px;
    }

    .pagination a, .pagination span {
        padding: 8px 12px;
        border: 1px solid #ddd;
        border-radius: 4px;
        text-decoration: none;
        color: #667eea;
    }

    .pagination a:hover {
        background: #667eea;
        color: white;
    }

    .pagination .active {
        background: #667eea;
        color: white;
        border-color: #667eea;
    }
@endsection

@section('content')
    @if (session('success'))
        <div class="success-message">
            ✅ {{ session('success') }}
        </div>
    @endif

    <div class="vouchers-header">
        <h2 style="color: #333; margin: 0;">All Vouchers</h2>
        <a href="{{ route('admin.vouchers.create') }}" class="create-btn">➕ Create New Voucher</a>
    </div>

    @if($vouchers->count() > 0)
        <table class="vouchers-table">
            <thead>
                <tr>
                    <th>Code</th>
                    <th>Name</th>
                    <th>Price (USD)</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Status</th>
                    <th>Used</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($vouchers as $voucher)
                    <tr>
                        <td>
                            <strong>{{ $voucher->code }}</strong>
                        </td>
                        <td>{{ $voucher->name }}</td>
                        <td>${{ number_format($voucher->price, 2) }}</td>
                        <td>{{ $voucher->start_date->format('M d, Y') }}</td>
                        <td>{{ $voucher->end_date->format('M d, Y') }}</td>
                        <td>
                            @if($voucher->isExpired())
                                <span class="status-badge status-expired">Expired</span>
                            @elseif($voucher->status === 'active')
                                <span class="status-badge status-active">Active</span>
                            @else
                                <span class="status-badge status-inactive">Inactive</span>
                            @endif
                        </td>
                        <td>{{ $voucher->usage_count }} times</td>
                        <td>
                            <div class="action-buttons">
                                <a href="{{ route('admin.vouchers.edit', $voucher->id) }}" class="btn-small btn-edit">✏️ Edit</a>
                                <form action="{{ route('admin.vouchers.destroy', $voucher->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-small btn-delete">🗑️ Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="pagination">
            {{ $vouchers->links() }}
        </div>
    @else
        <div class="empty-state">
            <div class="empty-state-icon">🎟️</div>
            <h3>No Vouchers Yet</h3>
            <p>You haven't created any vouchers. Click below to create your first one!</p>
            <a href="{{ route('admin.vouchers.create') }}" class="create-btn">➕ Create First Voucher</a>
        </div>
    @endif
@endsection
