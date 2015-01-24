(function() {
    var stripe_key = '';
    var payment_minimum = 100; // Let's make the minimum $1.00 for now

    var $targetAmounts = document.getElementsByClassName('target-amount');
    var $elem;

    var previous_amount = 'amount-twenty-five';
    var current_amount = 'amount-twenty-five';

    function uncheckAll() {
        console.log('hrr')
        for (var i = 0, $elem; $elem = $targetAmounts[i]; i++) { // jshint ignore:line
            $elem.classList.remove('checked');
        }
    }

    function amountClick () {
        uncheckAll();
        // Add current check.
        this.classList.add('checked');
        // Declare new amount.
        var new_amount;
        new_amount = this.id;
        // If different, update the previous and current.
        if ( new_amount !== current_amount ) {
            previous_amount = current_amount;
            current_amount = new_amount;
        }
    }

    // Listen for Clicking on Amounts
    for (var i = 0; $elem = $targetAmounts[i]; i++) { // jshint ignore:line
        $elem.addEventListener('click', amountClick);
    }

    // Check Custom Amounts on Blur
    document.getElementById('amount-custom').addEventListener('blur', function() {
        // If NOT valid OR empty.
        if (
            !this.validity.valid ||
            Number(this.value) <= 0 // Empty strings and less than zero
        ) {
            uncheckAll();
            // Use the old amount.
            current_amount = previous_amount;
            // Set the old amount as checked.
            document.getElementById(current_amount).classList.add('checked');
        }
    });

    document.getElementById('download').addEventListener('click', function() {
        console.log('Pay ' + current_amount);
        var payment_amount = document.getElementById(current_amount).value * 100;
        console.log('Starting payment for ' + payment_amount);
        if (payment_amount < payment_minimum) {
            open_download_overlay();
        } else {
            do_stripe_payment(payment_amount);
        }
    });

    function do_stripe_payment (amount) {
        StripeCheckout.open({
            key: stripe_key,
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
        payment_http.open('POST','./backend/payment.php',true);
        payment_http.setRequestHeader('Content-type','application/x-www-form-urlencoded');
        payment_http.send('amount=' + amount + '&token=' + token.id);
    }

    function open_download_overlay () {
        console.log('Open the download overlay!');
        $('.open-modal').leanModal({
            // Add this class to download buttons to make them close it.
            closeButton: '.close-modal',
            // Match Stripe
            overlayOpacity: 0.6,
            // We'll set the top, thanks.
            // Responsive forever!
            top: 'NOTHANKS',
        });
        $('.open-modal').click();
    }

    // Get the stripe key from the server
    key_http = new XMLHttpRequest();
    key_http.open('GET','./backend/payment.php',true);
    key_http.onreadystatechange = function() {
        if (key_http.readyState == 4 && key_http.status == 200) {
            stripe_key = key_http.responseText;
            console.log('Stripe key is: ' + stripe_key);
        }
    };
    key_http.send();

    console.log('Loaded homepage.js');
})();
