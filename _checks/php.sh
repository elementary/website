if find ./ -name '*.php' -exec php -l {} \; |grep -v 'No syntax error'
then
	echo 'There are PHP errors.'
	# find ./ -name '*.php' -exec php -l {} \;
	exit 1;
fi
