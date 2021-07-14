FROM php:7.4-fpm

RUN addgroup --gid 1000 wp
RUN adduser --shell /bin/sh --uid 1000 --gid 1000 --disabled-password wp
RUN usermod -a -G wp wp

RUN mkdir -p /var/www/html

RUN chown wp:wp /var/www/html

WORKDIR /var/www/html

# Install Node12
# replace shell with bash so we can source files
RUN rm /bin/sh && ln -s /bin/bash /bin/sh

USER root
RUN curl -sL https://deb.nodesource.com/setup_12.x | bash 
RUN apt -y install nodejs
USER wp

# Install Composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php composer-setup.php
RUN php -r "unlink('composer-setup.php');"

USER root
RUN mv composer.phar /usr/local/bin/composer

RUN apt -y install git
USER wp


WORKDIR /var/www/html/wp-content/plugins
