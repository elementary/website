/**
 * _scripts/lib/webtorrent.js
 * Loads WebTorrent from cdn address
 *
 * @exports {Promise} default - a promise of the WebTorrent library
 */

import Promise from 'core-js/fn/promise'
import Script from 'scriptjs'

export default new Promise((resolve, reject) => {
    Script('https://cdn.jsdelivr.net/g/webtorrent@0.98.3', () => {
        console.log('WebTorrent loaded')
        return resolve(window.WebTorrent)
    })
})
