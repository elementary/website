/* global Showcase Terminal */

/*
 * termSwitch
 * Switches terminal with image and vise versa
 *
 * @param {Object} $c - terminal app-display__image jQuery object
 * @param {Boolean} i - true if image should be visible
 * @return {Void}
 */
var termSwitch = function ($c, i) {
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
var termLock = function (t) {
    var $c = t.$w.parents('.app-display__image')
    var w = ($(window).innerWidth() <= 1000)

    termSwitch($c, w)
    t.onHold = w
    return w
}

$(function () {
    var showcase = new Showcase({
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

    $('#showcase .showcase-tab .showcase-back').on('click', function (e) {
        e.preventDefault()
        showcase.slideTo('index')
    })

    var terminal = new Terminal()
    termLock(terminal)

    $('#showcase').on('change', function (e, d) {
        if (d != null && d.active === 'showcase-terminal') {
            termLock(terminal)
        } else {
            terminal.onHold = true
        }
    })

    $(window).on('resize', function () {
        termLock(terminal)
    })

    console.log('Loaded showcase.run.js')
})
