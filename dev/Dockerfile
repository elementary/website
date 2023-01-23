FROM php:7.4-fpm-alpine3.16

RUN apk add --no-cache build-base python3 py3-pip libjpeg-turbo libjpeg-turbo-dev libpng libpng-dev automake \
    curl-dev oniguruma-dev icu-dev openssl shadow bash git nodejs npm sqlite jpeg musl-dev zlib-dev file gifsicle \
    autoconf automake libtool pkgconf nasm

RUN docker-php-ext-configure intl && docker-php-ext-install intl

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN usermod -u 1000 www-data

WORKDIR /var/www

USER root

RUN chown -R www-data:www-data /usr/local

USER www-data

EXPOSE 8000

ENTRYPOINT ["./dev/entrypoint.sh"]
