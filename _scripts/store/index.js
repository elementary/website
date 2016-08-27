/**
 * scripts/store/index.js
 * Does logic for picking product variants and adding to cart
 */

import Promise from 'core-js/fn/promise'

import jQuery from 'lib/jquery'
import modal from 'lib/modal'

Promise.all([jQuery, modal]).then(([$]) => {
    $('document').ready(function () {
        var baseUrl = $('base').attr('href')
        var products = []

        if (typeof window.products !== 'undefined') {
            products = window.products
        } else if (products.length === 0) {
            console.error('Unable to find store data')

            $.getJSON(baseUrl + 'data/store.json', function (data) {
                console.log('Was able to fetch store data manually')

                products = data
            })
        }

        /**
         * Opens product modal on image click
         */
        $('.grid--product .grid__item *').on('click', function (e) {
            if (e.target !== this) return

            var $item = $(this).closest('.grid__item')
            if ($item.attr('id').indexOf('product') === -1) return

            e.preventDefault()

            var $trigger = $item.find('.open-modal')

            $trigger.leanModal({
                top: '5vh',
                overlayOpacity: 0.5,
                closeButton: '.close-modal'
            })
            $trigger.click()
        })

        /**
         * updateVariant
         * Updates a modal with new variant data
         *
         * @param {Object} $f - the jQuery form to update
         * @param {Object} p - the product object
         * @param {Object} v - the variant object
         *
         * @return {Void}
         */
        var updateVariant = function ($f, p, v) {
            var $m = $f.closest('.modal')

            // Update price information
            $f.find('input[name="variant"]').val(v['id'])
            $m.find('.modal__price').text('$' + parseFloat(v['price']).toFixed(2))

            if (v['image'] != null) {
                $m.find('img').prop('src', v['image'])
            } else {
                $m.find('img').prop('src', p['image'])
            }

            // Update modal information
            setValue($f, 'size', v['size'])
            setValue($f, 'color', v['color'])
        }

        /**
         * getValue
         * Returns the current value of X in the form
         * NOTE: currently only supports buttons and select elements
         *
         * @param {Object} $f - the jQuery form to look in
         * @param {String} n - the name of the value to lookup
         *
         * @return {String} - the value of n
         */
        var getValue = function ($f, n) {
            var $b = $f.find('button[name=' + n + ']')

            if ($b.length) {
                return $b.filter('.checked').val()
            } else {
                return $f.find('select[name=' + n + ']').val()
            }
        }

        /**
         * setValue
         * Sets the value of X in the form
         * NOTE: currently only supports buttons and select elements
         *
         * @param {Object} $f - the jQuery form to look in
         * @param {String} n - the name of the value to change
         * @param {String} v - the value to change it to
         *
         * @return {Void}
         */
        var setValue = function ($f, n, v) {
            var $i = $f.find('input[name=' + n + ']')
            var $s = $f.find('select[name=' + n + ']')
            var $b = $i.siblings('button.target-amount')

            $i.val(v)
            $s.val(v)

            if ($b.length) {
                $b.removeClass('checked')
                $b.filter('[value="' + v + '"]').addClass('checked')
            }
        }

        /**
         * updateInfo
         * Updates the product modal based on new user input
         *
         * @param {Object} $f - the jQuery object of the form
         * @param {String} t - type of input that changed (color, size, etc)
         * @param {String} v - new value of input
         *
         * @return {Void}
         */
        var updateInfo = function ($f, t, v) {
            var $id = $f.find('input[name="id"]')

            var id = Number($id.val())
            var size = getValue($f, 'size')
            var color = getValue($f, 'color')

            if (t === 'size') {
                size = v
            } else if (t === 'color') {
                color = v
            } else {
                throw new Error('Unable to use updateInfo on anything besides size or color')
            }

            var p = null
            for (var pi in products) {
                if (products[pi]['id'] !== id) continue
                p = products[pi]
            }

            if (p == null) {
                $('.alert--error', $f).text('Unable to find product')
                $('input[type="submit"]', $f).prop('disabled', true)
                return
            }

            for (var i in p['variants']) {
                var variant = p['variants'][i]

                if (size != null && variant['size'] !== size) continue
                if (color != null && variant['color'] !== color) continue

                updateVariant($f, p, variant)

                $('.alert--error', $f).text('')
                $('input[type="submit"]', $f).prop('disabled', false)

                return
            }

            $('.alert--error', $f).text('Unable to find variant')
            $('input[type="submit"]', $f).prop('disabled', true)
        }

        /**
         * Handles button selection input and switching
         */
        $('.modal--product form[action$="inventory"] button.target-amount').on('click', function (e) {
            e.preventDefault()

            var $input = $(this).siblings('input')

            var $form = $(this).closest('form')
            var type = $input.attr('name')
            var value = $(this).attr('value')

            updateInfo($form, type, value)
        })

        /**
         * Updates product variance based on user input (size, color, etc)
         */
        $('.modal--product form[action$="inventory"] select').on('change', function (e) {
            e.preventDefault()

            var $form = $(this).closest('form')
            var type = $(this).attr('name')
            var value = $(this).val()

            updateInfo($form, type, value)
        })
    })
})
