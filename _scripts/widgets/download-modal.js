/**
 * _scripts/widgets/download-modal.js
 * Code for opening the download overlay widget on the homepage
 */

import modal from '~/lib/modal'

export function openDownloadOverlay () {
    modal.then(($) => {
        const $openModal = $('.open-modal')
        console.log('Open the download overlay!')
        $openModal.leanModal({
            // Add this class to download buttons to make them close it.
            closeButton: '.close-modal',
            disableCloseOnOverlayClick: true
        })
        // This is what actually opens the modal overlay.
        $openModal.click()
    })
}
