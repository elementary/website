FROM php:7.4-fpm

RUN curl -sL https://deb.nodesource.com/setup_16.x | bash -

RUN apt-get update && apt-get upgrade -y && apt-get install -y git libicu-dev nodejs nginx

RUN docker-php-ext-configure intl && docker-php-ext-install intl \
    && docker-php-ext-install opcache

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN { \
        echo 'opcache.memory_consumption=128'; \
        echo 'opcache.interned_strings_buffer=8'; \
        echo 'opcache.max_accelerated_files=4000'; \
        echo 'opcache.revalidate_freq=2'; \
        echo 'opcache.fast_shutdown=1'; \
        echo 'opcache.enable_cli=1'; \
    } > /usr/local/etc/php/conf.d/php-opocache-cfg.ini

COPY ./dev/nginx.conf /etc/nginx/sites-enabled/default

WORKDIR /var/www/website

EXPOSE 80 443

ENTRYPOINT ["./dev/entrypoint.sh"]
