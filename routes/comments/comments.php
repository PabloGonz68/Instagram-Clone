<?php

use App\Http\Controllers\CommentController;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {

    Route::post('/post/{id}/comment', [CommentController::class, 'crearComment'])->name('comment.crear');


});