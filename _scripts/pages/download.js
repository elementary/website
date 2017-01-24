/**
 * _scripts/pages/download.js
 * Handles homepage payment and OS image downloading
 */

import Promise from 'core-js/fn/promise'

import analytics from '~/lib/analytics'
import jQuery from '~/lib/jquery'
import modal from '~/lib/modal'
import Stripe from '~/lib/stripe'
import ReadableStream from '~/lib/web-streams-polyfill'
import streamSaver from '~/lib/streamsaver'
import WebTorrent from '~/lib/webtorrent'

import config from '~/config'

Promise.all([config, analytics, jQuery, Stripe, streamSaver, WebTorrent, modal]).then(([config, ga, $, StripeCheckout, streamSaver, WebTorrent]) => {
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

        // ACTION: amountValidate: Check the validity of custom amount inputs.
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

        // ACTION: amountBlur: Check the validity of custom amount inputs.
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
            if ($('#choice-buttons').children().length <= 1) {
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
        $('#choice-buttons').on('click', updateDownloadButton)
        $('#choice-buttons input').on('input', updateDownloadButton)
        updateDownloadButton()

        // ACTION: #download.click: Either initiate a payment or open the download modal.
        $('#download').click(function () {
            console.log('Payment initiated with selection ' + currentButton)
            var paymentAmount = $('#' + currentButton).val() * 100
            console.log('Starting payment for ' + paymentAmount)
            // Free download
            if (paymentAmount < paymentMinimum) {
                ga('send', 'event', config.release.title + ' ' + config.release.version + ' Payment (Skip)', 'Homepage', paymentAmount)
                // Open the Download modal immediately.
                openDownloadOverlay()
            // Paid download
            } else {
                ga('send', 'event', config.release.title + ' ' + config.release.version + ' Payment (Initiated)', 'Homepage', paymentAmount)
                // Open the Stripe modal first.
                doStripeCheckout(paymentAmount)
            }
        })

        // UTILITY: detectStripeLanguage: Detect the language and use the Stripe translation if possible.
        function detectStripeLanguage () {
            var stripeLanguages = ['da', 'de', 'en', 'es', 'fi', 'fr', 'it', 'ja', 'nl', 'no', 'sv', 'zh']
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
                key: config.keys.stripe,
                token: function (token) {
                    console.log(JSON.parse(JSON.stringify(token)))
                    doStripePayment(amount, token)
                    openDownloadOverlay()
                },
                name: 'elementary LLC.',
                description: config.release.title + ' ' + config.release.version,
                bitcoin: true,
                alipay: false,
                locale: detectStripeLanguage() || 'auto',
                amount: amount
            })
        }

        // UTILITY: detectOS: Detect the OS
        function detectOS () {
            var ua = window.navigator.userAgent
            if (ua == null || ua === false) return 'Other'
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
                return 'macOS'
            }
            if (ua.indexOf('Linux') >= 0) {
                return 'Linux'
            }
            return 'Unknown'
        }
        var detectedOS = detectOS()

        // ACTION: doStripePayment: Actually process the payment via Stripe
        function doStripePayment (amount, token) {
            var paymentHTTP, $amountTen
            $amountTen = $('#amount-ten')
            ga('send', 'event', config.release.title + ' ' + config.release.version + ' Payment (Complete)', 'Homepage', amount)
            if ($amountTen.val() !== 0) {
                $('#pay-what-you-want').remove()
                $('#choice-buttons').html('<input type="hidden" id="amount-ten" value="0">')
                $amountTen.each(amountSelect)
                updateDownloadButton()
            }
            paymentHTTP = new XMLHttpRequest()
            paymentHTTP.open('POST', './api/payment.php', true)
            paymentHTTP.setRequestHeader('Content-type', 'application/x-www-form-urlencoded')
            paymentHTTP.send(
                'description=' + encodeURIComponent(config.release.title + ' ' + config.release.version) +
                '&amount=' + amount +
                '&token=' + token.id +
                '&email=' + encodeURIComponent(token.email) +
                '&os=' + detectedOS
            )
        }

        // ACTION: .download-http.click: Track download over HTTP
        $('.download-link').click(function () {
            ga('send', 'event', config.release.title + ' ' + config.release.version + ' Download (OS)', 'Homepage', detectedOS)
            ga('send', 'event', config.release.title + ' ' + config.release.version + ' Download (Region)', 'Homepage', config.user.region)
        })
        $('.download-link.http').click(function () {
            ga('send', 'event', config.release.title + ' ' + config.release.version + ' Download (Method)', 'Homepage', 'HTTP')
        })
        $('.download-link.magnet').click(function () {
            ga('send', 'event', config.release.title + ' ' + config.release.version + ' Download (Method)', 'Homepage', 'Magnet')
        })

        // RETURN: openDownloadOverlay: Open the Download modal.
        function openDownloadOverlay () {
            var $openModal
            $openModal = $('.open-modal')
            console.log('Open the download overlay!')
            $openModal.leanModal({
                // Add this class to download buttons to make them close it.
                closeButton: '.close-modal',
                disableCloseOnOverlayClick: true
            })
            // This is what actually opens the modal overlay.
            $openModal.click()
            doWebtorrentDownload()
        }

        // WebTorrent will only work if (streamSaver is supported and HTTPS is
        // used) or if Firefox is used (Firefox allows large blobs).
        // TODO
        var isFirefox = navigator.userAgent.toLowerCase().indexOf('firefox') >= 0
        var isHttps = window.location.protocol === 'https:'
        var useStreamSaver = streamSaver.supported && isHttps
        var useWebTorrent = WebTorrent.WEBRTC_SUPPORT && (useStreamSaver || isFirefox)
        var runningWebTorrent = false
        var downloadLink = '//' + config.user.region + '.dl.elementary.io/download/' + btoa(Date.now()) + '/'
        console.log('isFirefox is ' + isFirefox)
        console.log('isHttps is ' + isHttps)
        console.log('streamSaver.supported is ' + streamSaver.supported)
        console.log('WebTorrent.WEBRTC_SUPPORT is ' + WebTorrent.WEBRTC_SUPPORT)
        console.log('downloadLink is ' + downloadLink)

        // UTILITY: doWebtorrentDownload: Start the WebTorrent download.
        // TODO Track Webtorrent downloads
        function doWebtorrentDownload () {
            if (useWebTorrent && !runningWebTorrent) {
                $('#download-webtorrent').show()
                $('#download-direct').hide()
                // Initialize WebTorrent
                var client = new WebTorrent()
                client.on('error', function (err) {
                    console.error('WTERROR: ' + err.message)
                })
                // Add Torrent
                console.log('Starting Download from https:' + downloadLink + config.release.filename + '.torrent')
                // TODO Wrap in a try
                client.add(
                    // OPTION: Torrent file name to get instant metadata.
                    'https:' + downloadLink + config.release.filename + '.torrent',
                    {
                        announce: [
                            'https://ashrise.com:443/phoenix/announce',
                            'udp://open.demonii.com:1337/announce',
                            'udp://tracker.ccc.de:80/announce',
                            'udp://tracker.openbittorrent.com:80/announce',
                            'udp://tracker.publicbt.com:80/announce',
                            'wss://tracker.openwebtorrent.com',
                            'wss://tracker.webtorrent.io',
                            'wss://tracker.btorrent.xyz'
                        ]
                    },
                    onTorrent
                )
                console.log('Download started?')
            }
        }

        // onTorrent: Handles WebSeed addition and tracking, as well as progress bars and the save button.
        function onTorrent (torrent) {
            torrent.on('error', function (err) {
                console.error('TERROR: ' + err.message)
            })
            console.log('Download started.')
            torrent.addWebSeed('https:' + downloadLink + config.release.filename)
            if (window.ga) {
                ga('send', 'event', config.release.title + ' ' + config.release.version + ' Download (OS)', 'Homepage', detectedOS)
                ga('send', 'event', config.release.title + ' ' + config.release.version + ' Download (Region)', 'Homepage', config.user.region)
                ga('send', 'event', config.release.title + ' ' + config.release.version + ' Download (Method)', 'Homepage', 'Webtorrent')
            }
            // Print out progress every second
            var c = 0
            var interval = setInterval(
                function () {
                    var progress = (torrent.progress * 100).toFixed(1)
                    console.log('Progress: ' + progress + '% - ' + torrent.timeRemaining)
                    $('.progress').width(progress + '%')
                    $('.counter').html('<span class="float-left">' + progress + '% downloaded</span> <span class="float-right">' + (torrent.timeRemaining / 1000).toFixed() + ' seconds remaining</span>')
                    // If after 10 seconds there is less than 0.01% progress, display an alternative.
                    console.log('c=' + c + ' & progress=' + torrent.progress)
                    if (c++ > 10 && progress < 1) {
                        $('#download-alternative').show()
                    }
                },
                1000
            )
            var file = torrent.files[0] // There should only ever be one file.
            // Use streamSaver when possible to directly save file to disk.
            if (useStreamSaver) {
                $('#js-save-webtorrent').hide()
                var fileStream = streamSaver.createWriteStream(file.name, file.size)
                var writer = fileStream.getWriter()
                file.createReadStream().on('data', function (data) {
                    writer.write(data)
                }).on('end', function () {
                    writer.close()
                })
            }
            // Stop printing out progress.
            torrent.on('done', function () {
                console.log('Progress: 100%')
                // Stop the progress bar
                clearInterval(interval)
                $('.counter').text('Complete')
                // Offer to save file if streamSaver isn't supported.
                if (!useStreamSaver) {
                    file.getBlobURL(function (err, url) {
                        if (err) throw err
                        $('#js-save-webtorrent').removeClass('loading').addClass('suggested-action').attr('download', file.name).attr('href', url)
                    })
                }
            })
        }

        console.log('Loaded download.js')
    })
})
