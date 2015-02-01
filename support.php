<?php
    include '_templates/sitewide.php';
    $page['title'] = 'Support &sdot; elementary';
    $page['scripts'] .= '<link rel="stylesheet" type="text/css" media="all" href="styles/support.css">';
    include '_templates/header.php';
?>

<div class="row">
    <h1>Get support for <?php include("./images/logotype.svg"); ?></h1>
</div>
<div class="row">
    <a class="column half" href="#">
        <h3><i class="fa fa-question-circle"></i> FAQ</h3>
        <p>Has your question been asked already? Check out answers to some of the most common questions we get.</p>
    </a>

    <a class="column half" href="/installation">
        <h3><i class="fa fa-download"></i> Installation</h3>
        <p>Get help installing elementary OS on your computer by following our step-by-step guide.</p>
    </a>

    <a class="column half" href="https://plus.google.com/communities/104613975513761463450" target="_blank">
        <h3><i class="fa fa-google-plus-square"></i> Google+</h3>
        <p>Communicate with other elementary OS users in our Google+ community. Find crowd-sourced support, screenshots, the latest news, and more.</p>
    </a>

    <a class="column half" href="http://www.reddit.com/r/elementaryos/" target="_blank">
        <h3><i class="fa fa-reddit"></i> reddit</h3>
        <p>Discuss elementary OS with other fans and followers in our official subreddit. Ask the community for help or just chat about the OS.</p>
    </a>
</div>


<hr />

<div class="row apps">

    <h2>Get support for a specific app</h2>

    <a class="app" href="https://answers.launchpad.net/maya" target="_blank">
        <img width="64" height="64" src="images/support/office-calendar.svg" />
        <span>Calendar</span>
    </a>

    <a class="app" href="https://answers.launchpad.net/snap-elementary" target="_blank">
        <img width="64" height="64" src="images/support/accessories-camera.svg" />
        <span>Camera</span>
    </a>

    <a class="app" href="https://answers.launchpad.net/pantheon-files" target="_blank">
        <img width="64" height="64" src="images/support/system-file-manager.svg" />
        <span>Files</span>
    </a>

    <a class="app" href="https://answers.launchpad.net/geary" target="_blank">
        <img width="64" height="64" src="images/support/internet-mail.svg" />
        <span>Geary</span>
    </a>

    <a class="app" href="https://answers.launchpad.net/midori" target="_blank">
        <img width="64" height="64" src="images/support/midori.svg" />
        <span>Midori</span>
    </a>

    <a class="app" href="https://answers.launchpad.net/noise" target="_blank">
        <img width="64" height="64" src="images/support/multimedia-audio-player.svg" />
        <span>Music</span>
    </a>

    <a class="app" href="https://answers.launchpad.net/pantheon-photos" target="_blank">
        <img width="64" height="64" src="images/support/multimedia-photo-manager.svg" />
        <span>Photos</span>
    </a>

    <a class="app" href="https://answers.launchpad.net/scratch" target="_blank">
        <img width="64" height="64" src="images/support/accessories-text-editor.svg" />
        <span>Scratch</span>
    </a>

    <a class="app" href="https://answers.launchpad.net/switchboard" target="_blank">
        <img width="64" height="64" src="images/support/preferences-desktop.svg" />
        <span>System Settings</span>
    </a>

    <a class="app" href="https://answers.launchpad.net/pantheon-terminal" target="_blank">
        <img width="64" height="64" src="images/support/utilities-terminal.svg" />
        <span>Terminal</span>
    </a>

    <a class="app" href="https://answers.launchpad.net/audience" target="_blank">
        <img width="64" height="64" src="images/support/multimedia-video-player.svg" />
        <span>Videos</span>
    </a>
</div>

<?php
    include '_templates/footer.html';
?>
