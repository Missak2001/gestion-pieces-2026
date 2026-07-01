FROM richarvey/nginx-php-fpm:3.1.6

WORKDIR /var/www/html

COPY . .

RUN rm -f public/hot

COPY nginx-site.conf /etc/nginx/sites-enabled/default.conf
COPY render-start.sh /usr/local/bin/render-start.sh

RUN composer install --no-dev --optimize-autoloader

RUN npm install
RUN npm run build

RUN chmod +x /usr/local/bin/render-start.sh
RUN chown -R www-data:www-data storage bootstrap/cache
RUN chmod -R 775 storage bootstrap/cache

CMD ["/usr/local/bin/render-start.sh"]
