<x-guest-layout>
    <div class="mb-8 text-center">
        <div class="w-20 h-20 bg-blue-100 rounded-full flex items-center justify-center text-4xl mx-auto mb-4">
            📧
        </div>
        <h2 class="text-2xl font-bold text-gray-800">Verify Your Email</h2>
        <p class="text-gray-400 text-sm mt-2">
            We've sent a verification link to your email address. Please check your inbox!
        </p>
    </div>

    @if(session('status') == 'verification-link-sent')
    <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl text-sm mb-4 text-center">
        ✅ A new verification link has been sent to your email!
    </div>
    @endif

    <div class="bg-blue-50 border border-blue-100 rounded-xl p-4 mb-6">
        <p class="text-sm text-blue-700 text-center">
            📬 Didn't receive the email? Check your spam folder or click below to resend.
        </p>
    </div>

    <div class="space-y-3">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit"
                class="w-full bg-blue-600 text-white py-3 rounded-xl text-sm font-semibold hover:bg-blue-700 transition">
                📨 Resend Verification Email
            </button>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                class="w-full bg-gray-100 text-gray-600 py-3 rounded-xl text-sm font-semibold hover:bg-gray-200 transition">
                🚪 Log Out
            </button>
        </form>
    </div>
</x-guest-layout>