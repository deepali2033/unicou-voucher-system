<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard')</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f5f5f5;
        }

        header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: 60px;
            z-index: 1000;
        }

        .navbar {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .navbar h2 {
            font-size: 20px;
        }
        
        .logout-btn {
            background: rgba(255, 255, 255, 0.2);
            border: 1px solid white;
            color: white;
            padding: 8px 15px;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            font-size: 14px;
            transition: background 0.3s;
        }
        
        .logout-btn:hover {
            background: rgba(255, 255, 255, 0.3);
        }

        .impersonation-banner {
            background: #ffc107;
            color: #000;
            padding: 10px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-weight: 600;
            position: fixed;
            top: 60px;
            left: 0;
            right: 0;
            z-index: 999;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        .stop-impersonation-btn {
            background: #333;
            color: white;
            padding: 5px 15px;
            border-radius: 4px;
            text-decoration: none;
            font-size: 13px;
            border: none;
            cursor: pointer;
        }

        .main-wrapper {
            display: flex;
            margin-top: 60px;
            min-height: calc(100vh - 60px);
        }

        .impersonating .main-wrapper {
            margin-top: 105px;
        }

        .impersonating aside {
            top: 105px;
            height: calc(100vh - 105px);
        }

        aside {
            width: 250px;
            background: #2c3e50;
            color: white;
            padding: 20px;
            height: calc(100vh - 60px);
            overflow-y: auto;
            position: fixed;
            left: 0;
            top: 60px;
        }

        .content-wrapper {
            flex: 1;
            margin-left: 250px;
            padding: 30px;
        }
        
        .container {
            max-width: 1400px;
            margin: 0 auto;
        }
        
        .welcome {
            background: white;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }
        
        .welcome h1 {
            color: #333;
            margin-bottom: 10px;
        }
        
        .welcome p {
            color: #666;
            font-size: 16px;
        }
        
        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
        }
        
        .card {
            background: white;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        
        .card h3 {
            color: #667eea;
            margin-bottom: 15px;
            font-size: 18px;
        }
        
        .card p {
            color: #666;
            line-height: 1.6;
            margin-bottom: 15px;
        }
        
        .card-icon {
            font-size: 40px;
            margin-bottom: 10px;
        }

        footer {
            background: #333;
            color: white;
            padding: 30px;
            text-align: center;
            margin-top: 50px;
            border-top: 1px solid #444;
            clear: both;
        }

        @yield('custom-css')
    </style>
</head>
<body class="{{ session()->has('admin_id') ? 'impersonating' : '' }}">
    @include('layouts.header')

    @if(session()->has('admin_id'))
        <div class="impersonation-banner">
            <span>🕵️ You are currently logged in as <strong>{{ Auth::user()->name }}</strong> ({{ ucfirst(Auth::user()->role) }})</span>
            <form action="{{ route('admin.users.stop-impersonation') }}" method="POST" style="margin: 0;">
                @csrf
                <button type="submit" class="stop-impersonation-btn">🔙 Return to Admin</button>
            </form>
        </div>
    @endif
    
    <div class="main-wrapper">
        @include('layouts.sidebar')
        
        <div class="content-wrapper">
            <div class="container">
                @yield('content')
            </div>
        </div>
    </div>

    @include('layouts.footer')

    <script>
        @yield('custom-js')
    </script>
</body>
</html>
