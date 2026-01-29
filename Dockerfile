FROM composer:lts as deps
WORKDIR /app 
RUN --mount=type=bind,source=composer.json,target=composer.json \
    --mount=type=bind,source=composer.lock,target=composer.lock \
    --mount=type=cache,target=/tmp/cache \
    composer install --no-dev --no-interaction

FROM php:8.3.11
WORKDIR /app
COPY . /app
RUN apt-get update && apt-get install -y libonig-dev libzip-dev libpng-dev default-mysql-client \
    && docker-php-ext-install pdo pdo_mysql
