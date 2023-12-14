FROM php:8.2-apache
WORKDIR /var/www/html
COPY public/index.php index.php
COPY public/ src
RUN docker-php-ext-install mysqli
RUN docker-php-ext-enable mysqli
EXPOSE 80

