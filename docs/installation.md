# Installation {#installation}

## Download elementary OS {#download-elementary-os}

If you haven't already, you will need to <a href="/" target="_blank">download elementary OS from our home page</a>. You will need to copy the downloaded ISO file to a USB flash drive using the instructions below.

elementary OS is currently built for two processor architectures, 32-bit and 64-bit.

* If you know you have a newer computer with a 64-bit processor, choose the 64-bit version.
* If your computer is older or you do not know which type of processor your computer has, choose the 32-bit version. (64-bit processors will still be able to run this version).

## Recommended System Specifications {#recommended-system-specifications}

* Intel i3 or comparable dual-core 64-bit processor
* 1 GB of system memory (RAM)
* 15 GB of disk space
* Internet access

<div class="row alert warning" markdown="1">
<div class="column alert">
<div class="icon">
<i class="warning fa fa-warning"></i>
</div>
<div class="icon-text" markdown="1">

##### Back Up Your Data {#back-up-your-data}

Make sure to back your important data up to an external location such as a cloud service or an external hard drive. Installing a new operating system may overwrite your existing data.

</div>
</div>
</div>

## Choose your current Operating System {#choose-operating-system}

Select the operating system you are currently using to view tailored installation instructions.

<div class="operating-system-choices-container text-center">
<div id="operating-system-choices" class="column linked">
<a class="button install-on-windows" href="#install-on-windows">Windows</a>
<a class="button install-on-os-x" href="#install-on-os-x">OS X</a>
<a class="button install-on-ubuntu" href="#install-on-ubuntu">Ubuntu</a>
</div>
</div>

***

<div class="slide-container" id="installation-instructions-slide-container" markdown="1">

<div id="install-on-windows" class="slide" markdown="1">

## Verify your Download {#verify-your-download}

Verifying your download is an important, but optional step. We generate a checksum (or hash sum) for elementary OS images and we recommend that you verify that your download matches that checksum before trying to install. This ensures that you've received the full, complete download and that your install image is not corrupted in any way.

Windows doesn't include a built-in tool to verify SHA256 Checksums, so you're going to need to download <a href="http://www.digitalvolcano.co.uk/hash.html">Hash Tool</a>.

![Hash Tool](images/docs/installation/hashtool.png)

1. Open Hash Tool
2. Under "Hash Type" select `SHA-256`
3. Under "Input File" select `Select File(s)` and find the elementary OS ISO file
4. Verify that the text in "Results" matches one of the following hashes

#### 32-bit
```bash nohighlight
97e143e762a1d1e3abac9eba33a59a7a6b9f319a7063cd47e406678c379fc683
```

#### 64-bit
```bash nohighlight
ee737ffa6bf33b742c5a7cee17aa26dec5ee3b573cbbc4b53cbe2a2513c9197a
```

## Creating an Install Drive {#creating-an-installation-medium .clear-float}

![Rufus - select ISO](images/docs/installation/rufus_select_iso.png) {.float-left}

<a href="https://rufus.akeo.ie/" class="button suggested-action">Download Rufus</a>

Begin with a spare USB flash drive with at least 1 GB of free space.

You'll also need a small application called Rufus. It will open a window like the one shown here.

You can now insert your USB drive and select it in the "Device" list. After that, you'll have to select "ISO Image" in "Create a bootable disk using..." and click
![the disk icon](images/docs/installation/rufus_disk_icon.png) to choose the ISO that you downloaded previously.

Click "Start", then just wait for the process to finish.

## Booting from the Install Drive {#booting-from-the-installation-medium .clear-float}

In order to start the installation process, you must boot your computer from the install drive.

* Assuming that your computer is still on, start by inserting your install drive and restarting your computer.
* Most computers will briefly allow you to change the boot order for this boot only by pressing a special key — usually <kbd>F12</kbd>, but sometimes <kbd>Esc</kbd> or another function key. Refer to the screen or your computer's documentation to be sure.
* Press <kbd>F12</kbd> (or the appropriate key) and select the install drive&mdash;usually "USB-HDD" or something containing the word "USB", but the wording may vary. If you choose the incorrect drive, your computer will likely continue to boot as normal. Just restart your computer and pick a different drive in that menu.
* Shortly after selecting the appropriate boot drive, you should be presented with the elementary OS splash screen. You may now follow the on-screen instructions which will guide you through the rest of the process.

</div>


<div id="install-on-os-x" class="slide" markdown="1">

## Verify your Download {#verify-your-download}

Verifying your download is an important, but optional step. We generate a checksum (or hash sum) for elementary OS images and we recommend that you verify that your download matches that checksum before trying to install. This ensures that you've received the full, complete download and that your install image is not corrupted in any way.

#### 32-bit

Running the following command in your terminal:

```bash nohighlight
shasum -a 256 elementaryos-0.3.2-stable-i386.20151209.iso
```

should produce the output:

```bash nohighlight
97e143e762a1d1e3abac9eba33a59a7a6b9f319a7063cd47e406678c379fc683
```

#### 64-bit

Running the following command in your terminal:

```bash nohighlight
shasum -a 256 elementaryos-0.3.2-stable-amd64.20151209.iso
```

should produce the output:

```bash nohighlight
ee737ffa6bf33b742c5a7cee17aa26dec5ee3b573cbbc4b53cbe2a2513c9197a
```

## Creating an Install Drive {#creating-an-installation-medium .clear-float}

<a href="https://github.com/linusbobcat/create-elementary-os-installer/releases/" class="button suggested-action">Download "Create elementary Installer"</a>

Begin with a spare USB flash drive with at least 1 GB of free space.

Before creating an install drive, make sure you have all OS X updates installed. To check for available updates, open the Apple Menu and select either "Software Update&#8230;" or "App Store&#8230;" Make sure to install any OS updates in addition to ones labeled with "Firmware" and "Boot Camp".

You'll need a small application called "Create elementary Installer". If your Mac cannot open it because it's from an unidentifiable developer, right (or control) click the app, and click "Open".

Insert your spare USB drive, and in the window below, select the ISO file you've just downloaded.

![Create elementary OS USB Installer](images/docs/installation/osx_select_iso.png)

Next, select your USB drive to start the installer creation process.

![Select USB Drive](images/docs/installation/osx_select_drive.png)

If your Mac doesn't recognize the resulting drive in the boot menu, you may need to create an elementary OS Install DVD instead. To create one, insert a blank DVD, right click on the ISO file in Finder, and select "Burn elementaryos-freya-xx.xx.iso to Disc".

## Booting from the Install Drive {#booting-from-the-installation-medium .clear-float}

In order to start the installation process, you must boot your computer from the install drive.

* Assuming that your computer is still on, start by inserting your install drive and restarting your computer.
* After you hear the chime, press and hold <kbd>Option</kbd>. Then, select the appropriate boot drive. Note that it may be incorrectly identified as "Windows", but this is normal.
* Shortly after selecting the appropriate boot drive, you should be presented with the elementary OS splash screen. You may now follow the on-screen instructions which will guide you through the rest of the process.

</div>


<div id="install-on-ubuntu" class="slide" markdown="1">

## Verify your Download {#verify-your-download}

Verifying your download is an important, but optional step. We generate a checksum (or hash sum) for elementary OS images and we recommend that you verify that your download matches that checksum before trying to install. This ensures that you've received the full, complete download and that your install image is not corrupted in any way.

#### 32-bit

Running the following command in your terminal:

```bash nohighlight
sha256sum elementaryos-0.3.2-stable-i386.20151209.iso
```

should produce the output:

```bash nohighlight
97e143e762a1d1e3abac9eba33a59a7a6b9f319a7063cd47e406678c379fc683
```

#### 64-bit

Running the following command in your terminal:

```bash nohighlight
sha256sum elementaryos-0.3.2-stable-amd64.20151209.iso
```

should produce the output:

```bash nohighlight
ee737ffa6bf33b742c5a7cee17aa26dec5ee3b573cbbc4b53cbe2a2513c9197a
```

## Creating an Install Drive {#creating-an-installation-medium .clear-float}

<a href="http://appnr.com/install/unetbootin" class="button suggested-action">Download UNetbootin</a>

Begin with a spare USB flash drive with at least 1 GB of free space.

You'll also need a small application called UNetbootin.

Open UNetbootin from the Dash. It will open a window like the one below:

![UNetbootin](images/docs/installation/unetbootin.png)

Make sure "Diskimage" is selected, and click "&#8230;" to select the ISO that you downloaded previously. Unplug all USB memory devices apart from the one you want to use. Click "OK" and wait for the process to finish.

## Booting from the Install Drive {#booting-from-the-installation-medium .clear-float}

In order to start the installation process, you must boot your computer from the install drive.

* Assuming that your computer is still on, start by inserting your install drive and restarting your computer.
* Most computers will briefly allow you to change the boot order for this boot only by pressing a special key — usually <kbd>F12</kbd>, but sometimes <kbd>Esc</kbd> or another function key. Refer to the screen or your computer's documentation to be sure.
* Press <kbd>F12</kbd> (or the appropriate key) and select the install drive&mdash;usually "USB-HDD" or something containing the word "USB", but the wording may vary. If you choose the incorrect drive, your computer will likely continue to boot as normal. Just restart your computer and pick a different drive in that menu.
* Shortly after selecting the appropriate boot drive, you should be presented with the elementary OS splash screen. You may now follow the on-screen instructions which will guide you through the rest of the process.

</div>

</div>

## After Installation {#after-installation .clear-float}

Take this time to read the <a href="/docs/learning-the-basics">getting started</a> guide to learn about your new operating system.

<!--[if lt IE 10]><script type="text/javascript" src="https://cdn.jsdelivr.net/g/classlist"></script><![endif]-->
<script type="text/javascript" src="scripts/slider.js"></script>
<script type="text/javascript" src="scripts/docs/installation.js"></script>
