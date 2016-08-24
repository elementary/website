#!/bin/sh
# Lints all javascript files with standard
# Requires nvm installed

set -e

echo "###########################"
echo "Starting Javascript linting"
echo "###########################"

./node_modules/.bin/eslint \
    --ignore-pattern "*.min.js" \
    --ignore-pattern "*.pack.js" \
    --ignore-pattern "jQuery.leanModal2.js" \
    "scripts/**/*.js"

echo "############################"
echo "Javascript linting complete!"
echo "############################"
