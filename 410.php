<?php
    include '_templates/sitewide.php';
    $page['title'] = 'Download Link Expired &sdot; elementary';
    include $template['header'];
    include $template['alert'];
?>

<script>
    ga('send', 'event', '410: Download Link Expired', window.location.host)
</script>

<div class="row">
    <div class="column alert">
        <i class="warning fa fa-clock-o"></i>
    </div>
    <div class="column alert">
        <h3>Whoops! That link has expired.</h3>
        <p>If you're trying to download elementary OS, please head back to the home page. If you were looking for something else, feel free to <a href="https://github.com/elementary/mvp/issues/new">file an issue on our GitHub</a>.</p>
    </div>
    <div class="row">
        <a class="button suggested-action" href="/">Go to Home Page</a>
    </div>
</div>

<?php
    include $template['footer'];
?>
