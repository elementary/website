$(function() {
    if (typeof store === 'undefined' || store.length === 0) {
        console.log('The shelves are empty today')
        return
    }

    console.log('Come and get your hot ' + Object.keys(store).length + ' items today!')

    $('.grid--product .grid__item img').on('click', function(event) {
        if (event.target != this) return
        event.preventDefault()

        var $trigger = $(this).closest('.grid__item').find('.open-modal')

        $trigger.leanModal({
            top: '5vh',
            overlayOpacity: 0.5,
            closeButton: '.close-modal',
        });
        $trigger.click();
    })

    $('.modal form[action="/store/inventory"] select').on('change', function(event) {
        var $form = $(this).closest('form')
        var $modal = $form.closest('.modal')

        var uid = $form.find('input[name="uid"]').val()
        var size = $form.find('select[name="size"]').val()
        var color = $form.find('select[name="color"]').val()

        for (var key in store) {
            var value = store[key]

            if (uid !== value.uid) continue
            if (size != null && value.size !== size) continue
            if (color != null && value.color !== color) continue

            $form.find('input[name="id"]').val(value.id)
            $modal.find('.modal__price').text('$' + parseFloat(value.price).toFixed(2))
            $('.alert--error', $form).text('')
            return
        }

        $('.alert--error', $form).text('Unable to find item')
    })

    $('.modal form[action="/store/inventory"]').on('submit', function(event) {
        event.preventDefault()
        $form = $(this)
        $err = $('.alert--error', $form)

        $.post($form.attr('action'), $form.serialize() + '&simple=true')
        .done(function(data, status) {
            if (data !== 'OK') {
                $err.text('Unable to add to cart')
                console.log('Well this is embarrassing')
                console.log(data)
                return
            }

            $err.text('')
            $form.find('input[name="quantity"]').val('1')
            $form.closest('.modal').find('.close-modal').click()
        })
        .fail(function(err) {
            $err.text('An error occured')
            console.log("Oh god, Not again.")
            console.log(err.statusText);
        })
    })
})
