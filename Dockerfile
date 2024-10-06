FROM php:8.2-cli

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libpq-dev \
	nodejs \
    npm \
    && docker-php-ext-install pdo pdo_pgsql \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . .

EXPOSE 8000

CMD composer install --no-scripts --no-interaction --optimize-autoloader \
	&& npm install && npm run dev && chmod -R 775 public/build \
    && php bin/console doctrine:database:create --env=test || true \
    && php bin/console doctrine:migrations:migrate --env=test --no-interaction \
    && php bin/console doctrine:migrations:migrate --no-interaction \
    && php -S 0.0.0.0:8000 -t public