/* global ga releaseTitle releaseVersion stripeKey StripeCheckout downloadRegion */

$(function () {
    //// Set defaults
    var paymentMinimum = 100 // Let's make the minimum $1 because of processing fees.
    var currentAmount = 'amount-ten' // Default to $10 when the page loads.
    var previousAmount = 'amount-ten' // Defaulting to $10 means it will be the first previous.

    //// ACTION: amountClick: Track the current and previous amounts selected.
    var amountClick = function(e) {
        // Capture the Target ID
        var targetId = $(e.target).attr('id') // avoids null values vs native js
        var targetType = e.type
        // Verify the number
        if (!$(e.target).hasClass('target-amount') && currentAmount === 'amount-custom') {
            var i = document.getElementById('amount-custom')
            // all the things for a 'bad input'
            if (!i.validity.valid || i.value === '') {
                targetId = previousButton
                targetType = 'click'
            }
        }
        // on button / input becoming active. Focus of custom amount with valid input considered becoming active
        if ((targetId === 'amount-custom' || targetType !== 'focusin') && $('#' + targetId).hasClass('target-amount')) {
            if (targetId !== 'amount-custom') previousButton = targetId
            // Remove existing checks.
            $('.target-amount').removeClass('checked')
            // Add current check.
            $('#' + targetId).addClass('checked')
            currentAmount = targetId
            updateDownloadButton()
        }
    }
    // Capture all focus events on Amounts so we can dictate what download amount is in use
    $('.target-amount').on('click focusin', amountClick)

    var amountValidate = function (event) {
        var currentVal = $('#amount-custom').val()
        var code = event.which || event.keyCode || event.charCode

        if ((code !== 46 || currentVal.indexOf('.') !== -1) &&
        [8, 37, 39].indexOf(code) === -1 &&
        (code < 48 || code > 57)) {
            event.preventDefault()
        }
    }

    // Don't allow non-digit input
    $('#amount-custom').keypress(amountValidate)

    //// ONLOAD & ACTION: updateDownloadButton: Change Button text based on resulting action
    function updateDownloadButton () {
        var translateDownload = $('#translate-download').text()
        var translatePurchase = $('#translate-purchase').text()
        // Catch case where no buttons are available because the user has already paid.
        if ($('#amounts').children().length <= 1) {
            $('#download').text(translateDownload)
            document.title = translateDownload
        // Catch case where a button is checked or the custom input is above the minimum.
        } else if (
            $('button.payment-button').hasClass('checked') ||
            $('#amount-custom').val() * 100 >= paymentMinimum
        ) {
            $('#download').text(translatePurchase)
            document.title = translatePurchase
        } else {
            $('#download').text(translateDownload)
            document.title = translateDownload
        }
    }
    $('#amounts').on('click', updateDownloadButton)
    $('#amounts input').on('input', updateDownloadButton)
    updateDownloadButton()

    //// ACTION: #download.click: Either initiate a payment or open the download modal.
    $('#download').click(function(){
        console.log('Pay ' + currentAmount)
        var paymentAmount = $('#' + currentAmount).val() * 100
        console.log('Starting payment for ' + paymentAmount)
        // Free download
        if (paymentAmount < paymentMinimum) {
            if (window.ga) ga('send', 'event', releaseTitle + ' ' + releaseVersion + ' Download (Free)', 'Homepage', paymentAmount)
            // Open the Download modal immediately.
            open_download_overlay()
        // Paid download
        } else {
            if (window.ga) ga('send', 'event', releaseTitle + ' ' + releaseVersion + ' Payment (Initiated)', 'Homepage', paymentAmount)
            // Open the Stripe modal first.
            do_stripe_payment(payment_amount)
        }
    })

    //// UTILITY: detect_stripe_language: Detect the language and use the Stripe translation if possible.
    function detect_stripe_language() {
        var stripe_languages = ['de', 'en', 'es', 'fr', 'it', 'jp', 'nl', 'zh']
        var language_code = $('html').prop('lang')
        // Stripe supports simplified chinese
        if (/^zh_CN/.test(language_code)) {
            return 'zh'
        }
        if (stripe_languages.indexOf(language_code) != -1) {
            return language_code
        }
    }

    //// RETURN: do_stripe_payment: Open the Stripe modal to process payment.
    function do_stripe_payment(amount) {
        StripeCheckout.open({
            key: stripe_key,
            token: function (token) {
                console.log(JSON.parse(JSON.stringify(token)))
                process_payment(amount, token)
                open_download_overlay()
            },
            name: 'elementary LLC.',
            description: releaseTitle + ' ' + releaseVersion,
            bitcoin: true,
            alipay: 'auto',
            locale: detect_stripe_language() || 'auto',
            amount: amount
        })
    }

    //// ACTION: process_payment: Actually process the payment via Stripe
    function process_payment(amount, token) {
        var payment_http, $amount_ten
        $amount_ten = $('#amount-ten')
        if (window.ga) ga('send', 'event', releaseTitle + ' ' + releaseVersion + ' Payment (Actual)', 'Homepage', amount)
        if ($amount_ten.val() !== 0) {
            $('#amounts').html('<input type="hidden" id="amount-ten" value="0">')
            $amount_ten.each(amountClick)
            updateDownloadButton()
        }
        payment_http = new XMLHttpRequest()
        payment_http.open('POST','./backend/payment.php',true)
        payment_http.setRequestHeader('Content-type','application/x-www-form-urlencoded')
        payment_http.send('description=' + encodeURIComponent(releaseTitle + ' ' + releaseVersion) +
                          '&amount=' + amount +
                          '&token=' + token.id +
                          '&email=' + encodeURIComponent(token.email)) +
                          '&os=' + detectedOS
    }

    //// UTILITY: detect_os: Detect the OS
    function detect_os() {
        var ua = window.navigator.userAgent
        if (ua.indexOf('Android') >= 0) {
            return 'Android'
        }
        if (ua.indexOf('Mac OS X') >= 0 && ua.indexOf('Mobile') >= 0) {
            return 'iOS'
        }
        if (ua.indexOf('Windows') >= 0) {
            return 'Windows'
        }
        if (ua.indexOf('Mac_PowerPC') >= 0 || ua.indexOf('Macintosh') >= 0) {
            return 'OS X'
        }
        if (ua.indexOf('Linux') >= 0) {
            return 'Linux'
        }
        return 'Other'
    }
    var detectedOS = detect_os()

    //// ACTION: .download-http.click: Track download over HTTP
    if (window.ga) {
        $('.download-link').click(function () {
            ga('send', 'event', releaseTitle + ' ' + releaseVersion + ' Download (Architecture)', 'Homepage', '64-bit')
            ga('send', 'event', releaseTitle + ' ' + releaseVersion + ' Download (OS)', 'Homepage', detectedOS)
            ga('send', 'event', releaseTitle + ' ' + releaseVersion + ' Download (Region)', 'Homepage', downloadRegion)
        })
        $('.http-link').click(function () {
            ga('send', 'event', releaseTitle + ' ' + releaseVersion + ' Download (Method)', 'Homepage', 'HTTP')
        })
        $('.magnet-link').click(function () {
            ga('send', 'event', releaseTitle + ' ' + releaseVersion + ' Download (Method)', 'Homepage', 'magnet')
        })
    }

    //// RETURN: open_download_overlay: Open the Download modal.
    function open_download_overlay() {
        var $open_modal
        $open_modal = $('.open-modal')
        console.log('Open the download overlay!')
        $open_modal.leanModal({
            // Add this class to download buttons to make them close it.
            closeButton: '.close-modal',
        })
        // This is what actually opens the modal overlay.
        $open_modal.click()
        do_webtorrent_download()
    }

    console.log('Loaded download.js')
})
