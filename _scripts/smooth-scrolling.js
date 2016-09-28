/**
 * _scripts/smooth-scrolling.js
 * Makes any same-page link animate instead of snapping to new point
 */

import jQuery from '~/lib/jquery'

jQuery.then(($) => {
    $(function () {
        $(document).on('click', 'a', function (event) {
            // Event already handled?
            if (event.isDefaultPrevented()) {
                return
            }

            // If no href set
            var $anchor = $(this)
            if (!$anchor.attr('href')) {
                return
            }

            // Get link href
            var href = $anchor.attr('href')
            if (href.indexOf('#') === -1) {
                return
            }

            // This handles /path/current-page#element
            href = href.split('#').pop()

            // Get offset
            var scrollTop
            if (href === '') {
                scrollTop = 0
            } else {
                var $target = $('#' + href)
                if (!$target.length) { // Anchor target not in this page
                    return
                }

                scrollTop = $target.offset().top
            }

            // Smooth scrolling
            $('html, body').stop().animate({
                scrollTop: scrollTop
            }, 'normal', function () {
                window.location.hash = href
            })

            event.preventDefault()
        })

        // Fix anchors
        // Let other scripts add links to DOM before fixing them
        setTimeout(function () {
            $('a[href^="#"]').each(function () {
                if (!$(this).hasClass('open-modal')) {
                    var href = $(this).attr('href')
                    $(this).attr('href', window.location.pathname + href)
                }
            })
        }, 0)
    })
})
