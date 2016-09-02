/* global ga releaseTitle releaseVersion hljs */

/**
 * Loki beta download hero
 */

$(function () {
    $('#download').bind('click', function (e) {
        e.preventDefault()
        $('.open-modal').leanModal({
            closeButton: '.close-modal'
        })
        $('.open-modal').click()
    })

    $('#download-modal a.suggested-action').click(function () {
        if (window.ga) {
            ga('send', 'event', releaseTitle + ' ' + releaseVersion + ' Download (Beta)', 'Developer')
        }
    })
})

/**
 * Code highlighting on developer page
 */
$('document').ready(function () {
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
})
