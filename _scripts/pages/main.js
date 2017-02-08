/**
 * _scripts/pages/main.js
 * Loads all of the site wide snippets
 */

import analytics from '~/lib/analytics'
import jQuery from '~/lib/jquery'

import '~/external-links'
import '~/popover'
import '~/smooth-scrolling'
import '~/twitter-links'

// Send some analytic information on every page load
analytics.then((ga) => {
    ga('send', 'pageview')
    ga('send', 'event', 'Language', 'Pageload', document.documentElement.lang)
})

jQuery.then(($) => {
    $('.toast__close').on('click', function (e) {
        $(this).closest('.toast').hide()
    })
})
