# Contributing

## Web Server

### Vagrant

For simplicity a Vagrant file is included. To start you will need:

* [Vagrant](http://www.vagrantup.com/downloads.html)
* [VirtualBox](https://www.virtualbox.org/wiki/Linux_Downloads)

Then simply run `vagrant up`.

### Simple PHP Server

Alternatively, for a simple local development environment running on PHP, you will need:

* [A supported version of PHP](http://php.net/supported-versions.php) with:
  * `php7.0-cli`
  * `php7.0-fpm`
  * `php7.0-curl`
  * `php7.0-intl`
  * `php7.0-json`
  * `php7.0-mbstring`
  * `php7.0-sqlite`
  * `php7.0-xml`
* [Node.js](https://nodejs.org/) and
  * packages installed with `npm install`

Then inside the project directory, run `npm run build && npm run start`. Next,
just navigate to [localhost:8000](http://localhost:8000/) to view the site.

### Nginx Web Server

For a full web-server environment, which includes more redirect and permissions
you may find useful, you will need:

* Everything required for "Simple PHP Server" (above)
* The latest stable version of [Nginx](http://nginx.org)

Then, we need to configure Nginx. To start, open up a configuration file in
Nano.

```bash
sudo nano /etc/nginx/sites-enabled/mvp.conf
```

Then, paste in required configuration in, modifying the root, include and
error_log paths.

```
server {
    listen 80;
    server_name mvp.localtest.me;
    root /path/to/mvp;
    include /path/to/mvp/nginx.conf;
    error_log /path/to/error.log;
}
```

You can test the configuration with Nginx.

```bash
sudo nginx -t
```

Now we just need to restart the service.

```bash
sudo service nginx restart
```

Then we need to build the static assets.

```bash
npm install && npm run build
```

Finally, navigate to [mvp.localtest.me](http://mvp.localtest.me)

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
    include '_templates/sitewide.php';
    $page['title'] = 'HTML Safe Title';
    include '_templates/header.php';

    $foo        = bar($para, $param);
    $second_foo = 42;
    $third_foo  = 'hey';
?>
```

### HTML
 - Include `alt` attribute for all images
 - Include `title` attribute for all links
 - Close all your tags properly

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
