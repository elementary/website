var updateTotal = function() {
    var $products = $('.row.product input[name$="id"]')

    if ($products.length <= 0) location.reload()

    var total = 0

    $products.each(function(i, p) {
        var n = $(p).attr('name').split('-')[1]
        var price = $('.row.product input[name="product-' + n + '-price"]').val()
        var quantity = $('.row.product input[name="product-' + n + '-quantity"]').val()

        total += (price * quantity)
    })

    $('.totals').html('Sub-Total: $' + total)
}

$(function() {
    $('.row.product input[name$="quantity"]').on('change', function(event) {
        var $input = $(this)
        var $form = $input.closest('form')

        $.get('/store/inventory', {
            id: $input.siblings('input[name$="id"]').val(),
            quantity: $input.val(),
            math: 'set'
        })
        .done(function(data) {
            if (data === 'OK') {
                updateTotal()
                console.log('Updated product quantity')
            } else if (data.indexOf('Invalid quantity')) {
                $input.val(data.split(':')[1])
            }
        })
    })

    $('.row.product a').on('click', function(event) {
        event.preventDefault()

        var $row = $(this).closest('.row.product');

        $.get($(this).attr('href'))
        .done(function(data) {
            if (data === 'OK') {
                $row.remove()
                updateTotal()
            } else {
                console.log('An error has occured trying to remove product')
            }
        })
        .fail(function() {
            console.log('Failed to make a connection')
        })
    })
})
