/**
 * _scripts/pages/previous.js
 * Tracking for download links
 */

/* global plausible */

import jQuery from '~/lib/jquery'

import config from '~/config'

Promise.all([config, jQuery]).then(([config, $]) => {
    $(document).ready(() => {
        // ACTION: .download-http.click: Track download over HTTP
        $('.download-link').click(function () {
            plausible('Download of Previous Version')
            plausible('Download of ' + config.previous.title + ' ' + config.previous.version)
        })
        console.log('Loaded previous.js')
    })
})
