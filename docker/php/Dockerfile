FROM php:7.3

WORKDIR /app

RUN apt-get update && apt-get install -y \
    curl git libzip-dev zip unzip zlib1g-dev wget && \
    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer && \
    docker-php-ext-install -j$(nproc) zip && \
    wget https://get.symfony.com/cli/installer -O - | bash

RUN mv /root/.symfony/bin/symfony /usr/local/bin/symfony

