# basic stuff
FROM php:8.2-apache
RUN a2enmod rewrite
RUN docker-php-ext-install mysqli opcache

# apt installs
RUN apt update
RUN apt install unzip

# composer install
COPY --from=composer/composer:latest-bin /composer /usr/bin/composer
COPY ./composer.json /var/www/composer.json
WORKDIR /var/www/
RUN composer update

# copy source files
COPY . /var/www/html
WORKDIR /var/www/html