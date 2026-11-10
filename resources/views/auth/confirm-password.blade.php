<x-guest-layout>
    <div class="mb-8">
        <h2 class="text-2xl font-bold text-gray-800">Confirm Password 🔒</h2>
        <p class="text-gray-400 text-sm mt-1">This is a secure area. Please confirm your password to continue.</p>
    </div>

    <!-- Info Box -->
    <div class="bg-yellow-50 border border-yellow-100 rounded-xl p-4 mb-6 flex items-start gap-3">
        <span class="text-2xl">⚠️</span>
        <p class="text-sm text-yellow-700">
            For your security, please re-enter your password to access this area.
        </p>
    </div>

    @if($errors->any())
    <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl text-sm mb-4">
        ❌ {{ $errors->first() }}
    </div>
    @endif

    <form method="POST" action="{{ route('password.confirm') }}" class="space-y-4">
        @csrf

        <!-- Password -->
        <div>
            <label class="block text-xs font-semibold text-gray-500 uppercase mb-1.5">
                🔐 Your Password
            </label>
            <input type="password" name="password"
                required
                placeholder="Enter your password"
                class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 @error('password') border-red-400 @enderror">
        </div>

        <!-- Submit -->
        <button type="submit"
            class="w-full bg-blue-600 text-white py-3 rounded-xl text-sm font-semibold hover:bg-blue-700 transition shadow">
            ✅ Confirm & Continue
        </button>

        <!-- Back -->
        <p class="text-center text-sm text-gray-500">
            <a href="{{ route('login') }}" class="text-blue-600 font-semibold hover:underline">
                ← Back to Login
            </a>
        </p>

    </form>
</x-guest-layout>