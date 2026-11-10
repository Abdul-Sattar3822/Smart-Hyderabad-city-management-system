<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $dept->name }} — Smart Hyderabad</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body { font-family: 'Inter', 'Segoe UI', sans-serif; }
        .glass {
            background: rgba(255,255,255,0.15);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.2);
        }
        .card-hover { transition: all 0.3s; }
        .card-hover:hover { transform: translateY(-4px); box-shadow: 0 20px 40px rgba(0,0,0,0.1); }
        #mobileMenu { display: none; }
        #mobileMenu.open { display: block; }
    </style>
</head>
<body class="bg-gray-50">

    <!-- TOP NAVBAR -->
    <nav style="background: linear-gradient(135deg, #1e3a5f 0%, #2563eb 50%, #7c3aed 100%);"
        class="text-white px-4 md:px-8 py-4 shadow-xl">
        <div class="flex justify-between items-center">

            <div class="flex items-center gap-3">
                <div class="w-11 h-11 bg-white bg-opacity-20 rounded-2xl flex items-center justify-center shadow">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                </div>
                <div>
                    <p class="font-bold text-base leading-tight">{{ $dept->name }}</p>
                    <p class="text-blue-200 text-xs">Smart Hyderabad City</p>
                </div>
            </div>

            <div class="hidden md:flex items-center gap-6">
                <div class="text-right">
                    <p class="text-blue-200 text-xs">{{ now()->format('l') }}</p>
                    <p class="font-semibold text-sm">{{ now()->format('d M Y') }}</p>
                </div>
                <form method="POST" action="{{ route('department.logout') }}">
                    @csrf
                    <button class="glass px-4 py-2 rounded-xl text-sm hover:bg-white hover:bg-opacity-20 transition font-medium flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                        Logout
                    </button>
                </form>
            </div>

            <button onclick="document.getElementById('mobileMenu').classList.toggle('open')"
                class="md:hidden text-white text-2xl">☰</button>
        </div>

        <div id="mobileMenu" class="mt-4 pb-2 border-t border-white border-opacity-20 pt-3">
            <div class="flex justify-between items-center">
                <p class="text-blue-200 text-sm">{{ now()->format('d M Y') }}</p>
                <form method="POST" action="{{ route('department.logout') }}">
                    @csrf
                    <button class="glass px-3 py-1.5 rounded-lg text-sm flex items-center gap-1.5">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </nav>

    @if(session('success'))
    <div class="mx-4 md:mx-8 mt-4 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl text-sm flex items-center gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>
        {{ session('success') }}
    </div>
    @endif

    <div class="max-w-7xl mx-auto px-4 md:px-8 py-6">

        <!-- HERO STATS -->
        <div style="background: linear-gradient(135deg, #1e3a5f, #2563eb, #7c3aed);"
            class="rounded-3xl p-6 md:p-8 mb-6 text-white shadow-2xl">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6">
                <div>
                    <h1 class="text-2xl md:text-3xl font-bold">Welcome Back!</h1>
                    <p class="text-blue-200 mt-1">{{ $dept->name }} — Complaint Management</p>
                </div>
                @if($stats['total'] > 0)
                <div class="mt-4 md:mt-0 glass px-6 py-3 rounded-2xl text-center">
                    <p class="text-blue-200 text-xs">Resolution Rate</p>
                    <p class="text-3xl font-bold">{{ round(($stats['resolved'] / $stats['total']) * 100) }}%</p>
                </div>
                @endif
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                <div class="glass rounded-2xl p-4 text-center card-hover">
                    <p class="text-4xl font-bold">{{ $stats['total'] }}</p>
                    <p class="text-blue-200 text-sm mt-1">Total</p>
                </div>
                <div class="glass rounded-2xl p-4 text-center card-hover">
                    <p class="text-4xl font-bold text-yellow-300">{{ $stats['pending'] }}</p>
                    <p class="text-blue-200 text-sm mt-1">Pending</p>
                </div>
                <div class="glass rounded-2xl p-4 text-center card-hover">
                    <p class="text-4xl font-bold text-blue-300">{{ $stats['in_progress'] }}</p>
                    <p class="text-blue-200 text-sm mt-1">In Progress</p>
                </div>
                <div class="glass rounded-2xl p-4 text-center card-hover">
                    <p class="text-4xl font-bold text-green-300">{{ $stats['resolved'] }}</p>
                    <p class="text-blue-200 text-sm mt-1">Resolved</p>
                </div>
            </div>
        </div>

        <!-- CHART + QUICK INFO -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 flex flex-col items-center">
                <h3 class="font-semibold text-gray-700 mb-4 self-start">Status Overview</h3>
                @if($stats['total'] > 0)
                <canvas id="doughnutChart" style="max-height:200px"></canvas>
                @else
                <div class="text-center text-gray-300 py-8">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 mx-auto text-gray-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                    </svg>
                    <p class="text-sm mt-2">No data yet</p>
                </div>
                @endif
            </div>

            <div class="md:col-span-2 grid grid-cols-1 gap-4">
                @php $highCount = $complaints->where('priority', 'high')->count(); @endphp
                <div class="bg-red-50 border border-red-100 rounded-2xl p-5 flex items-center gap-4">
                    <div class="w-14 h-14 bg-red-100 rounded-2xl flex items-center justify-center flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M12.395 2.553a1 1 0 00-1.45-.385c-.345.23-.614.558-.822.88-.214.33-.403.713-.57 1.116-.334.804-.614 1.768-.84 2.734a31.365 31.365 0 00-.613 3.58 2.64 2.64 0 01-.945-1.067c-.328-.68-.398-1.534-.398-2.654A1 1 0 005.05 6.05 6.981 6.981 0 003 11a7 7 0 1011.95-4.95c-.592-.591-.98-.985-1.348-1.467-.363-.476-.724-1.063-1.207-2.03zM12.12 15.12A3 3 0 017 13s.879.5 2.5.5c0-1 .5-4 1.25-4.5.5 1 .786 1.293 1.371 1.879A2.99 2.99 0 0113 13a2.99 2.99 0 01-.879 2.121z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-red-600 font-bold text-2xl">{{ $highCount }}</p>
                        <p class="text-red-400 text-sm">High Priority Complaints</p>
                        <p class="text-red-300 text-xs mt-1">Require immediate attention</p>
                    </div>
                </div>

                @php $unresolved = $stats['pending'] + $stats['in_progress']; @endphp
                <div class="bg-orange-50 border border-orange-100 rounded-2xl p-5 flex items-center gap-4">
                    <div class="w-14 h-14 bg-orange-100 rounded-2xl flex items-center justify-center flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-orange-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-orange-600 font-bold text-2xl">{{ $unresolved }}</p>
                        <p class="text-orange-400 text-sm">Unresolved Complaints</p>
                        <p class="text-orange-300 text-xs mt-1">Pending + In Progress</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- COMPLAINTS TABLE (same structure, SVG icons) -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-6 py-4 border-b flex justify-between items-center bg-gray-50">
                <div>
                    <h3 class="font-bold text-gray-800">Assigned Complaints</h3>
                    <p class="text-xs text-gray-400 mt-0.5">Manage and update complaint status</p>
                </div>
                <span class="bg-blue-600 text-white text-xs px-3 py-1 rounded-full font-medium">
                    {{ $stats['total'] }} Total
                </span>
            </div>

            @if($complaints->count() > 0)

            <!-- Mobile Cards -->
            <div class="md:hidden divide-y">
                @foreach($complaints as $complaint)
                <div class="p-4 hover:bg-gray-50 transition">
                    <div class="flex justify-between items-start mb-3">
                        <div>
                            <p class="font-bold text-gray-800">{{ $complaint->title }}</p>
                            <p class="text-xs text-gray-400 mt-0.5">
                                #{{ $complaint->id }} • {{ $complaint->user->name ?? 'N/A' }} • {{ $complaint->city ?? 'N/A' }}
                            </p>
                        </div>
                        <span class="px-2 py-1 rounded-full text-xs font-bold
                            {{ $complaint->priority === 'high' ? 'bg-red-100 text-red-600' :
                               ($complaint->priority === 'medium' ? 'bg-yellow-100 text-yellow-600' :
                               'bg-green-100 text-green-600') }}">
                            {{ ucfirst($complaint->priority) }}
                        </span>
                    </div>

                    @if($complaint->image)
                    <img src="{{ asset('storage/' . $complaint->image) }}"
                        class="w-full h-40 object-cover rounded-xl mb-3">
                    @endif

                    <div class="flex items-center gap-2 mb-3">
                        <span class="px-3 py-1 rounded-full text-xs font-medium
                            {{ $complaint->status === 'resolved' ? 'bg-green-100 text-green-600' :
                               ($complaint->status === 'in_progress' ? 'bg-blue-100 text-blue-600' :
                               'bg-yellow-100 text-yellow-600') }}">
                            {{ ucfirst(str_replace('_', ' ', $complaint->status)) }}
                        </span>
                        @if($complaint->latitude && $complaint->longitude)
                        <a href="https://www.google.com/maps?q={{ $complaint->latitude }},{{ $complaint->longitude }}"
                            target="_blank" class="text-blue-500 text-xs flex items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            </svg>
                            Map
                        </a>
                        @endif
                    </div>

                    <div class="flex gap-2">
                        <form method="POST" action="{{ route('department.complaints.status', $complaint) }}" class="flex gap-2 flex-1">
                            @csrf
                            <select name="status" class="border rounded-xl px-2 py-2 text-xs flex-1 bg-gray-50">
                                <option value="in_progress" {{ $complaint->status === 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                <option value="resolved" {{ $complaint->status === 'resolved' ? 'selected' : '' }}>Resolved</option>
                            </select>
                            <button type="submit"
                                class="bg-blue-600 text-white px-3 py-2 rounded-xl text-xs font-medium hover:bg-blue-700">
                                Update
                            </button>
                        </form>
                        <a href="{{ route('department.complaints.show', $complaint) }}"
                            class="bg-gray-800 text-white px-3 py-2 rounded-xl text-xs flex items-center hover:bg-gray-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Desktop Table -->
            <div class="hidden md:block overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-gray-50 text-gray-500 text-xs uppercase">
                        <tr>
                            <th class="px-4 py-3 text-left">ID</th>
                            <th class="px-4 py-3 text-left">Title</th>
                            <th class="px-4 py-3 text-left">User</th>
                            <th class="px-4 py-3 text-left">City</th>
                            <th class="px-4 py-3 text-left">Image</th>
                            <th class="px-4 py-3 text-left">Location</th>
                            <th class="px-4 py-3 text-left">Priority</th>
                            <th class="px-4 py-3 text-left">Status</th>
                            <th class="px-4 py-3 text-left">Update</th>
                            <th class="px-4 py-3 text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @foreach($complaints as $complaint)
                        <tr class="hover:bg-blue-50 transition">
                            <td class="px-4 py-4 text-gray-400 font-mono text-xs">#{{ $complaint->id }}</td>
                            <td class="px-4 py-4 font-semibold text-gray-800">{{ $complaint->title }}</td>
                            <td class="px-4 py-4 text-gray-600">{{ $complaint->user->name ?? 'N/A' }}</td>
                            <td class="px-4 py-4 text-gray-600">{{ $complaint->city ?? 'N/A' }}</td>
                            <td class="px-4 py-4">
                                @if($complaint->image)
                                    <img src="{{ asset('storage/' . $complaint->image) }}"
                                        class="w-14 h-14 rounded-xl object-cover shadow cursor-pointer"
                                        onclick="this.requestFullscreen()">
                                @else
                                    <span class="text-gray-300 text-xs">—</span>
                                @endif
                            </td>
                            <td class="px-4 py-4">
                                @if($complaint->latitude && $complaint->longitude)
                                    <a href="https://www.google.com/maps?q={{ $complaint->latitude }},{{ $complaint->longitude }}"
                                        target="_blank" class="text-blue-500 hover:underline text-xs flex items-center gap-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                        </svg>
                                        Map
                                    </a>
                                @else
                                    <span class="text-gray-300 text-xs">—</span>
                                @endif
                            </td>
                            <td class="px-4 py-4">
                                <span class="px-2 py-1 rounded-full text-xs font-bold
                                    {{ $complaint->priority === 'high' ? 'bg-red-100 text-red-700' :
                                       ($complaint->priority === 'medium' ? 'bg-yellow-100 text-yellow-700' :
                                       'bg-green-100 text-green-700') }}">
                                    {{ ucfirst($complaint->priority) }}
                                </span>
                            </td>
                            <td class="px-4 py-4">
                                <span class="px-2 py-1 rounded-full text-xs font-bold
                                    {{ $complaint->status === 'resolved' ? 'bg-green-100 text-green-700' :
                                       ($complaint->status === 'in_progress' ? 'bg-blue-100 text-blue-700' :
                                       'bg-yellow-100 text-yellow-700') }}">
                                    {{ ucfirst(str_replace('_', ' ', $complaint->status)) }}
                                </span>
                            </td>
                            <td class="px-4 py-4">
                                <form method="POST" action="{{ route('department.complaints.status', $complaint) }}" class="flex gap-2">
                                    @csrf
                                    <select name="status" class="border border-gray-200 rounded-xl px-2 py-1 text-xs bg-white">
                                        <option value="in_progress" {{ $complaint->status === 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                        <option value="resolved" {{ $complaint->status === 'resolved' ? 'selected' : '' }}>Resolved</option>
                                    </select>
                                    <button type="submit" class="bg-blue-600 text-white px-3 py-1 rounded-xl text-xs hover:bg-blue-700 font-medium">
                                        Update
                                    </button>
                                </form>
                            </td>
                            <td class="px-4 py-4">
                                <div class="flex flex-col gap-1">
                                    <a href="{{ route('department.complaints.show', $complaint) }}"
                                        class="bg-gray-800 text-white px-3 py-1.5 rounded-xl text-xs text-center hover:bg-gray-700 font-medium flex items-center justify-center gap-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                        View
                                    </a>
                                    <form method="POST" action="{{ route('department.complaints.destroy', $complaint) }}"
                                        onsubmit="return confirm('Delete?')">
                                        @csrf @method('DELETE')
                                        <button type="submit"
                                            class="w-full bg-red-500 text-white px-3 py-1.5 rounded-xl text-xs hover:bg-red-600 font-medium flex items-center justify-center gap-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
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

            @else
            <div class="py-20 text-center text-gray-300">
                <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                    </svg>
                </div>
                <p class="font-semibold text-gray-400">No complaints assigned yet</p>
                <p class="text-sm mt-1">Admin will assign complaints to your department soon.</p>
            </div>
            @endif
        </div>

    </div>

    <script>
        @if($stats['total'] > 0)
        new Chart(document.getElementById('doughnutChart'), {
            type: 'doughnut',
            data: {
                labels: ['Pending', 'In Progress', 'Resolved'],
                datasets: [{
                    data: [{{ $stats['pending'] }}, {{ $stats['in_progress'] }}, {{ $stats['resolved'] }}],
                    backgroundColor: ['#fbbf24', '#3b82f6', '#22c55e'],
                    borderWidth: 3,
                    borderColor: '#ffffff',
                }]
            },
            options: {
                cutout: '70%',
                plugins: { legend: { position: 'bottom', labels: { font: { size: 11 } } } }
            }
        });
        @endif
    </script>

</body>
</html>