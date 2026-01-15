@extends('layouts.master')

@section('title', 'Account Balance & Financial Summary')

@section('navbar-title', '💰 Balance & Financials')

@section('content')
<div style="display: grid; gap: 30px;">
    <!-- Top Summary Cards -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px;">
        <div style="background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.05); border-top: 4px solid #667eea;">
            <p style="color: #666; font-size: 14px; margin-bottom: 5px;">Total Cash Balance (Net)</p>
            <h2 style="color: #2c3e50;">${{ number_format($netBalance, 2) }}</h2>
            <p style="font-size: 12px; color: #999; margin-top: 10px;">Sales minus completed refunds</p>
        </div>

        <div style="background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.05); border-top: 4px solid #28a745;">
            <p style="color: #666; font-size: 14px; margin-bottom: 5px;">Total User Credit (Liability)</p>
            <h2 style="color: #2c3e50;">${{ number_format($totalUserCredit, 2) }}</h2>
            <p style="font-size: 12px; color: #999; margin-top: 10px;">Sum of all user wallet balances</p>
        </div>

        <div style="background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.05); border-top: 4px solid #ffc107;">
            <p style="color: #666; font-size: 14px; margin-bottom: 5px;">Max Credit Limit</p>
            <h2 style="color: #2c3e50;">$300.00</h2>
            <p style="font-size: 12px; color: #999; margin-top: 10px;">Default maximum allowed per user</p>
        </div>
    </div>

    <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 30px;">
        <!-- Balances per User Type -->
        <div style="background: white; padding: 25px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
            <h3 style="margin-bottom: 20px; color: #2c3e50; display: flex; align-items: center; gap: 10px;">
                👥 Account Balances per User Type
            </h3>
            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="text-align: left; background: #f8f9fa;">
                        <th style="padding: 12px; border-bottom: 1px solid #eee;">User Role</th>
                        <th style="padding: 12px; border-bottom: 1px solid #eee;">Total Combined Credit</th>
                        <th style="padding: 12px; border-bottom: 1px solid #eee;">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($balancesByRole as $row)
                    <tr style="border-bottom: 1px solid #fcfcfc;">
                        <td style="padding: 12px; font-weight: 600;">{{ ucfirst($row->role) }}</td>
                        <td style="padding: 12px;">${{ number_format($row->total_credit, 2) }}</td>
                        <td style="padding: 12px;">
                            <span style="background: #e7f3ff; color: #0056b3; padding: 3px 8px; border-radius: 12px; font-size: 12px;">Active</span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Quick Actions -->
        <div style="background: white; padding: 25px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
            <h3 style="margin-bottom: 20px; color: #2c3e50;">⚡ Quick Actions</h3>
            
            <div style="display: grid; gap: 15px;">
                <button onclick="document.getElementById('addCreditModal').style.display='flex'" style="background: #667eea; color: white; border: none; padding: 12px; border-radius: 5px; cursor: pointer; font-weight: 600; text-align: left; display: flex; align-items: center; gap: 10px;">
                    ➕ Add Credit to User
                </button>
                <a href="{{ route('admin.users.index') }}" style="background: #f8f9fa; color: #333; text-decoration: none; padding: 12px; border-radius: 5px; font-weight: 600; border: 1px solid #eee;">
                    👥 View All Users
                </a>
                <a href="{{ route('admin.revenue.financial') }}" style="background: #f8f9fa; color: #333; text-decoration: none; padding: 12px; border-radius: 5px; font-weight: 600; border: 1px solid #eee;">
                    📑 Financial Statements
                </a>
            </div>

            <div style="margin-top: 30px;">
                <h4 style="font-size: 14px; color: #666; margin-bottom: 15px;">Top Credit Holders</h4>
                @foreach($topCreditUsers as $user)
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px; padding-bottom: 10px; border-bottom: 1px dotted #eee;">
                    <div style="font-size: 13px;">
                        <div style="font-weight: 600;">{{ $user->name }}</div>
                        <div style="color: #999; font-size: 11px;">{{ $user->email }}</div>
                    </div>
                    <div style="font-weight: 700; color: #28a745;">
                        ${{ number_format($user->credit, 2) }}
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<!-- Simple Add Credit Modal (Placeholder logic) -->
<div id="addCreditModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 2000; justify-content: center; align-items: center;">
    <div style="background: white; padding: 30px; border-radius: 8px; width: 400px;">
        <h3 style="margin-bottom: 20px;">Add Credit to User</h3>
        <form action="{{ route('admin.users.add-credit', ['user' => '0']) }}" id="creditForm" method="POST">
            @csrf
            <div style="margin-bottom: 15px;">
                <label style="display: block; margin-bottom: 5px; font-size: 14px;">Select User</label>
                <select name="user_id" required style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;">
                    <option value="">-- Select User --</option>
                    @foreach($topCreditUsers as $u) <!-- Just using top users as sample for now -->
                    <option value="{{ $u->id }}">{{ $u->name }} (${{ $u->credit }})</option>
                    @endforeach
                </select>
            </div>
            <div style="margin-bottom: 20px;">
                <label style="display: block; margin-bottom: 5px; font-size: 14px;">Amount (USD)</label>
                <input type="number" name="amount" step="0.01" required style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;" placeholder="0.00">
            </div>
            <div style="display: flex; gap: 10px;">
                <button type="submit" style="background: #28a745; color: white; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer;">Confirm</button>
                <button type="button" onclick="document.getElementById('addCreditModal').style.display='none'" style="background: #eee; color: #333; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer;">Cancel</button>
            </div>
        </form>
    </div>
</div>

<script>
    document.getElementById('creditForm').addEventListener('submit', function(e) {
        const userId = this.querySelector('[name="user_id"]').value;
        if (userId) {
            this.action = this.action.replace('/0', '/' + userId);
        }
    });
</script>
@endsection
