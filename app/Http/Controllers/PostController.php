<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function mostrarPosts()
    {
        $posts = Post::with('user', 'comments')->latest()->get();
        return view('home', compact('posts'));
    }

    public function mostrarPost($id)
    {
        $post = Post::with('user', 'comments')->find($id);
        return view('posts.post', compact('post'));

    }

    public function crearPost(Request $request)
    {
        // Validar la entrada antes de crear el post
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = $image->store('posts', ['disk' => 'public']);
        }

        // Crear el post con la imagen guardada correctamente
        Post::create([
            'title' => $request->title,
            'description' => $request->description,
            'belongs_to' => Auth::id(),
            'publish_date' => Carbon::now(),
            'image_path' => $imagePath, // Aquí se envía la imagen correctamente
            'n_likes' => 0
        ]);

        return redirect()->route('home')->with('success', 'Publicación creada correctamente.');
    }

    public function likePost($id)
    {
        $post = Post::findOrFail($id);
        $post->n_likes = $post->n_likes + 1;
        $post->save();
        return redirect()->route('home');
    }

    public function eliminarPost($id)
    {
        $post = Post::findOrFail($id);
        if ($post->belongs_to == Auth::id()) {
            $post->delete();
            return redirect()->route('home')->with('success', 'Publicación eliminada correctamente.');
        }

        return redirect()->route('home')->with('error', 'No tienes permiso para eliminar esta publicación.');
    }
}
