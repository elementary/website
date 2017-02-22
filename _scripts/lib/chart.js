/**
 * _scripts/lib/chart.js
 * Loads Chart.js from cdn address
 *
 * @exports {Promise} default - a promise of the Chart.js library
 */

import Script from 'scriptjs'

export default new Promise((resolve, reject) => {
    Script('https://cdn.jsdelivr.net/g/chart.js@2.2.1', () => {
        console.log('Chart.js loaded')
        return resolve(window.Chart)
    })
})
