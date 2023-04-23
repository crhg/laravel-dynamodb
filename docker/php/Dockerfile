FROM php:8.1-cli

RUN apt-get update && apt-get install -y git zip && \
    pecl install xdebug

COPY xdebug.ini /usr/local/etc/php/conf.d/

COPY --from=composer /usr/bin/composer /usr/bin/composer
