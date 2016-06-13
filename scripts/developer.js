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
    $('#download-modal a.suggested-action').click(function(){
        if (window.ga) {
            ga('send', 'event', release_title + ' ' + release_version + ' Download (Beta)', 'Developer');
        }
    });
})
