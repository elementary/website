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
    window.ga('send', 'pageview')
    window.ga('send', 'event', 'Language', 'Pageload', document.documentElement.lang)
})
