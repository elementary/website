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

    return basePath
}

/**
 * detectedArchitecture
 * Returns the architecture of the user's device using User-Agent Client Hints API
 *
 * @return {Promise<String>} - Architecture of the user (ARM or x86)
 */
export async function detectedArchitecture () {
    // Try to use the modern User-Agent Client Hints API first
    if (navigator.userAgentData && navigator.userAgentData.getHighEntropyValues) {
        try {
            const values = await navigator.userAgentData.getHighEntropyValues(['architecture', 'bitness', 'platform'])
            
            if (values.architecture) {
                const arch = values.architecture.toLowerCase()
                if (arch.indexOf('arm') >= 0) {
                    return 'ARM'
                }
                if (arch.indexOf('x86') >= 0) {
                    return 'x86'
                }
            }
        } catch (e) {
            // Fall through to legacy detection
        }
    }
    
    // Fallback to legacy user agent parsing
    const ua = window.navigator.userAgent
    if (ua == null || ua === false) return 'Unknown'
    
    // Check for ARM indicators in user agent
    if (ua.indexOf('ARM') >= 0 || ua.indexOf('aarch64') >= 0 || ua.indexOf('arm64') >= 0) {
        return 'ARM'
    }
    
    // Check for x86/x64 indicators
    if (ua.indexOf('x86') >= 0 || ua.indexOf('x64') >= 0 || ua.indexOf('WOW64') >= 0 || ua.indexOf('Win64') >= 0 || ua.indexOf('Intel Mac') >= 0) {
        return 'x86'
    }
    
    // Additional platform checks
    if (navigator.platform) {
        const platform = navigator.platform.toLowerCase()
        if (platform.indexOf('arm') >= 0 || platform.indexOf('aarch') >= 0) {
            return 'ARM'
        }
        if (platform.indexOf('x86') >= 0 || platform.indexOf('win') >= 0 || platform.indexOf('mac') >= 0 || platform.indexOf('linux') >= 0) {
            return 'x86'
        }
    }
    
    return 'Unknown'
}
