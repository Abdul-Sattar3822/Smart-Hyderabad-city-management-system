<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel — Smart Hyderabad</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap');
        * { font-family: 'Inter', sans-serif; box-sizing: border-box; }

        .sidebar {
            background: linear-gradient(160deg, #2E1F6E 0%, #5B3FD6 50%, #7B5CFA 100%);
        }
        .nav-link {
            display: flex; align-items: center; gap: 12px;
            padding: 11px 16px; border-radius: 12px;
            font-size: 14px; font-weight: 500;
            color: rgba(255,255,255,0.75);
            text-decoration: none;
            transition: all 0.2s ease;
        }
        .nav-link svg {
            width: 20px;
            height: 20px;
            flex-shrink: 0;
            stroke: currentColor;
        }
        .nav-link:hover { background: rgba(255,255,255,0.1); color: #fff; }
        .nav-link.active {
            background: #ffffff;
            color: #5B3FD6;
            font-weight: 700;
            box-shadow: 0 8px 16px rgba(0,0,0,0.15);
        }
        #sidebar { transition: transform 0.3s ease; }
        @media (max-width: 768px) {
            #sidebar { position: fixed; top:0; left:0; height:100vh; z-index:50; transform: translateX(-100%); }
            #sidebar.open { transform: translateX(0); }
            #overlay { display:none; position:fixed; inset:0; background:rgba(0,0,0,0.5); z-index:40; }
            #overlay.open { display:block; }
        }
        ::-webkit-scrollbar { width: 4px; }
        ::-webkit-scrollbar-thumb { background: #c7c7f5; border-radius: 3px; }
    </style>
</head>
<body class="bg-[#F4F5FB]">
<div class="flex h-screen overflow-hidden">

    <div id="overlay" onclick="closeSidebar()"></div>

    <!-- SIDEBAR -->
    <div id="sidebar" class="sidebar w-64 flex-shrink-0 flex flex-col py-8 px-5">

        <!-- Logo -->
        <div class="flex flex-col items-center mb-10">
            <div class="w-14 h-14 bg-white rounded-2xl flex items-center justify-center shadow-lg mb-2">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" class="w-8 h-8">
                    <path d="M3 21h18" stroke="#5B3FD6" stroke-width="1.8" stroke-linecap="round"/>
                    <path d="M5 21V10l7-5 7 5v11" stroke="#5B3FD6" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M9 21v-6h6v6" stroke="#5B3FD6" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M9 13h.01M15 13h.01M12 13h.01" stroke="#5B3FD6" stroke-width="2.2" stroke-linecap="round"/>
                </svg>
            </div>
            <p class="text-white font-bold text-sm">Smart Hyderabad</p>
            <p class="text-indigo-200 text-xs">City Admin</p>
        </div>

        <!-- Nav -->
        <nav class="flex-1 space-y-1.5 overflow-y-auto">
            <a href="/admin/dashboard" class="nav-link {{ request()->is('admin/dashboard') ? 'active' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                Dashboard
            </a>
            <a href="/admin/complaints" class="nav-link {{ request()->is('admin/complaints*') ? 'active' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
                Complaints
            </a>
            <a href="/admin/cities" class="nav-link {{ request()->is('admin/cities*') ? 'active' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                </svg>
                Cities
            </a>
            <a href="/admin/users" class="nav-link {{ request()->is('admin/users') ? 'active' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
                Citizens
            </a>
            <a href="/admin/departments" class="nav-link {{ request()->is('admin/departments') ? 'active' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                </svg>
                Departments
            </a>
            <a href="/admin/map" class="nav-link {{ request()->is('admin/map') ? 'active' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/>
                </svg>
                Map Hotspots
            </a>
            <a href="/admin/analytics" class="nav-link {{ request()->is('admin/analytics') ? 'active' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                </svg>
                Analytics
            </a>
            <a href="/admin/reports" class="nav-link {{ request()->is('admin/reports') ? 'active' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                Reports
            </a>
            <a href="/admin/feedbacks" class="nav-link {{ request()->is('admin/feedbacks') ? 'active' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                </svg>
                Feedback
            </a>
            <a href="/admin/search" class="nav-link {{ request()->is('admin/search') ? 'active' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                Search
            </a>
            <a href="{{ route('admin.profile') }}" class="nav-link {{ request()->is('admin/profile') ? 'active' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
                Profile
            </a>
        </nav>

        <!-- Logout -->
        <form method="POST" action="/logout" class="mt-4">
            @csrf
            <button class="nav-link w-full text-left text-red-200 hover:bg-red-500 hover:bg-opacity-20 hover:text-white">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                </svg>
                Logout
            </button>
        </form>
    </div>

    <!-- MAIN -->
    <div class="flex-1 flex flex-col overflow-hidden">

        <!-- TOP BAR -->
        <div class="bg-white px-4 md:px-8 py-5 flex justify-between items-center shadow-sm flex-shrink-0">
            <div class="flex items-center gap-3">
                <button onclick="openSidebar()" class="md:hidden text-gray-500 text-2xl">☰</button>
                <div>
                    <p class="text-lg md:text-xl font-bold text-gray-800">Welcome to Smart Hyderabad City </p>
                    <p class="text-gray-400 text-sm">{{ auth()->user()->name }} — City Administrator</p>
                </div>
            </div>
            <div class="hidden md:flex items-center gap-4">
                <div class="text-right">
                    <p class="text-xs text-gray-400">Today</p>
                    <p class="font-semibold text-gray-700 text-sm">{{ now()->format('d M, Y') }}</p>
                </div>
                <img src="{{ Auth::user()->profile_image ? asset('storage/'.Auth::user()->profile_image) : 'https://ui-avatars.com/api/?name='.urlencode(auth()->user()->name).'&background=5B3FD6&color=fff' }}"
                    class="w-11 h-11 rounded-xl object-cover">
            </div>
        </div>

        <!-- Alerts -->
        @if(session('success'))
        <div class="mx-4 md:mx-8 mt-4 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl text-sm flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            {{ session('success') }}
        </div>
        @endif
        @if(session('error'))
        <div class="mx-4 md:mx-8 mt-4 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl text-sm flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            {{ session('error') }}
        </div>
        @endif

        <!-- PAGE CONTENT -->
        <div class="flex-1 overflow-y-auto p-4 md:p-8">
            @yield('content')
        </div>

    </div>
</div>

<script>
    function openSidebar() {
        document.getElementById('sidebar').classList.add('open');
        document.getElementById('overlay').classList.add('open');
    }
    function closeSidebar() {
        document.getElementById('sidebar').classList.remove('open');
        document.getElementById('overlay').classList.remove('open');
    }
</script>
</body>
</html>