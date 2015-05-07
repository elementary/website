$(function () {
    $('a').not('[href*="mailto:"]').each(function () {
        var a = new RegExp(window.location.host);
        var href = this.href;
        if ( ! a.test(href) ) {
            $(this).attr('target', '_blank');
        }
    });
});
