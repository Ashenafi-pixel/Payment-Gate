FROM php:7.x
WORKDIR /app
RUN apt-get update && \
    apt-get install -y \
        libzip-dev \
        libonig-dev \
        unzip \
        git \
        curl

RUN docker-php-ext-install pdo pdo_mysql mbstring zip
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN curl -sL https://deb.nodesource.com/setup_14.x | bash - && \
    apt-get install -y nodejs
COPY . .

RUN composer install --no-scripts --no-interaction

RUN npm install && npm run production

# Expose port 8000 and start the Laravel development server
EXPOSE 8000
CMD ["php", "artisan", "serve", "--host", "0.0.0.0", "--port", "8000"]
