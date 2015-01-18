The new elementaryos.org
================

We're focusing on getting the minimum viable product for our website up and running for the release of Freya. To start, we're just getting a single-page download site ready for Freya. From there we will expand to a small number of pages as needed.


Project organization
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
* Include `_templates/sitewide.php`, set any variables, then include `_templates/header.php` (see [code-of-conduct](https://github.com/elementary/mvp/blob/master/code-of-conduct.php) for an example) at top of page.
* Include `_templates/footer.html` at bottom of page.
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
