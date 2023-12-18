FROM php:8.2-apache

USER root

WORKDIR /var/www/html

COPY public/index.php index.php
COPY public/ src

RUN apt-get update && \
    apt-get install -y \
        libzip-dev \
        libonig-dev \
        unzip \
        git \
        curl \
        nodejs \
        npm

RUN docker-php-ext-install mysqli
RUN docker-php-ext-enable mysqli

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY . .

RUN composer install --ignore-platform-reqs
RUN npm install

RUN chown -R www-data:www-data storage bootstrap
RUN chmod -R 777 public
RUN npm run build

# Clear cache and optimize Laravel
RUN php artisan cache:clear
RUN  php artisan optimize

# Clear cache and cleanup
RUN apt-get clean
RUN apt-get clean rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*
RUN npm cache clean
RUN composer clear-cache

EXPOSE 8000

CMD ["php", "-S", "0.0.0.0:8000", "-t", "public"]
