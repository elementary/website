<?php

/**
 * _templates/event.php
 * Holds markdown for special event items like a release countdown or campain toast.
 */

require_once __DIR__ . '/../_backend/event.php';

$l10n->set_domain('layout');

const EVENT_NAME = 'juno 5.0 release';

// Insert event based code here.
if (event_active(EVENT_NAME) && event_cookie_get(EVENT_NAME) !== '1') { ?>
    <div class="countdown-background">
        <div class="countdown-wrapper">
            <div class="clock">
                <div class="digit day">
                    <span class="base"></span>
                    <div class="flap over front"></div>
                    <div class="flap over back"></div>
                    <div class="flap under"></div>
                </div>
                <div class="digit tenhour">
                    <span class="base"></span>
                    <div class="flap over front"></div>
                    <div class="flap over back"></div>
                    <div class="flap under"></div>
                </div>
                <div class="digit hour">
                    <span class="base"></span>
                    <div class="flap over front"></div>
                    <div class="flap over back"></div>
                    <div class="flap under"></div>
                </div>
                <div class="digit tenmin">
                    <span class="base"></span>
                    <div class="flap over front"></div>
                    <div class="flap over back"></div>
                    <div class="flap under"></div>
                </div>
                <div class="digit min">
                    <span class="base"></span>
                    <div class="flap over front"></div>
                    <div class="flap over back"></div>
                    <div class="flap under"></div>
                </div>
                <div class="digit tensec">
                    <span class="base"></span>
                    <div class="flap over front"></div>
                    <div class="flap over back"></div>
                    <div class="flap under"></div>
                </div>
                <div class="digit sec">
                    <span class="base"></span>
                    <div class="flap over front"></div>
                    <div class="flap over back"></div>
                    <div class="flap under"></div>
                </div>
            </div>

            <a class="read-more" href="#">Continue</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/gh/jquery/jquery@3/dist/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" media="all" href="styles/countdown.css">
    <script>
        // From https://codepen.io/anon/pen/bmrjPj?editors=0110

        function flipTo(digit, n){
            var current = digit.attr('data-num');
            digit.attr('data-num', n);
            digit.find('.front').attr('data-content', current);
            digit.find('.back, .under').attr('data-content', n);
            digit.find('.flap').css('display', 'block');
            setTimeout(function(){
                digit.find('.base').text(n);
                digit.find('.flap').css('display', 'none');
            }, 350);
        }

        function jumpTo(digit, n){
            digit.attr('data-num', n);
            digit.find('.base').text(n);
        }

        function updateGroup(group, n, flip){
            var digit1 = $('.ten'+group);
            var digit2 = $('.'+group);
            n = String(n);
            if(n.length == 1) n = '0'+n;
            var num1 = n.substr(0, 1);
            var num2 = n.substr(1, 1);
            if(digit1.attr('data-num') != num1){
                if(flip) flipTo(digit1, num1);
                else jumpTo(digit1, num1);
            }
            if(digit2.attr('data-num') != num2){
                if(flip) flipTo(digit2, num2);
                else jumpTo(digit2, num2);
            }
        }

        function setTime(flip){
            var now = new Date();
            var then = new Date('<?php echo date('D M d Y H:i:s O', date_timestamp_get($event_expires[EVENT_NAME][1])) ?>');
            var distance = new Date(then - now);

            if (distance <= 0) {
                window.location.reload(true);
                return;
            }

            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            updateGroup('day', days, flip);
            updateGroup('hour', hours, flip);
            updateGroup('min', minutes, flip);
            updateGroup('sec', seconds, flip);
        }

        $(document).ready(function(){
            setTime(false);
            setInterval(function(){
                setTime(true);
            }, 1000);

            $('.read-more').click(function (event) {
                event.preventDefault();
                $('.countdown-background').hide();
                $('.countdown-background').html('');
                var expireDate = new Date();
                expireDate.setDate(expireDate.getDate() + 1);
                document.cookie = '<?php echo event_cookie_encode(EVENT_NAME); ?>=1; expires=' + expireDate.toUTCString();
            });
        });
    </script>
<?php
}

$l10n->set_domain($page['name']);
