/**
 * _scripts/lib/highlight.js
 * Loads highlight.js from cdn address
 *
 * @exports {Promise} default - a promise of the highlight.js library
 */

import Script from 'scriptjs'

export default new Promise((resolve, reject) => {
    Script('https://cdn.jsdelivr.net/g/highlight.js@9(highlight.min.js+languages/vala.min.js)', () => {
        console.log('highlight.js loaded')
        return resolve(window.hljs)
    })
})
