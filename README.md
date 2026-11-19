# Mini Blog Management System

A simple blog management system built with Laravel. Admins manage posts with full CRUD, and visitors read published posts on a public blog. Built to practice Laravel, MySQL, Docker, and AWS deployment.

## Features

**Admin (`/posts`)**
- List all posts with ID, title, content preview, status, and creation date
- Create, view, edit, and delete posts
- Form validation and success messages
- Confirmation dialog before deleting
- Total post count on the dashboard

**Public blog (`/blog`)**
- Card list of published posts only (drafts are hidden)
- Full post page (a draft's address returns a 404)
- Pagination, 6 posts per page

## Tech Stack

- PHP 8.3 and Laravel 13
- MySQL 8.4
- Blade, HTML, CSS, Bootstrap 5, and Bootstrap Icons (loaded from a CDN)
- Nginx, Docker, and Docker Compose
- Git and GitHub

## Project Structure

| Path | Purpose |
|---|---|
| `app/Models/Post.php` | Post model |
| `app/Http/Controllers/PostController.php` | Admin CRUD logic and validation |
| `app/Http/Controllers/PublicPostController.php` | Public blog pages |
| `database/migrations/` | Creates the `posts` table |
| `resources/views/layouts/` | Admin and public page layouts |
| `resources/views/posts/` | Admin views (index, create, edit, show) |
| `resources/views/blog/` | Public views (index, show) |
| `routes/web.php` | Routes |
| `Dockerfile`, `docker-compose.yml`, `docker/nginx/` | Docker setup |

## Run Locally (without Docker)

Requirements: PHP 8.3 (with the `pdo_mysql` extension), Composer, and MySQL 8.4.

1. Clone the repository and open the folder:

   ```bash
   git clone https://github.com/Lair-Programming/mini-blog-management.git
   cd mini-blog-management
   ```

2. Install the PHP packages:

   ```bash
   composer install
   ```

3. Create your settings file and app key:

   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. Create an empty database named `mini_blog` in MySQL, then open `.env` and set `DB_PASSWORD` (and `DB_USERNAME` if you do not use `root`).

5. Create the tables and start the server:

   ```bash
   php artisan migrate
   php artisan serve
   ```

6. Open http://127.0.0.1:8000 for the public blog, or http://127.0.0.1:8000/posts for the admin.

## Run with Docker

Requirements: Docker Desktop (or Docker Engine with the Compose plugin). This starts three containers: PHP, Nginx, and MySQL 8.4.

1. Create your Docker settings file:

   ```bash
   cp .env.docker.example .env.docker
   ```

2. Open `.env.docker` and replace every `change_me`:
   - `APP_KEY`: generate one with `echo "base64:$(openssl rand -base64 32)"`
   - `DB_PASSWORD` and `MYSQL_PASSWORD`: the **same** password
   - `MYSQL_ROOT_PASSWORD`: a different password

3. Build and start the containers:

   ```bash
   docker compose up -d --build
   ```

4. Create the tables in MySQL (wait about 30 seconds after the first start):

   ```bash
   docker compose exec app php artisan migrate --force
   ```

5. Open http://localhost:8080 for the public blog, or http://localhost:8080/posts for the admin.

## Useful Docker Commands

| Command | What it does |
|---|---|
| `docker compose ps` | Show the containers and their status |
| `docker compose logs app --tail 30` | Show recent PHP and Laravel errors |
| `docker compose stop` | Stop the containers (data is kept) |
| `docker compose up -d` | Start them again |
| `docker compose down -v` | Remove the containers **and the database data** |

## Notes

- Real secrets live in `.env` and `.env.docker`, which are ignored by Git. Only the `.example` templates are committed.
- The admin pages have no login yet, so do not expose this app publicly without adding authentication or restricting access.
