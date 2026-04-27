/**
 * _scripts/pages/payment-complete.js
 * Shows the download overlay when loaded, used for post-payment
 */

import jQuery from '~/lib/jquery'
import { openDownloadOverlay } from '~/widgets/download-modal'

/* eslint-disable promise/catch-or-return */
Promise.all([jQuery, openDownloadOverlay]).then(([$, openDownloadOverlay]) => {
    $(document).ready(() => {
        openDownloadOverlay()
    })
})
