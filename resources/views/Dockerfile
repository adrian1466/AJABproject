FROM node:22-alpine AS assets

WORKDIR /app

COPY package*.json vite.config.js ./
COPY resources ./resources

RUN npm install && npm run build

FROM php:8.4-fpm

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    curl \
    libzip-dev \
    zip \
    libpng-dev \
    && docker-php-ext-install pdo pdo_mysql zip

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

ENV APP_ENV=production \
    APP_DEBUG=false

COPY . .

COPY --from=assets /app/public/build ./public/build

RUN composer install --no-dev --optimize-autoloader

RUN chmod -R 777 storage bootstrap/cache database

EXPOSE 10000

CMD chmod -R 777 storage bootstrap/cache database && php artisan config:clear && php artisan cache:clear && php artisan migrate --force && php artisan db:seed --force && php artisan serve --host=0.0.0.0 --port=${PORT:-10000}
