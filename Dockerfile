FROM php:8.2-cli

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . .

RUN composer install --optimize-autoloader

EXPOSE 8000

CMD php bin/console doctrine:database:create --env=test || true \
    && php bin/console doctrine:migrations:migrate --env=test --no-interaction \
    && php bin/console doctrine:migrations:migrate --no-interaction \
    && php -S 0.0.0.0:8000 -t public
