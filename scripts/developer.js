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

    $('#download-modal #entrycheck input').bind('input', function() {
        var $entry = $('#download-modal #entrycheck');
        var val = $('input', $entry).val();

        if (val.indexOf($('label', $entry).text()) !== -1) {
            $('.row.actions').css("display", "block");
        } else {
            $('.row.actions').css("display", "none");
        }
    });
})
