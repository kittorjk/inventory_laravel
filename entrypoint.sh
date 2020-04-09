#!/bin/sh
#immediatly exit if a command fails:
set -e
if [ -z "$(ls -A .)" ]; then
     composer create-project --prefer-dist laravel/laravel --no-interaction .
     php artisan key:generate
else
     composer install --no-interaction
fi
exec "$@"