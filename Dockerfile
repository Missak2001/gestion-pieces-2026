FROM node:22 AS assets

WORKDIR /app
COPY package*.json ./
RUN npm install
COPY resources ./resources
COPY vite.config.js ./
RUN npm run build


FROM richarvey/nginx-php-fpm:3.1.6

WORKDIR /var/www/html

COPY . .

RUN rm -f public/hot

COPY --from=assets /app/public/build ./public/build

COPY nginx-site.conf /etc/nginx/sites-enabled/default.conf
COPY render-start.sh /usr/local/bin/render-start.sh

RUN composer install --no-dev --optimize-autoloader

RUN chmod +x /usr/local/bin/render-start.sh
RUN chown -R www-data:www-data storage bootstrap/cache
RUN chmod -R 775 storage bootstrap/cache

CMD ["/usr/local/bin/render-start.sh"]
