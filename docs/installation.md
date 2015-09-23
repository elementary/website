# Installation {#installation}

## Download elementary OS {#download-elementary-os}

If you haven't already, you will need to <a href="/" target="_blank">download elementary OS from our home page</a>. You will need to copy the downloaded ISO file to a USB flash drive using the instructions below.

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

Windows doesn't include a built-in tool to verify SHA256 Checksums, so you're going to need to download <a href="http://www.digitalvolcano.co.uk/hash.html">Hash Tool</a>.

![Hash Tool](images/docs/installation/hashtool.png)

1. Open Hash Tool
2. Under "Hash Type" select `SHA-256`
3. Under "Input File" select `Select File(s)` and find the elementary OS ISO file
4. Verify that the text in "Results" matches one of the following hashes

#### 32-bit
```bash
75b6cf0afc8a8d46bdcd646d5f22aac0496c3dd7bf8eafb8897933bfb7048f22
```

#### 64-bit
```bash
ca0f5933231fc2d75ef4e82c177c8150a3def9ddb78db8f24da1c6a0c6037390
```

## Creating an Install Drive {#creating-an-installation-medium .clear-float}

![Rufus - select ISO](images/docs/installation/rufus_select_iso.png){.float-left}

Begin with a spare USB flash drive with at least 1 GB of free space.

You'll also need a small application called Rufus. You'll have to download it from <a href="https://rufus.akeo.ie/" target="_blank">its website</a> and open the downloaded file to launch it. It will open a window like the one below:

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

#### 32-bit

Running the following command in your terminal:

```bash
shasum -a 256 elementaryos-stable-0.3.1-i386.20150903.iso
```

should produce the output:

```bash
75b6cf0afc8a8d46bdcd646d5f22aac0496c3dd7bf8eafb8897933bfb7048f22
```

#### 64-bit

Running the following command in your terminal:

```bash
shasum -a 256 elementaryos-stable-0.3.1-amd64.20150903.iso
```

should produce the output:

```bash
ca0f5933231fc2d75ef4e82c177c8150a3def9ddb78db8f24da1c6a0c6037390
```

## Creating an Install Drive {#creating-an-installation-medium .clear-float}

![UNetbootin](images/docs/installation/unetbootin.png)

Begin with a spare USB flash drive with at least 1 GB of free space.

You'll also need a small application called UNetbootin. To install it in Ubuntu, just <a href="http://appnr.com/install/unetbootin">click this link</a>. In OS X you'll have to download it from <a href="http://unetbootin.sourceforge.net/" target="_blank">its website</a> and open the downloaded file to install it.

Open UNetbootin from the Dash in Ubuntu or Launchpad in OS X. It will open a window like the one below:

Make sure "Diskimage" is selected, and click "&#8230;" to select the ISO that you downloaded previously. Unplug all USB memory devices apart from the one you want to use. Click "OK" and wait for the process to finish.

## Booting from the Install Drive {#booting-from-the-installation-medium .clear-float}

In order to start the installation process, you must boot your computer from the install drive.

* Assuming that your computer is still on, start by inserting your install drive and restarting your computer.
* After you hear the chime, press and hold <kbd>Option</kbd>. Then, select the appropriate boot drive. Note that it may be incorrectly identified as "Windows", but this is normal.
* Shortly after selecting the appropriate boot drive, you should be presented with the elementary OS splash screen. You may now follow the on-screen instructions which will guide you through the rest of the process.

</div>


<div id="install-on-ubuntu" class="slide" markdown="1">

## Verify your Download {#verify-your-download}

#### 32-bit

Running the following command in your terminal:

```bash
sha256sum elementaryos-stable-0.3.1-i386.20150903.iso
```

should produce the output:

```bash
75b6cf0afc8a8d46bdcd646d5f22aac0496c3dd7bf8eafb8897933bfb7048f22
```

#### 64-bit

Running the following command in your terminal:

```bash
sha256sum elementaryos-stable-0.3.1-amd64.20150903.iso
```

should produce the output:

```bash
ca0f5933231fc2d75ef4e82c177c8150a3def9ddb78db8f24da1c6a0c6037390
```

## Creating an Install Drive {#creating-an-installation-medium .clear-float}

![UNetbootin](images/docs/installation/unetbootin.png)

Begin with a spare USB flash drive with at least 1 GB of free space.

You'll also need a small application called UNetbootin. To install it in Ubuntu, just <a href="http://appnr.com/install/unetbootin">click this link</a>. In OS X you'll have to download it from <a href="http://unetbootin.sourceforge.net/" target="_blank">its website</a> and open the downloaded file to install it.

Open UNetbootin from the Dash in Ubuntu or Launchpad in OS X. It will open a window like the one below:

Make sure "Diskimage" is selected, and click "&#8230;" to select the ISO that you downloaded previously. Unplug all USB memory devices apart from the one you want to use. Click "OK" and wait for the process to finish.

## Booting from the Install Drive {#booting-from-the-installation-medium .clear-float}

In order to start the installation process, you must boot your computer from the install drive.

* Assuming that your computer is still on, start by inserting your install drive and restarting your computer.
* Most computers will briefly allow you to change the boot order for this boot only by pressing a special key — usually <kbd>F12</kbd>, but sometimes <kbd>Esc</kbd> or another function key. Refer to the screen or your computer's documentation to be sure.
* Press <kbd>F12</kbd> (or the appropriate key) and select the install drive&mdash;usually "USB-HDD" or something containing the word "USB", but the wording may vary. If you choose the incorrect drive, your computer will likely continue to boot as normal. Just restart your computer and pick a different drive in that menu.
* Shortly after selecting the appropriate boot drive, you should be presented with the elementary OS splash screen. You may now follow the on-screen instructions which will guide you through the rest of the process.

</div>

</div>

<!--[if lt IE 10]><script type="text/javascript" src="https://cdn.jsdelivr.net/g/classlist"></script><![endif]-->
<script type="text/javascript" src="scripts/slider.js"></script>
<script type="text/javascript" src="scripts/docs/installation.js"></script>
