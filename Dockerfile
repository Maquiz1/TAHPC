# Use official PHP image with Nginx for Laravel
FROM php:8.2-fpm

# Install dependencies
RUN apt-get update && apt-get install -y \
    libpng-dev libjpeg-dev libfreetype6-dev \
    zip git unzip libicu-dev libxml2-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql intl xml

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/tibaasili/tibaasiliweb

# Install Laravel dependencies
COPY . /var/www/tibaasili/tibaasiliweb
RUN composer install --no-dev --optimize-autoloader

# Set permission for Laravel
RUN chown -R www-data:www-data /var/www/tibaasili/tibaasiliweb/storage /var/www/tibaasili/tibaasiliweb/bootstrap/cache

CMD ["php-fpm"]
