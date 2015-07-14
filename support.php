<?php
    include '_templates/sitewide.php';
    $page['title'] = 'Support &sdot; elementary';
    $page['scripts'] = '<link rel="stylesheet" type="text/css" media="all" href="styles/support.css">';
    include $template['header'];
?>

<div class="row">
    <h1>Get support for <?php include("./images/logotype.svg"); ?></h1>
</div>

<div class="row apps">
    <a class="app" href="https://answers.launchpad.net/maya" target="_blank">
        <img width="64" height="64" src="images/icons/office-calendar.svg" />
        <span>Calendar</span>
    </a>

    <a class="app" href="https://answers.launchpad.net/snap-elementary" target="_blank">
        <img width="64" height="64" src="images/icons/accessories-camera.svg" />
        <span>Camera</span>
    </a>

    <a class="app" href="https://answers.launchpad.net/pantheon-files" target="_blank">
        <img width="64" height="64" src="images/icons/system-file-manager.svg" />
        <span>Files</span>
    </a>

    <a class="app" href="https://answers.launchpad.net/ubuntu/+source/geary" target="_blank">
        <img width="64" height="64" src="images/icons/internet-mail.svg" />
        <span data-l10n-off>Geary</span>
    </a>

    <a class="app" href="https://answers.launchpad.net/midori" target="_blank">
        <img width="64" height="64" src="images/icons/midori.svg" />
        <span data-l10n-off>Midori</span>
    </a>

    <a class="app" href="https://answers.launchpad.net/noise" target="_blank">
        <img width="64" height="64" src="images/icons/multimedia-audio-player.svg" />
        <span>Music</span>
    </a>

    <a class="app" href="https://answers.launchpad.net/pantheon-photos" target="_blank">
        <img width="64" height="64" src="images/icons/multimedia-photo-manager.svg" />
        <span>Photos</span>
    </a>

    <a class="app" href="https://answers.launchpad.net/scratch" target="_blank">
        <img width="64" height="64" src="images/icons/accessories-text-editor.svg" />
        <span data-l10n-off>Scratch</span>
    </a>

    <a class="app" href="https://answers.launchpad.net/switchboard" target="_blank">
        <img width="64" height="64" src="images/icons/preferences-desktop.svg" />
        <span>System Settings</span>
    </a>

    <a class="app" href="https://answers.launchpad.net/audience" target="_blank">
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

    <a class="column half" href="https://plus.google.com/communities/104613975513761463450" target="_blank">
        <h3 class="read-more" data-l10n-off><i class="fa fa-google-plus-square"></i> Google+</h3>
        <p>Communicate with other elementary OS users in our Google+ community. Find crowd-sourced support, screenshots, the latest news, and more.</p>
    </a>

    <a class="column half" href="http://www.reddit.com/r/elementaryos/" target="_blank">
        <h3 class="read-more" data-l10n-off><i class="fa fa-reddit"></i> reddit</h3>
        <p>Discuss elementary OS with other fans and followers in our official subreddit. Ask the community for help or just chat about the OS.</p>
    </a>
</div>

<?php
    include $template['footer'];
?>
