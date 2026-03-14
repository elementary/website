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
            event.stopPropagation()

            const $popover = $(event.target).closest('.popover')
            const $content = $popover.find('.popover-content')

            if ($popover.hasClass('active')) {
                $popover.removeClass('active')
                return
            }

            $popover.addClass('active')

            $content.on('scroll touchmove mousewheel wheel', function (e) {
                e.stopPropagation()
            })

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

            const arrowLeft = (popoverWidth / 2) - popoverPos
            $content[0].style.setProperty('--popover-left', popoverPos + 'px')
            $content[0].style.setProperty('--arrow-left', arrowLeft + 'px')

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
