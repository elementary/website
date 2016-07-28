var $form = $('form[action$="order"]')

function stripe_language() {
    var stripe_languages = ['de', 'en', 'es', 'fr', 'it', 'jp', 'nl', 'zh']
    var language_code = $('html').prop('lang');
    // Stripe supports simplified chinese
    if (/^zh_CN/.test(language_code)) {
        return 'zh';
    }
    if (stripe_languages.indexOf(language_code) != -1) {
        return language_code;
    }
}

function do_stripe_payment (amount, email) {
    StripeCheckout.open({
        key: stripe_key,
        token: function (token) {
            console.log(JSON.parse(JSON.stringify(token)));
            process_payment(amount, token);
        },
        name: 'elementary LLC.',
        description: 'elementary store',
        bitcoin: true,
        alipay: 'auto',
        locale: stripe_language() || 'auto',
        amount: amount,
        email: email
    })
}

function process_payment (amount, token) {
    if (window.ga) {
        ga('send', 'event', 'elementary store' + 'payment process', 'store', amount);
    }

    $('input[name="stripe-token"]', $form).val(token.id)
    $form.submit()
}

$form.on('submit', function (event) {
    if ($('input[name="stripe-token"]', $form).val() === '') {
        event.preventDefault()

        var value = parseInt($('input[name="cart-total"]', $form).val() * 100)
        var email = $('input[name="email"]', $form).val()
        do_stripe_payment(value, email)
    }
})
