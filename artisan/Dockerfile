FROM php:8.3-cli

WORKDIR /var/www/fast-realtor

RUN apt-get install && apt-get update \
    && docker-php-ext-install pdo_mysql

ENTRYPOINT ["php", "artisan"]
