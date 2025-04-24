FROM php:8.3-cli-bookworm

# Instalações básicas
RUN apt-get update && apt-get install -y \
    zip unzip curl git libpq-dev libzip-dev libonig-dev \
    netcat-openbsd \
    && docker-php-ext-install pdo pdo_pgsql zip

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www
