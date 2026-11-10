@extends('layouts.user')

@section('content')

<div class="max-w-3xl mx-auto">

    <!-- Back Button -->
    <a href="{{ route('complaints.index') }}"
        class="inline-flex items-center gap-2 text-gray-500 hover:text-gray-700 mb-6 text-sm">
        ← Back to Complaints
    </a>

    <!-- Complaint Card -->
    <div class="bg-white rounded-2xl shadow p-6 mb-6">

        <div class="flex justify-between items-start mb-4">
            <div>
                <h1 class="text-xl font-bold text-gray-800">{{ $complaint->title }}</h1>
                <p class="text-gray-400 text-sm mt-1">#{{ $complaint->id }} • {{ $complaint->created_at->format('d M Y, h:i A') }}</p>
            </div>
            <span class="px-3 py-1 rounded-full text-sm font-medium
                {{ $complaint->status === 'resolved' ? 'bg-green-100 text-green-600' :
                   ($complaint->status === 'in_progress' ? 'bg-blue-100 text-blue-600' :
                   'bg-yellow-100 text-yellow-600') }}">
                {{ ucfirst(str_replace('_', ' ', $complaint->status)) }}
            </span>
        </div>

        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <p class="text-xs text-gray-400">Category</p>
                <p class="font-medium">{{ ucfirst($complaint->category ?? 'N/A') }}</p>
            </div>
            <div>
                <p class="text-xs text-gray-400">Priority</p>
                <span class="px-2 py-1 rounded-full text-xs font-medium
                    {{ $complaint->priority === 'high' ? 'bg-red-100 text-red-600' :
                       ($complaint->priority === 'medium' ? 'bg-yellow-100 text-yellow-600' :
                       'bg-green-100 text-green-600') }}">
                    {{ ucfirst($complaint->priority ?? 'N/A') }}
                </span>
            </div>
            <div>
                <p class="text-xs text-gray-400">City</p>
                <p class="font-medium">{{ $complaint->city ?? 'N/A' }}</p>
            </div>
            <div>
                <p class="text-xs text-gray-400">Location</p>
                @if($complaint->latitude && $complaint->longitude)
                    <a href="https://www.google.com/maps?q={{ $complaint->latitude }},{{ $complaint->longitude }}"
                        target="_blank" class="text-blue-500 text-sm hover:underline">📍 View on Map</a>
                @else
                    <p class="font-medium">N/A</p>
                @endif
            </div>
        </div>

        <div class="mb-4">
            <p class="text-xs text-gray-400 mb-1">Description</p>
            <p class="bg-gray-50 rounded-lg p-3 text-sm text-gray-700">{{ $complaint->description }}</p>
        </div>

        @if($complaint->image)
        <div>
            <p class="text-xs text-gray-400 mb-2">Image</p>
            <img src="{{ asset('storage/' . $complaint->image) }}" class="rounded-xl max-w-sm shadow">
        </div>
        @endif

    </div>

    <!-- Timeline -->
    <div class="bg-white rounded-2xl shadow p-6 mb-6">
        <h3 class="font-semibold text-gray-800 mb-6">📅 Complaint Timeline</h3>

        <div class="relative">
            <!-- Vertical Line -->
            <div class="absolute left-4 top-0 bottom-0 w-0.5 bg-gray-200"></div>

            <div class="space-y-6">

                <!-- Submitted -->
                <div class="flex items-start gap-4 relative">
                    <div class="w-8 h-8 rounded-full bg-blue-600 flex items-center justify-center text-white text-sm z-10 flex-shrink-0">
                        📝
                    </div>
                    <div class="flex-1 pb-2">
                        <p class="font-semibold text-gray-800 text-sm">Complaint Submitted</p>
                        <p class="text-xs text-gray-400 mt-0.5">{{ $complaint->created_at->format('d M Y, h:i A') }}</p>
                        <p class="text-xs text-gray-500 mt-1">Your complaint has been received by the system.</p>
                    </div>
                </div>

                <!-- History Records -->
                @foreach($complaint->histories as $history)
                <div class="flex items-start gap-4 relative">
                    <div class="w-8 h-8 rounded-full flex items-center justify-center text-white text-sm z-10 flex-shrink-0
                        {{ $history->status === 'resolved' ? 'bg-green-500' :
                           ($history->status === 'in_progress' ? 'bg-blue-500' :
                           'bg-yellow-500') }}">
                        {{ $history->status === 'resolved' ? '✅' : ($history->status === 'in_progress' ? '🔄' : '⏳') }}
                    </div>
                    <div class="flex-1 pb-2">
                        <p class="font-semibold text-gray-800 text-sm">
                            Status changed to: <span class="
                                {{ $history->status === 'resolved' ? 'text-green-600' :
                                   ($history->status === 'in_progress' ? 'text-blue-600' :
                                   'text-yellow-600') }}">
                                {{ ucfirst(str_replace('_', ' ', $history->status)) }}
                            </span>
                        </p>
                        <p class="text-xs text-gray-400 mt-0.5">{{ $history->created_at->format('d M Y, h:i A') }}</p>
                        @if($history->note)
                            <p class="text-xs text-gray-500 mt-1 bg-gray-50 rounded px-2 py-1">{{ $history->note }}</p>
                        @endif
                        <p class="text-xs text-gray-400 mt-1">By: {{ ucfirst($history->changed_by) }}</p>
                    </div>
                </div>
                @endforeach

            </div>
        </div>
    </div>

    <!-- Actions -->
    <div class="bg-white rounded-2xl shadow p-6">
        <h3 class="font-semibold text-gray-800 mb-4">Actions</h3>
        <div class="flex flex-wrap gap-3">
            <a href="{{ route('complaints.pdf', $complaint->id) }}"
                class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-blue-700 transition">
                📄 Download PDF
            </a>
            @if($complaint->status === 'resolved')
                <form method="POST" action="{{ route('complaints.reopen', $complaint->id) }}">
                    @csrf
                    <button class="bg-orange-500 text-white px-4 py-2 rounded-lg text-sm hover:bg-orange-600 transition">
                        🔁 Re-open
                    </button>
                </form>
            @endif
        </div>
    </div>

            <!-- Live Chat -->
    <div class="bg-white rounded-2xl shadow p-6 mt-6">
            <h3 class="font-semibold text-gray-800 mb-4">💬 Messages with Admin</h3>

            <!-- Messages -->
            <div class="space-y-3 mb-4 max-h-80 overflow-y-auto" id="chatBox">
                @forelse($complaint->messages as $msg)
                    <div class="flex {{ $msg->sender_type === 'user' ? 'justify-end' : 'justify-start' }}">
                        <div class="max-w-xs lg:max-w-md px-4 py-2 rounded-2xl text-sm
                            {{ $msg->sender_type === 'user'
                                ? 'bg-blue-600 text-white rounded-br-none'
                                : 'bg-gray-100 text-gray-800 rounded-bl-none' }}">
                            <p>{{ $msg->message }}</p>
                            <p class="text-xs mt-1 {{ $msg->sender_type === 'user' ? 'text-blue-200' : 'text-gray-400' }}">
                                {{ $msg->created_at->format('h:i A') }}
                            </p>
                        </div>
                    </div>
                @empty
                    <div class="text-center text-gray-400 py-6">
                        <p class="text-3xl mb-2">💬</p>
                        <p class="text-sm">No messages yet. Start a conversation!</p>
                    </div>
                @endforelse
            </div>

            <!-- Send Message -->
            <form method="POST" action="{{ route('messages.user.send', $complaint->id) }}"
                class="flex gap-2">
                @csrf
                <input type="text" name="message" required
                    placeholder="Type your message..."
                    class="flex-1 border border-gray-200 rounded-xl px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                <button type="submit"
                    class="bg-blue-600 text-white px-4 py-2 rounded-xl text-sm hover:bg-blue-700 transition">
                    Send 📤
                </button>
            </form>
        </div>

        <script>
            // Auto scroll to bottom of chat
            const chatBox = document.getElementById('chatBox');
            if(chatBox) chatBox.scrollTop = chatBox.scrollHeight;
        </script>

</div>

@endsection