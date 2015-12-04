<?php
    include '_templates/sitewide.php';
    $page['title'] = 'Develop Apps for elementary OS';
    $page['theme-color'] = '#226BB3';
    $page['scripts'] = '<link rel="stylesheet" type="text/css" media="all" href="styles/developer.css">';
    include $template['header'];
    include $template['alert'];
?>

<section class="hero dark">
    <img src="images/developer/developer-sketch.svg">
    <h1>Develop Your Ideas Into Code</h1>
    <h4>Learn to design, develop, and publish apps for elementary OS</h4>
    <!--<a class="button suggested-action" href="https://myapps.developer.ubuntu.com/dev/click-apps/">Sign In or Register for MyApps</a>-->
</section>
<section class="row">
    <div class="column third"><a href="docs/code/getting-started">
        <i class="fa fa-book"></i>
        <h3>Documentation</h3>
        <p>Get a basic app running, built, and ready for distribution with our Getting Started guide.</p>
    </a></div>
    <div class="column third"><a href="docs/human-interface-guidelines">
        <i class="fa fa-pencil"></i>
        <h3>Design</h3>
        <p>Learn about the design principles that make up apps on elementary OS.</p>
    </a></div>
    <div class="column third"><a href="docs/code/reference">
        <i class="fa  fa-code"></i>
        <h3>Reference</h3>
        <p>Get more info about code style, reporting issues, and proposing design changes.</p>
    </a></div>
</section>
<?php
    include $template['footer'];
?>
