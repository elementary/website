/**
 * _scripts/lib/chart.js
 * Loads Chart.js from cdn address
 *
 * @exports {Promise} default - a promise of the Chart.js library
 */

import Script from 'scriptjs'

export default new Promise((resolve, reject) => {
    Script('https://cdn.jsdelivr.net/gh/nnnick/Chart.js@2/dist/Chart.min.js', () => {
        console.log('Chart.js loaded')
        return resolve(window.Chart)
    })
})
