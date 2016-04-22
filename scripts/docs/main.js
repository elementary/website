$(document).ready(function() {
    // Code blocks highlighting
    $('pre code').each(function(i, block) {
        // Remove newline from CloudFlare's e-mail protection script
        $(this).find('script').each(function () {
            $(this).text($(this).text().trim());
        });

        // Add line numbers, unless it's bash or doesn't want to be highlighted
        if (!$(this).is('.language-bash') && !$(this).hasClass('nohighlight')) {
            var lines = $(this).text().trim().split('\n').length;
            var $numbering = $('<ul/>').addClass('pre-numbering');
            $(this).parent().addClass('has-numbering').prepend($numbering);

            for (var i = 1; i <= lines; i++){
                $numbering.append($('<li/>').text(i));
            }
        }

        $(this).parent().addClass('highlighted');

        if (!$(this).hasClass('nohighlight')) {
          // Highlight code block
          hljs.highlightBlock(block);
        } else {
          // Fake highlighting for stylesheet things
          $(this).addClass('hljs');
        }
    });

    // Anchor headings
    $('h1[id], h2[id], h3[id], h4[id], h5[id], h6[id]').each(function() {
        $(this).wrapInner('<a class="heading-link" href="'+window.location.pathname+'#'+$(this).attr('id')+'"></a>');
    });

    // Sidebar
    var $headings = $('h1');
    var $sidebar = $('<ul class="sidebar"></ul>');
    if ($headings.length > 1) {
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
        $('<div class="edit-doc"><a href="https://github.com/elementary/mvp/blob/master' + window.location.pathname + '.md"><i class="fa fa-pencil"></i> Edit</a></div>').prependTo('#content-container');
        $sidebar.prependTo('#content-container');

        var $sidebarItems = $sidebar.children('li');

        var navHeight = $('nav.nav:first').height();
        var footerScrollTop = $('footer:last').offset().top;
        var prevTarget = 0,
            nextTarget = 0;
    }

    // Update javascript variable currentSection
    var docElements = $('h1[id], h2[id]', '.docs');

    var currentSection = null;
    if (location.hash && docElements.is("#" + location.hash.substr(1).split("#")[0])) {
        currentSection = $("#" + location.hash.substr(1).split("#")[0], docElements);
    } else {
        currentSection = docElements[0];
    };

    // Scrolling function to run
    function scrollHandle() {
        // Check to see what is on screen right now
        for (var i = 0; i < docElements.length; i++) {
            var docViewTop = $(window).scrollTop();
            var elemTop = $(docElements[i]).offset().top;

            // Sets currentSection if element is top most visible element
            if ((elemTop <= docViewTop)) {
                currentSection = docElements[i];
            // Sets currentSection if element is more than 1/3 from the top
            } else if (elemTop <= (docViewTop + ($(window).height() / 6) )) {
                currentSection = docElements[i];
            // Catch when the it's the first element and below the 'current' area
            } else if (docElements[i - 1] == null) {
                currentSection = docElements[i]
            } else {
                break
            };
        };

        // Changes browser hash without adding to history
        if (currentSection.id !== location.hash.substr(1)) {
            history.replaceState(undefined, undefined, location.href.split("#")[0]+"#"+currentSection.id);
        }

        var scrollTop = $(this).scrollTop();

        $sidebar.toggleClass('nav-visible', (scrollTop < navHeight));
        $sidebar.toggleClass('footer-visible', (scrollTop + $(window).height() > footerScrollTop));

        $('ul.sidebar .active').removeClass('active');
        var $currentLink = $('ul.sidebar a[href$="#'+currentSection.id+'"]')
        if ($currentLink.parent().parent().is('.sidebar')) {
            $currentLink.parent().addClass('active');
        } else {
          ($currentLink.parent().parent().prev('li').addClass('active'));
        };
    }

    // Scroll timeout handling
    var repositionedAt = new Date()
    var repositionTimer = null

    $(window).scroll(function () {
        var diff = new Date().getTime() - repositionedAt;

        if (repositionedAt == null || diff >= 500) {
            repositionedAt = new Date().getTime();
            scrollHandle();
        } else {
            clearTimeout(repositionTimer)
            repositionTimer = setTimeout(scrollHandle, 100)
        }
    });

    // Run scrolling function at first load
    scrollHandle();
});
