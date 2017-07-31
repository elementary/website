/**
 * _scripts/lib/analytics.js
 * Loads Google analytics from cdn address
 *
 * @exports {Promise} default - a promise of the Google analytics library
 */

import Script from 'scriptjs'

import config from '~/config'

/**
 * timeoutDelay
 * A hard set time we wait for Google analytics before returning fallbackLogger
 *
 * @var {number}
 */
const timeoutDelay = 5000 // 5 Seconds

/**
 * fallbackLogger
 * The function we use for analytics if we can't contact Google.
 *
 * @param {...*} args
 * @return {void}
 */
const fallbackLogger = (...args) => {
    console.log('Google analytics disabled. Logging to console instead')
    console.log(args)
}

export default config.then((config) => {
    return new Promise((resolve, reject) => {
        if (!config.user.trackme) {
            console.log('Google analytics not loaded due to trackme config')
            return resolve(fallbackLogger)
        }

        try {
            window['GoogleAnalyticsObject'] = 'ga'
            window['ga'] = window['ga'] || function (...args) {
                window['ga'].q = window['ga'].q || []
                window['ga'].q.push(args)
            }
            window['ga'].l = 1 * new Date()
            console.log('Google analytics pre-load catch set')

            window.ga('create', 'UA-19280770-1', 'auto')
            window.ga('set', 'forceSSL', true)
            window.ga('set', 'anonymizeIp', true)
            window.ga('require', 'displayfeatures')

            Script('https://www.google-analytics.com/analytics.js', () => {
                console.log('Google analytics loaded')
            })
        } catch (e) {
            console.log('Unable to load Google analytics. It\'s probably being blocked.')
            return resolve(fallbackLogger)
        }

        setTimeout(() => {
            console.log('Google analytics timeout. It\'s probably being blocked.')
            return resolve(fallbackLogger)
        }, timeoutDelay)
    })
})
