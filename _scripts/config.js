/**
 * _scripts/config.js
 * Loads site configuration for api endpoint
 *
 * @exports {Promise} default - a promise of the site configuration
 */

import Promise from 'core-js/fn/promise'

import jQuery from '~/lib/jquery'

export default jQuery.then(($) => {
    let configPath = '/api/config'

    if (window.location.host === 'beta.elementary.io') {
        const branch = window.location.pathname.split('/')[1]

        if (branch == null || branch === '') {
            console.error('Unable to determine branch name')
        } else {
            configPath = `/${branch}/api/config`
        }
    }

    return new Promise((resolve, reject) => {
        $.getJSON(configPath)
        .done((config) => {
            console.log('Sitewide configuration loaded')
            return resolve(config)
        })
        .fail((jqxhr, status, err) => {
            console.error(`Failed to grab sitewide configuration with ${status}`)
            console.error(err)
            return reject(err)
        })
    })
})
