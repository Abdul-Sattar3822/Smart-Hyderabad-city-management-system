<x-guest-layout>
    <div class="mb-8">
        <h2 class="text-2xl font-bold text-gray-800">Forgot Password? 🔐</h2>
        <p class="text-gray-400 text-sm mt-1">No worries! Enter your email and we'll send you a reset link.</p>
    </div>

    <!-- Status -->
    @if(session('status'))
    <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl text-sm mb-4 flex items-center gap-2">
        ✅ {{ session('status') }}
    </div>
    @endif

    @if($errors->any())
    <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl text-sm mb-4">
        ❌ {{ $errors->first() }}
    </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
        @csrf

        <!-- Email -->
        <div>
            <label class="block text-xs font-semibold text-gray-500 uppercase mb-1.5">
                📧 Email Address
            </label>
            <input type="email" name="email"
                value="{{ old('email') }}"
                required autofocus
                placeholder="your@email.com"
                class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 @error('email') border-red-400 @enderror">
        </div>

        <!-- Info Box -->
        <div class="bg-blue-50 border border-blue-100 rounded-xl p-3">
            <p class="text-xs text-blue-600">
                📬 We'll send a password reset link to your registered email address.
            </p>
        </div>

        <!-- Submit -->
        <button type="submit"
            class="w-full bg-blue-600 text-white py-3 rounded-xl text-sm font-semibold hover:bg-blue-700 transition shadow">
            📨 Send Reset Link
        </button>

        <!-- Back to Login -->
        <p class="text-center text-sm text-gray-500">
            Remember your password?
            <a href="{{ route('login') }}" class="text-blue-600 font-semibold hover:underline">
                Back to Login
            </a>
        </p>

    </form>
</x-guest-layout>