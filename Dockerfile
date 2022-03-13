FROM node:16.14.0 as builder_node

COPY --chown=www-data:www-data ./ /app/

WORKDIR /app

RUN npm install && npm run build

FROM php:7.4-cli as builder_php

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer
COPY --chown=www-data:www-data ./ /app/

RUN apt-get update \
  && apt-get install -y git

WORKDIR /app

RUN composer install --no-dev

FROM wordpress:5.9

RUN apt-get update \
  && apt-get install -y less \
  && curl https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar \
    --output /usr/local/bin/wp \
  && chmod +x /usr/local/bin/wp

COPY --chown=www-data:www-data ./docker-setup-wordpress.sh /app/
COPY --chown=www-data:www-data ./ /var/www/html/wp-content/plugins/apnic-foundation-news/
COPY --chown=www-data:www-data ./src/theme/ /var/www/html/wp-content/themes/apnic-foundation-news/
COPY --from=builder_php --chown=www-data:www-data /app/vendor/ /var/www/html/wp-content/plugins/apnic-foundation-news/vendor/
COPY --from=builder_node --chown=www-data:www-data /app/build/ /var/www/html/wp-content/plugins/apnic-foundation-news/build/

RUN chmod +x /app/docker-setup-wordpress.sh
