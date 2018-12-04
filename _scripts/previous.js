/**
 * _scripts/pages/previous.js
 * Tracking for download links
 */

/* global ga */

import jQuery from '~/lib/jquery'

import config from '~/config'

Promise.all([config, jQuery]).then(([config, $]) => {
    $(document).ready(() => {
    
        // ACTION: .download-http.click: Track download over HTTP
        $('.download-link').click(function () {
            ga('send', 'event', config.previous.title + ' ' + config.previous.version + ' Download (OS)', 'Homepage', detectedOS)
            ga('send', 'event', config.previous.title + ' ' + config.previous.version + ' Download (Region)', 'Homepage', config.user.region)
        })
        $('.download-link.http').click(function () {
            ga('send', 'event', config.previous.title + ' ' + config.previous.version + ' Download (Method)', 'Homepage', 'HTTP')
        })
        $('.download-link.magnet').click(function () {
            ga('send', 'event', config.previous.title + ' ' + config.previous.version + ' Download (Method)', 'Homepage', 'Magnet')
        })

        console.log('Loaded previous.js')
    })
})
