/**
 * _scripts/pages/previous.js
 * Tracking for download links
 */

/* global */

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
            plausible(config.previous.title + ' ' + config.previous.version + ' Download from OS: ' + detectedOS)
            plausible(config.previous.title + ' ' + config.previous.version + ' Download from Region: ' + config.user.region)
        })
        $('.download-link.http').click(function () {
            plausible(config.previous.title + ' ' + config.previous.version + ' Download Method: HTTP')
        })
        $('.download-link.magnet').click(function () {
            plausible(config.previous.title + ' ' + config.previous.version + ' Download Method: Magnet')
        })

        console.log('Loaded previous.js')
    })
})
