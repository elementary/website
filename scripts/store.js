$(function() {
    if (typeof store === 'undefined' || store.length === 0) {
        console.log('The shelves are empty today')
        return
    }

    console.log('Come and get your hot ' + Object.keys(store).length + ' items today!')

    $('.product img').on('click', function(event) {
        if (event.target != this) { return }
        event.preventDefault()

        var $trigger = $(this).siblings('.open-modal')
        var id = $trigger.attr('id')
        var $modal = $('div.modal#' + id)

        $trigger.leanModal({
            closeButton: '.close-modal'
        })
        $trigger.click()
    })

    $('.modal form select').on('change', function(event) {
        var uid = $(this).parent().find('input[name="uid"]').val()
        var size = $(this).parent().find('select[name="size"]').val()
        var color = $(this).parent().find('select[name="color"]').val()

        var $modal = $(this).closest('.modal')

        store.forEach(function(value) {
            if (uid !== value.uid) return
            if (size != null && value.size !== size) return
            if (color != null && value.color !== color) return

            $modal.find('input[name="id"]').val(value.id)
            $modal.find('.price').text('$' + value.retail_price)
        })
    })

    $('.modal form').on('submit', function(event) {
        event.preventDefault()
        $form = $(this)

        var id = $form.find('input[name="id"]').val()
        if (typeof id === 'undefined') {
            console.log('This is not for sale sir')
            return
        }

        var quantity = $form.find('input[name="quantity"]').val()
        if (typeof quantity === 'undefined') {
            console.log('Sir, you are pointing at a wall')
            return
        }

        $.get('store/addtocart', {
            id: id,
            quantity: quantity
        })
        .done(function(data) {
            if (data === 'OK') {
                $form.find('input[name="quantity"]').val('1')
                $form.closest('.modal').find('.close-modal').click()
            } else {
                console.log('Well this is embarrassing')
            }
        })
        .fail(function() {
            console.log("That's no store!")
        })
    })
})
