<header class="bg-white shadow-md p-4 flex justify-between items-center">
    <a href="{{ route('home') }}">
        <div class="flex items-center">
            <img src="https://upload.wikimedia.org/wikipedia/commons/a/a5/Instagram_icon.png" alt="Instagram Logo"
                class="h-10 w-10 max-w-10 max-h-10">
            <span class="text-xl font-bold ml-2 text-gray-800">Instagram</span>
        </div>
    </a>
    @guest
        <nav class="flex items-center space-x-4">
            <a href="{{ route('showLogin') }}" class="text-gray-700 font-semibold hover:text-blue-500 transition">
                Login
            </a>
            <a href="{{ route('showRegister') }}"
                class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition">
                Register
            </a>
        </nav>
    @endguest


    @auth
        <nav class="flex items-center space-x-4">
            <a href="{{ route('user.showPerfil') }}" class="text-gray-700 font-semibold hover:text-blue-500 transition">
                Perfil
            </a>
            <a href="{{ route('user.doLogout') }}"
                class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition">
                Logout
            </a>
        </nav>
    @endauth
</header>