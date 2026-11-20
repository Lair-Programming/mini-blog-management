<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Each page can set its own title. If it doesn't, "Blog Management" is used. --}}
    <title>@yield('title', 'Blog Management') | Mini Blog</title>

    {{-- Bootstrap 5 and Bootstrap Icons, loaded from a CDN (no Node.js needed). --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    {{-- Small custom styles for the navy and blue theme. --}}
    <style>
        body {
            background-color: #ffffff;
        }

        .navbar-navy {
            background-color: #0b1f4d;
        }

        .page-title {
            color: #0b1f4d;
            font-weight: 700;
        }

        .table-navy th {
            background-color: #0b1f4d;
            color: #ffffff;
        }

        .btn-primary {
            --bs-btn-bg: #1d4ed8;
            --bs-btn-border-color: #1d4ed8;
            --bs-btn-hover-bg: #1e40af;
            --bs-btn-hover-border-color: #1e40af;
            --bs-btn-active-bg: #1e3a8a;
            --bs-btn-active-border-color: #1e3a8a;
        }
    </style>
</head>
<body>

    {{-- Top navigation bar: collapses into a menu button on small screens. --}}
    <nav class="navbar navbar-expand-md navbar-dark navbar-navy">
        <div class="container">
            <a class="navbar-brand fw-semibold" href="{{ route('posts.index') }}">
                <i class="bi bi-journal-text me-2"></i>Mini Blog
            </a>

            <button class="navbar-toggler" type="button"
                    data-bs-toggle="collapse" data-bs-target="#mainMenu"
                    aria-controls="mainMenu" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="mainMenu">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('posts.index') }}">All Posts</a>
                    </li>
                </ul>
                <form action="{{ route('logout') }}" method="POST" class="d-inline me-2">
                    @csrf
                    <button type="submit" class="btn btn-outline-light">
                        <i class="bi bi-box-arrow-right me-1"></i>Logout
                    </button>
                </form>
                <a class="btn btn-primary" href="{{ route('posts.create') }}">
                    <i class="bi bi-plus-lg me-1"></i>New Post
                </a>
            </div>
        </div>
    </nav>

    {{-- Main area: every page puts its own content here. --}}
    <main class="container py-4">

        {{-- Success message (created, updated, or deleted). It comes from ->with('success', ...) in the controller. --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @yield('content')
    </main>

    {{-- Bootstrap JavaScript, needed for the mobile menu and the dismiss button on alerts. --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
