<?php
    include '_templates/sitewide.php';
    $page['title'] = 'Installing elementary OS';
    include $template['header'];
?>
            <div class="row">
                <h1>Installation</h1>

                <div class="clear row">
                    <div class="column half">
                        <h3>Download elementary OS</h3>
                        <p>If you haven't already, you will need to <a href="/" target="_blank">download elementary OS from our home page</a>. You will need to copy the downloaded ISO file to a USB flash drive using the instructions below.</p>
                        <p>elementary OS is currently built for two processor architectures, 32-bit and 64-bit.</p>
                        <ul>
                            <li>If you know you have a newer computer with a 64-bit processor, choose the 64-bit version.</li>
                            <li>If your computer is older or you do not know which type of processor your computer has, choose the 32-bit version. (64-bit processors will still be able to run this version).</li>
                        </ul>
                    </div>
                    <div class="column half">
                        <h3>Recommended System Specifications</h3>
                        <ul>
                            <li>1 GHz 32-bit or 64-bit processor</li>
                            <li>1 GB of system memory (RAM)</li>
                            <li>15 GB of disk space</li>
                            <li>Internet access</li>
                        </ul>
                        <div class="row alert warning">
                            <div class="column alert">
                                <div class="icon">
                                    <i class="warning fa fa-warning"></i>
                                </div>
                                <div class="icon-text">
                                    <h3>Back Up Your Data</h3>
                                    <p>Make sure to back your important data up to an external location such as a cloud service or an external hard drive. Installing a new operating system may overwrite your existing data.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="clear row">
                    <h3 id="creating-an-installation-medium">Creating an Install Drive</h3>
                    <div class="text-center">
                        <div id="creating-a-usb-choices" class="column linked">
                            <a class="button creating-a-usb-on-windows" href="#creating-a-usb-on-windows">Windows</a>
                            <a class="button creating-a-usb-on-osx" href="#creating-a-usb-on-osx">OS X</a>
                            <a class="button creating-a-usb-on-ubuntu" href="#creating-a-usb-on-ubuntu">Ubuntu</a>
                        </div>
                    </div>
                    <div id="creating-a-usb-on-windows" class="slide">
                        <h3>Windows</h3>
                        <img src="images/installation/rufus_select_iso.png" alt="Rufus - select ISO" class="float-left">
                        <p>Begin with a spare USB flash drive with at least 1 GB of free space.</p>
                        <p>You'll also need a small application called Rufus. You'll have to download it from <a href="https://rufus.akeo.ie/" target="_blank">its website</a> and open the downloaded file to launch it. It will open a window like the one below:</p>
                        <p>You can now insert your USB drive and select it in the "Device" list. After that, you'll have to select "ISO Image" in "Create a bootable disk using..." and click <img src="images/installation/rufus_disk_icon.png" alt="the disk icon"> to choose the ISO that you downloaded previously.</p>
                        <p>Click "Start", then just wait for the process to finish.</p>
                    </div>
                    <div id="creating-a-usb-on-osx" class="slide">
                        <h3>OS X</h3>
                        <p>Before creating an install disk, make sure you have all firmware updates installed. To check for available firmware updates, open the Apple Menu and select "Software Update..." or "App Store..." Install any updates labeled with "firmware" or "Bootcamp". Next, find out what Mac Model you have:</p>
                        <img src="images/installation/osx_about_yosemite.png" alt="About Mac" class="float-left">
                        <p>For Macs running OS X Yosemite or later, click on the Apple Menu and select "About This Mac". Take note of the year the Mac was build.</p>
                        <img src="images/installation/osx_about_mac.png" alt="About Mac" class="float-left">
                        <p>For Macs running OS X Mavericks or earlier, click the Apple Menu and select "About This Mac", followed by "More Info..." Take note of the "Model Identifier".</p>
                        <h3>Compatibility</h3>
                        <p>The following Macs are completely unsupported by elementary OS:</p>
                        <ul>
                            <li>PowerPC based Macs</li>
                            <li>Xserve Macs</li>
                        </ul>
                        <p>For the following Mac models, you may choose to create an install USB drive:</p>
                        <ul>
                            <li>MacBook7,1 (Mid 2010) or newer</li>
                            <li>MacBook Pro7,1 (Mid 2010) or newer</li>
                            <li>MacBookr Air3,2 (Mid 2010) or newer</li>
                            <li>Mac Mini 5,1 (Mid 2011) or newer</li>
                            <li>iMac13,1 (Late 2012) or newer</li>
                            <li>Mac Pro5,1 (Mid 2010) or newer</li>
                        </ul>
                        <p>Proceed to the instructions on how to create an Install USB drive. If your Mac is older than the ones shown above, proceed to the instructions on creating an install DVD.</p>
                        <h3>Creating an Install USB Drive</h3>
                        <p>Begin with a spare USB flash drive with at least 1GB of free space</p>
                        <p>You'll need a small application called "elementary thumbnail creator". Download it from <a href="">its website</a>, uncompress it, and open the app to launch it. Insert your spare USB flash drive now if you haven't yet done so. Follow the instructions given by the app. You'll see a window looking like this:</p>
                        <img src="images/installation/osx_thumbnail_creator.png" alt="OS X Thumbnail Creator" class="float-left">
                        <p>To see the progress the app is making, click on the cog in the Apple Menu.</p>
                        <img src="images/installation/osx_thumbnail_creator_progress.png" alt="elementary Thumbnail Creator Progress" class="float-left">
                        <p>If your Mac fails to start with the following error "No Bootable Device -- Insert Boot Disk And Press Any Key", or doesn't give any option to start the USB drive in the Boot Manager, you may want to create an elementary OS Install DVD instead.</p>
                        <h3>Creating an Install DVD</h3>
                        <p>Insert a blank DVD-R or DVD-RW into your DVD drive. If your Mac does not have a DVD drive, you can use an external one, including the Apple USB SuperDrive. Please note that elementary OS is too large to fit inside a CD.<p>
                        <p>Upon inserting the blank DVD, a box might appear asking what to do; click "Ignore".
                        <img src="images/installation/osx_dialog.png" alt="OS X Dialog" class="float-left">
                        <p>Right click (or control click) on the ISO file you've just downloaded in Finder and select 'Burn "elementaryos-unstable-amd64.XX.iso" to Disc'. The date on the file might be different than shown.</p>
                        <img src="images/installation/osx_menu.png" alt="OS X Menu" class="float-left"> 
                    </div>
                    <div id="creating-a-usb-on-ubuntu" class="slide">
                        <h3>Ubuntu, and others</h3>
                        <img src="images/installation/unetbootin.png" alt="UNetbootin" class="float-left">
                        <p>Begin with a spare USB flash drive with at least 1 GB of free space.</p>
                        <p>You'll also need a small application called UNetbootin. To install it in Ubuntu, just <a href="http://appnr.com/install/unetbootin">click this link</a>.
                        <p>Open UNetbootin from the Dash in Ubuntu. It will open a window like the one below:</p>
                        <p>Make sure "Diskimage" is selected, and click "&#8230;" to select the ISO that you downloaded previously. Unplug all USB memory devices apart from the one you want to use. Click "OK" and wait for the process to finish.</p>
                    </div>
                </div>

                <div class="clear row">
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

            </div>
            <!--[if lt IE 10]><script type="text/javascript" src="https://cdn.jsdelivr.net/g/classlist"></script><![endif]-->
            <script type="text/javascript" src="scripts/installation.js"></script>
<?php
    include $template['footer'];
?>
