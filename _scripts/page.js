/**
 * _scripts/page.js
 * Has useful page helpers for use in other scripts
 *
 * @exports {Function} language - returns the current page language
 * @exports {Function} branch - returns the current branch
 * @exports {Function} url - returns the full root url of the site
 */

/**
 * language
 * Returns the current page language
 *
 * @return {String} - the current page language or undefined
 */
export function language () {
    return document.getElementsByTagName('html')[0].getAttribute('lang')
}

/**
 * branch
 * Returns the current branch of the website being viewed
 *
 * @return {String} - current branch name, or undefined if unable to find
 */
export function branch () {
    if (window.location.host === 'elementary.io') {
        return 'master'
    }

    if (window.location.host === 'staging.elementary.io') {
        return 'master'
    }

    if (window.location.host === 'beta.elementary.io') {
        const branch = window.location.pathname.split('/')[1]

        if (branch != null && branch !== '') {
            return branch
        }
    }

    return undefined
}

/**
 * url
 * Returns full base url of the website
 *
 * @return {String} - full url base path for website _WITHOUT_ trailing slash
 */
export function url () {
    let basePath = window.location.origin

    // For the old browsers that probably shouldn't be on the web anymore
    if (basePath == null) {
        basePath = `${window.location.protocol}//${window.location.hostname}`
        if (window.location.port) basePath = `${basePath}:${window.location.port}`
    }

    // Trim all of the crap at the end of the url
    basePath = basePath.split('#')[0]
    if (basePath[basePath.length - 1] === '/') basePath = basePath.substring(0, basePath.length - 1)

    // Ensure we fix this _one_ edge case
    if (basePath === 'https://beta.elementary.io' && branch() != null) {
        return `${basePath}/${branch()}`
    }

    return basePath
}

/**
 * detectedOS
 * Returns the OS of the user
 *
 * @return {String} - OS of the user
 */
export function detectedOS () {
    const ua = window.navigator.userAgent
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
