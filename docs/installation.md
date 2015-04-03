# Installation {#installation}

<div class="clear row" markdown="1">
<div class="column half" markdown="1">

### Download elementary OS {#download-elementary-os}

If you haven't already, you will need to <a href="/" target="_blank">download elementary OS from our home page</a>. You will need to copy the downloaded ISO file to a USB flash drive using the instructions below.

elementary OS is currently built for two processor architectures, 32-bit and 64-bit.

* If you know you have a newer computer with a 64-bit processor, choose the 64-bit version.
* If your computer is older or you do not know which type of processor your computer has, choose the 32-bit version. (64-bit processors will still be able to run this version).

</div>
<div class="column half" markdown="1">

### Recommended System Specifications {#recommended-system-specifications}

* 1 GHz 32-bit or 64-bit processor
* 1 GB of system memory (RAM)
* 15 GB of disk space
* Internet access

<div class="row alert warning" markdown="1">
<div class="column alert">
<div class="icon">
<i class="warning fa fa-warning"></i>
</div>
<div class="icon-text" markdown="1">

### Back Up Your Data {#back-up-your-data}

Make sure to back your important data up to an external location such as a cloud service or an external hard drive. Installing a new operating system may overwrite your existing data.

</div>
</div>
</div>
</div>
</div>

<div class="clear row" markdown="1">

### Creating an Install Drive {#creating-an-installation-medium}

<div class="text-center">
<div id="creating-a-usb-choices" class="column linked">
<a class="button creating-a-usb-on-windows" href="#creating-a-usb-on-windows">Windows</a>
<a class="button creating-a-usb-on-others" href="#creating-a-usb-on-others">OS X &amp; Ubuntu</a>
</div>
</div>

<div id="creating-a-usb-on-windows" class="slide" markdown="1">

### Windows

![Rufus - select ISO](images/docs/installation/rufus_select_iso.png){.float-left}

Begin with a spare USB flash drive with at least 1 GB of free space.

You'll also need a small application called Rufus. You'll have to download it from <a href="https://rufus.akeo.ie/" target="_blank">its website</a> and open the downloaded file to launch it. It will open a window like the one below:

You can now insert your USB drive and select it in the "Device" list. After that, you'll have to select "ISO Image" in "Create a bootable disk using..." and click
![the disk icon](images/docs/installation/rufus_disk_icon.png) to choose the ISO that you downloaded previously.

Click "Start", then just wait for the process to finish.

</div>

<div id="creating-a-usb-on-others" class="slide" markdown="1">

### OS X, Ubuntu, and others}

![UNetbootin](images/docs/installation/unetbootin.png){.float-left}

Begin with a spare USB flash drive with at least 1 GB of free space.

You'll also need a small application called UNetbootin. To install it in Ubuntu, just <a href="http://appnr.com/install/unetbootin">click this link</a>. In OS X you'll have to download it from <a href="http://unetbootin.sourceforge.net/" target="_blank">its website</a> and open the downloaded file to install it.

Open UNetbootin from the Dash in Ubuntu or Launchpad in OS X. It will open a window like the one below:

Make sure "Diskimage" is selected, and click "&#8230;" to select the ISO that you downloaded previously. Unplug all USB memory devices apart from the one you want to use. Click "OK" and wait for the process to finish.

</div>

</div>

<div class="clear row" markdown="1">

### Booting from the Install Drive {#booting-from-the-installation-medium}

In order to start the installation process, you must boot your computer from the install drive. This process may differ depending on the type of computer you have. This guide covers the most common use cases.

<div class="text-center">
<div id="booting-choices" class="column linked">
<a class="button booting-on-a-pc" href="#booting-on-a-pc">Booting on a PC</a>
<a class="button booting-on-a-mac" href="#booting-on-a-mac">Booting on a Mac</a>
</div>
</div>

<div id="booting-on-a-pc" class="slide" markdown="1">

## Booting on a PC

* Assuming that your computer is still on, start by inserting your install drive and restarting your computer.
* Most computers will briefly allow you to change the boot order for this boot only by pressing a special key — usually <kbd>F12</kbd>, but sometimes <kbd>Esc</kbd> or another function key. Refer to the screen or your computer's documentation to be sure.
* Press <kbd>F12</kbd> (or the appropriate key) and select the install drive&mdash;usually "USB-HDD" or something containing the word "USB", but the wording may vary. If you choose the incorrect drive, your computer will likely continue to boot as normal. Just restart your computer and pick a different drive in that menu.
* Shortly after selecting the appropriate boot drive, you should be presented with the elementary OS splash screen. You may now follow the on-screen instructions which will guide you through the rest of the process.

</div>
<div id="booting-on-a-mac" class="slide" markdown="1">

## Booting on a Mac

* Assuming that your computer is still on, start by inserting your install drive and restarting your computer.
* After you hear the chime, press and hold <kbd>Option</kbd>. Then, select the appropriate boot drive. Note that it may be incorrectly identified as "Windows", but this is normal.
* Shortly after selecting the appropriate boot drive, you should be presented with the elementary OS splash screen. You may now follow the on-screen instructions which will guide you through the rest of the process.

</div>

</div>

<!--[if lt IE 10]><script type="text/javascript" src="https://cdn.jsdelivr.net/g/classlist"></script><![endif]-->
<script type="text/javascript" src="scripts/docs/installation.js"></script>