@extends('layouts.user')

@section('content')

<div class="max-w-3xl mx-auto">

    <!-- Header -->
    <div class="mb-6">
        <a href="{{ route('complaints.index') }}"
            class="inline-flex items-center gap-2 text-gray-400 hover:text-gray-600 text-sm mb-3">
            ← Back to Complaints
        </a>
        <h1 class="text-2xl font-bold text-gray-800">📝 Report an Issue</h1>
        <p class="text-gray-400 text-sm mt-1">Submit a new complaint to Smart Hyderabad City</p>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-2xl shadow p-6">

        @if(session('success'))
        <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl text-sm mb-4 flex items-center gap-2">
            ✅ {{ session('success') }}
        </div>
        @endif

        <form method="POST" action="/complaints" enctype="multipart/form-data" class="space-y-4">
            @csrf

            <!-- Title -->
            <div>
                <label class="block text-xs font-semibold text-gray-500 uppercase mb-1.5">
                    📌 Title <span class="text-red-500">*</span>
                </label>
                <input type="text" name="title"
                    value="{{ old('title') }}"
                    placeholder="e.g. Water Leakage at Main Road"
                    class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- Description -->
            <div>
                <label class="block text-xs font-semibold text-gray-500 uppercase mb-1.5">
                    📄 Description <span class="text-red-500">*</span>
                </label>
                <textarea name="description" rows="4"
                    placeholder="Describe your issue in detail..."
                    class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 resize-none">{{ old('description') }}</textarea>
            </div>

            <!-- Category + Priority -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-gray-500 uppercase mb-1.5">
                        📂 Category <span class="text-red-500">*</span>
                    </label>
                    <select name="category"
                        class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white">
                        <option value="">Select Category</option>
                        <option value="infrastructure">🛣️ Roads & Infrastructure</option>
                        <option value="waste">🗑️ Waste Management</option>
                        <option value="sewerage">🚰 Sewerage & Drainage</option>
                        <option value="water">💧 Water Supply</option>
                        <option value="street_lights">💡 Street Lights</option>
                        <option value="electricity">⚡ Electricity & Power</option>
                        <option value="public_safety">🚔 Public Safety</option>
                        <option value="traffic">🚦 Traffic & Transport</option>
                        <option value="parks">🌳 Parks & Environment</option>
                        <option value="health">🏥 Health & Sanitation</option>
                        <option value="illegal_encroachments">⚠️ Illegal Encroachments</option>
                        <option value="emergency">🆘 Emergency Services</option>
                        <option value="education">🏫 Education & Schools</option>
                        <option value="food">🍽️ Food Authority</option>
                        <option value="others">📋 Others</option>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-500 uppercase mb-1.5">
                        🔥 Priority <span class="text-red-500">*</span>
                    </label>
                    <select name="priority"
                        class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white">
                        <option value="">Select Priority</option>
                        <option value="low">✅ Low — Can wait</option>
                        <option value="medium">⚠️ Medium — Needs attention</option>
                        <option value="high">🔥 High — Urgent!</option>
                    </select>
                </div>
            </div>

            <!-- City + Location -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-gray-500 uppercase mb-1.5">
                        🏙️ City <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="city"
                        value="{{ old('city') }}"
                        placeholder="e.g. Hyderabad"
                        class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-500 uppercase mb-1.5">
                        📍 Location
                    </label>
                    <input type="text" name="location"
                        value="{{ old('location') }}"
                        placeholder="e.g. Latifabad Unit 6"
                        class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
            </div>

            <!-- Image Upload -->
            <div>
                <label class="block text-xs font-semibold text-gray-500 uppercase mb-1.5">
                    📸 Image (Optional)
                </label>
                <div class="border-2 border-dashed border-gray-200 rounded-xl p-4 text-center hover:border-blue-400 transition cursor-pointer"
                    onclick="document.getElementById('imageInput').click()">
                    <input type="file" name="image" id="imageInput" accept="image/*" class="hidden"
                        onchange="previewImage(this)">
                    <div id="imagePreview" class="hidden mb-3">
                        <img id="previewImg" class="w-full max-h-40 object-cover rounded-xl">
                    </div>
                    <p class="text-gray-400 text-sm">📁 Click to upload image</p>
                    <p class="text-gray-300 text-xs mt-1">JPG, PNG, GIF up to 2MB</p>
                </div>
            </div>

            <!-- GPS Location -->
            <div>
                <label class="block text-xs font-semibold text-gray-500 uppercase mb-1.5">
                    🛰️ GPS Location
                </label>
                <div class="flex gap-2 items-center">
                    <button type="button" onclick="getLocation()"
                        id="gpsBtn"
                        class="bg-blue-600 text-white px-4 py-2.5 rounded-xl text-sm font-semibold hover:bg-blue-700 transition flex items-center gap-2">
                        📍 Fetch My Location
                    </button>
                    <div id="gpsStatus" class="text-xs text-gray-400"></div>
                </div>
                <div class="grid grid-cols-2 gap-2 mt-2">
                    <input type="text" id="latitude" name="latitude"
                        placeholder="Latitude"
                        readonly
                        class="border border-gray-200 rounded-xl px-3 py-2 text-xs bg-gray-50 text-gray-500">
                    <input type="text" id="longitude" name="longitude"
                        placeholder="Longitude"
                        readonly
                        class="border border-gray-200 rounded-xl px-3 py-2 text-xs bg-gray-50 text-gray-500">
                </div>
            </div>

            <!-- Submit -->
            <div class="flex gap-3 pt-2">
                <button type="submit"
                    class="flex-1 bg-blue-600 text-white py-3 rounded-xl text-sm font-semibold hover:bg-blue-700 transition">
                    🚀 Submit Complaint
                </button>
                <a href="{{ route('complaints.index') }}"
                    class="flex-1 bg-gray-100 text-gray-600 py-3 rounded-xl text-sm font-semibold hover:bg-gray-200 transition text-center">
                    Cancel
                </a>
            </div>

        </form>
    </div>
</div>

<script>
function getLocation() {
    const btn = document.getElementById('gpsBtn');
    const status = document.getElementById('gpsStatus');
    btn.innerHTML = '⏳ Fetching...';
    btn.disabled = true;

    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(
            function(position) {
                document.getElementById('latitude').value  = position.coords.latitude;
                document.getElementById('longitude').value = position.coords.longitude;
                btn.innerHTML = '✅ Location Fetched!';
                btn.classList.remove('bg-blue-600','hover:bg-blue-700');
                btn.classList.add('bg-green-600');
                status.innerHTML = '📍 ' + position.coords.latitude.toFixed(4) + ', ' + position.coords.longitude.toFixed(4);
            },
            function(error) {
                btn.innerHTML = '📍 Fetch My Location';
                btn.disabled = false;
                status.innerHTML = '❌ ' + error.message;
            }
        );
    } else {
        btn.innerHTML = '📍 Fetch My Location';
        btn.disabled = false;
        status.innerHTML = '❌ Geolocation not supported';
    }
}

function previewImage(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('previewImg').src = e.target.result;
            document.getElementById('imagePreview').classList.remove('hidden');
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>

@endsection