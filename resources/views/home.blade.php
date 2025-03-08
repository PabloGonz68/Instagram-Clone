<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instagram Clone</title>
    @vite(['resources/css/app.css'])
</head>

<body class="bg-gray-100">
    @include('partials.header')

    <main class="max-w-7xl mx-auto py-8">
        <h1 class="text-3xl font-bold text-center mb-8">Bienvenido al Home</h1>

        @auth
            <div class="mb-8 text-center">
                <a href="{{ route('posts.showForm') }}" class="bg-blue-500 text-white p-2 rounded hover:bg-blue-600">Crear
                    Publicación</a>
            </div>
        @else
            <section
                class="flex flex-col items-center justify-center bg-white py-6 rounded-lg shadow-lg w-1/2 mx-auto mb-8">
                <p class="text-gray-500">Debes iniciar sesión para crear una publicación.</p>
                <div class="flex justify-center gap-4 mt-4">
                    <a href="{{ route('showLogin') }}"
                        class="bg-blue-500 text-white p-2 rounded hover:bg-blue-600 transition-transform hover:scale-105">
                        Iniciar Sesión
                    </a>
                    <a href="{{ route('showRegister') }}"
                        class="bg-blue-500 text-white p-2 rounded hover:bg-blue-600 transition-transform hover:scale-105">
                        Registrarse
                    </a>
                </div>
            </section>
        @endauth

        <!-- Mostrar todos los posts -->
        <div class="space-y-8">
            @if($posts->isEmpty())
                <p class="text-center text-gray-500">No hay publicaciones disponibles.</p>
            @else
                @foreach ($posts as $post)
                    <a href="{{ route('posts.showPost', $post->id) }}">
                        <div class="bg-white px-6 py-4 rounded-lg shadow-lg max-w-lg mx-auto">
                            <div class="flex items-center mb-4 gap-2">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($post->user->name) }}&background=random"
                                    alt="Foto de {{$post->user->name }}"
                                    class="w-12 h-12 rounded-full object-cover border-4 border-gray-300">
                                <h2 class="text-sm font-semibold">{{ $post->user->name }}</h2>
                                <span class="text-sm text-gray-600">{{ $post->created_at->diffForHumans() }}</span>
                            </div>
                            <!-- Imagen del post con tamaño ajustado -->
                            <div class="flex justify-center mb-4">
                                <img src="{{ asset('storage/' . $post->image_path) }}" alt="Imagen de la publicación"
                                    class="w-full h-96 object-cover rounded-lg">
                            </div>

                            <div class="px-4">
                                <form action="{{ route('posts.likePost', $post->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="focus:outline-none">
                                        <div class="relative w-8 h-8 group">
                                            <!-- Imagen del corazón vacío -->
                                            <img src="{{ asset('corazon-empty.png') }}" alt="Me gusta"
                                                class="absolute inset-0 w-8 h-8 transition-opacity duration-300 opacity-100 group-hover:opacity-0">
                                            <!-- Imagen del corazón lleno -->
                                            <img src="{{ asset('corazon-filled.png') }}" alt="Me gusta relleno"
                                                class="absolute inset-0 w-8 h-8 transition-opacity duration-300 opacity-0 group-hover:opacity-100">
                                        </div>
                                    </button>
                                </form>

                                <p class="text-sm font-semibold">{{ $post->n_likes }} Me gusta</p>
                                <h2 class="text-xl font-semibold text-gray-800">{{ $post->title }}</h2>
                                <div class=" mt-2 flex gap-2">
                                    <p class="text-sm font-semibold">{{ $post->user->name }}</p>
                                    <p class="text-sm text-gray-600">{{ $post->description }}</p>
                                </div>


                                <div class="flex justify-start items-center mt-4">
                                    <a href="{{ route('posts.showPost', $post->id) }}"
                                        class="text-sm text-gray-500 hover:underline">
                                        Ver los {{ $post->comments->count() }} comentarios
                                    </a>

                                </div>

                                <!-- Opciones de interacción (Ver comentarios y eliminar si es el autor) -->
                                <div class="mt-4 flex justify-between items-center">


                                    @if ($post->belongs_to == auth()->id())
                                        <form action="{{ route('posts.deletePost', $post->id) }}" method="POST"
                                            onsubmit="return confirm('¿Seguro que deseas eliminar este post?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:underline">Eliminar</button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            @endif
        </div>
    </main>
</body>

</html>