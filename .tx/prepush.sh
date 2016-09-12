#!/bin/bash

extract_translations () {
	filename="$1"
	pagename=$(echo "$filename" | sed 's/\.php$//' | sed 's/\.md$//')
	output_file="lang/en/$pagename.json"
	output_dirname=`dirname "$output_file"`

	# Ignore some files
	if [[ $pagename == "router" ]] || [[ $pagename == "countdown" ]]; then
		return
	fi

	echo "Extracting: $pagename -> $output_file"

	# Create dirname if it doesn't exist
	if [ ! -d "$output_dirname" ] ; then
		mkdir -p "$output_dirname"
	fi

	# Run l10n-extract.php
	php -f backend/extract-l10n.php "$pagename" 2>>/dev/null > "$output_file"

	# Add file to .tx/config
	escaped_pagename=$(echo "$pagename" | sed 's/\//_/g')
	if ! grep -F -q "[elementary-mvp.$escaped_pagename]" .tx/config; then
		echo "Adding $pagename to .tx/config"
		tx set -t KEYVALUEJSON --auto-local -r "elementary-mvp.$escaped_pagename" "lang/<lang>/$pagename.json" --source-lang en --execute
	fi
}

# Cleanup
mkdir -p lang/en
rm -rf lang/en/*

echo "Extracting translations..."

# Extract layout
extract_translations "layout"

# Extract PHP files
for file in *.php; do
	extract_translations "$file"
done

# Extract docs
for file in $(find docs -name '*.md'); do
	extract_translations "$file"
done

# Extract select store pages
extract_translations "store/cart.php"
extract_translations "store/index.php"

echo "Done! You can now push source files on Transifex by running:"
echo "tx push -s"
