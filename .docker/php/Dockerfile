FROM php:8.3-fpm-alpine

ARG UID
ARG GID

# Set working directory
WORKDIR /var/www

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# php extensions installer: https://github.com/mlocati/docker-php-extension-installer
COPY --from=mlocati/php-extension-installer:latest --link /usr/bin/install-php-extensions /usr/local/bin/

RUN apk add --no-cache \
    sudo \
    shadow \
    acl \
    fcgi \
    file \
    gettext \
    git \
    libjpeg-turbo-dev \
    libpng-dev \
    libwebp-dev \
    freetype-dev \
    nodejs \
    npm \
    ;

RUN set -eux; \
    install-php-extensions \
    apcu \
    curl-7.74.0 \
    intl-67.1 \
    libxml-2.9.14 \
    opcache \
    zip \
    amqp-2.1.0 \
    redis-5.3.7 \
    pdo_mysql \
    mysqli \
    xsl-1.1.34 \
    gd \
    pcntl \
    openssl-1.1.11 \
    iconv-1.17 \
    xml-2.9.14 \
    ;

RUN echo 'memory_limit = 2G' > /usr/local/etc/php/conf.d/docker-php-memlimit.ini

RUN echo 'zlib.output_compression=On' > /usr/local/etc/php/conf.d/docker-php-zlib.ini

RUN echo 'upload_max_filesize = 10G' >> /usr/local/etc/php/conf.d/docker-php-filelimit.ini
RUN echo 'post_max_size = 10G' >> /usr/local/etc/php/conf.d/docker-php-filelimit.ini

RUN usermod -u $UID www-data || true
RUN groupmod -g $GID www-data || true

# Start PHP-FPM
CMD ["php-fpm"]