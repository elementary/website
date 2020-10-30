/**
 * _scripts/pages/download.js
 * Handles homepage payment and OS image downloading
 */

/* global plausible */

import jQuery from '~/lib/jquery'
import modal from '~/lib/modal'

import { url, detectedOS } from '~/page'
import config from '~/config'

import Payment from '~/widgets/payment'

Promise.all([config, jQuery, Payment, modal]).then(([config, $, Payment]) => {
    // DEBUG
    console.log('Config at download.js:')
    console.log(config)
    // END DEBUG
    const payment = new Payment(`${config.release.title} ${config.release.version}`)

    $(document).ready(() => {
        // Set defaults
        var paymentMinimum = 100 // Let's make the minimum $1 because of processing fees.
        var currentButton = 'amount-twenty' // Default to $20 when the page loads.
        var previousButton = 'amount-twenty' // Defaulting to $20 means it will be the first previous.

        // ACTION: amountSelect: Track the current and previous amounts selected.
        var amountSelect = function (e) {
            var targetID = $(e.target).attr('id') // avoids null values vs native js
            console.log('Setting payment target to #' + targetID)
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

            // Disables button for 3 seconds after clicking it
            var download = $(this)
            download.prop('disabled', true)
            setTimeout(function () {
                download.prop('disabled', false)
            }, 3000)

            // Free download
            if (Number.isNaN(paymentAmount) || paymentAmount < paymentMinimum) {
                plausible('Payment', {
                    props: {
                        Input: paymentAmount.toString(),
                        Amount: '0',
                        Action: 'Skipped'
                    }
                })
                // Open the Download modal immediately.
                openDownloadOverlay()
            // Paid download
            } else {
                // Open the Stripe modal first.
                payment.checkout(paymentAmount, 'USD')
                    .then(([token]) => doStripePayment(paymentAmount, token))
                    .then(() => openDownloadOverlay())
                    .then(() => plausible('Payment', {
                        props: {
                            Input: paymentAmount.toString(),
                            Amount: paymentAmount.toString(),
                            Action: 'Complete'
                        }
                    }))
                    .catch((err) => {
                        console.error('Error while making payment')
                        console.error(err)
                        plausible('Payment', {
                            props: {
                                Input: paymentAmount.toString(),
                                Amount: '0',
                                Action: 'Failed'
                            }
                        })
                        openDownloadOverlay() // Just in case. Don't interupt the flow
                        throw err // rethrow so it can be picked up by error tracking
                    })
            }
        })

        // ACTION: doStripePayment: Actually process the payment via Stripe
        function doStripePayment (amount, token) {
            var $amountTwenty = $('#amount-twenty')
            if ($amountTwenty.val() !== 0) {
                $('#pay-what-you-want').remove()
                $('#choice-buttons').remove()
                $('#amounts').append('<div id="choice-buttons"><input type="hidden" id="amount-twenty" value="0"></div>')
                currentButton = 'amount-twenty'
                updateDownloadButton()
            }

            // Because jQuery "promises" are not A+ standard
            return new Promise((resolve, reject) => {
                $.post(`${url()}/api/payment`, {
                    description: `${config.release.title} ${config.release.version}`,
                    amount: amount,
                    token: token.id,
                    email: token.email,
                    os: detectedOS()
                })
                    .done((res) => resolve(res))
                    .fail((xhr, status) => reject(new Error(status)))
            })
        }

        // ACTION: .download-http.click: Track downloads
        $('.download-link').click(function () {
            let downloadMethod = 'Unknown'
            if ($(this).hasClass('magnet')) {
                downloadMethod = 'Magnet'
            }
            if ($(this).hasClass('http')) {
                downloadMethod = 'HTTP'
            }
            plausible('Download', {
                props: {
                    Region: config.user.region,
                    Method: downloadMethod,
                    OS: detectedOS(),
                    Version: config.release.version
                }
            })
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
        }

        console.log('Loaded download.js')
    })
})
