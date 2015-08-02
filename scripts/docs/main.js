$(document).ready(function() {
    // Code blocks highlighting
    $('pre code').each(function(i, block) {
        // Remove newline from CloudFlare's e-mail protection script
        $(this).find('script').each(function () {
            $(this).text($(this).text().trim());
        });

        // Add line numbers
        if (!$(this).is('.language-bash')) {
            var lines = $(this).text().trim().split('\n').length;
            var $numbering = $('<ul/>').addClass('pre-numbering');
            $(this).parent().addClass('has-numbering').prepend($numbering);

            for (var i = 1; i <= lines; i++){
                $numbering.append($('<li/>').text(i));
            }
        }
        $(this).parent().addClass('highlighted');

        // Highlight code block
        hljs.highlightBlock(block);
    });

    // Anchor headings
    $('h1[id], h2[id], h3[id], h4[id], h5[id], h6[id]').each(function() {
        $(this).wrapInner('<a class="heading-link" href="'+window.location.pathname+'#'+$(this).attr('id')+'"></a>');
    });

    // Update javascript variable currentSection
    var docElements = $('h1[id], h2[id]', '.docs');

    var currentSection = null;
    if (location.hash) {
      currentSection = location.hash;
    } else {
      currentSection = docElements[0];
    };
    $(document).on('scroll', function (event) {
        // Check to see what is on screen right now
        for (var i = 0; i < docElements.length; i++) {
            // Checks if the passed element is visible on the screen after scrolling
            // Source: http://stackoverflow.com/questions/487073/check-if-element-is-visible-after-scrolling
            var docViewTop = $(window).scrollTop();
            var docViewBottom = docViewTop + $(window).height();

            var elemTop = $(docElements[i]).offset().top;
            var elemBottom = elemTop + $(docElements[i]).height();

            // Sets currentSection if element is top most visible element
            if ((elemTop <= docViewTop)) {
                currentSection = docElements[i];
            // Sets currentSection if element is more than 1/3 from the top
            } else if (elemTop <= (docViewTop + ($(window).height() / 3) )) {
                currentSection = docElements[i];
            };
        };
    });

    // Url hash selector. Only in docs class to avoid nav conflicts
    $(document).on('scroll', function (event) {
        // Changes browser hash without adding to history
        history.replaceState(undefined, undefined, location.href.split("#")[0]+"#"+currentSection.id);
    });

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

            $('ul.sidebar .active').removeClass('active');
            var $currentLink = $('ul.sidebar a[href$="#'+currentSection.id+'"]')
            if ($currentLink.parent().parent().is('.sidebar')) {
                $currentLink.parent().addClass('active');
            } else {
              ($currentLink.parent().parent().prev('li').addClass('active'));
            };
        });
        $(window).scroll(); // Trigger event
    }
});
