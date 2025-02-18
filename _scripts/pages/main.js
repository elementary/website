/**
 * _scripts/pages/main.js
 * Loads all of the site wide snippets
 */

import jQuery from '~/lib/jquery'

import '~/external-links'
import '~/popover'
import '~/smooth-scrolling'

jQuery.then(($) => {
    // Show toasts that haven't been dismissed.
    $('.toast').each((i, toast) => {
        const hasBeenDismissed = window.localStorage.getItem('toast-dismissed-' + $(toast).attr('id'))
        if (!hasBeenDismissed) {
            $(toast).css('display', 'inline-flex')
        }
    })

    $('.toast__close').on('click', function (e) {
        const toast = $(this).closest('.toast')
        $(toast).hide()
        window.localStorage.setItem('toast-dismissed-' + $(toast).attr('id'), '1')
    })

    const menuButton = $('nav .menu-button')
    menuButton.addClass('enabled')
    menuButton.on('click', function (e) {
        if (menuButton.attr('aria-expanded') === 'true') {
            menuButton.attr('aria-expanded', 'false')
        } else {
            menuButton.attr('aria-expanded', 'true')
        }
    })
})
