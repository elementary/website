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

            // Stop propagation so this click doesn't immediately trigger
            // the document-level close handler registered below
            event.stopPropagation()

            const $popover = $(event.target).closest('.popover')
            const $content = $popover.find('.popover-content')

            if ($popover.hasClass('active')) {
                $popover.removeClass('active')
                return
            }

            $popover.addClass('active')

            // Prevent scroll events inside the popover content from
            // bubbling up to the document close handler
            $content.on('scroll touchmove mousewheel wheel', function (e) {
                e.stopPropagation()
            })

            // Position the popover centered on its trigger, then clamp it
            // within the viewport so it doesn't cause horizontal overflow
            const popoverWidth = $popover.outerWidth()
            const contentWidth = $content.outerWidth()
            let popoverPos = (popoverWidth / 2) - (contentWidth / 2)

            const popoverRect = $popover[0].getBoundingClientRect()
            const contentRight = popoverRect.left + popoverPos + contentWidth
            const viewportWidth = document.documentElement.clientWidth

            if (contentRight > viewportWidth) {
                popoverPos -= (contentRight - viewportWidth)
            }

            const contentLeft = popoverRect.left + popoverPos
            if (contentLeft < 0) {
                popoverPos -= contentLeft
            }

            // Move the arrow to stay aligned with the trigger button,
            // compensating for how far the content was shifted
            const arrowLeft = (popoverWidth / 2) - popoverPos
            $content[0].style.setProperty('--popover-left', popoverPos + 'px')
            $content[0].style.setProperty('--arrow-left', arrowLeft + 'px')

            // Close when the user interacts outside the popover content.
            // Uses namespaced events so we can cleanly unbind them all at once
            $document.on('click.popover scroll.popover touchmove.popover', function (e) {
                if ($(e.target).closest('.popover-content').length) {
                    return
                }

                $popover.removeClass('active')
                $document.off('.popover')
            })
        })
    })
})
