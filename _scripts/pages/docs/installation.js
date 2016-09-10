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
            var ua = window.navigator.userAgent
            if (ua.indexOf('Windows') >= 0) {
                return 'windows'
            }
            if (ua.indexOf('Mac_PowerPC') >= 0 || ua.indexOf('Macintosh') >= 0) {
                return 'osx'
            }
            if (ua.indexOf('Linux') >= 0) {
                return 'linux'
            }
            return false
        }

        // Setup sliders
        var operatingSystemSlider = new Slider({
            slideContainer: '#installation-instructions-slide-container',
            choiceContainer: '#operating-system-choices',
            slides: ['install-on-windows', 'install-on-os-x', 'install-on-ubuntu'],
            fixed: false
        })

        // Show instructions for the current platform
        var currentOs = detectOS()

        if (currentOs === 'windows' || !currentOs) {
            operatingSystemSlider.slideTo('install-on-windows')
        } else if (currentOs === 'osx') {
            operatingSystemSlider.slideTo('install-on-os-x')
        } else {
            operatingSystemSlider.slideTo('install-on-ubuntu')
        }
    })
})
