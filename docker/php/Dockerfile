FROM php:8.3-fpm-alpine

# Install PHP extensions because we need MySQL drivers.
RUN docker-php-ext-install pdo pdo_mysql mysqli
# Install composer.
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer
# Install npm.
RUN apk add --no-cache npm
# Install yarn through npm.
RUN npm install -g yarn

WORKDIR /var/www/html