$(document).ready(function() {
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

    $('h1[id], h2[id], h3[id], h4[id], h5[id], h6[id]').each(function() {
        $(this).wrap('<a href="#'+$(this).attr('id')+'"></a>');
    })
});
