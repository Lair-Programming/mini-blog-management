<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    // Show all posts in a table (Read).
    public function index()
    {
        $posts = Post::latest()->get();   // newest posts first
        $totalPosts = $posts->count();    // used for the dashboard counter

        return view('posts.index', compact('posts', 'totalPosts'));
    }

    // Show the empty form for a new post.
    public function create()
    {
        return view('posts.create');
    }

    // Validate and save a new post (Create).
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title'   => 'required|string|max:255',
            'content' => 'required|string',
            'status'  => 'required|in:draft,published',
        ]);

        Post::create($validatedData);

        return redirect()->route('posts.index')
            ->with('success', 'Post created successfully.');
    }

    // Show one full post.
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    // Show the form filled with an existing post.
    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    // Validate and save changes to an existing post (Update).
    public function update(Request $request, Post $post)
    {
        $validatedData = $request->validate([
            'title'   => 'required|string|max:255',
            'content' => 'required|string',
            'status'  => 'required|in:draft,published',
        ]);

        $post->update($validatedData);

        return redirect()->route('posts.index')
            ->with('success', 'Post updated successfully.');
    }

    // Delete a post.
    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('posts.index')
            ->with('success', 'Post deleted successfully.');
    }
}