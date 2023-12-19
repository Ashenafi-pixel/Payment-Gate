FROM php:8.2-apache

USER root

WORKDIR /var/www/html

RUN apt-get update && apt-get install -y \
    libzip-dev \
    libonig-dev \
    unzip \
    nodejs \
    npm \
    git \
    curl \
    software-properties-common

# Add the Git PPA repository
RUN echo "deb http://ppa.launchpad.net/git-core/ppa/ubuntu focal main" >> /etc/apt/sources.list \
    && apt-key adv --keyserver keyserver.ubuntu.com --recv-keys E1DD270288B4E6030699E45FA1715D88E1DF1F24

RUN apt-get update && apt-get install -y git

COPY . .

# Enable Apache modules and configure
RUN a2enmod rewrite
COPY apache2.conf /etc/apache2/apache2.conf
COPY 000-default.conf /etc/apache2/sites-available/000-default.conf

# Install additional PHP extensions
RUN docker-php-ext-install pdo_mysql \
    && apt-get install -y libpng-dev libjpeg-dev libfreetype6-dev libwebp-dev libzip-dev \
    && docker-php-ext-configure gd --with-jpeg --with-freetype --with-webp \
    && docker-php-ext-install gd zip

# Set up Laravel scheduler
RUN echo "* * * * * cd /var/www/html && php artisan schedule:run >> /dev/null 2>&1" > /etc/cron.d/laravel

# Set permissions
RUN chown -R www-data:www-data storage bootstrap public \
    && chmod -R 775 storage bootstrap public

# Clear cache and optimize Laravel
RUN php artisan optimize

# Generate application key (if not done already)
RUN php artisan key:generate

# Publish storage link (if not done already)
RUN php artisan storage:link

# Expose port and start Apache
EXPOSE 80
CMD ["apache2-foreground"]
