FROM php:8.1-fpm as php


RUN usermod -u 1000 www-data

RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    nginx

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_mysql bcmath mbstring gd exif pcntl
RUN pecl install mongodb \
  && echo "extension=mongodb.so" >>  $PHP_INI_DIR/conf.d/mongodb.ini

WORKDIR /var/www

COPY --chown=www-data:www-data . .

COPY ./docker/php/php.ini /usr/local/etc/php/php.ini
COPY ./docker/php/php-fpm.conf /usr/local/etc/php-fpm.d/www.conf
COPY ./docker/nginx/nginx.conf /etc/nginx/nginx.conf

COPY --from=composer:2.3.5 /usr/bin/composer /usr/bin/composer

RUN chmod -R 755 /var/www/storage && chmod -R 755 /var/www/bootstrap

ENV PORT=8080

ENTRYPOINT [ "docker/entrypoint.sh" ]
RUN ["chmod", "+x", "/var/www/docker/entrypoint.sh"]

#=======================================================================#
#node
FROM node:16-alpine as node

WORKDIR /var/www
COPY . .

RUN npm install --global cross-env
Run npm install

VOLUME /var/www/node_modules
