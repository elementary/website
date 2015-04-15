$(document).ready(function() {
    $('pre code').each(function(i, block) {
        // Highlight code block
        hljs.highlightBlock(block);

        // Add line numbers
        var lines = $(this).text().split('\n').length;
        var $numbering = $('<ul/>').addClass('pre-numbering');
        $(this).parent().addClass('highlighted has-numbering').append($numbering);

        for (var i = 1; i <= lines; i++){
            $numbering.append($('<li/>').text(i));
        }
    });
});