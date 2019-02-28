/**
 * _scripts/pages/previous.js
 * Tracking for download links
 */

/* global ga */

import jQuery from '~/lib/jquery'

import config from '~/config'

Promise.all([config, jQuery]).then(([config, $]) => {
    $(document).ready(() => {
        // UTILITY: detectOS: Detect the OS
        function detectOS () {
            var ua = window.navigator.userAgent
            if (ua == null || ua === false) return 'Other'
            if (ua.indexOf('Android') >= 0) {
                return 'Android'
            }
            if (ua.indexOf('Mac OS X') >= 0 && ua.indexOf('Mobile') >= 0) {
                return 'iOS'
            }
            if (ua.indexOf('Windows') >= 0) {
                return 'Windows'
            }
            if (ua.indexOf('Mac_PowerPC') >= 0 || ua.indexOf('Macintosh') >= 0) {
                return 'macOS'
            }
            if (ua.indexOf('Linux') >= 0) {
                return 'Linux'
            }
            return 'Unknown'
        }
        var detectedOS = detectOS()

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
