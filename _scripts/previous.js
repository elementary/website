/**
 * _scripts/pages/previous.js
 * Tracking for download links
 */

/* global plausible */

import jQuery from '~/lib/jquery'

import config from '~/config'
import { detectedArchitecture } from '~/page'

Promise.all([config, jQuery]).then(([config, $]) => {
    $(document).ready(() => {
        // ACTION: .download-http.click: Track download over HTTP
        $('.download-link').click(async function () {
            let downloadMethod = 'Unknown'
            if ($(this).hasClass('magnet')) {
                downloadMethod = 'Magnet'
            }
            if ($(this).hasClass('http')) {
                downloadMethod = 'HTTP'
            }
            plausible('Download', {
                props: {
                    Region: config.user.region,
                    Method: downloadMethod,
                    Architecture: await detectedArchitecture(),
                    Version: config.previous.version
                }
            })
        })
        console.log('Loaded previous.js')
    })
})
