FROM php:8.0-apache
WORKDIR /var/www/html
RUN docker-php-ext-install mysqli
COPY ports.conf /etc/apache2/ports.conf
COPY 000-default.conf /etc/apache2/sites-available/000-default.conf
RUN a2enmod authn_dbd && apt-get update && apt-get install -y apache2-utils libaprutil1-dbd-mysql
EXPOSE 8001