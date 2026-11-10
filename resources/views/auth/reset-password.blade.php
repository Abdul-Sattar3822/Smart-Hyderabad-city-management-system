<x-guest-layout>
    <div class="mb-8">
        <h2 class="text-2xl font-bold text-gray-800">Reset Password 🔐</h2>
        <p class="text-gray-400 text-sm mt-1">Enter your new password below</p>
    </div>

    @if($errors->any())
    <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl text-sm mb-4">
        ❌ {{ $errors->first() }}
    </div>
    @endif

    <form method="POST" action="{{ route('password.store') }}" class="space-y-4">
        @csrf
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email -->
        <div>
            <label class="block text-xs font-semibold text-gray-500 uppercase mb-1.5">📧 Email Address</label>
            <input type="email" name="email"
                value="{{ old('email', $request->email) }}"
                required autofocus
                class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 @error('email') border-red-400 @enderror">
        </div>

        <!-- New Password -->
        <div>
            <label class="block text-xs font-semibold text-gray-500 uppercase mb-1.5">🔐 New Password</label>
            <input type="password" name="password"
                required
                placeholder="Enter new password"
                class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 @error('password') border-red-400 @enderror">
        </div>

        <!-- Confirm Password -->
        <div>
            <label class="block text-xs font-semibold text-gray-500 uppercase mb-1.5">🔐 Confirm Password</label>
            <input type="password" name="password_confirmation"
                required
                placeholder="Re-enter new password"
                class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <!-- Submit -->
        <button type="submit"
            class="w-full bg-blue-600 text-white py-3 rounded-xl text-sm font-semibold hover:bg-blue-700 transition shadow">
            🔄 Reset Password
        </button>

        <p class="text-center text-sm text-gray-500">
            <a href="{{ route('login') }}" class="text-blue-600 font-semibold hover:underline">
                ← Back to Login
            </a>
        </p>

    </form>
</x-guest-layout>