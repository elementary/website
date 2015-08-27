<?php
    include '_templates/sitewide.php';
    $page['title'] = 'Support &sdot; elementary';
    $page['scripts'] = '<link rel="stylesheet" type="text/css" media="all" href="styles/support.css">';
    include $template['header'];
    include $template['alert'];
?>

<div class="row">
    <h1>Get support for <?php include("./images/logotype.svg"); ?></h1>
</div>

<div class="row apps">
    <a class="app" href="https://elementaryos.stackexchange.com/questions/tagged/maya" target="_blank">
        <img width="64" height="64" src="images/icons/office-calendar.svg" />
        <span>Calendar</span>
    </a>

    <a class="app" href="https://elementaryos.stackexchange.com/questions/tagged/snap" target="_blank">
        <img width="64" height="64" src="images/icons/accessories-camera.svg" />
        <span>Camera</span>
    </a>

    <a class="app" href="https://elementaryos.stackexchange.com/questions/tagged/files" target="_blank">
        <img width="64" height="64" src="images/icons/system-file-manager.svg" />
        <span>Files</span>
    </a>

    <a class="app" href="https://elementaryos.stackexchange.com/questions/tagged/geary" target="_blank">
        <img width="64" height="64" src="images/icons/internet-mail.svg" />
        <span data-l10n-off>Geary</span>
    </a>

    <a class="app" href="https://elementaryos.stackexchange.com/questions/tagged/midori" target="_blank">
        <img width="64" height="64" src="images/icons/midori.svg" />
        <span data-l10n-off>Midori</span>
    </a>

    <a class="app" href="https://elementaryos.stackexchange.com/questions/tagged/noise" target="_blank">
        <img width="64" height="64" src="images/icons/multimedia-audio-player.svg" />
        <span>Music</span>
    </a>

    <a class="app" href="https://elementaryos.stackexchange.com/questions/tagged/photos" target="_blank">
        <img width="64" height="64" src="images/icons/multimedia-photo-manager.svg" />
        <span>Photos</span>
    </a>

    <a class="app" href="https://elementaryos.stackexchange.com/questions/tagged/scratch" target="_blank">
        <img width="64" height="64" src="images/icons/accessories-text-editor.svg" />
        <span data-l10n-off>Scratch</span>
    </a>

    <a class="app" href="https://elementaryos.stackexchange.com/questions/tagged/settings" target="_blank">
        <img width="64" height="64" src="images/icons/preferences-desktop.svg" />
        <span>System Settings</span>
    </a>

    <a class="app" href="https://elementaryos.stackexchange.com/questions/tagged/videos" target="_blank">
        <img width="64" height="64" src="images/icons/multimedia-video-player.svg" />
        <span>Videos</span>
    </a>
</div>

<div class="row">
    <a class="column half" href="https://elementaryos.stackexchange.com" target="_blank">
        <h3 class="read-more"><i class="fa fa-stack-exchange"></i> StackExchange</h3>
        <p>Has your question been asked already? Check out answers to some of the most common questions we get.</p>
    </a>

    <a class="column half" href="/docs/installation">
        <h3><i class="fa fa-download"></i> Installation</h3>
        <p>Get help installing elementary OS on your computer by following our step-by-step guide.</p>
    </a>
</div>

<?php
    include $template['footer'];
?>
