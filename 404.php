<?php
    require_once __DIR__.'/_backend/preload.php';

    $page['name'] = '404';
    $page['title'] = 'Page Not Found &sdot; elementary';

    include $template['header'];
    include $template['alert'];
?>

<script>plausible('Error', {props: { Code: '404', Description: 'Page Not Found'}})</script>

<div class="row">
    <div class="column alert">
        <i class="warning fas fa-4x fa-exclamation-triangle"></i>
    </div>
    <div class="column alert">
        <h3>The page you’re looking for can’t be found</h3>
        <p>There isn’t anything located here. Check the web address for mispelled words and try again.</p>
    </div>
    <div class="row">
        <a class="button suggested-action" href="/">Go to Home Page</a>
    </div>
</div>

<?php
    include $template['footer'];
?>
