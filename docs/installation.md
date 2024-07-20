# Installation {#installation}

## Download elementary OS {#download-elementary-os}

If you haven't already, you will need to <a href="/" target="_blank" rel="noopener">download elementary OS from our home page</a>. You will need to copy the downloaded ISO file to a USB flash drive using the instructions below.

## Frequently-Asked Questions

See the [frequently-asked questions for this release]({#release_faq}).

## Recommended System Specifications {#recommended-system-specifications}

While we don't have a strict set of minimum system requirements, we recommend at least the following specifications for the best experience:

* Recent Intel Core i3 or comparable dual-core 64-bit processor
* 4 GB of system memory (RAM)
* Solid state drive (SSD) with at least 32 GB of free space
* Internet access
* Built-in or wired mouse/touchpad and keyboard
* 1024×768 minimum resolution display

You will also need a spare USB flash drive with at least 4 GB of storage for installation.

**We do not recommend virtual machines as they don't perform as well as a full install.** If you are attempting to install in a virtual machine, enable EFI if possible but understand you may encounter other issues.

<div class="row alert warning" markdown="1">
<div class="column alert">
<div class="icon">
<i class="warning fas fa-4x fa-exclamation-triangle"></i>
</div>
<div class="icon-text" markdown="1">

##### Back Up Your Data {#back-up-your-data}

Make sure to back your important data up to an external location such as a cloud service or an external hard drive. Installing a new operating system may overwrite your existing data.

</div>
</div>
</div>

## Step-by-step Guide {#choose-operating-system}

<div class="embed">
<iframe src="https://www.youtube-nocookie.com/embed/3KoCDt4fxcM?modestbranding=1&rel=0" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
</div>

Follow the video above, or select the operating system you are currently using to view tailored installation instructions below.

<div class="operating-system-choices-container text-center">
<div id="operating-system-choices" class="column linked">
<a class="button install-on-windows" href="#install-on-windows"><i class="fab fa-windows"></i> Windows</a>
<a class="button install-on-macos" href="#install-on-macos"><i class="fab fa-apple"></i> macOS</a>
<a class="button install-on-ubuntu" href="#install-on-ubuntu"><i class="fab fa-linux"></i> Linux</a>
</div>
</div>

<div class="slide-container" id="installation-instructions-slide-container" markdown="1">

<div id="install-on-windows" class="slide" markdown="1">

### Verify Your Download {#verify-your-download}

Verifying your download is an important step: we generate a "checksum" for elementary OS images and recommend that you verify that your download matches that checksum before trying to install. This ensures that you've received the full, complete download and that it is not corrupted.

Assuming you downloaded elementary OS to your Windows Downloads folder, open the Command Prompt in Windows and run the following command:

```bash nohighlight
CertUtil -hashfile Downloads\{#release_filename} sha256
```

It should produce the output:

```bash nohighlight
SHA256 hash of Downloads\{#release_filename}:
{#release_sha256}
```

If the checksum does not match, you may need to re-download your copy of elementary OS and ensure it completes downloading before re-verifying it.

### Creating an Install Drive {#creating-an-installation-medium .clear-float}

To create an elementary OS install drive you'll need a USB flash drive that is at least 4 GB in capacity and an app called "Etcher".

<a href="https://balena.io/etcher" class="button suggested-action">Download Etcher</a>

![etcher steps](images/docs/installation/etcher.gif)

Open Etcher, then:

1. Plug in your spare USB flash drive
2. Select your downloaded .iso file using the "Select image" button
3. Etcher should automatically detect your USB drive; if not, select the correct drive
4. Click the "Flash!" button. It may take a moment to get started.

Once complete, continue to boot from the install drive.

### Booting From the Install Drive {#booting-from-the-installation-medium .clear-float}

In order to start the installation process, you must boot your computer from the install drive.

* Assuming that your computer is still on, start by inserting your install drive and restarting your computer.
* Most computers will briefly allow you to change the boot order for this boot only by pressing a special key — usually <kbd>F12</kbd>, but sometimes <kbd>Esc</kbd> or another function key. Refer to the screen or your computer's documentation to be sure.
* Press <kbd>F12</kbd> (or the appropriate key) and select the install drive&mdash;usually "USB-HDD" or something containing the word "USB", but the wording may vary. If you choose the incorrect drive, your computer will likely continue to boot as normal. Just restart your computer and pick a different drive in that menu.
* Shortly after selecting the appropriate boot drive, you should be presented with the elementary OS splash screen. You may now follow the on-screen instructions which will guide you through the rest of the process.

</div>

<div id="install-on-macos" class="slide" markdown="1">

### Verify Your Download {#verify-your-download}

Verifying your download is an important step: we generate a "checksum" for elementary OS images and recommend that you verify that your download matches that checksum before trying to install. This ensures that you've received the full, complete download and that it is not corrupted.

Assuming you downloaded elementary OS to your macOS Downloads folder, open the Terminal app in macOS and run the following command:

```bash nohighlight
shasum -a 256 ~/Downloads/{#release_filename}
```

It should produce the output:

```bash nohighlight
{#release_sha256}
```

If the checksum does not match, you may need to re-download your copy of elementary OS and ensure it completes downloading before re-verifying it.

### Creating an Install Drive {#creating-an-installation-medium .clear-float}

To create an elementary OS install drive you'll need a USB flash drive that is at least 4 GB in capacity and an app called "Etcher".

<a href="https://balena.io/etcher" class="button suggested-action">Download Etcher</a>

![etcher steps](images/docs/installation/etcher.gif)

Open Etcher, then:

1. Plug in your spare USB flash drive
2. Select your downloaded .iso file using the "Select image" button
3. Etcher should automatically detect your USB drive; if not, select the correct drive
4. Click the "Flash!" button. It may take a moment to get started.

Once complete, continue to boot from the install drive.

The following dialog may appear during the flashing process, it is safe to ignore.

![Not readable warning](images/docs/installation/osx_warning.png)

### Booting From the Install Drive {#booting-from-the-installation-medium .clear-float}

In order to start the installation process, you must boot your computer from the install drive.

* Assuming that your computer is still on, start by inserting your install drive and restarting your computer.
* After you hear the chime, press and hold <kbd>Option</kbd>. Then, select the appropriate boot drive. Note that it may be incorrectly identified as "Windows", but this is normal.
* Shortly after selecting the appropriate boot drive, you should be presented with the elementary OS splash screen. You may now follow the on-screen instructions which will guide you through the rest of the process.

#### Boot Errors

If your Mac doesn't recognize your elementary OS USB Install Drive in the boot menu, you may need to create an elementary OS Install DVD instead. To create one, insert a blank DVD, right click on the ISO file in Finder, and select "Burn {#release_filename} to Disc". When complete, attempt to boot again from the Install DVD.

</div>

<div id="install-on-ubuntu" class="slide" markdown="1">

### Verify Your Download {#verify-your-download}

Verifying your download is an important step: we generate a "checksum" for elementary OS images and recommend that you verify that your download matches that checksum before trying to install. This ensures that you've received the full, complete download and that it is not corrupted.

Running the following command in your terminal:

```bash nohighlight
sha256sum {#release_filename}
```

It should produce the output:

```bash nohighlight
{#release_sha256}
```

### Creating an Install Drive {#creating-an-installation-medium .clear-float}

To create an elementary OS install drive you'll need a USB flash drive that is at least 4 GB in capacity and an app called "Etcher".

<a href="https://balena.io/etcher" class="button suggested-action">Download Etcher</a>

![etcher steps](images/docs/installation/etcher.gif)

Open Etcher, then:

1. Plug in your spare USB flash drive
2. Select your downloaded .iso file using the "Select image" button
3. Etcher should automatically detect your USB drive; if not, select the correct drive
4. Click the "Flash!" button. It may take a moment to get started.

Once complete, continue to boot from the install drive.

### Booting From the Install Drive {#booting-from-the-installation-medium .clear-float}

In order to start the installation process, you must boot your computer from the install drive.

* Assuming that your computer is still on, start by inserting your install drive and restarting your computer.
* Most computers will briefly allow you to change the boot order for this boot only by pressing a special key — usually <kbd>F12</kbd>, but sometimes <kbd>Esc</kbd> or another function key. Refer to the screen or your computer's documentation to be sure.
* Press <kbd>F12</kbd> (or the appropriate key) and select the install drive&mdash;usually "USB-HDD" or something containing the word "USB", but the wording may vary. If you choose the incorrect drive, your computer will likely continue to boot as normal. Just restart your computer and pick a different drive in that menu.
* Shortly after selecting the appropriate boot drive, you should be presented with the elementary OS splash screen. You may now follow the on-screen instructions which will guide you through the rest of the process.

</div>

</div>

## After Installation {#after-installation .clear-float}

Take this time to read the <a href="/docs/learning-the-basics">getting started</a> guide to learn about your new operating system.

<!--[if lt IE 10]><script type="text/javascript" src="https://cdn.jsdelivr.net/gh/eligrey/classList.js@1.1.20170427/classList.min.js"></script><![endif]-->
<script type="text/javascript" src="scripts/docs/installation.js" async></script>
