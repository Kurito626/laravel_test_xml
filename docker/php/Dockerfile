FROM php:8.2.1-fpm

RUN apt -y update && apt upgrade -y && apt-get install -y \
                                       build-essential \
                                       libpng-dev \
                                       libjpeg62-turbo-dev \
                                       libfreetype6-dev \
                                       locales \
                                       zip \
                                       jpegoptim optipng pngquant gifsicle \
                                       vim \
                                       unzip \
                                       git \
                                       curl \
                                       libpq-dev \
                                       libonig-dev \
                                       libzip-dev && \
                                       docker-php-ext-configure gd --with-freetype --with-jpeg && \
                                       docker-php-ext-install mbstring zip exif pcntl gd && \
                                       apt-get clean && rm -rf /var/lib/apt/lists/*
RUN docker-php-ext-install pdo pdo_mysql && docker-php-ext-enable pdo_mysql

RUN pecl install xdebug-3.2.0 && docker-php-ext-enable xdebug

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY docker/php/conf.d/* $PHP_INI_DIR/conf.d/
