@extends('layouts.admin')

@section('content')
<!-- Header -->
<div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-1 mb-6">
    <h1 class="text-xl md:text-2xl font-bold text-gray-800">Dashboard</h1>
    <span class="text-xs md:text-sm text-gray-400">{{ now()->format('l, d M Y') }}</span>
</div>

<!-- Stats Row 1 -->
<div class="grid grid-cols-2 md:grid-cols-4 gap-3 md:gap-4 mb-6 md:mb-8">
    <div class="bg-white rounded-xl md:rounded-2xl p-3 md:p-5 shadow-sm border-l-4 border-red-400 flex items-center gap-2.5 md:gap-4">
        <div class="w-10 h-10 md:w-14 md:h-14 bg-red-50 rounded-xl md:rounded-2xl flex items-center justify-center flex-shrink-0">
            <img src="https://cdn.jsdelivr.net/gh/twitter/twemoji@14.0.2/assets/svg/1f3d9.svg" class="w-5 h-5 md:w-7 md:h-7">
        </div>
        <div>
            <p class="text-gray-400 text-xs font-medium">Cities Monitored</p>
            <p class="text-lg md:text-2xl font-bold text-gray-800 mt-0.5">{{ $totalCities }}</p>
        </div>
    </div>

    <div class="bg-white rounded-xl md:rounded-2xl p-3 md:p-5 shadow-sm border-l-4 border-indigo-400 flex items-center gap-2.5 md:gap-4">
        <div class="w-10 h-10 md:w-14 md:h-14 bg-indigo-50 rounded-xl md:rounded-2xl flex items-center justify-center flex-shrink-0">
            <img src="https://cdn.jsdelivr.net/gh/twitter/twemoji@14.0.2/assets/svg/1f4cb.svg" class="w-5 h-5 md:w-7 md:h-7">
        </div>
        <div>
            <p class="text-gray-400 text-xs font-medium">Total Complaints</p>
            <p class="text-lg md:text-2xl font-bold text-gray-800 mt-0.5">{{ $pending + $inProgress + $resolved }}</p>
        </div>
    </div>

    <div class="bg-white rounded-xl md:rounded-2xl p-3 md:p-5 shadow-sm border-l-4 border-yellow-400 flex items-center gap-2.5 md:gap-4">
        <div class="w-10 h-10 md:w-14 md:h-14 bg-yellow-50 rounded-xl md:rounded-2xl flex items-center justify-center flex-shrink-0">
            <img src="https://cdn.jsdelivr.net/gh/twitter/twemoji@14.0.2/assets/svg/1f465.svg" class="w-5 h-5 md:w-7 md:h-7">
        </div>
        <div>
            <p class="text-gray-400 text-xs font-medium">Total Population</p>
            <p class="text-lg md:text-2xl font-bold text-gray-800 mt-0.5">{{ number_format($totalPopulation) }}</p>
        </div>
    </div>

    <div class="bg-white rounded-xl md:rounded-2xl p-3 md:p-5 shadow-sm border-l-4 border-green-400 flex items-center gap-2.5 md:gap-4">
        <div class="w-10 h-10 md:w-14 md:h-14 bg-green-50 rounded-xl md:rounded-2xl flex items-center justify-center flex-shrink-0">
            <img src="https://cdn.jsdelivr.net/gh/twitter/twemoji@14.0.2/assets/svg/2705.svg" class="w-5 h-5 md:w-7 md:h-7">
        </div>
        <div>
            <p class="text-gray-400 text-xs font-medium">Resolved</p>
            <p class="text-lg md:text-2xl font-bold text-gray-800 mt-0.5">{{ $resolved }}</p>
        </div>
    </div>
</div>

<!-- Admin Command Center -->
<h2 class="text-sm md:text-base font-bold text-gray-700 mb-3">Complaint Status Overview</h2>
<div class="grid grid-cols-2 md:grid-cols-3 gap-3 md:gap-4 mb-6 md:mb-8">
    <div class="bg-white rounded-xl md:rounded-2xl p-3 md:p-5 shadow-sm border-l-4 border-orange-400 flex items-center gap-2.5 md:gap-4">
        <div class="w-10 h-10 md:w-14 md:h-14 bg-orange-50 rounded-xl md:rounded-2xl flex items-center justify-center flex-shrink-0">
            <img src="https://cdn.jsdelivr.net/gh/twitter/twemoji@14.0.2/assets/svg/231b.svg" class="w-5 h-5 md:w-7 md:h-7">
        </div>
        <div>
            <p class="text-gray-400 text-xs font-medium">Pending</p>
            <p class="text-lg md:text-2xl font-bold text-gray-800 mt-0.5">{{ $pending }}</p>
        </div>
    </div>

    <div class="bg-white rounded-xl md:rounded-2xl p-3 md:p-5 shadow-sm border-l-4 border-blue-400 flex items-center gap-2.5 md:gap-4">
        <div class="w-10 h-10 md:w-14 md:h-14 bg-blue-50 rounded-xl md:rounded-2xl flex items-center justify-center flex-shrink-0">
            <img src="https://cdn.jsdelivr.net/gh/twitter/twemoji@14.0.2/assets/svg/1f504.svg" class="w-5 h-5 md:w-7 md:h-7">
        </div>
        <div>
            <p class="text-gray-400 text-xs font-medium">In Progress</p>
            <p class="text-lg md:text-2xl font-bold text-gray-800 mt-0.5">{{ $inProgress }}</p>
        </div>
    </div>

    <div class="bg-white rounded-xl md:rounded-2xl p-3 md:p-5 shadow-sm border-l-4 border-green-400 flex items-center gap-2.5 md:gap-4 col-span-2 md:col-span-1">
        <div class="w-10 h-10 md:w-14 md:h-14 bg-green-50 rounded-xl md:rounded-2xl flex items-center justify-center flex-shrink-0">
            <img src="https://cdn.jsdelivr.net/gh/twitter/twemoji@14.0.2/assets/svg/2705.svg" class="w-5 h-5 md:w-7 md:h-7">
        </div>
        <div>
            <p class="text-gray-400 text-xs font-medium">Resolved</p>
            <p class="text-lg md:text-2xl font-bold text-gray-800 mt-0.5">{{ $resolved }}</p>
        </div>
    </div>
</div>

<!-- Charts Row -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6 mb-6">
    <!-- Pie Chart -->
    <div class="bg-white rounded-xl shadow-sm p-4 md:p-6">
        <div class="flex items-center justify-between mb-5">
            <h3 class="font-semibold text-gray-800 text-sm md:text-base">Complaints by Status</h3>
        </div>
        <div class="relative" style="height: 260px;">
            <canvas id="statusPieChart"></canvas>
        </div>
    </div>

    <!-- Line Chart -->
    <div class="bg-white rounded-xl shadow-sm p-4 md:p-6">
        <div class="flex items-center justify-between mb-5">
            <h3 class="font-semibold text-gray-800 text-sm md:text-base">Complaints — Last 7 Days</h3>
        </div>
        <div class="relative" style="height: 260px;">
            <canvas id="weeklyLineChart"></canvas>
        </div>
    </div>
</div>

<!-- Category Bar Chart -->
<div class="bg-white rounded-xl shadow-sm p-4 md:p-6 mb-6">
    <div class="flex items-center justify-between mb-5">
        <h3 class="font-semibold text-gray-800 text-sm md:text-base">Complaints by Category</h3>
    </div>
    <div class="relative" style="height: 280px;">
        <canvas id="categoryBarChart"></canvas>
    </div>
</div>

<!-- Recent Complaints -->
<div class="bg-white rounded-2xl shadow-sm p-4 md:p-6 mb-8">
    <div class="flex justify-between items-center mb-5">
        <h3 class="font-bold text-gray-800 text-base">Recent Complaints</h3>
        <a href="{{ route('admin.complaints') }}" class="text-indigo-500 text-sm font-medium hover:underline">View All →</a>
    </div>

    <!-- MOBILE: Cards -->
    <div class="md:hidden space-y-3">
        @foreach($recentComplaints as $c)
        <div class="border border-gray-100 rounded-xl p-3">
            <div class="flex items-center gap-3 mb-2">
                <img src="https://ui-avatars.com/api/?name={{ urlencode($c->user->name ?? 'NA') }}&background=EDE9FE&color=5B3FD6&bold=true"
                    class="w-9 h-9 rounded-full object-cover">
                <div class="flex-1 min-w-0">
                    <p class="font-semibold text-gray-800 text-sm truncate">{{ $c->user->name ?? 'N/A' }}</p>
                    <p class="text-gray-400 text-xs">#{{ $c->id }} · {{ $c->title }}</p>
                </div>
            </div>
            <div class="flex items-center gap-2 flex-wrap">
                <span class="px-2 py-0.5 rounded-full text-xs font-semibold
                    {{ $c->priority === 'high' ? 'bg-red-100 text-red-600' :
                       ($c->priority === 'medium' ? 'bg-yellow-100 text-yellow-600' :
                       'bg-green-100 text-green-600') }}">
                    {{ ucfirst($c->priority ?? 'N/A') }}
                </span>
                <span class="px-2 py-0.5 rounded-full text-xs font-semibold
                    {{ $c->status === 'resolved' ? 'bg-green-100 text-green-600' :
                       ($c->status === 'in_progress' ? 'bg-blue-100 text-blue-600' :
                       'bg-yellow-100 text-yellow-600') }}">
                    {{ ucfirst(str_replace('_', ' ', $c->status)) }}
                </span>
                <span class="text-gray-400 text-xs ml-auto">{{ $c->created_at->format('d M Y') }}</span>
            </div>
        </div>
        @endforeach
    </div>

    <!-- DESKTOP: Table -->
    <table class="w-full text-sm hidden md:table">
        <thead>
            <tr class="text-gray-400 text-xs uppercase">
                <th class="pb-3 text-left font-medium">Citizen</th>
                <th class="pb-3 text-left font-medium">Complaint</th>
                <th class="pb-3 text-left font-medium">Priority</th>
                <th class="pb-3 text-left font-medium">Status</th>
                <th class="pb-3 text-left font-medium">Date</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-50">
            @foreach($recentComplaints as $c)
            <tr class="hover:bg-gray-50 transition">
                <td class="py-3.5 pr-3">
                    <div class="flex items-center gap-3">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($c->user->name ?? 'NA') }}&background=EDE9FE&color=5B3FD6&bold=true"
                            class="w-9 h-9 rounded-full object-cover">
                        <div>
                            <p class="font-semibold text-gray-800 text-sm">{{ $c->user->name ?? 'N/A' }}</p>
                            <p class="text-gray-400 text-xs">#{{ $c->id }} · {{ ucfirst($c->category ?? 'N/A') }}</p>
                        </div>
                    </div>
                </td>
                <td class="py-3.5 pr-3 text-gray-600">{{ $c->title }}</td>
                <td class="py-3.5 pr-3">
                    <span class="px-2.5 py-1 rounded-full text-xs font-semibold
                        {{ $c->priority === 'high' ? 'bg-red-100 text-red-600' :
                           ($c->priority === 'medium' ? 'bg-yellow-100 text-yellow-600' :
                           'bg-green-100 text-green-600') }}">
                        {{ ucfirst($c->priority ?? 'N/A') }}
                    </span>
                </td>
                <td class="py-3.5 pr-3">
                    <span class="px-2.5 py-1 rounded-full text-xs font-semibold
                        {{ $c->status === 'resolved' ? 'bg-green-100 text-green-600' :
                           ($c->status === 'in_progress' ? 'bg-blue-100 text-blue-600' :
                           'bg-yellow-100 text-yellow-600') }}">
                        {{ ucfirst(str_replace('_', ' ', $c->status)) }}
                    </span>
                </td>
                <td class="py-3.5 text-gray-400">{{ $c->created_at->format('d M Y') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Common professional options
    Chart.defaults.font.family = "'Inter', 'Segoe UI', system-ui, sans-serif";
    Chart.defaults.color = '#6b7280';
    Chart.defaults.borderColor = 'rgba(0,0,0,0.05)';

    // ========== STATUS DOUGHNUT ==========
    new Chart(document.getElementById('statusPieChart'), {
        type: 'doughnut',
        data: {
            labels: ['Pending', 'In Progress', 'Resolved'],
            datasets: [{
                data: [{{ $pending }}, {{ $inProgress }}, {{ $resolved }}],
                backgroundColor: [
                    'rgba(249, 115, 22, 0.85)',   // orange
                    'rgba(59, 130, 246, 0.85)',   // blue
                    'rgba(34, 197, 94, 0.85)'     // green
                ],
                borderColor: '#ffffff',
                borderWidth: 3,
                hoverOffset: 8,
                borderRadius: 4,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '68%',
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        usePointStyle: true,
                        pointStyle: 'circle',
                        padding: 20,
                        font: { size: 12, weight: '500' }
                    }
                },
                tooltip: {
                    backgroundColor: 'rgba(17, 24, 39, 0.92)',
                    titleFont: { size: 13, weight: '600' },
                    bodyFont: { size: 13 },
                    padding: 12,
                    cornerRadius: 8,
                    displayColors: true,
                    callbacks: {
                        label: function(context) {
                            const total = context.dataset.data.reduce((a, b) => a + b, 0);
                            const value = context.raw;
                            const percentage = total > 0 ? Math.round((value / total) * 100) : 0;
                            return ` ${context.label}: ${value} (${percentage}%)`;
                        }
                    }
                }
            },
            animation: {
                animateRotate: true,
                animateScale: true,
                duration: 900
            }
        }
    });

    // ========== WEEKLY LINE CHART ==========
    const lineCtx = document.getElementById('weeklyLineChart').getContext('2d');
    const gradient = lineCtx.createLinearGradient(0, 0, 0, 260);
    gradient.addColorStop(0, 'rgba(59, 130, 246, 0.25)');
    gradient.addColorStop(1, 'rgba(59, 130, 246, 0.02)');

    new Chart(lineCtx, {
        type: 'line',
        data: {
            labels: @json($last7Days->pluck('date')),
            datasets: [{
                label: 'Complaints',
                data: @json($last7Days->pluck('count')),
                borderColor: '#3b82f6',
                backgroundColor: gradient,
                borderWidth: 2.5,
                tension: 0.4,
                fill: true,
                pointBackgroundColor: '#ffffff',
                pointBorderColor: '#3b82f6',
                pointBorderWidth: 2.5,
                pointRadius: 4,
                pointHoverRadius: 6,
                pointHoverBackgroundColor: '#3b82f6',
                pointHoverBorderColor: '#ffffff',
                pointHoverBorderWidth: 2,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            interaction: {
                mode: 'index',
                intersect: false,
            },
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: 'rgba(17, 24, 39, 0.92)',
                    titleFont: { size: 13, weight: '600' },
                    bodyFont: { size: 13 },
                    padding: 12,
                    cornerRadius: 8,
                    displayColors: false,
                    callbacks: {
                        label: function(context) {
                            return ` ${context.parsed.y} complaint${context.parsed.y !== 1 ? 's' : ''}`;
                        }
                    }
                }
            },
            scales: {
                x: {
                    grid: { display: false },
                    ticks: {
                        font: { size: 11 },
                        color: '#9ca3af'
                    }
                },
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1,
                        font: { size: 11 },
                        color: '#9ca3af',
                        precision: 0
                    },
                    grid: {
                        color: 'rgba(0,0,0,0.04)',
                        drawBorder: false
                    }
                }
            },
            animation: {
                duration: 900,
                easing: 'easeOutQuart'
            }
        }
    });

    // ========== CATEGORY BAR CHART ==========
    new Chart(document.getElementById('categoryBarChart'), {
        type: 'bar',
        data: {
            labels: @json($categoryStats->pluck('category')),
            datasets: [{
                label: 'Complaints',
                data: @json($categoryStats->pluck('total')),
                backgroundColor: [
                    'rgba(59, 130, 246, 0.8)',
                    'rgba(249, 115, 22, 0.8)',
                    'rgba(34, 197, 94, 0.8)',
                    'rgba(168, 85, 247, 0.8)',
                    'rgba(236, 72, 153, 0.8)',
                    'rgba(20, 184, 166, 0.8)',
                    'rgba(234, 179, 8, 0.8)',
                    'rgba(99, 102, 241, 0.8)'
                ],
                borderRadius: 8,
                borderSkipped: false,
                maxBarThickness: 48,
                hoverBackgroundColor: [
                    'rgba(59, 130, 246, 1)',
                    'rgba(249, 115, 22, 1)',
                    'rgba(34, 197, 94, 1)',
                    'rgba(168, 85, 247, 1)',
                    'rgba(236, 72, 153, 1)',
                    'rgba(20, 184, 166, 1)',
                    'rgba(234, 179, 8, 1)',
                    'rgba(99, 102, 241, 1)'
                ]
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: 'rgba(17, 24, 39, 0.92)',
                    titleFont: { size: 13, weight: '600' },
                    bodyFont: { size: 13 },
                    padding: 12,
                    cornerRadius: 8,
                    displayColors: true,
                    callbacks: {
                        label: function(context) {
                            return ` ${context.parsed.y} complaint${context.parsed.y !== 1 ? 's' : ''}`;
                        }
                    }
                }
            },
            scales: {
                x: {
                    grid: { display: false },
                    ticks: {
                        font: { size: 12, weight: '500' },
                        color: '#6b7280'
                    }
                },
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1,
                        font: { size: 11 },
                        color: '#9ca3af',
                        precision: 0
                    },
                    grid: {
                        color: 'rgba(0,0,0,0.04)',
                        drawBorder: false
                    }
                }
            },
            animation: {
                duration: 900,
                easing: 'easeOutQuart'
            }
        }
    });
</script>
@endsection