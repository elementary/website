/**
 * _scripts/lib/stripe.js
 * Loads stripe from official Stripe url
 *
 * @exports {Promise} default - a promise of the Stripe Checkout library
 */

import Script from 'scriptjs'

export default new Promise((resolve, reject) => {
    Script('https://checkout.stripe.com/checkout.js', () => {
        console.log('Stripe loaded')
        return resolve(window.StripeCheckout)
    })
})
