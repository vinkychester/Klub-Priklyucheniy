ARG PHP_VERSION=8.2.16

FROM php:${PHP_VERSION}-fpm-alpine3.19

#Composer for Production
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN apk update && apk add --no-cache --update $PHPIZE_DEPS \
    git \
    bash \
    zip \
    curl

# PHP extensions
RUN docker-php-ext-install opcache
RUN docker-php-ext-enable opcache

WORKDIR /srv/klub-priklyucheniy

COPY . .