@extends('layouts.app')

@section('title', 'Blog Management')

@section('content')

    {{-- Page heading, total post count, and the Create button. --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
        <div>
            <h1 class="page-title h3 mb-1">Blog Management</h1>
            <span class="badge bg-primary fs-6">Total posts: {{ $totalPosts }}</span>
        </div>
        <a href="{{ route('posts.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg me-1"></i>Create Post
        </a>
    </div>

    {{-- table-responsive lets the table scroll sideways on small phone screens. --}}
    <div class="table-responsive">
        <table class="table table-striped table-hover align-middle">
            <thead class="table-navy">
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Content Preview</th>
                    <th>Status</th>
                    <th>Created</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                {{-- Loop through every post. @forelse also lets us show a message when there are none. --}}
                @forelse ($posts as $post)
                    <tr>
                        <td>{{ $post->id }}</td>
                        <td class="fw-semibold">{{ $post->title }}</td>
                        <td>{{ \Illuminate\Support\Str::limit($post->content, 60) }}</td>
                        <td>
                            @if ($post->status === 'published')
                                <span class="badge bg-success">Published</span>
                            @else
                                <span class="badge bg-secondary">Draft</span>
                            @endif
                        </td>
                        <td>{{ $post->created_at->format('M d, Y') }}</td>
                        <td class="text-end text-nowrap">
                            <a href="{{ route('posts.show', $post) }}" class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-eye"></i> View
                            </a>
                            <a href="{{ route('posts.edit', $post) }}" class="btn btn-sm btn-outline-secondary">
                                <i class="bi bi-pencil"></i> Edit
                            </a>

                            {{-- Delete uses a small form. The browser asks "Are you sure?" before sending it. --}}
                            <form action="{{ route('posts.destroy', $post) }}" method="POST" class="d-inline"
                                  onsubmit="return confirm('Are you sure you want to delete this post?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                    <i class="bi bi-trash"></i> Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted py-4">
                            No posts yet. Click "Create Post" to add your first one.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

@endsection
