@extends('layouts.admin')

@section('content')

<!-- Header -->
<div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-3">
    <div>
        <h1 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
            </svg>
            Departments Management
        </h1>
        <p class="text-gray-400 text-sm mt-1">Manage city departments connected to the system</p>
    </div>
    <button onclick="document.getElementById('addDeptModal').classList.remove('hidden')"
        class="bg-blue-600 text-white px-5 py-2.5 rounded-xl text-sm font-semibold hover:bg-blue-700 transition shadow flex items-center gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
        Add Department
    </button>
</div>

<!-- Stats -->
<div class="grid grid-cols-2 md:grid-cols-3 gap-4 mb-6">
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
        <p class="text-gray-400 text-xs mb-1">Total Departments</p>
        <p class="text-3xl font-bold text-blue-600">{{ $departments->count() }}</p>
    </div>
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
        <p class="text-gray-400 text-xs mb-1">Active</p>
        <p class="text-3xl font-bold text-green-600">{{ $departments->where('is_active', true)->count() }}</p>
    </div>
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 col-span-2 md:col-span-1">
        <p class="text-gray-400 text-xs mb-1">Total Assigned Complaints</p>
        <p class="text-3xl font-bold text-purple-600">{{ $departments->sum('complaints_count') }}</p>
    </div>
</div>

@php
    function getDeptSvg($name) {
        $key = strtolower($name);
        if (str_contains($key, 'water') || str_contains($key, 'sewer')) {
            return '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>';
        } elseif (str_contains($key, 'electric') || str_contains($key, 'power')) {
            return '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M13 10V3L4 14h7v7l9-11h-7z"/>';
        } elseif (str_contains($key, 'road') || str_contains($key, 'street')) {
            return '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/>';
        } elseif (str_contains($key, 'waste') || str_contains($key, 'garbage')) {
            return '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>';
        } elseif (str_contains($key, 'park') || str_contains($key, 'garden')) {
            return '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>';
        }
        return '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>';
    }
@endphp

<!-- MOBILE: Cards -->
<div class="md:hidden space-y-4">
    @foreach($departments as $dept)
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="h-1.5 bg-blue-500"></div>
        <div class="p-4">
            <div class="flex justify-between items-start mb-3">
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 bg-blue-50 rounded-xl flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            {!! getDeptSvg($dept->name) !!}
                        </svg>
                    </div>
                    <div>
                        <p class="font-bold text-gray-800">{{ $dept->name }}</p>
                        <p class="text-xs text-gray-400">{{ $dept->email }}</p>
                    </div>
                </div>
                <span class="px-2.5 py-1 rounded-full text-xs font-semibold {{ $dept->is_active ? 'bg-green-100 text-green-600' : 'bg-gray-100 text-gray-500' }}">
                    {{ $dept->is_active ? 'Active' : 'Inactive' }}
                </span>
            </div>
            <div class="bg-gray-50 rounded-xl p-3 mb-3 text-center">
                <p class="font-bold text-gray-700">{{ $dept->complaints_count }}</p>
                <p class="text-xs text-gray-400">Assigned Complaints</p>
            </div>
            <div class="flex gap-2">
                <button onclick="openEditModal({{ $dept->id }}, '{{ $dept->name }}', '{{ $dept->email }}', '{{ $dept->icon }}')"
                    class="flex-1 flex items-center justify-center gap-1.5 bg-yellow-400 text-white py-2 rounded-xl text-xs font-semibold hover:bg-yellow-500 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                    Edit
                </button>
                <form action="{{ route('admin.departments.destroy', $dept->id) }}" method="POST" class="flex-1"
                    onsubmit="return confirm('Delete {{ $dept->name }}? Assigned complaints will become unassigned.')">
                    @csrf @method('DELETE')
                    <button class="w-full flex items-center justify-center gap-1.5 bg-red-500 text-white py-2 rounded-xl text-xs font-semibold hover:bg-red-600 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                        Delete
                    </button>
                </form>
            </div>
        </div>
    </div>
    @endforeach
</div>

<!-- DESKTOP: Table -->
<div class="hidden md:block bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="px-6 py-4 border-b bg-gray-50 flex justify-between items-center">
        <p class="font-semibold text-gray-700">All Departments</p>
        <p class="text-xs text-gray-400">{{ $departments->count() }} connected</p>
    </div>
    <table class="w-full text-sm">
        <thead class="text-gray-400 text-xs uppercase border-b">
            <tr>
                <th class="px-6 py-3 text-left font-medium">Department</th>
                <th class="px-6 py-3 text-left font-medium">Login Email</th>
                <th class="px-6 py-3 text-left font-medium">Status</th>
                <th class="px-6 py-3 text-left font-medium">Assigned Complaints</th>
                <th class="px-6 py-3 text-left font-medium">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-50">
            @foreach($departments as $dept)
            <tr class="hover:bg-gray-50 transition">
                <td class="px-6 py-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-blue-50 rounded-xl flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                {!! getDeptSvg($dept->name) !!}
                            </svg>
                        </div>
                        <p class="font-bold text-gray-800">{{ $dept->name }}</p>
                    </div>
                </td>
                <td class="px-6 py-4 text-gray-600">{{ $dept->email }}</td>
                <td class="px-6 py-4">
                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold {{ $dept->is_active ? 'bg-green-100 text-green-600' : 'bg-gray-100 text-gray-500' }}">
                        <span class="w-1.5 h-1.5 rounded-full {{ $dept->is_active ? 'bg-green-500' : 'bg-gray-400' }}"></span>
                        {{ $dept->is_active ? 'Active' : 'Inactive' }}
                    </span>
                </td>
                <td class="px-6 py-4">
                    <span class="font-bold text-gray-700">{{ $dept->complaints_count }}</span>
                    <span class="text-gray-400 text-xs">complaints</span>
                </td>
                <td class="px-6 py-4">
                    <div class="flex gap-2">
                        <button onclick="openEditModal({{ $dept->id }}, '{{ $dept->name }}', '{{ $dept->email }}', '{{ $dept->icon }}')"
                            class="flex items-center gap-1.5 bg-yellow-400 text-white px-4 py-1.5 rounded-xl text-xs font-semibold hover:bg-yellow-500 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                            Edit
                        </button>
                        <form action="{{ route('admin.departments.destroy', $dept->id) }}" method="POST"
                            onsubmit="return confirm('Delete {{ $dept->name }}? Assigned complaints will become unassigned.')">
                            @csrf @method('DELETE')
                            <button class="flex items-center gap-1.5 bg-red-500 text-white px-4 py-1.5 rounded-xl text-xs font-semibold hover:bg-red-600 transition">
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

<!-- Add Department Modal -->
<div id="addDeptModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md p-6">
        <div class="flex justify-between items-center mb-5">
            <h3 class="font-bold text-gray-800 text-lg flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Add New Department
            </h3>
            <button onclick="document.getElementById('addDeptModal').classList.add('hidden')"
                class="text-gray-400 hover:text-gray-600 text-xl">✕</button>
        </div>

        <form action="{{ route('admin.departments.store') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label class="block text-xs font-semibold text-gray-500 uppercase mb-1.5">Department Name</label>
                <input type="text" name="name" required
                    placeholder="e.g. Parks Department"
                    class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="block text-xs font-semibold text-gray-500 uppercase mb-1.5">Icon (Emoji)</label>
                <input type="text" name="icon"
                    placeholder="e.g. 🌳"
                    maxlength="4"
                    class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="block text-xs font-semibold text-gray-500 uppercase mb-1.5">Login Email</label>
                <input type="email" name="email" required
                    placeholder="dept@hyderabad.gov.pk"
                    class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="block text-xs font-semibold text-gray-500 uppercase mb-1.5">Login Password</label>
                <input type="password" name="password" required
                    placeholder="Min. 6 characters"
                    class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="flex gap-3 pt-2">
                <button type="submit"
                    class="flex-1 bg-blue-600 text-white py-3 rounded-xl text-sm font-semibold hover:bg-blue-700 transition">
                    Save Department
                </button>
                <button type="button" onclick="document.getElementById('addDeptModal').classList.add('hidden')"
                    class="flex-1 bg-gray-100 text-gray-600 py-3 rounded-xl text-sm font-semibold hover:bg-gray-200 transition">
                    Cancel
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Edit Department Modal -->
<div id="editDeptModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md p-6">
        <div class="flex justify-between items-center mb-5">
            <h3 class="font-bold text-gray-800 text-lg flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-yellow-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                </svg>
                Edit Department
            </h3>
            <button onclick="document.getElementById('editDeptModal').classList.add('hidden')"
                class="text-gray-400 hover:text-gray-600 text-xl">✕</button>
        </div>

        <form id="editDeptForm" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-xs font-semibold text-gray-500 uppercase mb-1.5">Department Name</label>
                <input type="text" name="name" id="edit_name" required
                    class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="block text-xs font-semibold text-gray-500 uppercase mb-1.5">Icon (Emoji)</label>
                <input type="text" name="icon" id="edit_icon" maxlength="4"
                    class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="block text-xs font-semibold text-gray-500 uppercase mb-1.5">Login Email</label>
                <input type="email" name="email" id="edit_email" required
                    class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="block text-xs font-semibold text-gray-500 uppercase mb-1.5">
                    New Password <span class="text-gray-400 normal-case">(leave blank to keep current)</span>
                </label>
                <input type="password" name="password"
                    placeholder="Min. 6 characters"
                    class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="flex gap-3 pt-2">
                <button type="submit"
                    class="flex-1 bg-yellow-500 text-white py-3 rounded-xl text-sm font-semibold hover:bg-yellow-600 transition">
                    Update Department
                </button>
                <button type="button" onclick="document.getElementById('editDeptModal').classList.add('hidden')"
                    class="flex-1 bg-gray-100 text-gray-600 py-3 rounded-xl text-sm font-semibold hover:bg-gray-200 transition">
                    Cancel
                </button>
            </div>
        </form>
    </div>
</div>

@if($errors->any())
<script>document.getElementById('addDeptModal').classList.remove('hidden');</script>
@endif
<script>
function openEditModal(id, name, email, icon) {
    document.getElementById('edit_name').value = name;
    document.getElementById('edit_email').value = email;
    document.getElementById('edit_icon').value = icon;
    document.getElementById('editDeptForm').action = '/admin/departments/' + id;
    document.getElementById('editDeptModal').classList.remove('hidden');
}
</script>

@endsection