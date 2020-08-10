FROM php:7.3-apache

RUN apt-get update && apt-get install -y vim zip git wget libcurl4-openssl-dev apt-utils supervisor cron

RUN a2enmod rewrite http2

RUN pecl channel-update pecl.php.net
RUN pecl install redis && docker-php-ext-enable redis
RUN pecl install ast && echo "extension=ast.so" > /usr/local/etc/php/conf.d/ext-ast.ini

RUN curl -sS https://getcomposer.org/installer | php -- --version=1.7.1 --install-dir=/usr/local/bin --filename=composer

RUN chown -R www-data:www-data /var/www/html/ && chmod -R g+w /var/www/html/

WORKDIR "/var/www/html"

COPY ./ ./

RUN COMPOSER_MEMORY_LIMIT=-1 composer install

RUN usermod -u 1000 www-data