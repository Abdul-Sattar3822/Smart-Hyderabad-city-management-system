<x-guest-layout>
    <div class="mb-8">
        <h2 class="text-2xl font-bold text-gray-800">Create Account 🎉</h2>
        <p class="text-gray-400 text-sm mt-1">Join Smart Hyderabad City as a citizen</p>
    </div>

    @if($errors->any())
    <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl text-sm mb-4">
        ❌ {{ $errors->first() }}
    </div>
    @endif

    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        <!-- Name -->
        <div>
            <label class="block text-xs font-semibold text-gray-500 uppercase mb-1.5">👤 Full Name</label>
            <input type="text" name="name"
                value="{{ old('name') }}"
                required autofocus
                placeholder="Enter your full name"
                class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 @error('name') border-red-400 @enderror">
        </div>

        <!-- Email -->
        <div>
            <label class="block text-xs font-semibold text-gray-500 uppercase mb-1.5">📧 Email Address</label>
            <input type="email" name="email"
                value="{{ old('email') }}"
                required
                placeholder="your@email.com"
                class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 @error('email') border-red-400 @enderror">
        </div>

        <!-- Phone -->
        <div>
            <label class="block text-xs font-semibold text-gray-500 uppercase mb-1.5">📞 Phone Number</label>
            <input type="text" name="phone"
                value="{{ old('phone') }}"
                required
                placeholder="03XX-XXXXXXX"
                class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 @error('phone') border-red-400 @enderror">
        </div>

        <!-- Password -->
        <div>
            <label class="block text-xs font-semibold text-gray-500 uppercase mb-1.5">🔐 Password</label>
            <input type="password" name="password"
                required
                placeholder="Min. 8 characters"
                class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 @error('password') border-red-400 @enderror">
        </div>

        <!-- Confirm Password -->
        <div>
            <label class="block text-xs font-semibold text-gray-500 uppercase mb-1.5">🔐 Confirm Password</label>
            <input type="password" name="password_confirmation"
                required
                placeholder="Re-enter password"
                class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <!-- Terms -->
        <div class="bg-gray-50 rounded-xl p-3">
            <p class="text-xs text-gray-400">By registering, you agree to use this platform responsibly as a citizen of Smart Hyderabad City.</p>
        </div>

        <!-- Submit -->
        <button type="submit"
            class="w-full bg-blue-600 text-white py-3 rounded-xl text-sm font-semibold hover:bg-blue-700 transition shadow">
            🚀 Create Account
        </button>

        <!-- Login Link -->
        <p class="text-center text-sm text-gray-500">
            Already have an account?
            <a href="{{ route('login') }}" class="text-blue-600 font-semibold hover:underline">
                Sign in here
            </a>
        </p>

    </form>
</x-guest-layout>