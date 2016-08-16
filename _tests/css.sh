#!/bin/sh
# Runs csscomb on all css files
# Requires nvm installed and project as git directory

set -e

echo "####################"
echo "Starting CSS linting"
echo "####################"

./node_modules/.bin/postcss --config .postcss.json

if ! git diff --quiet _styles/; then
    git --no-pager diff _styles/

    echo "##############################################################"
    echo "CSS linting detected an error. Please use csscomb and resubmit"
    echo "##############################################################"

    exit 1;
else
    echo "#####################"
    echo "CSS linting complete!"
    echo "#####################"

    exit 0;
fi
