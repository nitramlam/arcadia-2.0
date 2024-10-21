FROM php:8.2-apache

# Installer l'extension mysqli
RUN docker-php-ext-install mysqli

# Installer l'extension MongoDB
RUN apt-get update && apt-get install -y \
    libssl-dev \
    && pecl install mongodb \
    && docker-php-ext-enable mongodb

    