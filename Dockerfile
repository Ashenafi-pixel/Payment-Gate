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
    git \
    nodejs \
    libpng-dev && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/*

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
RUN php artisan key:generate && \
    php artisan optimize && \
    php artisan config:clear && \
    php artisan route:clear && \
    php artisan view:clear && \
    php artisan cache:clear

# Install Node.js dependencies and build frontend assets for production
RUN npm install && npm run production

# Change ownership and permissions
RUN chown -R www-data:www-data /var/www/html && \
    chmod -R 755 /var/www/html/public && \
    chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/public/uploads/qrcodes && \
    chmod -R 755 /var/www/html/public/public/images

# Set the correct permissions for the public directory
RUN chown -R www-data:www-data /var/www/html/public/public/images

# Expose port 80
EXPOSE 80

# Start Apache
CMD ["apache2-foreground"]
