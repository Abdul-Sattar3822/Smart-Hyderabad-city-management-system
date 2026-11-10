@extends('layouts.admin')

@section('content')

<!-- Header -->
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-800">🔍 Search & Filters</h1>
    <p class="text-gray-400 text-sm mt-1">Filter complaints by various criteria</p>
</div>

<!-- Filter Form -->
<div class="bg-white rounded-2xl shadow p-6 mb-6">
    <form method="GET" action="{{ route('admin.filters') }}">

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">

            <!-- Category -->
            <div>
                <label class="block text-xs font-semibold text-gray-500 uppercase mb-2">📂 Category</label>
                <select name="category"
                    class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white">
                    <option value="">All Categories</option>
                    <option value="water" {{ request('category')=='water'?'selected':'' }}>💧 Water</option>
                    <option value="electricity" {{ request('category')=='electricity'?'selected':'' }}>⚡ Electricity</option>
                    <option value="roads" {{ request('category')=='roads'?'selected':'' }}>🛣️ Roads</option>
                    <option value="sanitation" {{ request('category')=='sanitation'?'selected':'' }}>🧹 Sanitation</option>
                    <option value="parks" {{ request('category')=='parks'?'selected':'' }}>🌳 Parks</option>
                    <option value="transport" {{ request('category')=='transport'?'selected':'' }}>🚌 Transport</option>
                </select>
            </div>

            <!-- Status -->
            <div>
                <label class="block text-xs font-semibold text-gray-500 uppercase mb-2">📊 Status</label>
                <select name="status"
                    class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white">
                    <option value="">All Status</option>
                    <option value="pending" {{ request('status')=='pending'?'selected':'' }}>⏳ Pending</option>
                    <option value="in_progress" {{ request('status')=='in_progress'?'selected':'' }}>🔄 In Progress</option>
                    <option value="resolved" {{ request('status')=='resolved'?'selected':'' }}>✅ Resolved</option>
                </select>
            </div>

            <!-- Priority -->
            <div>
                <label class="block text-xs font-semibold text-gray-500 uppercase mb-2">🔥 Priority</label>
                <select name="priority"
                    class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white">
                    <option value="">All Priorities</option>
                    <option value="high" {{ request('priority')=='high'?'selected':'' }}>🔥 High</option>
                    <option value="medium" {{ request('priority')=='medium'?'selected':'' }}>⚠️ Medium</option>
                    <option value="low" {{ request('priority')=='low'?'selected':'' }}>✅ Low</option>
                </select>
            </div>

            <!-- City -->
            <div>
                <label class="block text-xs font-semibold text-gray-500 uppercase mb-2">🏙️ City</label>
                <input type="text" name="city"
                    value="{{ request('city') }}"
                    placeholder="Enter city name..."
                    class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- Date From -->
            <div>
                <label class="block text-xs font-semibold text-gray-500 uppercase mb-2">📅 Date From</label>
                <input type="date" name="date_from"
                    value="{{ request('date_from') }}"
                    class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- Date To -->
            <div>
                <label class="block text-xs font-semibold text-gray-500 uppercase mb-2">📅 Date To</label>
                <input type="date" name="date_to"
                    value="{{ request('date_to') }}"
                    class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

        </div>

        <!-- Buttons -->
        <div class="flex gap-3">
            <button type="submit"
                class="bg-blue-600 text-white px-6 py-2.5 rounded-xl text-sm font-semibold hover:bg-blue-700 transition">
                🔍 Apply Filters
            </button>
            <a href="{{ route('admin.filters') }}"
                class="bg-gray-100 text-gray-600 px-6 py-2.5 rounded-xl text-sm font-semibold hover:bg-gray-200 transition">
                🔄 Reset
            </a>
        </div>

    </form>
</div>

<!-- Results -->
@if(request()->anyFilled(['category','status','priority','city','date_from','date_to']))

@php
    $query = \App\Models\Complaint::with('user');
    if(request('category'))  $query->where('category',  request('category'));
    if(request('status'))    $query->where('status',    request('status'));
    if(request('priority'))  $query->where('priority',  request('priority'));
    if(request('city'))      $query->where('city', 'like', '%'.request('city').'%');
    if(request('date_from')) $query->whereDate('created_at', '>=', request('date_from'));
    if(request('date_to'))   $query->whereDate('created_at', '<=', request('date_to'));
    $results = $query->latest()->get();
@endphp

<!-- Results Header -->
<div class="flex justify-between items-center mb-4">
    <h3 class="font-semibold text-gray-700">
        Results
        <span class="bg-blue-100 text-blue-600 px-2 py-0.5 rounded-full text-xs ml-2">
            {{ $results->count() }} found
        </span>
    </h3>
</div>

@if($results->count() > 0)

{{-- MOBILE: Cards --}}
<div class="md:hidden space-y-4">
    @foreach($results as $c)
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="h-1 w-full
            {{ $c->priority == 'high' ? 'bg-red-500' :
               ($c->priority == 'medium' ? 'bg-yellow-400' : 'bg-green-400') }}">
        </div>
        <div class="p-4">
            <div class="flex justify-between items-start mb-2">
                <div>
                    <p class="font-bold text-gray-800">{{ $c->title }}</p>
                    <p class="text-xs text-gray-400">#{{ $c->id }} • {{ $c->user->name ?? 'N/A' }}</p>
                </div>
                <span class="px-2 py-1 rounded-full text-xs font-bold
                    {{ $c->status == 'pending' ? 'bg-yellow-100 text-yellow-700' :
                       ($c->status == 'in_progress' ? 'bg-blue-100 text-blue-700' :
                       'bg-green-100 text-green-700') }}">
                    {{ ucfirst(str_replace('_',' ',$c->status)) }}
                </span>
            </div>
            <div class="flex flex-wrap gap-2 mt-2">
                <span class="bg-gray-100 text-gray-600 px-2 py-1 rounded-lg text-xs">📂 {{ ucfirst($c->category ?? 'N/A') }}</span>
                <span class="bg-gray-100 text-gray-600 px-2 py-1 rounded-lg text-xs">🏙️ {{ $c->city ?? 'N/A' }}</span>
                <span class="px-2 py-1 rounded-lg text-xs font-bold
                    {{ $c->priority == 'high' ? 'bg-red-100 text-red-600' :
                       ($c->priority == 'medium' ? 'bg-yellow-100 text-yellow-600' :
                       'bg-green-100 text-green-600') }}">
                    {{ ucfirst($c->priority ?? 'N/A') }}
                </span>
                <span class="bg-gray-100 text-gray-600 px-2 py-1 rounded-lg text-xs">📅 {{ $c->created_at->format('d M Y') }}</span>
            </div>
        </div>
    </div>
    @endforeach
</div>

{{-- DESKTOP: Table --}}
<div class="hidden md:block bg-white rounded-2xl shadow overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-gray-50 text-gray-400 text-xs uppercase border-b">
            <tr>
                <th class="px-5 py-3 text-left">Complaint</th>
                <th class="px-5 py-3 text-left">Category</th>
                <th class="px-5 py-3 text-left">City</th>
                <th class="px-5 py-3 text-left">Priority</th>
                <th class="px-5 py-3 text-left">Status</th>
                <th class="px-5 py-3 text-left">Date</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-50">
            @foreach($results as $c)
            <tr class="hover:bg-gray-50 transition">
                <td class="px-5 py-4">
                    <p class="font-semibold text-gray-800">{{ $c->title }}</p>
                    <p class="text-xs text-gray-400">#{{ $c->id }} • {{ $c->user->name ?? 'N/A' }}</p>
                </td>
                <td class="px-5 py-4">
                    <span class="bg-gray-100 text-gray-600 px-2 py-1 rounded-lg text-xs">
                        {{ ucfirst($c->category ?? 'N/A') }}
                    </span>
                </td>
                <td class="px-5 py-4 text-gray-600 text-xs">{{ $c->city ?? 'N/A' }}</td>
                <td class="px-5 py-4">
                    <span class="px-2 py-1 rounded-full text-xs font-bold
                        {{ $c->priority == 'high' ? 'bg-red-100 text-red-600' :
                           ($c->priority == 'medium' ? 'bg-yellow-100 text-yellow-600' :
                           'bg-green-100 text-green-600') }}">
                        {{ $c->priority == 'high' ? '🔥' : ($c->priority == 'medium' ? '⚠️' : '✅') }}
                        {{ ucfirst($c->priority ?? 'N/A') }}
                    </span>
                </td>
                <td class="px-5 py-4">
                    <span class="px-2 py-1 rounded-full text-xs font-bold
                        {{ $c->status == 'pending' ? 'bg-yellow-100 text-yellow-700' :
                           ($c->status == 'in_progress' ? 'bg-blue-100 text-blue-700' :
                           'bg-green-100 text-green-700') }}">
                        {{ ucfirst(str_replace('_',' ',$c->status)) }}
                    </span>
                </td>
                <td class="px-5 py-4 text-gray-400 text-xs">
                    {{ $c->created_at->format('d M Y') }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@else
<div class="bg-white rounded-2xl shadow py-16 text-center text-gray-400">
    <p class="text-5xl mb-3">🔍</p>
    <p class="font-medium text-gray-500">No complaints found</p>
    <p class="text-sm mt-1">Try different filter criteria</p>
</div>
@endif

@endif

@endsection