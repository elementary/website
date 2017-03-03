<?php

/**
 * _templates/event.php
 * Holds markdown for special event items like a release countdown or campain toast.
 */

require_once __DIR__ . '/../_backend/event.php';

$l10n->set_domain('layout');

?>

<?php if (event_active('indiegogo appcenter 2/17') && event_cookie_get('indiegogo appcenter 2/17') !== '1') { ?>
    <div class="overlay">
        <div class="overlay__content toast">
            <div class="toast__close"><i class="fa fa-close"></i></div>
            <span class="toast__text">We're Crowdfunding on IndieGoGo</span>
            <a href="https://igg.me/at/appcenter" class="toast__button">Back Us</a>
        </div>
    </div>
<?php } ?>

<?php if (event_active('loki 0.4.0 release') && event_cookie_get('loki 0.4.0 release') !== '1') { ?>
    <div class="countdown-background">
        <div class="countdown-wrapper">
            <div>
                <iframe width="560" height="315" src="https://www.youtube.com/embed/6E7Ed8GxsUM?rel=0&showinfo=0&autoplay=1" frameborder="0" allowfullscreen></iframe>
            </div>
            <a class="read-more" href="#">Continue</a>
        </div>
    </div>

    <link rel="stylesheet" type="text/css" media="all" href="styles/countdown.css">
    <script>
        $('document').ready(function () {
            $('.read-more').click(function () {
                $('.countdown-background').hide()
                $('.countdown-background').html('')
                var expireDate = new Date()
                expireDate.setDate(expireDate.getDate() + 1)
                document.cookie = 'countdown_video=false; expires=' + expireDate.toUTCString()
            })
        })
    </script>
<?php } ?>

<?php

$l10n->set_domain($page['name']);
