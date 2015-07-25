<?php
    include '_templates/sitewide.php';
    $page['name'] = '403';
    $page['title'] = 'Forbidden &sdot; elementary';
    include $template['header'];
?>

<script>
    ga('send', 'event', '403: Forbidden', window.location.host);
</script>

<div class="row">
    <div class="column alert">
        <i class="warning fa fa-warning"></i>
    </div>
    <div class="column alert">
        <h3>Access denied.</h3>
        <p>You don't have permission to view the requested resource.</p>
    </div>
    <div class="row">
        <a class="button suggested-action" href="/">Go to Home Page</a>
    </div>
</div>

<?php
    include $template['footer'];
?>
