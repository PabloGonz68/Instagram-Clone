<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $user->name }} - Perfil</title>
    @vite(['resources/css/app.css'])
</head>

<body class="bg-gray-100">
    @include('partials.header')

    <main class="max-w-4xl mx-auto p-6 bg-white rounded-lg shadow-md mt-10">
        <div class="flex items-center space-x-6">
            <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=random"
                alt="Foto de {{ $user->name }}" class="w-24 h-24 rounded-full object-cover border-4 border-gray-300">

            <div>
                <h1 class="text-2xl font-bold text-gray-900">{{ $user->name }}</h1>
            </div>
        </div>

        <div class="mt-4 text-gray-700">
            <p><strong>Email:</strong> {{ $user->email }}</p>
            <p><strong>Fecha de registro:</strong> {{ $user->created_at->format('d M, Y') }}</p>
        </div>
        @if ($user->id == auth()->id())
            <form action="{{ route('user.deleteUser', $user->id) }}" method="POST"
                onsubmit="return confirm('¿Seguro que deseas eliminar este usuario?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-red-500 hover:underline">Eliminar</button>
            </form>
        @endif

    </main>
</body>

</html>