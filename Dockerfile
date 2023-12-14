FROM php:8.2-fpm

#ENV DEBIAN_FRONTEND noninteractive
#ENV TZ=UTC+3

RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

RUN apt-get update
RUN apt-get install -y zip unzip git
RUN apt-get install -y default-mysql-client
# For phpro/soap-client
#RUN apt-get install -y libxml2-dev libxslt-dev
#RUN docker-php-ext-install bcmath intl soap xsl
# Clean up
RUN apt-get -y autoremove
RUN apt-get clean
RUN rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

RUN docker-php-ext-install mysqli pdo pdo_mysql

COPY php.ini /usr/local/etc/php/php.ini

### App
WORKDIR /var/www/html
# Copy app files
COPY --chown=www-data:www-data . .
# Install composer & app
COPY --from=composer:2.5.8 /usr/bin/composer /usr/local/bin/composer
#CMD bash -c "composer install && php artisan serve"
RUN composer install

# Xdebug, как настроить: https://habr.com/ru/articles/712670/
RUN pecl install xdebug  \
    && docker-php-ext-enable xdebug

#COPY composer.json composer.lock* ./

#COPY ./create-testing-database.sh /docker-entrypoint-initdb.d/10-create-testing-database.sh

#ENTRYPOINT ["tail", "-f", "/dev/null"]
