@extends('layouts.admin')

@section('content')

<!-- Header -->
<div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-3">
    <div>
        <h1 class="text-2xl font-bold text-gray-800">⭐ Feedback & Ratings</h1>
        <p class="text-gray-400 text-sm mt-1">Citizen satisfaction insights</p>
    </div>
    <span class="bg-white shadow px-4 py-2 rounded-xl text-sm text-gray-600 font-medium">
        Total Reviews: <strong class="text-blue-600">{{ $feedbacks->count() }}</strong>
    </span>
</div>

@if($feedbacks->count() > 0)

<!-- Stats Row -->
@php
    $avgRating  = round($feedbacks->avg('rating'), 1);
    $fiveStar   = $feedbacks->where('rating', 5)->count();
    $fourStar   = $feedbacks->where('rating', 4)->count();
    $threeStar  = $feedbacks->where('rating', 3)->count();
    $twoStar    = $feedbacks->where('rating', 2)->count();
    $oneStar    = $feedbacks->where('rating', 1)->count();
@endphp

<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">

    <!-- Average Rating -->
    <div class="bg-white rounded-2xl shadow p-6 flex flex-col items-center justify-center text-center">
        <p class="text-6xl font-bold text-yellow-500 mb-2">{{ $avgRating }}</p>
        <div class="flex gap-1 mb-2">
            @for($i = 1; $i <= 5; $i++)
                <span class="text-2xl">{{ $i <= round($avgRating) ? '⭐' : '☆' }}</span>
            @endfor
        </div>
        <p class="text-gray-400 text-sm">Average Rating</p>
        <p class="text-xs text-gray-300 mt-1">Based on {{ $feedbacks->count() }} reviews</p>
    </div>

    <!-- Rating Breakdown -->
    <div class="bg-white rounded-2xl shadow p-6 md:col-span-2">
        <h3 class="font-semibold text-gray-700 mb-4">Rating Breakdown</h3>
        @php
            $bars = [
                5 => $fiveStar,
                4 => $fourStar,
                3 => $threeStar,
                2 => $twoStar,
                1 => $oneStar,
            ];
        @endphp
        @foreach($bars as $star => $count)
        <div class="flex items-center gap-3 mb-2">
            <span class="text-xs text-gray-500 w-4">{{ $star }}</span>
            <span class="text-yellow-400 text-sm">⭐</span>
            <div class="flex-1 bg-gray-100 rounded-full h-2.5">
                <div class="bg-yellow-400 h-2.5 rounded-full transition-all"
                    style="width: {{ $feedbacks->count() > 0 ? ($count / $feedbacks->count()) * 100 : 0 }}%">
                </div>
            </div>
            <span class="text-xs text-gray-400 w-6 text-right">{{ $count }}</span>
        </div>
        @endforeach
    </div>

</div>

<!-- Feedback Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    @foreach($feedbacks as $item)
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition">

        <!-- Top Priority Bar -->
        <div class="h-1 w-full
            {{ $item->priority == 'high' ? 'bg-red-500' :
               ($item->priority == 'medium' ? 'bg-yellow-400' : 'bg-green-400') }}">
        </div>

        <div class="p-5">
            <!-- User & Time -->
            <div class="flex justify-between items-start mb-3">
                <div class="flex items-center gap-3">
                    <img src="{{ $item->user->profile_image ? asset('storage/'.$item->user->profile_image) : 'https://ui-avatars.com/api/?name='.urlencode($item->user->name ?? 'U').'&background=3b82f6&color=fff' }}"
                        class="w-10 h-10 rounded-xl object-cover">
                    <div>
                        <p class="font-semibold text-gray-800 text-sm">{{ $item->user->name ?? 'User' }}</p>
                        <p class="text-xs text-gray-400">{{ $item->created_at->diffForHumans() }}</p>
                    </div>
                </div>
                <span class="px-2 py-1 rounded-full text-xs font-bold
                    {{ $item->priority == 'high' ? 'bg-red-100 text-red-600' :
                       ($item->priority == 'medium' ? 'bg-yellow-100 text-yellow-600' :
                       'bg-green-100 text-green-600') }}">
                    {{ ucfirst($item->priority ?? 'N/A') }}
                </span>
            </div>

            <!-- Complaint Title -->
            <p class="font-medium text-gray-700 text-sm mb-3 bg-gray-50 rounded-xl px-3 py-2">
                📋 {{ $item->title }}
            </p>

            <!-- Stars -->
            <div class="flex items-center gap-2 mb-3">
                <div class="flex gap-0.5">
                    @for($i = 1; $i <= 5; $i++)
                        <span class="text-lg">{{ $i <= $item->rating ? '⭐' : '☆' }}</span>
                    @endfor
                </div>
                <span class="text-sm font-bold text-yellow-500">{{ $item->rating }}/5</span>
            </div>

            <!-- Feedback Text -->
            @if($item->feedback)
            <div class="bg-blue-50 rounded-xl p-3">
                <p class="text-gray-700 text-sm italic">"{{ $item->feedback }}"</p>
            </div>
            @else
            <div class="bg-gray-50 rounded-xl p-3">
                <p class="text-gray-400 text-sm italic">No written feedback provided.</p>
            </div>
            @endif

        </div>
    </div>
    @endforeach
</div>

@else

<!-- Empty State -->
<div class="bg-white rounded-2xl shadow py-20 text-center text-gray-400">
    <p class="text-6xl mb-4">⭐</p>
    <p class="font-semibold text-gray-500 text-lg">No feedback yet</p>
    <p class="text-sm mt-2">Citizen feedback will appear here once complaints are resolved and rated.</p>
</div>

@endif

@endsection