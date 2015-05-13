$(function () {
    var current_page = window.location.pathname;
    $('a').not('[href*="mailto:"]').each(function () {
        var href = this.href;
        if ( href.indexOf(window.location.host) == -1 ) {
            $(this).attr('target', '_blank');
        }
        if ( href == current_page ) {
            $(this).addClass('current-page');
        }
    });
});
