/**
 * _scripts/pages/main.js
 * Loads all of the site wide snippets
 */

/* global ga */

import { url } from '~/page'
import jQuery from '~/lib/jquery'

import '~/lib/analytics'

import '~/external-links'
import '~/popover'
import '~/smooth-scrolling'
import '~/twitter-links'

// Send some analytic information on every page load
ga('send', 'pageview')
ga('send', 'event', 'Language', 'Pageload', document.documentElement.lang)

/**
 * indiegogo appcenter 2/17 event toast
 * TODO: generalize and make reusable for all events
 */
jQuery.then(($) => {
    $('.toast__close').on('click', function (e) {
        const $overlay = $(this).closest('.overlay')

        $overlay.animate({
            top: '-10px',
            opacity: 0
        }, 120, 'linear', () => $overlay.hide())

        const data = {
            type: 'event',
            attributes: {
                event: 'indiegogo appcenter 2/17',
                value: 1
            }
        }

        $.ajax({
            type: 'POST',
            url: `${url()}/api/event`,
            data: JSON.stringify({ data }),
            contentType: 'application/json',
            dataType: 'json'
        })
    })
})
