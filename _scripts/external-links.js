/**
 * _scripts/external-links.js
 * Adds '_blank' to all external links
 */

import jQuery from '~/lib/jquery'

jQuery.then(($) => {
    $(function () {
        $('a').not('[href*="mailto:"], [href*="magnet:"]').each(function () {
            var href = this.href
            if (href.indexOf(window.location.host) === -1) {
                $(this).attr('target', '_blank')
            }
        })
    })
})
