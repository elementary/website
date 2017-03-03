/**
 * scripts/pages/store/checkout.js
 * Changes prices depending on shipping and gets stripe information
 */

import analytics from '~/lib/analytics'
import jQuery from '~/lib/jquery'
import Payment from '~/widgets/payment'

Promise.all([jQuery, Payment, analytics]).then(([$, Payment, ga]) => {
    ga('send', 'event', 'Store', 'Checkout Visit')

    const payment = new Payment('Store')

    $(document).ready(function () {
        var baseUrl = $('base').attr('href')
        var stripeKey = null

        if (typeof window.stripeKey !== 'undefined') {
            stripeKey = window.stripeKey
        } else if (stripeKey == null) {
            console.error('Unable to find stripe key on page')

            $.getJSON(baseUrl + 'api/payment.php', function (data) {
                console.log('Was able to fetch stripe key manually')

                stripeKey = data
            })
        }

        /**
         * updateTotal
         * Updates prices with new shipping price
         *
         * @param {Number} s - shipping price
         */
        var updateTotal = function (s) {
            var $subtotal = $('input[name="cart-subtotal"]')
            var $rat = $('input[name="cart-tax-rate"]')
            var $tax = $('input[name="cart-tax"]')
            var $shipping = $('input[name="cart-shipping"]')
            var $total = $('input[name="cart-total"]')

            var sub = parseFloat($subtotal.val())
            var shi = parseFloat(s)
            var tax = parseFloat($rat.val() * (sub + shi))
            var tot = (sub + tax + shi)

            $tax.val(tax.toFixed(2))
            $shipping.val(shi.toFixed(2))
            $total.val(tot.toFixed(2))

            $('#cart-tax').html('Tax: $' + tax.toFixed(2))
            $('#cart-shipping').html('Shipping: $' + shi.toFixed(2))
            $('#cart-total').html('Total: $' + tot.toFixed(2))
        }

        /**
         * Updates shipping information based on selection
         */
        $('input[name="shipping"]').on('change', function (e) {
            var id = $(this).val()

            var name = $('input[name="shipping-' + id + '-name"]').val()
            var expected = $('input[name="shipping-' + id + '-expected"]').val()
            var cost = $('input[name="shipping-' + id + '-cost"]').val()

            $('.shipping-name').html(name)
            $('.shipping-expected').html(expected)
            $('.shipping-cost').html(cost)

            updateTotal(cost)
        })

        /**
         * Past this point is all stripe checkout scripting
         */
        var $form = $('form[action$="order"]')

        function processPayment (amount, token) {
            ga('send', 'event', 'elementary store' + 'payment process', 'store', amount)

            $('input[name="stripe-token"]', $form).val(token.id)
            $form.submit()
        }

        $form.on('submit', function (event) {
            if ($('input[name="stripe-token"]', $form).val() === '') {
                event.preventDefault()

                var value = parseInt($('input[name="cart-total"]', $form).val() * 100)
                var email = $('input[name="email"]', $form).val()

                payment.user = {
                    email
                }

                payment.checkout(value, 'USD')
                .then(([token]) => processPayment(value, token))
            }
        })
    })
})
