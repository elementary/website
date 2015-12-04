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
<section class="grid">
    <div class="third"><a href="docs/code/getting-started">
        <i class="fa fa-book"></i>
        <h3>Documentation</h3>
        <p>Get a basic app running, built, and ready for distribution with our Getting Started guide.</p>
    </a></div>
    <div class="third"><a href="docs/human-interface-guidelines">
        <i class="fa fa-pencil"></i>
        <h3>Design</h3>
        <p>Learn about the design principles that make up apps on elementary OS.</p>
    </a></div>
    <div class="third"><a href="docs/code/reference">
        <i class="fa  fa-code"></i>
        <h3>Reference</h3>
        <p>Get more info about code style, reporting issues, and proposing design changes.</p>
    </a></div>
</section>
<div class="grid">
    <hr/>
</div>
<div class="grid">
    <div class="two-thirds">
        <image src="images/developer/logo.svg">
        <h1>Build for <?php include("./images/logotype.svg"); ?></h1>
        <h4>Freya brings a new API for Switchboard, searchable action entries in Slingshot, new widgets like HeaderBar, animations in the toolkit, improved CSS theming and more. Build feature-full apps easier than ever with Gtk 3.14 & Vala 0.26</h4>
    </div>
</div>
<div class="grid">
    <div class="half">
        <div class="alert column">
            <img src="images/developer/contractor.svg">
        </div>
        <div class="alert column">
            <h2>Contractor</h2>
            <p>A desktop-wide extension service that allows apps to use the exposed functionality of other apps.</p>
            <p><a class="read-more" href="http://valadoc.org/#!api=granite/Granite.Services.ContractorProxy">Reference for Contractor</a></p>
        </div>
    </div>
    <div class="half">
        <div class="alert column">
            <img src="images/developer/granite.svg">
        </div>
        <div class="alert column">
            <h2>Granite</h2>
            <p>The foundation library for elementary OS apps. Among other things, it provides complex widgets like DynamicNotebook, utilities, and convenience functions.</p>
            <p><a class="read-more" href="http://valadoc.org/#!wiki=granite/index">Reference for Granite</a></p>
        </div>
    </div>
</div>
<section class="grey">
    <div class="grid">
        <div class="two-thirds">
            <img src="images/developer/vala.svg">
            <h2>Vala. A Modern, Fast, Open Source Language.</h2>
            <p>Write fast, native, object-oriented code with Vala. It's familiar to anyone who's seen C#, but maintains API/ABI compatability with standard C, has low memory requirements, and is purpose built for GObject. You name it, Vala's got it: anonymous functions, signals, properties, generics, assited memory management, exception handling, type inference, lambdas, and more.</p>
            <div class="grid">
                <div class="half">
                    <a class="read-more" href="https://wiki.gnome.org/Projects/Vala">Learn More about Vala</a>
                </div>
                <div class="half">
                    <a class="read-more" href="http://valadoc.org/">Library Documentation for Vala</a>
                </div>
        </div>
    </div>
</section>
<?php
    include $template['footer'];
?>
