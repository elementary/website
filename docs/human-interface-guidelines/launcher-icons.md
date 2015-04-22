# Launcher Icons {#launcher-icons}

A launcher icon is a graphic that represents your app. Launcher icons appear in the app launcher and on the user's dock. Launcher icons may show up in other places in the OS, such as in a notification or when being referenced by another app.

You should create separate icons for all possible display sizes, including 32, 48, 64, and 128 pixels. This ensures that your icons will display properly throughout the OS without being blurry or oddly weighted.

## Goals of the Launcher Icon {#goals-of-the-launcher-icon}

App launcher icons have three primary goals:

1. Promote the brand and tell the story of the app.
2. Help users discover the app in the software center.
3. Function well in the OS.

### Promote the brand story {#promote-the-brand-story}

App launcher icons are an opportunity to showcase the brand and hint at the story of what your app is about. Thus, you should:

* Create an icon that is unique and memorable.
* Use a color scheme that suits your brand.
* Don't try to communicate too much with the icon. A simple icon will have more impact and be more memorable.
* Avoid including the application name in the icon.

### Help users discover the app in the software center {#help-users-discover-the-app-in-the-software-center}

App launcher icons are the first look that prospective users will get of your app in the software center. A high quality app icon can influence users to find out more as they scroll through lists of apps.

Quality matters here; a well-designed icon can be a strong signal that your app is of similarly high quality. Consider working with an icon designer to develop the app’s launcher icon.

### Function well in the OS {#function-well-in-the-os}

A successful app launcher icon will look great in all situations: on near-white when in the the app launcher, partially over any background when on the dock, and next to any other icons and app widgets. To do this, icons should:

* Communicate well at smaller sizes.
* Work on a wide variety of backgrounds.
* Reflect the implied lighting model of the OS (top-lit).
* Have a relatively shallow depth.
* Have a unique silhouette for faster recognition; **not all app icons should be square**.
* Not present a cropped view of a larger image.
* Have similar weight to other icons. Icons that are too spindly or that don't use enough of the space may not successfully attract the user’s attention, or may not stand out well on all backgrounds.

## Do's and Don'ts {#dos-and-donts}
Below are some "do and don't" examples to consider when creating icons for your app.

* Icons should not be overly complicated. Remember that launcher icons will be used at often small sizes, so they should be distinguishable at small sizes.
* Icons should not be cropped. Use unique shapes where appropriate; remember that launcher icons should differentiate your app from others. Additionally, **do not use a glossy finish** unless the represented object has a glossy material.
* Icons should not be thin. They should have a similar weight to other icons. Overly thin icons will not stand out well on all backgrounds.
* Icons should make use of the alpha channel, and should not simply be full-frame images. Where appropriate, distinguish your icon with subtle yet appealing visual treatment.
* If your icon has a tilt to it's perspective, it should tilt backward (not forward).

## Size and Format {#size-and-format}

Launcher icons should be 32-bit PNGs or SVGs with an alpha channel for transparency. You must provide 32, 48, 64, and 128 pixel versions of your launcher icon to ensure it looks the best throughout the OS.

You should also include a few pixels of padding in launcher icons to maintain a consistent visual weight with adjacent icons. This padding can also be used to make room for a subtle drop shadow, which can help ensure that launcher icons are legible across on any background color.

-----------------------------

_Portions of this page are derived from work created and [shared by the Android Open Source Project](https://code.google.com/policies.html) and used according to terms described in the [Creative Commons 2.5 Attribution License](http://creativecommons.org/licenses/by/2.5/)._

#### Next Page: [Sizes](/docs/human-interface-guidelines/sizes) {.text-right}