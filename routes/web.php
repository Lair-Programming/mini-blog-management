<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\PublicPostController;
use Illuminate\Support\Facades\Route;

// Home page (/) sends visitors to the public blog.
Route::get('/', function () {
    return redirect()->route('blog.index');
});

// Public side: readers see published posts only.
Route::get('/blog', [PublicPostController::class, 'index'])->name('blog.index');
Route::get('/blog/{post}', [PublicPostController::class, 'show'])->name('blog.show');

// Admin side: full CRUD for posts (no login yet).
Route::resource('posts', PostController::class);
