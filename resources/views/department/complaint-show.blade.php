<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complaint Details — {{ $complaint->title }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">

    <!-- Navbar -->
    <nav class="bg-white shadow-sm border-b px-4 md:px-6 py-4 flex justify-between items-center">
        <h1 class="font-bold text-lg text-gray-800 flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
            </svg>
            Complaint Details
        </h1>
        <a href="{{ route('department.dashboard') }}"
            class="bg-gray-800 text-white px-4 py-2 rounded-xl text-sm hover:bg-gray-700 transition flex items-center gap-1.5">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Back
        </a>
    </nav>

    <div class="max-w-3xl mx-auto p-4 md:p-6">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">

            <!-- Title & Status -->
            <div class="flex flex-col sm:flex-row justify-between items-start gap-3 mb-6">
                <div>
                    <p class="text-xs text-gray-400 font-mono mb-1">#{{ $complaint->id }}</p>
                    <h2 class="text-xl font-bold text-gray-800">{{ $complaint->title }}</h2>
                </div>
                <span class="px-3 py-1.5 rounded-full text-sm font-semibold
                    {{ $complaint->status === 'resolved' ? 'bg-green-100 text-green-600' :
                       ($complaint->status === 'in_progress' ? 'bg-blue-100 text-blue-600' :
                       'bg-yellow-100 text-yellow-600') }}">
                    {{ ucfirst(str_replace('_', ' ', $complaint->status)) }}
                </span>
            </div>

            <!-- Details Grid -->
            <div class="grid grid-cols-2 gap-4 mb-6">
                <div class="bg-gray-50 rounded-xl p-3">
                    <p class="text-xs text-gray-400 mb-1">User</p>
                    <p class="font-medium text-gray-800">{{ $complaint->user->name ?? 'N/A' }}</p>
                </div>
                <div class="bg-gray-50 rounded-xl p-3">
                    <p class="text-xs text-gray-400 mb-1">Category</p>
                    <p class="font-medium text-gray-800">{{ ucfirst($complaint->category ?? 'N/A') }}</p>
                </div>
                <div class="bg-gray-50 rounded-xl p-3">
                    <p class="text-xs text-gray-400 mb-1">City</p>
                    <p class="font-medium text-gray-800">{{ $complaint->city ?? 'N/A' }}</p>
                </div>
                <div class="bg-gray-50 rounded-xl p-3">
                    <p class="text-xs text-gray-400 mb-1">Priority</p>
                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-semibold
                        {{ $complaint->priority === 'high' ? 'bg-red-100 text-red-600' :
                           ($complaint->priority === 'medium' ? 'bg-yellow-100 text-yellow-600' :
                           'bg-green-100 text-green-600') }}">
                        @if($complaint->priority === 'high')
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M12.395 2.553a1 1 0 00-1.45-.385c-.345.23-.614.558-.822.88-.214.33-.403.713-.57 1.116-.334.804-.614 1.768-.84 2.734a31.365 31.365 0 00-.613 3.58 2.64 2.64 0 01-.945-1.067c-.328-.68-.398-1.534-.398-2.654A1 1 0 005.05 6.05 6.981 6.981 0 003 11a7 7 0 1011.95-4.95c-.592-.591-.98-.985-1.348-1.467-.363-.476-.724-1.063-1.207-2.03zM12.12 15.12A3 3 0 017 13s.879.5 2.5.5c0-1 .5-4 1.25-4.5.5 1 .786 1.293 1.371 1.879A2.99 2.99 0 0113 13a2.99 2.99 0 01-.879 2.121z" clip-rule="evenodd"/>
                            </svg>
                        @elseif($complaint->priority === 'medium')
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                            </svg>
                        @else
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        @endif
                        {{ ucfirst($complaint->priority) }}
                    </span>
                </div>
                <div class="bg-gray-50 rounded-xl p-3">
                    <p class="text-xs text-gray-400 mb-1">Submitted</p>
                    <p class="font-medium text-gray-800">{{ $complaint->created_at->format('d M Y, h:i A') }}</p>
                </div>
                <div class="bg-gray-50 rounded-xl p-3">
                    <p class="text-xs text-gray-400 mb-1">Location</p>
                    @if($complaint->latitude && $complaint->longitude)
                        <a href="https://www.google.com/maps?q={{ $complaint->latitude }},{{ $complaint->longitude }}"
                            target="_blank" class="text-blue-500 hover:underline text-sm flex items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            View on Map
                        </a>
                    @else
                        <p class="font-medium text-gray-800">N/A</p>
                    @endif
                </div>
            </div>

            <!-- Description -->
            <div class="mb-6">
                <p class="text-xs text-gray-400 mb-2 font-medium uppercase">Description</p>
                <p class="bg-gray-50 rounded-xl p-4 text-sm text-gray-700 leading-relaxed">{{ $complaint->description }}</p>
            </div>

            <!-- Image -->
            @if($complaint->image)
            <div class="mb-6">
                <p class="text-xs text-gray-400 mb-2 font-medium uppercase">Attached Image</p>
                <img src="{{ asset('storage/' . $complaint->image) }}"
                    class="rounded-xl max-w-full sm:max-w-sm shadow-sm border border-gray-100 cursor-pointer"
                    onclick="this.requestFullscreen()">
            </div>
            @endif

            <!-- Update Status -->
            <div class="border-t pt-5">
                <p class="text-sm font-semibold text-gray-700 mb-3 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                    </svg>
                    Update Status
                </p>
                <form method="POST"
                    action="{{ route('department.complaints.status', $complaint) }}"
                    class="flex flex-col sm:flex-row gap-3">
                    @csrf
                    <select name="status" class="border border-gray-200 rounded-xl px-4 py-2.5 text-sm bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 flex-1">
                        <option value="in_progress" {{ $complaint->status === 'in_progress' ? 'selected' : '' }}>
                            In Progress
                        </option>
                        <option value="resolved" {{ $complaint->status === 'resolved' ? 'selected' : '' }}>
                            Resolved
                        </option>
                    </select>
                    <button type="submit"
                        class="bg-blue-600 text-white px-6 py-2.5 rounded-xl text-sm font-semibold hover:bg-blue-700 transition flex items-center justify-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Update
                    </button>
                </form>
            </div>

        </div>
    </div>

</body>
</html>