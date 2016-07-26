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

function do_stripe_payment (amount) {
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
        amount: amount
    })
}

function process_payment (amount, token) {
    if (window.ga) {
        ga('send', 'event', 'elementary store' + 'order', 'store', amount);
    }

    var payment_http = new XMLHttpRequest();
    payment_http.open('POST','./backend/payment.php',true);
    payment_http.setRequestHeader('Content-type','application/x-www-form-urlencoded');
    payment_http.send('description=' + encodeURIComponent(release_title + ' ' + release_version) +
                      '&amount=' + amount +
                      '&token=' + token.id +
                      '&email=' + encodeURIComponent(token.email));
}

(function() {

})
