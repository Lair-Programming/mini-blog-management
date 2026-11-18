@extends('layouts.app')

@section('title', 'Create Post')

@section('content')

    <h1 class="page-title h3 mb-4">Create New Post</h1>

    <div class="card shadow-sm">
        <div class="card-body">

            {{-- This form sends the data to the store() method in PostController. --}}
            <form action="{{ route('posts.store') }}" method="POST">
                @csrf

                {{-- Title --}}
                <div class="mb-3">
                    <label for="title" class="form-label fw-semibold">Title</label>
                    <input type="text" name="title" id="title"
                           class="form-control @error('title') is-invalid @enderror"
                           value="{{ old('title') }}">
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Content --}}
                <div class="mb-3">
                    <label for="content" class="form-label fw-semibold">Content</label>
                    <textarea name="content" id="content" rows="6"
                              class="form-control @error('content') is-invalid @enderror">{{ old('content') }}</textarea>
                    @error('content')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Status --}}
                <div class="mb-4">
                    <label for="status" class="form-label fw-semibold">Status</label>
                    <select name="status" id="status"
                            class="form-select @error('status') is-invalid @enderror">
                        <option value="draft" {{ old('status', 'draft') === 'draft' ? 'selected' : '' }}>Draft</option>
                        <option value="published" {{ old('status') === 'published' ? 'selected' : '' }}>Published</option>
                    </select>
                    @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-check-lg me-1"></i>Save Post
                </button>
                <a href="{{ route('posts.index') }}" class="btn btn-outline-secondary">Cancel</a>
            </form>

        </div>
    </div>

@endsection
