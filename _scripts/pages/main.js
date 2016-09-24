/**
 * _scripts/pages/main.js
 * Loads all of the site wide snippets
 */

import analytics from '~/lib/analytics'

import '~/external-links'
import '~/popover'
import '~/smooth-scrolling'
import '~/twitter-links'

// Send some analytic information on every page load
analytics.then((ga) => {
    ga('send', 'pageview')
    ga('send', 'event', 'Language', 'Pageload', document.documentElement.lang)
    ga('send', 'event', 'Protocol', 'Pageload', document.location.protocol)
})
