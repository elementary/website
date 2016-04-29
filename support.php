<?php
    include '_templates/sitewide.php';
    $page['title'] = 'Support &sdot; elementary';
    $page['scripts'] = '<link rel="stylesheet" type="text/css" media="all" href="styles/support.css">';
    include $template['header'];
    include $template['alert'];
?>

<div class="row">
    <h1>Get support for <?php include("./images/logotype-os.svg"); ?></h1>
</div>

<div class="row apps">
    <a class="app" href="https://elementaryos.stackexchange.com/questions/tagged/maya" target="_blank">
        <img width="64" height="64" src="images/icons/office-calendar.svg" alt="Calendar" />
        <span>Calendar</span>
    </a>

    <a class="app" href="https://elementaryos.stackexchange.com/questions/tagged/snap" target="_blank">
        <img width="64" height="64" src="images/icons/accessories-camera.svg"  alt="Camera"/>
        <span>Camera</span>
    </a>

    <a class="app" href="https://elementaryos.stackexchange.com/questions/tagged/pantheon-files" target="_blank">
        <img width="64" height="64" src="images/icons/system-file-manager.svg" alt="Files" />
        <span>Files</span>
    </a>

    <a class="app" href="https://elementaryos.stackexchange.com/questions/tagged/geary" target="_blank">
        <img width="64" height="64" src="images/icons/internet-mail.svg" alt="Geary"/>
        <span data-l10n-off>Geary</span>
    </a>

    <a class="app" href="https://elementaryos.stackexchange.com/questions/tagged/midori" target="_blank">
        <img width="64" height="64" src="images/icons/midori.svg" alt="Midori"/>
        <span data-l10n-off>Midori</span>
    </a>

    <a class="app" href="https://elementaryos.stackexchange.com/questions/tagged/noise" target="_blank">
        <img width="64" height="64" src="images/icons/multimedia-audio-player.svg" alt="Audio Player"/>
        <span>Music</span>
    </a>

    <a class="app" href="https://elementaryos.stackexchange.com/questions/tagged/photos" target="_blank">
        <img width="64" height="64" src="images/icons/multimedia-photo-manager.svg" alt="Photos"/>
        <span>Photos</span>
    </a>

    <a class="app" href="https://elementaryos.stackexchange.com/questions/tagged/scratch" target="_blank">
        <img width="64" height="64" src="images/icons/accessories-text-editor.svg" alt="Text Editor"/>
        <span data-l10n-off>Scratch</span>
    </a>

    <a class="app" href="https://elementaryos.stackexchange.com/questions/tagged/settings" target="_blank">
        <img width="64" height="64" src="images/icons/preferences-desktop.svg" alt="System Settings"/>
        <span>System Settings</span>
    </a>

    <a class="app" href="https://elementaryos.stackexchange.com/questions/tagged/videos" target="_blank">
        <img width="64" height="64" src="images/icons/multimedia-video-player.svg" alt="Videos"/>
        <span>Videos</span>
    </a>
</div>

<div class="row">
    <a class="column third" href="/docs/installation">
        <i class="fa fa-download"></i>
        <h3>Installation</h3>
        <p>Get help installing elementary OS with our step-by-step guide.</p>
    </a>

    <a class="column third" href="/docs/learning-the-basics">
        <i class="fa fa-book"></i>
        <h3>Learning the Basics</h3>
        <p>Walk through the desktop, multi-tasking, keyboard shortcuts and more.</p>
    </a>

    <a class="column third" href="https://elementaryos.stackexchange.com" target="_blank">
        <i class="fa fa-stack-exchange"></i>
        <h3 class="read-more">StackExchange</h3>
        <p>Check out answers to some of the most common questions we get.</p>
    </a>
</div>

<?php
    include $template['footer'];
?>
