# Current server versions (2026-02-28):
# - PHP: 8.1.2
# - Nginx: 1.18
# - Node: 18.17.1
# - NPM: 9.6.7
# - Composer: 2.2.6
FROM composer:2.5 AS composer
FROM node:18 AS node
FROM php:8.1-fpm

COPY --from=composer /usr/bin/composer /usr/bin/composer
COPY --from=node /usr/local/bin/node /usr/local/bin/node
COPY --from=node /usr/local/lib/node_modules /usr/local/lib/node_modules

RUN ln -sf /usr/local/lib/node_modules/npm/bin/npm-cli.js /usr/local/bin/npm \
    && ln -sf /usr/local/lib/node_modules/npm/bin/npx-cli.js /usr/local/bin/npx

RUN apt-get update \
    && apt-get upgrade -y \
    && apt-get install -y ca-certificates curl git gnupg libicu-dev nginx libpng-dev libzip-dev \
    libwebp-dev unzip zip libxml2-dev libjpeg62-turbo-dev zlib1g-dev libfreetype6 libfreetype6-dev \
    && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-configure intl \
    && docker-php-ext-install intl

COPY ./dev/nginx.conf /etc/nginx/sites-enabled/default

WORKDIR /var/www/website

EXPOSE 80 443

ENTRYPOINT ["./dev/entrypoint.sh"]
