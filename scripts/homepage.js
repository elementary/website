$(function () {
    var payment_minimum = 100; // Let's make the minimum $1.00 for now

    var previous_amount = 'amount-ten';
    var current_amount = 'amount-ten';
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

            updateDownloadButton();
        }
    };
    var amountValidate = function(event) {
      
      var currentVal = $('#amount-custom').val();
      
      var code = event.which | event.keyCode | event.charCode;
      var specialKeys = [8, 37, 39];
      
      if ((code != 46 || currentVal.indexOf('.') != -1) && 
          specialKeys.indexOf(code) == -1 && 
          (code < 48 || code > 57)) {
          event.preventDefault();
      }
    }
      
    
    // Listen for Clicking on Amounts
    $('.target-amount').click(amountClick);
    // Check Custom Amounts on Blur
    $('#amount-custom').blur(amountBlur);
    // Don't allow non-digit input
    $('#amount-custom').keypress(amountValidate);

    $('#download').click(function(){
        console.log('Pay ' + current_amount);
        var payment_amount = $('#' + current_amount).val() * 100;
        console.log('Starting payment for ' + payment_amount);
        if (payment_amount < payment_minimum) {
            if (window.ga) {
                ga('send', 'event', release_title + ' ' + release_version + ' Download (Free)', 'Homepage', payment_amount);
            }
            open_download_overlay();
        } else {
            if (window.ga) {
                ga('send', 'event', release_title + ' ' + release_version + ' Payment (Initiated)', 'Homepage', payment_amount);
            }
            do_stripe_payment(payment_amount);
        }
    });

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
                open_download_overlay();
            },
            name: 'elementary LLC.',
            description: release_title + ' ' + release_version,
            bitcoin: true,
            alipay: 'auto',
            locale: stripe_language() || 'auto',
            amount: amount
        });
    }

    function process_payment (amount, token) {
        var payment_http, $amount_ten;

        $amount_ten = $('#amount-ten');

        if (window.ga) {
            ga('send', 'event', release_title + ' ' + release_version + ' Payment (Actual)', 'Homepage', amount);
        }

        if ($amount_ten.val() !== 0) {
            $('#amounts').html('<input type="hidden" id="amount-ten" value="0">');
            $amount_ten.each(amountClick);
            updateDownloadButton()
        }
        payment_http = new XMLHttpRequest();
        payment_http.open('POST','./backend/payment.php',true);
        payment_http.setRequestHeader('Content-type','application/x-www-form-urlencoded');
        payment_http.send('description=' + encodeURIComponent(release_title + ' ' + release_version) +
                          '&amount=' + amount +
                          '&token=' + token.id +
                          '&email=' + encodeURIComponent(token.email));
    }

    function open_download_overlay () {
        var $open_modal;

        $open_modal = $('.open-modal');

        console.log('Open the download overlay!');
        $open_modal.leanModal({
            top: '15vmin',
            overlayOpacity: 0.5,
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
                    ga('send', 'event', release_title + ' ' + release_version + ' Download (Architecture)', 'Homepage', data.arch);
                    ga('send', 'event', release_title + ' ' + release_version + ' Download (Method)', 'Homepage', data.method);
                    ga('send', 'event', release_title + ' ' + release_version + ' Download (OS)', 'Homepage', detect_os());
                    ga('send', 'event', release_title + ' ' + release_version + ' Download (Region)', 'Homepage', download_region);
                });
            })(links_data[i], download_links[i]);
        }
    }

    // Carousel
    var appCarousel = new Slider({
      slideContainer: '.slide-container',
      choiceContainer: '#carousel-choices',
      slides: ['photos', 'music', 'videos', 'midori'],
      fixed: true
    });

    $(function() {
        $.getJSON('data/slingshot.json', function(data) {
            $.each(data.grid, function(i, f) {
                var griditems = '<div class="app '+f.position+'"><img src="images/icons/'+f.icon+'.svg" alt="'+f.title+'"/><p>'+f.title+'</p>'
                $(griditems).appendTo(".slingshot-grid");
            });
            $.each(data.categories, function(i, f) {
                var categoriesitems = '<div class="app '+f.position+'"><img src="images/icons/'+f.icon+'.svg" alt="'+f.title+'"/><p>'+f.title+'</p>'
                $(categoriesitems).appendTo(".slingshot-categories");
            });
            $.each(data.searchone, function(i, f) {
                var searchitems = '<div class="search-result"><img class="result-img" src="images/icons/32/'+f.icon+'.svg" alt="'+f.title+'"/><p>'+f.title+'</p>'
                $(searchitems).appendTo(".searchone");
            });
            $.each(data.searchtwo, function(i, f) {
                var searchitems = '<div class="search-result"><img class="result-img" src="images/icons/32/'+f.icon+'.svg" alt="'+f.title+'"/><p>'+f.title+'</p>'
                $(searchitems).appendTo(".searchtwo");
            });
            $.each(data.searchthree, function(i, f) {
                var searchitems = '<div class="search-result"><img class="result-img" src="images/icons/32/'+f.icon+'.svg" alt="'+f.title+'"/><p>'+f.title+'</p>'
                $(searchitems).appendTo(".searchthree");
            });
        });
    });

    $(function() {
        window.setInterval(function() {
            if( $('#slingshot-grid').hasClass('active') ){
                $('#slingshot-grid').addClass('previous');
                $('#slingshot-grid').removeClass('active');
                $('#slingshot-categories').removeClass('next');
                $('#slingshot-categories').addClass('active');
                $('#slingshot-categories-button').addClass ('active');
                $('#slingshot-grid-button').removeClass ('active');
            } else if( $('#slingshot-categories').hasClass('active') ){
                $('#slingshot-categories').addClass('previous');
                $('#slingshot-categories').removeClass('active');
                $('#slingshot-search').removeClass('next');
                $('#slingshot-search').addClass('active');
                $('.slingshot .clear-icon').removeClass ('inactive');
                $('.slingshot .search-term').removeClass ('inactive');
                $('.searchone').removeClass ('inactive');
                setTimeout(function(){
                    $('.slingshot-search-results').addClass ('inactive');
                    $('.searchtwo').removeClass ('inactive');
                }, 700);
                setTimeout(function(){
                    $('.slingshot-search-results').addClass ('inactive');
                    $('.searchthree').removeClass ('inactive');
                }, 1200);
                $('.slingshot .linked').addClass ('inactive');
                $('.slingshot .entry').addClass ('expanded');
            } else if( $('#slingshot-search').hasClass('active') ){
                $('#slingshot-search').addClass('next');
                $('#slingshot-search').removeClass('active');
                $('#slingshot-grid').removeClass('previous');
                $('#slingshot-grid').addClass('active');
                $('#slingshot-categories').addClass('next');
                $('#slingshot-categories').removeClass('previous');
                $('.slingshot .clear-icon, .slingshot .search-term, .slingshot-search-results').addClass ('inactive');
                $('.slingshot .linked').removeClass ('inactive');
                $('.slingshot .entry').removeClass ('expanded');
                $('#slingshot-grid-button').addClass ('active');
                $('#slingshot-categories-button').removeClass ('active');
            }
        }, 3000);
    });

    // Change Button text on payment click
    function updateDownloadButton () {
        var translate_download = $('#translate-download').text();
        var translate_purchase = $('#translate-purchase').text();

        if ($('#amounts').children().length <= 1) {
            $('#download').text(translate_download);
            document.title = translate_download;
        } else if (
            $('button.payment-button').hasClass('checked') ||
            $('#amount-custom').val() * 100 >= payment_minimum
        ) {
            $('#download').text(translate_purchase);
            document.title = translate_purchase;
        } else {
            $('#download').text(translate_download);
            document.title = translate_download;
        }
    }

    $('#amounts').on('click', updateDownloadButton);
    $('#amounts input').on('input', updateDownloadButton);
    updateDownloadButton();

    console.log('Loaded homepage.js');
});
