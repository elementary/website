<?php
    include '_templates/sitewide.php';
    $page['title'] = 'Installing elementary OS';
    include $template['header'];
?>
            <div class="row">
                <h1>Installation</h1>
                <p>elementary OS is designed to run on any relatively new 32-bit and 64-bit desktop or laptop. In this section, we'll cover system requirements and other prerequisites to installing elementary OS on your computer.</p>

                <h3>System Requirements</h3>

                <div class="column half">
                    <p>Minimum System Requirements:</p>
                    <ul>
                        <li>1 GHz 32-bit or 64-bit processor</li>
                        <li>512 MB of system memory (RAM)</li>
                        <li>5 GB of disk space</li>
                    </ul>
                </div>
                <div class="column half">
                    <p>Recommended System Requirements:</p>
                    <ul>
                        <li>1 GHz 32-bit or 64-bit processor</li>
                        <li>1 GB of system memory (RAM)</li>
                        <li>15 GB of disk space</li>
                        <li>Internet access</li>
                    </ul>
                </div>

                <h3>Downloading elementary OS</h3>
                <p>If you haven't already, you will need to <a href="/" target="_blank">download elementary OS from our home page</a>. You will need to copy the downloaded ISO file to a USB flash drive using the instructions below.</p>

                <h3>32-bit versus 64-bit</h3>
                <p>elementary OS is currently built for two processor architectures, 32-bit and 64-bit.</p>
                <ul>
                    <li>If you know you have a newer computer with a 64-bit processor, choose the 64-bit version.</li>
                    <li>If your computer is older or you do not know which type of processor your computer has, choose the 32-bit version. (64-bit processors will still be able to run this version).</li>
                </ul>

                <div class="row alert warning">
                    <div class="column alert">
                        <i class="warning fa fa-warning"></i>
                    </div>
                    <div class="column alert">
                        <h3>Back Up Your Data</h3>
                        <p>Make sure to back your important data up to an external location such as a cloud service or an external hard drive. Installing a new operating system may overwrite your existing data.</p>
                    </div>
                </div>

                <div class="text-center">
                    <h3 id="creating-an-installation-medium">Creating an Install Drive</h3>
                    <div id="creating-a-usb-choices" class="column linked">
                        <a class="button creating-a-usb-on-windows" href="#creating-a-usb-on-windows">Windows</a>
                        <a class="button creating-a-usb-on-others" href="#creating-a-usb-on-others">OS X & Ubuntu</a>
                    </div>
                </div>


                <div id="creating-a-usb-on-windows" class="slide">
                    <h3>Windows</h3>

                    <p>Begin with a spare USB flash drive with at least 1 GB of free space.</p>

                    <p>You'll also need a small application called Rufus. You'll have to download it from <a href="https://rufus.akeo.ie/" target="_blank">its website</a> and open the downloaded file to launch it. It will open a window like the one below:</p>

                    <img src="images/installation/rufus.png" alt="Rufus">

                    <p>You can now insert your USB drive and select it in the "Device" list. After that, you'll have to select "ISO Image" in "Create a bootable disk using..." and click <img src="images/installation/rufus_disk_icon.png" alt="the disk icon"> to choose the ISO that you downloaded previously.</p>

                    <img src="images/installation/rufus_select_iso.png" alt="Rufus - select ISO">

                    <p>Click "Start", then just wait for the process to finish.</p>
                </div>


                <div id="creating-a-usb-on-others" class="slide">
                    <h3>OS X, Ubuntu, and others</h3>

                    <p>Begin with a spare USB flash drive with at least 1 GB of free space.</p>

                    <p>You'll also need a small application called UNetbootin. To install it in Ubuntu, just <a href="http://appnr.com/install/unetbootin">click this link</a>. In OS X you'll have to download it from <a href="http://unetbootin.sourceforge.net/" target="_blank">its website</a> and open the downloaded file to install it.</p>

                    <p>Open UNetbootin from the Dash in Ubuntu or Launchpad in OS X. It will open a window like the one below:</p>

                    <img src="images/installation/unetbootin.png" alt="UNetbootin">

                    <p>Make sure "Diskimage" is selected, and click "&#8230;" to select the ISO that you downloaded previously. Unplug all USB memory devices apart from the one you want to use. Click "OK" and wait for the process to finish.</p>
                </div>


                <h3 id="booting-from-the-installation-medium">Booting from the Install Drive</h3>
                <p>In order to start the installation process, you must boot your computer from the install drive. This process may differ depending on the type of computer you have. This guide covers the most common use cases.</p>

                <div class="text-center">
                    <div id="booting-choices" class="column linked">
                        <a class="button booting-on-a-pc" href="#booting-on-a-pc">Booting on a PC</a>
                        <a class="button booting-on-a-mac" href="#booting-on-a-mac">Booting on a Mac</a>
                    </div>
                </div>


                <div id="booting-on-a-pc" class="slide">
                    <h2>Booting on a PC</h2>

                    <ul>
                        <li>Assuming that your computer is still on, start by inserting your install drive and restarting your computer.</li>
                        <li>Most computers will briefly allow you to change the boot order for this boot only by pressing a special key — usually <kbd>F12</kbd>, but sometimes <kbd>Esc</kbd> or another function key. Refer to the screen or your computer's documentation to be sure.</li>
                        <li>Press <kbd>F12</kbd> (or the appropriate key) and select the install drive&mdash;usually "USB-HDD" or something containing the word "USB", but the wording may vary. If you choose the incorrect drive, your computer will likely continue to boot as normal. Just restart your computer and pick a different drive in that menu.</li>
                        <li>Shortly after selecting the appropriate boot drive, you should be presented with the elementary OS splash screen. You may now follow the on-screen instructions which will guide you through the rest of the process.</li>
                    </ul>
                </div>


                <div id="booting-on-a-mac" class="slide">
                    <h2>Booting on a Mac</h2>

                    <ul>
                        <li>Assuming that your computer is still on, start by inserting your install drive and restarting your computer.</li>
                        <li>After you hear the chime, press and hold <kbd>Option</kbd>. Then, select the appropriate boot drive. Note that it may be incorrectly identified as "Windows", but this is normal.</li>
                        <li>Shortly after selecting the appropriate boot drive, you should be presented with the elementary OS splash screen. You may now follow the on-screen instructions which will guide you through the rest of the process.</li>
                    </ul>
                </div>


            </div>

            <!--[if lt IE 10]><script type="text/javascript" src="https://cdn.jsdelivr.net/g/classlist"></script><![endif]-->
            <script type="text/javascript" src="scripts/installation.js"></script>
<?php
    include $template['footer'];
?>
