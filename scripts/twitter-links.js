$(function () {
    $('.inline-tweet').each(function () {
        var tweetBody = $(this).text();
        var tweetSuffix = $(this).data('tweet-suffix');
        var tweet = tweetBody + tweetSuffix;

        if ( tweet.length >= 135 ) {
            var quote = tweetBody.slice(-1);
            tweet = tweetBody.substring(0, tweetBody.length - (tweet.length - 135)) + '…' + quote + tweetSuffix;
        }

        $(this).prop('href', 'http://twitter.com/home/?status=' + encodeURIComponent(tweet));
    });
});
