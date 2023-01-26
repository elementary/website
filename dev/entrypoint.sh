#!/bin/bash

cd _backend
composer up
cd ../
npm ci
npm run build
service nginx start
php-fpm
