#!/bin/bash

cd _backend
composer up
cd ../
npm i -g npm
npm ci && npm run build && npm run start
