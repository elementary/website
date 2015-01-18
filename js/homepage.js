var stripe_key = '';

function download_clicked (e) {
    var payment_amount = parsePayment();
    do_stripe_payment(payment_amount)
}

function parsePayment() {
    var amount = document.getElementById('payment').value;
    if (-1 == amount.indexOf('.')) {
        var isDollar = true;
    }
    var cleanAmount = amount.replace(/\D+/g, '');
    if (isDollar) {
        cleanAmount = cleanAmount + '00';
    }
    return cleanAmount;
}

function do_stripe_payment (amount) {
    if (/^0+$/.test(amount)) {
        open_download_overlay();
        return;
    }
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
    payment_http.open("POST","./backend/payment.php",true);
    payment_http.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    payment_http.send("amount=" + amount + "&token=" + token.id);
}

function open_download_overlay () {
    alert("Download overlay goes here!");
    window.open("http://downloads.sourceforge.net/project/elementaryos/unstable/elementaryos-unstable-amd64.20140810.iso");
}

// Get the stripe key from the server
key_http = new XMLHttpRequest();
key_http.open("GET","./backend/payment.php",true);
key_http.onreadystatechange = function() {
    if (key_http.readyState == 4 && key_http.status == 200) {
        stripe_key = key_http.responseText;
        console.log("Striep key is: " + stripe_key);
    }
} 
key_http.send();
