/**
 * _scripts/pages/showcase.run.js
 * Loads the homepage showcase and other related widgets
 */

import jQuery from '~/lib/jquery'

import Showcase from '~/widgets/showcase'
import Terminal from '~/widgets/pantheon/terminal'

jQuery.then(($) => {
    /*
     * termSwitch
     * Switches terminal with image and vise versa
     *
     * @param {Object} $c - terminal app-display__image jQuery object
     * @param {Boolean} i - true if image should be visible
     * @return {Void}
     */
    const termSwitch = ($c, i) => {
        if (i) {
            $('.pantheon', $c).hide()
            $('.pantheon--fallback', $c).show()
        } else {
            $('.pantheon--fallback', $c).hide()
            $('.pantheon', $c).show()
        }
    }

    /**
     * termLock
     * Determins if the terminal will be locked and switches if needed
     *
     * @param {Terminal} t - terminal class
     * @return {Boolean} - true if terminal image is shown, false if interactive
     */
    const termLock = (t) => {
        var $c = t.$w.parents('.app-display__image')
        var w = ($(window).innerWidth() <= 1000)

        termSwitch($c, w)
        t.onHold = w
        return w
    }

    $(document).ready(() => {
        const showcase = new Showcase({
            container: '#showcase',
            index: '#showcase-index',
            slides: [
                'showcase-music',
                'showcase-epiphany',
                'showcase-mail',
                'showcase-photos',
                'showcase-videos',
                'showcase-calendar',
                'showcase-files',
                'showcase-terminal',
                'showcase-scratch',
                'showcase-camera'
            ],
            fixed: false
        })
        showcase.start()

        $('#showcase .showcase-tab .showcase-back').on('click', (e) => {
            e.preventDefault()
            showcase.slideTo('index')
        })

        const terminal = new Terminal()
        terminal.start()
        termLock(terminal)

        $('#showcase').on('change', (e, d) => {
            if (d != null && d.active === 'showcase-terminal') {
                termLock(terminal)
            } else {
                terminal.onHold = true
            }
        })

        $(window).on('resize', () => termLock(terminal))

        console.log('Loaded showcase.run.js')
    })
})
