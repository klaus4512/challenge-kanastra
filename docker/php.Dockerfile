FROM php:8.3-fpm-alpine

ADD ./docker/php/www.conf /usr/local/etc/php-fpm.d/www.conf
COPY ./docker/php/uploads.ini /usr/local/etc/php/conf.d/uploads.ini

RUN addgroup -g 1000 laravel && adduser -G laravel -g laravel -s /bin/sh -D laravel

RUN mkdir -p /var/www/html

ADD ./ /var/www/html

RUN docker-php-ext-install pdo pdo_mysql

RUN chown -R laravel:laravel /var/www/html
