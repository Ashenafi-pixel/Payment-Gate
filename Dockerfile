FROM php:latest
# RUN php artisan cache:clear
# RUN php artisan route:clear
# RUN php artisan view:clear
# RUN php artisan config:clear
# RUN php artisan optimize

WORKDIR /app
RUN apt-get update && \
    apt-get install -y \
        libzip-dev \
        libonig-dev \
        unzip \
        git \
        curl

RUN docker-php-ext-install pdo pdo_mysql mbstring zip
RUN apt-get install -y git

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN apt-get update && apt-get upgrade -y && apt-get install -y nodejs npm
COPY . .
RUN composer install --ignore-platform-reqs
RUN npm install && npm run build
RUN chown -R www-data:www-data /app
RUN chmod -R 755 /app
EXPOSE 8000
CMD ["php", "artisan", "serve", "--host", "0.0.0.0", "--port", "8000"]
