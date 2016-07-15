<?php
    include '_templates/sitewide.php';
    $page['title'] = 'Open Source';
    $page['scripts'] = '<link rel="stylesheet" type="text/css" media="all" href="styles/open-source.css">';
    include $template['header'];
    include $template['alert'];
?>

    <div class="grid">
        <div class="row">
            <div class="nested top-level"?>
                <div id="logotype">

                    <?php
                        // Embed the SVG to fix scaling in WebKit 1.x,
                        // while preserving CSS options for the image.
                        include('images/logotype-os.svg');
                    ?>

                </div>
                <p>elementary is built upon a strong foundation of open source</p>
                <div class="nested foundation">
                    <div class="two-thirds">
                        <img src="images/open-source/ubuntu.svg" alt="Ubuntu">
                        <h2>Ubuntu</h2>
                        <p>The Ubuntu repositories serve as the foundation of elementary OS</p>
                        <p><a class="read-more" target="_blank" href="http://ubuntu.com/">Ubuntu Homepage</a></p>
                    </div>
                    <div class="nested libraries">
                        <div class="two-thirds">
                            <img class="oss-logo" src="images/open-source/gnome.svg" alt="GNOME">
                            <img class="oss-logo" src="images/open-source/gtk.svg" alt="GTK+">
                            <h2>GNOME &amp; GTK+</h2>
                            <p>The GNOME and related GTK+ projects provides a foundation of system libraries upon which the elementary OS desktop is built.</p>
                            <p><a class="read-more" target="_blank" href="http://gnome.org/">GNOME Homepage</a></p>
                            <p><a class="read-more" target="_blank" href="http://gtk.org/">GTK+ Homepage</a></p>
                        </div>
                        <div class="nested display">
                            <div class="two-thirds">
                                <img class="oss-logo" src="images/open-source/xorg.svg" alt="X.Org">
                                <h2>X.Org</h2>
                                <p>It's the display server. woo.</p>
                                <p><a class="read-more white" href="http://x.org/">X.Org Homepage</a></p>
                            </div>
                            <div class="nested low-level">
                                <div class="two-thirds">
                                    <img class="oss-logo" src="images/open-source/gnu.svg" alt="GNU">
                                    <img class="oss-logo" src="images/open-source/linux.svg" alt="Linux">
                                    <h2>GNU &amp; Linux</h2>
                                    <p>At the lower level, elementary OS is built upon the robust combination of the GNU stack and the Linux kernel.</p>
                                    <p><a class="read-more" target="_blank" href="http://linuxfoundation.org/">Linux Foundation Homepage</a></p>
                                    <p><a class="read-more" target="_blank" href="http://gnu.org/">GNU Project Homepage</a></p>
                                </div>
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
    