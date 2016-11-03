<?php
    require_once __DIR__.'/_backend/preload.php';

    $page['title'] = 'Open Source &sdot; elementary';

    $page['styles'] = array(
        'styles/open-source.css'
    );

    include $template['header'];
    include $template['alert'];
?>

<div class="grid">
    <div class="two-thirds">
        <h1>Open Source</h1>
        <h4>The elementary OS platform is built upon a strong foundation of Free &amp; Open Source software. Without projects such as these, elementary OS would not exist.</h4>
        <a class="button suggested-action" href="get-involved#desktop-development">Get Involved</a>
    </div>
</div>
<div class="grid">
    <div class="platform-item full">
        <a href="get-involved#desktop-development">
            <img class="oss-logo" src="images/icons/places/64/distributor-logo.svg" alt="Applications">
            <p class="oss-title">elementary OS Applications</p>
        </a>
        <div>
            <a class="button sub-item" href="https://launchpad.net/maya" target="_blank"><span>Calendar</span></a>
            <a class="button sub-item" href="https://launchpad.net/snap-elementary" target="_blank"><span>Camera</span></a>
            <a class="button sub-item" href="https://launchpad.net/pantheon-files" target="_blank"><span>Files</span></a>
            <a class="button sub-item" href="https://launchpad.net/pantheon-mail" target="_blank"><span>Mail</span></a>
            <a class="button sub-item" href="https://launchpad.net/noise" target="_blank"><span>Music</span></a>
            <a class="button sub-item" href="https://launchpad.net/pantheon-photos" target="_blank"><span>Photos</span></a>
            <a class="button sub-item" href="https://launchpad.net/scratch" target="_blank"><span>Scratch</span></a>
            <a class="button sub-item" href="https://launchpad.net/pantheon-terminal" target="_blank"><span>Terminal</span></a>
            <a class="button sub-item" href="https://launchpad.net/audience" target="_blank"><span>Videos</span></a>
        </div>
    </div>
    <div class="platform-item half">
        <a href="get-involved#desktop-development">
            <img class="oss-logo" src="images/icons/categories/64/preferences-desktop-wallpaper.svg" alt="Desktop Shell">
            <p class="oss-title">Pantheon Desktop Shell</p>
        </a>
        <div>
            <a class="button sub-item" href="https://github.com/elementary/stylesheet" target="_blank"><span>GTK+ Stylesheet</span></a>
            <a class="button sub-item" href="https://github.com/elementary/icons" target="_blank"><span>Icon Theme</span></a>
            <a class="button sub-item" href="https://launchpad.net/gala" target="_blank"><span>Gala</span></a>
            <a class="button sub-item" href="https://launchpad.net/plank" target="_blank"><span>Plank</span></a>
            <a class="button sub-item" href="https://launchpad.net/slingshot" target="_blank"><span>Slingshot</span></a>
            <a class="button sub-item" href="https://launchpad.net/switchboard" target="_blank"><span>Switchboard</span></a>
            <a class="button sub-item" href="https://launchpad.net/wingpanel" target="_blank"><span>Wingpanel</span></a>
        </div>
    </div>
    <div class="platform-item half">
        <a href="get-involved#desktop-development">
            <img class="oss-logo" src="images/open-source/platform.svg" alt="Platform">
            <p class="oss-title">Pantheon Platform</p>
        </a>
        <div>
            <a class="button sub-item" href="https://launchpad.net/contractor" target="_blank"><span>Contractor</span></a>
            <a class="button sub-item" href="https://launchpad.net/granite" target="_blank"><span>Granite</span></a>
            <a class="button sub-item" href="https://launchpad.net/capnet-assist" target="_blank"><span>Captive Portal Assistant</span></a>
            <a class="button sub-item" href="https://launchpad.net/pantheon-online-accounts" target="_blank"><span>Pantheon Online Accounts</span></a>
            <a class="button sub-item" href="https://launchpad.net/pantheon-agent-polkit" target="_blank"><span>Polkit Agent</span></a>
        </div>
    </div>
    <hr class="dotted full">
    <div class="platform-item third" id="ubuntu">
        <a href="https://ubuntu.com/" target="_blank">
            <img class="oss-logo" src="images/open-source/ubuntu.svg" alt="Ubuntu">
            <h3 class="oss-title">Ubuntu</h3>
            <p class="oss-subtitle">Desktop Libraries &amp; Repositories</p>
        </a>
        <div>
            <a class="button sub-item" href="https://launchpad.net/ayatana" target="_blank"><span>Ayatana</span></a>
            <a class="button sub-item" href="https://launchpad.net/bamf" target="_blank"><span>BAMF</span></a>
            <a class="button sub-item" href="https://launchpad.net/libunity" target="_blank"><span>libunity</span></a>
            <a class="button sub-item" href="https://launchpad.net/ubiquity" target="_blank"><span>Ubiquity</span></a>
        </div>
    </div>
    <div class="platform-item third" id="gtk">
        <a href="http://gtk.org/" target="_blank">
            <img class="oss-logo" src="images/open-source/gtk.svg" alt="GTK+">
            <h3 class="oss-title">GTK+</h3>
            <p class="oss-subtitle">User Interface Toolkit</p>
        </a>
        <div>
            <a class="button sub-item" href="https://wiki.gnome.org/Accessibility" target="_blank"><span>ATK</span></a>
            <a class="button sub-item" href="http://www.gtk.org/" target="_blank"><span>GTK+</span></a>
            <a class="button sub-item" href="http://www.pango.org/" target="_blank"><span>Pango</span></a>
            <a class="button sub-item" href="https://cairographics.org/" target="_blank"><span>Cairo</span></a>
        </div>
    </div>
    <div class="platform-item third" id="gnome">
        <a href="https://gnome.org/" target="_blank">
            <img class="oss-logo" src="images/open-source/gnome.svg" alt="GNOME">
            <h3 class="oss-title">GNOME</h3>
            <p class="oss-subtitle">Desktop Libraries</p>
        </a>
        <div>
            <a class="button sub-item" href="https://wiki.gnome.org/Projects/dconf" target="_blank"><span>D-Conf</span></a>
            <a class="button sub-item" href="https://wiki.gnome.org/Projects/GLib" target="_blank"><span>GLib</span></a>
            <a class="button sub-item" href="https://wiki.gnome.org/Projects/PolicyKit" target="_blank"><span>PolicyKit</span></a>
            <a class="button sub-item" href="https://wiki.gnome.org/Projects/Vala" target="_blank"><span>Vala</span></a>
        </div>
    </div>
    <div class="platform-item two-thirds" id="fdo">
        <a href="https://freedesktop.org/" target="_blank">
            <img class="oss-logo" src="images/open-source/freedesktop.svg" alt="FreeDesktop">
            <h3 class="oss-title">FreeDesktop.org</h3>
            <p class="oss-subtitle">Base Technology</p>
        </a>
        <div>
            <a class="button sub-item" href="https://www.freedesktop.org/wiki/Software/dbus/" target="_blank"><span>D-Bus</span></a>
            <a class="button sub-item" href="https://gstreamer.freedesktop.org/" target="_blank"><span>GStreamer</span></a>
            <a class="button sub-item" href="https://www.freedesktop.org/wiki/Software/libinput/" target="_blank"><span>libinput</span></a>
            <a class="button sub-item" href="https://www.freedesktop.org/wiki/Software/LightDM/" target="_blank"><span>LightDM</span></a>
            <a class="button sub-item" href="https://www.freedesktop.org/wiki/Software/PulseAudio/" target="_blank"><span>PulseAudio</span></a>
            <a class="button sub-item" href="https://www.freedesktop.org/wiki/Software/systemd/" target="_blank"><span>systemd</span></a>
        </div>
    </div>
    <div class="platform-item third" id="xorg">
        <a href="http://x.org/" target="_blank">
            <img class="oss-logo" src="images/open-source/xorg.svg" alt="X.org">
            <h3 class="oss-title">X.org</h3>
            <p class="oss-subtitle">Display Server &amp; Windowing System</p>
        </a>
        <div>
            <a class="button sub-item" href="https://www.x.org/" target="_blank"><span>X11</span></a>
            <a class="button sub-item" href="https://www.x.org/wiki/XServer/" target="_blank"><span>XServer</span></a>
        </div>
    </div>
    <div class="platform-item half" id="gnu">
        <a href="http://gnu.org/" target="_blank">
            <img class="oss-logo" src="images/open-source/gnu.svg" alt="GNU">
            <h3 class="oss-title">GNU</h3>
            <p class="oss-subtitle">Compiler &amp; Core Utilities</p>
        </a>
        <div>
            <a class="button sub-item" href="https://www.gnu.org/software/bash/" target="_blank"><span>Bash</span></a>
            <a class="button sub-item" href="https://www.gnu.org/software/gcc/" target="_blank"><span>GCC</span></a>
            <a class="button sub-item" href="https://www.gnu.org/software/libc/" target="_blank"><span>GNU C Library</span></a>
            <a class="button sub-item" href="https://www.gnu.org/software/coreutils/" target="_blank"><span>Coreutils</span></a>
        </div>
    </div>
    <div class="platform-item half" id="linux">
        <a href="https://kernel.org/" target="_blank">
            <img class="oss-logo" src="images/open-source/linux.svg" alt="Linux">
            <h3 class="oss-title">Linux</h3>
            <p class="oss-subtitle">Filesystem, Hardware, Networking &amp; Drivers</p>
        </a>
        <div>
            <a class="button sub-item" href="https://kernel.org/" target="_blank"><span>Kernel</span></a>
        </div>
    </div>
</div>

<p class="small-label">All logos featured here are trademarks of their respective projects.</p>

<?php
    include $template['footer'];
?>
