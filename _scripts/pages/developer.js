/**
 * _scripts/pages/developer.js
 * Page handling for all JS things on the developer page
 */

import Promise from 'core-js/fn/promise'

import highlight from '~/lib/highlight'
import jQuery from '~/lib/jquery'

Promise.all([highlight, jQuery]).then(([hljs, $]) => {
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
})
