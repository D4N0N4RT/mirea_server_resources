FROM composer:latest AS composer
FROM php:8.0-apache
WORKDIR /var/www/html
COPY --from=composer /usr/bin/composer /usr/local/bin/composer
ENV COMPOSER_ALLOW_SUPERUSER=1
COPY ports.conf /etc/apache2/ports.conf
COPY 000-default.conf /etc/apache2/sites-available/000-default.conf

RUN chmod 777 /var/www/html

RUN apt-get update && \
    pecl install -o -f redis && \
    rm -rf /tmp/pear && \
    docker-php-ext-enable redis && \
    docker-php-ext-install mysqli
#Ватермарка
RUN apt-get update && \
    apt-get install -y libfreetype6-dev libjpeg62-turbo-dev libpng-dev && \
    docker-php-ext-configure gd --with-freetype=/usr/include/ --with-jpeg=/usr/include/ && \
    docker-php-ext-install gd
COPY src/composer.json ./
RUN composer update && \
   composer install
EXPOSE 8001