/**
 * _scripts/lib/analytics.js
 * Loads Google analitics from cdn address
 *
 * @exports {Promise} default - a promise of the Google analitics library
 */

import Promise from 'core-js/fn/promise'
import Script from 'scriptjs'

import config from '~/config'

export default config.then((config) => {
    return new Promise((resolve, reject) => {
        if (!config.user.trackme) {
            console.log('Google analitics not loaded due to trackme config')

            return resolve((...args) => {
                console.log('Google analytics disabled. Logging to console instead')
                console.log(args)
            })
        }

        Script('https://www.google-analytics.com/analytics.js', () => {
            console.log('Google analitics loaded')

            window.ga('create', 'UA-19280770-1', 'auto')
            window.ga('set', 'forceSSL', true)
            window.ga('set', 'anonymizeIp', true)
            window.ga('require', 'displayfeatures')

            return resolve(window.ga)
        })
    })
})
