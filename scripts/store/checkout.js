/* global ga StripeCheckout */

/**
 * scripts/store/checkout.js
 * Changes prices depending on shipping and gets stripe information
 */

if (typeof stripeKey !== 'string') {
    console.error('Unable to find stripe key on page')

    var stripeKey = null
    $.getJSON('backend/payment.php', function (data) {
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
    var $tax = $('input[name="cart-tax"]')
    var $shipping = $('input[name="cart-shipping"]')
    var $total = $('input[name="cart-total"]')

    var sub = parseFloat($subtotal.val())
    var tax = parseFloat($tax.val())
    var shi = parseFloat(s)
    var tot = (sub + tax + shi)

    $shipping.val(shi)
    $total.val(tot)

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

function stripeLanguage () {
    var stripeLanguages = ['de', 'en', 'es', 'fr', 'it', 'jp', 'nl', 'zh']
    var languageCode = $('html').prop('lang')

    // Stripe supports simplified chinese
    if (/^zh_CN/.test(languageCode)) {
        return 'zh'
    }

    if (stripeLanguages.indexOf(languageCode) !== -1) {
        return languageCode
    }
}

function doStripePayment (amount, email) {
    StripeCheckout.open({
        key: stripeKey,
        token: function (token) {
            console.log(JSON.parse(JSON.stringify(token)))

            processPayment(amount, token)
        },
        name: 'elementary LLC.',
        description: 'Store',
        bitcoin: true,
        alipay: 'auto',
        locale: stripeLanguage() || 'auto',
        amount: amount,
        email: email
    })
}

function processPayment (amount, token) {
    if (window.ga) {
        ga('send', 'event', 'elementary store' + 'payment process', 'store', amount)
    }

    $('input[name="stripe-token"]', $form).val(token.id)
    $form.submit()
}

$form.on('submit', function (event) {
    if ($('input[name="stripe-token"]', $form).val() === '') {
        event.preventDefault()

        var value = parseInt($('input[name="cart-total"]', $form).val() * 100)
        var email = $('input[name="email"]', $form).val()
        doStripePayment(value, email)
    }
})
