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
 * @return {String} - full url base path for website
 */
export function url () {
    if (window.location.host === 'beta.elementary.io') {
        const branch = branch()
        return `${window.location.origin}/${branch}`
    }

    return window.location.origin
}
