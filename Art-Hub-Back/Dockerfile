FROM php:8.2-fpm-alpine

RUN apk add --no-cache nginx supervisor postgresql-dev \
    && docker-php-ext-install pdo_pgsql pgsql

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

ENV COMPOSER_ALLOW_SUPERUSER=1

WORKDIR /app
COPY . .

RUN cp .env.example .env \
    && php artisan key:generate --force \
    && composer install --no-dev --optimize-autoloader \
    && php artisan config:clear \
    && rm .env \
    && mkdir -p storage/framework/views storage/framework/cache storage/framework/sessions bootstrap/cache \
    && chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

RUN sed -i.bak 's/^;clear_env = no/clear_env = no/' /usr/local/etc/php-fpm.d/www.conf 2>/dev/null; \
    grep -q '^clear_env = no' /usr/local/etc/php-fpm.d/www.conf || echo 'clear_env = no' >> /usr/local/etc/php-fpm.d/www.conf; \
    rm -f /usr/local/etc/php-fpm.d/www.conf.bak

COPY docker/nginx.conf /etc/nginx/http.d/default.conf
COPY docker/supervisord.conf /etc/supervisord.conf

EXPOSE 8080

CMD ["supervisord", "-c", "/etc/supervisord.conf"]
