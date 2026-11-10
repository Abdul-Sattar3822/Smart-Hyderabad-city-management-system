@extends('layouts.user')

@section('content')

<div class="max-w-3xl mx-auto">

    <!-- Header -->
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">⚙️ Settings</h1>
        <p class="text-gray-400 text-sm mt-1">Manage your account preferences</p>
    </div>

    <!-- Verified Badge -->
    @if($resolvedCount >= 5)
    <div class="bg-gradient-to-r from-yellow-400 to-orange-400 rounded-2xl p-4 mb-6 text-white flex items-center gap-3">
        <span class="text-3xl">🏆</span>
        <div>
            <p class="font-bold">Verified Citizen Badge</p>
            <p class="text-yellow-100 text-sm">You have {{ $resolvedCount }} resolved complaints!</p>
        </div>
    </div>
    @endif

    <!-- Tabs -->
    <div class="bg-white rounded-2xl shadow p-1.5 flex gap-1 mb-6">
        <button onclick="openTab('general')" id="tab-general"
            class="tab-btn flex-1 py-2.5 rounded-xl text-sm font-semibold transition bg-blue-600 text-white">
            👤 General
        </button>
        <button onclick="openTab('security')" id="tab-security"
            class="tab-btn flex-1 py-2.5 rounded-xl text-sm font-semibold transition text-gray-500 hover:bg-gray-100">
            🔐 Security
        </button>
        <button onclick="openTab('notifications')" id="tab-notifications"
            class="tab-btn flex-1 py-2.5 rounded-xl text-sm font-semibold transition text-gray-500 hover:bg-gray-100">
            🔔 Notifications
        </button>
    </div>

    <!-- Success/Error -->
    @if(session('success'))
    <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl text-sm mb-4 flex items-center gap-2">
        ✅ {{ session('success') }}
    </div>
    @endif
    @if(session('error'))
    <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl text-sm mb-4 flex items-center gap-2">
        ❌ {{ session('error') }}
    </div>
    @endif

    <!-- GENERAL TAB -->
    <div id="general" class="tab-content">
        <div class="bg-white rounded-2xl shadow p-6">

            <div class="flex items-center gap-3 mb-5 pb-5 border-b">
                <div class="w-10 h-10 bg-blue-100 rounded-xl flex items-center justify-center text-xl">👤</div>
                <div>
                    <p class="font-bold text-gray-800">Personal Information</p>
                    <p class="text-xs text-gray-400">Update your profile details</p>
                </div>
            </div>

            <form method="POST" action="{{ route('profile.update.custom') }}" enctype="multipart/form-data" class="space-y-4">
                @csrf

                <!-- Profile Photo -->
                <div>
                    <label class="block text-xs font-semibold text-gray-500 uppercase mb-2">Profile Photo</label>
                    <div class="flex items-center gap-4">
                        <img id="preview"
                            src="{{ auth()->user()->profile_image ? asset('storage/' . auth()->user()->profile_image) : 'https://ui-avatars.com/api/?name='.urlencode(auth()->user()->name).'&background=3b82f6&color=fff' }}"
                            class="w-16 h-16 rounded-2xl object-cover border-2 border-blue-200 shadow">
                        <div class="flex-1">
                            <input type="file" name="profile_image" accept="image/*"
                                onchange="previewImage(event)"
                                class="w-full text-sm text-gray-500 file:mr-3 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-blue-600 hover:file:bg-blue-100">
                            <p class="text-xs text-gray-400 mt-1">JPG, PNG up to 2MB</p>
                        </div>
                    </div>
                </div>

                <!-- Name -->
                <div>
                    <label class="block text-xs font-semibold text-gray-500 uppercase mb-1.5">Full Name</label>
                    <input type="text" name="name"
                        value="{{ auth()->user()->name }}"
                        class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <!-- Email -->
                <div>
                    <label class="block text-xs font-semibold text-gray-500 uppercase mb-1.5">Email Address</label>
                    <input type="email" name="email"
                        value="{{ auth()->user()->email }}"
                        class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <!-- Phone -->
                <div>
                    <label class="block text-xs font-semibold text-gray-500 uppercase mb-1.5">Phone Number</label>
                    <input type="text" name="phone"
                        value="{{ auth()->user()->phone }}"
                        placeholder="03XX-XXXXXXX"
                        class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <button type="submit"
                    class="w-full bg-blue-600 text-white py-3 rounded-xl text-sm font-semibold hover:bg-blue-700 transition">
                    💾 Save Changes
                </button>
            </form>
        </div>
    </div>

    <!-- SECURITY TAB -->
    <div id="security" class="tab-content hidden">
        <div class="bg-white rounded-2xl shadow p-6">

            <div class="flex items-center gap-3 mb-5 pb-5 border-b">
                <div class="w-10 h-10 bg-green-100 rounded-xl flex items-center justify-center text-xl">🔐</div>
                <div>
                    <p class="font-bold text-gray-800">Change Password</p>
                    <p class="text-xs text-gray-400">Keep your account secure</p>
                </div>
            </div>

            <form method="POST" action="{{ route('password.update') }}" class="space-y-4">
                @csrf

                <div>
                    <label class="block text-xs font-semibold text-gray-500 uppercase mb-1.5">Current Password</label>
                    <input type="password" name="current_password"
                        placeholder="Enter current password"
                        class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-500 uppercase mb-1.5">New Password</label>
                    <input type="password" name="password"
                        placeholder="Enter new password"
                        class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-500 uppercase mb-1.5">Confirm Password</label>
                    <input type="password" name="password_confirmation"
                        placeholder="Confirm new password"
                        class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
                </div>

                <!-- Tips -->
                <div class="bg-gray-50 rounded-xl p-3">
                    <p class="text-xs font-semibold text-gray-500 mb-1">Requirements:</p>
                    <p class="text-xs text-gray-400">✓ Minimum 8 characters</p>
                    <p class="text-xs text-gray-400">✓ Must match confirmation</p>
                </div>

                <button type="submit"
                    class="w-full bg-green-600 text-white py-3 rounded-xl text-sm font-semibold hover:bg-green-700 transition">
                    🔐 Update Password
                </button>
            </form>
        </div>
    </div>

    <!-- NOTIFICATIONS TAB -->
    <div id="notifications" class="tab-content hidden">
        <div class="bg-white rounded-2xl shadow p-6">

            <div class="flex items-center gap-3 mb-5 pb-5 border-b">
                <div class="w-10 h-10 bg-yellow-100 rounded-xl flex items-center justify-center text-xl">🔔</div>
                <div>
                    <p class="font-bold text-gray-800">Notification Preferences</p>
                    <p class="text-xs text-gray-400">Choose what you want to be notified about</p>
                </div>
            </div>

            <form method="POST" action="{{ route('settings.notifications') }}" class="space-y-4">
                @csrf

                <label class="flex items-center gap-4 p-4 bg-gray-50 rounded-xl cursor-pointer hover:bg-blue-50 transition">
                    <input type="checkbox" name="email_alerts" value="1"
                        {{ auth()->user()->email_alerts ? 'checked' : '' }}
                        class="w-5 h-5 rounded accent-blue-600">
                    <div>
                        <p class="font-medium text-gray-800 text-sm">📧 Email Alerts</p>
                        <p class="text-xs text-gray-400">Get notified when your complaint status changes</p>
                    </div>
                </label>

                <label class="flex items-center gap-4 p-4 bg-gray-50 rounded-xl cursor-pointer hover:bg-blue-50 transition">
                    <input type="checkbox" name="city_alerts" value="1"
                        {{ auth()->user()->city_alerts ? 'checked' : '' }}
                        class="w-5 h-5 rounded accent-blue-600">
                    <div>
                        <p class="font-medium text-gray-800 text-sm">🏙️ City Announcements</p>
                        <p class="text-xs text-gray-400">Receive important city-wide updates and announcements</p>
                    </div>
                </label>

                <button type="submit"
                    class="w-full bg-yellow-500 text-white py-3 rounded-xl text-sm font-semibold hover:bg-yellow-600 transition">
                    💾 Save Preferences
                </button>
            </form>
        </div>
    </div>

    <!-- Stats Card -->
    <div class="bg-white rounded-2xl shadow p-5 mt-4">
        <h3 class="font-semibold text-gray-700 mb-4">📊 Your Activity</h3>
        <div class="grid grid-cols-3 gap-3 text-center">
            @php
                $userTotal    = \App\Models\Complaint::where('user_id', auth()->id())->count();
                $userResolved = \App\Models\Complaint::where('user_id', auth()->id())->where('status','resolved')->count();
                $userPending  = \App\Models\Complaint::where('user_id', auth()->id())->where('status','pending')->count();
            @endphp
            <div class="bg-gray-50 rounded-xl p-3">
                <p class="text-2xl font-bold text-gray-700">{{ $userTotal }}</p>
                <p class="text-xs text-gray-400 mt-1">Total</p>
            </div>
            <div class="bg-green-50 rounded-xl p-3">
                <p class="text-2xl font-bold text-green-600">{{ $userResolved }}</p>
                <p class="text-xs text-gray-400 mt-1">Resolved</p>
            </div>
            <div class="bg-yellow-50 rounded-xl p-3">
                <p class="text-2xl font-bold text-yellow-500">{{ $userPending }}</p>
                <p class="text-xs text-gray-400 mt-1">Pending</p>
            </div>
        </div>
    </div>

</div>

<script>
function openTab(tab) {
    document.querySelectorAll('.tab-content').forEach(el => el.classList.add('hidden'));
    document.getElementById(tab).classList.remove('hidden');

    document.querySelectorAll('.tab-btn').forEach(btn => {
        btn.classList.remove('bg-blue-600','text-white');
        btn.classList.add('text-gray-500','hover:bg-gray-100');
    });
    document.getElementById('tab-' + tab).classList.add('bg-blue-600','text-white');
    document.getElementById('tab-' + tab).classList.remove('text-gray-500','hover:bg-gray-100');
}

function previewImage(event) {
    const reader = new FileReader();
    reader.onload = function() {
        document.getElementById('preview').src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
}
</script>

@endsection