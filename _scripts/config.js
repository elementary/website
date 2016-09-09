/**
 * _scripts/config.js
 * Loads site configuration for api endpoint
 *
 * @exports {Promise} default - a promise of the site configuration
 */

import Promise from 'core-js/fn/promise'

import jQuery from '~/lib/jquery'

export default jQuery.then(($) => {
    return new Promise((resolve, reject) => {
        $.ajax({
            url: 'api/config',
            dataType: 'json'
        })
        .done((config) => {
            return resolve(config)
        })
        .fail((err) => {
            return reject(err)
        })
    })
})
