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
    <div class="platform-item full">
        <img class="oss-logo" src="images/icons/distributor-logo.svg" alt="Applications">
        <p class="oss-title">elementary OS Applications</p>
        <div>
            <a class="sub-item button" href="https://launchpad.net/maya" target="_blank"><span>Calendar</span></a>
            <a class="sub-item button" href="https://launchpad.net/snap-elementary" target="_blank"><span>Camera</span></a>
            <a class="sub-item button" href="https://launchpad.net/pantheon-files" target="_blank"><span>Files</span></a>
            <a class="sub-item button" href="https://launchpad.net/pantheon-mail" target="_blank"><span>Mail</span></a>
            <a class="sub-item button" href="https://launchpad.net/noise" target="_blank"><span>Music</span></a>
            <a class="sub-item button" href="https://launchpad.net/pantheon-photos" target="_blank"><span>Photos</span></a>
            <a class="sub-item button" href="https://launchpad.net/scratch" target="_blank"><span>Scratch</span></a>
            <a class="sub-item button" href="https://launchpad.net/pantheon-terminal" target="_blank"><span>Terminal</span></a>
            <a class="sub-item button" href="https://launchpad.net/audience" target="_blank"><span>Videos</span></a>
        </div>
    </div>
    <div class="platform-item full">
        <img class="oss-logo" src="images/icons/preferences-desktop-wallpaper.svg" alt="Desktop">
        <p class="oss-title">Pantheon Desktop Environment</p>
        <div>
            <a class="sub-item button" href="https://launchpad.net/contractor" target="_blank"><span>Contractor</span></a>
            <a class="sub-item button" href="https://launchpad.net/egtk" target="_blank"><span>eGTK</span></a>
            <a class="sub-item button" href="https://launchpad.net/gala" target="_blank"><span>Gala</span></a>
            <a class="sub-item button" href="https://launchpad.net/granite" target="_blank"><span>Granite</span></a>
            <a class="sub-item button" href="https://github.com/elementary/icons" target="_blank"><span>Icons</span></a>
            <a class="sub-item button" href="https://launchpad.net/plank" target="_blank"><span>Plank</span></a>
            <a class="sub-item button" href="https://launchpad.net/slingshot" target="_blank"><span>Slingshot</span></a>
            <a class="sub-item button" href="https://launchpad.net/switchboard" target="_blank"><span>Switchboard</span></a>
            <a class="sub-item button" href="https://launchpad.net/wingpanel" target="_blank"><span>Wingpanel</span></a>
        </div>
    </div>
    <hr class="dotted full">
    <div class="platform-item third">
        <a href="http://gtk.org/" target="_blank"><img class="oss-logo" src="images/open-source/gtk.svg" alt="GTK+"></a>
        <h3 class="oss-title">GTK+</h3>
        <p class="oss-subtitle">User Interface Toolkit</p>
        <div>
            <a class="sub-item button" href="http://www.gtk.org/" target="_blank"><span>GTK+</span></a>
            <a class="sub-item button" href="http://www.pango.org/" target="_blank"><span>Pango</span></a>
            <a class="sub-item button" href="https://cairographics.org/" target="_blank"><span>Cairo</span></a>
        </div>
    </div>
    <div class="platform-item two-thirds">
        <a href="https://gnome.org/" target="_blank"><img class="oss-logo" src="images/open-source/gnome.svg" alt="GNOME"></a>
        <h3 class="oss-title">GNOME</h3>
        <p class="oss-subtitle">Desktop Libraries</p>
        <div>
            <a class="sub-item button" href="https://wiki.gnome.org/Accessibility" target="_blank"><span>ATK</span></a>
            <a class="sub-item button" href="https://wiki.gnome.org/Projects/dconf" target="_blank"><span>D-Conf</span></a>
            <a class="sub-item button" href="https://wiki.gnome.org/Projects/Clutter" target="_blank"><span>Clutter</span></a>
            <a class="sub-item button" href="https://wiki.gnome.org/Projects/GLib" target="_blank"><span>GLib</span></a>
            <a class="sub-item button" href="https://wiki.gnome.org/Projects/PolicyKit" target="_blank"><span>PolicyKit</span></a>
            <a class="sub-item button" href="https://wiki.gnome.org/Projects/Vala" target="_blank"><span>Vala</span></a>
        </div>
    </div>
    <div class="platform-item two-thirds">
        <a href="https://freedesktop.org/" target="_blank"><img class="oss-logo" src="images/open-source/freedesktop.svg" alt="FreeDesktop"></a>
        <h3 class="oss-title">FreeDesktop.org</h3>
        <p class="oss-subtitle">Base Technology</p>
        <div>
            <a class="sub-item button" href="https://www.freedesktop.org/wiki/Software/dbus/" target="_blank"><span>D-Bus</span></a>
            <a class="sub-item button" href="https://gstreamer.freedesktop.org/" target="_blank"><span>GStreamer</span></a>
            <a class="sub-item button" href="https://www.freedesktop.org/wiki/Software/libinput/" target="_blank"><span>libinput</span></a>
            <a class="sub-item button" href="https://www.freedesktop.org/wiki/Software/lightdm/" target="_blank"><span>LightDM</span></a>
            <a class="sub-item button" href="https://www.freedesktop.org/wiki/Software/PulseAudio/" target="_blank"><span>PulseAudio</span></a>
            <a class="sub-item button" href="https://www.freedesktop.org/wiki/Software/systemd/" target="_blank"><span>systemd</span></a>
        </div>
    </div>
    <div class="platform-item third">
        <a href="http://x.org/" target="_blank"><img class="oss-logo" src="images/open-source/xorg.svg" alt="X.org"></a>
        <h3 class="oss-title">X.org</h3>
        <p class="oss-subtitle">Display Server &amp; Windowing System</p>
        <div>
            <a class="sub-item button" href="https://www.x.org/wiki/XServer/" target="_blank"><span>XServer</span></a>
            <a class="sub-item button" href="https://wayland.freedesktop.org/xserver.html" target="_blank"><span>XWayland</span></a>
        </div>
    </div>
    <div class="platform-item half">
        <a href="http://gnu.org/" target="_blank"><img class="oss-logo" src="images/open-source/gnu.svg" alt="GNU"></a>
        <h3 class="oss-title">GNU</h3>
        <p class="oss-subtitle">Complier &amp; Core Utilities</p>
        <div>
            <a class="sub-item button" href="https://www.gnu.org/software/bash/" target="_blank"><span>bash</span></a>
            <a class="sub-item button" href="https://www.gnu.org/software/gcc/" target="_blank"><span>GCC</span></a>
            <a class="sub-item button" href="https://www.gnu.org/software/coreutils/" target="_blank"><span>Coreutils</span></a>
        </div>
    </div>
    <div class="platform-item half">
        <img class="oss-logo" src="images/open-source/linux.svg" alt="Linux">
        <h3 class="oss-title">Linux</h3>
        <p class="oss-subtitle">Hardware Support &amp; drivers</p>
        <div>
            <a class="sub-item button" href="https://kernel.org/" target="_blank"><span>Kernel</span></a>
        </div>
    </div>
</div>

<p class="small-label">All logos featured here are trademarks of their respective projects.</p>

<?php
    include $template['footer'];
?>
    