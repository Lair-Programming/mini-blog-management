<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PublicPostController;
use Illuminate\Support\Facades\Route;

// Home page (/) sends visitors to the public blog.
Route::get('/', function () {
    return redirect()->route('blog.index');
});

// Public side: anyone can read published posts.
Route::get('/blog', [PublicPostController::class, 'index'])->name('blog.index');
Route::get('/blog/{post}', [PublicPostController::class, 'show'])->name('blog.show');

// Login page and form. The "guest" middleware sends people who are already logged in away from them.
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
});

// Admin side: only logged-in users can reach these routes.
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::resource('posts', PostController::class);
});
