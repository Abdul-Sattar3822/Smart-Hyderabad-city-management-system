@extends('layouts.user')

@section('content')

<!-- Welcome Header -->
<div class="bg-gradient-to-r from-blue-600 to-indigo-600 rounded-2xl p-6 mb-6 text-white shadow-lg">
    <div class="flex justify-between items-center">
        <div>
            <p class="text-blue-100 text-sm">Good {{ now()->hour < 12 ? 'Morning' : (now()->hour < 17 ? 'Afternoon' : 'Evening') }},</p>
            <h1 class="text-2xl font-bold mt-1 flex items-center gap-2">
                {{ auth()->user()->name }}
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-yellow-300" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                </svg>
            </h1>
            <p class="text-blue-100 text-sm mt-1">Welcome to Smart Hyderabad Citizen Portal</p>
        </div>
        <div class="text-right">
            <p class="text-blue-100 text-xs">{{ now()->format('l') }}</p>
            <p class="text-white font-semibold">{{ now()->format('d M Y') }}</p>
        </div>
    </div>
</div>

<!-- Stats Cards -->
<div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
    <div class="bg-white rounded-xl p-5 shadow hover:shadow-md transition">
        <div class="flex items-center justify-between mb-2">
            <p class="text-gray-400 text-sm">Total</p>
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
            </svg>
        </div>
        <p class="text-3xl font-bold text-gray-700">{{ $total }}</p>
        <p class="text-xs text-gray-400 mt-1">Complaints filed</p>
    </div>
    <div class="bg-yellow-50 rounded-xl p-5 shadow hover:shadow-md transition">
        <div class="flex items-center justify-between mb-2">
            <p class="text-gray-400 text-sm">Pending</p>
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-yellow-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
        </div>
        <p class="text-3xl font-bold text-yellow-500">{{ $pending }}</p>
        <p class="text-xs text-gray-400 mt-1">Awaiting review</p>
    </div>
    <div class="bg-blue-50 rounded-xl p-5 shadow hover:shadow-md transition">
        <div class="flex items-center justify-between mb-2">
            <p class="text-gray-400 text-sm">In Progress</p>
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
            </svg>
        </div>
        <p class="text-3xl font-bold text-blue-500">{{ $inProgress }}</p>
        <p class="text-xs text-gray-400 mt-1">Being worked on</p>
    </div>
    <div class="bg-green-50 rounded-xl p-5 shadow hover:shadow-md transition">
        <div class="flex items-center justify-between mb-2">
            <p class="text-gray-400 text-sm">Resolved</p>
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
        </div>
        <p class="text-3xl font-bold text-green-500">{{ $resolved }}</p>
        <p class="text-xs text-gray-400 mt-1">Successfully resolved</p>
    </div>
</div>

<!-- Quick Actions -->
<h2 class="text-lg font-semibold text-gray-700 mb-3">Quick Actions</h2>
<div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
    <a href="{{ route('complaints.create') }}"
        class="bg-blue-600 hover:bg-blue-700 text-white rounded-xl p-5 flex items-center gap-4 shadow transition">
        <div class="w-12 h-12 bg-blue-500 rounded-xl flex items-center justify-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
        </div>
        <div>
            <p class="font-semibold">Submit Complaint</p>
            <p class="text-blue-100 text-xs">Report a new issue</p>
        </div>
    </a>
    <a href="{{ route('complaints.index') }}"
        class="bg-white hover:bg-gray-50 text-gray-800 rounded-xl p-5 flex items-center gap-4 shadow transition border">
        <div class="w-12 h-12 bg-indigo-100 rounded-xl flex items-center justify-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
            </svg>
        </div>
        <div>
            <p class="font-semibold">View Complaints</p>
            <p class="text-gray-400 text-xs">Track your submissions</p>
        </div>
    </a>
    <a href="{{ route('settings') }}"
        class="bg-white hover:bg-gray-50 text-gray-800 rounded-xl p-5 flex items-center gap-4 shadow transition border">
        <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
            </svg>
        </div>
        <div>
            <p class="font-semibold">Edit Profile</p>
            <p class="text-gray-400 text-xs">Update your info</p>
        </div>
    </a>
</div>

<!-- Progress Bar -->
@if($total > 0)
<div class="bg-white rounded-xl shadow p-5 mb-6">
    <h3 class="font-semibold text-gray-700 mb-3 flex items-center gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
        </svg>
        Complaint Resolution Progress
    </h3>
    <div class="flex items-center gap-3">
        <div class="flex-1 bg-gray-100 rounded-full h-3">
            <div class="bg-gradient-to-r from-blue-500 to-green-500 h-3 rounded-full transition-all"
                style="width: {{ ($resolved / $total) * 100 }}%">
            </div>
        </div>
        <span class="text-sm font-semibold text-gray-600">
            {{ round(($resolved / $total) * 100) }}%
        </span>
    </div>
    <p class="text-xs text-gray-400 mt-2">{{ $resolved }} out of {{ $total }} complaints resolved</p>
</div>
@endif

<!-- Recent Complaints -->
@php
    $recentComplaints = \App\Models\Complaint::where('user_id', auth()->id())
                        ->latest()->take(3)->get();
@endphp

@if($recentComplaints->count() > 0)
<div class="bg-white rounded-xl shadow overflow-hidden">
    <div class="px-6 py-4 border-b flex justify-between items-center">
        <h3 class="font-semibold text-gray-700 flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            Recent Complaints
        </h3>
        <a href="{{ route('complaints.index') }}" class="text-blue-500 text-sm hover:underline">View All →</a>
    </div>
    <div class="divide-y">
        @foreach($recentComplaints as $c)
        <div class="px-6 py-4 flex items-center justify-between hover:bg-gray-50 transition">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-lg bg-gray-100 flex items-center justify-center">
                    @if($c->category === 'water')
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>
                        </svg>
                    @elseif($c->category === 'electricity')
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-yellow-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                    @elseif($c->category === 'roads')
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
                    <p class="text-xs text-gray-400">{{ $c->created_at->diffForHumans() }}</p>
                </div>
            </div>
            <span class="px-3 py-1 rounded-full text-xs font-medium
                {{ $c->status === 'resolved' ? 'bg-green-100 text-green-600' :
                   ($c->status === 'in_progress' ? 'bg-blue-100 text-blue-600' :
                   'bg-yellow-100 text-yellow-600') }}">
                {{ ucfirst(str_replace('_', ' ', $c->status)) }}
            </span>
        </div>
        @endforeach
    </div>
</div>
@endif

@endsection