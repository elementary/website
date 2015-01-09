elementaryos.org
================

Let's focus on getting the minimum viable product for our website up and running for the release of Freya.

We'll attack it in various phases:

1. A single-page site to download Freya
2. FAQ/User Docs
3. A Journal (possibly a link to Tumblr)


Project organization
====================

Up for discussion in Slack, but here's how Cassidy James has it in his head:

* **Issues** for individual actionable items, or bugs i.e.:
  * Design home page
  * Implement home page
  * Add payment form
  * Fix link to Wired article
* **Milestones** for "releases" or overall steps, i.e.:
  * Single-page site
  * User Documentation
  * Journal
* Do all work in branches, then submit pull requests for review when ready

Architecture/Philosophies
=========================

* HTML, CSS, and JS
* No/minimal frameworks (keep it simple!)
* Graceful degradation (don't be held back by crappy browsers)
* Mobile-first
