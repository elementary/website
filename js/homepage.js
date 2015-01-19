var stripe_key = '';

function download_clicked (e) {
    var payment_amount = parsePayment();
    // Not a valid payment amount
    if ( payment_amount === false ) {
        return false;
        // open_download_overlay();
    // 0-like payment amount
    } else if ( payment_amount < 1 ) {
        open_download_overlay();
    // Pay
    } else {
        do_stripe_payment(payment_amount);
    }
}

function parsePayment() {

    // $1     = false
    // -1     = false
    //  0     = 0
    //  1     = 100
    //  1.2   = 120
    //  1.23  = 123
    //  1.234 = 123

    // See also:
    ////    https://support.stripe.com/questions/what-is-the-minimum-amount-i-can-charge-with-stripe
    ////    https://support.stripe.com/questions/what-is-the-maximum-amount-i-can-charge-with-stripe

    var amount = document.getElementById('pay-custom');
    if ( !amount.validity.valid ) {
        // TODO
        // Not valid, make wobble with a class.
        // Also set color, for IE <= 9
        return false;
    } else {
        amount = amount.value;
        console.log('Initial amount: ' + amount);
        // Not a decimal, just pad the thing with two zeros.
        if (-1 == amount.indexOf('.')) {
            var cleanAmount = amount.replace(/\D+/g, '');
;
            cleanAmount = cleanAmount + '00';
        // A decimal
        } else {
            // Split it in half
            var arr = amount.split('.');
            // Convert the cents to a string and trim to two places.
            arr[1] = arr[1].toString().substr(0, 2);
            // If less than two places, add padding.
            while ( arr[1].length < 2 ) {
                arr[1] = arr[1] + '0';
            }
            // Condense the two together again.
            var amount = arr[0] + arr[1];
            var cleanAmount = amount.replace(/\D+/g, '');
        }
        // Remove leading zeros.
        return parseInt(cleanAmount, 10);
    }
}

function do_stripe_payment (amount) {
    StripeCheckout.open({
        key: stripe_key,
        image: '/logomark.svg',
        token: function (token) {
            console.log(token);
            process_payment(amount, token);
            open_download_overlay();
        },
        name: 'elementary LLC.',
        description: 'elementary OS download',
        amount: amount
    });
}

function process_payment(amount, token) {
    payment_http = new XMLHttpRequest();
    payment_http.open("POST", "./backend/payment.php", true);
    payment_http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    payment_http.send("amount=" + amount + "&token=" + token.id);
}

function open_download_overlay () {
    alert("Download overlay goes here!");
    window.open("http://downloads.sourceforge.net/project/elementaryos/unstable/elementaryos-unstable-amd64.20140810.iso");
}

// Get the stripe key from the server
key_http = new XMLHttpRequest();
key_http.open("GET", "./backend/payment.php", true);
key_http.onreadystatechange = function() {
    if (key_http.readyState == 4 && key_http.status == 200) {
        stripe_key = key_http.responseText;
        console.log("Striep key is: " + stripe_key);
    }
}
key_http.send();