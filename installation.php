<?php
    include '_templates/sitewide.php';
    $page['title'] = 'Installation';
    include '_templates/header.php';
?>
            <div class="row">
                <h1>Installation</h1>
                <p>elementary is designed to run on any relatively new 32-bit and 64-bit desktop or laptop. In this section, we'll cover system requirements and other pre-requisites to installing elementary on your computer.</p>

                <h2>System Requirements</h2>

                <div class="column half">
                    <p>Minimum System Requirements:</p>
                    <ul>
                        <li>1 GHz x86 or AMD64 processor</li>
                        <li>512MB of system memory (RAM)</li>
                        <li>5GB of disk space</li>
                    </ul>
                </div>
                <div class="column half">
                    <p>Recommended System Requirements:</p>
                    <ul>
                        <li>1 GHz x86 or AMD64 processor</li>
                        <li>1GB of system memory (RAM)</li>
                        <li>15 GB of disk space</li>
                        <li>Internet access</li>
                    </ul>
                </div>

                <h2>Downloading elementary</h2>
                <p>If you haven't already, you will need to <a href="index.php" target="_blank">download the elementary OS disk image from our home page</a>. This file is an ISO image — a snapshot of the contents of a bootable disk — which you will need to burn to a CD, DVD, or USB stick.</p>

                <h2>32-bit versus 64-bit</h2>
                <p>Elementary is currently built for two processor architectures, 32-bit and 64-bit. If this sounds a bit technical for you, never fear:</p>
                <ul>
                    <li>If you know you have a newer computer with a 64-bit processor, choose the 64bit version.</li>
                    <li>If your computer is older or you do not know which type of processor your computer has, choose the 32-bit version. (64-bit processors will still be able to run this version).</li>
                </ul>

                <h2>Back Up Your Data</h2>
                <p>While you're waiting for your download to complete, make sure to back up all of your data to an external location such as a cloud service like DropBox or an external hard drive. Installing a new operating system may overwrite your existing data; backing up ensures you won't lose anything precious.</p>

                <h1 id="creating-an-install-disk">Creating an Install Disk</h1>
                <p>To install elementary OS, you'll need some kind of installation media. Either a blank CD or USB stick will work. Each option has its benefits and its drawbacks:</p>

                <ul>
                    <li>CDs are cheaply available and (unless your computer doesn't have a CD drive) your computer should support booting from a CD. If you're unsure which to use, a CD is a safe bet.</li>
                    <li>USB sticks are a lot faster and are reusable. However, if you have an older computer (2003 or older), your computer may not support booting from a USB. If your computer doesn't have a CD drive, chances are it supports booting from USB.</li>
                </ul>
            </div>

            <div class="text-center">
                <div id="installing-choices" class="column linked center-block">
                    <a class="button burning-a-cd" href="#burning-a-cd">Burn a CD</a>
                    <a class="button creating-a-usb" href="#creating-a-usb">Create a USB</a>
                </div>
            </div>
            
            <div id="burning-a-cd" class="slide">
                <div class="row">
                    <h2>Burning a CD</h2>
                </div>

                <div class="text-center">
                    <div id="burning-choices" class="column linked">
                        <a class="button burning-on-linux" href="#burning-on-linux">Ubuntu</a>
                        <a class="button burning-on-windows" href="#burning-on-windows">Windows</a>
                        <a class="button burning-on-macos" href="#burning-on-macos">Mac OS X</a>
                    </div>
                </div>

                <div class="row">
                    <div id="burning-on-linux" class="slide">
                        <h3>Ubuntu</h3>

                        <p>Open Brasero and select: "Burn Image".</p>

                        <img src="images/installation/brasero_home.png" alt="Brasero main window">

                        <p>In the following window, choose the ISO you just downloaded, and make sure the right disk drive with a blank CD in it is selected.</p>

                        <img src="images/installation/brasero_image.png" alt="Burn window">

                        <p>Then you simply click: "Create Image", and Brasero does the rest.</p>

                        <img src="images/installation/brasero_burning.png" alt="Burning">
                    </div>

                    <div id="burning-on-windows" class="slide">
                        <h3>Windows 7</h3>

                        <p>Insert a blank CD-R or CD-RW into your CD drive. Then right click on the elementary disk image and select "Burn disc image".</p>

                        <img src="images/installation/windows_image.jpg" alt="Burning on Windows">

                        <p>Click "Burn". This make take a few minutes.</p>
                    </div>

                    <div id="burning-on-macos" class="slide">
                        <h3>Mac OS X</h3>

                        <p>Insert a blank CD-R or CD-RW into your CD drive. A box will appear asking what to do; click "Ignore".</p>

                        <img src="images/installation/macos_dialog.png" alt="CD dialog on Mac OS X">

                        <p>Right click (or control click) on elementaryOS.iso and select "Burn elementaryOS.iso to Disc...".</p>

                        <img src="images/installation/macos_menu.png" alt="CD dialog on Mac OS X">

                        <p>Click "Burn". This make take a few minutes.</p>
                    </div>
                </div>
            </div>

            <div id="creating-a-usb" class="slide">
                <div class="row">
                    <h2>Creating a USB</h2>
                    <p>Begin with a spare USB Stick or SD Card with at least 1GB or more of free space, and a means for your computer to read them.</p>

                    <p>You'll also need a small application called UNetbootin. To install it in Ubuntu, just <a href="http://appnr.com/install/unetbootin">click this link</a>. In other Linux distros, as well as any Windows or Mac computer, you'll have to download it from <a href="http://unetbootin.sourceforge.net/" target="_blank">its website</a> and open the downloaded file to install it.</p>

                    <p>After that, open unetbootin from your application menu, or just type "unetbootin" in a terminal. It will open a window like the one below:</p>

                    <img src="images/installation/unetbootin.png" alt="UNetbootin">

                    <p>Make sure "Diskimage" is selected, and click the "..." to select the ISO that you downloaded previously. Then unplug all USB memory devices apart from the one you want to use, and click "OK". Then just wait for the process to finish.</p>

                    <p>If UNetbootin fails to work, Windows users can try a small app called Universal USB Installer <a href="http://www.pendrivelinux.com/universal-usb-installer-easy-as-1-2-3/" target="_blank">available here</a>. To use it, follow the wizard, and at the OS selection page, select unlisted distro, new syslinux. Install the elementary OS ISO found on the download page to your flash drive.</p>
                </div>
            </div>

            <div class="row">
                <h1 id="booting-the-install-disk">Booting the Install Disk</h1>
                <p>In order to start the installation process, you must boot your computer from the installation disk. This process can be different depending on the type of hardware you are planning to install elementary OS on. This guide should cover the most common use cases.</p>
            </div>

            <div class="text-center">
                <div id="booting-choices" class="column linked">
                    <a class="button booting-on-a-pc" href="#booting-on-a-pc">Boot on a PC</a>
                    <a class="button booting-on-a-mac" href="#booting-on-a-mac">Boot on a Mac</a>
                </div>
            </div>

            <div id="booting-on-a-pc" class="slide">
                <div class="row">
                    <h2>Booting on a PC</h2>

                    <ul>
                        <li>Assuming that your computer is still on, start by inserting your installation disk and restarting your computer.</li>
                        <li>Most computers will briefly allow you to change the boot order for this boot only by pressing a special key — usually <kbd>F12</kbd>, but sometimes <kbd>Esc</kbd> or another function key. Refer to the screen or your computer's documentation to be sure.</li>
                        <li>Press <kbd>F12</kbd> (or the appropriate key) and select the appropriate boot disk. "USB-HDD" for a USB install disk, or "CDROM" for a CD/DVD install disk. The wording may vary depending on your hardware. If you choose the incorrect device, your computer will likely continue to boot as normal. Just restart your computer and pick a different device in that menu.</li>
                        <li>Shortly after selecting the appropriate boot device, you should be presented with the elementary splash screen. You may now continue to the Installation Wizard which will guide you through the rest of the process.</li>
                    </ul>
                </div>
            </div>

            <div id="booting-on-a-mac" class="slide">
                <div class="row">
                    <h2>Booting on a Mac</h2>

                    <p>Booting elementary OS on Apple hardware is possible; however, it's not well-documented at the moment. We're working hard to document this process for you. Until then, refer to <a href="http://tech-devnet.blogspot.de/2012/05/running-ubuntu-1204-on-mac.html">one of</a> the <a href="http://lifehacker.com/5934942/how-to-dual-boot-linux-on-your-mac-and-take-back-your-powerhouse-apple-hardware">many third-party guides</a> for installing Ubuntu 12.04 on a Mac; since elementary shares its core with Ubuntu, that should at least get you started.</p>
                </div>
            </div>

            <script type="text/javascript" src="scripts/installation.js"></script>
<?php
    include '_templates/footer.html';
?>
