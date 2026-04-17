FROM php:8.2-cli-alpine

RUN apk add --no-cache \
        git \
        unzip \
        libzip-dev \
        icu-dev \
        linux-headers \
        $PHPIZE_DEPS \
    && docker-php-ext-install \
        zip \
        intl \
    && pecl install xdebug \
    && docker-php-ext-enable xdebug \
    && rm -rf /tmp/pear \
    && apk del $PHPIZE_DEPS

# Xdebug config: keep disabled by default; enable via env (XDEBUG_MODE)
RUN mkdir -p /usr/local/etc/php/conf.d \
    && { \
      echo "zend_extension=xdebug"; \
      echo "xdebug.client_host=host.docker.internal"; \
      echo "xdebug.client_port=9003"; \
      echo "xdebug.start_with_request=yes"; \
      echo "xdebug.discover_client_host=0"; \
      echo "xdebug.log_level=0"; \
    } > /usr/local/etc/php/conf.d/99-xdebug.ini

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app

CMD ["tail", "-f", "/dev/null"]