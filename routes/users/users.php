<?php

use App\Http\Controllers\UserController;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::middleware(['guest'])->group(function () {
    Route::get('login', function () {
        return view('auth.login');
    })->name('user.showLogin');

    Route::get('register', function () {
        return view('auth.register');
    })->name('user.showRegister');

    Route::post('login', [UserController::class, 'doLogin'])->name('user.doLogin');
    Route::post('register', [UserController::class, 'doRegister'])->name('user.doRegister');
});

Route::middleware(['auth'])->group(function () {
    Route::get('logout', [UserController::class, 'doLogout'])->name('user.doLogout');
    Route::get('/profile', function () {
        $user = Auth::user();
        return view('user.perfil', compact('user'));
    })->name('user.showPerfil');
});