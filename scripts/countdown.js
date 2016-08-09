var clock = $('.countdown').FlipClock({
});

clock.setCountdown(true);
clock.setTime(90000);

$('.read-more').click(function() {
    $('.countdown-wrapper').hide();
});
