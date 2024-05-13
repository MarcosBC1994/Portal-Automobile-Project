<nav class="bg-gray-800 h-full fixed w-64 top-0 left-0 flex flex-col md:w-56 lg:w-64 transition-all duration-300 ease-in-out">
    <div class="px-4 py-8 border-b border-gray-700 flex items-center">
        <div class="w-16 h-15 bg-white rounded-full flex-shrink-0 mr-2">
            <img src="{{ asset('images/App-logo.png') }}" alt="Logo" class="w-full h-full object-cover rounded-full">
        </div>
        <a href="#" class="text-white text-xl font-bold">InnoDrive</a>
    </div>

    <!-- Menu Links -->
    <div class="overflow-y-auto flex-1">
        <ul class="py-4">
            <li>
                <a href="/home" class="block text-white py-2 px-4 hover:bg-gray-700 transition-colors duration-200">Home</a>
            </li>
            <!-- Add more menu links here -->
        </ul>
    </div>

    <div class="mt-auto">
        @guest
            <div class="px-4 py-3 border-t border-gray-700">
                <a href="{{ route('login') }}" class="auth-link block text-white py-2 px-4 hover:bg-gray-700 transition-colors duration-200">Login</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="auth-link block text-white py-2 px-4 hover:bg-gray-700 transition-colors duration-200">Register</a>
                @endif
            </div>
        @else
            <div class="relative px-4 py-3 border-t border-gray-700">
                <div class="flex items-center">
                    <span class="text-white">{{ Auth::user()->name }}</span>
                    <button id="user-menu-btn" class="user-menu-btn ml-auto focus:outline-none">
                        <svg class="h-5 w-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM2 10a8 8 0 1116 0 8 8 0 01-16 0z" clip-rule="evenodd"></path>
                            <path fill-rule="evenodd" d="M5 9a1 1 0 011-1h8a1 1 0 010 2H6a1 1 0 01-1-1zm3-4a1 1 0 011-1h2a1 1 0 110 2H9a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
                <!-- Dropdown menu -->
                <div id="user-dropdown" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg hidden bottom-12">
                    <div class="py-1">
                        <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();" class="block px-4 py-2 text-gray-800 hover:bg-gray-300 transition-colors duration-200">Logout</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        @endguest
    </div>
</nav>

<script>
    document.getElementById('user-menu-btn').addEventListener('click', function() {
        document.getElementById('user-dropdown').classList.toggle('hidden');
    });
</script>
