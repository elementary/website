/**
 * _scripts/developer.js
 * Loki beta download hero
 */

/* global ga releaseTitle releaseVersion */

import jQuery from 'lib/jquery'

jQuery.then(($) => {
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
})
