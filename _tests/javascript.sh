#!/bin/sh
# Lints all javascript files with standard
# Requires nvm installed

set -e

#`Starting Javascript linting`



./node_modules/.bin/eslint \
    --ignore-pattern "*.min.js" \
    --ignore-pattern "*.pack.js" \
    --ignore-pattern "terminal.js" \
    "_scripts/**/*.js"
    
    
#`Javascript linting complete

