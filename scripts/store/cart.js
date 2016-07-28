var updateTotal = function() {
    var $products = $('.list--product .list__item')

    if ($products.length <= 0) location.reload()

    var total = 0

    $products.each(function(i, p) {
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

$('.list--product .list__item input[name$="quantity"]').on('change', function(event) {
    var $input = $(this)
    var $item = $input.closest('.list__item')
    var i = $item.attr('id').replace('product-', '')

    var id = $item.find('input[name$="id"]').val()
    var quantity = $input.val()
    var $err = $item.find('.alert--error')

    $.get('/store/inventory', {
        id: id,
        quantity: quantity,
        math: 'set',
        simple: true
    })
    .done(function(data) {
        if (data === 'OK') {
            $err.text('')

            if (quantity <= 0) {
                $item.remove();
            }

            updateTotal()
        } else if (data.indexOf('quantity')) {
            $err.text('Unable to update quantity')
        }
    })
})
