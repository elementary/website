/**
 * _scripts/lib/streamsaver.js
 * Loads streamSaver from cdn address
 *
 * @exports {Promise} default - a promise of the streamSaver library, also  and web-streams-polyfill
 */

import Promise from 'core-js/fn/promise'
import Script from 'scriptjs'

export default new Promise((resolve, reject) => {
    Script('https://cdn.jsdelivr.net/g/streamsaver.js@1', () => {
        console.log('streamSaver loaded')
        return resolve(window.streamSaver)
    })
})
