/**
 * _scripts/widgets/payment.js
 * Handles transactions to Stripe
 *
 * @exports {Class} default - A purchase class for Stripe transactions
 */

import Promise from 'core-js/fn/promise'

import { language } from '~/page'
import config from '~/config'
import Stripe from '~/lib/stripe'

// Run the promises right on load
const configPromise = config.then((c) => c)
const stripePromise = Stripe.then((s) => s)

// All two letter langauge codes that Stripe currently supports
const supportedLanguages = [
    'da',
    'de',
    'en',
    'es',
    'fi',
    'fr',
    'it',
    'ja',
    'nl',
    'no',
    'sv',
    'zh'
]

export default class Payment {

    /**
     * Payment
     * Creates a new Payment class
     *
     * @param {String} desc - payment description
     */
    constructor (desc) {
        this.description = desc

        // This is used to store user details passed to Stripe, like an email
        // address or phone number.
        this.user = {}
    }

    /**
     * get language
     * Finds the stripe locale setting
     *
     * @return {String} - two letter language code, or 'auto'
     */
    get language () {
        let htmlLanguage = language()
        if (htmlLanguage == null) htmlLanguage = ''

        if (htmlLanguage.length > 2) {
            htmlLanguage = htmlLanguage.substring(0, 2)
        }

        if (supportedLanguages.indexOf(htmlLanguage) !== -1) {
            return htmlLanguage
        } else {
            return 'auto'
        }
    }

    /**
     * checkout
     * Opens the Stripe checkout dialog
     *
     * @param {Number} amount - the payment amount
     * @param {String} currency - Three letter currency code
     * @returns {Promise} - a promise of token information
     */
    checkout (amount, currency) {
        return Promise.all([configPromise, stripePromise])
        .then(([config, stripe]) => {
            return new Promise((resolve) => {
                stripe.open(Object.assign(this.user, {
                    token: (token, opts) => resolve([token, opts]),

                    key: config.keys.stripe,
                    name: 'elementary LLC.',
                    description: this.description,
                    locale: this.language,

                    bitcoin: true,
                    alipay: false,

                    currency,
                    amount
                }))
            })
        })
    }
}
