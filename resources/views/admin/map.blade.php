@extends('layouts.admin')

@section('content')

<!-- Header -->
<div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-3">
    <div>
        <h1 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/>
            </svg>
            Complaint Map
        </h1>
        <p class="text-gray-400 text-sm mt-1">Live complaint locations across Hyderabad</p>
    </div>
    <span class="bg-white shadow-sm border border-gray-100 px-4 py-2 rounded-xl text-sm text-gray-600 font-medium flex items-center gap-1.5">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
        </svg>
        Total Pins: <strong class="text-blue-600">{{ $complaints->whereNotNull('latitude')->count() }}</strong>
    </span>
</div>

<!-- Stats + Legend Row -->
<div class="grid grid-cols-2 md:grid-cols-4 gap-3 mb-6">
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4 flex items-center gap-3">
        <span class="w-4 h-4 rounded-full bg-red-500 flex-shrink-0"></span>
        <div>
            <p class="text-xs text-gray-400">Pending</p>
            <p class="font-bold text-red-500">{{ $complaints->where('status','pending')->whereNotNull('latitude')->count() }}</p>
        </div>
    </div>
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4 flex items-center gap-3">
        <span class="w-4 h-4 rounded-full bg-orange-400 flex-shrink-0"></span>
        <div>
            <p class="text-xs text-gray-400">In Progress</p>
            <p class="font-bold text-orange-500">{{ $complaints->where('status','in_progress')->whereNotNull('latitude')->count() }}</p>
        </div>
    </div>
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4 flex items-center gap-3">
        <span class="w-4 h-4 rounded-full bg-green-500 flex-shrink-0"></span>
        <div>
            <p class="text-xs text-gray-400">Resolved</p>
            <p class="font-bold text-green-500">{{ $complaints->where('status','resolved')->whereNotNull('latitude')->count() }}</p>
        </div>
    </div>
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4 flex items-center gap-3">
        <span class="w-4 h-4 rounded-full bg-red-600 flex-shrink-0"></span>
        <div>
            <p class="text-xs text-gray-400">High Priority</p>
            <p class="font-bold text-red-600">{{ $complaints->where('priority','high')->whereNotNull('latitude')->count() }}</p>
        </div>
    </div>
</div>

<!-- Filter Bar -->
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4 mb-4">
    <div class="flex flex-wrap gap-2 items-center">
        <p class="text-sm font-medium text-gray-600 mr-2">Filter:</p>
        <button onclick="filterMap('all')"
            id="btn-all"
            class="filter-btn px-4 py-1.5 rounded-full text-xs font-semibold bg-gray-800 text-white transition">
            All
        </button>
        <button onclick="filterMap('pending')"
            id="btn-pending"
            class="filter-btn px-4 py-1.5 rounded-full text-xs font-semibold bg-gray-100 text-gray-600 hover:bg-red-100 hover:text-red-600 transition">
            Pending
        </button>
        <button onclick="filterMap('in_progress')"
            id="btn-in_progress"
            class="filter-btn px-4 py-1.5 rounded-full text-xs font-semibold bg-gray-100 text-gray-600 hover:bg-orange-100 hover:text-orange-600 transition">
            In Progress
        </button>
        <button onclick="filterMap('resolved')"
            id="btn-resolved"
            class="filter-btn px-4 py-1.5 rounded-full text-xs font-semibold bg-gray-100 text-gray-600 hover:bg-green-100 hover:text-green-600 transition">
            Resolved
        </button>
        <button onclick="filterMap('high')"
            id="btn-high"
            class="filter-btn px-4 py-1.5 rounded-full text-xs font-semibold bg-gray-100 text-gray-600 hover:bg-red-100 hover:text-red-600 transition">
            High Priority
        </button>
        <button onclick="recenterMap()"
            class="ml-auto px-4 py-1.5 rounded-full text-xs font-semibold bg-blue-600 text-white hover:bg-blue-700 transition flex items-center gap-1.5">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
            </svg>
            Recenter
        </button>
    </div>
</div>

<!-- Map -->
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<div id="map" class="rounded-2xl shadow-lg w-full border border-gray-100" style="height: 520px;"></div>
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<!-- Complaint List Below Map -->
<div class="mt-6">
    <h3 class="font-semibold text-gray-700 mb-3 flex items-center gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
        </svg>
        Complaints with Location
    </h3>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3">
        @foreach($complaints->whereNotNull('latitude') as $c)
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4 flex items-center gap-3 cursor-pointer hover:shadow-md transition"
            onclick="flyToComplaint({{ $c->latitude }}, {{ $c->longitude }})">
            <div class="w-3 h-3 rounded-full flex-shrink-0
                {{ $c->status == 'pending' ? 'bg-red-500' :
                   ($c->status == 'in_progress' ? 'bg-orange-400' : 'bg-green-500') }}">
            </div>
            <div class="flex-1 min-w-0">
                <p class="font-semibold text-gray-800 text-sm truncate">{{ $c->title }}</p>
                <p class="text-xs text-gray-400">{{ $c->city ?? 'N/A' }} • {{ ucfirst(str_replace('_',' ',$c->status)) }}</p>
            </div>
            <span class="px-2 py-0.5 rounded-full text-xs font-bold
                {{ $c->priority == 'high' ? 'bg-red-100 text-red-600' :
                   ($c->priority == 'medium' ? 'bg-yellow-100 text-yellow-600' :
                   'bg-green-100 text-green-600') }}">
                {{ ucfirst($c->priority) }}
            </span>
        </div>
        @endforeach

        @if($complaints->whereNotNull('latitude')->count() == 0)
        <div class="col-span-3 text-center py-10 text-gray-400">
            <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
            </div>
            <p class="font-medium">No complaints with location data yet.</p>
        </div>
        @endif
    </div>
</div>

<script>
    var map = L.map('map').setView([25.3960, 68.3578], 13);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    var complaints = @json($complaints);
    var allMarkers = [];

    function getIcon(status, priority) {
        let color = '#3b82f6';
        if (status === 'pending')     color = '#ef4444';
        if (status === 'in_progress') color = '#f97316';
        if (status === 'resolved')    color = '#22c55e';

        let size = priority === 'high' ? 18 : (priority === 'medium' ? 14 : 11);

        return L.divIcon({
            className: '',
            html: `<div style="
                width: ${size}px; height: ${size}px;
                background: ${color};
                border: 2.5px solid white;
                border-radius: 50%;
                box-shadow: 0 3px 8px rgba(0,0,0,0.35);
                cursor: pointer;
            "></div>`,
            iconSize: [size, size],
            iconAnchor: [size/2, size/2],
        });
    }

    complaints.forEach(function(c) {
        if (c.latitude && c.longitude) {
            var icon = getIcon(c.status, c.priority);

            var priorityBadge = '';
            if (c.priority === 'high')   priorityBadge = '<span style="background:#fee2e2;color:#dc2626;padding:2px 10px;border-radius:20px;font-size:11px;font-weight:600;">High</span>';
            if (c.priority === 'medium') priorityBadge = '<span style="background:#fef9c3;color:#ca8a04;padding:2px 10px;border-radius:20px;font-size:11px;font-weight:600;">Medium</span>';
            if (c.priority === 'low')    priorityBadge = '<span style="background:#dcfce7;color:#16a34a;padding:2px 10px;border-radius:20px;font-size:11px;font-weight:600;">Low</span>';

            var statusBadge = '';
            if (c.status === 'pending')     statusBadge = '<span style="background:#fee2e2;color:#dc2626;padding:2px 10px;border-radius:20px;font-size:11px;font-weight:600;">Pending</span>';
            if (c.status === 'in_progress') statusBadge = '<span style="background:#dbeafe;color:#2563eb;padding:2px 10px;border-radius:20px;font-size:11px;font-weight:600;">In Progress</span>';
            if (c.status === 'resolved')    statusBadge = '<span style="background:#dcfce7;color:#16a34a;padding:2px 10px;border-radius:20px;font-size:11px;font-weight:600;">Resolved</span>';

            var marker = L.marker([c.latitude, c.longitude], { icon: icon }).addTo(map);

            marker.bindPopup(`
                <div style="min-width:210px; font-family:sans-serif; padding:4px;">
                    <p style="font-weight:bold; font-size:14px; margin-bottom:6px; color:#1f2937;">
                        #${c.id} — ${c.title}
                    </p>
                    <p style="font-size:12px; color:#6b7280; margin-bottom:3px;">${c.user ? c.user.name : 'N/A'}</p>
                    <p style="font-size:12px; color:#6b7280; margin-bottom:8px;">${c.category ?? 'N/A'} &nbsp;|&nbsp; ${c.city ?? 'N/A'}</p>
                    <div style="display:flex; gap:6px; flex-wrap:wrap;">
                        ${priorityBadge}
                        ${statusBadge}
                    </div>
                </div>
            `, { maxWidth: 260 });

            allMarkers.push({ marker, status: c.status, priority: c.priority });
        }
    });

    function filterMap(type) {
        document.querySelectorAll('.filter-btn').forEach(btn => {
            btn.className = 'filter-btn px-4 py-1.5 rounded-full text-xs font-semibold bg-gray-100 text-gray-600 transition';
        });
        document.getElementById('btn-' + type).className =
            'filter-btn px-4 py-1.5 rounded-full text-xs font-semibold bg-gray-800 text-white transition';

        allMarkers.forEach(({ marker, status, priority }) => {
            let show = false;
            if (type === 'all')         show = true;
            if (type === 'pending')     show = status === 'pending';
            if (type === 'in_progress') show = status === 'in_progress';
            if (type === 'resolved')    show = status === 'resolved';
            if (type === 'high')        show = priority === 'high';

            if (show) {
                if (!map.hasLayer(marker)) map.addLayer(marker);
            } else {
                if (map.hasLayer(marker)) map.removeLayer(marker);
            }
        });
    }

    function flyToComplaint(lat, lng) {
        map.flyTo([lat, lng], 16, { animate: true, duration: 1 });
    }

    function recenterMap() {
        map.flyTo([25.3960, 68.3578], 13, { animate: true, duration: 1 });
    }
</script>

@endsection