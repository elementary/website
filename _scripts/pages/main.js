/**
 * _scripts/pages/main.js
 * Loads all of the site wide snippets
 */

/* global ga */

import '~/lib/analytics'

import '~/external-links'
import '~/menu-responsive'
import '~/popover'
import '~/smooth-scrolling'
import '~/twitter-links'

// Send some analytic information on every page load
ga('send', 'pageview')
ga('send', 'event', 'Language', 'Pageload', document.documentElement.lang)
