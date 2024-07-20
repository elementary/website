<?php
    require_once __DIR__.'/_backend/preload.php';

    $page['title'] = 'Download Link Expired &sdot; elementary';

    include $template['header'];
    include $template['alert'];
?>

<script>plausible('Error', {props: { Code: '410', Description: 'Download Link Expired'}})</script>

<div class="row">
    <div class="column alert">
        <i class="warning fa fa-clock-o"></i>
    </div>
    <div class="column alert">
        <h3>Whoops! That link has expired.</h3>
        <p>If you’re trying to download elementary OS, please head back to <a href="/">the home page</a> for the most up-to-date version. If you were brought here from a third-party website, it is possible they were attempting to bypass the payment prompt or installation directions. Please inform them that download links are temporary, per-user, and load-balanced. The correct way to link to the download is to link to <a href="https://elementary.io">elementary.io</a>.</p>
        <p>If you were looking for something else, feel free to <a href="https://github.com/elementary/website/issues/new">file an issue on our GitHub</a>.</p>
    </div>
    <div class="row">
        <a class="button suggested-action" href="/">Go to Home Page</a>
    </div>
</div>

<?php
    include $template['footer'];
?>
