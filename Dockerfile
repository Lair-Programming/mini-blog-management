FROM php:8.3-fpm-bookworm

# Tools Composer needs, plus the PHP extensions Laravel needs to talk to MySQL.
RUN apt-get update && apt-get install -y --no-install-recommends \
        git unzip libzip-dev \
    && docker-php-ext-install pdo_mysql zip \
    && rm -rf /var/lib/apt/lists/*

# Copy the Composer program from its official image.
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Copy the project in (the .dockerignore file lists what is left out).
COPY . .

# Install PHP packages for production, without development tools.
RUN composer install --no-dev --optimize-autoloader --no-interaction --no-scripts

# Rebuild Laravel's package list inside the image, so it matches what is installed here.
RUN php artisan package:discover --ansi

# Laravel must be able to write logs, cache, and sessions.
RUN chown -R www-data:www-data storage bootstrap/cache
