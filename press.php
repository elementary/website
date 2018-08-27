<?php
    require_once __DIR__.'/_backend/preload.php';

    $page['title'] = 'Press &sdot; elementary';

    include $template['header'];
    include $template['alert'];
?>

<div class="grid">
    <div class="two-thirds">
        <h2>Press Resources</h2>
    </div>
    <div class="half">
        <h3>Join the Press List</h3>
        <p>Be the first to know about new releases and significant developments. We send press early access to press releases and press kits, including high resolution screenshots. This is a <strong>very low volume</strong> list, with an average of an email once a year with the biggest news.</p>
        <a class="button" href="#">Join List</a>
    </div>
    <div class="half">
        <h3>Press Kit</h3>
        <p>Download the Loki press kit for resources around our current stable release, elementary OS 0.4.1 Loki. This includes the press release, detailed user- and developer-facing changes, high resolution screenshots, and logos.</p>
        <a class="button" href="#">Download Press Kit</a>
    </div>
</div>

<div class="grid">
    <div class="whole">
        <div class="two-thirds">
            <h3>Get in Touch</h3>
            <p>Talk directly with the team by emailing <a href="mailto:press@elementary.io">press@elementary.io</a>. We welcome requests for interviews, podcast appearances, or just general inquiries.</p>
        <a class="button suggested-action" href="mailto:press@elementary.io">Send an Email</a>
        </div>
    </div>
</div>

<?php
    include $template['footer'];
?>
