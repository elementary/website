$(function () {

    //// Set defaults
    var payment_minimum = 100; // Let's make the minimum $1 because of processing fees.
    var current_amount = 'amount-ten'; // Default to $10 when the page loads.
    var previous_amount = 'amount-ten'; // Defaulting to $10 means it will be the first previous.

    //// ACTION: amountClick: Track the current and previous amounts selected.
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
    // Listen for Clicking on Amounts
    $('.target-amount').click(amountClick);

    //// ACTION: amountBlur: Check the vality of custom amount inputs.
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
    // Check Custom Amounts on Blur
    $('#amount-custom').blur(amountBlur);

    //// ACTION: #download.click: Either initiate a payment or open the download modal.
    $('#download').click(function(){
        console.log('Pay ' + current_amount);
        var payment_amount = $('#' + current_amount).val() * 100;
        console.log('Starting payment for ' + payment_amount);
        // Free download
        if (payment_amount < payment_minimum) {
            if (window.ga) ga('send', 'event', release_title + ' ' + release_version + ' Download (Free)', 'Homepage', payment_amount);
            // Open the Download modal immediately.
            open_download_overlay();
        // Paid download
        } else {
            if (window.ga) ga('send', 'event', release_title + ' ' + release_version + ' Payment (Initiated)', 'Homepage', payment_amount);
            // Open the Stripe modal first.
            do_stripe_payment(payment_amount);
        }
    });

    //// UTILITY: detect_stripe_language: Detect the language and use the Stripe translation if possible.
    function detect_stripe_language() {
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

    //// RETURN: do_stripe_payment: Open the Stripe modal to process payment.
    function do_stripe_payment(amount) {
        StripeCheckout.open({
            key: stripe_key,
            token: function (token) {
                console.log(JSON.parse(JSON.stringify(token)));
                process_payment(amount, token);
                open_download_overlay();
            },
            name: 'elementary LLC.',
            description: release_title + ' ' + release_version,
            bitcoin: true,
            alipay: 'auto',
            locale: detect_stripe_language() || 'auto',
            amount: amount
        });
    }

    //// ACTION: process_payment: Actually process the payment via Stripe
    function process_payment(amount, token) {
        var payment_http, $amount_ten;
        $amount_ten = $('#amount-ten');
        if (window.ga) ga('send', 'event', release_title + ' ' + release_version + ' Payment (Actual)', 'Homepage', amount);
        if ($amount_ten.val() !== 0) {
            $('#amounts').html('<input type="hidden" id="amount-ten" value="0">');
            $amount_ten.each(amountClick);
            updateDownloadButton();
        }
        payment_http = new XMLHttpRequest();
        payment_http.open('POST','./backend/payment.php',true);
        payment_http.setRequestHeader('Content-type','application/x-www-form-urlencoded');
        payment_http.send('description=' + encodeURIComponent(release_title + ' ' + release_version) +
                          '&amount=' + amount +
                          '&token=' + token.id +
                          '&email=' + encodeURIComponent(token.email));
    }

    //// UTILITY: detect_os: Detect the OS
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

    //// ACTION: .download-http.click: Track download over HTTP
    if (window.ga) {
        $('.download-http').click(function () {
            ga('send', 'event', release_title + ' ' + release_version + ' Download (Architecture)', 'Homepage', '64-bit');
            ga('send', 'event', release_title + ' ' + release_version + ' Download (Method)', 'Homepage', 'HTTP');
            ga('send', 'event', release_title + ' ' + release_version + ' Download (OS)', 'Homepage', detect_os());
            ga('send', 'event', release_title + ' ' + release_version + ' Download (Region)', 'Homepage', download_region);
        });
    }

    //// RETURN: open_download_overlay: Open the Download modal.
    function open_download_overlay() {
        var $open_modal;
        $open_modal = $('.open-modal');
        console.log('Open the download overlay!');
        $open_modal.leanModal({
            // Add this class to download buttons to make them close it.
            closeButton: '.close-modal',
        });
        // This is what actually opens the modal overlay.
        $open_modal.click();
        do_webtorrent_download();
    }

    //// UTILITY: do_webtorrent_download: Start the WebTorrent download.
    function do_webtorrent_download() {
        if (WebTorrent.WEBRTC_SUPPORT) {
            $('#download-webtorrent').show();
            $('#download-direct').hide();
            var magnet = $('.download-magnet').attr('href');
            console.log('Starting download from ' + magnet);
            // Initialize WebTorrent
            var client = new WebTorrent();
            client.on('error', function (err) {
                console.error('WTERROR: ' + err.message);
            });
            // Add Torrent
            var torrentId = 'magnet:?xt=urn:btih:6a9759bffd5c0af65319979fb7832189f4f3c35d&dn=sintel.mp4&tr=wss%3A%2F%2Ftracker.btorrent.xyz&tr=wss%3A%2F%2Ftracker.fastcast.nz&tr=wss%3A%2F%2Ftracker.openwebtorrent.com&tr=wss%3A%2F%2Ftracker.webtorrent.io&ws=https%3A%2F%2Fwebtorrent.io%2Ftorrents%2Fsintel-1024-surround.mp4';
            console.log(magnet);
            console.log(torrentId);
            client.add(torrentId, onTorrent);
            client.add(magnet, onTorrent);
            function onTorrent (torrent) {
                torrent.on('error', function (err) {
                    console.error('TERROR: ' + err.message);
                });
                console.log('Download started.');
                var file = torrent.files[0]; // There should only ever be one file.
                file.appendTo('.log'); // append the file to the DOM
                // Print out progress every second
                var interval = setInterval(function () {
                    var progress = (torrent.progress * 100).toFixed(1);
                    console.log('Progress: ' + progress + '% - ' + torrent.timeRemaining);
                    $('.progress.sintel').width(progress + '%');
                    $('.counter').text('' + progress + '% downloaded - ' + (torrent.timeRemaining / 1000 ).toFixed() + ' seconds remaining');
                }, 1000);
                // Stop printing out progress.
                torrent.on('done', function () {
                    console.log('Progress: 100%');
                    $('.counter').text('Complete');
                    clearInterval(interval);
                });
            }
            console.log('Download started?');
        }
    }

    console.log('Loaded download.js');

});
