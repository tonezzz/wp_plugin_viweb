FROM php:8.2-fpm

# Update package repo data
RUN apt update

# Install memcached server
RUN apt install -y memcached libmemcached-tools

# Install PHP memcache extension
RUN apt install -y zlib1g-dev \
    && yes '' | pecl install memcache-8.2

# Install PHP MySQL extension
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

RUN apt-get install -y \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libwebp-dev \
    && docker-php-ext-configure gd \
    && docker-php-ext-install -j$(nproc) gd

RUN apt-get update && apt-get install -y \
    libmagickwand-dev --no-install-recommends \
    && pecl install imagick \
    && docker-php-ext-enable imagick

# Xdebug
RUN pecl install xdebug && docker-php-ext-enable xdebug

# Clean unused repo & packages data
RUN apt clean && rm -rf /var/lib/apt/lists/*

# Change user id & group id for docker host accessible
RUN usermod -u 1000 www-data && groupmod -g 1000 www-data

# Change working directory
WORKDIR /usr/local/apache2/htdocs

# Run memcached server & php-fpm service
CMD service memcached start && php-fpm