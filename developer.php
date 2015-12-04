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
        <h1>It's a Brave New World</h1>
        <h4>elementary OS Freya brings a new API for Switchboard, searchable action entries in Slingshot, new widgets like HeaderBar, animations in the toolkit, improved CSS theming and more. Build feature-full apps easier than ever with Gtk 3.14 & Vala 0.26</h4>
    </div>
</div>
<div class="grid">
    <div class="half">
        <img src="images/developer/default.svg">
        <h2>Champlain</h2>
        <p>Maps for apps. It supports numerous free map sources such as OpenStreetMap, OpenCycleMap, OpenAerialMap and Maps-For-Free.</p>
        <p><a class="read-more" href="https://wiki.gnome.org/Projects/libchamplain">Learn More</a></p>
    </div>
    <div class="half">
        <img src="images/developer/contractor.svg">
        <h2>Contractor</h2>
        <p>A desktop-wide extension service that allows apps to use the exposed functionality of other apps.</p>
        <p><a class="read-more" href="http://valadoc.org/#!api=granite/Granite.Services.ContractorProxy">Learn More</a></p>
    </div>
    <div class="half">
        <img src="images/developer/folks.svg">
        <h2>Folks</h2>
        <p>Contact aggregation service, which combines contacts from multiple sources.</p>
        <p><a class="read-more" href="https://wiki.gnome.org/Projects/Folks">Learn More</a></p>
    </div>
    <div class="half">
        <img src="images/developer/default.svg">
        <h2>GeoClue</h2>
        <p>Location services for applications, based on Wi-Fi access points, GPS, 3G modems and GeoIP.</p>
        <p><a class="read-more" href="http://www.freedesktop.org/wiki/Software/GeoClue/">Learn More</a></p>
    </div>
</div>
<section class="grey">
    <div class="grid">
        <div class="two-thirds">
            <img src="images/developer/vala.svg">
            <h2>Vala. A Modern, Fast, Open Source Language.</h2>
            <p>Vala allows developers to write complex object-oriented code rapidly while maintaining a standard C API and ABI and keeping memory requirements low. Vala is syntactically similar to C# and includes several features such as: anonymous functions, signals, properties, generics, assisted memory management, exception handling, type inference, and foreach statements.</p>
            <p><a class="read-more" href="https://wiki.gnome.org/Projects/Vala">Learn More About Vala</a></p>
        </div>
    </div>
</section>
<?php
    include $template['footer'];
?>
