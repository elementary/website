/**
 * _scripts/widgets/download-modal.js
 * Code for opening the download overlay widget on the homepage
 */

function detectDialogSupport () {
    return typeof document.createElement('dialog').showModal === 'function'
}

// Some browsers have styling for the native dialog element but they dont actually support it.
function swapDialogToDiv ($dialog) {
    $dialog.outerHTML = $dialog.outerHTML.replace('<dialog', '<div').replace('</dialog>', '</div>')
}

function moveToAnchor (id) {
    var originalURL = location.href
    window.location.href = window.location.href.split('#')[0] + '#' + id
    // Remove hash from URL after jumping
    window.history.replaceState(null, null, originalURL)
}

export function openDownloadOverlay () {
    var modalId = 'download-modal'
    var $downloadModal = document.getElementById(modalId)
    if (!$downloadModal) {
        return
    }
    var supportsDialog = detectDialogSupport()
    if (!supportsDialog) {
        swapDialogToDiv($downloadModal)
        moveToAnchor(modalId)
        return
    }
    $downloadModal.showModal()
    var $closeButton = $downloadModal.querySelector('.js-close-button')
    $closeButton.addEventListener('click', () => {
        $downloadModal.close()
    }, { once: true })
}
