/**
 * _scripts/lib/modal.js
 * Loads jQuery.leanModal2 from cdn address
 *
 * @exports {Promise} default - a promise of the jQuery with jQuery.leanModal2 loaded
 */

import Promise from 'core-js/fn/promise'
import Script from 'scriptjs'

import jQuery from './jquery'

export default jQuery.then(($) => {
    return new Promise((resolve, reject) => {
        Script('https://cdn.jsdelivr.net/g/jquery.leanmodal2@2.5', () => {
            console.log('jQuery.leanModal2 loaded')
            return resolve(window.jQuery)
        })
    })
})
