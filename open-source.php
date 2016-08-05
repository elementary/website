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
        <h4>The elementary OS platform is built upon a strong foundation of Free &amp; Open Source software. Without projects such as these, elementary OS would not exist.</h4>
        <a class="button suggested-action" href="get-involved#desktop-development">Get Involved</a>
    </div>
</div>
<div class="row">
    <div class="platform-item half">
        <img class="oss-logo" src="images/open-source/apps.svg" alt="Applications">
        <h3 class="oss-title">Applications</h3>
        <p class="oss-subtitle">elementary OS Apps</p>
        <div>
            <span class="sub-item"><a href="https://launchpad.net/pantheon-files" target="_blank">Files</a></span>
            <span class="sub-item"><a href="https://launchpad.net/pantheon-mail" target="_blank">Mail</a></span>
            <span class="sub-item"><a href="https://launchpad.net/noise" target="_blank">Music</a></span>
            <span class="sub-item"><a href="https://launchpad.net/pantheon-photos" target="_blank">Photos</a></span>
            <span class="sub-item"><a href="https://launchpad.net/audience" target="_blank">Videos</a></span>
        </div>
    </div>
    <div class="platform-item half">
        <img class="oss-logo" src="images/open-source/desktop.svg" alt="Desktop">
        <h3 class="oss-title">Desktop</h3>
        <p class="oss-subtitle">Pantheon Desktop Environment</p>
        <div>
            <span class="sub-item"><a href="https://launchpad.net/gala" target="_blank">Gala</a></span>
            <span class="sub-item"><a href="https://launchpad.net/wingpanel" target="_blank">Wingpanel</a></span>
            <span class="sub-item"><a href="https://launchpad.net/plank" target="_blank">Plank</a></span>
        </div>
    </div>
    <hr class="dotted full">
    <div class="platform-item half">
        <a href="http://gtk.org/" target="_blank"><img class="oss-logo" src="images/open-source/gtk.svg" alt="GTK+"></a>
        <h3 class="oss-title">GTK+</h3>
        <p class="oss-subtitle">User Interface Toolkit</p>
        <div>
            <span class="sub-item"><a href="http://www.pango.org/" target="_blank">Pango</a></span>
            <span class="sub-item"><a href="https://cairographics.org/" target="_blank">Cairo</a></span>
        </div>
    </div>
    <div class="platform-item half">
        <a href="https://gnome.org/" target="_blank"><img class="oss-logo" src="images/open-source/gnome.svg" alt="GNOME"></a>
        <h3 class="oss-title">GNOME</h3>
        <p class="oss-subtitle">Desktop Libraries</p>
        <div>
            <span class="sub-item"><a href="https://wiki.gnome.org/Projects/GLib" target="_blank">GLib</a></span>
            <span class="sub-item"><a href="https://wiki.gnome.org/Accessibility" target="_blank">ATK</a></span>
            <span class="sub-item"><a href="https://wiki.gnome.org/Projects/Clutter" target="_blank">Clutter</a></span>
        </div>
    </div>
    <div class="platform-item third">
        <a href="http://x.org/" target="_blank"><img class="oss-logo" src="images/open-source/xorg.svg" alt="X.org"></a>
        <h3 class="oss-title">X.org</h3>
        <p class="oss-subtitle">Display Server &amp; Windowing System</p>
        <div>
            <span class="sub-item">xserver</span>
            <span class="sub-item">XWayland</span>
        </div>
    </div>
    <div class="platform-item two-thirds">
        <a href="https://freedesktop.org/" target="_blank"><img class="oss-logo" src="images/open-source/freedesktop.svg" alt="FreeDesktop"></a>
        <h3 class="oss-title">FreeDesktop.org</h3>
        <p class="oss-subtitle">Base Technology</p>
        <div>
            <span class="sub-item"><a href="https://www.freedesktop.org/wiki/Software/systemd/" target="_blank">systemd</a></span>
            <span class="sub-item"><a href="https://gstreamer.freedesktop.org/" target="_blank">GStreamer</a></span>
            <span class="sub-item"><a href="https://www.freedesktop.org/wiki/Software/PulseAudio/" target="_blank">PulseAudio</a></span>
            <span class="sub-item"><a href="https://www.freedesktop.org/wiki/Software/dbus/" target="_blank">D-Bus</a></span>
            <span class="sub-item"><a href="https://www.freedesktop.org/wiki/Software/libinput/" target="_blank">libinput</a></span>
        </div>
    </div>
    <div class="platform-item two-thirds">
        <img class="oss-logo" src="images/open-source/linux.svg" alt="Linux">
        <h3 class="oss-title">Linux</h3>
        <p class="oss-subtitle">Hardware Support &amp; drivers</p>
        <div>
            <span class="sub-item"><a href="https://kernel.org/" target="_blank">Kernel</a></span>
        </div>
    </div>
    <div class="platform-item third">
        <a href="http://gnu.org/" target="_blank"><img class="oss-logo" src="images/open-source/gnu.svg" alt="GNU"></a>
        <h3 class="oss-title">GNU</h3>
        <p class="oss-subtitle">Complier &amp; Core Utilities</p>
        <div>
            <span class="sub-item"><a href="https://www.gnu.org/software/bash/" target="_blank">bash</a></span>
            <span class="sub-item"><a href="https://www.gnu.org/software/gcc/" target="_blank">GCC</a></span>
            <span class="sub-item"><a href="https://www.gnu.org/software/coreutils/" target="_blank">Coreutils</a></span>
        </div>
    </div>
</div>

<p class="small-label">All logos featured here are trademarks of their respective projects.</p>

<?php
    include $template['footer'];
?>
    