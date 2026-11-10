@extends('layouts.admin')

@section('content')

<!-- Header -->
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
        </svg>
        Search & Filters
    </h1>
    <p class="text-gray-400 text-sm mt-1">Filter complaints by various criteria</p>
</div>

<!-- Filter Form -->
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-6">
    <form method="GET" action="{{ route('admin.filters') }}">

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">

            <!-- Category -->
            <div>
                <label class="block text-xs font-semibold text-gray-500 uppercase mb-2">Category</label>
                <select name="category"
                    class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white">
                    <option value="">All Categories</option>
                    <option value="water" {{ request('category')=='water'?'selected':'' }}>Water</option>
                    <option value="electricity" {{ request('category')=='electricity'?'selected':'' }}>Electricity</option>
                    <option value="roads" {{ request('category')=='roads'?'selected':'' }}>Roads</option>
                    <option value="sanitation" {{ request('category')=='sanitation'?'selected':'' }}>Sanitation</option>
                    <option value="parks" {{ request('category')=='parks'?'selected':'' }}>Parks</option>
                    <option value="transport" {{ request('category')=='transport'?'selected':'' }}>Transport</option>
                </select>
            </div>

            <!-- Status -->
            <div>
                <label class="block text-xs font-semibold text-gray-500 uppercase mb-2">Status</label>
                <select name="status"
                    class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white">
                    <option value="">All Status</option>
                    <option value="pending" {{ request('status')=='pending'?'selected':'' }}>Pending</option>
                    <option value="in_progress" {{ request('status')=='in_progress'?'selected':'' }}>In Progress</option>
                    <option value="resolved" {{ request('status')=='resolved'?'selected':'' }}>Resolved</option>
                </select>
            </div>

            <!-- Priority -->
            <div>
                <label class="block text-xs font-semibold text-gray-500 uppercase mb-2">Priority</label>
                <select name="priority"
                    class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white">
                    <option value="">All Priorities</option>
                    <option value="high" {{ request('priority')=='high'?'selected':'' }}>High</option>
                    <option value="medium" {{ request('priority')=='medium'?'selected':'' }}>Medium</option>
                    <option value="low" {{ request('priority')=='low'?'selected':'' }}>Low</option>
                </select>
            </div>

            <!-- City -->
            <div>
                <label class="block text-xs font-semibold text-gray-500 uppercase mb-2">City</label>
                <input type="text" name="city"
                    value="{{ request('city') }}"
                    placeholder="Enter city name..."
                    class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- Date From -->
            <div>
                <label class="block text-xs font-semibold text-gray-500 uppercase mb-2">Date From</label>
                <input type="date" name="date_from"
                    value="{{ request('date_from') }}"
                    class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- Date To -->
            <div>
                <label class="block text-xs font-semibold text-gray-500 uppercase mb-2">Date To</label>
                <input type="date" name="date_to"
                    value="{{ request('date_to') }}"
                    class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

        </div>

        <!-- Buttons -->
        <div class="flex gap-3">
            <button type="submit"
                class="bg-blue-600 text-white px-6 py-2.5 rounded-xl text-sm font-semibold hover:bg-blue-700 transition flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                Apply Filters
            </button>
            <a href="{{ route('admin.filters') }}"
                class="bg-gray-100 text-gray-600 px-6 py-2.5 rounded-xl text-sm font-semibold hover:bg-gray-200 transition flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                </svg>
                Reset
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
        <span class="bg-blue-100 text-blue-600 px-2.5 py-0.5 rounded-full text-xs ml-2">
            {{ $results->count() }} found
        </span>
    </h3>
</div>

@if($results->count() > 0)

{{-- MOBILE: Cards --}}
<div class="md:hidden space-y-4">
    @foreach($results as $c)
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="h-1.5 w-full
            {{ $c->priority == 'high' ? 'bg-red-500' :
               ($c->priority == 'medium' ? 'bg-yellow-400' : 'bg-green-400') }}">
        </div>
        <div class="p-4">
            <div class="flex justify-between items-start mb-2">
                <div>
                    <p class="font-bold text-gray-800">{{ $c->title }}</p>
                    <p class="text-xs text-gray-400">#{{ $c->id }} • {{ $c->user->name ?? 'N/A' }}</p>
                </div>
                <span class="px-2.5 py-1 rounded-full text-xs font-semibold
                    {{ $c->status == 'pending' ? 'bg-yellow-100 text-yellow-700' :
                       ($c->status == 'in_progress' ? 'bg-blue-100 text-blue-700' :
                       'bg-green-100 text-green-700') }}">
                    {{ ucfirst(str_replace('_',' ',$c->status)) }}
                </span>
            </div>
            <div class="flex flex-wrap gap-2 mt-2">
                <span class="bg-gray-100 text-gray-600 px-2.5 py-1 rounded-lg text-xs">{{ ucfirst($c->category ?? 'N/A') }}</span>
                <span class="bg-gray-100 text-gray-600 px-2.5 py-1 rounded-lg text-xs">{{ $c->city ?? 'N/A' }}</span>
                <span class="px-2.5 py-1 rounded-lg text-xs font-semibold
                    {{ $c->priority == 'high' ? 'bg-red-100 text-red-600' :
                       ($c->priority == 'medium' ? 'bg-yellow-100 text-yellow-600' :
                       'bg-green-100 text-green-600') }}">
                    {{ ucfirst($c->priority ?? 'N/A') }}
                </span>
                <span class="bg-gray-100 text-gray-600 px-2.5 py-1 rounded-lg text-xs">{{ $c->created_at->format('d M Y') }}</span>
            </div>
        </div>
    </div>
    @endforeach
</div>

{{-- DESKTOP: Table --}}
<div class="hidden md:block bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-gray-50 text-gray-400 text-xs uppercase border-b">
            <tr>
                <th class="px-5 py-3 text-left font-medium">Complaint</th>
                <th class="px-5 py-3 text-left font-medium">Category</th>
                <th class="px-5 py-3 text-left font-medium">City</th>
                <th class="px-5 py-3 text-left font-medium">Priority</th>
                <th class="px-5 py-3 text-left font-medium">Status</th>
                <th class="px-5 py-3 text-left font-medium">Date</th>
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
                    <span class="bg-gray-100 text-gray-600 px-2.5 py-1 rounded-lg text-xs">
                        {{ ucfirst($c->category ?? 'N/A') }}
                    </span>
                </td>
                <td class="px-5 py-4 text-gray-600 text-xs">{{ $c->city ?? 'N/A' }}</td>
                <td class="px-5 py-4">
                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-semibold
                        {{ $c->priority == 'high' ? 'bg-red-100 text-red-600' :
                           ($c->priority == 'medium' ? 'bg-yellow-100 text-yellow-600' :
                           'bg-green-100 text-green-600') }}">
                        @if($c->priority == 'high')
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M12.395 2.553a1 1 0 00-1.45-.385c-.345.23-.614.558-.822.88-.214.33-.403.713-.57 1.116-.334.804-.614 1.768-.84 2.734a31.365 31.365 0 00-.613 3.58 2.64 2.64 0 01-.945-1.067c-.328-.68-.398-1.534-.398-2.654A1 1 0 005.05 6.05 6.981 6.981 0 003 11a7 7 0 1011.95-4.95c-.592-.591-.98-.985-1.348-1.467-.363-.476-.724-1.063-1.207-2.03zM12.12 15.12A3 3 0 017 13s.879.5 2.5.5c0-1 .5-4 1.25-4.5.5 1 .786 1.293 1.371 1.879A2.99 2.99 0 0113 13a2.99 2.99 0 01-.879 2.121z" clip-rule="evenodd"/>
                            </svg>
                        @elseif($c->priority == 'medium')
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                            </svg>
                        @else
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        @endif
                        {{ ucfirst($c->priority ?? 'N/A') }}
                    </span>
                </td>
                <td class="px-5 py-4">
                    <span class="px-2.5 py-1 rounded-full text-xs font-semibold
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
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 py-16 text-center">
    <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
        </svg>
    </div>
    <p class="font-medium text-gray-500">No complaints found</p>
    <p class="text-sm text-gray-400 mt-1">Try different filter criteria</p>
</div>
@endif

@endif

@endsection