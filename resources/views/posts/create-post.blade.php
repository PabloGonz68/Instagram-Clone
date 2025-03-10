<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Publicación</title>
    @vite(['resources/css/app.css'])
</head>

<body class="bg-gray-100 flex justify-center items-center min-h-screen">

    <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md">
        <h2 class="text-2xl font-bold text-gray-800 text-center mb-4">Crear Publicación</h2>

        <form action="{{ route('posts.createPost') }}" method="POST" class="space-y-4" enctype="multipart/form-data">
            @csrf

            <input type="text" name="title" placeholder="Título" required
                class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">

            <textarea name="description" placeholder="Descripción" required rows="4"
                class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>

            <div class="w-full text-center">
                <label for="image" class="block text-gray-700 font-medium mb-2">Imagen</label>
                <input type="file" name="image" id="image" required
                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-100 focus:outline-none file:bg-blue-500 file:text-white file:px-4 file:py-2 file:rounded-lg file:border-none hover:file:bg-blue-600">
            </div>

            <button type="submit"
                class="w-full bg-blue-500 text-white p-2 rounded-lg font-semibold hover:bg-blue-600 transition-transform hover:scale-105">
                Publicar
            </button>
        </form>
    </div>

</body>

</html>