@extends('layouts.admin')

@section('content')

<!-- Header -->
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
        </svg>
        Reports
    </h1>
    <p class="text-gray-400 text-sm mt-1">Download and view complaint reports</p>
</div>

<!-- Stats Summary -->
@php
    $total      = \App\Models\Complaint::count();
    $pending    = \App\Models\Complaint::where('status','pending')->count();
    $inProgress = \App\Models\Complaint::where('status','in_progress')->count();
    $resolved   = \App\Models\Complaint::where('status','resolved')->count();
    $high       = \App\Models\Complaint::where('priority','high')->count();
    $todayCount = \App\Models\Complaint::whereDate('created_at', today())->count();
@endphp

<div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
        <p class="text-gray-400 text-xs mb-1">Total Complaints</p>
        <p class="text-3xl font-bold text-gray-800">{{ $total }}</p>
    </div>
    <div class="bg-yellow-50 rounded-2xl shadow-sm border border-yellow-100 p-5">
        <p class="text-gray-400 text-xs mb-1">Pending</p>
        <p class="text-3xl font-bold text-yellow-500">{{ $pending }}</p>
    </div>
    <div class="bg-blue-50 rounded-2xl shadow-sm border border-blue-100 p-5">
        <p class="text-gray-400 text-xs mb-1">In Progress</p>
        <p class="text-3xl font-bold text-blue-500">{{ $inProgress }}</p>
    </div>
    <div class="bg-green-50 rounded-2xl shadow-sm border border-green-100 p-5">
        <p class="text-gray-400 text-xs mb-1">Resolved</p>
        <p class="text-3xl font-bold text-green-500">{{ $resolved }}</p>
    </div>
</div>

<!-- Download Cards -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">

    <!-- PDF Report -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 flex flex-col items-center text-center hover:shadow-md transition">
        <div class="w-16 h-16 bg-red-100 rounded-2xl flex items-center justify-center mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
            </svg>
        </div>
        <h3 class="font-bold text-gray-800 mb-1">PDF Report</h3>
        <p class="text-gray-400 text-sm mb-4">Download all complaints as a PDF document</p>
        <div class="bg-gray-50 rounded-xl p-3 w-full mb-4 text-left">
            <p class="text-xs text-gray-500 flex items-center gap-1.5">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
                Includes: All {{ $total }} complaints
            </p>
            <p class="text-xs text-gray-500 mt-1 flex items-center gap-1.5">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                Generated: {{ now()->format('d M Y') }}
            </p>
        </div>
        <a href="/admin/download-pdf"
            class="w-full bg-red-500 text-white py-2.5 rounded-xl text-sm font-semibold hover:bg-red-600 transition text-center flex items-center justify-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
            </svg>
            Download PDF
        </a>
    </div>

    <!-- Summary Card -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 flex flex-col items-center text-center hover:shadow-md transition">
        <div class="w-16 h-16 bg-blue-100 rounded-2xl flex items-center justify-center mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
            </svg>
        </div>
        <h3 class="font-bold text-gray-800 mb-1">Summary Report</h3>
        <p class="text-gray-400 text-sm mb-4">Quick overview of complaint statistics</p>
        <div class="bg-gray-50 rounded-xl p-3 w-full mb-4 text-left space-y-1.5">
            <div class="flex justify-between text-xs">
                <span class="text-gray-500">Resolution Rate</span>
                <span class="font-bold text-green-600">
                    {{ $total > 0 ? round(($resolved/$total)*100) : 0 }}%
                </span>
            </div>
            <div class="flex justify-between text-xs">
                <span class="text-gray-500">High Priority</span>
                <span class="font-bold text-red-600">{{ $high }}</span>
            </div>
            <div class="flex justify-between text-xs">
                <span class="text-gray-500">Today's Complaints</span>
                <span class="font-bold text-blue-600">{{ $todayCount }}</span>
            </div>
        </div>
        <a href="/admin/analytics"
            class="w-full bg-blue-600 text-white py-2.5 rounded-xl text-sm font-semibold hover:bg-blue-700 transition text-center flex items-center justify-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
            </svg>
            View Analytics
        </a>
    </div>

    <!-- Departments Report -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 flex flex-col items-center text-center hover:shadow-md transition">
        <div class="w-16 h-16 bg-purple-100 rounded-2xl flex items-center justify-center mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-purple-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
            </svg>
        </div>
        <h3 class="font-bold text-gray-800 mb-1">Department Report</h3>
        <p class="text-gray-400 text-sm mb-4">Complaints assigned per department</p>
        <div class="bg-gray-50 rounded-xl p-3 w-full mb-4 text-left space-y-1.5">
            @foreach(\App\Models\Department::withCount('complaints')->get() as $dept)
            <div class="flex justify-between text-xs">
                <span class="text-gray-500">{{ $dept->name }}</span>
                <span class="font-bold text-purple-600">{{ $dept->complaints_count }}</span>
            </div>
            @endforeach
        </div>
        <a href="/admin/complaints"
            class="w-full bg-purple-600 text-white py-2.5 rounded-xl text-sm font-semibold hover:bg-purple-700 transition text-center flex items-center justify-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
            </svg>
            View Complaints
        </a>
    </div>

</div>

<!-- Recent Activity -->
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="px-6 py-4 border-b flex justify-between items-center">
        <h3 class="font-semibold text-gray-800 flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            Recent Complaints
        </h3>
        <a href="/admin/complaints" class="text-blue-500 text-sm hover:underline">View All →</a>
    </div>
    <div class="divide-y">
        @foreach(\App\Models\Complaint::with('user')->latest()->take(5)->get() as $c)
        <div class="px-6 py-4 flex items-center justify-between hover:bg-gray-50 transition">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl flex items-center justify-center
                    {{ $c->priority == 'high' ? 'bg-red-100' :
                       ($c->priority == 'medium' ? 'bg-yellow-100' : 'bg-green-100') }}">
                    @if($c->category == 'water')
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>
                        </svg>
                    @elseif($c->category == 'electricity')
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-yellow-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                    @elseif($c->category == 'roads')
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/>
                        </svg>
                    @else
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                    @endif
                </div>
                <div>
                    <p class="font-medium text-gray-800 text-sm">{{ $c->title }}</p>
                    <p class="text-xs text-gray-400">
                        {{ $c->user->name ?? 'N/A' }} • {{ $c->created_at->diffForHumans() }}
                    </p>
                </div>
            </div>
            <span class="px-3 py-1 rounded-full text-xs font-bold
                {{ $c->status == 'resolved' ? 'bg-green-100 text-green-600' :
                   ($c->status == 'in_progress' ? 'bg-blue-100 text-blue-600' :
                   'bg-yellow-100 text-yellow-600') }}">
                {{ ucfirst(str_replace('_',' ',$c->status)) }}
            </span>
        </div>
        @endforeach
    </div>
</div>

@endsection