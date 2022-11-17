# The official public image does not perform the segfault
# This uses PHP version 8.1.1
FROM php:8.1.1-fpm-alpine3.15 AS base

# Add OPCache to official image
RUN docker-php-ext-install opcache

RUN set -eux; \
    # Download packages
    apk add --update --no-cache nginx; \
    # Remove the default php-fpm configs
    rm /usr/local/etc/php-fpm.d/*; \
    # Setup directories
    mkdir -p /var/www/html /run/php; \
    # Prevent couchbase from throwing an error
    touch /tmp/cb_config_cache; \
    # Make nginx log to stdout and stderr
    ln -sf /dev/stdout /var/log/nginx/access.log; \
    ln -sf /dev/stderr /var/log/nginx/error.log; \
    # Make sure nginx user/group owns the stuff
    chown nginx:nginx /var/www/html /run/php /tmp/cb_config_cache;

EXPOSE 8080


FROM base AS production

COPY build/config/nginx/nginx.conf \
    build/config/nginx/serverListen.conf \
    build/config/nginx/fastcgi_params \
    build/config/nginx/fastcgi_whitelist \
    /etc/nginx/

COPY build/config/php/fpm.conf /usr/local/etc/php-fpm.d/www.conf
COPY build/config/php/php.ini $PHP_INI_DIR/php.ini
COPY build/config/php/opcache.ini $PHP_INI_DIR/conf.d/

USER nginx

ENV NGINX_STOPSIGNAL SIGQUIT
ENV FPM_STOPSIGNAL SIGQUIT
STOPSIGNAL SIGTERM


FROM production AS local

USER root
EXPOSE 8090

COPY build/entrypoint.dev.sh /usr/local/bin/docker-php-entrypoint-dev
RUN chmod 777 /usr/local/bin/docker-php-entrypoint-dev
ENTRYPOINT docker-php-entrypoint-dev

STOPSIGNAL SIGKILL


FROM local AS debug
RUN apk --no-cache add pcre-dev ${PHPIZE_DEPS} \
    && pecl install xdebug-3.1.4 \
    && docker-php-ext-enable xdebug