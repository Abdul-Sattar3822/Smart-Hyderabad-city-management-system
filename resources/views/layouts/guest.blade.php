<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Smart Hyderabad City</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="font-sans antialiased">

<div class="min-h-screen flex">

    <!-- LEFT SIDE — Branding -->
    <div class="hidden lg:flex lg:w-1/2 bg-gradient-to-br from-blue-700 via-blue-600 to-indigo-700 flex-col justify-between p-12 text-white">

        <!-- Logo -->
        <div class="flex items-center gap-3">
            <div class="w-12 h-12 bg-white bg-opacity-20 rounded-2xl flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" class="w-7 h-7">
                    <path d="M3 21h18" stroke="white" stroke-width="1.8" stroke-linecap="round"/>
                    <path d="M5 21V10l7-5 7 5v11" stroke="white" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M9 21v-6h6v6" stroke="white" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M9 13h.01M15 13h.01M12 13h.01" stroke="white" stroke-width="2.2" stroke-linecap="round"/>
                </svg>
            </div>
            <div>
                <p class="font-bold text-xl">Smart Hyderabad</p>
                <p class="text-blue-200 text-sm">City Management System</p>
            </div>
        </div>

        <!-- Center Content -->
        <div>
            <h1 class="text-4xl font-bold mb-4 leading-tight">
                Your City,<br>Your Voice
            </h1>
            <p class="text-blue-100 text-lg mb-10">
                Report issues, track complaints, and help build a better Hyderabad for everyone.
            </p>

            <!-- Features -->
            <div class="space-y-5">
                <div class="flex items-center gap-4">
                    <div class="w-11 h-11 bg-white bg-opacity-20 rounded-xl flex items-center justify-center flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="font-semibold">Submit Complaints</p>
                        <p class="text-blue-200 text-sm">Report any civic issue easily</p>
                    </div>
                </div>
                <div class="flex items-center gap-4">
                    <div class="w-11 h-11 bg-white bg-opacity-20 rounded-xl flex items-center justify-center flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="font-semibold">Track Progress</p>
                        <p class="text-blue-200 text-sm">Real-time status updates</p>
                    </div>
                </div>
                <div class="flex items-center gap-4">
                    <div class="w-11 h-11 bg-white bg-opacity-20 rounded-xl flex items-center justify-center flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="font-semibold">Get Resolved</p>
                        <p class="text-blue-200 text-sm">Fast resolution by authorities</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="text-blue-300 text-sm">
            © {{ date('Y') }} Smart Hyderabad City — All rights reserved
        </div>
    </div>

    <!-- RIGHT SIDE — Form -->
    <div class="w-full lg:w-1/2 flex items-center justify-center p-6 md:p-12 bg-gray-50">
        <div class="w-full max-w-md">

            <!-- Mobile Logo -->
            <div class="flex lg:hidden items-center gap-3 mb-8">
                <div class="w-10 h-10 bg-blue-600 rounded-xl flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" class="w-6 h-6">
                        <path d="M3 21h18" stroke="white" stroke-width="1.8" stroke-linecap="round"/>
                        <path d="M5 21V10l7-5 7 5v11" stroke="white" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M9 21v-6h6v6" stroke="white" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M9 13h.01M15 13h.01M12 13h.01" stroke="white" stroke-width="2.2" stroke-linecap="round"/>
                    </svg>
                </div>
                <div>
                    <p class="font-bold text-gray-800">Smart Hyderabad</p>
                    <p class="text-gray-400 text-xs">City Management System</p>
                </div>
            </div>

            {{ $slot }}

        </div>
    </div>

</div>

</body>
</html>