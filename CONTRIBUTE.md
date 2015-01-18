# Code Style

 - Four space indentation
 - Remove trailing whitespaces and add an empty line at the end of each file
 - IE 9+ Compatability
 
## PHP
 - `include` templates, not `require` or `_once`
 - Use full PHP tags, not short ones
 - Don't close PHP tags on PHP only files
 - Correctly format assignments for readability

```php
<?php
    include '_templates/sitewide.php';
    $page['title'] = 'HTML Safe Title';
    include '_templates/header.php';
    
    $foo        = bar($para, $param);
    $second_foo = 42;
    $third_foo  = 'hey';
?>
```

## HTML
 - Include `alt` attribute for all images
 - Include `title` attribute for all links
 - Close all your tags properly
 
## CSS
 - Try to use classes instead of IDs unless things are absolutely unique
 - One selector per line
 - Care with fallbacks and browsers compatibilities
```css
.class {
    color: #fefe89;
    font-size: 1.1em;
}

.second-class,
.third-class {
    backgound-color: white;
}
```

# Contributing

## Make a new branch and push it to GitHub.
```bash
git checkout -b feature_branch_name
git push -u origin feature_branch_name
```
## Updating from Master
```bash
git pull origin master
```
## Merge/Rebase from master
```bash
git checkout feature_branch_name
git merge master
```
or
```bash
git checkout feature_branch_name
git rebase master
```
## Fix Merge Conflicts
