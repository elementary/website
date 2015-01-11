function download_clicked (e) {
    payment_amount = 2000;
    //TODO: Add input and get the value here
    //TODO: Add checking for $0 or below transaction costs
    do_stripe_payment(payment_amount)
}

function do_stripe_payment (amount) {
    handler = StripeCheckout.configure({
        key: 'pk_test_aPQFfHx96Qeznh5tFGzW3H6T',
        image: '/logomark.svg',
        token: function (token) {
            console.log(token);
            //TODO: send payment token to server
            open_download_overlay();
        }
    });

    handler.open({
        name: 'elementary LLC.',
        description: 'elementary OS download',
        amount: amount
    });
}

function open_download_overlay () {
    alert("Download overlay goes here!");
    window.open("http://downloads.sourceforge.net/project/elementaryos/unstable/elementaryos-unstable-amd64.20140810.iso");
}