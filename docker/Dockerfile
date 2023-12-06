FROM php:7.4-apache

RUN docker-php-ext-install pdo pdo_mysql
COPY docker/000-default.conf /etc/apache2/sites-available/000-default.conf
COPY docker/start-apache.sh /usr/local/bin
RUN a2enmod rewrite

# Copy application source
COPY ../src /var/www/
RUN chown -R www-data:www-data /var/www

CMD ["start-apache.sh"]
