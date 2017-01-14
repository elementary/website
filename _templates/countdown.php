<?php

$l10n->set_domain('layout');

if (
    (!isset($_COOKIE['countdown_video']) || $_COOKIE['countdown_video'] === true)
) {

?>

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

<?php }

$l10n->set_domain($page['name']);
