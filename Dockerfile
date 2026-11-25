FROM dunglas/frankenphp:1-php8.4-alpine

WORKDIR /app

RUN cp "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini" \
    && install-php-extensions mbstring

COPY Caddyfile /etc/caddy/Caddyfile
COPY index.php ./index.php
COPY assets ./assets

ENV PORT=80

CMD ["frankenphp", "run", "--config", "/etc/caddy/Caddyfile"]
