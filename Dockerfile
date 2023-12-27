# Use an official PHP with Apache image as a parent image
FROM php:7.4-apache

# Set the working directory to /app
WORKDIR /app

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    libonig-dev \
    libxml2-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libmcrypt-dev \
    libpng-dev \
    nano

# Install Composer globally
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install Node.js and npm
RUN curl -sL https://deb.nodesource.com/setup_14.x | bash - \
    && apt-get install -y nodejs

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_mysql zip mbstring exif pcntl bcmath gd xml

# Set recommended PHP.ini settings
# See https://laravel.com/docs/8.x/deployment#optimization
RUN echo "memory_limit=512M" > $PHP_INI_DIR/conf.d/memory-limit.ini
RUN echo "max_execution_time=300" > $PHP_INI_DIR/conf.d/max-execution-time.ini
RUN echo "upload_max_filesize=100M" > $PHP_INI_DIR/conf.d/upload-max-filesize.ini
RUN echo "post_max_size=100M" > $PHP_INI_DIR/conf.d/post-max-size.ini

# Remove previous cached image layers
RUN rm -rf /var/lib/apt/lists/*

# Copy the local application directory to the container at /app
COPY . /app

# Install application dependencies
RUN composer install --no-interaction --no-suggest --no-scripts

# Install Node.js dependencies and compile assets
RUN npm install && npm run production

# Set permissions (adjust this based on your needs)
RUN chown -R www-data:www-data /app
RUN chmod -R 755 /app/storage

# Expose port 8000 and start Apache
EXPOSE 8000
CMD php artisan serve --host=0.0.0.0 --port=8000
