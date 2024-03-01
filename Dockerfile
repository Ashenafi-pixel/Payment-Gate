# Use the official PHP Apache image
FROM php:8.2.14-apache

# Set the working directory
WORKDIR /var/www/html

# Install dependencies
RUN apt-get update && \
    apt-get install -y \
    libzip-dev \
    unzip \
    npm \
    nodejs \
    libpng-dev

# Install additional PHP extensions
RUN docker-php-ext-install zip pdo pdo_mysql gd

# Enable Apache modules and configure the virtual host
RUN a2enmod rewrite
COPY apache2.conf /etc/apache2/sites-available/000-default.conf

# Install Composer globally
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy the Laravel application files
COPY . .

# Install Laravel dependencies
RUN composer install

# Generate application key and run migrations
RUN php artisan key:generate
RUN php artisan optimize

# Install Node.js dependencies
RUN npm install

# Build frontend assets for production
RUN npm run production

# Change ownership of storage and cache directories
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
RUN chown -R www-data:www-data /var/www/html/public/uploads/qrcodes   # Add this line to modify ownership

# Set the correct permissions for the public directory
RUN chmod -R 755 /var/www/html/public
RUN php artisan config:clear
RUN php artisan route:clear
RUN php artisan view:clear
RUN php artisan cache:clear

# Expose port 80
EXPOSE 80

RUN sed -i 's/SESSION_SECURE_COOKIE=false/SESSION_SECURE_COOKIE=true/' /var/www/html/config/session.php

# Start Apache
CMD ["apache2-foreground"]
