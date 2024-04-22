FROM php:8.2-fpm-alpine

WORKDIR /var/www/toolkit

RUN apk add --no-cache openssl zip unzip git

ENV COMPOSER_ALLOW_SUPERUSER=1

COPY composer.json composer.lock ./

COPY ./vendor ./vendor

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN composer install

COPY . .

EXPOSE 80

CMD ["php", "-S", "0.0.0.0:80", "-t", "public"]
