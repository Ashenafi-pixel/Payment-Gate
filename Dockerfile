FROM php:latest
USER root
WORKDIR /var/www/html

RUN apt-get update && \
    apt-get install -y \
        libzip-dev \
        libonig-dev \
        unzip \
        git \
        curl \
        nodejs \
        npm

RUN docker-php-ext-install pdo pdo_mysql mbstring zip
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
COPY . .
RUN composer install --ignore-platform-reqs
RUN npm install

RUN chown -R www-data:www-data storage bootstrap
RUN chmod -R 777 /public*
RUN npm run build

EXPOSE 8000

# Start the PHP server
CMD ["php", "-S", "0.0.0.0:8000", "-t", "public"]
