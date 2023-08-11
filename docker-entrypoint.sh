#!/bin/bash


if [ ! -f ".env" ]; then
    cp .env.example .env
fi
# 
/var/www/html/wait-for-it.sh db:5432 -- php artisan migrate --force

# 
php artisan serve --host=0.0.0.0 --port=8000
