@extends('layouts.user')

@section('content')

<div class="max-w-3xl mx-auto">

    <!-- Header -->
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">👤 My Profile</h1>
        <p class="text-gray-400 text-sm mt-1">View and update your profile</p>
    </div>

    <!-- Profile Hero -->
    <div class="bg-gradient-to-r from-blue-600 to-indigo-600 rounded-2xl p-6 mb-6 text-white">
        <div class="flex flex-col md:flex-row items-center md:items-start gap-5">
            <img src="{{ auth()->user()->profile_image ? asset('storage/' . auth()->user()->profile_image) : 'https://ui-avatars.com/api/?name='.urlencode(auth()->user()->name).'&background=ffffff&color=3b82f6&size=128' }}"
                class="w-24 h-24 rounded-2xl object-cover border-4 border-white shadow-lg">
            <div class="text-center md:text-left">
                <h2 class="text-2xl font-bold">{{ auth()->user()->name }}</h2>
                <p class="text-blue-200 mt-1">{{ auth()->user()->email }}</p>
                <div class="flex flex-wrap gap-2 mt-3 justify-center md:justify-start">
                    <span class="bg-white bg-opacity-20 px-3 py-1 rounded-full text-xs font-semibold">
                        👤 Citizen
                    </span>
                    <span class="bg-white bg-opacity-20 px-3 py-1 rounded-full text-xs font-semibold">
                        📞 {{ auth()->user()->phone ?? 'No phone' }}
                    </span>
                    <span class="bg-white bg-opacity-20 px-3 py-1 rounded-full text-xs font-semibold">
                        📅 Joined {{ auth()->user()->created_at->format('M Y') }}
                    </span>
                </div>
            </div>
            @php
                $total    = \App\Models\Complaint::where('user_id', auth()->id())->count();
                $resolved = \App\Models\Complaint::where('user_id', auth()->id())->where('status','resolved')->count();
            @endphp
            <div class="md:ml-auto grid grid-cols-2 gap-3 text-center">
                <div class="bg-white bg-opacity-15 rounded-xl p-3">
                    <p class="text-2xl font-bold">{{ $total }}</p>
                    <p class="text-blue-200 text-xs">Complaints</p>
                </div>
                <div class="bg-white bg-opacity-15 rounded-xl p-3">
                    <p class="text-2xl font-bold">{{ $resolved }}</p>
                    <p class="text-blue-200 text-xs">Resolved</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Update Form -->
    <div class="bg-white rounded-2xl shadow p-6">

        <div class="flex items-center gap-3 mb-5 pb-5 border-b">
            <div class="w-10 h-10 bg-blue-100 rounded-xl flex items-center justify-center text-xl">✏️</div>
            <div>
                <p class="font-bold text-gray-800">Update Profile</p>
                <p class="text-xs text-gray-400">Change your personal information</p>
            </div>
        </div>

        @if(session('success'))
        <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl text-sm mb-4">
            ✅ {{ session('success') }}
        </div>
        @endif

        <form method="POST" action="{{ route('profile.update.custom') }}" enctype="multipart/form-data" class="space-y-4">
            @csrf

            <!-- Profile Photo -->
            <div>
                <label class="block text-xs font-semibold text-gray-500 uppercase mb-2">Profile Photo</label>
                <div class="flex items-center gap-4">
                    <img id="preview"
                        src="{{ auth()->user()->profile_image ? asset('storage/' . auth()->user()->profile_image) : 'https://ui-avatars.com/api/?name='.urlencode(auth()->user()->name).'&background=3b82f6&color=fff' }}"
                        class="w-16 h-16 rounded-2xl object-cover shadow border-2 border-blue-200">
                    <input type="file" name="profile_image" accept="image/*"
                        onchange="previewImage(event)"
                        class="text-sm text-gray-500 file:mr-3 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-blue-600 hover:file:bg-blue-100">
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

            <button type="submit"
                class="w-full bg-blue-600 text-white py-3 rounded-xl text-sm font-semibold hover:bg-blue-700 transition">
                💾 Update Profile
            </button>
        </form>
    </div>

</div>

<script>
function previewImage(event) {
    const reader = new FileReader();
    reader.onload = function() {
        document.getElementById('preview').src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
}
</script>

@endsection