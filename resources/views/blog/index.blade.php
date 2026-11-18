@extends('layouts.public')

@section('title', 'Latest Posts')

@section('content')

    <h1 class="page-title h2 mb-4">Latest Posts</h1>

    <div class="row g-4">
        {{-- One card per published post. @forelse also handles the "no posts" case. --}}
        @forelse ($posts as $post)
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card h-100 post-card">
                    <div class="card-body d-flex flex-column">
                        <h2 class="h5 card-title">{{ $post->title }}</h2>
                        <p class="text-muted small mb-2">
                            <i class="bi bi-calendar3 me-1"></i>{{ $post->created_at->format('M d, Y') }}
                        </p>
                        <p class="card-text">{{ \Illuminate\Support\Str::limit($post->content, 140) }}</p>
                        <a href="{{ route('blog.show', $post) }}" class="btn btn-outline-primary btn-sm mt-auto align-self-start">
                            Read more <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <p class="text-center text-muted py-5">No posts have been published yet.</p>
            </div>
        @endforelse
    </div>

    {{-- Page links (only appear when there are more than 6 posts). --}}
    <div class="mt-4 d-flex justify-content-center">
        {{ $posts->links('pagination::bootstrap-5') }}
    </div>

@endsection
