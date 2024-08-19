#!/usr/bin/env bash
echo "Running composer"
composer install --no-dev --working-dir=/var/www/html

mv .env.example .env

php artisan key:generate

echo "Caching config..."
php artisan config:cache

echo "Caching routes..."
php artisan route:cache

php artisan key:generate

php artisan serve --host=0.0.0.0 --port=10000