#!/bin/sh
# Runs php -l on all php files

set -e

echo "####################"
echo "Starting PHP linting"
echo "####################"

find . -path './_backend/vendor' -prune -o -name "*.php" -print0 | xargs -0 -n1 -P8 php -l

./_backend/vendor/bin/phpcs --ignore="*/vendor/*,*/node_modules/*" \
  --exclude=Generic.Files.LineLength,PSR1.Files.SideEffects \
  --extensions=php \
  --standard=PSR2 .

echo "#####################"
echo "PHP linting complete!"
echo "#####################"
