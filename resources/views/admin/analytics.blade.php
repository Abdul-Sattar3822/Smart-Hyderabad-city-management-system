@extends('layouts.admin')

@section('content')

<!-- Header -->
<div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-3">
    <div>
        <h1 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
            </svg>
            Analytics Dashboard
        </h1>
        <p class="text-gray-400 text-sm mt-1">Complaint trends and insights</p>
    </div>
    <span class="text-xs text-gray-400 bg-white px-3 py-2 rounded-xl shadow-sm border border-gray-100 flex items-center gap-1.5">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>
        Last updated: {{ now()->format('d M Y, h:i A') }}
    </span>
</div>

<!-- Stats Cards -->
<div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
        <div class="flex items-center justify-between mb-3">
            <p class="text-gray-400 text-sm">Total</p>
            <div class="w-10 h-10 bg-gray-100 rounded-xl flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
            </div>
        </div>
        <p class="text-3xl font-bold text-gray-800">{{ $pending + $inProgress + $resolved }}</p>
        <p class="text-xs text-gray-400 mt-1">All complaints</p>
    </div>
    <div class="bg-yellow-50 rounded-2xl shadow-sm border border-yellow-100 p-5">
        <div class="flex items-center justify-between mb-3">
            <p class="text-gray-400 text-sm">Pending</p>
            <div class="w-10 h-10 bg-yellow-100 rounded-xl flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
        </div>
        <p class="text-3xl font-bold text-yellow-500">{{ $pending }}</p>
        <p class="text-xs text-gray-400 mt-1">Awaiting action</p>
    </div>
    <div class="bg-blue-50 rounded-2xl shadow-sm border border-blue-100 p-5">
        <div class="flex items-center justify-between mb-3">
            <p class="text-gray-400 text-sm">In Progress</p>
            <div class="w-10 h-10 bg-blue-100 rounded-xl flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                </svg>
            </div>
        </div>
        <p class="text-3xl font-bold text-blue-500">{{ $inProgress }}</p>
        <p class="text-xs text-gray-400 mt-1">Being worked on</p>
    </div>
    <div class="bg-green-50 rounded-2xl shadow-sm border border-green-100 p-5">
        <div class="flex items-center justify-between mb-3">
            <p class="text-gray-400 text-sm">Resolved</p>
            <div class="w-10 h-10 bg-green-100 rounded-xl flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
        </div>
        <p class="text-3xl font-bold text-green-500">{{ $resolved }}</p>
        <p class="text-xs text-gray-400 mt-1">Successfully resolved</p>
    </div>
</div>

<!-- Resolution Rate -->
@php $total = $pending + $inProgress + $resolved; @endphp
@if($total > 0)
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 mb-6">
    <div class="flex justify-between items-center mb-3">
        <p class="font-semibold text-gray-700 flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
            </svg>
            Overall Resolution Rate
        </p>
        <p class="text-2xl font-bold text-green-600">{{ round(($resolved / $total) * 100) }}%</p>
    </div>
    <div class="w-full bg-gray-100 rounded-full h-4">
        <div class="h-4 rounded-full bg-gradient-to-r from-blue-500 to-green-500 transition-all"
            style="width: {{ ($resolved / $total) * 100 }}%">
        </div>
    </div>
    <div class="flex justify-between mt-2 text-xs text-gray-400">
        <span>0%</span>
        <span>{{ $resolved }} of {{ $total }} resolved</span>
        <span>100%</span>
    </div>
</div>
@endif

<!-- Charts Row 1 -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
        <h3 class="font-semibold text-gray-700 mb-1">Status Distribution</h3>
        <p class="text-xs text-gray-400 mb-4">Breakdown by complaint status</p>
        <div class="flex items-center justify-center">
            <canvas id="doughnutChart" style="max-height: 250px;"></canvas>
        </div>
        <div class="flex justify-center gap-4 mt-4">
            <div class="flex items-center gap-1.5 text-xs text-gray-500">
                <span class="w-3 h-3 rounded-full bg-yellow-400 inline-block"></span> Pending
            </div>
            <div class="flex items-center gap-1.5 text-xs text-gray-500">
                <span class="w-3 h-3 rounded-full bg-blue-500 inline-block"></span> In Progress
            </div>
            <div class="flex items-center gap-1.5 text-xs text-gray-500">
                <span class="w-3 h-3 rounded-full bg-green-500 inline-block"></span> Resolved
            </div>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
        <h3 class="font-semibold text-gray-700 mb-1">Complaints Trend</h3>
        <p class="text-xs text-gray-400 mb-4">Last 7 days activity</p>
        <canvas id="lineChart" style="max-height: 250px;"></canvas>
    </div>
</div>

<!-- Charts Row 2 -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
        <h3 class="font-semibold text-gray-700 mb-1">Priority Breakdown</h3>
        <p class="text-xs text-gray-400 mb-4">Complaints by priority level</p>
        <canvas id="priorityChart" style="max-height: 220px;"></canvas>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
        <h3 class="font-semibold text-gray-700 mb-1">Category Breakdown</h3>
        <p class="text-xs text-gray-400 mb-4">Complaints by category</p>
        <canvas id="categoryChart" style="max-height: 220px;"></canvas>
    </div>
</div>

<!-- Quick Stats Row -->
<div class="grid grid-cols-2 md:grid-cols-4 gap-4">
    @php
        $highPriority = \App\Models\Complaint::where('priority','high')->count();
        $todayCount   = \App\Models\Complaint::whereDate('created_at', today())->count();
        $avgRating    = \App\Models\Complaint::whereNotNull('rating')->avg('rating');
        $totalUsers   = \App\Models\User::where('role','user')->count();
    @endphp
    <div class="bg-red-50 rounded-2xl shadow-sm border border-red-100 p-5 text-center">
        <p class="text-3xl font-bold text-red-500">{{ $highPriority }}</p>
        <p class="text-xs text-gray-400 mt-1">High Priority</p>
    </div>
    <div class="bg-indigo-50 rounded-2xl shadow-sm border border-indigo-100 p-5 text-center">
        <p class="text-3xl font-bold text-indigo-500">{{ $todayCount }}</p>
        <p class="text-xs text-gray-400 mt-1">Today's Complaints</p>
    </div>
    <div class="bg-yellow-50 rounded-2xl shadow-sm border border-yellow-100 p-5 text-center">
        <p class="text-3xl font-bold text-yellow-500">{{ number_format($avgRating ?? 0, 1) }}</p>
        <p class="text-xs text-gray-400 mt-1">Avg Rating</p>
    </div>
    <div class="bg-purple-50 rounded-2xl shadow-sm border border-purple-100 p-5 text-center">
        <p class="text-3xl font-bold text-purple-500">{{ $totalUsers }}</p>
        <p class="text-xs text-gray-400 mt-1">Total Citizens</p>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    new Chart(document.getElementById('doughnutChart'), {
        type: 'doughnut',
        data: {
            labels: ['Pending', 'In Progress', 'Resolved'],
            datasets: [{
                data: [{{ $pending }}, {{ $inProgress }}, {{ $resolved }}],
                backgroundColor: ['#fbbf24', '#3b82f6', '#22c55e'],
                borderWidth: 3,
                borderColor: '#ffffff',
            }]
        },
        options: {
            cutout: '65%',
            plugins: { legend: { display: false } }
        }
    });

    new Chart(document.getElementById('lineChart'), {
        type: 'line',
        data: {
            labels: @json($dates),
            datasets: [{
                label: 'Complaints',
                data: @json($counts),
                borderColor: '#3b82f6',
                backgroundColor: 'rgba(59,130,246,0.1)',
                tension: 0.4,
                fill: true,
                pointBackgroundColor: '#3b82f6',
                pointRadius: 5,
            }]
        },
        options: {
            plugins: { legend: { display: false } },
            scales: {
                y: { beginAtZero: true, ticks: { stepSize: 1 }, grid: { color: '#f3f4f6' } },
                x: { grid: { display: false } }
            }
        }
    });

    new Chart(document.getElementById('priorityChart'), {
        type: 'bar',
        data: {
            labels: ['High', 'Medium', 'Low'],
            datasets: [{
                data: [
                    {{ \App\Models\Complaint::where('priority','high')->count() }},
                    {{ \App\Models\Complaint::where('priority','medium')->count() }},
                    {{ \App\Models\Complaint::where('priority','low')->count() }},
                ],
                backgroundColor: ['#ef4444', '#f59e0b', '#22c55e'],
                borderRadius: 10,
                borderSkipped: false,
            }]
        },
        options: {
            plugins: { legend: { display: false } },
            scales: {
                y: { beginAtZero: true, ticks: { stepSize: 1 }, grid: { color: '#f3f4f6' } },
                x: { grid: { display: false } }
            }
        }
    });

    @php
        $categories = \App\Models\Complaint::selectRaw('category, count(*) as total')
                        ->groupBy('category')->get();
    @endphp
    new Chart(document.getElementById('categoryChart'), {
        type: 'bar',
        data: {
            labels: @json($categories->pluck('category')),
            datasets: [{
                data: @json($categories->pluck('total')),
                backgroundColor: ['#3b82f6','#8b5cf6','#f59e0b','#ef4444','#22c55e','#06b6d4'],
                borderRadius: 10,
                borderSkipped: false,
            }]
        },
        options: {
            plugins: { legend: { display: false } },
            scales: {
                y: { beginAtZero: true, ticks: { stepSize: 1 }, grid: { color: '#f3f4f6' } },
                x: { grid: { display: false } }
            }
        }
    });
</script>

@endsection