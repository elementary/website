#!/bin/bash

cd _backend
composer up
cd ../
npm i -g npm
npm ci
service nginx start
php-fpm
