<?php
    include '_templates/sitewide.php';
    $page['title'] = 'Page Not Found | elementary OS';
    include '_templates/header.php';
?>

<div class="row">
    <p class="error-label">404</p>
    <h1>The page you’re looking for can’t be found</h1>
    <h2>There isn’t anything located here. Check the web address for mispelled words and try again.</h2>
    <a class="button suggested-action" href="/">Go to Home Page</a>
</div>

<?php
    include '_templates/footer.html';
?>