# App Launchers {#app-launchers}

The primary method of discovering and using your app will be through an app launcher found in Slingshot or in the dock. In order to provide these launchers you must install an appropriate .desktop file with your app. This includes giving your launcher an appropriate name, placing it in the correct category, assigning it an icon, etc.

.desktop files follow the freedesktop.org [Desktop Entry Specification](http://standards.freedesktop.org/desktop-entry-spec/latest/index.html "View the spec on FreeDesktop.Org"). They should be installed in _/usr/share/applications_. Users may create their own launchers by putting .desktop files in _~/.local/share/applications_.

The contents of .desktop files should follow this formula:

_**Title** is a(n) **GenericName** that lets you **Comment**._

## Title {#title}

You should not include descriptive words in your title. For example, Dexter is called "Dexter," not "Dexter Address Book." Midori is just "Midori," not "Midori Web Browser." Instead, utilize the GenericName attribute of your app's .desktop file for a generic name, and the Comment attribute for a longer descriptive phrase.

## GenericName {#genericname}

If your app is easily categorized or described with a generic name, you should use that for the GenericName attribute in your app's .desktop file. If you can say, "My app is a(n) ________," then whatever fits in that blank could be the generic name. For example, Maya is a calendar, so its generic name is "Calendar."

You should not include articles (the, a, an) or the words "program," "app," or "application" in your app's generic name.

The generic name should be in [title case](./capitalization#title-case) and may be used around the system to better describe or categorize your app. 

## Comment {#comment}

The system utilizes an app's Comment attribute found in the .desktop file to succinctly inform a user what can be done with the app. It should be a short sentence or phrase beginning with a verb and containing the primary nouns that your app deals with. For example, the following are appropriate comments:

* Maya: **Browse and schedule events**
* Noise: **Listen to music**
* Lingo: **Look up definitions**
* Geary: **Send and receive mail**
* Scratch: **Edit text files**
* Files: **Browse and manage your files**

An app's comment should be in [sentence case](./capitalization), not include terminal punctuation (periods, exclamation points, or question marks), and should be as short as possible while describing the _primary_ use case of the app.

## Categories {#categories}

The following categories may be used to aid with searching or browsing for your app:

* AudioVideo  
* Audio
* Video
* Development
* Education
* Game
* Graphics
* Network 
* Office
* Science
* Settings
* System
* Utility

For more info, see the FreeDesktop.Org [menu entry](http://standards.freedesktop.org/menu-spec/latest/apa.html) spec.

## Keywords {#keywords}

You may also include keywords in your launcher to help users find your app via search. These follow the convention of "X-GNOME-Keywords" (for in the app launcher) and "X-AppInstall-Keywords" (for in the app installer). For example, web browser might include "Internet" as a keyword even though it's not in the app's name, generic name, or description. As a result, a user searching for "Internet" will find the app. Here are some more examples:

* Geary: **Email;Gmail**
* Midori: **Internet;WWW;Explorer**
* Files: **Folders;Browser;Explorer;Finder;Manager**
* Terminal: **Command;Prompt;cmd;Emulator**
* Scratch: **Notepad;IDE;Plain**
* System Settings: **Control;Panel**
* Shotwell: **Camera;Picture**

Keywords should be single words in [title case](./capitalization#title-case) and seperated with a semicolon.

--------------------------------------

See also: [Desktop Entry Specification](http://standards.freedesktop.org/desktop-entry-spec/latest/index.html) from FreeDesktop.org

#### Next Page: [Contractor](/docs/human-interface-guidelines/contractor) {.text-right}