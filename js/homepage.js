var stripe_key = '';
var payment_minimum = 150; // Let's make the minimum $1.50 for now

$('#download').click(function(){
    payment_amount = 2000;
    //TODO: Add input and get the value here
    if (payment_amount > payment_minimum) {
    	do_stripe_payment(payment_amount);
    } else {
    	open_download_overlay();
    }
});

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

function process_payment (amount, token) {
    payment_http = new XMLHttpRequest();
    payment_http.open("POST","./backend/payment.php",true);
    payment_http.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    payment_http.send("amount=" + amount + "&token=" + token.id);
}

function open_download_overlay () {
    console.log('Open the download overlay!');
    $('.open-modal').leanModal();
    $('.open-modal').click();
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

console.log('Loaded homepage.js');