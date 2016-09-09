/**
 * _scripts/download.js
 * Handles homepage payment and OS image downloading
 */

/* global releaseTitle releaseVersion downloadRegion stripeKey */

import Promise from 'core-js/fn/promise'

import analytics from '~/lib/analytics'
import jQuery from '~/lib/jquery'
import modal from '~/lib/modal'
import Stripe from '~/lib/stripe'

Promise.all([analytics, jQuery, Stripe, modal]).then(([ga, $, StripeCheckout]) => {
    $(document).ready(() => {
        // Set defaults
        var paymentMinimum = 100 // Let's make the minimum $1 because of processing fees.
        var currentButton = 'amount-ten' // Default to $10 when the page loads.
        var previousButton = 'amount-ten' // Defaulting to $10 means it will be the first previous.

        // ACTION: amountSelect: Track the current and previous amounts selected.
        var amountSelect = function (e) {
            var targetID = $(e.target).attr('id') // avoids null values vs native js
            if (currentButton !== targetID) previousButton = currentButton
            currentButton = targetID

            $('.target-amount').removeClass('checked')
            $('#' + currentButton).addClass('checked')

            updateDownloadButton()
        }
        // Capture all .target-amount focuses
        $('.target-amount').on('click focusin', amountSelect)

        // ACTION: amountValidate: Check the vality of custom amount inputs.
        var amountValidate = function (event) {
            var currentVal = $('#amount-custom').val()
            var code = event.which || event.keyCode || event.charCode
            if (
                // IS NOT a period or no period already.
                (code !== 46 || currentVal.indexOf('.') !== -1) &&
                // IS NOT a backspace, left arrow, or right arrow
                [8, 37, 39].indexOf(code) === -1 &&
                // IS NOT a number
                (code < 48 || code > 57)
            ) {
                // Prevent from happening
                event.preventDefault()
            }
        }
        $('#amount-custom').keypress(amountValidate)

        // ACTION: amountBlur: Check the vality of custom amount inputs.
        var amountBlur = function () {
            // If NOT valid OR empty.
            var i = document.getElementById('amount-custom')
            if (
                !i.validity.valid ||
                i.value === ''
            ) {
                // Remove existing checks.
                $('.target-amount').removeClass('checked')
                // Use the old button.
                currentButton = previousButton
                // Set the old button as checked.
                $('#' + currentButton).addClass('checked')
                updateDownloadButton()
            }
        }
        // Check Custom Amounts on Blur
        $('#amount-custom').blur(amountBlur)

        // ONLOAD & ACTION: updateDownloadButton: Change Button text based on resulting action
        function updateDownloadButton () {
            var translateDownload = $('#translate-download').text()
            var translatePurchase = $('#translate-purchase').text()
            // Catch case where no buttons are available because the user has already paid.
            if ($('#amounts').children().length <= 1) {
                $('#download').text(translateDownload)
            // Catch case where a button is checked or the custom input is above the minimum.
            } else if (
                $('button.payment-button').hasClass('checked') ||
                $('#amount-custom').val() * 100 >= paymentMinimum ||
                $('#amount-custom').val() === ''
            ) {
                $('#download').text(translatePurchase)
            } else {
                $('#download').text(translateDownload)
            }
        }
        $('#amounts').on('click', updateDownloadButton)
        $('#amounts input').on('input', updateDownloadButton)
        $(document).on('ready', updateDownloadButton)

        // ACTION: #download.click: Either initiate a payment or open the download modal.
        $('#download').click(function () {
            console.log('Payment initiated with selection ' + currentButton)
            var paymentAmount = $('#' + currentButton).val() * 100
            console.log('Starting payment for ' + paymentAmount)
            // Free download
            if (paymentAmount < paymentMinimum) {
                if (window.ga) ga('send', 'event', releaseTitle + ' ' + releaseVersion + ' Download (Free)', 'Homepage', paymentAmount)
                // Open the Download modal immediately.
                openDownloadOverlay()
            // Paid download
            } else {
                if (window.ga) ga('send', 'event', releaseTitle + ' ' + releaseVersion + ' Payment (Initiated)', 'Homepage', paymentAmount)
                // Open the Stripe modal first.
                doStripeCheckout(paymentAmount)
            }
        })

        // UTILITY: detectStripeLanguage: Detect the language and use the Stripe translation if possible.
        function detectStripeLanguage () {
            var stripeLanguages = ['de', 'en', 'es', 'fr', 'it', 'jp', 'nl', 'zh']
            var languageCode = $('html').prop('lang')
            // Stripe supports simplified chinese
            if (/^zh_CN/.test(languageCode)) {
                return 'zh'
            }
            if (stripeLanguages.indexOf(languageCode) !== -1) {
                return languageCode
            }
        }

        // RETURN: doStripeCheckout: Open the Stripe modal to process payment.
        function doStripeCheckout (amount) {
            StripeCheckout.open({
                key: stripeKey,
                token: function (token) {
                    console.log(JSON.parse(JSON.stringify(token)))
                    doStripePayment(amount, token)
                    openDownloadOverlay()
                },
                name: 'elementary LLC.',
                description: releaseTitle + ' ' + releaseVersion,
                bitcoin: true,
                alipay: 'auto',
                locale: detectStripeLanguage() || 'auto',
                amount: amount
            })
        }

        // ACTION: doStripePayment: Actually process the payment via Stripe
        function doStripePayment (amount, token) {
            var paymentHTTP, $amountTen
            $amountTen = $('#amount-ten')
            if (window.ga) ga('send', 'event', releaseTitle + ' ' + releaseVersion + ' Payment (Actual)', 'Homepage', amount)
            if ($amountTen.val() !== 0) {
                $('#amounts').html('<input type="hidden" id="amount-ten" value="0">')
                $amountTen.each(amountSelect)
                updateDownloadButton()
            }
            paymentHTTP = new XMLHttpRequest()
            paymentHTTP.open('POST', './backend/payment.php', true)
            paymentHTTP.setRequestHeader('Content-type', 'application/x-www-form-urlencoded')
            paymentHTTP.send('description=' + encodeURIComponent(releaseTitle + ' ' + releaseVersion) +
                              '&amount=' + amount +
                              '&token=' + token.id +
                              '&email=' + encodeURIComponent(token.email)) +
                              '&os=' + detectedOS
        }

        // UTILITY: detectOS: Detect the OS
        function detectOS () {
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
        var detectedOS = detectOS()

        // ACTION: .download-http.click: Track download over HTTP
        if (window.ga) {
            $('.download-link').click(function () {
                ga('send', 'event', releaseTitle + ' ' + releaseVersion + ' Download (Architecture)', 'Homepage', '64-bit')
                ga('send', 'event', releaseTitle + ' ' + releaseVersion + ' Download (OS)', 'Homepage', detectedOS)
                ga('send', 'event', releaseTitle + ' ' + releaseVersion + ' Download (Region)', 'Homepage', downloadRegion)
            })
            $('.download-link.http').click(function () {
                ga('send', 'event', releaseTitle + ' ' + releaseVersion + ' Download (Method)', 'Homepage', 'HTTP')
            })
            $('.download-link.magnet').click(function () {
                ga('send', 'event', releaseTitle + ' ' + releaseVersion + ' Download (Method)', 'Homepage', 'magnet')
            })
        }

        // RETURN: openDownloadOverlay: Open the Download modal.
        function openDownloadOverlay () {
            var $openModal
            $openModal = $('.open-modal')
            console.log('Open the download overlay!')
            $openModal.leanModal({
                // Add this class to download buttons to make them close it.
                closeButton: '.close-modal'
            })
            // This is what actually opens the modal overlay.
            $openModal.click()
        }

        console.log('Loaded download.js')
    })
})
