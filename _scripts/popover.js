/**
 * _scripts/popover.js
 * Creates a popover to show more information
 */

import jQuery from '~/lib/jquery'

jQuery.then(($) => {
    $(function () {
        const $document = $(document)

        $document.on('click', '.popover > a', function (event) {
            event.preventDefault()

            const $body = $('body')
            const $link = $(event.target)
            const $popover = $link.parent()
            const $content = $popover.find('.popover-content')

            $body.css({ overflow: 'hidden' })

            $popover.addClass('active')

            $content.on('scroll touchmove mousewheel wheel', function (e) {
                e.stopPropagation()
            })

            const popoverPos = ($popover.outerWidth() / 2) - ($content.outerWidth() / 2)
            $content.css({ left: popoverPos })

            $document.one('click scroll touchmove mousewheel wheel', function (event) {
                if (!$(event.target).is('.popover-content *')) {
                    event.stopImmediatePropagation()
                    event.preventDefault()
                }

                $body.css({ overflow: 'visible' })

                $popover.removeClass('active')
                $body.click()
            })
        })
    })
})
