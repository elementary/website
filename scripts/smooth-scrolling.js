$(function () {
    $(document).on('click', 'a', function (event) {
        // Event already handled?
        if (event.isDefaultPrevented()) {
            return;
        }

        // Get link href
        var $anchor = $(this);
        var href = $anchor.attr('href');
        if (
            href[0] !== '#' &&
            href.indexOf(window.location.host) == -1
        ) {
            return;
        }

        // This handles /path/current-page#element
        href = href.split('#').pop();

        // Get offset
        var scrollTop;
        if (href === '') {
            scrollTop = 0;
        } else {
            var $target = $('#'+href);
            if (!$target.length) { // Anchor target not in this page
                return;
            }
            scrollTop = $target.offset().top;
        }

        // Smooth scrolling
        $('html, body').stop().animate({
            scrollTop: scrollTop
        }, 'normal', function () {
            window.location.hash = href;
        });

        event.preventDefault();
    });

    // Fix anchors
    // Let other scripts add links to DOM before fixing them
    setTimeout(function () {
        $('a[href^="#"]').each(function () {
            if ( !$(this).hasClass('open-modal') ) {
                var href = $(this).attr('href');
                $(this).attr('href', window.location.pathname + href);
            }
        });
    }, 0);
});
