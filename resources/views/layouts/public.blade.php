<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Blog') | Mini Blog</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        body { background-color: #ffffff; }
        .navbar-navy { background-color: #0b1f4d; }
        .page-title { color: #0b1f4d; font-weight: 700; }
        .post-card { transition: box-shadow 0.15s ease; }
        .post-card:hover { box-shadow: 0 0.5rem 1rem rgba(11, 31, 77, 0.15); }
        .btn-primary {
            --bs-btn-bg: #1d4ed8;
            --bs-btn-border-color: #1d4ed8;
            --bs-btn-hover-bg: #1e40af;
            --bs-btn-hover-border-color: #1e40af;
        }
        .btn-outline-primary {
            --bs-btn-color: #1d4ed8;
            --bs-btn-border-color: #1d4ed8;
            --bs-btn-hover-bg: #1d4ed8;
            --bs-btn-hover-border-color: #1d4ed8;
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">

    {{-- Public navigation: Blog link, plus a small link to the admin area. --}}
    <nav class="navbar navbar-expand-md navbar-dark navbar-navy">
        <div class="container">
            <a class="navbar-brand fw-semibold" href="{{ route('blog.index') }}">
                <i class="bi bi-journal-text me-2"></i>Mini Blog
            </a>
            <button class="navbar-toggler" type="button"
                    data-bs-toggle="collapse" data-bs-target="#publicMenu"
                    aria-controls="publicMenu" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="publicMenu">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('blog.index') }}">Blog</a>
                    </li>
                </ul>
                <a class="btn btn-outline-light btn-sm" href="{{ route('posts.index') }}">
                    <i class="bi bi-gear me-1"></i>Admin
                </a>
            </div>
        </div>
    </nav>

    <main class="container py-4 flex-grow-1">
        @yield('content')
    </main>

    <footer class="border-top py-3 text-center text-muted small">
        Mini Blog Management System
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
