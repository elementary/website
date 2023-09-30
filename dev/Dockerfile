FROM composer:2.5 AS composer

FROM php:8.1-fpm

COPY --from=composer /usr/bin/composer /usr/bin/composer

RUN apt-get update \
    && apt-get upgrade -y \
    && apt-get install -y ca-certificates curl gnupg \
    && mkdir -p /etc/apt/keyrings \
    && curl -fsSL https://deb.nodesource.com/gpgkey/nodesource-repo.gpg.key | gpg --dearmor -o /etc/apt/keyrings/nodesource.gpg \
    && echo "deb [signed-by=/etc/apt/keyrings/nodesource.gpg] https://deb.nodesource.com/node_18.x nodistro main" | tee /etc/apt/sources.list.d/nodesource.list > /dev/null \
    && rm -rf /var/lib/apt/lists/*

RUN apt-get update \
    && apt-get install -y git libicu-dev nodejs nginx libpng-dev libzip-dev \ 
    libwebp-dev unzip zip libxml2-dev libjpeg62-turbo-dev zlib1g-dev libfreetype6 libfreetype6-dev \
    && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-configure intl \
    && docker-php-ext-install intl

COPY ./dev/nginx.conf /etc/nginx/sites-enabled/default

WORKDIR /var/www/website

EXPOSE 80 443

ENTRYPOINT ["./dev/entrypoint.sh"]
