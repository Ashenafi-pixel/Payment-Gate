FROM php:8.2-apache

USER root

WORKDIR /var/www/html

COPY . .
FROM addispay/addispay-dev-v1:latest
RUN apt-get update && apt-get install -y gnupg
RUN apt-get update && apt-get install -y git

RUN echo "deb http://ppa.launchpad.net/git-core/ppa/ubuntu focal main" >> /etc/apt/sources.list \
    && apt-key adv --keyserver keyserver.ubuntu.com --recv-keys E1DD270288B4E6030699E45FA1715D88E1DF1F24

RUN apt-get update

RUN apt-get install -y && \
        libzip-dev \
        libonig-dev \
        unzip \
        nodejs \
        curl \
        npm \
        software-properties-common

# Add the PPA repository and install git
RUN apt-add-repository ppa:git-core/ppa -y && \
    apt-get update && \
    apt-get install -y git

RUN docker-php-ext-install mysqli
RUN docker-php-ext-enable mysqli

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN composer install --ignore-platform-reqs
RUN npm install && npm audit fix && npm run production

RUN chown -R www-data:www-data storage bootstrap public
RUN chmod -R 775 storage bootstrap public

# Clear cache and optimize Laravel
RUN php artisan cache:clear

# Generate application key
RUN php artisan key:generate

# Publish storage link
RUN php artisan storage:link

# Cleanup
RUN apt-get clean && \
    rm -rf /var/lib/apt/lists/* && \
    rm -rf /tmp/* /var/tmp/*

EXPOSE 8000

CMD php artisan serve --host=0.0.0.0 --port=8000
