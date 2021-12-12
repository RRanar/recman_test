FROM php:7.2-fpm

COPY --from=alpine/git /usr/bin/git /usr/local/bin/git

COPY --from=composer /usr/bin/composer /usr/local/bin/composer

RUN useradd -u 1000 appuser

WORKDIR /var/www/html

COPY  ./app .

RUN chown -R appuser:appuser .

USER appuser

WORKDIR /var/www/html/public




