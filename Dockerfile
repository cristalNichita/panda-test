FROM php:8.3-fpm
WORKDIR /app

# Устанавливаем зависимости для PHP и Composer
RUN apt-get update && apt-get install -y \
    zip unzip git curl libzip-dev libonig-dev libpng-dev libmcrypt-dev \
    && docker-php-ext-install pdo pdo_mysql

# Устанавливаем Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Копируем файлы проекта
COPY . .

# Устанавливаем зависимости проекта
RUN composer install

# Права на storage и bootstrap/cache
RUN chmod -R 777 storage bootstrap/cache

CMD dockerize -wait tcp://db:3306 -timeout 30s php artisan serve --host=0.0.0.0 --port=8000
