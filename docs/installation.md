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

Verifying your download is an important, but optional step. We generate a checksum (or hash sum) for elementary OS images and we recommend that you verify that your download matches that checksum before trying to install. This ensures that you've received the full, complete download and that your install image is not corrupted in any way.

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

Verifying your download is an important, but optional step. We generate a checksum (or hash sum) for elementary OS images and we recommend that you verify that your download matches that checksum before trying to install. This ensures that you've received the full, complete download and that your install image is not corrupted in any way.

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

Begin with a spare USB flash drive with at least 1 GB of free space.

Before creating an install drive, make sure you have all OS X updates installed. To check for available updates, open the Apple Menu and select either "Software Update&#8230;" or "App Store&#8230;" Make sure to install any OS updates in addition to ones labeled with "Firmware" and "Boot Camp".

You'll need a small application called "Create elementary Installer". Download the latest version from [here](https://github.com/linusbobcat/create-elementary-os-installer/releases/), uncompress it, and open the app to launch it. If your Mac cannot open it because it's from an unidentifiable developer, right (or control) click the app, and click "Open".

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

Begin with a spare USB flash drive with at least 1 GB of free space.

You'll also need a small application called UNetbootin. To install it, just <a href="http://appnr.com/install/unetbootin">click this link</a>.

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

<!--[if lt IE 10]><script type="text/javascript" src="https://cdn.jsdelivr.net/g/classlist"></script><![endif]-->
<script type="text/javascript" src="scripts/slider.js"></script>
<script type="text/javascript" src="scripts/docs/installation.js"></script>

# Learning the Basics {#learning-the-basics .clear-float}

As with every operating system there are some things that you may not be familiar with. This section will deal with how to complete simple, every day tasks such as browsing the web and listening to music, as well as other useful information that you may be unaware of.

## The Desktop {#the-desktop}
The elementary OS desktop is very simple and easy to learn. It consists of two elements: the panel and the dock. You can customize the desktop's wallpaper through **[System Settings](/docs/learning-the-basics#system-settings)** → **Desktop** → **Wallpaper**.

### The Panel {#the-panel}
At the top of the screen you can see the Panel. On the left is the Applications menu, in the center are the time and date, and on the right are the Indicators.

![The Panel](images/docs/learning-the-basics/panel.png)

#### Applications {#applications}
On the left side of the panel is the Applications item. Clicking **Applications** brings up a launcher with all of your installed apps. You can view multiple pages of apps using the pagers at the bottom or by scrolling. You can also use the view switcher at the top to switch between a grid view and a category view. Lastly, you can search the launcher by typing at any time.

#### Indicators {#indicators}
On the right side of the panel are icons called Indicators. These tell you of the current status of your session, i.e. your network connections, battery power, time, chat and email accounts, etc. Clicking an indicator exposes more information and related actions.

### The Dock {#the-dock}
At the bottom of the screen is the Dock. It contains your favorite apps well as any apps that are currently open.

![The Dock](images/docs/learning-the-basics/dock.png)

The contents of the dock are easily customizable. To add an app to the dock, drag and drop it from **Applications** on the panel or right-click an open app's icon and choose **Keep in Dock**. To remove an app from the dock, drag it off and drop it in an empty space on your desktop or right-click the icon and uncheck **Keep in Dock**. To rearrange apps on the dock, simply drag and drop them.

By default, the dock hides off the bottom of the screen when an app is maximized. Simply move your mouse to the bottom center of the screen to reveal the dock.

You can customize the dock's behavior through **[System Settings](/docs/learning-the-basics#system-settings)** → **Desktop** → **Dock**.

## App Windows {#app-windows}

Apps exist in their own windows which can be closed, maximized, or moved around.

When you open an app, its window appears on the desktop. Each app typically has three areas: the window buttons, a toolbar, and the contents of the app.

### Window Buttons {#window-buttons}
An app's window buttons are at the top corners of the app window. The close button is on the left and the maximize button is on the right. Pressing the close button will close the app's window. Pressing the maximize button will toggle whether the app window takes up the full screen or not. You can move an app's window around the desktop by dragging empty space between the window buttons.

![](images/docs/learning-the-basics/windows.png)

### Toolbar {#toolbar}
Many apps have a toolbar at the top of the app. This area contains common actions or navigation items for the app. You can move an app's window around by dragging any blank area of a toolbar.

## Multitasking {#multitasking}

elementary OS supports two types of multitasking: windows and workspaces.

### Windows {#windows}
Apps open in app windows. They can overlap on your desktop and be moved around. You can switch between windows several ways:

* click on the window you want to switch to
* click on the app's icon in the dock
* press <kbd>Alt</kbd> + <kbd>Tab</kbd>
* To see an overview of your open app windows, press <kbd>⌘</kbd> + <kbd>W</kbd>.

You can customize these shortcuts through **[System Settings](/docs/learning-the-basics#system-settings)** → **Keyboard** → **Shortcuts** → **Windows**.

### Hot Corners {#hot-corners}
You can also configure "hot corners" (shortcuts activated by placing your cursor in the corner of the display) to activate multi-tasking functions like the window overview, workspace overview, and more.

You can customize hot corners through **[System Settings](/docs/learning-the-basics#system-settings)** → **Desktop** → **Hot Corners**.

### Workspaces {#workspaces}
By default, all app windows open on one workspace. However, you can use multiple workspaces to organize your workflow:

* To see an overview of your workspaces, press <kbd>⌘</kbd> + <kbd>S</kbd>
* To quickly move left or right through your workspaces, press <kbd>⌘</kbd> + <kbd>←</kbd> or <kbd>⌘</kbd> + <kbd>→</kbd>
* To cycle through your workspaces, press <kbd>⌘</kbd> + <kbd>Tab</kbd>
* You can jump straight to a specific workspace by pressing <kbd>⌘</kbd> + <kbd>1</kbd> through <kbd>⌘</kbd> + <kbd>9</kbd>. You can always jump to a new workspace with <kbd>⌘</kbd> + <kbd>0</kbd>.
* You can also drag app windows between workspaces by dragging their icons in the workspace overview. To see an overview of app windows across all workspaces, press <kbd>⌘</kbd> + <kbd>A</kbd>.

You can customize these shortcuts through **[System Settings](/docs/learning-the-basics#system-settings)** → **Keyboard** → **Shortcuts** → **Workspaces**.

_Note: <kbd>⌘</kbd> refers to the "super" key. It is also known as the "Windows" key on most PCs or the "Command" key on Macs._

## Installing Apps {#installing-apps}

elementary OS comes bundled with **Software Center**, an app store for free and paid apps. Installing a new app from Software Center is easy:

1. Open the **Software Center** app.
2. Search in the top-right, or browse.
3. Click **Install** next to the app you want to install.

You may be asked for your password prior to installing an app.

_Note: Some software may not be available from the Software Center. While we don't recommend downloading software from the general Internet, apps that are compatible with Ubuntu 14.04 LTS should work just as well on elementary OS Freya._

## System Settings {#system-settings}

elementary OS comes with a handy app called "System Settings" that controls all of your system-wide (or "global") preferences. System Settings gives you the ability to adjust things like keyboard shortcuts, display resolution, your wallpaper, and more.

![](images/docs/learning-the-basics/switchboard.png)

### Search {#search}
You can quickly find settings you are looking for by typing keywords in the search bar at the top of the window. The contents of the System Settings window will filter down to match your search.

### App Settings {#app-settings}
Keep in mind that System Settings only deals with the global preferences for elementary OS. Although, some apps may also have their own preferences, you will not find them here. Instead, look for them inside the app in question.
