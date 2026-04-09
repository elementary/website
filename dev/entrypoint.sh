#!/bin/bash
set -e

# Build the backend
cd _backend
composer install
cd ../

# Build the frontend
npm ci
npm run build

# Start serving the website
service nginx start
php-fpm