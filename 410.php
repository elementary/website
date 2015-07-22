<?php
    include '_templates/sitewide.php';
    $page['title'] = 'Download Link Expired &sdot; elementary';
    include $template['header'];
?>

<script>
    ga('send', 'event', '410: Download Link Expired', window.location.host);
</script>

<div class="row">
    <div class="column alert">
        <i class="warning fa fa-warning"></i>
    </div>
    <div class="column alert">
        <h3>The download link you clicked has expired</h3>
        <p>Download links are valid for 3 days.<br>Please go back to our homepage and download again.</p>
    </div>
    <div class="row">
        <a class="button suggested-action" href="/">Go to Home Page</a>
    </div>
</div>

<?php
    include $template['footer'];
?>
