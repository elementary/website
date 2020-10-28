// UTILITY: detectOS: Detect the OS
function detectOS () {
    var ua = window.navigator.userAgent
    if (ua == null || ua === false) return 'Other'
    if (ua.indexOf('Android') >= 0) {
        return 'Android'
    }
    if (ua.indexOf('Mac OS X') >= 0 && ua.indexOf('Mobile') >= 0) {
        return 'iOS'
    }
    if (ua.indexOf('Windows') >= 0) {
        return 'Windows'
    }
    if (ua.indexOf('Mac_PowerPC') >= 0 || ua.indexOf('Macintosh') >= 0) {
        return 'macOS'
    }
    if (ua.indexOf('Linux') >= 0) {
        return 'Linux'
    }
    return 'Unknown'
}
var detectedOS = detectOS()
