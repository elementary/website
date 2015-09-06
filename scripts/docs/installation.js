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
<<<<<<< HEAD
    var createUsbSlider = new Slider({
        slidesContainer: 'creating-a-usb-choices-slide-container',
        choicesContainer: 'creating-a-usb-choices-container',
        id: 'creating-a-usb-choices',
        choices: ['creating-a-usb-on-windows', 'creating-a-usb-on-osx', 'creating-a-usb-on-linux'],
        hideHeadings: true
    });
    var bootSlider = new Slider({
        slidesContainer: 'booting-choices-slide-container',
        choicesContainer: 'booting-choices-container',
        id: 'booting-choices',
        choices: ['booting-on-a-pc', 'booting-on-a-mac'],
        hideHeadings: true
=======
    var operatingSystemSlider = new Slider({
        slidesContainer: 'installation-instructions-slide-container',
        choicesContainer: 'operating-system-choices-container',
        id: 'operating-system-choices',
        choices: ['install-on-windows', 'install-on-os-x', 'install-on-ubuntu'],
        hideHeadings: false
>>>>>>> elementary/master
    });

    // Show instructions for the current platform
    var currentOs = detectOS();
<<<<<<< HEAD
    if (currentOs == 'windows' || !currentOs) {
        createUsbSlider.slideTo('creating-a-usb-on-windows');
    } else if (currentOs == 'osx') {
        createUsbSlider.slideTo('creating-a-usb-on-osx');
    } else {
        createUsbSlider.slideTo('creating-a-usb-on-linux');
    }
=======
>>>>>>> elementary/master

    if (currentOs == 'windows' || !currentOs) {
        operatingSystemSlider.slideTo('install-on-windows');
    } else if (currentOs == 'osx') {
        operatingSystemSlider.slideTo('install-on-os-x');
    } else {
        operatingSystemSlider.slideTo('install-on-ubuntu');
    }
});
