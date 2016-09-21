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
            console.log('Google analytics not loaded due to trackme config')

            return resolve((...args) => {
                console.log('Google analytics disabled. Logging to console instead')
                console.log(args)
            })
        }

        Script('https://www.google-analytics.com/analytics.js', () => {
            console.log('Google analytics loaded')
        })

        try {
            window['GoogleAnalyticsObject'] = 'ga'
            window['ga'] = window['ga'] || function (...args) {
                window['ga'].q = window['ga'].q || []
                window['ga'].q.push(args)
            }
            window['ga'].l = 1 * new Date()

            window.ga('create', 'UA-19280770-1', 'auto')
            window.ga('set', 'forceSSL', true)
            window.ga('set', 'anonymizeIp', true)
            window.ga('require', 'displayfeatures')
        } catch (err) {
            console.error('Unable to setup Google analytics. Probably getting blocked.')
            console.error(err)

            return resolve((...args) => {
                console.log('Google analytics errored during setup. Logging to console instead')
                console.log(args)
            })
        }

        return resolve(window.ga)
    })
})
