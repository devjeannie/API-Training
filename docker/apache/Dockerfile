FROM php:8.2-apache


# COPY ./conf/php.ini /usr/local/etc/php/
COPY ./conf/*.conf /etc/apache2/sites-enabled/

RUN apt-get update \
  && apt-get install -y libzip-dev zlib1g-dev libpq-dev mariadb-client libmagick++-dev libmagickwand-dev libpq-dev libfreetype6-dev libjpeg62-turbo-dev libpng-dev libwebp-dev unzip supervisor \
  && pecl install -o -f redis \
  && rm -rf /tmp/pear \
  && docker-php-ext-install zip pdo_mysql mysqli gd \
  && docker-php-ext-enable mysqli gd redis

RUN docker-php-ext-configure pcntl --enable-pcntl \
  && docker-php-ext-install \
    pcntl

RUN mkdir -p /var/log/supervisor

COPY --chown=root:root ./supervisor_conf/supervisord.conf /etc/supervisor/conf.d/supervisord.conf
COPY --from=composer:2.5.1 /usr/bin/composer /usr/bin/composer
ENV COMPOSER_ALLOW_SUPERUSER 1
ENV COMPOSER_HOME /composer
ENV PATH $PATH:/composer/vendor/bin


WORKDIR /var/www/html
RUN a2enmod rewrite
ENTRYPOINT ["/usr/bin/supervisord", "-c", "/etc/supervisor/supervisord.conf"]
