<?php
    include '_templates/sitewide.php';
    $page['title'] = 'Support &sdot; elementary';
    $page['scripts'] .= '<link rel="stylesheet" type="text/css" media="all" href="styles/support.css">';
    include '_templates/header.php';
?>
            <div class="row">
                <h1>Get support for <?php include("./images/logotype.svg"); ?></h1>
            </div>
            <div class="row">
                <a class="column half" href="#">
                    <h2><i class="fa fa-question-circle"></i> FAQ</h2>
                    <p>Has your question been answered already? Check out answers to some of the most common questions.</p>
                </a>
                <a class="column half" href="#">
                    <h2><i class="fa fa-download"></i> Installation</h2>
                    <p>Get help installing elementary OS on your computer.</p>
                </a>
                <a class="column half" href="#">
                    <h2><i class="fa fa-google-plus"></i> Google+</h2>
                    <p>Communicate with other elementary OS users in our Google+ community.</p>
                </a>
                <a class="column half" href="#">
                    <h2><i class="fa fa-reddit"></i> reddit</h2>
                    <p>Discuss elementary OS in our official subreddit.</p>
                </a>
            </div>
            <div class="row">
                <a href="#">
                    <h2><i class="fa fa-bug"></i> Report a bug</h2>
                    <p>Unable to resolve your issue? Let our developers know.</p>
                </a>
            </div>

<?php
    include '_templates/footer.html';
?>
