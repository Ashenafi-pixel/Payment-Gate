FROM php:latest
WORKDIR /dev_addispay

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
RUN npm cache clean --force
RUN rm -rf node_modules
RUN rm -f package-lock.json
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
COPY . .
RUN composer install --ignore-platform-reqs
RUN npm install

RUN npm run build

EXPOSE 8000
CMD ["php", "-S", "0.0.0.0:8000", "-t", "public"]

