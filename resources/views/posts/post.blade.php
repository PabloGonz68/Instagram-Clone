<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Publicación de {{ $post->user->name }}</title>
    @vite(['resources/css/app.css'])
</head>

<body class="bg-gray-100">

    @include('partials.header')

    <main class="max-w-4xl mx-auto py-8">

        <div class="bg-white rounded-lg shadow-lg p-4">
            <div class="flex gap-6">
                <!-- Imagen del post -->
                <div class="w-[60%] flex justify-center items-center">
                    <img src="{{ asset('storage/' . $post->image_path) }}" alt="Imagen del post"
                        class="w-full h-[35rem] object-cover rounded-lg">
                </div>


                <!-- Sección de detalles -->
                <section class="flex flex-col w-[40%] p-6" classname="detalles">
                    <!-- Info del usuario -->
                    <div class="flex items-center mb-4 gap-2">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($post->user->name) }}&background=random"
                            alt="Foto de {{ $post->user->name }}"
                            class="w-12 h-12 rounded-full object-cover border-4 border-gray-300">
                        <h2 class="text-sm font-semibold">{{ $post->user->name }}</h2>
                    </div>

                    <!-- Detalles del post -->
                    <h2 class="text-2xl font-semibold text-gray-800">{{ $post->title }}</h2>
                    <p class="text-gray-600 mt-2">{{ $post->description }}</p>

                    <!-- Comentarios -->
                    <h3 class="text-xl font-semibold mt-6">Comentarios:</h3>
                    @if ($post->comments->isEmpty())
                        <p class="text-gray-500 mt-2">No hay comentarios aún. Sé el primero en comentar.</p>
                    @else
                        <ul class="mt-4 space-y-4 max-h-60 overflow-y-auto">
                            @foreach ($post->comments as $comment)
                                <li class="bg-gray-50 p-4 rounded-lg shadow-sm break-words">

                                    <div class="w-full">
                                        <div class="flex items-center gap-2">
                                            <img src="https://ui-avatars.com/api/?name={{ urlencode($comment->user->name) }}&background=random"
                                                alt="Foto de {{ $post->user->name }}"
                                                class="w-12 h-12 rounded-full object-cover border-4 border-gray-300">
                                            <p class="text-sm text-gray-500 mt-1">- {{ $comment->user->name }}</p>
                                        </div>
                                        <div class="flex justify-center items-center">
                                            <p class="text-gray-800 whitespace-normal pl-16 break-words w-full">
                                                {{ $comment->comment }}
                                            </p>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @endif

                    <div class="w-full border-t-2 border-gray-300 mt-4 pt-4">
                        <div class="flex gap-2 items-center">
                            <form action="{{ route('posts.likePost', $post->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="focus:outline-none">
                                    <div class="relative w-8 h-8 group">
                                        <img src="{{ asset('corazon-empty.png') }}" alt="Me gusta"
                                            class="absolute inset-0 w-8 h-8 transition-opacity duration-300 opacity-100 group-hover:opacity-0">
                                        <img src="{{ asset('corazon-filled.png') }}" alt="Me gusta relleno"
                                            class="absolute inset-0 w-8 h-8 transition-opacity duration-300 opacity-0 group-hover:opacity-100">
                                    </div>
                                </button>
                            </form>
                            <p class="text-md font-semibold">{{ $post->n_likes }} Me gusta</p>
                        </div>
                        <span class="text-sm text-gray-600">{{ $post->created_at->diffForHumans() }}</span>

                        <!-- Formulario de comentarios -->
                        @auth
                            <form class="flex items-center gap-2 mt-4"
                                action="{{ route('comment.crear', ['id' => $post->id]) }}" method="POST">
                                @csrf
                                <textarea name="comment" required
                                    class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 resize-none"
                                    placeholder="Añade un comentario..."></textarea>
                                <button type="submit"
                                    class="bg-blue-500 text-white font-semibold py-2 px-4 rounded-lg hover:bg-blue-600 transition duration-300">
                                    Comentar
                                </button>
                            </form>
                        @else
                            <p class="text-gray-500 mt-4">Debes <a href="{{ route('showLogin') }}"
                                    class="text-blue-500">iniciar sesión</a> para comentar.</p>
                        @endauth
                    </div>
                </section>
            </div>
        </div>
        <div class="mt-8 text-center">
            <a href="{{ route('posts.showForm') }}" class="bg-blue-500 text-white p-2 rounded hover:bg-blue-600">Crear
                Publicación</a>
        </div>
    </main>


</body>

</html>