@extends('layouts.admin')

@section('content')

<div class="max-w-4xl mx-auto">

    <!-- Header -->
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
            </svg>
            Admin Profile
        </h1>
        <p class="text-gray-400 text-sm mt-1">Manage your account settings</p>
    </div>

    <!-- Profile Hero Card -->
    <div class="bg-gradient-to-r from-blue-600 to-indigo-600 rounded-2xl p-6 mb-6 text-white shadow-lg">
        <div class="flex flex-col md:flex-row items-center md:items-start gap-5">
            <div class="relative">
                <img src="{{ $admin->profile_image ? asset('storage/'.$admin->profile_image) : 'https://ui-avatars.com/api/?name='.urlencode($admin->name).'&background=ffffff&color=3b82f6&size=128' }}"
                    class="w-24 h-24 rounded-2xl object-cover border-4 border-white shadow-lg">
                <span class="absolute -bottom-2 -right-2 bg-green-400 w-5 h-5 rounded-full border-2 border-white"></span>
            </div>
            <div class="text-center md:text-left">
                <h2 class="text-2xl font-bold">{{ $admin->name }}</h2>
                <p class="text-blue-200 mt-1">{{ $admin->email }}</p>
                <div class="flex flex-wrap gap-2 mt-3 justify-center md:justify-start">
                    <span class="inline-flex items-center gap-1.5 bg-white bg-opacity-20 px-3 py-1 rounded-full text-xs font-semibold">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                        Super Admin
                    </span>
                    <span class="inline-flex items-center gap-1.5 bg-white bg-opacity-20 px-3 py-1 rounded-full text-xs font-semibold">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                        {{ $admin->phone ?? 'No phone' }}
                    </span>
                    <span class="inline-flex items-center gap-1.5 bg-white bg-opacity-20 px-3 py-1 rounded-full text-xs font-semibold">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        Joined {{ $admin->created_at->format('M Y') }}
                    </span>
                </div>
            </div>

            <!-- Quick Stats -->
            <div class="md:ml-auto grid grid-cols-3 gap-3 text-center">
                <div class="bg-white bg-opacity-15 rounded-xl p-3">
                    <p class="text-xl font-bold">{{ \App\Models\Complaint::count() }}</p>
                    <p class="text-blue-200 text-xs">Total</p>
                </div>
                <div class="bg-white bg-opacity-15 rounded-xl p-3">
                    <p class="text-xl font-bold">{{ \App\Models\Complaint::where('status','resolved')->count() }}</p>
                    <p class="text-blue-200 text-xs">Resolved</p>
                </div>
                <div class="bg-white bg-opacity-15 rounded-xl p-3">
                    <p class="text-xl font-bold">{{ \App\Models\User::where('role','user')->count() }}</p>
                    <p class="text-blue-200 text-xs">Citizens</p>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        <!-- Personal Details Form -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
            <div class="flex items-center gap-3 mb-5">
                <div class="w-10 h-10 bg-blue-100 rounded-xl flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="font-bold text-gray-800">Personal Details</h3>
                    <p class="text-xs text-gray-400">Update your basic information</p>
                </div>
            </div>

            @if(session('success'))
            <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl text-sm mb-4 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                {{ session('success') }}
            </div>
            @endif

            @if(session('error'))
            <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl text-sm mb-4 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
                {{ session('error') }}
            </div>
            @endif

            <form method="POST" action="{{ route('admin.profile.update') }}" enctype="multipart/form-data">
                @csrf

                <div class="space-y-4">
                    <div>
                        <label class="block text-xs font-semibold text-gray-500 uppercase mb-1.5">Full Name</label>
                        <input type="text" name="name" value="{{ $admin->name }}"
                            class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder="Your full name">
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-gray-500 uppercase mb-1.5">Email Address</label>
                        <input type="email" name="email" value="{{ $admin->email }}"
                            class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder="your@email.com">
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-gray-500 uppercase mb-1.5">Phone Number</label>
                        <input type="text" name="phone" value="{{ $admin->phone }}"
                            class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder="03XX-XXXXXXX">
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-gray-500 uppercase mb-1.5">Profile Photo</label>
                        <div class="flex items-center gap-3">
                            <img src="{{ $admin->profile_image ? asset('storage/'.$admin->profile_image) : 'https://ui-avatars.com/api/?name='.urlencode($admin->name).'&background=3b82f6&color=fff' }}"
                                class="w-12 h-12 rounded-xl object-cover">
                            <input type="file" name="profile_image" accept="image/*"
                                class="flex-1 text-sm text-gray-500 file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-blue-600 hover:file:bg-blue-100">
                        </div>
                    </div>

                    <button type="submit"
                        class="w-full bg-blue-600 text-white py-2.5 rounded-xl text-sm font-semibold hover:bg-blue-700 transition flex items-center justify-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Save Changes
                    </button>
                </div>
            </form>
        </div>

        <!-- Security Form -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
            <div class="flex items-center gap-3 mb-5">
                <div class="w-10 h-10 bg-green-100 rounded-xl flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="font-bold text-gray-800">Security</h3>
                    <p class="text-xs text-gray-400">Change your password</p>
                </div>
            </div>

            <form method="POST" action="{{ route('admin.profile.password') }}">
                @csrf

                <div class="space-y-4">
                    <div>
                        <label class="block text-xs font-semibold text-gray-500 uppercase mb-1.5">Current Password</label>
                        <input type="password" name="current_password"
                            class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-green-500"
                            placeholder="Enter current password">
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-gray-500 uppercase mb-1.5">New Password</label>
                        <input type="password" name="new_password"
                            class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-green-500"
                            placeholder="Enter new password">
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-gray-500 uppercase mb-1.5">Confirm Password</label>
                        <input type="password" name="new_password_confirmation"
                            class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-green-500"
                            placeholder="Confirm new password">
                    </div>

                    <div class="bg-gray-50 rounded-xl p-3">
                        <p class="text-xs font-semibold text-gray-500 mb-2">Password Requirements:</p>
                        <ul class="text-xs text-gray-400 space-y-1">
                            <li class="flex items-center gap-1.5">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                Minimum 6 characters
                            </li>
                            <li class="flex items-center gap-1.5">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                Must match confirmation
                            </li>
                        </ul>
                    </div>

                    <button type="submit"
                        class="w-full bg-green-600 text-white py-2.5 rounded-xl text-sm font-semibold hover:bg-green-700 transition flex items-center justify-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                        Update Password
                    </button>
                </div>
            </form>
        </div>

    </div>

</div>

@endsection