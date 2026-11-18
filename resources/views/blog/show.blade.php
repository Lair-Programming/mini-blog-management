@extends('layouts.public')

@section('title', $post->title)

@section('content')

    <article class="mx-auto" style="max-width: 760px;">
        <h1 class="page-title h2 mb-2">{{ $post->title }}</h1>

        <p class="text-muted small mb-4">
            <i class="bi bi-calendar3 me-1"></i>
            Published on {{ $post->created_at->format('F d, Y') }}
        </p>

        {{-- e() escapes any HTML for safety, and nl2br keeps the line breaks the author typed. --}}
        <div class="mb-4 fs-5">
            {!! nl2br(e($post->content)) !!}
        </div>

        <hr>

        <a href="{{ route('blog.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left me-1"></i>Back to Blog
        </a>
    </article>

@endsection
