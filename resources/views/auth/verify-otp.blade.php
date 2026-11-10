<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify OTP — Smart Hyderabad</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-gray-50 flex items-center justify-center p-4">

<div class="w-full max-w-md">

    <!-- Logo -->
    <div class="text-center mb-8">
        <div class="w-16 h-16 bg-blue-600 rounded-2xl flex items-center justify-center text-3xl mx-auto mb-3">
            🏛️
        </div>
        <p class="font-bold text-gray-800 text-lg">Smart Hyderabad City</p>
        <p class="text-gray-400 text-sm">Email Verification</p>
    </div>

    <!-- Card -->
    <div class="bg-white rounded-2xl shadow-lg p-8">

        <div class="text-center mb-6">
            <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center text-3xl mx-auto mb-3">
                🔐
            </div>
            <h2 class="text-xl font-bold text-gray-800">Verify Your Email</h2>
            <p class="text-gray-400 text-sm mt-1">Enter the 6-digit OTP sent to your email</p>
        </div>

        @if(session('error'))
        <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl text-sm mb-4 text-center">
            ❌ {{ session('error') }}
        </div>
        @endif

        @if(session('success'))
        <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl text-sm mb-4 text-center">
            ✅ {{ session('success') }}
        </div>
        @endif

        <form method="POST" action="/verify-otp" class="space-y-4">
            @csrf

            <!-- OTP Input -->
            <div>
                <label class="block text-xs font-semibold text-gray-500 uppercase mb-2 text-center">
                    Enter OTP Code
                </label>
                <input type="text" name="otp"
                    maxlength="6"
                    placeholder="• • • • • •"
                    class="w-full text-center text-2xl font-bold tracking-widest border-2 border-gray-200 rounded-xl px-4 py-4 focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                    oninput="this.value = this.value.replace(/[^0-9]/g, '')">
            </div>

            <!-- Submit -->
            <button type="submit"
                class="w-full bg-blue-600 text-white py-3 rounded-xl text-sm font-semibold hover:bg-blue-700 transition shadow">
                ✅ Verify OTP
            </button>

        </form>

        <!-- Resend -->
        <div class="text-center mt-6">
            <p class="text-sm text-gray-400 mb-2" id="timerText">
                Resend available in <span id="timerCount">30</span>s
            </p>
            <a href="/resend-otp" id="resendBtn"
                class="text-blue-600 font-semibold text-sm hover:underline pointer-events-none opacity-50">
                🔄 Resend OTP
            </a>
        </div>

    </div>

    <!-- Back to Login -->
    <p class="text-center text-sm text-gray-400 mt-4">
        <a href="{{ route('login') }}" class="text-blue-600 hover:underline">
            ← Back to Login
        </a>
    </p>

</div>

<script>
let time = 30;
const timerCount = document.getElementById('timerCount');
const timerText  = document.getElementById('timerText');
const resendBtn  = document.getElementById('resendBtn');

const countdown = setInterval(() => {
    time--;
    timerCount.innerText = time;

    if (time <= 0) {
        clearInterval(countdown);
        timerText.innerText = 'You can resend OTP now';
        resendBtn.classList.remove('pointer-events-none', 'opacity-50');
    }
}, 1000);
</script>

</body>
</html>