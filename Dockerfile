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
    && docker-php-ext-install zip pdo pdo_mysql
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
RUN php artisan key:generate && \
    php artisan migrate
RUN php artisan optimize
# Install Node.js dependencies
RUN npm install
# Build frontend assets for production
RUN npm run production

# Change ownership of storage and cache directories
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Set the correct permissions for the public directory
RUN chmod -R 755 /var/www/html/public

# Expose port 80
EXPOSE 80
RUN sed -i 's/SESSION_SECURE_COOKIE=false/SESSION_SECURE_COOKIE=true/' /var/www/html/config/session.php

# Start Apache
CMD ["apache2-foreground"]
