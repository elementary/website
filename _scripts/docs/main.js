/**
 * _scripts/docs/main.js
 * Does code highlighting, sidebar generation, and hash updating for doc pages
 */

import Promise from 'core-js/fn/promise'

import highlight from '~/lib/highlight'
import jQuery from '~/lib/jquery'

Promise.all([highlight, jQuery]).then(([hljs, $]) => {
    $(document).ready(function () {
        // Code blocks highlighting
        $('pre code').each(function (i, block) {
            // Remove newline from CloudFlare's e-mail protection script
            $(this).find('script').each(function () {
                $(this).text($(this).text().trim())
            })

            // Add line numbers, unless it's bash or doesn't want to be highlighted
            if (!$(this).is('.language-bash') && !$(this).hasClass('nohighlight')) {
                var lines = $(this).text().trim().split('\n').length
                var $numbering = $('<ul/>').addClass('pre-numbering')
                $(this).parent().addClass('has-numbering').prepend($numbering)

                for (var l = 1; l <= lines; l++) {
                    $numbering.append($('<li/>').text(l))
                }
            }

            $(this).parent().addClass('highlighted')

            if (!$(this).hasClass('nohighlight')) {
                // Highlight code block
                hljs.highlightBlock(block)
            } else {
                // Fake highlighting for stylesheet things
                $(this).addClass('hljs')
            }
        })

        // Anchor headings
        $('h1[id], h2[id], h3[id], h4[id], h5[id], h6[id]').each(function () {
            $(this).wrapInner('<a class="heading-link" href="' + window.location.pathname + '#' + $(this).attr('id') + '"></a>')
        })

        // Sidebar
        var $headings = $('h1')
        var $sidebar = $('<div class="sidebar"></div>')
        if ($headings.length > 1) {
            var $index = $('<ul class="index"></ul>')
            $headings.each(function () {
                $index.append('<li><a href="#' + $(this).attr('id') + '">' + $(this).text() + '</a></li>')
                var $subHeadings = $(this).nextUntil('h1', 'h2')
                if ($subHeadings.length > 0) {
                    var $subMenu = $('<ul></ul>')
                    $subHeadings.each(function () {
                        $subMenu.append('<li><a href="#' + $(this).attr('id') + '">' + $(this).text() + '</a></li>')
                    })
                    $index.append($subMenu)
                }
            })
            $index.prependTo($sidebar)

            var $actions = $('<ul class="actions"></ul>')
            $('<li><a href="https://github.com/elementary/mvp/blob/master/docs' + window.location.pathname.split('/docs')[1] + '.md" id="edit"><i class="fa fa-pencil"></i> Edit</a></li>').appendTo($actions)
            $actions.appendTo($sidebar)

            var secondUp = window.location.pathname.split('/')[1]
            var transifexTitle = window.location.pathname.split('/docs/')[1].split('#')[0].replace('/', '_')
            if (secondUp !== 'docs' && secondUp !== 'en') {
                $('<li><a href="https://www.transifex.com/elementary/elementary-mvp/translate/#' + secondUp + '/docs_' + transifexTitle + '" id="translate"><i class="fa fa-globe"></i> Translate</a></li>').appendTo($actions)
                $actions.appendTo($sidebar)
            }

            $sidebar.prependTo('#content-container')
        }

        // Update javascript variable currentSection
        var docElements = $('h1[id], h2[id]', '.docs')

        var currentSection = null
        if (window.location.hash && docElements.is('#' + window.location.hash.substr(1).split('#')[0])) {
            currentSection = $('#' + window.location.hash.substr(1).split('#')[0], docElements)
        } else {
            currentSection = docElements[0]
        };

        // Makes sidebar sticky with footer and header
        function sidebarHandle () {
            if ($(window).width() <= 990) return

            var scrollTop = $('body').scrollTop()
            var $header = $('nav:first-of-type')
            var $footer = $('footer')
            var $sidebar = $('.sidebar')

            var headerFromTop = $header.height() - scrollTop
            var headerSquish = (headerFromTop > 0) ? headerFromTop : 0

            if (headerSquish === 0) {
                $sidebar.addClass('sticky')
            } else {
                $sidebar.removeClass('sticky')
            }

            var footerFromBottom = $(document).height() - $(window).height() - $footer.height() - scrollTop
            var footerSquish = (footerFromBottom < 0) ? Math.abs(footerFromBottom) : 0

            $sidebar.css('height', 'calc(100% - ' + footerSquish + 'px - ' + headerSquish + 'px)')
        }

        // Scrolling function to run
        function scrollHandle () {
            // Check to see what is on screen right now
            for (var i = 0; i < docElements.length; i++) {
                var docViewTop = $(window).scrollTop()
                var elemTop = $(docElements[i]).offset().top

                // Sets currentSection if element is top most visible element
                if ((elemTop <= docViewTop)) {
                    currentSection = docElements[i]
                // Sets currentSection if element is more than 1/3 from the top
                } else if (elemTop <= (docViewTop + ($(window).height() / 6))) {
                    currentSection = docElements[i]
                // Catch when the it's the first element and below the 'current' area
                } else if (docElements[i - 1] == null) {
                    currentSection = docElements[i]
                } else {
                    break
                }
            }

            // Changes browser hash without adding to history
            if (currentSection.id !== window.location.hash.substr(1)) {
                window.history.replaceState(undefined, undefined, window.location.href.split('#')[0] + '#' + currentSection.id)
            }

            // Changes sidebar link classes based on what's currently active
            $('.sidebar .index .active').removeClass('active')
            var $currentLink = $('.sidebar .index a[href$="#' + currentSection.id + '"]')
            if ($currentLink.parent().parent().is('.index')) {
                $currentLink.parent().addClass('active')
            } else {
                ($currentLink.parent().parent().prev('li').addClass('active'))
            };
        }

        // Scroll timeout handling
        var repositionedAt = new Date()
        var repositionTimer = null

        $(window).scroll(function () {
            if ($(window).width() <= 990) return

            var diff = new Date().getTime() - repositionedAt

            sidebarHandle()

            if (repositionedAt == null || diff >= 500) {
                repositionedAt = new Date().getTime()
                scrollHandle()
            } else { // Wait until scroll spam stops
                clearTimeout(repositionTimer)
                repositionTimer = setTimeout(scrollHandle, 500)
            }
        })

        // Run scrolling function at first load
        sidebarHandle()
        scrollHandle()
    })
})
