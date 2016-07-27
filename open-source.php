<?php
    include '_templates/sitewide.php';
    $page['title'] = 'Open Source &sdot; elementary';
    $page['scripts'] = '<link rel="stylesheet" type="text/css" media="all" href="styles/open-source.css">';
    include $template['header'];
    include $template['alert'];
?>

<div class="grid">
    <div class="nested top-level"?>
        <div id="logotype">
            <?php include('images/logotype-os.svg'); ?>
        </div>
        <p>elementary OS is built and relies on many open source projects to exist.</p>
        <div class="nested foundation">
            <div class="two-thirds">
                <img src="images/open-source/ubuntu.svg" alt="Ubuntu">
                <h2>Ubuntu</h2>
                <p>The Ubuntu LTS software repositories serve as a stable basis for elementary OS.</p>
                <p><a class="read-more" target="_blank" href="http://ubuntu.com/">Ubuntu Homepage</a></p>
            </div>
            <div class="nested libraries">
                <div class="two-thirds">
                    <img class="oss-logo" src="images/open-source/gtk.svg" alt="GTK+">
                    <img class="oss-logo" src="images/open-source/gnome.svg" alt="GNOME">
                    <h2>GTK+ &amp; GNOME</h2>
                    <p>elementary OS is built using many GNOME Project technologies and libraries. The graphical user interface toolkit (GTK+) enables the creation of elementary OS's modern, user-friendly interface.</p>
                    <p><a class="read-more" target="_blank" href="http://gtk.org/">GTK+ Homepage</a></p>
                    <p><a class="read-more" target="_blank" href="http://gnome.org/">GNOME Homepage</a></p>
                </div>
                <div class="nested display">
                    <div class="two-thirds">
                        <img class="oss-logo" src="images/open-source/xorg.svg" alt="X.Org">
                        <h2>X.Org</h2>
                        <p>The open source implementation of the X Window System and the X.org display server power the elementary OS desktop environment.</p>
                        <p><a class="read-more white" href="http://x.org/">X.Org Homepage</a></p>
                    </div>
                    <div class="nested low-level">
                        <div class="two-thirds">
                            <img class="oss-logo" src="images/open-source/linux.svg" alt="Linux">
                            <h2>Linux Kernel</h2>
                            <p>elementary OS is built upon the robust Linux kernel so it can run on virtually any computer.</p>
                            <p><a class="read-more" target="_blank" href="http://kernel.org/">Linux Kernel Homepage</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<p class="small-label">All logos featured here are trademarks of their respective projects.</p>

<?php
    include $template['footer'];
?>
    