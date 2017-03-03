/**
 * _scripts/config.js
 * Loads site configuration for api endpoint
 *
 * @exports {Promise} default - a promise of the site configuration
 */

import { url } from '~/page'
import jQuery from '~/lib/jquery'

export default jQuery.then(($) => {
    const basePath = url()
    const configPath = `${basePath}/api/config`

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
