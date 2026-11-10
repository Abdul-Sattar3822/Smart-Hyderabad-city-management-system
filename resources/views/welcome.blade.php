<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart Hyderabad City — Citizen Portal</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap');
        * { font-family: 'Inter', sans-serif; }

        /* Gradient Animations */
        .hero-bg {
            background: linear-gradient(135deg, #0f172a 0%, #1e3a5f 30%, #2563eb 60%, #7c3aed 100%);
            position: relative;
            overflow: hidden;
        }
        .hero-bg::before {
            content: '';
            position: absolute;
            width: 600px; height: 600px;
            background: radial-gradient(circle, rgba(99,102,241,0.3) 0%, transparent 70%);
            top: -200px; right: -200px;
            animation: pulse 4s ease-in-out infinite;
        }
        .hero-bg::after {
            content: '';
            position: absolute;
            width: 400px; height: 400px;
            background: radial-gradient(circle, rgba(37,99,235,0.2) 0%, transparent 70%);
            bottom: -100px; left: -100px;
            animation: pulse 6s ease-in-out infinite reverse;
        }
        @keyframes pulse {
            0%, 100% { transform: scale(1); opacity: 0.5; }
            50% { transform: scale(1.2); opacity: 1; }
        }

        /* Floating Animation */
        .float { animation: float 3s ease-in-out infinite; }
        .float-delay { animation: float 3s ease-in-out infinite 1.5s; }
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-12px); }
        }

        /* Glass Effect */
        .glass {
            background: rgba(255,255,255,0.08);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255,255,255,0.15);
        }
        .glass-white {
            background: rgba(255,255,255,0.95);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255,255,255,0.8);
        }

        /* Card Hover */
        .card-hover {
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }
        .card-hover:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 25px 50px rgba(0,0,0,0.15);
        }

        /* Gradient Text */
        .gradient-text {
            background: linear-gradient(135deg, #fbbf24, #f59e0b, #fcd34d);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Navbar Scroll Effect */
        .navbar-scroll {
            transition: all 0.3s ease;
        }

        /* Counter Animation */
        .counter { transition: all 1s ease; }

        /* Scroll Reveal */
        .reveal {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.8s ease;
        }
        .reveal.visible {
            opacity: 1;
            transform: translateY(0);
        }

        /* Mobile Menu */
        #mobileMenu {
            display: none;
            transition: all 0.3s ease;
        }
        #mobileMenu.open { display: block; }

        /* Gradient Border */
        .gradient-border {
            border: 2px solid transparent;
            background: linear-gradient(white, white) padding-box,
                        linear-gradient(135deg, #3b82f6, #7c3aed) border-box;
        }

        /* Particle */
        .particle {
            position: absolute;
            border-radius: 50%;
            animation: particleFloat linear infinite;
        }
        @keyframes particleFloat {
            0% { transform: translateY(100vh) rotate(0deg); opacity: 0; }
            10% { opacity: 1; }
            90% { opacity: 1; }
            100% { transform: translateY(-100px) rotate(720deg); opacity: 0; }
        }

        /* Smooth Scroll */
        html { scroll-behavior: smooth; }

        /* Custom Scrollbar */
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: #f1f5f9; }
        ::-webkit-scrollbar-thumb { background: #3b82f6; border-radius: 3px; }
    </style>
</head>
<body class="antialiased">

<!-- NAVBAR -->
<nav id="navbar" class="fixed top-0 left-0 right-0 z-50 navbar-scroll py-4 px-4 md:px-8">
    <div class="max-w-7xl mx-auto">
        <div class="glass rounded-2xl px-5 py-3 flex justify-between items-center">

            <!-- Logo -->
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-blue-600 rounded-xl flex items-center justify-center shadow-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" class="w-6 h-6">
                        <path d="M3 21h18" stroke="white" stroke-width="1.8" stroke-linecap="round"/>
                        <path d="M5 21V10l7-5 7 5v11" stroke="white" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M9 21v-6h6v6" stroke="white" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M9 13h.01M15 13h.01M12 13h.01" stroke="white" stroke-width="2.2" stroke-linecap="round"/>
                    </svg>
                </div>
                <div>
                    <p class="font-bold text-white text-sm leading-tight">Smart Hyderabad</p>
                    <p class="text-blue-300 text-xs">City Portal</p>
                </div>
            </div>

            <!-- Desktop Links -->
            <div class="hidden md:flex items-center gap-6">
                <a href="#features" class="text-gray-300 hover:text-white text-sm font-medium transition">Features</a>
                <a href="#how-it-works" class="text-gray-300 hover:text-white text-sm font-medium transition">How it Works</a>
                <a href="#stats" class="text-gray-300 hover:text-white text-sm font-medium transition">Stats</a>
                <a href="#categories" class="text-gray-300 hover:text-white text-sm font-medium transition">Categories</a>
            </div>

            <!-- Auth Buttons -->
            <div class="hidden md:flex items-center gap-3">
                <a href="{{ route('login') }}"
                    class="text-white text-sm font-medium px-4 py-2 rounded-xl hover:bg-white hover:bg-opacity-10 transition">
                    Sign In
                </a>
                <a href="{{ route('register') }}"
                    class="bg-gradient-to-r from-blue-500 to-indigo-600 text-white px-5 py-2.5 rounded-xl text-sm font-semibold hover:shadow-lg hover:shadow-blue-500/30 transition shadow">
                    Get Started
                </a>
            </div>

            <!-- Mobile Hamburger -->
            <button onclick="document.getElementById('mobileMenu').classList.toggle('open')"
                class="md:hidden text-white text-2xl">☰</button>

        </div>

        <!-- Mobile Menu -->
        <div id="mobileMenu" class="glass rounded-2xl mt-2 p-4">
            <div class="space-y-2">
                <a href="#features" class="block text-gray-300 hover:text-white py-2 px-3 rounded-xl hover:bg-white hover:bg-opacity-10 text-sm">Features</a>
                <a href="#how-it-works" class="block text-gray-300 hover:text-white py-2 px-3 rounded-xl hover:bg-white hover:bg-opacity-10 text-sm">How it Works</a>
                <a href="#stats" class="block text-gray-300 hover:text-white py-2 px-3 rounded-xl hover:bg-white hover:bg-opacity-10 text-sm">Stats</a>
                <div class="flex gap-2 pt-2">
                    <a href="{{ route('login') }}" class="flex-1 text-center bg-white bg-opacity-10 text-white py-2 rounded-xl text-sm font-medium">Login</a>
                    <a href="{{ route('register') }}" class="flex-1 text-center bg-blue-600 text-white py-2 rounded-xl text-sm font-semibold">Register</a>
                </div>
            </div>
        </div>

    </div>
</nav>

<!-- HERO SECTION -->
<section class="hero-bg min-h-screen flex items-center pt-24 pb-16 relative">

    <!-- Floating Particles -->
    <div class="particle w-2 h-2 bg-blue-400 opacity-60" style="left:10%;animation-duration:8s;animation-delay:0s;"></div>
    <div class="particle w-3 h-3 bg-purple-400 opacity-40" style="left:25%;animation-duration:12s;animation-delay:2s;"></div>
    <div class="particle w-2 h-2 bg-yellow-400 opacity-50" style="left:60%;animation-duration:10s;animation-delay:4s;"></div>
    <div class="particle w-4 h-4 bg-blue-300 opacity-30" style="left:80%;animation-duration:9s;animation-delay:1s;"></div>
    <div class="particle w-2 h-2 bg-indigo-400 opacity-50" style="left:45%;animation-duration:11s;animation-delay:3s;"></div>

    <div class="max-w-7xl mx-auto px-4 md:px-8 w-full relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">

            <!-- Left -->
            <div class="text-white text-center lg:text-left animate__animated animate__fadeInLeft">

                <!-- Badge -->
                <div class="inline-flex items-center gap-2 glass px-4 py-2 rounded-full text-xs font-medium mb-6 text-blue-200">
                    <span class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></span>
                    Pakistan's Smart City Initiative — Hyderabad
                </div>

                <h1 class="text-4xl md:text-5xl lg:text-6xl font-black mb-6 leading-tight">
                    Your City.<br>
                    Your Voice.<br>
                    <span class="gradient-text">Your Power.</span>
                </h1>

                <p class="text-blue-100 text-lg md:text-xl mb-8 leading-relaxed max-w-xl mx-auto lg:mx-0">
                    Report civic issues, track complaints in real-time, and help build a smarter, better Hyderabad for every citizen.
                </p>

                <!-- CTA Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start mb-10">
                    <a href="{{ route('register') }}"
                        class="group bg-gradient-to-r from-yellow-400 to-orange-400 text-gray-900 px-8 py-4 rounded-2xl text-base font-bold hover:shadow-2xl hover:shadow-yellow-400/30 transition-all duration-300 flex items-center justify-center gap-2">
                         Get Started Free
                        <span class="group-hover:translate-x-1 transition-transform">→</span>
                    </a>
                    <a href="{{ route('login') }}"
                        class="glass text-white px-8 py-4 rounded-2xl text-base font-semibold hover:bg-white hover:bg-opacity-20 transition-all duration-300 flex items-center justify-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        Sign In
                    </a>
                </div>

                <!-- Live Stats -->
                @php
                    $totalComplaints   = \App\Models\Complaint::count();
                    $resolvedComplaints = \App\Models\Complaint::where('status','resolved')->count();
                    $totalUsers        = \App\Models\User::where('role','user')->count();
                @endphp
                <div class="flex flex-wrap gap-8 justify-center lg:justify-start">
                    <div class="text-center">
                        <p class="text-3xl font-black text-yellow-300 counter">{{ $totalUsers }}+</p>
                        <p class="text-blue-300 text-xs mt-1 flex items-center justify-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                            Citizens
                        </p>
                    </div>
                    <div class="w-px bg-white bg-opacity-20 h-12 self-center hidden sm:block"></div>
                    <div class="text-center">
                        <p class="text-3xl font-black text-yellow-300 counter">{{ $totalComplaints }}+</p>
                        <p class="text-blue-300 text-xs mt-1 flex items-center justify-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            Complaints Filed
                        </p>
                    </div>
                    <div class="w-px bg-white bg-opacity-20 h-12 self-center hidden sm:block"></div>
                    <div class="text-center">
                        <p class="text-3xl font-black text-yellow-300 counter">{{ $resolvedComplaints }}+</p>
                        <p class="text-blue-300 text-xs mt-1 flex items-center justify-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            Resolved
                        </p>
                    </div>
                </div>

            </div>

            <!-- Right — Dashboard Preview Cards -->
            <div class="hidden lg:block animate__animated animate__fadeInRight">
                <div class="relative">

                    <!-- Main Card -->
                    <div class="glass-white rounded-3xl p-6 shadow-2xl float">
                        <div class="flex items-center justify-between mb-4">
                            <p class="font-bold text-gray-800 flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                                Live Dashboard
                            </p>
                            <span class="flex items-center gap-1 text-xs text-green-600 bg-green-100 px-2 py-1 rounded-full">
                                <span class="w-1.5 h-1.5 bg-green-500 rounded-full animate-pulse"></span>
                                Live
                            </span>
                        </div>
                        <div class="grid grid-cols-2 gap-3 mb-4">
                            <div class="bg-yellow-50 rounded-xl p-3 text-center">
                                <p class="text-2xl font-black text-yellow-600">{{ \App\Models\Complaint::where('status','pending')->count() }}</p>
                                <p class="text-xs text-gray-500 flex items-center justify-center gap-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    Pending
                                </p>
                            </div>
                            <div class="bg-green-50 rounded-xl p-3 text-center">
                                <p class="text-2xl font-black text-green-600">{{ $resolvedComplaints }}</p>
                                <p class="text-xs text-gray-500 flex items-center justify-center gap-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    Resolved
                                </p>
                            </div>
                        </div>
                        <!-- Mini Chart Bars -->
                        <div class="flex items-end gap-1 h-16">
                            @foreach([40,65,45,80,55,90,70] as $h)
                            <div class="flex-1 bg-gradient-to-t from-blue-600 to-indigo-400 rounded-t-lg opacity-80"
                                style="height: {{ $h }}%"></div>
                            @endforeach
                        </div>
                        <p class="text-xs text-gray-400 mt-2 text-center">Last 7 days activity</p>
                    </div>

                    <!-- Floating Mini Cards -->
                    <div class="glass rounded-2xl p-4 absolute -top-6 -right-6 shadow-xl float-delay">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <p class="text-white text-xs font-semibold mt-1">GPS Tracking</p>
                    </div>

                    <div class="glass rounded-2xl p-4 absolute -bottom-4 -left-4 shadow-xl float">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                        </svg>
                        <p class="text-white text-xs font-semibold mt-1">Live Alerts</p>
                    </div>

                </div>
            </div>

        </div>
    </div>

    <!-- Wave Bottom -->
    <div class="absolute bottom-0 left-0 right-0">
        <svg viewBox="0 0 1440 80" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M0 80L60 72C120 64 240 48 360 44C480 40 600 48 720 52C840 56 960 56 1080 50C1200 44 1320 32 1380 26L1440 20V80H1380C1320 80 1200 80 1080 80C960 80 840 80 720 80C600 80 480 80 360 80C240 80 120 80 60 80H0Z" fill="#f9fafb"/>
        </svg>
    </div>

</section>

<!-- FEATURES SECTION -->
<section id="features" class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 md:px-8">

        <div class="text-center mb-16 reveal">
            <span class="bg-blue-100 text-blue-600 px-4 py-2 rounded-full text-xs font-bold uppercase tracking-wide">
                Features
            </span>
            <h2 class="text-3xl md:text-4xl font-black text-gray-800 mt-4 mb-4">
                Everything You Need 
            </h2>
            <p class="text-gray-500 text-lg max-w-2xl mx-auto">
                A complete platform for citizen complaint management with cutting-edge features
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @php
            $features = [
                ['svg' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>', 'color'=>'from-blue-500 to-blue-600','bg'=>'bg-blue-50','title'=>'GPS Location','desc'=>'Attach exact GPS coordinates for faster complaint resolution'],
                ['svg' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/>', 'color'=>'from-purple-500 to-purple-600','bg'=>'bg-purple-50','title'=>'Photo Evidence','desc'=>'Upload photos with complaints for visual proof'],
                ['svg' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>', 'color'=>'from-yellow-500 to-orange-500','bg'=>'bg-yellow-50','title'=>'Real-time Alerts','desc'=>'Instant email and in-app notifications on status updates'],
                ['svg' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>', 'color'=>'from-green-500 to-emerald-600','bg'=>'bg-green-50','title'=>'Live Analytics','desc'=>'Admin dashboard with charts and complaint insights'],
                ['svg' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/>', 'color'=>'from-red-500 to-pink-600','bg'=>'bg-red-50','title'=>'Complaint Map','desc'=>'Interactive map showing all complaints across Hyderabad'],
                ['svg' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>', 'color'=>'from-indigo-500 to-violet-600','bg'=>'bg-indigo-50','title'=>'Live Chat','desc'=>'Direct messaging between citizens and admin'],
                ['svg' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>', 'color'=>'from-orange-500 to-amber-600','bg'=>'bg-orange-50','title'=>'Departments','desc'=>'Auto-routed to Water, Roads, Electricity departments'],
                ['svg' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>', 'color'=>'from-teal-500 to-cyan-600','bg'=>'bg-teal-50','title'=>'PDF Reports','desc'=>'Download complaint reports and official receipts'],
                ['svg' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>', 'color'=>'from-pink-500 to-rose-600','bg'=>'bg-pink-50','title'=>'Feedback System','desc'=>'Rate resolution quality and submit feedback'],
            ];
            @endphp

            @foreach($features as $i => $f)
            <div class="bg-white rounded-2xl shadow-sm p-6 card-hover border border-gray-100 reveal"
                style="transition-delay: {{ $i * 0.1 }}s">
                <div class="w-14 h-14 bg-gradient-to-br {{ $f['color'] }} rounded-2xl flex items-center justify-center mb-4 shadow-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        {!! $f['svg'] !!}
                    </svg>
                </div>
                <h3 class="font-bold text-gray-800 text-lg mb-2">{{ $f['title'] }}</h3>
                <p class="text-gray-500 text-sm leading-relaxed">{{ $f['desc'] }}</p>
            </div>
            @endforeach
        </div>

    </div>
</section>

<!-- HOW IT WORKS -->
<section id="how-it-works" class="py-20 bg-white relative overflow-hidden">

    <!-- Background Decorations -->
    <div class="absolute top-0 right-0 w-96 h-96 bg-blue-50 rounded-full -translate-y-1/2 translate-x-1/2 opacity-50"></div>
    <div class="absolute bottom-0 left-0 w-64 h-64 bg-purple-50 rounded-full translate-y-1/2 -translate-x-1/2 opacity-50"></div>

    <div class="max-w-7xl mx-auto px-4 md:px-8 relative z-10">

        <div class="text-center mb-16 reveal">
            <span class="bg-purple-100 text-purple-600 px-4 py-2 rounded-full text-xs font-bold uppercase tracking-wide">
                Process
            </span>
            <h2 class="text-3xl md:text-4xl font-black text-gray-800 mt-4 mb-4">
                How It Works
            </h2>
            <p class="text-gray-500 text-lg">Simple 4-step process to get your issue resolved</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 relative">

            <!-- Connecting Line (Desktop) -->
            <div class="hidden lg:block absolute top-12 left-1/4 right-1/4 h-0.5 bg-gradient-to-r from-blue-300 to-purple-300 z-0"></div>

            @php
            $steps = [
                ['num'=>'01','svg'=>'<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>','color'=>'from-blue-500 to-blue-600','title'=>'Register','desc'=>'Create your free citizen account in seconds'],
                ['num'=>'02','svg'=>'<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/>','color'=>'from-purple-500 to-purple-600','title'=>'Report Issue','desc'=>'Submit with photo and GPS location'],
                ['num'=>'03','svg'=>'<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>','color'=>'from-indigo-500 to-violet-600','title'=>'Dept Reviews','desc'=>'Admin assigns to relevant department'],
                ['num'=>'04','svg'=>'<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>','color'=>'from-green-500 to-emerald-600','title'=>'Resolved!','desc'=>'Get notified when issue is resolved'],
            ];
            @endphp

            @foreach($steps as $i => $step)
            <div class="text-center relative z-10 reveal" style="transition-delay: {{ $i * 0.2 }}s">
                <div class="relative inline-block mb-6">
                    <div class="w-24 h-24 bg-gradient-to-br {{ $step['color'] }} rounded-3xl flex items-center justify-center shadow-xl mx-auto">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            {!! $step['svg'] !!}
                        </svg>
                    </div>
                    <div class="absolute -top-3 -right-3 w-8 h-8 bg-gray-900 rounded-xl flex items-center justify-center text-white text-xs font-black shadow">
                        {{ $step['num'] }}
                    </div>
                </div>
                <h3 class="font-black text-gray-800 text-xl mb-2">{{ $step['title'] }}</h3>
                <p class="text-gray-500 text-sm leading-relaxed">{{ $step['desc'] }}</p>
            </div>
            @endforeach

        </div>

    </div>
</section>

<!-- STATS SECTION -->
<section id="stats" class="py-20 relative overflow-hidden"
    style="background: linear-gradient(135deg, #0f172a 0%, #1e3a5f 40%, #2563eb 70%, #7c3aed 100%);">

    <!-- Decorations -->
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-10 left-10 w-40 h-40 border-2 border-white rounded-full"></div>
        <div class="absolute bottom-10 right-10 w-60 h-60 border border-white rounded-full"></div>
        <div class="absolute top-1/2 left-1/2 w-80 h-80 border border-white rounded-full -translate-x-1/2 -translate-y-1/2"></div>
    </div>

    <div class="max-w-7xl mx-auto px-4 md:px-8 relative z-10">

        <div class="text-center mb-16 reveal">
            <span class="glass px-4 py-2 rounded-full text-xs font-bold uppercase tracking-wide text-blue-200">
                Live Numbers
            </span>
            <h2 class="text-3xl md:text-4xl font-black text-white mt-4 mb-4">
                Our Impact So Far
            </h2>
            <p class="text-blue-200 text-lg">Real-time data from Smart Hyderabad City</p>
        </div>

        @php
            $cities     = \App\Models\City::count();
            $population = \App\Models\City::sum('population');
            $avgRating  = \App\Models\Complaint::whereNotNull('rating')->avg('rating');
            $depts      = \App\Models\Department::where('is_active', true)->count();
        @endphp

        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            @php
            $statsData = [
                ['val' => $cities, 'label' => 'Cities Monitored', 'svg' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>', 'suffix' => ''],
                ['val' => number_format($population), 'label' => 'Population Served', 'svg' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>', 'suffix' => ''],
                ['val' => $depts, 'label' => 'Active Departments', 'svg' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>', 'suffix' => ''],
                ['val' => number_format($avgRating ?? 0, 1), 'label' => 'Average Rating', 'svg' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>', 'suffix' => '/5'],
            ];
            @endphp
            @foreach($statsData as $i => $stat)
            <div class="glass rounded-2xl p-6 text-center card-hover reveal" style="transition-delay: {{ $i * 0.15 }}s">
                <div class="flex justify-center mb-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-yellow-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        {!! $stat['svg'] !!}
                    </svg>
                </div>
                <p class="text-3xl md:text-4xl font-black text-yellow-300">{{ $stat['val'] }}{{ $stat['suffix'] }}</p>
                <p class="text-blue-200 text-sm mt-2">{{ $stat['label'] }}</p>
            </div>
            @endforeach
        </div>

        <!-- Progress Bars -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-12">
            @php
                $total    = \App\Models\Complaint::count() ?: 1;
                $resolved = \App\Models\Complaint::where('status','resolved')->count();
                $pending  = \App\Models\Complaint::where('status','pending')->count();
                $progress = \App\Models\Complaint::where('status','in_progress')->count();
            @endphp
            <div class="glass rounded-2xl p-5 reveal">
                <div class="flex justify-between mb-2">
                    <span class="text-white text-sm font-semibold">Resolved</span>
                    <span class="text-yellow-300 text-sm font-bold">{{ round(($resolved/$total)*100) }}%</span>
                </div>
                <div class="w-full bg-white bg-opacity-20 rounded-full h-2.5">
                    <div class="bg-green-400 h-2.5 rounded-full" style="width: {{ round(($resolved/$total)*100) }}%"></div>
                </div>
            </div>
            <div class="glass rounded-2xl p-5 reveal">
                <div class="flex justify-between mb-2">
                    <span class="text-white text-sm font-semibold">In Progress</span>
                    <span class="text-yellow-300 text-sm font-bold">{{ round(($progress/$total)*100) }}%</span>
                </div>
                <div class="w-full bg-white bg-opacity-20 rounded-full h-2.5">
                    <div class="bg-blue-400 h-2.5 rounded-full" style="width: {{ round(($progress/$total)*100) }}%"></div>
                </div>
            </div>
            <div class="glass rounded-2xl p-5 reveal">
                <div class="flex justify-between mb-2">
                    <span class="text-white text-sm font-semibold">Pending</span>
                    <span class="text-yellow-300 text-sm font-bold">{{ round(($pending/$total)*100) }}%</span>
                </div>
                <div class="w-full bg-white bg-opacity-20 rounded-full h-2.5">
                    <div class="bg-yellow-400 h-2.5 rounded-full" style="width: {{ round(($pending/$total)*100) }}%"></div>
                </div>
            </div>
        </div>

    </div>
</section>

<!-- CATEGORIES -->
<section id="categories" class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 md:px-8">

        <div class="text-center mb-16 reveal">
            <span class="bg-green-100 text-green-600 px-4 py-2 rounded-full text-xs font-bold uppercase tracking-wide">
                Categories
            </span>
            <h2 class="text-3xl md:text-4xl font-black text-gray-800 mt-4 mb-4">
                We Handle All Civic Issues
            </h2>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 gap-4">
            @php
            $cats = [
                ['svg'=>'<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>','name'=>'Water Supply','color'=>'bg-blue-100 text-blue-600'],
                ['svg'=>'<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M13 10V3L4 14h7v7l9-11h-7z"/>','name'=>'Electricity','color'=>'bg-yellow-100 text-yellow-600'],
                ['svg'=>'<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/>','name'=>'Roads','color'=>'bg-gray-100 text-gray-600'],
                ['svg'=>'<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>','name'=>'Waste Mgmt','color'=>'bg-green-100 text-green-600'],
                ['svg'=>'<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>','name'=>'Sewerage','color'=>'bg-cyan-100 text-cyan-600'],
                ['svg'=>'<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>','name'=>'Street Lights','color'=>'bg-orange-100 text-orange-600'],
                ['svg'=>'<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>','name'=>'Parks','color'=>'bg-emerald-100 text-emerald-600'],
                ['svg'=>'<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>','name'=>'Health','color'=>'bg-red-100 text-red-600'],
                ['svg'=>'<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>','name'=>'Traffic','color'=>'bg-purple-100 text-purple-600'],
                ['svg'=>'<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>','name'=>'Emergency','color'=>'bg-rose-100 text-rose-600'],
            ];
            @endphp
            @foreach($cats as $i => $cat)
            <div class="bg-white rounded-2xl shadow-sm p-5 text-center card-hover border border-gray-100 reveal"
                style="transition-delay: {{ $i * 0.05 }}s">
                <div class="w-14 h-14 {{ $cat['color'] }} rounded-2xl flex items-center justify-center mx-auto mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        {!! $cat['svg'] !!}
                    </svg>
                </div>
                <p class="text-gray-700 text-sm font-semibold">{{ $cat['name'] }}</p>
            </div>
            @endforeach
        </div>

    </div>
</section>

<!-- TESTIMONIAL / ROLE SECTION -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 md:px-8">

        <div class="text-center mb-16 reveal">
            <span class="bg-indigo-100 text-indigo-600 px-4 py-2 rounded-full text-xs font-bold uppercase tracking-wide">
                Roles
            </span>
            <h2 class="text-3xl md:text-4xl font-black text-gray-800 mt-4 mb-4">
                Built for Everyone
            </h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            <div class="gradient-border rounded-2xl p-6 card-hover reveal text-center">
                <div class="w-16 h-16 bg-blue-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </div>
                <h3 class="font-black text-gray-800 text-xl mb-3">Citizens</h3>
                <ul class="text-gray-500 text-sm space-y-2 text-left">
                    <li class="flex items-center gap-2"><span class="text-green-500">✓</span> Submit complaints with GPS</li>
                    <li class="flex items-center gap-2"><span class="text-green-500">✓</span> Track real-time status</li>
                    <li class="flex items-center gap-2"><span class="text-green-500">✓</span> Chat with admin</li>
                    <li class="flex items-center gap-2"><span class="text-green-500">✓</span> Download PDF receipts</li>
                    <li class="flex items-center gap-2"><span class="text-green-500">✓</span> Rate & give feedback</li>
                </ul>
                <a href="{{ route('register') }}" class="mt-4 block bg-blue-600 text-white py-2.5 rounded-xl text-sm font-semibold hover:bg-blue-700 transition">
                    Register as Citizen
                </a>
            </div>

            <div class="bg-gradient-to-br from-blue-600 to-indigo-700 rounded-2xl p-6 card-hover reveal text-center shadow-2xl transform scale-105">
                <div class="w-16 h-16 bg-white bg-opacity-20 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>
                    </svg>
                </div>
                <h3 class="font-black text-white text-xl mb-3">Admin</h3>
                <ul class="text-blue-100 text-sm space-y-2 text-left">
                    <li class="flex items-center gap-2"><span class="text-yellow-300">✓</span> Full dashboard control</li>
                    <li class="flex items-center gap-2"><span class="text-yellow-300">✓</span> Assign to departments</li>
                    <li class="flex items-center gap-2"><span class="text-yellow-300">✓</span> Analytics & reports</li>
                    <li class="flex items-center gap-2"><span class="text-yellow-300">✓</span> Map hotspot view</li>
                    <li class="flex items-center gap-2"><span class="text-yellow-300">✓</span> User management</li>
                </ul>
                <a href="{{ route('login') }}" class="mt-4 block bg-yellow-400 text-gray-900 py-2.5 rounded-xl text-sm font-bold hover:bg-yellow-300 transition">
                    Admin Login
                </a>
            </div>

            <div class="gradient-border rounded-2xl p-6 card-hover reveal text-center">
                <div class="w-16 h-16 bg-purple-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                </div>
                <h3 class="font-black text-gray-800 text-xl mb-3">Departments</h3>
                <ul class="text-gray-500 text-sm space-y-2 text-left">
                    <li class="flex items-center gap-2"><span class="text-green-500">✓</span> View assigned complaints</li>
                    <li class="flex items-center gap-2"><span class="text-green-500">✓</span> Update status</li>
                    <li class="flex items-center gap-2"><span class="text-green-500">✓</span> View location & photos</li>
                    <li class="flex items-center gap-2"><span class="text-green-500">✓</span> Department analytics</li>
                    <li class="flex items-center gap-2"><span class="text-green-500">✓</span> Resolution tracking</li>
                </ul>
                <a href="{{ route('department.login') }}" class="mt-4 block bg-purple-600 text-white py-2.5 rounded-xl text-sm font-semibold hover:bg-purple-700 transition">
                    Department Login
                </a>
            </div>

        </div>

    </div>
</section>

<!-- CTA SECTION -->
<section class="py-20 relative overflow-hidden"
    style="background: linear-gradient(135deg, #1e3a5f, #2563eb, #7c3aed);">

    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-0 left-1/4 w-96 h-96 bg-white rounded-full -translate-y-1/2"></div>
        <div class="absolute bottom-0 right-1/4 w-64 h-64 bg-white rounded-full translate-y-1/2"></div>
    </div>

    <div class="max-w-4xl mx-auto px-4 text-center relative z-10 reveal">
        <div class="flex justify-center mb-6">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 text-white float" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
            </svg>
        </div>
        <h2 class="text-3xl md:text-5xl font-black text-white mb-6 leading-tight">
            Ready to Make<br>
            <span class="gradient-text">Hyderabad Better?</span>
        </h2>
        <p class="text-blue-100 text-lg md:text-xl mb-10 max-w-2xl mx-auto">
            Join thousands of citizens who are actively helping build a smarter, cleaner, and better Hyderabad.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('register') }}"
                class="group bg-gradient-to-r from-yellow-400 to-orange-400 text-gray-900 px-10 py-4 rounded-2xl font-black text-lg hover:shadow-2xl hover:shadow-yellow-400/30 transition-all flex items-center justify-center gap-2">
                 Register Now — Free!
                <span class="group-hover:translate-x-1 transition-transform">→</span>
            </a>
            <a href="{{ route('login') }}"
                class="glass text-white px-10 py-4 rounded-2xl font-semibold text-lg hover:bg-white hover:bg-opacity-20 transition-all">
                Already a member? Login
            </a>
        </div>
    </div>

</section>

<!-- FOOTER -->
<footer class="bg-gray-950 text-white py-12">
    <div class="max-w-7xl mx-auto px-4 md:px-8">

        <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">

            <!-- Brand -->
            <div class="md:col-span-2">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 bg-blue-600 rounded-xl flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" class="w-6 h-6">
                            <path d="M3 21h18" stroke="white" stroke-width="1.8" stroke-linecap="round"/>
                            <path d="M5 21V10l7-5 7 5v11" stroke="white" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M9 21v-6h6v6" stroke="white" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M9 13h.01M15 13h.01M12 13h.01" stroke="white" stroke-width="2.2" stroke-linecap="round"/>
                        </svg>
                    </div>
                    <div>
                        <p class="font-black text-lg">Smart Hyderabad City</p>
                        <p class="text-gray-400 text-xs">Citizen Complaint Management System</p>
                    </div>
                </div>
                <p class="text-gray-400 text-sm leading-relaxed max-w-xs">
                    Empowering citizens of Hyderabad to report, track, and resolve civic issues through technology.
                </p>
            </div>

            <!-- Quick Links -->
            <div>
                <p class="font-bold text-sm uppercase tracking-wide text-gray-300 mb-4">Quick Links</p>
                <div class="space-y-2">
                    <a href="#features" class="block text-gray-400 hover:text-white text-sm transition">Features</a>
                    <a href="#how-it-works" class="block text-gray-400 hover:text-white text-sm transition">How it Works</a>
                    <a href="#stats" class="block text-gray-400 hover:text-white text-sm transition">Statistics</a>
                    <a href="#categories" class="block text-gray-400 hover:text-white text-sm transition">Categories</a>
                </div>
            </div>

            <!-- Portals -->
            <div>
                <p class="font-bold text-sm uppercase tracking-wide text-gray-300 mb-4">Portals</p>
                <div class="space-y-2">
                    <a href="{{ route('register') }}" class="block text-gray-400 hover:text-white text-sm transition">Citizen Register</a>
                    <a href="{{ route('login') }}" class="block text-gray-400 hover:text-white text-sm transition">Citizen Login</a>
                    <a href="{{ route('login') }}" class="block text-gray-400 hover:text-white text-sm transition">Admin Login</a>
                    <a href="{{ route('department.login') }}" class="block text-gray-400 hover:text-white text-sm transition">Department Login</a>
                </div>
            </div>

        </div>

        <div class="border-t border-gray-800 pt-6 flex flex-col md:flex-row justify-between items-center gap-4">
            <p class="text-gray-500 text-sm">© {{ date('Y') }} Smart Hyderabad City. All rights reserved.</p>
            <p class="text-gray-500 text-sm">Made with ❤️ for the citizens of Hyderabad</p>
        </div>

    </div>
</footer>

<!-- Scripts -->
<script>
// Navbar Scroll Effect
window.addEventListener('scroll', () => {
    const navbar = document.getElementById('navbar');
    if (window.scrollY > 50) {
        navbar.style.paddingTop = '8px';
        navbar.style.paddingBottom = '8px';
    } else {
        navbar.style.paddingTop = '16px';
        navbar.style.paddingBottom = '16px';
    }
});

// Scroll Reveal
const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add('visible');
        }
    });
}, { threshold: 0.1 });

document.querySelectorAll('.reveal').forEach(el => observer.observe(el));
</script>

<!-- ═══════ CSRF Token ═══════ -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<!-- ═══════ AI CHATBOT ═══════ -->

<!-- Floating Bubble -->
<div id="chatBubble" onclick="toggleChat()"
    class="fixed bottom-6 right-6 z-50 cursor-pointer group">
    <div class="relative">
        <div class="w-16 h-16 bg-gradient-to-br from-blue-600 to-indigo-600 rounded-2xl flex items-center justify-center shadow-2xl hover:shadow-blue-500/40 transition-all duration-300 group-hover:scale-110 group-hover:rotate-3">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
            </svg>
        </div>
        <div class="absolute inset-0 rounded-2xl bg-blue-500 opacity-20 animate-ping"></div>
        <div class="absolute -top-2 -right-2 bg-red-500 text-white text-xs w-5 h-5 rounded-full flex items-center justify-center font-bold shadow animate-bounce">
            1
        </div>
    </div>
    <div class="absolute bottom-full right-0 mb-3 bg-gray-900 text-white text-xs px-3 py-2 rounded-xl whitespace-nowrap opacity-0 group-hover:opacity-100 transition-all duration-200 shadow-xl">
        AI Assistant se poochein!
        <div class="absolute top-full right-4 w-0 h-0 border-l-4 border-r-4 border-t-4 border-transparent border-t-gray-900"></div>
    </div>
</div>

<!-- Chat Window -->
<div id="chatWindow" class="fixed bottom-28 right-6 z-50 w-96 max-w-[calc(100vw-24px)] hidden">
    <div class="bg-white rounded-2xl shadow-2xl border border-gray-100 overflow-hidden flex flex-col" style="height:520px;">

        <!-- Header -->
        <div class="bg-gradient-to-r from-blue-600 via-indigo-600 to-purple-600 px-4 py-3.5 flex items-center gap-3 flex-shrink-0">
            <div class="w-10 h-10 bg-white bg-opacity-20 rounded-xl flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
            </div>
            <div class="flex-1">
                <p class="text-white font-bold text-sm">Smart Hyderabad AI</p>
                <div class="flex items-center gap-1.5 mt-0.5">
                    <div class="w-1.5 h-1.5 bg-green-400 rounded-full animate-pulse"></div>
                    <p class="text-blue-200 text-xs">Online — Powered by Gemini AI</p>
                </div>
            </div>
            <button onclick="toggleChat()"
                class="text-white text-opacity-70 hover:text-opacity-100 w-8 h-8 flex items-center justify-center rounded-lg hover:bg-white hover:bg-opacity-10 transition text-xl">
                ✕
            </button>
        </div>

        <!-- Messages -->
        <div id="chatMessages" class="flex-1 overflow-y-auto p-4 space-y-3 bg-gray-50">
            <!-- Welcome Message -->
            <div class="flex items-start gap-2">
                <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center flex-shrink-0 mt-0.5 shadow">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4.5 h-4.5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </div>
                <div class="bg-white rounded-2xl rounded-tl-sm px-4 py-3 shadow-sm border border-gray-100 max-w-xs">
                    <p class="text-gray-800 text-sm font-semibold mb-1">السلام علیکم! </p>
                    <p class="text-gray-600 text-xs leading-relaxed">Main Smart Hyderabad City ka AI Assistant hun! Aapki kaise madad kar sakta hun?</p>
                </div>
            </div>
        </div>

        <!-- FAQs -->
        <div id="faqSection" class="px-3 py-2.5 border-t border-gray-100 bg-white flex-shrink-0">
            <p class="text-xs font-semibold text-gray-400 mb-2 px-1">Aksar poochhe jane wale sawaal:</p>
            <div class="space-y-1.5">
                <button onclick="sendFAQ(0)"
                    class="w-full text-left text-xs bg-blue-50 text-blue-700 px-3 py-2 rounded-xl hover:bg-blue-100 transition border border-blue-100 font-medium">
                    Complaint kaise submit karein?
                </button>
                <button onclick="sendFAQ(1)"
                    class="w-full text-left text-xs bg-blue-50 text-blue-700 px-3 py-2 rounded-xl hover:bg-blue-100 transition border border-blue-100 font-medium">
                    Complaint status kaise check karein?
                </button>
                <button onclick="sendFAQ(2)"
                    class="w-full text-left text-xs bg-blue-50 text-blue-700 px-3 py-2 rounded-xl hover:bg-blue-100 transition border border-blue-100 font-medium">
                    Kaunsi complaint categories hain?
                </button>
                <button onclick="sendFAQ(3)"
                    class="w-full text-left text-xs bg-blue-50 text-blue-700 px-3 py-2 rounded-xl hover:bg-blue-100 transition border border-blue-100 font-medium">
                    Smart Hyderabad City kya hai?
                </button>
                <button onclick="sendFAQ(4)"
                    class="w-full text-left text-xs bg-blue-50 text-blue-700 px-3 py-2 rounded-xl hover:bg-blue-100 transition border border-blue-100 font-medium">
                    Complaint re-open kaise karein?
                </button>
            </div>
        </div>

        <!-- Input -->
        <div class="px-4 py-3 border-t border-gray-100 bg-white flex-shrink-0">
            <div class="flex gap-2 items-end">
                <textarea id="chatInput"
                    placeholder="Apna sawaal likhein..."
                    rows="1"
                    class="flex-1 border border-gray-200 rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 resize-none leading-relaxed"
                    onkeydown="if(event.key==='Enter'&&!event.shiftKey){event.preventDefault();sendMessage();}"
                    oninput="this.style.height='auto';this.style.height=Math.min(this.scrollHeight,80)+'px'">
                </textarea>
                <button onclick="sendMessage()" id="sendBtn"
                    class="w-10 h-10 bg-gradient-to-br from-blue-600 to-indigo-600 text-white rounded-xl flex items-center justify-center hover:shadow-lg hover:shadow-blue-500/30 transition-all flex-shrink-0">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                    </svg>
                </button>
            </div>
            <p class="text-xs text-gray-300 mt-1.5 text-center">Powered by Google Gemini AI</p>
        </div>

    </div>
</div>

<style>
@keyframes chatSlideUp {
    from { opacity:0; transform:translateY(16px) scale(0.95); }
    to   { opacity:1; transform:translateY(0) scale(1); }
}
@keyframes chatSlideDown {
    from { opacity:1; transform:translateY(0) scale(1); }
    to   { opacity:0; transform:translateY(16px) scale(0.95); }
}
#chatMessages::-webkit-scrollbar { width:3px; }
#chatMessages::-webkit-scrollbar-thumb { background:#cbd5e1; border-radius:2px; }
</style>

<script>
let chatOpen = false;
let isLoading = false;
let conversationHistory = [];
let faqHidden = false;

const faqs = [
    {
        q: 'Complaint kaise submit karein?',
        a: 'Complaint submit karne ke steps:\n\n1️⃣ **/register** pe account banayein\n2️⃣ **/login** se login karein\n3️⃣ Dashboard mein **"Add Complaint"** click karein\n4️⃣ Yeh fill karein:\n   • Title\n   • Description\n   • Category\n   • Priority (Low/Medium/High)\n   • City & Location\n5️⃣ Photo aur GPS location attach karein\n6️⃣ **Submit** karein!\n\nAapko confirmation email aa jayega ✅'
    },
    {
        q: 'Complaint status kaise check karein?',
        a: 'Status check karne ke liye:\n\n1️⃣ Login karein\n2️⃣ **"My Complaints"** mein jaein\n3️⃣ Status dekhen:\n\n⏳ **Pending** — Review pending hai\n🔄 **In Progress** — Kaam ho raha hai\n✅ **Resolved** — Masla hal ho gaya!\n\nAapko **email notification** bhi milegi jab bhi status change ho! 📧'
    },
    {
        q: 'Kaunsi complaint categories hain?',
        a: 'Hum in categories mein madad karte hain:\n\n💧 Water Supply\n⚡ Electricity & Power\n🛣️ Roads & Infrastructure\n🗑️ Waste Management\n🚰 Sewerage & Drainage\n💡 Street Lights\n🌳 Parks & Environment\n🏥 Health & Sanitation\n🚦 Traffic & Transport\n🆘 Emergency Services\n🏫 Education & Schools\n🍽️ Food Authority\n📋 Others\n\nKoi bhi civic masla report kar saktey hain! ✅'
    },
    {
        q: 'Smart Hyderabad City kya hai?',
        a: '**Smart Hyderabad City** Pakistan ka ek advanced civic complaint management system hai! 🏙️\n\n🎯 **Maqsad:** Citizens ko civic issues report karne aur track karne ki facility dena\n\n✨ **Key Features:**\n📍 GPS location attach karein\n📸 Photo upload karein\n💬 Admin se chat karein\n📄 PDF download karein\n🔔 Real-time notifications\n⭐ Feedback system\n🗺️ Complaint map\n\nAaj hi register karein! 🚀'
    },
    {
        q: 'Complaint re-open kaise karein?',
        a: 'Agar aap resolved complaint se satisfied nahi:\n\n1️⃣ Login karein\n2️⃣ **"My Complaints"** mein jaein\n3️⃣ Resolved complaint open karein\n4️⃣ **"Re-open"** button click karein\n5️⃣ Complaint dobara **Pending** ho jayegi\n\nAap admin ko **direct message** bhi kar saktey hain complaint details page pe! 💬'
    }
];

function toggleChat() {
    const win = document.getElementById('chatWindow');
    const badge = document.querySelector('#chatBubble .bg-red-500');

    if (!chatOpen) {
        win.classList.remove('hidden');
        win.querySelector('.bg-white').style.animation = 'chatSlideUp 0.3s ease forwards';
        chatOpen = true;
        if (badge) badge.style.display = 'none';
        setTimeout(() => document.getElementById('chatInput').focus(), 300);
    } else {
        win.querySelector('.bg-white').style.animation = 'chatSlideDown 0.3s ease forwards';
        setTimeout(() => win.classList.add('hidden'), 280);
        chatOpen = false;
    }
}

function sendFAQ(index) {
    const faq = faqs[index];
    hideFAQs();
    
    // User message add karo
    addMessage(faq.q, 'user');
    
    // History mein sirf user message add karo
    // Bot directly answer karega via API
    conversationHistory.push({ role: 'user', content: faq.q });
    
    // Typing show karo aur API se answer lo
    const typingId = showTyping();
    isLoading = true;
    document.getElementById('sendBtn').disabled = true;
    
    fetch('/chatbot', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
        },
        body: JSON.stringify({ messages: conversationHistory })
    })
    .then(r => r.json())
    .then(data => {
        removeTyping(typingId);
        if (data.content && data.content[0] && data.content[0].text) {
            const reply = data.content[0].text;
            conversationHistory.push({ role: 'assistant', content: reply });
            addMessage(reply, 'bot');
        } else {
            addMessage('Jawab dene mein masla hua, dobara poochein! 🙏', 'bot');
        }
        isLoading = false;
        document.getElementById('sendBtn').disabled = false;
    })
    .catch(() => {
        removeTyping(typingId);
        addMessage('Connection masla! Dobara try karein 🌐', 'bot');
        isLoading = false;
        document.getElementById('sendBtn').disabled = false;
    });
}

function hideFAQs() {
    if (!faqHidden) {
        document.getElementById('faqSection').style.display = 'none';
        faqHidden = true;
    }
}

async function sendMessage() {
    const input = document.getElementById('chatInput');
    const message = input.value.trim();
    if (!message || isLoading) return;

    input.value = '';
    input.style.height = 'auto';
    hideFAQs();

    addMessage(message, 'user');
    conversationHistory.push({ role: 'user', content: message });

    const typingId = showTyping();
    isLoading = true;
    document.getElementById('sendBtn').disabled = true;

    try {
        const csrfToken = document.querySelector('meta[name="csrf-token"]');
        const response = await fetch('/chatbot', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken ? csrfToken.content : ''
            },
            body: JSON.stringify({ messages: conversationHistory })
        });

        const data = await response.json();
        removeTyping(typingId);

        if (data.content && data.content[0] && data.content[0].text) {
            const reply = data.content[0].text;
            conversationHistory.push({ role: 'assistant', content: reply });
            addMessage(reply, 'bot');
        } else {
            addMessage('Maafi chahta hun, kuch masla aa gaya. Thodi der baad try karein! 🙏', 'bot');
        }

    } catch (err) {
        removeTyping(typingId);
        addMessage('Connection masla aa gaya. Dobara try karein! 🌐', 'bot');
    }

    isLoading = false;
    document.getElementById('sendBtn').disabled = false;
}

function addMessage(text, sender) {
    const messages = document.getElementById('chatMessages');
    const div = document.createElement('div');
    div.className = `flex items-start gap-2 ${sender === 'user' ? 'flex-row-reverse' : ''}`;

    const formatted = text
        .replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>')
        .replace(/\*(.*?)\*/g, '<em>$1</em>')
        .replace(/\n/g, '<br>');

    if (sender === 'user') {
        div.innerHTML = `
            <div class="bg-gradient-to-br from-blue-600 to-indigo-600 text-white rounded-2xl rounded-tr-sm px-4 py-3 max-w-xs shadow-sm text-sm leading-relaxed">${formatted}</div>
            <div class="w-8 h-8 bg-gray-200 rounded-xl flex items-center justify-center flex-shrink-0 mt-0.5">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
            </div>`;
    } else {
        div.innerHTML = `
            <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center flex-shrink-0 mt-0.5 shadow">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
            </div>
            <div class="bg-white rounded-2xl rounded-tl-sm px-4 py-3 shadow-sm max-w-xs border border-gray-100 text-sm text-gray-800 leading-relaxed">${formatted}</div>`;
    }

    messages.appendChild(div);
    messages.scrollTop = messages.scrollHeight;
}

function showTyping() {
    const messages = document.getElementById('chatMessages');
    const id = 'typing-' + Date.now();
    const div = document.createElement('div');
    div.id = id;
    div.className = 'flex items-start gap-2';
    div.innerHTML = `
        <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center flex-shrink-0 shadow">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
        </div>
        <div class="bg-white rounded-2xl rounded-tl-sm px-4 py-3.5 shadow-sm border border-gray-100">
            <div class="flex gap-1.5 items-center">
                <div class="w-2 h-2 bg-blue-400 rounded-full animate-bounce" style="animation-delay:0s"></div>
                <div class="w-2 h-2 bg-blue-400 rounded-full animate-bounce" style="animation-delay:0.15s"></div>
                <div class="w-2 h-2 bg-blue-400 rounded-full animate-bounce" style="animation-delay:0.3s"></div>
            </div>
        </div>`;
    messages.appendChild(div);
    messages.scrollTop = messages.scrollHeight;
    return id;
}

function removeTyping(id) {
    const el = document.getElementById(id);
    if (el) el.remove();
}
</script>

</body>
</html>