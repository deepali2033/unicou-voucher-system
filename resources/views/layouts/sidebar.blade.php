<aside style="width: 250px; background: #2c3e50; color: white; padding: 20px; height: calc(100vh - 60px); overflow-y: auto; position: fixed; left: 0; top: 60px;">
    <nav>
        <div style="margin-bottom: 30px;">
            <h4 style="color: #ecf0f1; margin: 0 0 15px 0; font-size: 12px; text-transform: uppercase; font-weight: 600; letter-spacing: 1px;">Main Menu</h4>
            
            @if(Auth::user()->role === 'admin')
                <a href="/admin/dashboard" style="display: block; padding: 12px 15px; color: white; text-decoration: none; border-radius: 5px; margin-bottom: 8px; transition: background 0.3s; background: rgba(255, 255, 255, 0.1);">
                    📊 Dashboard
                </a>
                <a href="{{ route('profile.index') }}" style="display: block; padding: 12px 15px; color: white; text-decoration: none; border-radius: 5px; margin-bottom: 8px; transition: background 0.3s;">
                    👤 My Profile
                </a>
                <a href="{{ route('notifications.index') }}" style="display: block; padding: 12px 15px; color: white; text-decoration: none; border-radius: 5px; margin-bottom: 8px; transition: background 0.3s;">
                    🔔 Notifications
                </a>

                <div style="margin-top: 20px;">
                    <h4 style="color: #ecf0f1; margin: 0 0 15px 0; font-size: 12px; text-transform: uppercase; font-weight: 600; letter-spacing: 1px;">Voucher Management</h4>
                    <a href="{{ route('admin.vouchers.index') }}" style="display: block; padding: 12px 15px; color: white; text-decoration: none; border-radius: 5px; margin-bottom: 8px; transition: background 0.3s;">
                        🎟️ All Vouchers
                    </a>
                    <a href="{{ route('admin.vouchers.create') }}" style="display: block; padding: 12px 15px; color: white; text-decoration: none; border-radius: 5px; margin-bottom: 8px; transition: background 0.3s; background: rgba(40, 167, 69, 0.3); border-left: 3px solid #28a745;">
                        ➕ Create Voucher
                    </a>
                    <a href="{{ route('admin.coupons.index') }}" style="display: block; padding: 12px 15px; color: white; text-decoration: none; border-radius: 5px; margin-bottom: 8px; transition: background 0.3s;">
                        🏷️ Coupons
                    </a>
                    <a href="{{ route('admin.redemptions.index') }}" style="display: block; padding: 12px 15px; color: white; text-decoration: none; border-radius: 5px; margin-bottom: 8px; transition: background 0.3s;">
                        ✅ Redemptions
                    </a>
                    <a href="{{ route('admin.bonuses.index') }}" style="display: block; padding: 12px 15px; color: white; text-decoration: none; border-radius: 5px; margin-bottom: 8px; transition: background 0.3s;">
                        🎁 Bonuses
                    </a>
                    <a href="{{ route('admin.referral-campaigns.index') }}" style="display: block; padding: 12px 15px; color: white; text-decoration: none; border-radius: 5px; margin-bottom: 8px; transition: background 0.3s;">
                        🌟 Referral Campaigns
                    </a>
                    <a href="{{ route('admin.referrals.index') }}" style="display: block; padding: 12px 15px; color: white; text-decoration: none; border-radius: 5px; margin-bottom: 8px; transition: background 0.3s;">
                        🔗 Referrals
                    </a>
                </div>

                <div style="margin-top: 20px;">
                    <h4 style="color: #ecf0f1; margin: 0 0 15px 0; font-size: 12px; text-transform: uppercase; font-weight: 600; letter-spacing: 1px;">Revenue Management</h4>
                    <a href="{{ route('admin.revenue.overview') }}" style="display: block; padding: 12px 15px; color: white; text-decoration: none; border-radius: 5px; margin-bottom: 8px; transition: background 0.3s;">
                        📊 Overview
                    </a>
                    <a href="{{ route('admin.revenue.balance') }}" style="display: block; padding: 12px 15px; color: white; text-decoration: none; border-radius: 5px; margin-bottom: 8px; transition: background 0.3s;">
                        💰 Balance
                    </a>
                    <a href="{{ route('admin.revenue.sales') }}" style="display: block; padding: 12px 15px; color: white; text-decoration: none; border-radius: 5px; margin-bottom: 8px; transition: background 0.3s;">
                        📈 Sales
                    </a>
                    <a href="{{ route('admin.revenue.credit') }}" style="display: block; padding: 12px 15px; color: white; text-decoration: none; border-radius: 5px; margin-bottom: 8px; transition: background 0.3s;">
                        💳 Credit
                    </a>
                    <a href="{{ route('admin.revenue.refunds') }}" style="display: block; padding: 12px 15px; color: white; text-decoration: none; border-radius: 5px; margin-bottom: 8px; transition: background 0.3s;">
                        💸 Refunds
                    </a>
                    <a href="{{ route('admin.revenue.financial') }}" style="display: block; padding: 12px 15px; color: white; text-decoration: none; border-radius: 5px; margin-bottom: 8px; transition: background 0.3s;">
                        📑 Financial
                    </a>
                </div>

                <div style="margin-top: 20px;">
                    <h4 style="color: #ecf0f1; margin: 0 0 15px 0; font-size: 12px; text-transform: uppercase; font-weight: 600; letter-spacing: 1px;">Management</h4>
                    <a href="{{ route('admin.users.index') }}" style="display: block; padding: 12px 15px; color: white; text-decoration: none; border-radius: 5px; margin-bottom: 8px; transition: background 0.3s;">
                        👥 Users
                    </a>
                    <a href="/admin/refunds" style="display: block; padding: 12px 15px; color: white; text-decoration: none; border-radius: 5px; margin-bottom: 8px; transition: background 0.3s;">
                        💰 Refunds
                    </a>
                    <a href="/admin/reports" style="display: block; padding: 12px 15px; color: white; text-decoration: none; border-radius: 5px; margin-bottom: 8px; transition: background 0.3s;">
                        📊 Reports
                    </a>
                </div>

                <div style="margin-top: 20px;">
                    <h4 style="color: #ecf0f1; margin: 0 0 15px 0; font-size: 12px; text-transform: uppercase; font-weight: 600; letter-spacing: 1px;">System</h4>
                    <a href="/admin/settings" style="display: block; padding: 12px 15px; color: white; text-decoration: none; border-radius: 5px; margin-bottom: 8px; transition: background 0.3s;">
                        ⚙️ Settings
                    </a>
                </div>
            @elseif(Auth::user()->role === 'manager')
                <a href="/manager/dashboard" style="display: block; padding: 12px 15px; color: white; text-decoration: none; border-radius: 5px; margin-bottom: 8px; transition: background 0.3s; background: rgba(255, 255, 255, 0.1);">
                    📊 Dashboard
                </a>
                <a href="{{ route('profile.index') }}" style="display: block; padding: 12px 15px; color: white; text-decoration: none; border-radius: 5px; margin-bottom: 8px; transition: background 0.3s;">
                    👤 My Profile
                </a>
                <a href="{{ route('notifications.index') }}" style="display: block; padding: 12px 15px; color: white; text-decoration: none; border-radius: 5px; margin-bottom: 8px; transition: background 0.3s;">
                    🔔 Notifications
                </a>
                <a href="/manager/team" style="display: block; padding: 12px 15px; color: white; text-decoration: none; border-radius: 5px; margin-bottom: 8px; transition: background 0.3s;">
                    👥 Team
                </a>
                <a href="/manager/tasks" style="display: block; padding: 12px 15px; color: white; text-decoration: none; border-radius: 5px; margin-bottom: 8px; transition: background 0.3s;">
                    📝 Tasks
                </a>
                <a href="/manager/reports" style="display: block; padding: 12px 15px; color: white; text-decoration: none; border-radius: 5px; margin-bottom: 8px; transition: background 0.3s;">
                    📊 Reports
                </a>
            @elseif(Auth::user()->role === 'agent')
                <a href="/agent/dashboard" style="display: block; padding: 12px 15px; color: white; text-decoration: none; border-radius: 5px; margin-bottom: 8px; transition: background 0.3s; background: rgba(255, 255, 255, 0.1);">
                    📊 Dashboard
                </a>
                <a href="{{ route('profile.index') }}" style="display: block; padding: 12px 15px; color: white; text-decoration: none; border-radius: 5px; margin-bottom: 8px; transition: background 0.3s;">
                    👤 My Profile
                </a>
                <a href="{{ route('notifications.index') }}" style="display: block; padding: 12px 15px; color: white; text-decoration: none; border-radius: 5px; margin-bottom: 8px; transition: background 0.3s;">
                    🔔 Notifications
                </a>
                <a href="/agent/tickets" style="display: block; padding: 12px 15px; color: white; text-decoration: none; border-radius: 5px; margin-bottom: 8px; transition: background 0.3s;">
                    🎟️ Tickets
                </a>
                <a href="/agent/performance" style="display: block; padding: 12px 15px; color: white; text-decoration: none; border-radius: 5px; margin-bottom: 8px; transition: background 0.3s;">
                    📈 Performance
                </a>
            @elseif(Auth::user()->role === 'support')
                <a href="/support/dashboard" style="display: block; padding: 12px 15px; color: white; text-decoration: none; border-radius: 5px; margin-bottom: 8px; transition: background 0.3s; background: rgba(255, 255, 255, 0.1);">
                    📊 Dashboard
                </a>
                <a href="{{ route('profile.index') }}" style="display: block; padding: 12px 15px; color: white; text-decoration: none; border-radius: 5px; margin-bottom: 8px; transition: background 0.3s;">
                    👤 My Profile
                </a>
                <a href="/support/documents-form" style="display: block; padding: 12px 15px; color: white; text-decoration: none; border-radius: 5px; margin-bottom: 8px; transition: background 0.3s; background: rgba(255, 255, 255, 0.1);">
                   Documents
                </a>
                <a href="{{ route('notifications.index') }}" style="display: block; padding: 12px 15px; color: white; text-decoration: none; border-radius: 5px; margin-bottom: 8px; transition: background 0.3s;">
                    🔔 Notifications
                </a>
                <a href="/support/tickets" style="display: block; padding: 12px 15px; color: white; text-decoration: none; border-radius: 5px; margin-bottom: 8px; transition: background 0.3s;">
                    🎟️ Support Tickets
                </a>
                <a href="/support/reports" style="display: block; padding: 12px 15px; color: white; text-decoration: none; border-radius: 5px; margin-bottom: 8px; transition: background 0.3s;">
                    📊 Reports
                </a>
            @endif
        </div>
    </nav>
</aside>
