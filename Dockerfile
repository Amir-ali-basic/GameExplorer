# Use an official PHP runtime as a parent image
FROM php:8.2-fpm

# Set the working directory to /app
WORKDIR /app

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    && docker-php-ext-install pdo pdo_mysql

# Install Composer globally
RUN curl -sS https://getcomposer.org/installer | php -- \
    --install-dir=/usr/local/bin --filename=composer

# Copy composer.lock and composer.json to the working directory
COPY composer.lock composer.json ./

# Run Composer to install dependencies
# Note: It is important that this is done after the COPY command above
RUN composer install --no-scripts --no-autoloader

# Copy the rest of the application's code
COPY . .

# Run Composer to finish installation
RUN composer dump-autoload --optimize && composer run-script post-install-cmd

EXPOSE 9000

# Default command to start PHP-FPM
CMD php -S 0.0.0.0:9000 -t public
