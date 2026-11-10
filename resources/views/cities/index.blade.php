@extends('layouts.admin')

@section('content')

<!-- Header -->
<div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-3">
    <div>
        <h1 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
            </svg>
            Cities Management
        </h1>
        <p class="text-gray-400 text-sm mt-1">Manage cities under Smart Hyderabad system</p>
    </div>
    <a href="/admin/cities/create"
        class="bg-blue-600 text-white px-5 py-2.5 rounded-xl text-sm font-semibold hover:bg-blue-700 transition shadow flex items-center gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
        Add New City
    </a>
</div>

<!-- Stats -->
@php
    $totalPop = $cities->sum('population');
@endphp
<div class="grid grid-cols-2 md:grid-cols-3 gap-4 mb-6">
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
        <p class="text-gray-400 text-xs mb-1">Total Cities</p>
        <p class="text-3xl font-bold text-blue-600">{{ $cities->total() }}</p>
    </div>
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
        <p class="text-gray-400 text-xs mb-1">Total Population</p>
        <p class="text-3xl font-bold text-green-600">{{ number_format($totalPop) }}</p>
    </div>
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 col-span-2 md:col-span-1">
        <p class="text-gray-400 text-xs mb-1">Total Complaints</p>
        <p class="text-3xl font-bold text-purple-600">{{ \App\Models\Complaint::count() }}</p>
    </div>
</div>

<!-- Search -->
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4 mb-6">
    <div class="relative">
        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
        </div>
        <input type="text" id="searchInput"
            placeholder="Search by city name or district..."
            class="w-full border border-gray-200 rounded-xl pl-10 pr-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
    </div>
</div>

<!-- MOBILE: Cards -->
<div class="md:hidden space-y-4">
    @foreach($cities as $city)
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden city-item"
        data-name="{{ strtolower($city->name) }}"
        data-district="{{ strtolower($city->district ?? '') }}">

        <div class="h-1.5 bg-blue-500"></div>
        <div class="p-4">
            <div class="flex justify-between items-start mb-3">
                <div>
                    <p class="font-bold text-gray-800 text-lg">{{ $city->name }}</p>
                    <p class="text-xs text-gray-400 mt-0.5 flex items-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        {{ $city->district ?? 'N/A' }}
                    </p>
                </div>
                <div class="bg-blue-50 rounded-xl px-3 py-2 text-center">
                    <p class="font-bold text-blue-600 text-sm">{{ number_format($city->population) }}</p>
                    <p class="text-xs text-gray-400">Population</p>
                </div>
            </div>

            @php
                $cityComplaints = \App\Models\Complaint::where('city', $city->name)->count();
                $cityResolved   = \App\Models\Complaint::where('city', $city->name)->where('status','resolved')->count();
            @endphp
            <div class="grid grid-cols-2 gap-2 mb-4">
                <div class="bg-gray-50 rounded-xl p-3 text-center">
                    <p class="font-bold text-gray-700">{{ $cityComplaints }}</p>
                    <p class="text-xs text-gray-400">Complaints</p>
                </div>
                <div class="bg-green-50 rounded-xl p-3 text-center">
                    <p class="font-bold text-green-600">{{ $cityResolved }}</p>
                    <p class="text-xs text-gray-400">Resolved</p>
                </div>
            </div>

            <div class="flex gap-2">
                <a href="/admin/cities/{{ $city->id }}/edit"
                    class="flex-1 flex items-center justify-center gap-1.5 bg-yellow-400 text-white py-2 rounded-xl text-xs font-semibold hover:bg-yellow-500 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                    Edit
                </a>
                <form action="/admin/cities/{{ $city->id }}" method="POST"
                    onsubmit="return confirm('Delete {{ $city->name }}?')" class="flex-1">
                    @csrf @method('DELETE')
                    <button class="w-full flex items-center justify-center gap-1.5 bg-red-500 text-white py-2 rounded-xl text-xs font-semibold hover:bg-red-600 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                        Delete
                    </button>
                </form>
            </div>
        </div>
    </div>
    @endforeach
</div>

<!-- DESKTOP: Table -->
<div class="hidden md:block bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="px-6 py-4 border-b bg-gray-50 flex justify-between items-center">
        <p class="font-semibold text-gray-700">All Cities</p>
        <p class="text-xs text-gray-400">{{ $cities->total() }} cities total</p>
    </div>
    <table class="w-full text-sm">
        <thead class="text-gray-400 text-xs uppercase border-b">
            <tr>
                <th class="px-6 py-3 text-left font-medium">#</th>
                <th class="px-6 py-3 text-left font-medium">City</th>
                <th class="px-6 py-3 text-left font-medium">District</th>
                <th class="px-6 py-3 text-left font-medium">Population</th>
                <th class="px-6 py-3 text-left font-medium">Complaints</th>
                <th class="px-6 py-3 text-left font-medium">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-50">
            @foreach($cities as $city)
            @php
                $cityComplaints = \App\Models\Complaint::where('city', $city->name)->count();
                $cityResolved   = \App\Models\Complaint::where('city', $city->name)->where('status','resolved')->count();
            @endphp
            <tr class="hover:bg-gray-50 transition city-item"
                data-name="{{ strtolower($city->name) }}"
                data-district="{{ strtolower($city->district ?? '') }}">

                <td class="px-6 py-4 text-gray-400 font-mono text-xs">{{ $loop->iteration }}</td>

                <td class="px-6 py-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-blue-100 rounded-xl flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                            </svg>
                        </div>
                        <p class="font-bold text-gray-800">{{ $city->name }}</p>
                    </div>
                </td>

                <td class="px-6 py-4 text-gray-600">
                    <span class="flex items-center gap-1.5">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        {{ $city->district ?? 'N/A' }}
                    </span>
                </td>

                <td class="px-6 py-4">
                    <p class="font-semibold text-gray-800">{{ number_format($city->population) }}</p>
                    <p class="text-xs text-gray-400">residents</p>
                </td>

                <td class="px-6 py-4">
                    <div class="flex items-center gap-3">
                        <div class="text-center">
                            <p class="font-bold text-gray-700">{{ $cityComplaints }}</p>
                            <p class="text-xs text-gray-400">Total</p>
                        </div>
                        <div class="w-px h-8 bg-gray-200"></div>
                        <div class="text-center">
                            <p class="font-bold text-green-600">{{ $cityResolved }}</p>
                            <p class="text-xs text-gray-400">Resolved</p>
                        </div>
                    </div>
                </td>

                <td class="px-6 py-4">
                    <div class="flex gap-2">
                        <a href="/admin/cities/{{ $city->id }}/edit"
                            class="flex items-center gap-1.5 bg-yellow-400 text-white px-4 py-1.5 rounded-xl text-xs font-semibold hover:bg-yellow-500 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                            Edit
                        </a>
                        <form action="/admin/cities/{{ $city->id }}" method="POST"
                            onsubmit="return confirm('Delete {{ $city->name }}?')">
                            @csrf @method('DELETE')
                            <button class="flex items-center gap-1.5 bg-red-500 text-white px-4 py-1.5 rounded-xl text-xs font-semibold hover:bg-red-600 transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                                Delete
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Pagination -->
    <div class="px-6 py-4 border-t bg-gray-50">
        {{ $cities->links() }}
    </div>
</div>

<!-- No Results -->
<div id="noResults" class="hidden text-center py-16 text-gray-400">
    <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
        </svg>
    </div>
    <p class="font-medium">No cities found</p>
</div>

<script>
document.getElementById('searchInput').addEventListener('input', function() {
    const search = this.value.toLowerCase();
    let visible = 0;

    document.querySelectorAll('.city-item').forEach(item => {
        const match = !search ||
            item.dataset.name.includes(search) ||
            item.dataset.district.includes(search);
        item.style.display = match ? '' : 'none';
        if(match) visible++;
    });

    document.getElementById('noResults').classList.toggle('hidden', visible > 0);
});
</script>

@endsection