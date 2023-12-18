# Use the latest PHP base image
FROM php:latest

# Set the working directory
WORKDIR /var/www/html

# Install dependencies
RUN apt-get update && \
    apt-get install -y \
        libzip-dev \
        libonig-dev \
        unzip \
        git \
        curl \
        nodejs \
        npm

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_mysql mbstring zip

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy project files to the working directory
COPY . .

# Install project dependencies
RUN composer install --ignore-platform-reqs

# Install npm packages
RUN npm install

# Set the correct file permissions
RUN chown -R www-data:www-data storage bootstrap

# Build the assets
RUN npm run build

# Expose the application port
EXPOSE 8000

# Start the PHP server
CMD ["php", "-S", "0.0.0.0:8000", "-t", "public"]
