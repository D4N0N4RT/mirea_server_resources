FROM composer:latest AS composer
FROM php:8.0-apache
WORKDIR /var/www/html
COPY --from=composer /usr/bin/composer /usr/local/bin/composer
ENV COMPOSER_ALLOW_SUPERUSER=1ъ
COPY ports.conf /etc/apache2/ports.conf
COPY 000-default.conf /etc/apache2/sites-available/000-default.conf

RUN chmod 777 /var/www/html

RUN apt-get update && \
    pecl install -o -f redis && \
    rm -rf /tmp/pear && \
    docker-php-ext-enable redis && \
    docker-php-ext-install mysqli
#Фикстуры
RUN apt-get install -y zip
RUN composer require --prefer-dist nelmio/alice && \
    composer update
#Ватермарка
RUN apt-get update && \
    apt-get install -y libfreetype6-dev libjpeg62-turbo-dev libpng-dev && \
    docker-php-ext-configure gd --with-freetype=/usr/include/ --with-jpeg=/usr/include/ && \
    docker-php-ext-install gd
COPY src/composer.json ./
RUN composer update && \
   composer install

# ENTRYPOINT ["composer", "install"]
# RUN docker-php-ext-install mysqli && \
#        a2enmod authn_dbd && \
#       pecl install -o -f redis && \
#        rm -rf /tmp/pear && \
#        docker-php-ext-enable redis && \
#        apt-get update && \
#        apt-get install -y libaprutil1-dbd-mysql && \
#        apt-get install -y git && \
#       apt-get install -y libpng-dev && \
#        apt-get install -y zip unzip && \
#       docker-php-ext-install gd
#COPY src/composer.json ./
#RUN composer update && \
#   composer install && \
#    service apache2 restart
EXPOSE 8001