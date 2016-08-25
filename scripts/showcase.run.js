/* global Showcase Terminal */

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
    terminal.onHold = ($(window).width() <= 1050)

    $('#showcase').on('change', function (e, d) {
        if (d != null && d.active === 'showcase-terminal') {
            terminal.$w.addClass('active')
        } else {
            terminal.$w.removeClass('active')
        }
    })

    $(window).on('resize', function () {
        if ($(window).width() <= 1050) {
            if (!terminal.onHold) {
                terminal.onHold = true
            }
        } else {
            if (terminal.onHold) {
                terminal.onHold = false
            }
        }
    })

    console.log('Loaded slider.run.js')
})
