/**
 * _scripts/pages/previous.js
 * Tracking for download links
 */

/* global plausible */

import jQuery from '~/lib/jquery'

import config from '~/config'
import { detectedArchitecture } from '~/page'

// Pre-fetch architecture detection so it's ready before any click event fires
const architecturePromise = detectedArchitecture()

Promise.all([config, jQuery]).then(([config, $]) => {
    $(document).ready(() => {
        // ACTION: .download-http.click: Track download over HTTP
        $('.download-link').click(function () {
            const $this = $(this)
            let downloadMethod = 'Unknown'
            if ($this.hasClass('magnet')) {
                downloadMethod = 'Magnet'
            }
            if ($this.hasClass('http')) {
                downloadMethod = 'HTTP'
            }
            architecturePromise.then(function (architecture) {
                plausible('Download', {
                    props: {
                        Region: config.user.region,
                        Method: downloadMethod,
                        Architecture: architecture,
                        Version: config.previous.version
                    }
                })
            })
        })
        console.log('Loaded previous.js')
    })
})
