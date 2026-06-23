#!/bin/sh

php artisan config:clear
php artisan cache:clear
php artisan migrate --force
php artisan db:seed --force

/start.sh
