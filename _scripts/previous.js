/**
 * _scripts/pages/previous.js
 * Tracking for download links
 */

/* global plausible */

import jQuery from '~/lib/jquery'

import config from '~/config'
import detectedOS from '~/widgets/detectedos'

Promise.all([config, jQuery]).then(([config, $]) => {
    $(document).ready(() => {
        // ACTION: .download-http.click: Track download over HTTP
        $('.download-link').click(function () {
            if ( $(this).hasClass('http') ) {
                var method = 'HTTP'
            }
            if ( $(this).hasClass('magnet') ) {
                var method = 'Magnet'
            }
            plausible('Downloads', {meta: {
                Region: config.user.region,
                Method: method,
                OS: detectedOS,
                Version: config.previous.version
            }})
        })
        console.log('Loaded previous.js')
    })
})
