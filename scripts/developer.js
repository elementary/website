/**
 * Loki beta download hero
 */
$(function() {
    $('#download').bind('click', function(e) {
        e.preventDefault();

        $('.open-modal').leanModal({
            closeButton: '.close-modal',
        });
        $('.open-modal').click();
    });
})
