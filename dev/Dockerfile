FROM composer:2.5 AS composer

FROM php:8.1-fpm

COPY --from=composer /usr/bin/composer /usr/bin/composer

RUN curl -sL https://deb.nodesource.com/setup_18.x | bash -

RUN apt-get update && apt-get upgrade -y && apt-get install -y git libicu-dev nodejs \
    nginx libpng-dev libzip-dev libwebp-dev unzip zip libxml2-dev libjpeg62-turbo-dev zlib1g-dev \
    libfreetype6 libfreetype6-dev

RUN docker-php-ext-configure intl \
    && docker-php-ext-install intl

COPY ./dev/nginx.conf /etc/nginx/sites-enabled/default

WORKDIR /var/www/website

EXPOSE 80 443

ENTRYPOINT ["./dev/entrypoint.sh"]
