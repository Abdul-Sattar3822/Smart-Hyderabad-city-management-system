<nav class="bg-white border-b border-gray-100 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">

            <!-- Logo -->
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 bg-blue-600 rounded-xl flex items-center justify-center text-white font-bold">
                    🏛️
                </div>
                <div>
                    <p class="font-bold text-gray-800 text-sm">Smart Hyderabad</p>
                    <p class="text-gray-400 text-xs hidden md:block">City Management</p>
                </div>
            </div>

            <!-- Desktop Nav -->
            <div class="hidden md:flex items-center gap-4">
                <a href="{{ route('dashboard') }}"
                    class="text-sm font-medium {{ request()->routeIs('dashboard') ? 'text-blue-600' : 'text-gray-500 hover:text-gray-700' }} transition">
                    🏠 Dashboard
                </a>

                <!-- User Dropdown -->
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open"
                        class="flex items-center gap-2 bg-gray-50 hover:bg-gray-100 px-3 py-2 rounded-xl transition">
                        <img src="{{ auth()->user()->profile_image ? asset('storage/'.auth()->user()->profile_image) : 'https://ui-avatars.com/api/?name='.urlencode(auth()->user()->name).'&background=3b82f6&color=fff' }}"
                            class="w-8 h-8 rounded-lg object-cover">
                        <span class="text-sm font-medium text-gray-700">{{ auth()->user()->name }}</span>
                        <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
                        </svg>
                    </button>

                    <div x-show="open" @click.away="open = false"
                        x-transition
                        class="absolute right-0 mt-2 w-48 bg-white rounded-2xl shadow-lg border border-gray-100 py-2 z-50">
                        <a href="{{ route('profile.edit') }}"
                            class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">
                            👤 Profile
                        </a>
                        <div class="border-t border-gray-100 my-1"></div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="flex items-center gap-2 w-full px-4 py-2 text-sm text-red-500 hover:bg-red-50 text-left">
                                🚪 Log Out
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Mobile Hamburger -->
            <div class="md:hidden" x-data="{ open: false }">
                <button @click="open = !open"
                    class="text-gray-500 hover:text-gray-700 p-2 rounded-xl hover:bg-gray-100">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        <path x-show="open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>

                <!-- Mobile Menu -->
                <div x-show="open" @click.away="open = false"
                    x-transition
                    class="absolute top-16 left-0 right-0 bg-white border-b border-gray-100 shadow-lg z-50 p-4">

                    <div class="flex items-center gap-3 mb-4 pb-4 border-b border-gray-100">
                        <img src="{{ auth()->user()->profile_image ? asset('storage/'.auth()->user()->profile_image) : 'https://ui-avatars.com/api/?name='.urlencode(auth()->user()->name).'&background=3b82f6&color=fff' }}"
                            class="w-12 h-12 rounded-xl object-cover">
                        <div>
                            <p class="font-semibold text-gray-800">{{ auth()->user()->name }}</p>
                            <p class="text-xs text-gray-400">{{ auth()->user()->email }}</p>
                        </div>
                    </div>

                    <div class="space-y-1">
                        <a href="{{ route('dashboard') }}"
                            class="flex items-center gap-2 px-4 py-2.5 rounded-xl text-sm font-medium {{ request()->routeIs('dashboard') ? 'bg-blue-600 text-white' : 'text-gray-700 hover:bg-gray-100' }}">
                            🏠 Dashboard
                        </a>
                        <a href="{{ route('profile.edit') }}"
                            class="flex items-center gap-2 px-4 py-2.5 rounded-xl text-sm font-medium text-gray-700 hover:bg-gray-100">
                            👤 Profile
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="flex items-center gap-2 w-full px-4 py-2.5 rounded-xl text-sm font-medium text-red-500 hover:bg-red-50">
                                🚪 Log Out
                            </button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</nav>