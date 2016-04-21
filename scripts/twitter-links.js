$(function () {
    $('.inline-tweet').each(function () {
        $(this).prop('href', 'http://twitter.com/home/?status=' + encodeURIComponent($(this).text()) + $(this).data('tweet-suffix'));
    });
});
