The New elementary.io
================

[![CI](https://github.com/elementary/website/actions/workflows/ci.yml/badge.svg)](https://github.com/elementary/website/actions/workflows/ci.yml)
[![Translation status](https://l10n.elementaryos.org/widgets/website/-/svg-badge.svg)](https://l10n.elementaryos.org/engage/website/?utm_source=widget)

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
  * No dummy content in main, ever.
  * Small diff is best diff.
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
* `require_once '_backend/preload.php';`, set any variables, then `include $template['header'];` (see [code-of-conduct](https://github.com/elementary/website/blob/main/code-of-conduct.php) for an example) at top of page.
* `include $template['footer'];` at bottom of page.
* Page variables:
  * `$page['title']`
  * `$page['description']`
  * `$page['author']`

Contributing
============

See guidelines for [coding](https://github.com/elementary/website/blob/main/.github/CONTRIBUTING.md) and [translating](https://github.com/elementary/website/blob/main/TRANSLATE.md).

Security
========

Please see [SECURITY.md](./SECURITY.md) for information about disclosure policy and contact.

License
=======

This project has a [MIT license](LICENSE.md).
