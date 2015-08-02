# Installation {#installation}

## Download elementary OS {#download-elementary-os}

If you haven't already, you will need to <a href="/" target="_blank">download elementary OS from our home page</a>. You will need to copy the downloaded ISO file to an installation drive using the instructions below.

elementary OS is currently built for two processor architectures, 32-bit and 64-bit.

* If you know you have a newer computer with a 64-bit processor, choose the 64-bit version.
* If your computer is older or you do not know which type of processor your computer has, choose the 32-bit version. (64-bit processors will still be able to run this version).

## Recommended System Specifications {#recommended-system-specifications}

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

## Back Up Your Data {#back-up-your-data}

Make sure to back your important data up to an external location such as a cloud service or an external hard drive. Installing a new operating system may overwrite your existing data.

</div>
</div>
</div>

## Creating an Install Drive {#creating-an-installation-medium}

<div class="creating-a-usb-choices-container text-center">
<div id="creating-a-usb-choices" class="column linked">
<a class="button creating-a-usb-on-windows" href="#creating-a-usb-on-windows">Windows</a>
<a class="button creating-a-usb-on-osx" href="#creating-a-usb-on-osx">OS X</a>
<a class="button creating-a-usb-on-linux" href="#creating-a-usb-on-linux">Linux</a>
</div>
</div>

<div class="creating-a-usb-choices-slide-container" markdown="1">

<div id="creating-a-usb-on-windows" class="slide" markdown="1">

### Windows

![Rufus - select ISO](images/docs/installation/rufus_select_iso.png){.float-left}

Begin with a spare USB flash drive with at least 1 GB of free space.

You'll also need a small application called Rufus. You'll have to download it from <a href="https://rufus.akeo.ie/" target="_blank">its website</a> and open the downloaded file to launch it. It will open a window like the one below:

You can now insert your USB drive and select it in the "Device" list. After that, you'll have to select "ISO Image" in "Create a bootable disk using..." and click
![the disk icon](images/docs/installation/rufus_disk_icon.png) to choose the ISO that you downloaded previously.

Click "Start", then just wait for the process to finish.

</div>

<div id="creating-a-usb-on-osx" class="slide" markdown="1">

### OS X

Before creating an install drive, make sure you have all OS X updates installed. To check for available updates, open the Apple Menu and select either "Software Update&#8230;" or "App Store&#8230;" Make sure to install any OS updates in addition to updates labeled with "firmware" and "Boot Camp".

 Next, find out what Mac model you have:

For Macs running OS X Yosemite (10.10) or later, click on the Apple Menu and select "About This Mac". Take note of the year the Mac was build.

![About OS X Yosemite](images/docs/installation/osx_about_yosemite.png)

For Macs running OS X Mavericks (10.9) or earlier, click on the Apple Menu and select "About This Mac" followed by "More Info&#8230;" Take note of the "Model Identifier".

![About OS X](images/docs/installation/osx_about_mac.png)

#### Compatibility

The following Macs are incompatible with elementary OS:

 - PowerPC based Macs
 - Xserve Macs

It's recommended to create an install USB drive for the following Mac models:

 - MacBook7,1 (Mid 2010) or newer
 - MacBook Pro7,1 (Mid 2010) or newer
 - MacBook Air3,2 (Late 2010) or newer
 - Mac Mini5,1 (Mid 2011) or newer
 - iMac 13,1 (Late 2012) or newer
 - Mac Pro5,1 (Mid 2010) or newer

For these Macs, proceed to the instructions on creating an install USB drive. If your Mac is older than the ones shown above, proceed to the instructions on creating an install DVD.

#### Creating an Install USB Drive

Begin with a spare USB flash drive with at least 1 GB of free space.

You'll need a small application called "elementary thumbdrive creator" Download it [here](https://github.com/sdaitzman/elementary-thumbdrive-creator/archive/master.zip), uncompress it, and open the app to launch it. You'll see a window looking like the one below.

![elementary thumbdrive creator](images/docs/installation/osx_thumbnail_creator.png)

Insert your spare USB flash drive if you haven't done so already and proceed to follow the instructions given by the app. To see elementary Thumbdrive Creator's progress, click on the cog on the Apple Menu.

![elementary thumdrive creator progress](images/docs/installation/osx_thumbnail_creator_progress.png)

If your Mac fails to start the USB drive, either by not giving any option to start it in the boot selector, or by showing the "No Bootable Device --- Insert Boot Disk and Press Any Key" text, you may choose to create an elementary OS Install DVD instead.

#### Creating an Install DVD

Insert a blank DVD-R or DVD-RW into your DVD drive. It's not possible to use a CD since elementary OS is too large to fit inside one. If your Mac does not have a build-in DVD drive, you may use an external one, including the Apple USB Super Drive.

Upon inserting the DVD a dialog might appear asking what to do; click "ignore".

![OS X dialog](images/docs/installation/osx_dialog.png)

Right or control click on the ISO file you've just downloaded in Finder and select "Burn elementaryos-freya-XX.XX.iso to Disc&#8230;" The date and architecture, either amd64 or x86, may be different than shown below.

![OS X right click menu](images/docs/installation/osx_menu.png)

</div>

<div id="creating-a-usb-on-linux" class="slide" markdown="1">

### Linux

![UNetbootin](images/docs/installation/unetbootin.png)

Begin with a spare USB flash drive with at least 1 GB of free space.

You'll also need a small application called UNetbootin. To install it in Ubuntu, just <a href="http://appnr.com/install/unetbootin">click this link</a>.

If using Ubuntu, UNetBootin can be found in the dash. It will open a window like the one below:

Make sure "Diskimage" is selected, and click "&#8230;" to select the ISO that you downloaded previously. Unplug all USB memory devices apart from the one you want to use. Click "OK" and wait for the process to finish.

</div>

</div>

## Booting from the Install Drive {#booting-from-the-installation-medium}

In order to start the installation process, you must boot your computer from the install drive. This process may differ depending on the type of computer you have. This guide covers the most common use cases.

<div class="booting-choices-container text-center">
<div id="booting-choices" class="column linked">
<a class="button booting-on-a-pc" href="#booting-on-a-pc">Booting on a PC</a>
<a class="button booting-on-a-mac" href="#booting-on-a-mac">Booting on a Mac</a>
</div>
</div>

<div class="booting-choices-slide-container" markdown="1">

<div id="booting-on-a-pc" class="slide" markdown="1">

### Booting on a PC

* Assuming that your computer is still on, start by inserting your install drive and restarting your computer.
* Most computers will briefly allow you to change the boot order for this boot only by pressing a special key — usually <kbd>F12</kbd>, but sometimes <kbd>Esc</kbd> or another function key. Refer to the screen or your computer's documentation to be sure.
* Press <kbd>F12</kbd> (or the appropriate key) and select the install drive&mdash;usually "USB-HDD" or something containing the word "USB", but the wording may vary. If you choose the incorrect drive, your computer will likely continue to boot as normal. Just restart your computer and pick a different drive in that menu.
* Shortly after selecting the appropriate boot drive, you should be presented with the elementary OS splash screen. You may now follow the on-screen instructions which will guide you through the rest of the process.

</div>

<div id="booting-on-a-mac" class="slide" markdown="1">

### Booting on a Mac

* Assuming that your computer is still on, start by inserting your install drive and restarting your computer.
* After you hear the chime, press and hold <kbd>Option</kbd>. Then, select the appropriate boot drive. Note that it may be incorrectly identified as "Windows", but this is normal.
* Shortly after selecting the appropriate boot drive, you should be presented with the elementary OS splash screen. You may now follow the on-screen instructions which will guide you through the rest of the process.

</div>

</div>

<!--[if lt IE 10]><script type="text/javascript" src="https://cdn.jsdelivr.net/g/classlist"></script><![endif]-->
<script type="text/javascript" src="scripts/slider.js"></script>
<script type="text/javascript" src="scripts/docs/installation.js"></script>
