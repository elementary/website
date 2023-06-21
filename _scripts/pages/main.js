/**
 * _scripts/pages/main.js
 * Loads all of the site wide snippets
 */

import jQuery from '~/lib/jquery'

import '~/external-links'
import '~/popover'
import '~/smooth-scrolling'

jQuery.then(($) => {
    $('.toast__close').on('click', function (e) {
        $(this).closest('.toast').hide()
    })
})
