/**
 * scripts/pages/store/order.js
 * Sends analytics notification on store order
 */

/* global ga plausible */

ga('send', 'event', 'Store', 'Order Completion')
plausible('Store: Order Completion')
