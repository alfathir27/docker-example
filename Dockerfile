# install php-mysqli for service php
FROM php:7.4-fpm
RUN docker-php-ext-install mysqli