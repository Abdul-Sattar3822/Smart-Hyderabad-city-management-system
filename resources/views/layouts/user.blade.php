<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CityApp — Smart Hyderabad</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .nav-link {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 14px;
            border-radius: 10px;
            font-size: 14px;
            color: #64748b;
            transition: all 0.2s;
            text-decoration: none;
        }
        .nav-link:hover { background: #eff6ff; color: #2563eb; }
        .nav-link.active {
            background: linear-gradient(135deg, #3b82f6, #6366f1);
            color: white;
            font-weight: 600;
        }
        .nav-link.active svg {
            stroke: white;
        }
        #userSidebar { transition: transform 0.3s ease; }
        @media (max-width: 768px) {
            #userSidebar {
                position: fixed;
                top: 0; left: 0;
                height: 100vh;
                z-index: 50;
                transform: translateX(-100%);
            }
            #userSidebar.open { transform: translateX(0); }
            #userOverlay {
                display: none;
                position: fixed;
                inset: 0;
                background: rgba(0,0,0,0.5);
                z-index: 40;
            }
            #userOverlay.open { display: block; }
        }
    </style>
</head>

<body class="bg-gray-50">
<div class="flex h-screen overflow-hidden">

    <!-- Overlay -->
    <div id="userOverlay" onclick="closeUserSidebar()"></div>

    <!-- SIDEBAR -->
    <div id="userSidebar" class="w-64 bg-white shadow-lg flex flex-col flex-shrink-0">

        <!-- Logo -->
        <div class="px-6 py-5 border-b flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 bg-blue-600 rounded-lg flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" class="w-5 h-5">
                        <path d="M3 21h18" stroke="white" stroke-width="1.8" stroke-linecap="round"/>
                        <path d="M5 21V10l7-5 7 5v11" stroke="white" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M9 21v-6h6v6" stroke="white" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M9 13h.01M15 13h.01M12 13h.01" stroke="white" stroke-width="2.2" stroke-linecap="round"/>
                    </svg>
                </div>
                <div>
                    <p class="font-bold text-gray-800 text-sm">Smart Hyderabad</p>
                    <p class="text-gray-400 text-xs">Citizen Portal</p>
                </div>
            </div>
            <button onclick="closeUserSidebar()" class="text-gray-400 hover:text-gray-600 md:hidden">✕</button>
        </div>

        <!-- Profile -->
        <div class="px-4 py-4 border-b bg-gradient-to-r from-blue-50 to-indigo-50">
            <div class="flex items-center gap-3">
                <img src="{{ auth()->user()->profile_image ? asset('storage/' . auth()->user()->profile_image) : 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->name) . '&background=3b82f6&color=fff' }}"
                    class="w-12 h-12 rounded-full object-cover border-2 border-blue-400">
                <div>
                    <p class="font-semibold text-gray-800 text-sm">{{ auth()->user()->name }}</p>
                    <span class="text-xs bg-blue-100 text-blue-600 px-2 py-0.5 rounded-full">Citizen</span>
                </div>
            </div>
        </div>

        <!-- Nav Links -->
        @php
            $unreadCount = \App\Models\Notification::where('user_id', auth()->id())
                            ->where('is_read', false)->count();
        @endphp
        <nav class="flex-1 px-3 py-4 space-y-1 overflow-y-auto">
            <a href="/dashboard" class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                Dashboard
            </a>
            <a href="{{ route('complaints.index') }}" class="nav-link {{ request()->is('complaints') ? 'active' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
                My Complaints
            </a>
            <a href="{{ route('complaints.create') }}" class="nav-link {{ request()->is('complaints/create') ? 'active' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 4v16m8-8H4"/>
                </svg>
                Add Complaint
            </a>
            <a href="{{ route('notifications.index') }}" class="nav-link {{ request()->is('notifications') ? 'active' : '' }} justify-between">
                <span class="flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                    </svg>
                    Notifications
                </span>
                @if($unreadCount > 0)
                    <span class="bg-red-500 text-white text-xs font-bold px-2 py-0.5 rounded-full animate-pulse">{{ $unreadCount }}</span>
                @endif
            </a>
            <a href="{{ route('settings') }}" class="nav-link {{ request()->is('settings') ? 'active' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                Settings
            </a>
        </nav>

        <!-- Logout -->
        <div class="px-3 py-4 border-t">
            <form method="POST" action="/logout">
                @csrf
                <button class="nav-link w-full text-left text-red-500 hover:bg-red-50 hover:text-red-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>
                    Logout
                </button>
            </form>
        </div>
    </div>

    <!-- MAIN CONTENT -->
    <div class="flex-1 flex flex-col overflow-hidden">

        <!-- TOP BAR -->
        <div class="bg-white shadow-sm px-4 py-3 flex justify-between items-center">
            <div class="flex items-center gap-3">
                <!-- Hamburger -->
                <button onclick="openUserSidebar()"
                    class="md:hidden text-gray-600 hover:text-gray-900 text-2xl">
                    ☰
                </button>
                <div>
                    <p class="text-xs text-gray-400 hidden md:block">{{ now()->format('l, d M Y') }}</p>
                    <p class="font-semibold text-gray-800 text-sm flex items-center gap-1">
                        Welcome, {{ auth()->user()->name }}!
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-yellow-500" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                        </svg>
                    </p>
                </div>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('notifications.index') }}" class="relative">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                    </svg>
                    @if($unreadCount > 0)
                        <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs w-4 h-4 rounded-full flex items-center justify-center">
                            {{ $unreadCount }}
                        </span>
                    @endif
                </a>
                <img src="{{ auth()->user()->profile_image ? asset('storage/' . auth()->user()->profile_image) : 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->name) . '&background=3b82f6&color=fff' }}"
                    class="w-9 h-9 rounded-full object-cover border-2 border-blue-500">
            </div>
        </div>

        <!-- Success / Error -->
        @if(session('success'))
        <div class="mx-4 mt-3 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg text-sm flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            {{ session('success') }}
        </div>
        @endif
        @if(session('error'))
        <div class="mx-4 mt-3 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg text-sm flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            {{ session('error') }}
        </div>
        @endif

        <!-- PAGE CONTENT -->
        <div class="flex-1 overflow-y-auto p-4 md:p-6">
            @yield('content')
        </div>

    </div>
</div>

<script>
    function openUserSidebar() {
        document.getElementById('userSidebar').classList.add('open');
        document.getElementById('userOverlay').classList.add('open');
    }
    function closeUserSidebar() {
        document.getElementById('userSidebar').classList.remove('open');
        document.getElementById('userOverlay').classList.remove('open');
    }
</script>

</body>
</html>