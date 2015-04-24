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

        var navHeight = $('nav.nav:first').height();
        $(window).scroll(function () {
            var scrollTop = $(this).scrollTop();

            $sidebar.toggleClass('nav-hidden', (scrollTop > navHeight));
        });
        $(window).scroll(); // Trigger event
    }
});