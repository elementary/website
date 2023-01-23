# Contributing

## Web Server

### Docker Web Server with Nginx and PHP

For a simple local development environment running on PHP, you will need:
```
cd ./dev && docker-compose up -d
```
just navigate to [localhost:8000](http://localhost:8000/) to view the site.

## Code Style

 - Four space indentation
 - Remove trailing whitespaces and add an empty line at the end of each file
 - Compatibility with the latest versions of popular browsers (chrome, firefox,
     safari, edge, midori)

### PHP
 - `include` templates, not `require` or `_once`
 - Use full PHP tags, not short ones
 - Don't close PHP tags on PHP only files
 - Correctly format assignments for readability

```php
<?php
    require_once __DIR__.'/_backend/preload.php';
    $page['title'] = 'HTML Safe Title';
    include $template['header'];

    $foo        = bar($para, $param);
    $second_foo = 42;
    $third_foo  = 'hey';
?>
```

### HTML
 - Include `alt` attribute for all images
 - Include `title` attribute for all links
 - Close all your tags properly
 - `a` elements with `target="_blank"` should include a `rel="noopener"`

### CSS
 - Try to use classes instead of IDs unless things are absolutely unique
 - One selector per line
 - Care with fallbacks and browsers compatibilities. Using only official syntax
     and let the build process add prefixes as needed.

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

## Proposing Changes

### Make a new branch and push it to GitHub.
```bash
git checkout -b feature_branch_name
git push -u origin feature_branch_name
```

### Updating from Master
```bash
git pull origin master
```

### Merge from master
```bash
git checkout feature_branch_name
git merge master
```
