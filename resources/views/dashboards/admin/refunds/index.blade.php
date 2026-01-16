@extends('layouts.master')

@section('title', 'Refund Management')

@section('navbar-title', '💰 Refund Management')

@section('custom-css')
    .refunds-table {
        width: 100%;
        background: white;
        border-collapse: collapse;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }
    .refunds-table th, .refunds-table td {
        padding: 15px;
        text-align: left;
        border-bottom: 1px solid #eee;
    }
    .status-badge {
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
    }
    .status-pending { background: #fff3cd; color: #856404; }
    .status-approved { background: #d4edda; color: #155724; }
    .status-rejected { background: #f8d7da; color: #721c24; }
    
    .action-btn {
        padding: 6px 12px;
        border-radius: 4px;
        font-size: 12px;
        font-weight: 600;
        cursor: pointer;
        border: none;
        transition: all 0.2s;
    }
    .btn-approve { background: #28a745; color: white; }
    .btn-reject { background: #dc3545; color: white; }
@endsection

@section('content')
    <div style="margin-bottom: 25px;">
        <h2>Refund Requests</h2>
    </div>

    @if(session('success'))
        <div style="background: #d4edda; color: #155724; padding: 15px; border-radius: 8px; margin-bottom: 20px;">
            {{ session('success') }}
        </div>
    @endif

    <table class="refunds-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>User</th>
                <th>Transaction</th>
                <th>Amount</th>
                <th>Reason</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($refunds as $refund)
                <tr>
                    <td>#{{ $refund->id }}</td>
                    <td>
                        <strong>{{ $refund->user->name }}</strong><br>
                        <small>{{ $refund->user->email }}</small>
                    </td>
                    <td>
                        Type: {{ ucfirst($refund->transaction->type) }}<br>
                        Date: {{ $refund->transaction->created_at->format('M d, Y') }}
                    </td>
                    <td style="font-weight: 700; color: #dc3545;">
                        ${{ number_format($refund->amount, 2) }}
                    </td>
                    <td style="max-width: 250px;">{{ $refund->reason }}</td>
                    <td>
                        <span class="status-badge status-{{ $refund->status }}">
                            {{ ucfirst($refund->status) }}
                        </span>
                    </td>
                    <td>
                        @if($refund->status === 'pending')
                            <div style="display: flex; gap: 5px;">
                                <form action="{{ route('admin.refunds.approve', $refund->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="action-btn btn-approve">Approve</button>
                                </form>
                                <button type="button" class="action-btn btn-reject" onclick="toggleRejectForm({{ $refund->id }})">Reject</button>
                            </div>
                            
                            <div id="reject-form-{{ $refund->id }}" style="display: none; margin-top: 10px;">
                                <form action="{{ route('admin.refunds.reject', $refund->id) }}" method="POST">
                                    @csrf
                                    <input type="text" name="admin_note" placeholder="Rejection reason..." required style="padding: 5px; width: 150px; border: 1px solid #ddd; border-radius: 4px; font-size: 11px;">
                                    <button type="submit" class="action-btn btn-reject">Submit</button>
                                </form>
                            </div>
                        @else
                            <small>{{ $refund->admin_note }}</small>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" style="text-align: center; padding: 30px;">No refund requests found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div style="margin-top: 20px;">
        {{ $refunds->links() }}
    </div>

    <script>
        function toggleRejectForm(id) {
            const form = document.getElementById('reject-form-' + id);
            form.style.display = form.style.display === 'none' ? 'block' : 'none';
        }
    </script>
@endsection
