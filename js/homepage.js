function download_clicked (e) {
    payment_amount = 2000;
    //TODO: Add input and get the value here
    //TODO: Add checking for $0 or below transaction costs
    do_stripe_payment(payment_amount)
}

function do_stripe_payment (amount) {
    StripeCheckout.open({
        key: 'pk_test_aPQFfHx96Qeznh5tFGzW3H6T',
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
    xmlhttp = new XMLHttpRequest();
    xmlhttp.open("POST","./backend/payment.php",true);
    xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    xmlhttp.send("amount=" + amount + "&token=" + token.id);
}

function open_download_overlay () {
    alert("Download overlay goes here!");
    window.open("http://downloads.sourceforge.net/project/elementaryos/unstable/elementaryos-unstable-amd64.20140810.iso");
}