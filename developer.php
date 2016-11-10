<?php
    require_once __DIR__.'/_backend/preload.php';

    $page['title'] = 'Developer &sdot; elementary';
    $page['description'] = 'Resources for designing, developing, and publishing apps for elementary OS.';
    $page['image'] = 'https://elementary.io/images/developer/preview.png';
    $page['theme-color'] = '#403757';

    $page['scripts'] = array(
        'scripts/developer.js'
    );

    $page['styles'] = array(
        'styles/developer.css',
        'styles/solarized_light.css'
    );

    include $template['header'];
?>

<section class="hero dark">
    <div>
        <img src="images/developer/developer-sketch.svg" alt="Developer hero image">
        <h1>Develop Your Ideas Into Code</h1>
        <h4>Learn to design, develop, and publish apps for elementary OS</h4>
        <a href="docs/code/getting-started" class="button suggested-action">Get Started</a>
    </div>
</section>

<?php include $template['alert']; ?>

<section class="grid">
    <a class="third" href="docs/code/getting-started">
        <i class="fa fa-book"></i>
        <h3>Documentation</h3>
        <p>Get a basic app running, built, and ready for distribution with our Getting Started guide.</p>
    </a>
    <a class="third" href="docs/human-interface-guidelines">
        <i class="fa fa-pencil"></i>
        <h3>Design</h3>
        <p>Learn about the design principles that make up apps on elementary OS.</p>
    </a>
    <a class="third" href="docs/code/reference">
        <i class="fa  fa-code"></i>
        <h3>Reference</h3>
        <p>Get more info about code style, reporting issues, and proposing design changes.</p>
    </a>
</section>
<div class="grid">
    <hr/>
</div>
<div class="grid">
    <div class="two-thirds">
        <image src="images/icons/places/128/distributor-logo.svg" alt="logo">
        <h1>Build for <?php include("./images/logotype-os.svg"); ?></h1>
        <h4>Loki brings a new API for Wingpanel, Launcher API support in Slingshot, new widgets like AlertView, new CSS style classes and icons, and tons more. Build feature-full apps easier than ever with Gtk 3.18 &amp; Vala 0.32, running atop Linux 4.4</h4>
    </div>
</div>
<div class="grid">
    <div class="half">
        <div class="alert column">
            <img src="images/icons/actions/48/document-export.svg" alt="Contractor">
        </div>
        <div class="alert column">
            <h2>Contractor</h2>
            <p>A desktop-wide extension service that allows apps to use functionality exposed by other apps — without prior coordination.</p>
            <p><a class="read-more" href="docs/human-interface-guidelines#contractor">HIG for Contractor</a></p>
            <p><a class="read-more" href="http://valadoc.elementary.io/#!api=granite/Granite.Services.ContractorProxy">Reference for Contractor</a></p>
        </div>
    </div>
    <div class="half">
        <div class="alert column">
            <img src="images/developer/granite.svg" alt="Granite">
        </div>
        <div class="alert column">
            <h2>Granite</h2>
            <p>The foundation library for elementary OS apps. Provides powerful widgets like DynamicNotebook, utilities, convenience functions, and more.</p>
            <p><a class="read-more" href="http://valadoc.elementary.io/#!wiki=granite/index">Reference for Granite</a></p>
        </div>
    </div>
    <div class="half">
        <div class="alert column">
            <img src="images/icons/mimes/48/office-database.svg" alt="GDA">
        </div>
        <div class="alert column">
            <h2>GDA</h2>
            <p>Simple, flexible database management. Supports remote and on-disk SQL databases, including SQLite. Comes with graphical and in-console SQL data browsers, a metadata extractor enabling object auto-discovery, and more.</p>
            <p><a class="read-more" href="http://valadoc.org/libgda-5.0/Gda">Reference for GDA</a></p>
        </div>
    </div>
    <div class="half">
        <div class="alert column">
            <img src="images/icons/categories/48/preferences-system-network.svg" alt="Soup">
        </div>
        <div class="alert column">
            <h2>Soup</h2>
            <p>An HTTP client/server library with synchronous and async APIs. Comes with SSL/TLS, cookies, caching, WebSockets, proxy and tunneling support, and more. Goes great with JSON-GLib.</p>
            <p><a class="read-more" href="http://valadoc.elementary.io/#!api=libsoup-2.4/Soup">Reference for Soup</a></p>
            <p><a class="read-more" href="http://valadoc.elementary.io/#!api=json-glib-1.0/Json">Reference for JSON-GLib</a></p>
        </div>
    </div>
</div>
<section class="grey">
    <div class="grid">
        <div class="two-thirds">
            <img src="images/developer/vala.svg" alt="vala">
            <h2>Vala. Write Fast, Native, Object-Oriented Code.</h2>
        </div>
        <div class="grid">
            <div class="third">
                <i class="fa fa-cube"></i>
                <p>Familiar to anyone who's seen C#, but maintains API/ABI compatibility with C</p>
            </div>
            <div class="third">
                <i class="fa fa-rocket"></i>
                <p>Low memory requirements, native execution, and purpose-built for GObject</p>
            </div>
            <div class="third">
                <i class="fa  fa-cogs"></i>
                <p>Signals, properties, generics, lambdas, assisted memory management, exception handling, type inference, async/yield & more</p>
            </div>
        </div>
        <div class="two-thirds">
<pre><code>public class MyApp : Gtk.Application {

    public MyApp () {
        Object (application_id: "com.github.myteam.myapp",
        flags: ApplicationFlags.FLAGS_NONE);
    }

    protected override void activate () {
        var window = new Gtk.ApplicationWindow (this);
        window.title = "MyApp";
        window.set_default_size (1024, 768);
        window.show_all ();
    }

    public static int main (string[] args) {
        var app = new MyApp ();
        return app.run (args);
    }
}</code></pre>
            <div class="grid">
                <div class="half">
                    <a class="read-more" href="https://wiki.gnome.org/Projects/Vala">Learn More about Vala</a>
                </div>
                <div class="half">
                    <a class="read-more" href="http://valadoc.elementary.io/">Library Documentation for Vala</a>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
    include $template['footer'];
?>
