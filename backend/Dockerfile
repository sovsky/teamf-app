FROM php:8.2.0-fpm

# Zainstaluj zależności systemowe
RUN apt-get update && apt-get install -y \
    zip \
    libpq-dev \
    libzip-dev \
    && apt-get clean

# Zainstaluj rozszerzenia PHP
RUN docker-php-ext-install pdo_pgsql pgsql zip

# Zainstaluj Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Ustaw katalog roboczy
WORKDIR /var/www

# Skopiuj resztę aplikacji
COPY . .

# Zainstaluj zależności PHP
RUN composer install --prefer-dist --no-interaction --verbose

# Ustaw odpowiednie uprawnienia do katalogów storage i bootstrap
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# Uruchom PHP-FPM
CMD ["./run.sh"]
