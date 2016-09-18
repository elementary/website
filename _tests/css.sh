#!/bin/sh
# Runs postcss on all css files
# Requires nvm installed and project as git directory

set -e

echo "####################"
echo "Starting CSS linting"
echo "####################"

./node_modules/.bin/stylelint --config .stylelintrc.json "_styles/**/*.css"

echo "#####################"
echo "CSS linting complete!"
echo "#####################"

exit 0;
