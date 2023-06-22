/**
 * _scripts/lib/modal.js
 * Loads jQuery.leanModal2 from cdn address
 *
 * @exports {Promise} default - a promise of the jQuery with jQuery.leanModal2 loaded
 */

import Script from 'scriptjs'

import jQuery from '~/lib/jquery'

export default jQuery.then(($) => {
    return new Promise((resolve, reject) => {
        Script('https://cdn.jsdelivr.net/gh/eustasy/jQuery.leanModal2@2.6.3/jQuery.leanModal2.min.js', () => {
            console.log('jQuery.leanModal2 loaded')
            return resolve(window.jQuery)
        })
    })
})
