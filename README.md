The New elementary.io
================


TESTING this shit again

A focused, minimum viable product (hence MVP) for a website that accompanied the release of elementary OS Freya.

Project Organization
====================

* **Issues** for individual actionable items, or bugs i.e.:
  * Design home page
  * Implement home page
  * Add payment form
  * Fix link to Wired article
* **Milestones** for "releases" or overall steps, i.e.:
  * Single-page site
  * User Documentation
  * Journal
* **Reviews** Do all work in branches, then submit pull requests for review when ready
  * No dummy content in master, ever.
  * small diff is best diff
  * The reviewer is the gatekeeper. Be kind of a dick.


Architecture/Philosophies
=========================

* HTML, CSS, and JS
* Super simple PHP-based templating system
* No/minimal frameworks (keep it simple!)
* Graceful degradation (don't be held back by crappy browsers)
* Mobile-first


Templating System
=================

* PHP-based
* Pages go in root as .php files
* Include `_templates/sitewide.php`, set any variables, then `include $template['header'];` (see [code-of-conduct](https://github.com/elementary/mvp/blob/master/code-of-conduct.php) for an example) at top of page.
* `include $template['footer'];` at bottom of page.
* Page variables:
  * `$page['title']`
  * `$page['description']`
  * `$page['author']`


Code Style
==========

It's important we keep the code style consistent across collaborators and editors. We are following the official [elementary code style](http://elementaryos.org/docs/code/code-style) guidelines for this project.

For quick reference:
* 4 spaces for indentation (no tabs)
* Comma-separated CSS rules on separate lines
* Strip extra whitespace (on blank lines and ends of lines)


Simple Local Development
========================

For simplicity a Vagrant file is included. To start you will need:

* [Vagrant](http://www.vagrantup.com/downloads.html)
* [VirtualBox](https://www.virtualbox.org/wiki/Linux_Downloads)

Then simply run `vagrant up`.

For bypassing Vagrant you will need:

* [A supported version of PHP](http://php.net/supported-versions.php)
* `php5-json`
* `php5-curl`

Then inside the project directory, run `php -S localhost:8000 router.php`. Next, just navigate to http://localhost:8000/ to view the site.

Contributing
============

See guidelines for [coding](https://github.com/elementary/mvp/blob/master/CONTRIBUTING.md) and [translating](https://github.com/elementary/mvp/blob/master/TRANSLATE.md).
