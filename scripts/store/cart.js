/**
 * scripts/store/cart.js
 * Does update logic for cart quantities and some basic address validation
 */

/**
 * updateTotal
 * Adds prices for everything in cart and puts sub total in footer
 */
var updateTotal = function () {
    var $products = $('.list--product .list__item')

    if ($products.length <= 0) location.reload()

    var total = 0

    $products.each(function (i, p) {
        var n = $(p).attr('id').replace('product-', '')
        var $i = $('.list__item#product-' + n)

        var price = $('input[name$="price"]', $i).val()
        var quantity = $('input[name$="quantity"]', $i).val()

        var t = (price * quantity)
        $('.subtotal b', $i).text('$' + parseFloat(t).toFixed(2))

        total += t
    })

    $('.list--product .list__footer h4').text('Sub-Total: $' + parseFloat(total).toFixed(2))
}

/**
 * POSTs to inventory endpoint to update cart quantities without page refresh
 */
$('.list--product .list__item input[name$="quantity"]').on('change', function (e) {
    try {
        if (!$(this)[0].checkValidity || !$(this)[0].checkValidity()) return
    } catch (err) {
        console.error('You have a really old browser...')
    }

    var $input = $(this)
    var $item = $input.closest('.list__item')

    var id = $item.attr('id').replace('product-', '').split('-')
    var productId = id[0]
    var variantId = id[1]

    var quantity = $input.val()
    var $error = $item.find('.alert--error')

    console.log(id)

    $.get('/store/inventory', {
        id: productId,
        variant: variantId,
        quantity: quantity,
        math: 'set',
        simple: true
    })
    .done(function (data) {
        if (data === 'OK') {
            $error.text('')

            if (quantity <= 0) $item.remove()

            updateTotal()
        } else {
            console.error('Unable to update cart quantity')
            console.error(data)
            $error.text('Unable to update quantity')
        }
    })
})
