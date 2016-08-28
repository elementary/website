<?php

$l10n->set_domain('layout');

$releaseDate = new DateTime('2016-09-05 22:00:00');

if (
    (new DateTime() < $releaseDate) &&
    (!isset($_COOKIE['countdown']) || $_COOKIE['countdown'] === true)
) {

?>

<div class="countdown-background">
    <div class="countdown-wrapper">
        <div class="countdown"></div>
        <a class="read-more" href="#">Continue</a>
    </div>
</div>

<link rel="stylesheet" type="text/css" media="all" href="styles/countdown.css">
<script>
    $('document').ready(function () {
        FlipClock.MvpClockFace = FlipClock.DailyCounterFace.extend({
            showSeconds: true,
            build: function (time) {
                var t = this
    			var $el = this.factory.$el
    			var offset = 0

    			time = time ? time : this.factory.time.getDayCounter(this.showSeconds)

    			if (time.length > $el.children('ul').length) {
    				$.each(time, function (i, digit) {
    					t.createList(digit)
    				})
    			}

                var children = $el.children('ul')

                for (var i = 0; i < children.length; i += 2) {
                    children.slice(i, i + 2).wrapAll('<div class="flip-wrapper"></div>')
                }

                this.base()
            }
        })

        var releaseDate = new Date('<?php echo date('D M d Y H:i:s O', date_timestamp_get($releaseDate)) ?>')

        var clock = $('.countdown').FlipClock(releaseDate, {
            clockFace: 'MvpClock',
            countdown: true
        })

        $('.read-more').click(function () {
            $('.countdown-background').hide()
            var expireDate = new Date()
            expireDate.setDate(expireDate.getDate() + 1)
            document.cookie = 'countdown=false; expires=' + expireDate.toUTCString()
        })
    })
</script>

<?php

}

$l10n->set_domain($page['name']);

?>
