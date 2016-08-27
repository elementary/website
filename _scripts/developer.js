/* global ga releaseTitle releaseVersion */

/**
 * Loki beta download hero
 */

$(function () {
    $('#download').bind('click', function (e) {
        e.preventDefault()
        $('.open-modal').leanModal({
            closeButton: '.close-modal'
        })
        $('.open-modal').click()
    })

    $('#download-modal a.suggested-action').click(function () {
        if (window.ga) {
            ga('send', 'event', releaseTitle + ' ' + releaseVersion + ' Download (Beta)', 'Developer')
        }
    })
})
