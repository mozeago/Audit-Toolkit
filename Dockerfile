FROM php:8.1-fpm

WORKDIR /var/www/toolkit

COPY composer.json composer.lock ./
RUN composer install --ignore-platform-reqs

COPY . .

EXPOSE 80

RUN chmod -R 777 storage bootstrap/cache

CMD ["php", "-S", "0.0.0.0:80", "-t", "public"]
