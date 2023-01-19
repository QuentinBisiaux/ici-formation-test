FROM php:7.4-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    netcat \
    vim

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

## Install PHP extensions
ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/

RUN chmod uga+x /usr/local/bin/install-php-extensions && sync && \
    #install-php-extensions amqp apcu bcmath exif gd grpc imap intl ldap mcrypt opcache sockets uuid xdebug yaml zip
    install-php-extensions pdo_mysql

# Get latest Composer
COPY --from=composer:2.4.2 /usr/bin/composer /usr/bin/composer

# Create system user to run Composer and Artisan Commands
RUN useradd -G www-data,root -u 1000 -d /home/dev dev
RUN mkdir -p /home/dev/.composer && \
    chown -R dev:dev /home/dev

# Set working directory
WORKDIR /var/www

USER dev
