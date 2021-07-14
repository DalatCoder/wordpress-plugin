FROM php:7.4-fpm

RUN touch /var/log/error_log

ADD ./php/www.conf /usr/local/etc/php-fpm.d/www.conf

RUN addgroup --gid 1000 wp
RUN adduser --shell /bin/sh --uid 1000 --gid 1000 --disabled-password wp
RUN usermod -a -G wp wp

RUN mkdir -p /var/www/html

RUN chown wp:wp /var/www/html

WORKDIR /var/www/html

RUN docker-php-ext-install mysqli pdo pdo_mysql && docker-php-ext-enable pdo_mysql
