/**
 * _scripts/pages/docs/installation.js
 * Sets up the OS dependent slider for installation guide
 */

import jQuery from '~/lib/jquery'

import Slider from '~/slider'

jQuery.then(($) => {
    $(function () {
        // Parse user-agent to detect current platform
        function detectOS () {
            const ua = window.navigator.userAgent
            if (ua.indexOf('Windows') >= 0) {
                return 'windows'
            }
            if (ua.indexOf('Mac_PowerPC') >= 0 || ua.indexOf('Macintosh') >= 0) {
                return 'macos'
            }
            if (ua.indexOf('Linux') >= 0) {
                return 'linux'
            }
            return false
        }

        // Setup sliders
        const operatingSystemSlider = new Slider({
            slideContainer: '#installation-instructions-slide-container',
            choiceContainer: '#operating-system-choices',
            slides: ['install-on-windows', 'install-on-macos', 'install-on-ubuntu'],
            fixed: false
        })

        // Show instructions for the current platform
        const currentOs = detectOS()

        if (currentOs === 'windows' || !currentOs) {
            operatingSystemSlider.slideTo('install-on-windows')
        } else if (currentOs === 'macos') {
            operatingSystemSlider.slideTo('install-on-macos')
        } else {
            operatingSystemSlider.slideTo('install-on-ubuntu')
        }
    })
})
