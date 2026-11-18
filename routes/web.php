<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

// Visiting the home page (/) sends the user to the posts list.
Route::get('/', function () {
    return redirect()->route('posts.index');
});

// One line that creates all seven CRUD routes for posts.
Route::resource('posts', PostController::class);
