@extends('layouts.app')

@section('title', $post->title)

@section('content')

    <h1 class="page-title h3 mb-4">View Post</h1>

    <div class="card shadow-sm">
        <div class="card-body">

            {{-- Title and status --}}
            <div class="d-flex flex-wrap justify-content-between align-items-start gap-2 mb-3">
                <h2 class="h4 mb-0">{{ $post->title }}</h2>
                @if ($post->status === 'published')
                    <span class="badge bg-success">Published</span>
                @else
                    <span class="badge bg-secondary">Draft</span>
                @endif
            </div>

            {{-- Creation date --}}
            <p class="text-muted small mb-4">
                <i class="bi bi-calendar3 me-1"></i>
                Created on {{ $post->created_at->format('F d, Y \a\t h:i A') }}
            </p>

            {{-- Full content. nl2br keeps the line breaks the user typed, and e() escapes any HTML for safety. --}}
            <div class="mb-4">
                {!! nl2br(e($post->content)) !!}
            </div>

            <hr>

            {{-- Back button, plus quick link to edit. --}}
            <a href="{{ route('posts.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left me-1"></i>Back
            </a>
            <a href="{{ route('posts.edit', $post) }}" class="btn btn-primary">
                <i class="bi bi-pencil me-1"></i>Edit
            </a>
        </div>
    </div>

@endsection
