FROM php:8.2-fpm

RUN apt-get update && apt-get install -y curl git libpq-dev build-essential \
                    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
                    && docker-php-ext-install pdo pdo_pgsql

WORKDIR /var/www/html

ENTRYPOINT [ "php-fpm" ]
