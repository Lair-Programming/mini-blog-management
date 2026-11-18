<?php

namespace App\Http\Controllers;

use App\Models\Post;

class PublicPostController extends Controller
{
    // Public blog list: only published posts, newest first, 6 per page.
    public function index()
    {
        $posts = Post::where('status', 'published')
            ->latest()
            ->paginate(6);

        return view('blog.index', compact('posts'));
    }

    // Public single post page. Drafts return a 404 page, so readers can't see them.
    public function show(Post $post)
    {
        abort_if($post->status !== 'published', 404);

        return view('blog.show', compact('post'));
    }
}
