@extends('layouts.admin')

@section('content')

<!-- Header -->
<div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-3">
    <div>
        <h1 class="text-2xl font-bold text-gray-800">All Complaints</h1>
        <p class="text-gray-400 text-sm mt-1">Manage and track all citizen complaints</p>
    </div>
    <div class="flex flex-wrap gap-2">
        <span class="inline-flex items-center gap-1.5 bg-yellow-100 text-yellow-700 px-3 py-1.5 rounded-full text-xs font-medium">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            Pending: {{ $complaints->where('status','pending')->count() }}
        </span>
        <span class="inline-flex items-center gap-1.5 bg-blue-100 text-blue-700 px-3 py-1.5 rounded-full text-xs font-medium">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
            </svg>
            In Progress: {{ $complaints->where('status','in_progress')->count() }}
        </span>
        <span class="inline-flex items-center gap-1.5 bg-green-100 text-green-700 px-3 py-1.5 rounded-full text-xs font-medium">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            Resolved: {{ $complaints->where('status','resolved')->count() }}
        </span>
    </div>
</div>

<!-- Search & Filter Bar -->
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4 mb-6">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
        <div class="relative md:col-span-2">
            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
            </div>
            <input type="text" id="searchInput"
                placeholder="Search by ID, title, user, city..."
                class="w-full border border-gray-200 rounded-xl pl-10 pr-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>
        <select id="statusFilter"
            class="border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white">
            <option value="">All Status</option>
            <option value="pending">Pending</option>
            <option value="in_progress">In Progress</option>
            <option value="resolved">Resolved</option>
        </select>
    </div>
</div>

<!-- MOBILE: Cards -->
<div class="md:hidden space-y-4">
    @foreach($complaints as $c)
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden complaint-item"
        data-id="{{ $c->id }}"
        data-title="{{ strtolower($c->title) }}"
        data-user="{{ strtolower($c->user->name ?? '') }}"
        data-city="{{ strtolower($c->city ?? '') }}"
        data-status="{{ $c->status }}">

        <div class="h-1.5 w-full
            {{ $c->priority == 'high' ? 'bg-red-500' :
               ($c->priority == 'medium' ? 'bg-yellow-400' : 'bg-green-400') }}">
        </div>

        <div class="p-4">
            <div class="flex justify-between items-start mb-3">
                <div class="flex-1 min-w-0">
                    <div class="flex items-center gap-2 mb-1">
                        <span class="text-xs text-gray-400 font-mono">#{{ $c->id }}</span>
                        <span class="px-2 py-0.5 rounded-full text-xs font-semibold
                            {{ $c->status == 'pending' ? 'bg-yellow-100 text-yellow-700' :
                               ($c->status == 'in_progress' ? 'bg-blue-100 text-blue-700' :
                               'bg-green-100 text-green-700') }}">
                            {{ ucfirst(str_replace('_',' ',$c->status)) }}
                        </span>
                    </div>
                    <p class="font-bold text-gray-800 text-base">{{ $c->title }}</p>
                    <p class="text-xs text-gray-500 mt-0.5">{{ $c->user->name ?? 'N/A' }} • {{ $c->city ?? 'N/A' }}</p>
                </div>
                @if($c->image)
                <img src="{{ asset('storage/' . $c->image) }}"
                    class="w-16 h-16 rounded-xl object-cover ml-3 cursor-pointer shadow-sm border border-gray-100"
                    onclick="openImage(this.src)">
                @endif
            </div>

            <div class="flex flex-wrap gap-2 mb-4">
                <span class="bg-gray-100 text-gray-600 px-2.5 py-1 rounded-lg text-xs font-medium">
                    {{ ucfirst($c->category ?? 'N/A') }}
                </span>
                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg text-xs font-semibold
                    {{ $c->priority == 'high' ? 'bg-red-100 text-red-600' :
                       ($c->priority == 'medium' ? 'bg-yellow-100 text-yellow-600' :
                       'bg-green-100 text-green-600') }}">
                    @if($c->priority == 'high')
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M12.395 2.553a1 1 0 00-1.45-.385c-.345.23-.614.558-.822.88-.214.33-.403.713-.57 1.116-.334.804-.614 1.768-.84 2.734a31.365 31.365 0 00-.613 3.58 2.64 2.64 0 01-.945-1.067c-.328-.68-.398-1.534-.398-2.654A1 1 0 005.05 6.05 6.981 6.981 0 003 11a7 7 0 1011.95-4.95c-.592-.591-.98-.985-1.348-1.467-.363-.476-.724-1.063-1.207-2.03zM12.12 15.12A3 3 0 017 13s.879.5 2.5.5c0-1 .5-4 1.25-4.5.5 1 .786 1.293 1.371 1.879A2.99 2.99 0 0113 13a2.99 2.99 0 01-.879 2.121z" clip-rule="evenodd"/></svg>
                    @elseif($c->priority == 'medium')
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                    @else
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    @endif
                    {{ ucfirst($c->priority ?? 'N/A') }}
                </span>
                @if($c->latitude && $c->longitude)
                <a href="https://www.google.com/maps?q={{ $c->latitude }},{{ $c->longitude }}" target="_blank"
                    class="inline-flex items-center gap-1 bg-blue-50 text-blue-600 px-2.5 py-1 rounded-lg text-xs font-medium">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    Map
                </a>
                @endif
            </div>

            <div class="grid grid-cols-2 gap-2 mb-3">
                <a href="{{ route('admin.complaints.show', $c->id) }}"
                    class="flex items-center justify-center gap-1.5 bg-gray-900 text-white py-2 rounded-xl text-xs font-semibold hover:bg-gray-700 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                    View
                </a>
                <form method="POST" action="{{ route('admin.complaints.delete', $c->id) }}" onsubmit="return confirm('Delete this complaint?')">
                    @csrf @method('DELETE')
                    <button class="w-full flex items-center justify-center gap-1.5 bg-red-500 text-white py-2 rounded-xl text-xs font-semibold hover:bg-red-600 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                        Delete
                    </button>
                </form>
            </div>

            <form method="POST" action="{{ route('admin.update.status', $c->id) }}" class="flex gap-2 mb-2">
                @csrf
                <select name="status" class="border border-gray-200 rounded-xl px-3 py-2 text-xs flex-1 bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    <option value="pending" {{ $c->status=='pending'?'selected':'' }}>Pending</option>
                    <option value="in_progress" {{ $c->status=='in_progress'?'selected':'' }}>In Progress</option>
                    <option value="resolved" {{ $c->status=='resolved'?'selected':'' }}>Resolved</option>
                </select>
                <button class="bg-blue-600 text-white px-4 py-2 rounded-xl text-xs font-semibold hover:bg-blue-700 transition">Update</button>
            </form>

            <form method="POST" action="{{ route('admin.complaints.assign-department', $c) }}" class="flex gap-2">
                @csrf
                <select name="department_id" class="border border-gray-200 rounded-xl px-3 py-2 text-xs flex-1 bg-white focus:ring-2 focus:ring-purple-500 focus:outline-none">
                    <option value="">Assign Department</option>
                    @foreach($departments as $dept)
                        <option value="{{ $dept->id }}" {{ $c->department_id == $dept->id ? 'selected' : '' }}>
                            {{ $dept->name }}
                        </option>
                    @endforeach
                </select>
                <button class="bg-purple-600 text-white px-4 py-2 rounded-xl text-xs font-semibold hover:bg-purple-700 transition">Assign</button>
            </form>
        </div>
    </div>
    @endforeach
</div>

<!-- DESKTOP: Table -->
<div class="hidden md:block bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <table class="w-full text-sm">
        <thead class="text-gray-500 text-xs uppercase border-b bg-gray-50">
            <tr>
                <th class="px-5 py-4 text-left font-medium">Complaint</th>
                <th class="px-5 py-4 text-left font-medium">Category</th>
                <th class="px-5 py-4 text-left font-medium">Image</th>
                <th class="px-5 py-4 text-left font-medium">Priority</th>
                <th class="px-5 py-4 text-left font-medium">Status</th>
                <th class="px-5 py-4 text-left font-medium">Department</th>
                <th class="px-5 py-4 text-left font-medium">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-50">
            @foreach($complaints as $c)
            <tr class="hover:bg-gray-50 transition complaint-item"
                data-id="{{ $c->id }}"
                data-title="{{ strtolower($c->title) }}"
                data-user="{{ strtolower($c->user->name ?? '') }}"
                data-city="{{ strtolower($c->city ?? '') }}"
                data-status="{{ $c->status }}">

                <td class="px-5 py-4">
                    <div class="flex items-center gap-3">
                        <div class="w-1 h-12 rounded-full flex-shrink-0
                            {{ $c->priority == 'high' ? 'bg-red-500' :
                               ($c->priority == 'medium' ? 'bg-yellow-400' : 'bg-green-400') }}">
                        </div>
                        <div>
                            <p class="font-bold text-gray-800">{{ $c->title }}</p>
                            <p class="text-xs text-gray-400 mt-0.5">
                                #{{ $c->id }} • {{ $c->user->name ?? 'N/A' }} • {{ $c->city ?? 'N/A' }}
                            </p>
                            @if($c->latitude && $c->longitude)
                            <a href="https://www.google.com/maps?q={{ $c->latitude }},{{ $c->longitude }}"
                                target="_blank" class="inline-flex items-center gap-1 text-blue-500 text-xs hover:underline mt-0.5">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                Map
                            </a>
                            @endif
                        </div>
                    </div>
                </td>

                <td class="px-5 py-4">
                    <span class="bg-gray-100 text-gray-700 px-2.5 py-1 rounded-lg text-xs font-medium">
                        {{ ucfirst($c->category ?? 'N/A') }}
                    </span>
                </td>

                <td class="px-5 py-4">
                    @if($c->image)
                        <img src="{{ asset('storage/' . $c->image) }}"
                            class="w-14 h-14 rounded-xl object-cover cursor-pointer shadow-sm border border-gray-100 hover:opacity-80 transition"
                            onclick="openImage(this.src)">
                    @else
                        <span class="text-gray-300 text-xs">No image</span>
                    @endif
                </td>

                <td class="px-5 py-4">
                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-semibold
                        {{ $c->priority == 'high' ? 'bg-red-100 text-red-600' :
                           ($c->priority == 'medium' ? 'bg-yellow-100 text-yellow-600' :
                           'bg-green-100 text-green-600') }}">
                        @if($c->priority == 'high')
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M12.395 2.553a1 1 0 00-1.45-.385c-.345.23-.614.558-.822.88-.214.33-.403.713-.57 1.116-.334.804-.614 1.768-.84 2.734a31.365 31.365 0 00-.613 3.58 2.64 2.64 0 01-.945-1.067c-.328-.68-.398-1.534-.398-2.654A1 1 0 005.05 6.05 6.981 6.981 0 003 11a7 7 0 1011.95-4.95c-.592-.591-.98-.985-1.348-1.467-.363-.476-.724-1.063-1.207-2.03zM12.12 15.12A3 3 0 017 13s.879.5 2.5.5c0-1 .5-4 1.25-4.5.5 1 .786 1.293 1.371 1.879A2.99 2.99 0 0113 13a2.99 2.99 0 01-.879 2.121z" clip-rule="evenodd"/></svg>
                        @elseif($c->priority == 'medium')
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                        @else
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        @endif
                        {{ ucfirst($c->priority ?? 'N/A') }}
                    </span>
                </td>

                <td class="px-5 py-4">
                    <form method="POST" action="{{ route('admin.update.status', $c->id) }}" class="flex gap-1.5 items-center">
                        @csrf
                        <select name="status"
                            class="border border-gray-200 rounded-xl px-2.5 py-1.5 text-xs bg-white focus:outline-none focus:ring-2 focus:ring-blue-400">
                            <option value="pending" {{ $c->status=='pending'?'selected':'' }}>Pending</option>
                            <option value="in_progress" {{ $c->status=='in_progress'?'selected':'' }}>In Progress</option>
                            <option value="resolved" {{ $c->status=='resolved'?'selected':'' }}>Resolved</option>
                        </select>
                        <button class="bg-blue-600 text-white w-7 h-7 rounded-lg text-xs hover:bg-blue-700 flex items-center justify-center transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                        </button>
                    </form>
                </td>

                <td class="px-5 py-4">
                    <form method="POST" action="{{ route('admin.complaints.assign-department', $c) }}" class="flex gap-1.5 items-center">
                        @csrf
                        <select name="department_id"
                            class="border border-gray-200 rounded-xl px-2.5 py-1.5 text-xs bg-white focus:outline-none focus:ring-2 focus:ring-purple-400">
                            <option value="">— Assign —</option>
                            @foreach($departments as $dept)
                                <option value="{{ $dept->id }}" {{ $c->department_id == $dept->id ? 'selected' : '' }}>
                                    {{ $dept->name }}
                                </option>
                            @endforeach
                        </select>
                        <button class="bg-purple-600 text-white w-7 h-7 rounded-lg text-xs hover:bg-purple-700 flex items-center justify-center transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                        </button>
                    </form>
                    @if($c->department)
                    <p class="text-xs text-green-600 mt-1.5 font-medium flex items-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        {{ $c->department->name }}
                    </p>
                    @endif
                </td>

                <td class="px-5 py-4">
                    <div class="flex flex-col gap-1.5">
                        <a href="{{ route('admin.complaints.show', $c->id) }}"
                            class="flex items-center justify-center gap-1 bg-gray-900 text-white px-3 py-1.5 rounded-xl text-xs font-semibold hover:bg-gray-700 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            View
                        </a>
                        <form method="POST" action="{{ route('admin.complaints.delete', $c->id) }}" onsubmit="return confirm('Delete?')">
                            @csrf @method('DELETE')
                            <button class="w-full flex items-center justify-center gap-1 bg-red-500 text-white px-3 py-1.5 rounded-xl text-xs font-semibold hover:bg-red-600 transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                Delete
                            </button>
                        </form>
                    </div>
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
    <p class="font-medium text-gray-500">No complaints found</p>
    <p class="text-sm mt-1">Try different search terms</p>
</div>

<!-- Image Modal -->
<div id="imageModal"
    class="hidden fixed inset-0 bg-black bg-opacity-80 flex items-center justify-center z-50 p-4"
    onclick="this.classList.add('hidden')">
    <img id="modalImg" class="max-w-full max-h-screen rounded-2xl shadow-2xl">
    <button class="absolute top-4 right-4 text-white text-2xl hover:text-gray-300">✕</button>
</div>

<script>
function openImage(src) {
    document.getElementById('imageModal').classList.remove('hidden');
    document.getElementById('modalImg').src = src;
}

document.getElementById('searchInput').addEventListener('input', filterComplaints);
document.getElementById('statusFilter').addEventListener('change', filterComplaints);

function filterComplaints() {
    const search = document.getElementById('searchInput').value.toLowerCase();
    const status = document.getElementById('statusFilter').value;
    let visible = 0;

    document.querySelectorAll('.complaint-item').forEach(item => {
        const matchSearch = !search ||
            item.dataset.id.includes(search) ||
            item.dataset.title.includes(search) ||
            item.dataset.user.includes(search) ||
            item.dataset.city.includes(search);
        const matchStatus = !status || item.dataset.status === status;
        const show = matchSearch && matchStatus;
        item.style.display = show ? '' : 'none';
        if(show) visible++;
    });

    document.getElementById('noResults').classList.toggle('hidden', visible > 0);
}
</script>

@endsection