<?php

$l10n->set_domain('layout');

if (
    (isset($sitewide['releaseDate']) && new DateTime() < $sitewide['releaseDate']) &&
    (!isset($_COOKIE['countdown']) || $_COOKIE['countdown'] === true)
) {

?>

<div class="countdown-wrapper">
    <div class="countdown"></div>
    <a class="read-more" href="#">Click to Continue</a>
</div>

<link rel="stylesheet" type="text/css" media="all" href="styles/countdown.css">
<script>
    $('document').ready(function () {
        var releaseDate = new Date('<?php echo date('D M d Y H:i:s O', date_timestamp_get($sitewide['releaseDate'])) ?>')

        var clock = $('.countdown').FlipClock(releaseDate, {
            countdown: true
        })

        $('.read-more').click(function () {
            $('.countdown-wrapper').hide()
            document.cookie = 'countdown=false; expires=' + releaseDate.toUTCString()
        })
    })
</script>

<?php

}

$l10n->set_domain($page['name']);

?>
