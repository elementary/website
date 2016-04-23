$(function () {
    $('.inline-tweet').each(function () {
        var tweet = encodeURIComponent($(this).text() + $(this).data('tweet-suffix'));
        if ( tweet.length > 140 ) {
            var trim_length = 140 - $(this).data('tweet-suffix').length - 5;
            tweet = encodeURIComponent($(this).text().substring(0, trim_length) + '…' + $(this).data('tweet-suffix'));
        }
        $(this).prop('href', 'http://twitter.com/home/?status=' + tweet);
    });
});
