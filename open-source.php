<?php
    include '_templates/sitewide.php';
    $page['title'] = 'Open Source &sdot; elementary';
    $page['scripts'] = '<link rel="stylesheet" type="text/css" media="all" href="styles/open-source.css">';
    include $template['header'];
    include $template['alert'];
?>

<div class="grid">
    <div class="two-thirds">
        <div id="logotype">
            <?php include('images/logotype-os.svg'); ?>
        </div>
        <h4>The elementary OS platform is built upon a strong foundation of Free &amp; Open Source software. Without projects like these, elementary OS would not exist.</h4>
    </div>
</div>
<div class="row">
    <div class="platform-item full">
        <img class="oss-logo" src="images/open-source/apps.svg" alt="Linux">
        <h3 class="oss-title">elementary Applications</h3>
    </div>
    <div class="platform-item third">
        <img class="oss-logo" src="images/open-source/desktop.svg" alt="Linux">
        <h3 class="oss-title">Pantheon</h3>
        <p class="oss-subtitle">elementary OS Desktop</p>
        <div>
            <span class="sub-item"><a href="https://launchpad.net/gala" target="_blank">Gala</a></span>
            <span class="sub-item"><a href="https://launchpad.net/wingpanel" target="_blank">Wingpanel</a></span>
            <span class="sub-item"><a href="https://launchpad.net/plank" target="_blank">Plank</a></span>
        </div>
    </div>
    <div class="platform-item third">
        <img class="oss-logo" src="images/open-source/gtk.svg" alt="Linux">
        <h3 class="oss-title"><a href="http://gtk.org/" target="_blank">GTK+</a></h3>
        <p class="oss-subtitle">User interface toolkit</p>
        <div>
            <span class="sub-item"><a href="http://www.pango.org/" target="_blank">Pango</a></span>
            <span class="sub-item"><a href="https://cairographics.org/" target="_blank">Cairo</a></span>
        </div>
    </div>
    <div class="platform-item third">
        <img class="oss-logo" src="images/open-source/gnome.svg" alt="Linux">
        <h3 class="oss-title"><a href="https://gnome.org/" target="_blank">GNOME</a></h3>
        <p class="oss-subtitle">Desktop libraries</p>
        <div>
            <span class="sub-item"><a href="https://wiki.gnome.org/Projects/GLib" target="_blank">GLib</a></span>
            <span class="sub-item"><a href="https://wiki.gnome.org/Accessibility" target="_blank">ATK</a></span>
            <span class="sub-item"><a href="https://wiki.gnome.org/Projects/Clutter" target="_blank">Clutter</a></span>
        </div>
    </div>
    <div class="platform-item half">
        <img class="oss-logo" src="images/open-source/xorg.svg" alt="X11">
        <h3 class="oss-title"><a href="http://x.org/" target="_blank">X.org</a></h3>
        <p class="oss-subtitle">Display Server &amp; Windowing System</p>
        <div>
            <span class="sub-item">xserver</span>
            <span class="sub-item">XWayland</span>
        </div>
    </div>
    <div class="platform-item half">
        <img class="oss-logo" src="images/open-source/freedesktop.svg" alt="X11">
        <h3 class="oss-title"><a href="https://freedesktop.org/" target="_blank">FreeDesktop.org</a></h3>
        <p class="oss-subtitle">Base technology &amp; backend</p>
        <div>
            <span class="sub-item"><a href="https://www.freedesktop.org/wiki/Software/systemd/" target="_blank">systemd</a></span>
            <span class="sub-item"><a href="https://gstreamer.freedesktop.org/" target="_blank">GStreamer</a></span>
            <span class="sub-item"><a href="https://www.freedesktop.org/wiki/Software/PulseAudio/" target="_blank">PulseAudio</a></span>
            <span class="sub-item"><a href="https://www.freedesktop.org/wiki/Software/dbus/" target="_blank">D-Bus</a></span>
        </div>
    </div>
    <div class="platform-item third">
        <img class="oss-logo" src="images/open-source/gnu.svg" alt="GNU">
        <h3 class="oss-title"><a href="http://gnu.org/" target="_blank">GNU</a></h3>
        <p class="oss-subtitle">Operating system</p>
    </div>
    <div class="platform-item two-thirds">
        <img class="oss-logo" src="images/open-source/linux.svg" alt="Linux">
        <h3 class="oss-title">Linux Kernel</h3>
        <p class="oss-subtitle">Device drivers, modules</p>
    </div>
    <div class="platform-item full">
        <img class="oss-logo" src="images/open-source/hardware.svg" alt="Linux">
        <h3 class="oss-title">Hardware</h3>
    </div>
</div>

<p class="small-label">All logos featured here are trademarks of their respective projects.</p>

<?php
    include $template['footer'];
?>
    