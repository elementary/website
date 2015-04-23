(function () {
    var payment_minimum = 100; // Let's make the minimum $1.00 for now

    var previous_amount = 'amount-twenty-five';
    var current_amount = 'amount-twenty-five';
    var amountClick = function() {
        // Remove existing checks.
        $('.target-amount').removeClass('checked');
        // Add current check.
        $(this).addClass('checked');
        // Declare new amount.
        var new_amount;
        new_amount = this.id;
        // If different, update the previous and current.
        if ( new_amount != current_amount ) {
            previous_amount = current_amount;
            current_amount = new_amount;
        }
    };
    var amountBlur = function() {
        // If NOT valid OR empty.
        if (
            !this.validity.valid ||
            this.value == ''
        ) {
            // Remove existing checks.
            $('.target-amount').removeClass('checked');
            // Use the old amount.
            current_amount = previous_amount;
            // Set the old amount as checked.
            $('#' + current_amount).addClass('checked');
        }
    };
    // Listen for Clicking on Amounts
    $('.target-amount').click(amountClick);
    // Check Custom Amounts on Blur
    $('#amount-custom').blur(amountBlur);

    $('#download').click(function(){
        console.log('Pay ' + current_amount);
        var payment_amount = $('#' + current_amount).val() * 100;
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
                console.log(JSON.parse(JSON.stringify(token)));
                process_payment(amount, token);
                open_download_overlay();
            },
            name: 'elementary LLC.',
            description: 'elementary OS download',
            bitcoin: 'true',
            amount: amount
        });
    }

    function process_payment (amount, token) {
        var payment_http, $amount_twenty_five;

        $amount_twenty_five = $('#amount-twenty-five');

        if ($amount_twenty_five.val() !== 0) {
            $('#amounts').html('<input type="hidden" id="amount-twenty-five" value="0">');
            $amount_twenty_five.each(amountClick);
        }
        payment_http = new XMLHttpRequest();
        payment_http.open('POST','./backend/payment.php',true);
        payment_http.setRequestHeader('Content-type','application/x-www-form-urlencoded');
        payment_http.send('amount=' + amount + '&token=' + token.id + '&email=' + encodeURIComponent(token.email));
    }

    function open_download_overlay () {
        var $open_modal;

        $open_modal = $('.open-modal');

        console.log('Open the download overlay!');
        $open_modal.leanModal({
            // Add this class to download buttons to make them close it.
            closeButton: '.close-modal',
        });
        $open_modal.click();
    }

    function detect_os() {
        var ua = window.navigator.userAgent;
        if (ua.indexOf('Android') >= 0) {
            return 'Android';
        }
        if (ua.indexOf('Mac OS X') >= 0 && ua.indexOf('Mobile') >= 0) {
            return 'iOS';
        }
        if (ua.indexOf('Windows') >= 0) {
            return 'Windows';
        }
        if (ua.indexOf('Mac_PowerPC') >= 0 || ua.indexOf('Macintosh') >= 0) {
            return 'OS X';
        }
        if (ua.indexOf('Linux') >= 0) {
            return 'Linux';
        }
        return 'Other';
    }

    if (window.ga) {
        var download_links = $('#download-modal').find('.actions').find('a');
        var links_data = [
            { arch: '32-bit', method: 'HTTP' },
            { arch: '32-bit', method: 'Magnet' },
            { arch: '64-bit', method: 'HTTP' },
            { arch: '64-bit', method: 'Magnet' }
        ];

        for (var i = 0; i < links_data.length; i++) {
            (function (data, link) {
                $(link).click(function () {
                    ga('send', 'event', 'Freya Beta Download (Architecture)', 'Homepage', data.arch);
                    ga('send', 'event', 'Freya Beta Download (Method)', 'Homepage', data.method);
                    ga('send', 'event', 'Freya Beta Download (OS)', 'Homepage', detect_os());
                });
            })(links_data[i], download_links[i]);
        }
    }

    // Carousel
    var appCarousel = new Slider({
        id: 'carousel-choices',
        choices: ['photos', 'music', 'videos', 'midori']
    });
    appCarousel.slideTo('photos');

    $(function() {
        $.getJSON('data/slingshot.json', function(data) {
            $.each(data.grid, function(i, f) {
                var griditems = '<div class="app '+f.position+'"><img src="images/icons/'+f.icon+'.svg"/><p>'+f.title+'</p>'
                $(griditems).appendTo(".slingshot-grid");
            });
            $.each(data.categories, function(i, f) {
                var categoriesitems = '<div class="app '+f.position+'"><img src="images/icons/'+f.icon+'.svg"/><p>'+f.title+'</p>'
                $(categoriesitems).appendTo(".slingshot-categories");
            });
        });
    });

    $(function() {
        window.setInterval(function () {
            var grid = $("#slingshot-grid");
            var categories = $("#slingshot-categories");
            if (grid.hasClass ("active")) {
                grid.removeClass ("active");
                categories.addClass ("active");
                console.log("category");
            } else {
                grid.addClass ("active");
                categories.removeClass ("active");
                console.log("grid");
            }
        }, 3000);
    });

    console.log('Loaded homepage.js');
})();
