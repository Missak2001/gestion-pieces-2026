FROM richarvey/nginx-php-fpm:3.1.6

WORKDIR /var/www/html

COPY . .

COPY nginx-site.conf /etc/nginx/sites-enabled/default.conf

RUN composer install --no-dev --optimize-autoloader

RUN chown -R www-data:www-data storage bootstrap/cache
RUN chmod -R 775 storage bootstrap/cache
