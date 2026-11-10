@extends('layouts.user')

@section('content')

<div class="max-w-3xl mx-auto">

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">🔔 Notifications</h1>
        @if($notifications->count() > 0)
            <form method="POST" action="{{ route('notifications.readAll') }}">
                @csrf
                <button class="text-sm text-blue-600 hover:underline">
                    Mark all as read
                </button>
            </form>
        @endif
    </div>

    @if($notifications->count() > 0)
        <div class="space-y-3">
            @foreach($notifications as $notification)
            <div class="bg-white rounded-xl shadow p-4 flex items-start gap-4
                {{ !$notification->is_read ? 'border-l-4 border-blue-500' : '' }}">

                {{-- Icon --}}
                <div class="text-2xl">
                    {{ $notification->type === 'success' ? '✅' : ($notification->type === 'warning' ? '⚠️' : '🔔') }}
                </div>

                {{-- Content --}}
                <div class="flex-1">
                    <p class="font-semibold text-gray-800">{{ $notification->title }}</p>
                    <p class="text-sm text-gray-600 mt-1">{{ $notification->message }}</p>
                    <p class="text-xs text-gray-400 mt-2">{{ $notification->created_at->diffForHumans() }}</p>
                </div>

                {{-- Unread badge --}}
                @if(!$notification->is_read)
                    <span class="bg-blue-500 w-2 h-2 rounded-full mt-2"></span>
                @endif

            </div>
            @endforeach
        </div>
    @else
        <div class="bg-white rounded-xl shadow p-12 text-center text-gray-400">
            <p class="text-4xl mb-3">🔔</p>
            <p>No notifications yet.</p>
        </div>
    @endif

</div>

@endsection