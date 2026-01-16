@extends('layouts.master')

@section('title', 'Financial Statements')

@section('navbar-title', '📈 Financial Statements')

@section('content')
<div style="background: white; padding: 25px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
    <h3 style="color: #2c3e50; margin-bottom: 20px;">Monthly Revenue Summary</h3>

    <table style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr style="text-align: left; background: #f8f9fa;">
                <th style="padding: 12px; border-bottom: 1px solid #eee;">Month</th>
                <th style="padding: 12px; border-bottom: 1px solid #eee;">Total Sales Revenue</th>
                <th style="padding: 12px; border-bottom: 1px solid #eee;">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($monthlyRevenue as $row)
            <tr style="border-bottom: 1px solid #fcfcfc;">
                <td style="padding: 12px; font-weight: 600;">{{ Carbon\Carbon::parse($row->month . '-01')->format('F Y') }}</td>
                <td style="padding: 12px;">${{ number_format($row->total, 2) }}</td>
                <td style="padding: 12px;">
                    <span style="background: #e7f3ff; color: #0056b3; padding: 3px 10px; border-radius: 12px; font-size: 12px;">Finalized</span>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="3" style="padding: 20px; text-align: center; color: #999;">No financial data available yet.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    
    <div style="margin-top: 30px; padding: 20px; background: #fffaf0; border-radius: 8px; border-left: 4px solid #ed8936;">
        <h4 style="margin: 0 0 10px 0; color: #9c4221;">💡 Financial Reporting Note</h4>
        <p style="margin: 0; font-size: 14px; color: #7b341e;">
            These figures represent gross sales revenue from completed voucher purchases. 
            Refunds and credit additions are tracked separately in their respective modules.
        </p>
    </div>
</div>
@endsection
