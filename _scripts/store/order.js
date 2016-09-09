/**
 * scripts/store/order.js
 * Sends a nalytics notification on store order
 */

import analytics from 'lib/analytics'

analytics.then((ga) => {
    ga('send', 'event', 'Store', 'Order Completion')
})
