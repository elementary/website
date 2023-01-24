# Contributing

## Web Server

### Simple PHP Server

For a simple local development environment running on PHP, you will need:

* [A supported version of PHP](http://php.net/supported-versions.php) with:
  * `php-cli`
  * `php-curl`
  * `php-intl`
  * `php-json`
  * `php-mbstring`
  * `composer`
* [Node.js](https://nodejs.org/) and `npm`
  * packages installed with `npm ci`

#### GNU/Linux Based Operating Systems

First, install Node.js (18.x recommended) from [Nodesource](https://github.com/nodesource/distributions/blob/master/README.md#debian-and-ubuntu-based-distributions).

_If you are on an unsupported version of elementary OS—i.e. during development of a new version—you may need to download the provided installation script, modify it first to map `elementaryOS` and the version codename to `Ubuntu` and its equivalent codename, then `chmod +x` the script and run it as root._

The rest can be most easily installed from Terminal on elementary OS 5.x (Ubuntu 18.04) or 6.x (Ubuntu 20.04):

```
sudo apt install php-cli php-curl php-intl php-json php-mbstring composer &&
npm ci
```

Then inside the project directory, run `npm run build && npm run start`. Next,
just navigate to [localhost:8000](http://localhost:8000/) to view the site.

If you are working on CSS and would like an easier time developing, you can run
the `npx gulp watch` command. This will watch for any CSS and image changes,
and rebuild on the fly.

#### macOS

First, make sure you have your system updated.

Second, install Node.js (18.x recommended) from [Nodejs.org](https://nodejs.org).

Then follow these directions from your favorite shell:

```
/bin/bash -c "$(curl -fsSL https://raw.githubusercontent.com/Homebrew/install/HEAD/install.sh)"
brew install php composer
npm ci
cd _backend
composer up
cd ../
npm run build && npm run start
```

Once finished, open a browser and navigate to http://localhost:8000. Enjoy!

**NOTE**: The version of PHP shipped via brew has all modules enabled by default.

### Nginx Web Server

For a full web-server environment, which includes more redirect and permissions
you may find useful, you will need:

* Everything required for "Simple PHP Server" (above)
* The latest stable version of [Nginx](http://nginx.org)
* `php8.1-fpm`

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
npm ci && npm run build
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
