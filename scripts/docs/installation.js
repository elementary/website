$(function() {
    // Parse user-agent to detect current platform
    function detectOS() {
        var ua = window.navigator.userAgent;
        if (ua.indexOf('Windows') >= 0) {
            return 'windows';
        }
        if (ua.indexOf('Mac_PowerPC') >= 0 || ua.indexOf('Macintosh') >= 0) {
            return 'osx';
        }
        if (ua.indexOf('Linux') >= 0) {
            return 'linux';
        }
        return false;
    }

    // Setup sliders
    var operatingSystemSlider = new Slider({
        slidesContainer: 'installation-instructions-slide-container',
        choicesContainer: 'operating-system-choices-container',
        id: 'operating-system-choices',
        choices: ['install-on-windows', 'install-on-os-x', 'install-on-ubuntu'],
        hideHeadings: false
    });

    // Show instructions for the current platform
    var currentOs = detectOS();

    if (currentOs == 'windows' || !currentOs) {
        operatingSystemSlider.slideTo('install-on-windows');
    } else if (currentOs == 'osx') {
        operatingSystemSlider.slideTo('install-on-os-x');
    } else {
        operatingSystemSlider.slideTo('install-on-ubuntu');
    }
})();
