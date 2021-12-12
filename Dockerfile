FROM php:7.2-fpm

RUN useradd -u 1000 appuser

WORKDIR /var/www/html

COPY  ./app .

RUN chown -R appuser:appuser .

USER appuser

WORKDIR /var/www/html/public




