#!/bin/sh

php artisan config:clear
php artisan cache:clear
php artisan migrate --force

/start.sh
