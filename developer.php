<?php
    include '_templates/sitewide.php';
    $page['description'] = 'Resources for designing, developing, and publishing apps for elementary OS.';
    $page['image'] = 'https://elementary.io/images/developer/preview.png';
    $page['title'] = 'Developer &sdot; elementary';
    $page['theme-color'] = '#403757';
    $page['script-plugins'] = array(
        'https://cdn.jsdelivr.net/g/jquery.leanmodal2@2.5'
    );
    $page['scripts'] = array(
        'scripts/developer.js' => array(
            'async' => false
        )
    );
    $page['styles'] = array(
        'styles/developer.css'
    );
    include $template['header'];
    require_once __DIR__.'/backend/classify.current.php';
?>

<script>var releaseTitle = 'Loki'</script>
<script>var releaseVersion = '0.4-beta2'</script>
<script>var downloadRegion = '<?php echo $region; ?>'</script>

<section class="hero dark">
    <div>
        <img src="images/developer/save.svg" alt="Save">
        <h1>Loki Beta 2 Is Here</h1>
        <h4>Try out the upcoming version of elementary OS.</h4>
        <button type="submit" id="download" class="suggested-action">Download Loki Beta 2</button>
        <p class="small-label"><a href="http://blog.elementary.io/post/147507276666/loki-beta-2-is-here">Read the Release Notes</a></p>
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
        <image src="images/developer/logo.svg" alt="logo">
        <h1>Build for <?php include("./images/logotype-os.svg"); ?></h1>
        <h4>Loki brings a new API for Wingpanel, Launcher API support in Slingshot, new widgets like AlertView, new CSS style classes and icons, and tons more. Build feature-full apps easier than ever with Gtk 3.18 &amp; Vala 0.32, running atop Linux 4.4</h4>
    </div>
</div>
<div class="grid">
    <div class="half">
        <div class="alert column">
            <img src="images/developer/contractor.svg" alt="Contractor">
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
            <img src="images/developer/gda.svg" alt="GDA">
        </div>
        <div class="alert column">
            <h2>GDA</h2>
            <p>Simple, flexible database management. Supports remote and on-disk SQL databases, including SQLite. Comes with graphical and in-console SQL data browsers, a metadata extractor enabling object auto-discovery, and more.</p>
            <p><a class="read-more" href="http://valadoc.elementary.io/#!api=libgda-4.0/Gda">Reference for GDA</a></p>
        </div>
    </div>
    <div class="half">
        <div class="alert column">
            <img src="images/icons/48/preferences-system-network.svg" alt="Soup">
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
            <h2>Vala. A Modern, Fast, Open Source Language.</h2>
            <p>Write fast, native, object-oriented code with Vala. It's familiar to anyone who's seen C#, but maintains API/ABI compatibility with standard C, has low memory requirements, and is purpose-built for GObject. You name it, Vala's got it: signals, properties, generics, lambda functions, assisted memory management, exception handling, type inference, async/yield, and more.</p>
            <div class="grid">
                <div class="half">
                    <a class="read-more" href="https://wiki.gnome.org/Projects/Vala">Learn More about Vala</a>
                </div>
                <div class="half">
                    <a class="read-more" href="http://valadoc.elementary.io/">Library Documentation for Vala</a>
                </div>
        </div>
    </div>
</section>
<div id="download-modal" class="modal">
    <div class="modal-container">
        <h3>Download Loki Beta 2</h3>
        <p>By downloading this beta you accept that it is not a final product and will be unstable.</p>
        <div class="row actions">
            <div class="column">
                <a class="button close-modal" href="#">Cancel</a>
            </div>
            <div class="column linked">
                <a class="button suggested-action close-modal download-link http" href="<?php echo $download_link; ?>elementaryos-0.4-beta2-amd64.20160716.iso">Loki Beta 2 64-bit</a>
                <a class="button suggested-action close-modal download-link magnet" title="Torrent Magnet Link" href="magnet:?xt=urn:btih:ddfb046f2f881b6ec845f8ee4ecbfe0758bedd67&dn=elementaryos-0.4-beta2-amd64.20160716.iso&tr=https%3A%2F%2Fashrise.com%3A443%2Fphoenix%2Fannounce&tr=udp%3A%2F%2Fopen.demonii.com%3A1337%2Fannounce&tr=udp%3A%2F%2Ftracker.ccc.de%3A80%2Fannounce&tr=udp%3A%2F%2Ftracker.openbittorrent.com%3A80%2Fannounce&tr=udp%3A%2F%2Ftracker.publicbt.com%3A80%2Fannounce&ws=http:<?php echo $download_link; ?>elementaryos-0.4-beta2-amd64.20160716.iso"><i class="fa fa-magnet"></i></a>
            </div>
        </div>
    </div>
</div>
<a style="display:none;" class="open-modal" href="#download-modal"></a>
<?php
    include $template['footer'];
?>
