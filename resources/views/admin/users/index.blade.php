@extends('layouts.admin')

@section('content')

<!-- Header -->
<div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-3">
    <div>
        <h1 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
            </svg>
            Users Management
        </h1>
        <p class="text-gray-400 text-sm mt-1">Manage all registered citizens</p>
    </div>
    <div class="flex gap-2">
        <span class="inline-flex items-center gap-1.5 bg-green-100 text-green-700 px-3 py-1.5 rounded-full text-xs font-medium">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
            </svg>
            Admins: {{ $users->where('role','admin')->count() }}
        </span>
        <span class="inline-flex items-center gap-1.5 bg-blue-100 text-blue-700 px-3 py-1.5 rounded-full text-xs font-medium">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
            </svg>
            Users: {{ $users->where('role','user')->count() }}
        </span>
    </div>
</div>

<!-- Search Bar -->
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4 mb-6">
    <div class="relative">
        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
        </div>
        <input type="text" id="searchInput"
            placeholder="Search by name, email, phone..."
            class="w-full border border-gray-200 rounded-xl pl-10 pr-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
    </div>
</div>

<!-- MOBILE: Cards -->
<div class="md:hidden space-y-4">
    @foreach($users as $user)
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden user-item"
        data-name="{{ strtolower($user->name) }}"
        data-email="{{ strtolower($user->email) }}"
        data-phone="{{ strtolower($user->phone ?? '') }}">

        <div class="h-1.5 w-full {{ $user->role == 'admin' ? 'bg-green-500' : 'bg-blue-500' }}"></div>

        <div class="p-4">
            <div class="flex items-center gap-4 mb-4">
                <img src="{{ $user->profile_image ? asset('storage/'.$user->profile_image) : 'https://ui-avatars.com/api/?name='.urlencode($user->name).'&background=3b82f6&color=fff' }}"
                    class="w-16 h-16 rounded-2xl object-cover shadow-sm border border-gray-100">

                <div class="flex-1">
                    <div class="flex items-center gap-2 mb-1">
                        <p class="font-bold text-gray-800">{{ $user->name }}</p>
                        <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-xs font-semibold
                            {{ $user->role == 'admin' ? 'bg-green-100 text-green-700' : 'bg-blue-100 text-blue-700' }}">
                            @if($user->role == 'admin')
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                </svg>
                                Admin
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                                User
                            @endif
                        </span>
                    </div>
                    <p class="text-sm text-gray-500">{{ $user->email }}</p>
                    <p class="text-xs text-gray-400 mt-0.5 flex items-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                        {{ $user->phone ?? 'N/A' }}
                    </p>
                </div>
            </div>

            @php
                $complaintCount = \App\Models\Complaint::where('user_id', $user->id)->count();
                $resolvedCount = \App\Models\Complaint::where('user_id', $user->id)->where('status','resolved')->count();
            @endphp
            <div class="grid grid-cols-2 gap-2 mb-4">
                <div class="bg-gray-50 rounded-xl p-3 text-center">
                    <p class="text-xl font-bold text-gray-700">{{ $complaintCount }}</p>
                    <p class="text-xs text-gray-400">Total Complaints</p>
                </div>
                <div class="bg-green-50 rounded-xl p-3 text-center">
                    <p class="text-xl font-bold text-green-600">{{ $resolvedCount }}</p>
                    <p class="text-xs text-gray-400">Resolved</p>
                </div>
            </div>

            @if($user->role != 'admin')
            <form action="/admin/users/{{ $user->id }}" method="POST"
                onsubmit="return confirm('Delete {{ $user->name }}?')">
                @csrf @method('DELETE')
                <button class="w-full flex items-center justify-center gap-1.5 bg-red-500 text-white py-2 rounded-xl text-sm font-semibold hover:bg-red-600 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                    </svg>
                    Delete User
                </button>
            </form>
            @else
            <div class="bg-gray-50 rounded-xl py-2 text-center text-xs text-gray-400 flex items-center justify-center gap-1.5">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                </svg>
                Admin account protected
            </div>
            @endif
        </div>
    </div>
    @endforeach
</div>

<!-- DESKTOP: Table -->
<div class="hidden md:block bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">

    <div class="px-6 py-4 border-b bg-gray-50 flex justify-between items-center">
        <p class="font-semibold text-gray-700">All Users</p>
        <p class="text-xs text-gray-400">Total: {{ $users->count() }}</p>
    </div>

    <table class="w-full text-sm">
        <thead class="text-gray-400 text-xs uppercase border-b">
            <tr>
                <th class="px-6 py-3 text-left font-medium">#</th>
                <th class="px-6 py-3 text-left font-medium">User</th>
                <th class="px-6 py-3 text-left font-medium">Contact</th>
                <th class="px-6 py-3 text-left font-medium">Complaints</th>
                <th class="px-6 py-3 text-left font-medium">Role</th>
                <th class="px-6 py-3 text-left font-medium">Joined</th>
                <th class="px-6 py-3 text-left font-medium">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-50">
            @foreach($users as $user)
            @php
                $complaintCount = \App\Models\Complaint::where('user_id', $user->id)->count();
                $resolvedCount = \App\Models\Complaint::where('user_id', $user->id)->where('status','resolved')->count();
            @endphp
            <tr class="hover:bg-gray-50 transition user-item"
                data-name="{{ strtolower($user->name) }}"
                data-email="{{ strtolower($user->email) }}"
                data-phone="{{ strtolower($user->phone ?? '') }}">

                <td class="px-6 py-4 text-gray-400 font-mono text-xs">{{ $loop->iteration }}</td>

                <td class="px-6 py-4">
                    <div class="flex items-center gap-3">
                        <img src="{{ $user->profile_image ? asset('storage/'.$user->profile_image) : 'https://ui-avatars.com/api/?name='.urlencode($user->name).'&background=3b82f6&color=fff' }}"
                            class="w-11 h-11 rounded-xl object-cover shadow-sm border border-gray-100">
                        <div>
                            <p class="font-semibold text-gray-800">{{ $user->name }}</p>
                            <p class="text-xs text-gray-400">ID: {{ $user->id }}</p>
                        </div>
                    </div>
                </td>

                <td class="px-6 py-4">
                    <p class="text-gray-700 text-sm">{{ $user->email }}</p>
                    <p class="text-gray-400 text-xs mt-0.5 flex items-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                        {{ $user->phone ?? 'N/A' }}
                    </p>
                </td>

                <td class="px-6 py-4">
                    <div class="flex items-center gap-3">
                        <div class="text-center">
                            <p class="font-bold text-gray-700">{{ $complaintCount }}</p>
                            <p class="text-xs text-gray-400">Total</p>
                        </div>
                        <div class="w-px h-8 bg-gray-200"></div>
                        <div class="text-center">
                            <p class="font-bold text-green-600">{{ $resolvedCount }}</p>
                            <p class="text-xs text-gray-400">Resolved</p>
                        </div>
                    </div>
                </td>

                <td class="px-6 py-4">
                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-semibold
                        {{ $user->role == 'admin' ? 'bg-green-100 text-green-700' : 'bg-blue-100 text-blue-700' }}">
                        @if($user->role == 'admin')
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                            </svg>
                            Admin
                        @else
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            User
                        @endif
                    </span>
                </td>

                <td class="px-6 py-4 text-gray-400 text-xs">
                    {{ $user->created_at->format('d M Y') }}
                </td>

                <td class="px-6 py-4">
                    @if($user->role != 'admin')
                    <form action="/admin/users/{{ $user->id }}" method="POST"
                        onsubmit="return confirm('Delete {{ $user->name }}?')">
                        @csrf @method('DELETE')
                        <button class="flex items-center gap-1.5 bg-red-500 text-white px-4 py-1.5 rounded-xl text-xs font-semibold hover:bg-red-600 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                            Delete
                        </button>
                    </form>
                    @else
                    <span class="inline-flex items-center gap-1 text-gray-300 text-xs">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                        Protected
                    </span>
                    @endif
                </td>

            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- No Results -->
<div id="noResults" class="hidden text-center py-16 text-gray-400">
    <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
        </svg>
    </div>
    <p class="font-medium">No users found</p>
</div>

<script>
document.getElementById('searchInput').addEventListener('input', function() {
    const search = this.value.toLowerCase();
    let visible = 0;

    document.querySelectorAll('.user-item').forEach(item => {
        const match = !search ||
            item.dataset.name.includes(search) ||
            item.dataset.email.includes(search) ||
            item.dataset.phone.includes(search);
        item.style.display = match ? '' : 'none';
        if(match) visible++;
    });

    document.getElementById('noResults').classList.toggle('hidden', visible > 0);
});
</script>

@endsection