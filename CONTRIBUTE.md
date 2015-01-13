# Code Style
 - Four space indentation.
 - IE 9+ Compatability

## PHP
 - include templates, not require or _once.
 - Use full PHP tags, not short ones.
```
<?php
    include '_templates/sitewide.php';
    $page['title'] = 'HTML Safe Title';
    include '_templates/header.php';
    $foo = bar($para, $param);
?>
```

## HTML
 - Include ALT attributes for all images.
 - Close all your tags properly.
 
## CSS
 - Try to use classes instead of IDs unless things are absolutely unique.
```
.class {
    color: #fefe89;
    font-size: 1.1em;
}
```

# Contributing
## Make a new branch and push it to GitHub.
```
git checkout -b feature_branch_name
git push -u origin feature_branch_name
```
## Updating from Master
```
git pull origin master
# Fix Merge Conflicts
```
