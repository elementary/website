$(document).ready(function() {
    // Code blocks highlighting
    $('pre code').each(function(i, block) {
        // Remove newline from CloudFlare's e-mail protection script
        $(this).find('script').each(function () {
            $(this).text($(this).text().trim());
        });

        // Add line numbers
        var lines = $(this).text().trim().split('\n').length;
        var $numbering = $('<ul/>').addClass('pre-numbering');
        $(this).parent().addClass('highlighted has-numbering').prepend($numbering);

        for (var i = 1; i <= lines; i++){
            $numbering.append($('<li/>').text(i));
        }

        // Highlight code block
        hljs.highlightBlock(block);
    });

	// Anchor headings
    $('h1[id], h2[id], h3[id], h4[id], h5[id], h6[id]').each(function() {
        $(this).wrap('<a href="#'+$(this).attr('id')+'"></a>');
    })

    // Sidebar
    var $headings = $('h1');
    if ($headings.length > 1) {
        var $sidebar = $('<ul class="sidebar"></ul>');
        $headings.each(function () {
            $sidebar.append('<li><a href="#'+$(this).attr('id')+'">'+$(this).text()+'</a></li>');
            var $subHeadings = $(this).nextUntil('h1', 'h2');
            if ($subHeadings.length > 0) {
                var $subMenu = $('<ul></ul>');
                $subHeadings.each(function () {
                    $subMenu.append('<li><a href="#'+$(this).attr('id')+'">'+$(this).text()+'</a></li>');
                });
                $sidebar.append($subMenu);
            }
        });
        $sidebar.prependTo('#content-container');

        var $sidebarItems = $sidebar.children('li');

        var navHeight = $('nav.nav:first').height();
        var footerScrollTop = $('footer:last').offset().top;
        var prevTarget = 0,
            nextTarget = 0;
        $(window).scroll(function () {
            var scrollTop = $(this).scrollTop();

            $sidebar.toggleClass('nav-visible', (scrollTop < navHeight));
            $sidebar.toggleClass('footer-visible', (scrollTop + $(window).height() > footerScrollTop));

            var $current = null;
            if (scrollTop >= nextTarget) {
                $headings.each(function () {
                    var headingScrollTop = Math.floor($(this).offset().top);
                    if (headingScrollTop > scrollTop) {
                        $current = $(this).prevAll('h1').first() || $(this);
                        prevTarget = nextTarget;
                        nextTarget = headingScrollTop;
                        return false;
                    }
                });
                if (!$current) {
                    $current = $headings.last();
                    prevTarget = nextTarget;
                    nextTarget = Number.POSITIVE_INFINITY;
                }
                if (!prevTarget) {
                    prevTarget = Math.floor($current.first().offset().top);
                }
            }
            if (scrollTop < prevTarget) {
                $($headings.get().reverse()).each(function () {
                    var headingScrollTop = $(this).offset().top;
                    if (headingScrollTop < scrollTop) {
                        $current = $(this);
                        prevTarget = Math.floor(headingScrollTop);
                        nextTarget = prevTarget;
                        return false;
                    }
                });
                if (!$current) {
                    $current = $headings.first();
                    prevTarget = 0;
                    nextTarget = $($headings[1]).offset().top;
                }
            }
            if ($current) {
                $sidebarItems.removeClass('active');
                var $activeItem = $sidebarItems.children('a[href="#'+$current.attr('id')+'"]').parent();
                $activeItem.addClass('active');
                if ($activeItem.next().is('ul')) {
                    $activeItem.next().addClass('active');
                }
            }
        });
        $(window).scroll(); // Trigger event
    }
});
