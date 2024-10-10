FROM php:8.2-apache

# Installer l'extension mysqli
RUN docker-php-ext-install mysqli