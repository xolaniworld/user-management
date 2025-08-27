FROM php:7.4-apache

RUN apt-get update && apt-get dist-upgrade -y
#RUN #docker-php-ext-install pdo pdo_mysql

#RUN pecl install xdebug-3.1.6 \
#    && docker-php-ext-enable xdebug

#COPY docker/000-default.conf /etc/apache2/sites-available/000-default.conf
#COPY docker/start-apache.sh /usr/local/bin
#RUN a2enmod rewrite

# Copy application source
COPY ../src /var/www/
RUN chown -R www-data:www-data /var/www

