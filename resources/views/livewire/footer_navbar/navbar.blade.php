<!-- Navbar -->
<div class="shadow-sm bg-white">
    <div class="container mx-auto flex justify-between items-center p-4">
        <!-- Logo -->
        <a href="/" class="text-green-600 font-bold text-xl">DepresQ</a>

        <!-- Menu -->
        <nav class="hidden md:flex space-x-6">
            <a href="{{ route('home') }}" class="hover:text-green-600">Home</a>
            <a href="{{ route('artikel.index') }}" class="hover:text-green-600">Artikel</a>
            <a href="{{ route('diagnosa') }}" class="hover:text-green-600">Diagnosa</a>
            <a href="{{ route('tentang.pakar') }}" class="hover:text-green-600">Tentang</a>
        </nav>

        <!-- Auth Buttons / User Menu -->
        <div class="space-x-2 flex items-center">
            @guest
                <!-- Jika belum login -->
                <a href="{{ route('login') }}" 
                   class="px-3 py-1.5 text-sm border border-green-600 text-green-600 rounded-lg hover:bg-green-50 transition">
                   Sign In
                </a>
                <a href="{{ route('register') }}" 
                   class="px-3 py-1.5 text-sm bg-green-600 text-white rounded-lg hover:bg-green-700 transition">
                   Sign Up
                </a> 
            @endguest

            @auth
                <!-- Jika sudah login -->
                <div class="relative">
                    <button id="userMenuButton" class="flex items-center px-3 py-1.5 text-sm border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-100 transition">
                        Hi, {{ auth()->user()->name }}
                        <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div id="userMenu" class="hidden absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded-lg shadow-lg">
                        <a href="{{ route('profile') }}" class="block px-4 py-2 hover:bg-gray-100">Profile</a>
                        <a href="{{ route('riwayat.diagnosa') }}" class="block px-4 py-2 hover:bg-gray-100">Riwayat Diagnosa</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full text-left px-4 py-2 text-red-600 hover:bg-gray-100">
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            @endauth
        </div>
    </div>
</div>

<script>
    document.getElementById("userMenuButton")?.addEventListener("click", function () {
        document.getElementById("userMenu").classList.toggle("hidden");
    });
</script>
