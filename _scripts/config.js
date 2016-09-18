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
            console.log('Sitewide configuration loaded')
            return resolve(config)
        })
        .fail((err) => {
            console.error('Failed to grab sitewide configuration')
            console.error(err.responseText)
            return reject(err)
        })
    })
})
