var updateTotal = function() {
    var $products = $('.list--product .list__item input[name$="id"]')

    if ($products.length <= 0) location.reload()

    var total = 0

    $products.each(function(i, p) {
        var n = $(p).attr('name').split('-')[1]
        var price = $('.list--product .list__item input[name="product-' + n + '-price"]').val()
        var quantity = $('.list--product .list__item input[name="product-' + n + '-quantity"]').val()

        total += (price * quantity)
    })

    $('.list--product .list__footer h4:first-of-type').text('Sub-Total: $' + total)
}

$('.list--product .list__item input[name$="quantity"]').on('change', function(event) {
    var $input = $(this)
    var $form = $input.closest('form')

    $.get('/store/inventory', {
        id: $input.siblings('input[name$="id"]').val(),
        quantity: $input.val(),
        math: 'set',
        simple: true
    })
    .done(function(data) {
        if (data === 'OK') {
            console.log('Updated product quantity')

            if ($input.val() <= 0) {
                $input.closest('.list__item').remove();
            }

            updateTotal()
        } else if (data.indexOf('quantity')) {
            console.log('Unable to update quantity')
        }
    })
})

$('.list--product .list__item a[href^="/store/inventory"]').on('click', function(event) {
    event.preventDefault()

    var $row = $(this).closest('.list--product');

    $.get($(this).attr('href') + '&simple=true')
    .done(function(data) {
        if (data === 'OK') {
            $row.remove()
            updateTotal()
        } else {
            console.log('An error has occured trying to remove product')
            console.log(data)
        }
    })
    .fail(function(err) {
        console.log("Oh god, Not again.")
        console.log(err.statusText);
    })
})
