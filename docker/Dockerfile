FROM php:8.5-cli AS php-runtime

ARG UID=1000
ARG GID=1000

RUN groupadd -g ${GID} app \
 && useradd -u ${UID} -g app -m app

RUN apt-get update && apt-get install -y \
    git zip unzip curl libzip-dev \
    && docker-php-ext-install zip \
    && pecl install pcov \
    && docker-php-ext-enable pcov \
    && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY .. .

RUN composer install --optimize-autoloader

USER app
