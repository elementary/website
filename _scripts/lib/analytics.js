/**
 * _scripts/lib/analytics.js
 * Loads Google analytics from cdn address
 */

import Script from 'scriptjs'

import config from '~/config'

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

config.then((config) => {
    if (!config.user.trackme) {
        console.log('Google analytics not loaded due to trackme config')
    }

    Script('https://www.google-analytics.com/analytics.js', () => {
        console.log('Google analytics loaded')
    })
})
