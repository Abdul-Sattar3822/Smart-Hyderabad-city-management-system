@extends('layouts.user')

@section('content')

<!-- Header -->
<div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-3">
    <div>
        <h1 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
            </svg>
            My Complaints
        </h1>
        <p class="text-gray-400 text-sm mt-1">Track all your submitted complaints</p>
    </div>
    <a href="{{ route('complaints.create') }}"
        class="bg-blue-600 text-white px-5 py-2.5 rounded-xl text-sm font-semibold hover:bg-blue-700 transition shadow flex items-center gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
        New Complaint
    </a>
</div>

<!-- Stats -->
<div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4 text-center">
        <p class="text-2xl font-bold text-gray-700">{{ count($complaints) }}</p>
        <p class="text-xs text-gray-400 mt-1">Total</p>
    </div>
    <div class="bg-yellow-50 rounded-2xl shadow-sm border border-yellow-100 p-4 text-center">
        <p class="text-2xl font-bold text-yellow-500">{{ $complaints->where('status','pending')->count() }}</p>
        <p class="text-xs text-gray-400 mt-1">Pending</p>
    </div>
    <div class="bg-blue-50 rounded-2xl shadow-sm border border-blue-100 p-4 text-center">
        <p class="text-2xl font-bold text-blue-500">{{ $complaints->where('status','in_progress')->count() }}</p>
        <p class="text-xs text-gray-400 mt-1">In Progress</p>
    </div>
    <div class="bg-green-50 rounded-2xl shadow-sm border border-green-100 p-4 text-center">
        <p class="text-2xl font-bold text-green-500">{{ $resolvedCount }}</p>
        <p class="text-xs text-gray-400 mt-1">Resolved</p>
    </div>
</div>

@if(count($complaints) > 0)

<div class="space-y-5">
    @foreach($complaints as $complaint)
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition">

        <!-- Priority Color Bar -->
        <div class="h-1.5 w-full
            {{ $complaint->priority == 'high' ? 'bg-red-500' :
               ($complaint->priority == 'medium' ? 'bg-yellow-400' : 'bg-green-400') }}">
        </div>

        <div class="p-5 md:p-6">
            <!-- Top Row -->
            <div class="flex justify-between items-start mb-4">
                <div class="flex-1 min-w-0">
                    <div class="flex items-center gap-2 mb-2">
                        <span class="text-xs text-gray-400 font-mono">#{{ $complaint->id }}</span>
                        <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-semibold
                            {{ $complaint->priority == 'high' ? 'bg-red-100 text-red-600' :
                               ($complaint->priority == 'medium' ? 'bg-yellow-100 text-yellow-600' :
                               'bg-green-100 text-green-600') }}">
                            @if($complaint->priority == 'high')
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M12.395 2.553a1 1 0 00-1.45-.385c-.345.23-.614.558-.822.88-.214.33-.403.713-.57 1.116-.334.804-.614 1.768-.84 2.734a31.365 31.365 0 00-.613 3.58 2.64 2.64 0 01-.945-1.067c-.328-.68-.398-1.534-.398-2.654A1 1 0 005.05 6.05 6.981 6.981 0 003 11a7 7 0 1011.95-4.95c-.592-.591-.98-.985-1.348-1.467-.363-.476-.724-1.063-1.207-2.03zM12.12 15.12A3 3 0 017 13s.879.5 2.5.5c0-1 .5-4 1.25-4.5.5 1 .786 1.293 1.371 1.879A2.99 2.99 0 0113 13a2.99 2.99 0 01-.879 2.121z" clip-rule="evenodd"/>
                                </svg>
                            @elseif($complaint->priority == 'medium')
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                                </svg>
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            @endif
                            {{ ucfirst($complaint->priority ?? 'N/A') }}
                        </span>
                    </div>
                    <h3 class="font-bold text-gray-800 text-lg leading-tight">{{ $complaint->title }}</h3>
                    <p class="text-gray-500 text-sm mt-1.5 line-clamp-2">{{ $complaint->description }}</p>
                </div>
                @if($complaint->image)
                <img src="{{ asset('storage/' . $complaint->image) }}"
                    class="w-16 h-16 md:w-20 md:h-20 rounded-xl object-cover ml-4 shadow-sm flex-shrink-0 border border-gray-100">
                @endif
            </div>

            <!-- Info Tags -->
            <div class="flex flex-wrap gap-2 mb-5">
                <span class="inline-flex items-center gap-1.5 bg-gray-50 text-gray-600 px-2.5 py-1 rounded-lg text-xs border border-gray-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"/>
                    </svg>
                    {{ ucfirst($complaint->category ?? 'N/A') }}
                </span>
                <span class="inline-flex items-center gap-1.5 bg-gray-50 text-gray-600 px-2.5 py-1 rounded-lg text-xs border border-gray-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    {{ $complaint->city ?? 'N/A' }}
                </span>
                <span class="inline-flex items-center gap-1.5 bg-gray-50 text-gray-600 px-2.5 py-1 rounded-lg text-xs border border-gray-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    ETA: {{ $complaint->eta ?? 'N/A' }}
                </span>
                <span class="inline-flex items-center gap-1.5 bg-gray-50 text-gray-600 px-2.5 py-1 rounded-lg text-xs border border-gray-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    {{ $complaint->created_at->format('d M Y') }}
                </span>
            </div>

            <!-- Status Stepper -->
            <div class="bg-gray-50 rounded-xl p-4 mb-5">
                <div class="flex items-center justify-between text-xs">
                    @php
                        $steps = ['pending' => 'Submitted', 'review' => 'Review', 'in_progress' => 'In Progress', 'resolved' => 'Resolved'];
                        $stepKeys = array_keys($steps);
                        $currentIndex = array_search($complaint->status, $stepKeys) ?? 0;
                    @endphp
                    @foreach($steps as $key => $label)
                    @php $idx = array_search($key, $stepKeys); @endphp
                    <div class="flex flex-col items-center gap-1.5">
                        <div class="w-7 h-7 rounded-full flex items-center justify-center text-xs font-bold
                            {{ $idx <= $currentIndex ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-400' }}">
                            @if($idx < $currentIndex)
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                                </svg>
                            @elseif($idx == $currentIndex)
                                <div class="w-2 h-2 bg-white rounded-full"></div>
                            @else
                                <div class="w-2 h-2 bg-gray-300 rounded-full"></div>
                            @endif
                        </div>
                        <span class="{{ $idx <= $currentIndex ? 'text-blue-600 font-semibold' : 'text-gray-400' }}">
                            {{ $label }}
                        </span>
                    </div>
                    @if(!$loop->last)
                    <div class="flex-1 h-0.5 {{ $idx < $currentIndex ? 'bg-blue-600' : 'bg-gray-200' }} mx-1 mb-5"></div>
                    @endif
                    @endforeach
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="grid grid-cols-2 md:grid-cols-3 gap-2.5">
                <a href="{{ route('complaints.show', $complaint->id) }}"
                    class="flex items-center justify-center gap-1.5 bg-gray-800 text-white py-2.5 rounded-xl text-xs font-semibold hover:bg-gray-700 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                    View Details
                </a>
                <a href="{{ route('complaints.pdf', $complaint->id) }}"
                    class="flex items-center justify-center gap-1.5 bg-blue-600 text-white py-2.5 rounded-xl text-xs font-semibold hover:bg-blue-700 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    Download PDF
                </a>
                @if($complaint->status == 'resolved')
                <form method="POST" action="{{ route('complaints.reopen', $complaint->id) }}" class="col-span-2 md:col-span-1">
                    @csrf
                    <button class="w-full flex items-center justify-center gap-1.5 bg-orange-500 text-white py-2.5 rounded-xl text-xs font-semibold hover:bg-orange-600 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                        </svg>
                        Re-open
                    </button>
                </form>
                @endif
            </div>

            <!-- Feedback Form (only for resolved) -->
            @if($complaint->status == 'resolved')
            <div class="mt-5 pt-5 border-t border-gray-100">
                <p class="text-xs font-semibold text-gray-500 mb-3 flex items-center gap-1.5">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                    </svg>
                    Rate this resolution
                </p>
                <form method="POST" action="/feedback/{{ $complaint->id }}" class="flex flex-col sm:flex-row gap-2.5 items-stretch sm:items-center">
                    @csrf
                    <select name="rating"
                        class="border border-gray-200 rounded-xl px-3 py-2 text-xs bg-white focus:outline-none focus:ring-2 focus:ring-yellow-400">
                        <option value="5">★★★★★ Excellent</option>
                        <option value="4">★★★★ Good</option>
                        <option value="3">★★★ Average</option>
                        <option value="2">★★ Poor</option>
                        <option value="1">★ Very Poor</option>
                    </select>
                    <input type="text" name="feedback"
                        placeholder="Write your feedback..."
                        class="flex-1 border border-gray-200 rounded-xl px-3 py-2 text-xs focus:outline-none focus:ring-2 focus:ring-yellow-400">
                    <button class="bg-yellow-400 hover:bg-yellow-500 text-gray-900 px-5 py-2 rounded-xl text-xs font-semibold transition flex items-center justify-center gap-1.5">
                        Submit
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                    </button>
                </form>
            </div>
            @endif

        </div>
    </div>
    @endforeach
</div>

@else
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 py-20 text-center">
    <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-5">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
        </svg>
    </div>
    <p class="font-semibold text-gray-600 text-lg">No complaints yet</p>
    <p class="text-sm text-gray-400 mt-2 mb-6">Submit your first complaint to get started</p>
    <a href="{{ route('complaints.create') }}"
        class="inline-flex items-center gap-2 bg-blue-600 text-white px-6 py-3 rounded-xl text-sm font-semibold hover:bg-blue-700 transition shadow">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
        Submit Complaint
    </a>
</div>
@endif

@endsection