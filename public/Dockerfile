FROM php:8.2-apache

# Install PHP extensions and system dependencies
RUN apt-get update && apt-get install -y \
    git curl zip unzip sqlite3 libsqlite3-dev libonig-dev libzip-dev \
    && docker-php-ext-install pdo pdo_sqlite zip

# Enable Apache rewrite module
RUN a2enmod rewrite

# Set working directory
WORKDIR /var/www/html

# Copy Laravel project files into container
COPY . .

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Install Laravel dependencies
RUN composer install --no-dev --optimize-autoloader

# Set proper permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 storage bootstrap/cache

# Change Apache document root to public/
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

RUN php artisan migrate --force && php artisan db:seed --force

# Expose HTTP port
EXPOSE 80

# Start Apache
CMD ["apache2-foreground"]
