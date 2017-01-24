/**
 * _scripts/lib/web-streams-polyfill.js
 * Loads web-streams-polyfill from cdn address
 *
 * @exports {Promise} default - a promise of the web-streams-polyfill library
 */

import Promise from 'core-js/fn/promise'
import Script from 'scriptjs'

export default new Promise((resolve, reject) => {
    Script('https://cdn.jsdelivr.net/g/web-streams-polyfill@1.1.0', () => {
        console.log('web-streams-polyfill loaded')
        return resolve(window.ReadableStream)
    })
})
