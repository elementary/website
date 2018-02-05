<?php

/**
 * _templates/event.php
 * Holds markdown for special event items like a release countdown or campain toast.
 */

require_once __DIR__ . '/../_backend/event.php';

$l10n->set_domain('layout');

// Insert event based code here.
if (event_active('juno 0.5.0 release') && event_cookie_get('juno 0.5.0 release') !== '1') { ?>
    <div class="countdown-background">
        <div class="countdown-wrapper">
            <div class="countdown"></div>
            <div>
                <iframe width="560" height="315" src="https://www.youtube.com/embed/ocCxNWgMz20?rel=0&showinfo=0&autoplay=0" frameborder="0" allowfullscreen></iframe>
            </div>
            <a class="read-more" href="#">Continue</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/gh/jquery/jquery@3/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flipclock@0.7.8/compiled/flipclock.min.js"></script>
    <link rel="stylesheet" type="text/css" media="all" href="https://cdn.jsdelivr.net/npm/flipclock@0.7.8/compiled/flipclock.min.css">
    <link rel="stylesheet" type="text/css" media="all" href="styles/countdown.css">
    <script>
        $('document').ready(function () {
			console.log('Starting FlipClock')
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
            var releaseDate = new Date('<?php echo date('D M d Y H:i:s O', date_timestamp_get($event_expires['juno 0.5.0 release'][1])) ?>')
            var clock = $('.countdown').FlipClock(releaseDate, {
                clockFace: 'MvpClock',
                countdown: true
            })
			console.log('Started FlipClock')
			$('.read-more').click(function (event) {
				event.preventDefault()
                $('.countdown-background').hide()
                $('.countdown-background').html('')
                var expireDate = new Date()
                expireDate.setDate(expireDate.getDate() + 1)
                document.cookie = 'countdown_video=false; expires=' + expireDate.toUTCString()
            })
        })
    </script>
<?php
}

$l10n->set_domain($page['name']);
