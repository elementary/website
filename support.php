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

    <a class="app" href="#" target="_blank">
        <img src="/images/icons/apps/64/office-calendar.svg" />
        <span>Calendar</span>
    </a>

    <a class="app" href="#" target="_blank">
        <img src="/images/icons/apps/64/accessories-camera.svg" />
        <span>Camera</span>
    </a>

    <a class="app" href="#" target="_blank">
        <img src="/images/icons/apps/64/system-file-manager.svg" />
        <span>Files</span>
    </a>

    <a class="app" href="#" target="_blank">
        <img src="/images/icons/apps/64/internet-mail.svg" />
        <span>Geary</span>
    </a>

    <a class="app" href="#" target="_blank">
        <img src="/images/icons/apps/64/midori.svg" />
        <span>Midori</span>
    </a>

    <a class="app" href="#" target="_blank">
        <img src="/images/icons/apps/64/multimedia-audio-player.svg" />
        <span>Music</span>
    </a>

    <a class="app" href="#" target="_blank">
        <img src="/images/icons/apps/64/multimedia-photo-manager.svg" />
        <span>Photos</span>
    </a>

    <a class="app" href="#" target="_blank">
        <img src="/images/icons/apps/64/accessories-text-editor.svg" />
        <span>Scratch</span>
    </a>

    <a class="app" href="#" target="_blank">
        <img src="/images/icons/apps/64/preferences-desktop.svg" />
        <span>System Settings</span>
    </a>

    <a class="app" href="#" target="_blank">
        <img src="/images/icons/apps/64/utilities-terminal.svg" />
        <span>Terminal</span>
    </a>

    <a class="app" href="#" target="_blank">
        <img src="/images/icons/apps/64/multimedia-video-player.svg" />
        <span>Videos</span>
    </a>
</div>

<?php
    include '_templates/footer.html';
?>
