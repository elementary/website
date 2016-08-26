<?php

$l10n->set_domain('layout');

$releaseDate = new DateTime('2016-09-05 22:00:00');

if (
    (new DateTime() < $releaseDate) &&
    (!isset($_COOKIE['countdown']) || $_COOKIE['countdown'] === true)
) {

?>

<div class="countdown-wrapper">
    <div class="countdown"></div>
    <a class="read-more" href="#">Continue</a>
</div>

<link rel="stylesheet" type="text/css" media="all" href="styles/countdown.css">
<script>
    $('document').ready(function () {
        var releaseDate = new Date('<?php echo date('D M d Y H:i:s O', date_timestamp_get($releaseDate)) ?>')

        var clock = $('.countdown').FlipClock(releaseDate, {
            clockFace: 'DailyCounter',
            countdown: true
        })

        $('.read-more').click(function () {
            $('.countdown-wrapper').hide()
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
