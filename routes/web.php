<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommentController;

/*Route::get('/', function () {
    return view('home');
})->name('home');*/
use App\Http\Controllers\PostController;

Route::get('/', [PostController::class, 'mostrarPosts'])->name('home');

Route::get('/posts/create-post', function () {
    return view('posts.crear-post');
});

Route::middleware(['guest'])->group(function () {
    Route::get('/login', function () {
        return view('auth.login');
    })->name('showLogin');

    Route::get('/register', function () {
        return view('auth.register');
    })->name('showRegister');
});




Route::prefix('users')->group(base_path('routes/users/users.php'));
Route::prefix('posts')->group(base_path('routes/posts/posts.php'));
Route::prefix('comments')->group(base_path('routes/comments/comments.php'));



