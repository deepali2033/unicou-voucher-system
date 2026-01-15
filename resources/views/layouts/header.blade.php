<header class="navbar" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 15px 30px; display: flex; justify-content: space-between; align-items: center;">
    <div style="display: flex; align-items: center; gap: 20px;">
        <h2 style="margin: 0; font-size: 20px;">@yield('navbar-title', 'Dashboard')</h2>
    </div>
    <div style="display: flex; align-items: center; gap: 15px;">
        <span style="font-size: 14px;">{{ Auth::user()->name }}</span>
        <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
            @csrf
            <button type="submit" style="background: rgba(255, 255, 255, 0.2); border: 1px solid white; color: white; padding: 8px 15px; border-radius: 5px; cursor: pointer; font-size: 14px; transition: background 0.3s;">
                Logout
            </button>
        </form>
    </div>
</header>
