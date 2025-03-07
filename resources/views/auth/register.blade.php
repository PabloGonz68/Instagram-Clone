<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    @vite(['resources/css/app.css'])
</head>

<body class="flex items-center justify-center min-h-screen bg-gray-100">
    <main class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
        <h2 class="text-2xl font-bold text-center text-gray-700 mb-6">Registro</h2>
        <form action="{{ route('user.doRegister') }}" method="POST" class="space-y-4">
            @csrf
            <label class="block">
                <span class="text-gray-700">Nombre</span>
                <input type="text" name="name"
                    class="w-full mt-1 p-2 border rounded-lg focus:outline-none focus:ring focus:ring-blue-300">
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </label>

            <label class="block">
                <span class="text-gray-700">Email</span>
                <input type="email" name="email"
                    class="w-full mt-1 p-2 border rounded-lg focus:outline-none focus:ring focus:ring-blue-300">
                @error('email')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </label>

            <label class="block">
                <span class="text-gray-700">Contraseña</span>
                <input type="password" name="password"
                    class="w-full mt-1 p-2 border rounded-lg focus:outline-none focus:ring focus:ring-blue-300">
                @error('password')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </label>

            <label class="block">
                <span class="text-gray-700">Confirmar Contraseña</span>
                <input type="password" name="password_confirmation"
                    class="w-full mt-1 p-2 border rounded-lg focus:outline-none focus:ring focus:ring-blue-300">
                @error('password_confirmation')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </label>

            <button
                class="w-full bg-blue-500 text-white p-2 rounded-lg hover:bg-blue-600 transition">Registrarse</button>
        </form>
        <div class="mt-6 text-center">
            <p class="text-gray-700">Ya tienes cuenta?
                <a href="{{ route('showLogin') }}" class="text-blue-500 hover:underline">Inicia Sesión</a>
            </p>
        </div>
    </main>
</body>

</html>