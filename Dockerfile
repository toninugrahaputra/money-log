FROM dunglas/frankenphp:1-php8.3-alpine

# Install system dependencies
RUN apk add --no-cache \
    bash \
    icu-dev \
    libpq-dev \
    libzip-dev \
    zip \
    unzip \
    git

# Install PHP extensions
RUN docker-php-ext-install \
    bcmath \
    intl \
    pdo_pgsql \
    zip

# Enable opcache
RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"

# Set working directory
WORKDIR /app

# Copy application code
COPY . .

# Install composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Set permissions
RUN chown -R www-data:www-data storage bootstrap/cache

# Environment variables
ENV APP_ENV=production
ENV APP_DEBUG=false
ENV PORT=8080
ENV FRANKENPHP_CONFIG="worker /app/public/index.php"

# Expose port
EXPOSE 8080

# Multi-stage startup (Migration + Start)
CMD php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=8080
