<?php
    require_once __DIR__.'/_backend/preload.php';
    $page['title'] = 'Thank You for Downloading elementary OS';
    $page['theme-color'] = '#3E4E54';

    $already_paid = (os_payment_getcookie($config['previous_version']) > 0);
    if (!$already_paid) {
        header("Location: " . $sitewide['root']);
        exit;
    } else {

        include $template['header'];
        include $template['alert'];
?>

<section class="hero">
    <div class="grid">
        <div class="two-thirds">
            <h1>
                Thank You for Downloading
                <?php
                    // Embed the SVG to fix scaling in WebKit 1.x,
                    // while preserving CSS options for the image.
                    include __DIR__.'/images/logotype-os.svg';
                ?>
            </h1>
            <!-- TODO Add link to download previous version -->
            <!-- TODO Add warning about outdated version -->
            <p>For help and more info, read the <a href="<?php echo $sitewide['lang-root'];?>/docs/installation#installation">installation guide</a>. If you purchased elementary OS, check your email for a receipt that includes your link to download elementary OS again for free.</p>
            <a class="button suggested-action" href="<?php echo $sitewide['lang-root'];?>/docs/installation#installation">Read Installation Guide</a>
        </div>
    </div>
</section>

<?php
        include $template['footer'];
    }
