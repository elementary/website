$(function() {
    // Parse user-agent to detect current plateform
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
    var verifyDownloadSlider = new Slider({
        slidesContainer: 'verifying-your-download-slide-container',
        choicesContainer: 'verifying-your-download-choices-container',
        id: 'verifying-your-download-choices',
        choices: ['verifying-your-download-on-windows', 'verifying-your-download-on-os-x', 'verifying-your-download-on-linux'],
        hideHeadings: true
    });
    var createUsbSlider = new Slider({
        slidesContainer: 'creating-a-usb-choices-slide-container',
        choicesContainer: 'creating-a-usb-choices-container',
        id: 'creating-a-usb-choices',
        choices: ['creating-a-usb-on-windows', 'creating-a-usb-on-others'],
        hideHeadings: true
    });
    var bootSlider = new Slider({
        slidesContainer: 'booting-choices-slide-container',
        choicesContainer: 'booting-choices-container',
        id: 'booting-choices',
        choices: ['booting-on-a-pc', 'booting-on-a-mac'],
        hideHeadings: true
    });

    // Show instructions for the current platform
    var currentOs = detectOS();

    if (currentOs == 'windows' || !currentOs) {
        verifyDownloadSlider.slideTo('verifying-your-download-on-windows');
    } else if (currentOs == 'osx') {
        verifyDownloadSlider.slideTo('verifying-your-download-on-os-x');
    } else {
        verifyDownloadSlider.slideTo('verifying-your-download-on-linux');
    }

    if (currentOs == 'windows' || !currentOs) {
        createUsbSlider.slideTo('creating-a-usb-on-windows');
    } else {
        createUsbSlider.slideTo('creating-a-usb-on-others');
    }

    if (currentOs == 'osx') {
        bootSlider.slideTo('booting-on-a-mac');
    } else {
        bootSlider.slideTo('booting-on-a-pc');
    }

})();
