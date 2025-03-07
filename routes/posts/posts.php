<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::get('/', [PostController::class, 'mostrarPosts'])->name('home');
    Route::get('/{id}', [PostController::class, 'mostrarPost'])->name('posts.showPost');
    Route::get('/create-post', function () {
        return view('posts.create-post');
    })->name('posts.showForm');
    Route::post('/like-post/{id}', [PostController::class, 'likePost'])->name('posts.likePost');
    Route::post('/posts', [PostController::class, 'crearPost'])->name('posts.createPost');
    Route::delete('/post/{id}', [PostController::class, 'eliminarPost'])->name('posts.deletePost');

});