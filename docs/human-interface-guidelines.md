# Human Interface Guidelines {#human-interface-guidelines}

These guidelines are designed to help developers and designers create a beautifully consistent experience on the elementary desktop. They were written for interface designers, graphic artists and software developers who will be working on elementary OS. They will not only define specific design elements and principles, but will also instill a philosophy that will allow you to decide when it is appropriate to deviate from the Guidelines. Adhering to the suggestions contained here will provide many benefits:

* Users will learn to use your application faster because it shares common elements that they are already familiar with.
* Users will accomplish tasks more quickly because you will have a straight-forward interface design that isn't confusing or difficult.
* Your application will appear native to the desktop and share the same elegant look as default applications.
* Your application will be easier to document because an expected behavior does not require explanation.
* The amount of support you will have to provide, including bugs filed, will be lessened (for the reasons above).

To help you achieve these goals, these guidelines will cover basic interface elements, how to use them and put them together effectively, and how to make your application integrate well with the desktop. The most important thing to remember is that following these guidelines will make it easier to design a new application, not harder.

However, keep in mind that this is a guideline, not a rulebook. New, amazing interaction paradigms appear every day and more are waiting to be discovered. This is a living document that can and will be changed.

For sections that have not yet been written, please refer to [The GNOME HIG](https://wiki.gnome.org/Design/HIG/)

# Design Philosophy {#design-philosophy}

The elementary HIG isn't just about a set of concrete rules; it's meant to be flexible and extensible. As such, this very first portion of the guideline is all about the guiding philosophy we employ. For a quick crash course, we like "The User is Drunk":

<iframe width="560" height="315" src="https://www.youtube.com/embed/r2CbbBLVaPk" frameborder="0" allowfullscreen></iframe>

## What Design Is Not {#what-design-is-not}

Before we get into all the things that make up elementary apps, there is a clarification that needs to be made. We need to understand what exactly design is about, but more importantly we want to smash two major myths:

1. **Design is not something you add on after you've completed a product.** Whether you realize it or not, you are constantly designing anything you build. It is an intrinsic part of creating something. Design is not just what something looks like. It's not just the colors and fonts. Design is how it works. When you decide to add a button that does a thing, that is design. You made a decision to add a button with an icon or a label and where that button went and the size and color of that button. Decisions are designs.

2. **Design is not [just, like, your opinion, man.](http://www.imdb.com/title/tt0118715/quotes?item=qt0464776)** Design is testable. One design will meet a specific goal better than another design. Consider different types of bicycles. A folding bicycle has a different set of design goals than a mountain bicycle. Things like weight, size, and tire tread are important factors in helping the intended user reach their goals. Because we understand that design is about solving specific problems, we must also understand that we can objectively compare the effectiveness of two designs at solving those problems.

------------------------------------------
1. [Design Is Not Veneer, Aral Balkan](http://aralbalkan.com/notes/design-is-not-veneer/)
2. [Design is Not Subjective, Jeff Law](http://www.jefflaw.ca/design-is-not-subjective/)

## Concision {#concision}

Always work to make your app instantly understandable. The main function of your app should be immediately apparent. You can do this in a number of ways, but one of the best ways is by sticking to a principal of concision.

### Avoid Feature Bloat {#avoid-feature-bloat}

It's often very tempting to continue adding more and more features into your application. However, it is important to recognize that every new feature has a price. Specifically, every time you add a new feature:

* Your application gets slower, consumes more resources, and takes up more disk space.
* Your application's interface becomes more cluttered and thus harder to use.
* More time is spent implementing this new feature, rather than perfecting an old feature.
* More code can often mean a greater possibility for bugs.
* More features means more work on documentation, translations, etc.

### Think in Modules {#think-in-modules}

Build small, modular apps that communicate well. elementary apps avoid feature overlap and make their functions available to other apps either through [Contractor](#contractor) or over [D-Bus](http://www.freedesktop.org/wiki/Software/dbus "View D-Bus docs from FreeDesktop.Org"). This both saves you time as a developer (by other apps making their functions available to you), and is a courteous gesture towards other developers (by making your app's functions available to them).

## Avoid Configuration {#avoid-configuration}

If possible, completely avoid presenting any settings or configuration in your app. Providing settings is usually an easy way out of making design decisions about an app's behavior. But just like with problems of feature bloat, settings mean more code, more bugs, more testing, more documentation, and more complexity.

### Build for the "Out of The Box" Experience {#build-for-the-out-of-the-box-experience}

Design with sane defaults in mind. elementary apps put strong emphasis on the out of the box experience. If your app has to be configured before a user is comfortable using it, they may not take the time to configure it at all and simply use another app instead.

<iframe width="420" height="315" src="https://www.youtube.com/embed/G2YNqr-V-xM" frameborder="0" allowfullscreen></iframe>

### Ask the Operating System {#ask-the-operating-system}

Get as much information automatically as possible. Instead of asking a user for their name or their location, ask the system for this information. This cuts down on the amount of things a user has to do and makes your app look intelligent and integrated.

### Do You Really Need It? {#do-you-really-need-it}

Ask yourself if the configuration option you are adding is really necessary or makes sense to a user. Don't ever ask users to make engineering or design decisions.

### When You Absolutely Have To {#when-you-absolutely-have-to}

Keep things contextual. Instead of tucking away preferences in a configuration dialog, think about displaying them in context with the objects they affect (much like how shuffle and repeat options appear near your music library).

If your app needs to be configured before it can be used (like a mail client), present this configuration inside the main window much like a [Welcome Screen](#welcome-screen). Once again, make sure this is really necessary set-up. Adding unnecessary configuration screens stops users from doing what they wanted to do when they opened your app in the first place.

---------------------------
See Also:

1. [Checkboxes That Kill Your Product](http://limi.net/checkboxes-that-kill) by Alex Limi
2. [Don't Give Your Users Shit Work](http://zachholman.com/posts/shit-work/) by Zach Holman
3. [The Wizard Anti-Pattern](http://stef.thewalter.net/installer-anti-pattern.html) by Stef Walter

## Minimal Documentation {#minimal-documentation}

Most users don't want to read through help docs before they can use your app. Instead, they expect that your app will be intuitive and simple for them to understand without assistance.


[![](https://imgs.xkcd.com/comics/manuals.png "The most ridiculous offender of all is the sudoers man page, which for 15 years has started with a 'quick guide' to EBNF, a system for defining the grammar of a language. 'Don't despair', it says, 'the definitions below are annotated.'")](http://xkcd.com/1343/)

### Use Understandable Copy {#use-understandable-copy}

Avoid technical jargon and assume little-to-no technical knowledge. This allows your app to be "self-documenting."

Provide non-technical explanations instead of cryptic error messages. If something goes wrong, a simplified explanation of what happened and how to fix it should be presented. 

------------------------------------------

For more information, see [Writing Style](#writing-style).

# User Workflow {#user-workflow}

Visible design is a large part of the user experience, but so is the user's workflow, or how they interact with an app. In this section, we cover a few important steps of a typical workflow:

* **First-Launch Experience**: What the user sees the first time they use your app.

* **Normal Launch**: What happens when opening your app on a day-to-day basis.

* **Closing**: What happens when closing your app.

* **Background Tasks**: How your app manages to do things invisibly in the background.

## First-Launch Experience {#first-launch-experience}

### Required Configuration {#required-configuration}

When a user first launches an app, they should be able to get down to business as quickly as possible. If configuration is not absolutely required for the first use, they should not be required to configure anything. If configuration is required (like in Postler), they should be presented with a clean and simple [welcome screen](#welcome-screen) within the app (again, like Postler). Avoid separate configuration dialogs when launching.

### Speed of Launch {#speed-of-launch}

Your app's first launch is the user's first impression of your app; it's a chance to really show off its design and speed. If your app has to configure things in the background before visibly launching, it gives the user the impression that the app is slow or will take a long time to start up. Instead, focus on making the application window appear fast and ready to be used, then do any background tasks behind the scenes. If the background task is blocking (ie. the user is unable to perform certain tasks until it's complete), show some type of indication that a background process is happening and make the blocked user interface items insensitive (see: [Widget Concepts](#widget-concepts)).

### Welcoming the User {#welcoming-the-user}

If there is no content to show the user, provide actions they can act upon by using a simple [welcome screen](#welcome-screen). Allow them to open a document, add an account, import a CD, or whatever makes sense in the context of the app.

### Resetting the App {#resetting-the-app}

If a user explicitly "resets" the app (ex. by deleting all songs in a music library or removing all mail accounts in a mail client), it should return to its first-launch state.

## Normal Launch {#normal-launch}

When a user launches an app, they're performing an explicit action and expecting a fast, oftentimes immediate response. You should focus on three key areas for app launching: speed, obviousness of what to do next, and state.

### Speed {#speed}

As has been said before, speed, especially when launching an app, is very important. There should be as little delay as possible in between the time a user decides to launch an app and the instant they can begin using it. If your app requires a splash screen, you're doing it wrong.

### Obviousness {#obviousness}

When a user launches your app, they should know exactly what to do next. This is achieved by following the other interface guidelines (ensuring your app is consistent with other apps) and by offering up explicit actions from the get go. If the app typically displays "items," such as songs or emails, let the user get at those items by displaying them when the app opens. If there are no previously-opened items, you should offer to open or create a new item (such as a document) by using a [welcome screen](#welcome-screen).

### State {#state}

If the user has previously used your app, it's typically best to restore the state of the app when opening it again. This means the app comes up to right where the user left off so they can pick up their work again. For a music player, this means opening up with the view where the user left it and the song paused where the user closed the app. For a document editor, this would mean opening up with the same document scrolled to the same spot with the cursor in the same spot on the page.

## Always Provide An Undo {#always-provide-an-undo}

Sometimes a user will perform an action which could possibly be destructive or traditionally irreversible. Rather than present the user with a warning, apps should allow the user to undo the action for an appropriate amount of time. Some prime examples of when this behavior is useful are:

* **Closing an app**. Rather than warning the user, automatically save their work and the app's state so they can return exactly where they left off. See [Closing](#closing).

* **Deleting an item**. Instead of asking the user if they are sure, make the item "disappear" from the app, but provide an easy and intuitive way to undo the delete.

* **Sending an email**. Rather than asking the user if they want to send an email, allow them to undo or edit the message a short time after "sending."

* **Editing a photo**. Instead of asking the user if they want to destructively apply an edit, allow them to undo the edit and always keep the original backed up.

This behavior should only as a last resort be implemented by providing a buffer time between when the app shows the user what happened and actually performing the action. To keep the experience responsive, the app should always look as if it performed the action as soon as the user initiates it. 

This behavior strikes the best balance of keeping out of the user's way while making sure they don't do something unintended. It's important to keep the undo action unobtrusive yet simple and intuitive; a common way of doing so is by using an info bar, though other methods may also be appropriate.

-----
See also: [Never Use a Warning When you Mean Undo](http://www.alistapart.com/articles/neveruseawarning/ "Read the article on A List Apart") by Aza Raskin

## Always Saved {#always-saved}

Users should feel confident when using elementary; they should know that everything they see is saved and up to date.

Apps in elementary should operate around an always-saved state. This means that changes the user makes are instantly applied and visible and that making the user manually save things is a legacy or specialized behavior.

For example, a Song Info dialog should update the track information instantly without a user having to press a save button, user preferences should be applied as soon as the user manipulates the relevant widget, and closing an app should mean that reopening it will return to where the user left off.

## Closing {#closing}

When a user closes an app, it's typically because they're done using it for now and they want to get it out of the way.

### Saving State {#saving-state}

Apps should save their current state when closed so they can be reopened right to where the user left off. Ideally closing and reopening an app should be indistinguishable from the traditional concept of minimizing and unminimizing an app; that is, all elements should be saved including open documents, scroll position, undo history, etc.

## Background Tasks {#background-tasks}

If it makes sense for an app to complete background tasks after the window is closed, the tasks should be completed soon after the window is closed. If the app performs repeat background tasks (such as a mail client), the background tasks should be handled by a separate daemon that does not rely on the app itself being open.

### Closing the App Window {#closing-the-app-window}

It is not desirable for an app window to simply minimize rather than close when the user attempts to close it. Instead, the app window should be "hidden". If it makes sense to continue a process in the background (such as downloading/transferring, playing music, or executing a terminal command) the app backend should continue with the task and close when the task is finished. If it's not immediately apparent that the process has completed (as with the file download/transfer or terminal command), the app may show a notification informing the user that the process has completed. If it is apparent, as with the music, no notification is necessary.

### Re-Opening the App Window {#re-opening-the-app-window}

If the user re-opens the app while the background process is still executing, the app should be exactly where it would be if the window had been open the whole time. For example, the terminal should show any terminal output, the music player should be on the same page it was when closed, and the browser should come back to the page it was on previously. For more details, see the discussion of app state on a [Normal Launch](#normal-launch).

---
See also: [That's It, We're Quitting](http://design.canonical.com/2011/03/quit/) by Matthew Paul Thomas

# Desktop Integration {#desktop-integration}

An important advantage that developers have when choosing the elementary platform is the ability to seamlessly integrate their application with the default desktop. Outlined below are the several ways in which you can make your application feel beyond native in elementary. This section will cover things like:

* **Creating an App Launcher**. The primary method of discovering and using your app will be through an app launcher found in Slingshot or in the dock. This section details how to create these launchers.
MIME handling. If your application can open and save files, place entries for those file types in the application database and the document type (MIME) database. This allows the file manager and other applications to automatically launch your application when they encounter files your application can handle.

* **Contractor**. elementary provides an easy new way for applications to share files with each other. This will make your application more useful and extend its functionality without adding hundreds of lines of code.

* **Using System Indicators**. elementary uses indicator applets in the panel that allow your application to provide persistent notifications. This section discusses not only how to use that area, but when it is or isn't appropriate to use it.

* **Integrating with the Dock**. elementary ships with a great dock that supports the Unity Launcher API. This allows your application to provide notification badges, progress indicators, and more.

## App Launchers {#app-launchers}

The primary method of discovering and using your app will be through an app launcher found in Slingshot or in the dock. In order to provide these launchers you must install an appropriate .desktop file with your app. This includes giving your launcher an appropriate name, placing it in the correct category, assigning it an icon, etc.

.desktop files follow the freedesktop.org [Desktop Entry Specification](http://standards.freedesktop.org/desktop-entry-spec/latest/index.html "View the spec on FreeDesktop.Org"). They should be installed in _/usr/share/applications_. Users may create their own launchers by putting .desktop files in _~/.local/share/applications_.

The contents of .desktop files should follow this formula:

_**Title** is a(n) **GenericName** that lets you **Comment**._

### Title {#title}

You should not include descriptive words in your title. For example, Dexter is called "Dexter," not "Dexter Address Book." Midori is just "Midori," not "Midori Web Browser." Instead, utilize the GenericName attribute of your app's .desktop file for a generic name, and the Comment attribute for a longer descriptive phrase.

### GenericName {#genericname}

If your app is easily categorized or described with a generic name, you should use that for the GenericName attribute in your app's .desktop file. If you can say, "My app is a(n) ________," then whatever fits in that blank could be the generic name. For example, Maya is a calendar, so its generic name is "Calendar."

You should not include articles (the, a, an) or the words "program," "app," or "application" in your app's generic name.

The generic name should be in [title case](#title-case) and may be used around the system to better describe or categorize your app. 

### Comment {#comment}

The system utilizes an app's Comment attribute found in the .desktop file to succinctly inform a user what can be done with the app. It should be a short sentence or phrase beginning with a verb and containing the primary nouns that your app deals with. For example, the following are appropriate comments:

* Maya: **Browse and schedule events**
* Noise: **Listen to music**
* Lingo: **Look up definitions**
* Geary: **Send and receive mail**
* Scratch: **Edit text files**
* Files: **Browse and manage your files**

An app's comment should be in [sentence case](#sentence-case), not include terminal punctuation (periods, exclamation points, or question marks), and should be as short as possible while describing the _primary_ use case of the app.

### Categories {#categories}

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

### Keywords {#keywords}

You may also include keywords in your launcher to help users find your app via search. These follow the convention of "X-GNOME-Keywords" (for in the app launcher) and "X-AppInstall-Keywords" (for in the app installer). For example, web browser might include "Internet" as a keyword even though it's not in the app's name, generic name, or description. As a result, a user searching for "Internet" will find the app. Here are some more examples:

* Geary: **Email;Gmail**
* Midori: **Internet;WWW;Explorer**
* Files: **Folders;Browser;Explorer;Finder;Manager**
* Terminal: **Command;Prompt;cmd;Emulator**
* Scratch: **Notepad;IDE;Plain**
* System Settings: **Control;Panel**
* Shotwell: **Camera;Picture**

Keywords should be single words in [title case](#title-case) and seperated with a semicolon.

--------------------------------------

See also: [Desktop Entry Specification](http://standards.freedesktop.org/desktop-entry-spec/latest/index.html) from FreeDesktop.org

## Contractor {#contractor}

Contractor is a service and a protocol for exposing services easily between apps. It allows an app to interact with various other apps/services without hardcoding support for them. You simply add [contractor](https://launchpad.net/contractor) support, and then any service registered with contractor is now available for your app to use. Your app can integrate with contractor in two different ways:

* Register one of it's functions as a service that can be used from other apps
* Implement the contractor menu or otherwise access contractor to receive a list of services that can handle the data your app manages

### Displaying Results from Contractor {#displaying-results-from-contractor}

The most typical way to present Contractor results to users is in menu form. Keep in mind the following things when presenting contractor results:

* If the item acted upon is one of many items visible, such as in an icon view, be sure to display results in a way that is directly related to the item such as in a context menu.
* If the item acted upon is the only item currently visible, such as a web page or a contact in Dexter, contractor can be displayed in a toolbar menu.
* Never display the target app's name. The menu string is the intended display name for that app. Doing so can lead to redundant messages such as, "Set image as wallpaper (wallpaper)" and it is always irrelevant to a user's needs.

## Dock Integration {#dock-integration}

By integration with Pantheon's dock, apps are able to communicate their status to the user at a glance.

![](/images/docs/human-interface-guidelines/dock-integration/dock.png)

### Progressbars {#progressbars}

A progressbar must be unambiguous in it's use, referring to a single specific task. For example, a progressbar can be used to indicate the status of a file transfer or of a lengthy process like encoding. A progressbar should not be used to compound the progress of multiple types of actions.

* **Good Example**: Installation progress in Software Center
* **Bad Example**: Combined progress of downloading an album, burning a CD, and syncing a mobile device in Noise

### Badges {#badges}

A badge shows a count of actionable items which your app manages. It's purpose is to inform the user that there are items that require user attention or action without being obtrusive. This is a passive notification. A badge should not show totals or rarely changing counters. If the badge is not easily dismissed when the user views your app, it is likely that this is not a good use of a badge.

* **Good Example**: Unread messages in Geary
* **Bad Example**: Total number of Photos in Shotwell

## System Indicators {#system-indicators}

Indicators are small icons that live on the top panel. They give users a place to glance for a quick indication of various settings or events. Clicking the icon shows a small menu with related actions available to the user.

![](/images/docs/human-interface-guidelines/system-indicators/systray.png)

### Does Your App Need An Indicator? {#does-your-app-need-an-indicator}

The indicator area is notorious for becoming cluttered and having inconsistent behavior. Given that users will probably install many third party apps, we need to be careful about how many indicators we're showing and how they behave. Keep in mind that not every application needs an indicator. Only a very small set of apps will benefit from one. You do not need an indicator if:

* **The indicator will only appear while your app's main window is open.** LibUnity already provides a great API for showing application statuses on your app's icon in the dock. Only use an indicator if it will show while your app's main window is closed.

* **You want a persistent/smaller launcher.** ​Launchers are already stored in the dock in a way that gives the user control over persistence and size. The indicator area should never be used for an app launcher. If you want to add special actions to your launcher, Quicklists should be used, not an indicator.

* **The application is for IM, IRC, e-mail, news-reading, or music playback.** Instead, integrate the application with the existing messaging or sound menus.

---
See also: [Farewell To The Notification Area](http://design.canonical.com/2010/04/notification-area/) by Matthew Paul Thomas

# Container Widgets {#container-widgets}

## Windows {#windows}

Windows are the foundation that your app is built on. They provide a sort of canvas with basic actions built in such as closing an app, resizing it, etc. Although users may see all windows as being the same, there are several distinct types of windows in elementary OS. It's important to understand the types of windows available to you, window behavior in general, and behavior that is specific to a certain window type. This section will cover the different types of windows available in elementary OS. Although each type of window is a bit different, think of them all as a subclass of a window. Unless otherwise stated, they all behave as an average window.

* **View Windows** are the most literal kind of "Window" available. They show content such as presentations, web pages, documents, etc. These Windows act as a sort of frame around the specific content they display. They typically allow multiple instances of an application to be shown and may utilize tabs to help keep content organized without displaying too many windows.
* **App Windows** are the main windows of apps that are not document-based. These windows typically only allow one instance of an application to be shown.
* **Dialogs and Alerts** are temporary windows that require a response from a user. Dialogs and Alerts are especially unique types of windows with much stricter guidelines for their use and visual style. They typically belong to App or View windows and are often modal. We'll discuss what modality means in a bit.

### Window Titles {#window-tiles}

When dealing with window titles, consider that their main use is in distinguishing one window from another. A good window title will provide a description that helps a user make a selection. Keep that in mind as you consider the following:

* A view window should display the name of the content being viewed.  For example, in Midori the window title reflects the title of the current web page. When looking for a specific window among multiple instances of an app, simply showing the application's name is not helpful.
* A window's title should not show the vendor name or version number of the app.  Adding the version number or vendor name clutters the title and doesn't help to distinguish a window. Additionally, this information is already available from your app's About window.
* Dialogs and alerts should not display a window title. They are distinctive enough in their visual style and are often modal.
* If you need to display more than one item in the title, separate the items with an em dash (—) with space on either side. The helps keep the title clean when you need to show more information.
* Don’t display pathnames in window titles, only the current destination. If you have two paths that are very similar it will be hard to distinguish them when displaying the full path. If you only show the destination, the distinction is clear.

### Dialogs {#dialogs}

![A generic alert dialog](/images/docs/human-interface-guidelines/dialogs/dialog-padding.png)

#### Alert Text {#alert-text}

An alert contains both primary and secondary text.

The primary text contains a brief summary of the situation and offer a suggested action. This text should be displayed in a bold font that is slightly larger than the default.

The secondary text provides a more detailed description of the situation and describes any possible side effects of the available actions. It's important to note that a user should only need the primary text to make a decision and should only need to refer to the secondary text for clarification. This text should be placed one text line height beneath the primary text using the default font size and weight.

Make both the primary and secondary text selectable. This makes it easy for the user to copy and paste the text to another window, such as an email message.

#### Button Order {#button-order}

![](/images/docs/human-interface-guidelines/dialogs/button-order.png)

* All dialogs should contain an affirmative button that performs the action suggested in the primary text. This button goes on the far right side of the window.
* For dialogs that are displayed in response to user action (such as "Quit"), provide a "Cancel" button directly to the left of the affirmative button.
* If your dialog has alternative actions, list them to the left of the "Cancel" button.
* If you wish your dialog to contain a "Help" button, this should be placed to the far left of the window.

#### "OK" is not Okay {#ok-is-not-okay}

When presenting a dialog to a user, always use explicit action names like "Save...", "Shut Down", etc. Consider that using "OK" enables users to proceed without understand the action they are authorizing. Not all users will read the question or information presented to them in a dialog. Using specific action names will make it harder for a user to select an unintended action and may even encourage them to read the information presented before making a selection.

#### Preference Dialogs {#preference-dialogs}

Preference dialogs should be made Transient, but not Modal. When a user makes a change in a preference dialog, the change should be immediately visible in the UI. If the dialog is modal, the user may be blocked from seeing (and especially from interacting with) the change. This means they will have to close the dialog, evaluate the change, then possibly re-open the dialog. By making the dialog transient, we keep the dialog on top for easy access, but we also allow the user to evaluate and possibly revert the change without having to close and re-open the preference dialog.

-------------------------------------------

See also:

1. [Why 'Ok' Buttons In Dialog Boxes Work Best On The Right](http://uxmovement.com/buttons/why-ok-buttons-in-dialog-boxes-work-best-on-the-right/) by UX Movement
2. [Why The Ok Button Is No Longer Okay](http://uxmovement.com/buttons/why-the-ok-button-is-no-longer-okay/) by UX Movement
3. [Should I use Yes/No or Ok/Cancel on my message box?](http://ux.stackexchange.com/questions/9946/should-i-use-yes-no-or-ok-cancel-on-my-message-box) on UX StackExchange
4. [Where to Place Icons Next to Button Labels](http://uxmovement.com/buttons/where-to-place-icons-next-to-button-labels/) by UX Movement

## Popovers {#popovers}

Popovers are like a contextual dialog. They display transient content directly related to something that was clicked on and close when clicked out of, like menus.

![](/images/docs/human-interface-guidelines/popovers/midori-favorites-popover.png)

A popover should be used when a user wants to perform a quick action without getting out of the main UI. Some examples of where a popover could be used are adding a contact from an email, adding a bookmark in a browser, or displaying downloads or file transfers.

Popovers should not be used when displaying only a simple list of items; instead, use a menu. Likewise, don't use a popover if the user would spend more than a few seconds in it; instead, use a dialog. Remember that popovers are contextual and should directly relate to the UI element from which they spawn.

## Toolbars {#toolbars}

A Toolbar is useful for providing users with quick access to an app's most used features. Besides Buttons, a Toolbar is one of the most frequently used UI elements. It may seem like a simple container, but it is important to remain consistent in it's use and organization.

### Ordering Toolbar Items {#ordering-toolbar-items}

![](/images/docs/human-interface-guidelines/toolbars/toolbar.png)

Toolbar items should be organized with the most significant objects on the left and the least significant on the right, with the AppMenu always on the far right of the Toolbar. If you have many toolbar items it may be appropriate to divide them into groups with space in between each group. Keep in mind that when viewed with RTL languages, your toolbar layout will be flipped.

# UI Toolkit Elements {#ui-toolkit-elements}

elementary uses consistent user interface (UI) elements to bring a unified and predictable experience to users, no matter what app they're using. When used properly, this ensures a small (or nonexistent) learning curve for your app.

## Widget Concepts {#widget-concepts}

Before we get into all the widgets available in elementary OS, we need to cover some basic concepts that apply to all widgets. Employing these concepts correctly will create a more seamless experience for your users and help you avoid sifting through bug reports!

### Controls That Do Nothing {#controls-that-do-nothing}

A very common mistake for developers to make is creating controls that seemingly do nothing. Keep in mind that we want to present an environment where users feel comfortable exploring. A curious user will interact with a control expecting there to be some immediate reaction. When a control seemingly does nothing, this creates confusion and can be scary (Think,  "uh-oh I don't know what happened!"). In some cases, controls that do nothing are simply clutter and add unnecessary complexity to your UI.

Consider the "clear" button present in search fields. This button only appears when it is relevant and needed. Clicking this button when the field is already clear essentially does nothing. 

### Sensitivity {#sensitivity}

Sometimes it doesn't make sense for a user to interact with a widget until some pre-requisite is fulfilled. For example, It doesn't make sense to allow a user to click the "Forward" button in a browser unless there is forward history available. In this case, you should make the "Forward" button insensitive or a user may click it, expecting a result, and be confused when nothing happens.

It's usually better to make a widget insensitive than to hide it altogether. Making a widget insensitive informs the user that the functionality is available, but only after a certain condition is met. Hiding the widget gives the impression that the functionality is not available at all or can leave a user wondering why a feature has suddenly "disappeared".

### Hidden Widgets {#hidden-widgets}

When a widget only makes sense in a certain context (not as an indicator of an action to be performed) sometimes it does make more sense to hide it. Take hardware requirements for example: It may not make sense to show multi-display options if the system only has a single display. Making multi-display options insensitive is not really a helpful hint on this system. Another exemption to this rule is a widget that a user will only look for in context, like the clear button example above. Finally, Keep in mind that insensitive items will still be recognized by screen readers and other assistive tech, while hidden widgets will not.

### Spacing {#spacing}

* Windows should have a 12px (minimum) space between any widgets and the window's border.
* Labels should be 12px (minimum) from their widgets.
* If there are section headers present, labels should be indented.
* Horizontal spacing between buttons is 6px.

### Alignment {#alignment}

* Widgets should be "Justified" so that they align on both the left and right sides. Do not include "descriptor" widgets such as icons or labels in this justification.
* Labels should be right aligned with respect to each other when possible.
* Section headers should be left aligned with respect to each other.

---
See also: [Form Label Proximity: Right Aligned is Easier to Scan](http://uxmovement.com/forms/form-label-proximity-right-aligned-is-easier-to-scan) by UX Movement

## Infobars {#infobars}

Infobars provide contextual information and actions to the user with varying levels of severity.

![](/images/docs/human-interface-guidelines/infobars/infobars.png)

It is important to determine the severity or type of infobar to use. There are four types of infobars available:

* **Information**: Supplemental information and an optional action the user may perform. Shows as white in the UI.
* **Question**: A non-critical question for the user. An answer of some sort is expected, but it's not urgent or severe. Shows as blue in the UI.
* **Warning**: Lets the user know something unexpected or bad may happen and provides an action to resolve it. Displays as yellow in the UI.
* **Error**: Informs the user of an error that has occurred and requires a user action to resolve it. Reserved for critical situations. Displays as red in the UI.

## Welcome Screen {#welcome-screen}

![](/images/docs/human-interface-guidelines/welcome-screen/welcome-screen.png)

The Welcome Screen is a friendly way to help users get started with your app.

### Usage {#welcome-screen-usage}

Typically a Welcome Screen is used for apps like Noise or Scratch where you have to import or create objects in a library before you can interact with them. This provides your users with a clear path to getting started and points out any immediate steps they must take before your app becomes useful.

Make sure that if your app allows its library to be cleared that the Welcome Screen is shown again instead of an empty list.

### Labeling {#welcome-screen-labeling}

The Welcome Screen consists of two sets of labels:

* The first set explains the situation and what the Welcome Screen will help you accomplish. As an example, Noise's Welcome Screen explains that your music library is empty and that in order for the library view to become useful, we must add songs to it.
* The second set of labels consists of the actions that will assist a user in getting started with your app. To use Noise as an example again, one possible action is setting your music folder to an alternate location. First we name the action, "Set Music Folder". Then, we describe what the action does, "Find your Music folder and import its contents."

### Iconography {#welcome-screen-iconography}

Grouped with each action is an icon that helps to quickly visualize it. Most of the time these will be Action icons, but you can use Places icons when importing or setting a location and even Apps icons if you must open a configuration utility.

## Source List {#source-list}

A source list may be used as a high-level form of navigation. Source lists are useful for showing different locations, bookmarks, or categories within your app.

![](/images/docs/human-interface-guidelines/source-list/files.png)

### Sections {#sections}

A source list may be separated into different collapsible sections, each with its own heading. For example, a file manager might have a section for bookmarked locations, a section for storage devices attached to the computer, and a section for network locations. These sections help group related items in the source list and allows the user to hide away sections they might not use.

Avoid nesting expandable sections within a source list if possible; if you find yourself wanting to do this, you may need to rethink the sections.

### Hierarchy {#hierarchy}

Hierarchy is important with source lists, both within the widget itself and within the broader scope of your app.

Sections in the source list should be sorted from most important at the top to least important at the bottom. If you're having a hard time deciding the relative importance of each section, think about which section a user is likely to use more often. Sorting the sections this way ensures that the most important items are always visible, even if the source list is too short to fit all of the items, though of course items at the bottom will still be accessible via scrolling.

A source list goes at the left side of a window (or right side for right-to-left languages). Because the user reads in this direction, the sidebar is reinforced as being before (and therefore at a higher level than) the app's contents. 

## Buttons {#buttons}

Buttons are an incredibly important widget to understand since your app will undoubtedly contain them. 

### Tool Buttons {#tool-buttons}

![](/images/docs/human-interface-guidelines/buttons/open.png)

#### Labeling {#tool-buttons-labeling}

Tool Buttons are almost always icon-only and do not provide a button border. They should not be accompanied by a label.

#### Tooltips {#tool-buttons-tooltips}

All Tool Buttons should have tooltips, since they do not contain a label. This assists users with disabilities as well as giving a translation for an unrecognized icon. Tooltips should be done in Sentence Case.

Like text button labels, a tooltip should clearly describe what will happen when the button is pressed.

### Text Buttons {#text-buttons}

![](/images/docs/human-interface-guidelines/buttons/cancel.png)

#### Labeling {#text-buttons-labeling}

Text Button labels should be done in Title Case.

Like menu items, Text Button labels should consist of an Action or a Location but not a status. Make sure that a button's label clearly describes what will happen when it is pressed.

"Remove Account", "Transfer to Jim's Laptop", and "Import 20 Songs" are good labels.

"OK", "Get more storage!", and "Low Battery" are not good button labels. The "Get more storage!" label uses incorrect capitalization and unnecessary punctuation. With the other two labels, It's not very clear what will happen when these buttons are clicked.

#### Tooltips {#text-buttons-tooltips}

Since Text buttons have a clear and explicit label, it's usually unnecessary to give them a tooltip.

### Linked Buttons {#linked-buttons}

![](/images/docs/human-interface-guidelines/buttons/radio.png)

#### Usage {#linked-buttons-usage}

Linked Buttons are used to group actions that are either similar in nature or mutually exclusive. For example, they could group text options like Bold, Italic, and Underline. Or they can be used to group mutually exclusive states like Grid, List, or Column view.

#### Labeling {#linked-buttons-labeling}

Linked Buttons should never contain colored icons. Only 16px symbolic icons OR text. Do not mix icons and text.

---
1. [Why The OK Button Is No Longer Okay](http://uxmovement.com/buttons/why-the-ok-button-is-no-longer-okay/) by UX Movement
2. [Should I use Yes/No or Ok/Cancel on my message box?](http://ux.stackexchange.com/questions/9946/should-i-use-yes-no-or-ok-cancel-on-my-message-box) on UX StackExchange

## AppMenu {#appmenu}

The AppMenu is an optional menu which is opened using the gear-shaped icon on the far-right of an app's toolbar. It provides relevant menu items in place of the traditional "File, Edit, View..." menu bar.

![](/images/docs/human-interface-guidelines/appmenu/appmenu.png)

### Usage {#appmenu-usage}

You should first consider if your app needs this widget. While most apps may have one, your app may not necessarily need an AppMenu.

When adding items to your AppMenu, consider the following:

* Items should be relevant and useful. It's not acceptable to duplicate items that are found in your main UI here.
* If the app includes a "preferences" window, it should be available from the AppMenu.
* There should be an item for the "About" dialog which contains links to the project's bug tracker, help, etc.
* If an AppMenu is displayed, a menu bar should not be, and vice-versa.

## Search Fields {#search-fields}

Apps that support the searching or filtering of content should include a search field on the right side of the app's toolbar (to the left of the AppMenu). This gives users a predictable place to see whether or not an app supports searching, and a consistent location from which to search. Gtk+ provides a convenient complex widget for this purpose called [Gtk.SearchEntry](http://valadoc.org/#!api=gtk+-3.0/Gtk.SearchEntry).

![](/images/docs/human-interface-guidelines/search-fields/search-field.png)

### Behavior {#behavior}

If it is possible to include search functionality within your app, it is best to do so. Any list or representation of multiple pieces of data should be searchable using a search field that follows these rules:

* Results should be instantly shown as you type. This helps your app to appear faster and is more useful than having to hit "Enter" and wait. Exceptions may be made if the data is not stored locally.
* In most cases, the search should be case-insensitive; users should not be expected to provide the exact capitalization. A good compromise is "smart case" where case is respected whenever the user intentionally types lower and upper case letters.

### Labeling {#search-fields-labeling}

Search fields should contain hint text that describes what will be search. You can set this using the entry property ["placeholder_text"](http://www.valadoc.org/#!api=gtk+-3.0/Gtk.Entry.placeholder_text).

Most search fields should use the format "Search OBJECTS" where OBJECTS is something to be searched, like Contacts, Accounts, etc.

If the search field interacts with a search service, the hint text should be the name of that service such as "Google" or "Yahoo!"

## Checkboxes & Switches {#checkboxes-switches}

### Checkboxes {#checkboxes}

Checkboxes present a way for users to select items from a list.

#### Usage {#checkboxes-usage}

Use checkboxes when users are making a selection of items.
Make sure that a user can toggle the state of the checkbox by clicking on the label associated with the checkbox.

#### Labeling {#checkboxes-labeling}

Labels associated with Checkboxes should usually be nouns or nounal phrases.

### Switches {#switches}

![](/images/docs/human-interface-guidelines/checkboxes-switches/switches.png)

Switches present a way for users to toggle certain features or behaviors "on" or "off".

#### Usage {#switches-usage}

Don't use switches to include related items as part of a list, instead use a checkbox. Think of switches as acting on independent services and checkboxes as including objects in a list. This is an important distinction to make.

Notice that the option "Record from microphone" is a great candidate for a switch. You are enabling and disabling this recording service.

However, if there are two options "Record system sounds" and "Record from microphone" you are now dealing with a list of related items to include as part of a larger recording service (who's on and off state is independent of what services it includes). In this case, a checkbox is more appropriate to denote this inclusion.

#### Labeling {#switches-labeling}

When possible, directly call out the service you are acting on. Do not use words that describe the state that the widget is describing like "Enable Multitouch", "Use Multitouch", or "Disable Multitouch". This can create a confusing situation logically. Instead, simply use the noun and write "Multitouch".

----------------

See also: _[3 Ways to Make Checkboxes, Radio Buttons Easier to Click](http://uxmovement.com/forms/ways-to-make-checkboxes-radio-buttons-easier-to-click/)_ by UX Movement

## Notebooks {#notebooks}

Notebooks are a type of widget that allow showing one of multiple pages in an app, also colloquially referred to as "tab bars."

### Static Notebook {#static-notebook}

![](/images/docs/human-interface-guidelines/notebooks/static-notebook.png)

A Static Notebook is a small set of unchanging tabs, commonly seen in preferences or settings screens. The tabs appear as linked buttons centered at the top of the content area. A Static Notebook should typically contain two to five tabs.

### Dynamic Notebook {#dynamic-notebook}

![](/images/docs/human-interface-guidelines/notebooks/dynamic-notebook.png)

A Dynamic Notebook is a way for an app to provide user-managable tabbing functionality, commonly seen in web browsers. The tabs appear attached to the toolbar on their own tab bar above the relevant content. Tabs are able to be rearranged and closed and a "new tab" button is at the left ot the notebook widget.

# Iconography {#iconography}

Iconography is a key part of elementary OS. Icons make up the majority of the UI that your user will be actively engaging with; they're what bring the system to life and cater to the powerful recognition engine of the human brain.

## Shape {#shape}

Your icon should have a distinctive shape/silhouette to improve its recognition. This shape should not be too complicated, but the icon should not always be a rounded rectangle.

<div style="width:100%;display:inline-block;text-align:center;">
	<img title="Warning icon" class="hig-icon" src="/images/docs/human-interface-guidelines/icons/64/dialog-warning.svg">
	<img title="Chat icon" class="hig-icon" src="/images/docs/human-interface-guidelines/icons/64/internet-chat.svg">
	<img title="Photos icon" class="hig-icon" src="/images/docs/human-interface-guidelines/icons/64/multimedia-photo-manager.svg">
	<img title="Videos icon" class="hig-icon" src="/images/docs/human-interface-guidelines/icons/64/multimedia-video-player.svg">
	<img title="Online Accounts icon" class="hig-icon" src="/images/docs/human-interface-guidelines/icons/64/preferences-desktop-online-accounts.svg">
	<img title="Terminal icon" class="hig-icon" src="/images/docs/human-interface-guidelines/icons/64/utilities-terminal.svg">
</div>

### Metaphors

If you're creating an icon for a hardware device or a file type (such as those for MimeType or Device icons), its shape is typically a visual representation of its real-world counterparts. For example, the icon for a camera is a stylized camera.

<div style="width:100%;display:inline-block;text-align:center;">
	<img title="Camera icon" class="hig-icon" src="/images/docs/human-interface-guidelines/icons/64/camera-photo.svg">
	<img title="Hard Disk icon" class="hig-icon" src="/images/docs/human-interface-guidelines/icons/64/drive-harddisk.svg">
	<img title="Mouse icon" class="hig-icon" src="/images/docs/human-interface-guidelines/icons/64/input-mouse.svg">
	<img title="Package icon" class="hig-icon" src="/images/docs/human-interface-guidelines/icons/64/package.svg">
	<img title="HTML Text icon" class="hig-icon" src="/images/docs/human-interface-guidelines/icons/64/text-html.svg">
	<img title="Computer icon" class="hig-icon" src="/images/docs/human-interface-guidelines/icons/64/video-display.svg">
</div>

### Action Icons

Action icons are used to represent common user actions, such as "delete", "play", or "save". These icons are mostly found in app toolbars, but can be found throughout the OS.

<div style="width:100%;display:inline-block;text-align:center;">
	<img title="Previous icon" class="hig-icon" src="/images/docs/human-interface-guidelines/icons/24/go-previous.svg">
	<img title="Next icon" class="hig-icon" src="/images/docs/human-interface-guidelines/icons/24/go-next.svg">
	<img title="Document export icon" class="hig-icon" src="/images/docs/human-interface-guidelines/icons/24/document-export.svg">
	<img title="Print icon" class="hig-icon" src="/images/docs/human-interface-guidelines/icons/24/document-print.svg">
	<img title="Save icon" class="hig-icon" src="/images/docs/human-interface-guidelines/icons/24/document-save-as.svg">
	<img title="Delete icon" class="hig-icon" src="/images/docs/human-interface-guidelines/icons/24/edit-delete.svg">
	<img title="Cut icon" class="hig-icon" src="/images/docs/human-interface-guidelines/icons/24/edit-cut.svg">
	<img title="Undo icon" class="hig-icon" src="/images/docs/human-interface-guidelines/icons/24/edit-undo.svg">
	<img title="Inverse icon" class="hig-icon" src="/images/docs/human-interface-guidelines/icons/24/object-inverse.svg">
	<img title="Play icon" class="hig-icon" src="/images/docs/human-interface-guidelines/icons/24/media-playback-start.svg">
	<img title="New tag icon" class="hig-icon" src="/images/docs/human-interface-guidelines/icons/24/tag-new.svg">
	<img title="Menu icon" class="hig-icon" src="/images/docs/human-interface-guidelines/icons/24/open-menu.svg">
</div>

If your app makes use one of these common actions, reference its corresponding icon instead of creating your own. This ensures a consistent user experience and aids in user recognition of common functions.

If your app has a unique action, you may need to create your own. When doing this, try to follow the look and feel of existing action icons, and include it along with your app.


## Icon Sizes {#size}

elementary OS uses **six** main icon sizes throughout the OS and it's best to include all six as part of your application.

<div class="icons-container">
	<img title="16 pixel icon" src="/images/docs/human-interface-guidelines/icons/16/utilities-terminal.svg">
	<img title="24 pixel icon" src="/images/docs/human-interface-guidelines/icons/24/utilities-terminal.svg">
	<img title="32 pixel icon" src="/images/docs/human-interface-guidelines/icons/32/utilities-terminal.svg">
	<img title="48 pixel icon" src="/images/docs/human-interface-guidelines/icons/48/utilities-terminal.svg">
	<img title="64 pixel icon" src="/images/docs/human-interface-guidelines/icons/64/utilities-terminal.svg">
	<img title="128 pixel icon" id="s128" src="/images/docs/human-interface-guidelines/icons/128/utilities-terminal.svg">
</div>

<div class="icons-container">
	<span>16</span>
	<span>24</span>
	<span>32</span>
	<span>48</span>
	<span>64</span>
	<span id="s128">128</span>
</div>

<div class="icons-container small-screen">
	<img title="128 pixel icon" src="/images/docs/human-interface-guidelines/icons/128/utilities-terminal.svg">
</div>

<div class="icons-container small-screen">
	<span>128</span>
</div>

Design each icon for the size it's meant to be viewed at. In other words, do not design one icon and resize it to fill the remaining sizes, the best result is when each icon is designed individually.

## Color Palette {#color}

Color, don't be afraid to use it! Many of the elementary icons use vibrant colors; it's best to reserve muted tones and greys for boring system icons.

<div style="width:100%;display:inline-block;text-align:center;">
	<img title="Mail icon"class="hig-icon" src="/images/docs/human-interface-guidelines/icons/64/internet-mail.svg">
	<img title="RSS reader icon"class="hig-icon" src="/images/docs/human-interface-guidelines/icons/64/internet-news-reader.svg">
	<img title="Web browser icon"class="hig-icon" src="/images/docs/human-interface-guidelines/icons/64/internet-web-browser.svg">
	<img title="Photos icon"class="hig-icon" src="/images/docs/human-interface-guidelines/icons/64/multimedia-photo-manager.svg">
	<img title="Network error icon"class="hig-icon" src="/images/docs/human-interface-guidelines/icons/64/network-error.svg">
	<img title="Calendar icon"class="hig-icon" src="/images/docs/human-interface-guidelines/icons/64/office-calendar.svg">
</div>

Colors do have their connotations, so be cognisant of this when picking them. For instance: red is usually associated with error or "danger" and orange with warnings. But you can use these color connotations to help convey your icon's meaning, such as green for "go".

## Composition {#composition}

There are three aspects to note when designing an elementary icon:

* Its baseline (highlighted in <span style="color:blue;">blue</span>) to ensure that all icons of one size line up along the bottom when in a row (much like text).
* Its mean line height (<span style="color:green;">green</span>), also known as the center line of your canvas.
* The x-height (shown in <span style="color:red;">red</span>) or "how tall" your icon is.

<img title="Videos icon composition" class="hig-icons-example" style="background-image:url(/images/docs/human-interface-guidelines/icons/example-icon1.png);" src="/images/docs/human-interface-guidelines/icons/grid.svg">
<img title="Terminal icon composition" class="hig-icons-example" style="background-image:url(/images/docs/human-interface-guidelines/icons/example-icon2.png);" src="/images/docs/human-interface-guidelines/icons/grid.svg">

Keeping these lines in mind while designing, means you can place elements along them so icons appear more consistent when put together. For example, notice how some elements in both the Terminal and Videos icon above relate to the mean line.

### Common Measurements

If you're designing a square-shaped icon, like the one for Terminal seen above, then these are some common measurements (in pixels) for each icon.


| Canvas Size   | Base Line     | x-Height | Mean Line Height |
| ------------- |:------------- | -------- | ---------------- |
| 16x16         | 1             | 14       | 8                |
| 24x24         | 2             | 20       | 12               |
| 32x32         | 2             | 26       | 16               |
| 48x48         | 3             | 40       | 24               |
| 64x64         | 4             | 56       | 32               |
| 128x128       | 9             | 104      | 64               |

### Exceptions

However there are exceptions. Many icons (especially mimetype icons) have ascending and descending elements, which are those elements that extend beyond the base line and x-height line (shown here in <span style="color:orange;">orange</span>.)

<img title="First composition exception example" class="hig-icons-example" style="background-image:url(/images/docs/human-interface-guidelines/icons/exception-icon1.png);" src="/images/docs/human-interface-guidelines/icons/grid.svg">
<img title="Second composition exception example" class="hig-icons-example" style="background-image:url(/images/docs/human-interface-guidelines/icons/exception-icon2.png);" src="/images/docs/human-interface-guidelines/icons/grid.svg">

Rounder components will always need to be slightly larger than their rectangular counterparts due to the necessary addition of overshoot to compensate for the optical illusion that makes them look smaller.

## Outlines &amp; Contrast {#contrast}

All elementary icons have a thin outline (stroke) to improve their contrast. This stroke width is **one** pixel for each and every icon, at every size.
The color of the outline is a darker variant (30% darker) of the primary color of the icon. For instance, in the calendar icon below, the green header has a stroke of a darker green.

<img title="First icon contrast example" class="hig-icons-example" style="background-image:url(/images/docs/human-interface-guidelines/icons/contrast-example1.png);" src="/images/docs/human-interface-guidelines/icons/grid.svg">
<img title="Second icon contrast example" class="hig-icons-example" style="background-image:url(/images/docs/human-interface-guidelines/icons/contrast-example2.png);" src="/images/docs/human-interface-guidelines/icons/grid.svg">

To further improve contrast, strokes are also semi-transparent. This ensures icons appear sharp against a variety of backgrounds. Also, if the element is near-white this stroke acts like border and contains, rather than overlaps, its corresponding element. See the above icon for an example of this.

## Shadows &amp; Highlights {#shadows}

If you picture an icon sitting on a shelf facing you with a light source being above it, you may see a small fuzzy shadow near the bottom. Also, since the edges of an object tends to reflect light more due to your relative position to it and the light source, they will have a highlight. Both these effects are something elementary icons emulate in their design to lend a degree of realism.
### Edge Highlight

To apply the edge highlight effect to your icon, you draw a subtle, <b>1 pixel</b>, inner stroke as a highlight. This outline is slightly brighter at the top and the bottom than it is at the edges.

<img title="Highlight example" class="hig-icons-example" style="background-image:url(/images/docs/human-interface-guidelines/icons/highlight-example1.png);" src="/images/docs/human-interface-guidelines/icons/grid.svg">

### Drop Shadow

To draw this you'll start by drawing a rectangle. Then fill it with a linear gradient that is perpindicular to bottom of the icon and has three stops –the first and last of which have a zero opacity. Then this entire shape is set to <b>60% opacity</b>.

![](/images/docs/human-interface-guidelines/icons/shadow-example1.png "Shadow example 1")

Next create two smaller rectangles to "bookend" the larger. Fill each with a gradient identical to the first but make it radial instead. Center the radial gradient in the middle of a short edge with each stop directly out to the nearest edge –see below for an example. Both these rectangles are also set to <b>60% opacity</b>.

![](/images/docs/human-interface-guidelines/icons/shadow-example2.png "Shadow example 2")

### Pictogram Shadow

If your icon has a pictogram, such as the play triangle in the icon below, you can give it a drop shadow to make it stand out from the background of the icon.

![](/images/docs/human-interface-guidelines/icons/64/multimedia-video-player.svg "Video player icon")

To do this, first duplicate the pictogram and fill it with solid black and set it to <b>15% opacity</b>. Next, shift it 1 pixel down and place it below the pictogram. Create a copy of this shadow and give it a 1 pixel stroke (also black) and adjust this element to <b>7% opacity</b>

### Icon Materials

You are free to add gloss (extra highlights) to your icon but this is only a good idea if you're emulating a surface that is more-reflective in real life (such as plastic, glass, etc.) For instance, a sheet of paper is not glossy therefore a icon emulating paper would not be either.

![](/images/docs/human-interface-guidelines/icons/highlight-example2.png "Glossy vs. non-glossy")

## Dos and Don'ts {#dos-donts}

Below are some "do and don't" examples to consider when creating icons for your app.

* Your icon should not be overly complicated. Keep in mind that since there are smaller sizes, the elements that make up your icon should be distinguishable when at those sizes.
* Your icon should make use of transparent elements, and should not simply be full-frame images. Where you can, distinguish your icon with subtle yet appealing visuals.
* Don't make a thin icon. Your icon's weight should be comparable to that of other icons. An overly thin icon won't stand out well on many backgrounds.
* If you would like to give your icon a tilted perspective, it should tilt backward (not forward).

# Text {#text}

Although elementary primarily uses graphics as a means of interaction, text is also widely used for things like button labels, tooltips, menu items, dialog messages, and more. Using text consistently and clearly both in terminology and format is an extremely important part of designing your app and helps add to the overall cohesiveness of the elementary platform.

* **Writing Style**. Keep your text understandable and consistent with the rest of elementary.
* **Language**. Keep other languages in mind.
* **Capitalization**. What, when, and where to capitalize.
* **Punctuation**. Avoid common mistakes and follow convention.
* **Using Ellipsis**. When, where, and why to use ellipsis.
* **Naming Menu Items**. Keep your menus clear and consistent.

## Writing Style {#writing-style}

Use the following rules to keep your text understandable and consistent:

### Be Brief {#be-brief}

Don't give the user a bunch of text to read; a lengthy sentence can appear daunting and may discourage users from actually reading your messaging. Instead, provide the user with short and concise text.

* **Bad**: It doesn't look like you have any music in your library. You can use Noise to organize your music, add more, and listen to the music you already have. To get started, click on the "Add" button, then follow the prompts. Once you're done, your Music will be displayed here.
* **Better**: Get Some Tunes. Noise can't seem to find your contacts. \[Buttons to import or create contacts\]

### Think Simple {#think-simple}

Assume the user is intelligent, but not technical. Avoid long, uncommon words and focus on using common, simple verbs, nouns, and adjectives. Never use technical jargon.

* **Bad**:37 audio format files have been successfully imported into the songs database.
* **Better**: Successfully added 37 songs.

### Get To The Bottom Line {#get-to-the-bottom-line}

Put the most important information at the beginning of your text. If the user stops reading, they'll still have what they need in mind.

* **Bad**: Your network connection might be down because Lingo could not find any definitions. Check it and try again.
* **Better**: No definition found. Check your network connection and try again.

### Don't Repeat Yourself {#dont-repeat-yourself}

Repetition can be annoying and adds unnecessary length to your messaging.

* **Bad**: Your email address, johndoe@email.com, has been added. To access johndoe@email.com, click on "johndoe@email.com" above.
* **Better**: Your email address has been added. To access it, click "johndoe@email.com" above.

### Use Visual Hierarchy {#use-visual-hierarchy}

Visual hierarchy aids users in reading and comprehending your text as well as knowing what is most important. Use headings and other text styles appropriately.

* **Bad**:
<p>No files are open. Open a file to begin editing.</p>

* **Better**:
### No files are open.
Open a file to begin editing.

## Language {#language}

While much of elementary is developed in English, there are many users who do not know English or prefer their native language. While putting text into your app, keep the following in mind:

* **Make it translatable.** Always, always make your text translatable using the built-in methods. It can't be translated if you don't make it translatable. Include punctuation in translatable strings.
* **Avoid culture-specific references.** Remember that users of another language are going to be using your app. Specific metaphors or references will likely be lost on or downright confusing to other those users. Instead, use universal text.
* **Keep differences in mind.** Remember that other languages and cultures often use different currencies, date formats, punctuation, and more. Always keep these things in mind when developing your app's text, and use the system-provided methods for translating these items when possible.
* **Right-to-left.** It's easy to forget about right-to-left (RTL) languages if you're so used to using left-to-right. Make sure your app still works well when used with RTL layouts, and always use RTL-compatible widgets when developing your app.

## Capitalization {#capitalization}

All textual user interface items, including labels, buttons, and menus, should use one of two capitalization styles: sentence case or title case.

### Sentence Case {#sentence-case}

Sentence case means you capitalize like in a standard sentence or phrase.

Only the first letter of the phrase and the first letter of proper nouns are capitalized.
Used for labels and descriptive text.

* ex. "Always open MPEG files with Marlin" next to a checkbox.
* ex. "Read news feeds" for the description of an RSS reader.
* ex. "This folder is empty" in a file manager.

### Title Case {#title-case}

Title case means you capitalize like a book or article title.

Capitalize the first and last words.
All nouns, pronouns, adjectives, verbs, adverbs, and subordinate conjunctions (as, because, although) are capitalized.
Used for titles, buttons, menus, and most other widgets.

* ex. "Open File" title in a dialog.
* ex. "Delete 13 Songs" on a button.
* ex. "Search Contacts..." in a search bar.

### Notes/Exceptions {#notes-exceptions}

Proper nouns should always be capitalized properly; this means that, for example, Google should always be shown as "Google," elementary should always be shown as "elementary," and MPEG should always be shown as "MPEG." If you're unsure how a certain pronoun should be officially capitalized, refer to the documentation of the pronoun in question.

## Punctuation {#punctuation}

Proper typography is important throughout elementary OS. Not just for consistency within the OS, but for following proper convention and presenting ourselves as a serious, professional platform.

### Prevent Common Mistakes {#prevent-common-mistakes}

* Only use **one space** after a period.
    * i.e. “This is a sentence. This is another sentence.”
* Use a proper ellipsis character (…) rather than three dots.
    * Use `\u0133` in your code.
    * See [Using Ellipses](#using-ellipses) for usage details.
* For quotes, use proper **left and right double quotation characters** (“ and ”).
    *  Use `\u201C` and `\u201D` in your code.
* In contractions and possession, use a **right single quotation mark** (’) as an apostrophe.
    * Use `\u2019` in your code.
* Use **real math symbols** for subtraction (−), multiplication (×), and division (÷) signs.
    * Use `\u2212`,  `\u00D7`,  and `\u00F7` in your code.
* Use correct **copyright symbols** (©).
    * Use `\u0169` in your code.
* Use **superscripts** where needed (e.g. 1<sup>st</sup>).

### Hyphens & Dashes {#hyphens-and-dashes}

#### Hyphen (-) {#hyphen}

Use `\u2010` in code. Used for:

* Joining words (e.g. non-breaking).
    * _If the word cannot be split along lines (e.g. UTF-8), use a non-breaking hyphen (- `\u2011`)._

#### En Dash (–) {#en-dashe}

Use `\u2013` in code. Used for:

* Number ranges (e.g. 5–12). _Do not put a space on either side._

#### Em Dash (—) {#em-dashe}

Use `\u2014` in code. Used for:

* Interjections (e.g. the party—which was scheduled for Thursday—was delayed).
    * _Do not put a space on either side._
* Quote offsets.
    * _New line, space to the right._

-----------------

If in doubt, refer to [Butterwick's Practical Typography](http://practicaltypography.com/).

These rules apply to the English language; other languages may have their own conventions which should be followed by translators.

## Using Ellipsis {#using-ellipses}

The ellipsis character (…) is used in the interface for two primary reasons: informing the user of an additional required information and letting the user know text has been shortened.

### Additional Information {#additional-information}

An ellipsis should be used to let a user know that more information or a further action is required before their action can be performed. Usually this means that the user should expect a new interface element to appear such as a new window, dialog, toolbar, etc in which they must enter more information or make a selection before completing the intended action. This is an important distinction because a user should typically expect an instant action from buttons and menu items while this prepares them for an alternate behavior. More specifically, an ellipsis should be used when the associated action:

* **Requires specific input from the user.** For example, Find, Open, and Print commands all use ellipses because the user must select or input the item to find, open, or print. An easy way to remember this is to think of a question requiring and answer: Find what? Open what? Print what?
* **Is performed in a new window or dialog.** For example, Preferences, Report a Problem, and Customize Toolbar all use ellipses because they open a new window (sometimes another app) or dialog in which the user makes a selection or inputs other information. Consider that the absence of an ellipsis implies the app will handle the action immediately. This means that the app will automatically generate a report or customize its own toolbar. Using an ellipsis makes the important distinction that the user will be writing the report or selecting which toolbar items to show.
* **Warns the user of a potentially dangerous action.** For example, Log Out, Restart, and Shut Down all use ellipses because they display an alert that asks the user to confirm or cancel a potentially harmful action. Again, this is the user clicking a button or menu item that requires them to input more information or make a selection before the action is completed.

### Shortened Text {#shortened-text}

Ellipses should be used when shortening text that cannot fit in any specific place. For example, if a playlist's name is longer than the space available in the sidebar, truncate it and use an ellipsis to signify that it's been truncated. There are two ways to use an ellipsis when shortening text:

* End truncation. If the important or distinctive text is at the beginning of the string, truncate it at the end and append an ellipsis.
* Middle truncation. When the end of the text is more important or distinctive, truncate the text in the middle and replace the truncated text with an ellipsis.

If you're unsure, it's best to use middle truncation as it keeps both the beginning and end of the string in tact. It's also important that you do not ship your app with any truncated text; truncation should only be the result of a user action such as resizing a sidebar or entering custom text.

### When Not to Use Ellipsis {#when-not-to-use-ellipsis}

* In an entry's placeholder text. An ellipsis is not necessary here and adds no value.
* For a submenu item. The right arrow already indicates that this entry spawns a submenu and is not an action.

--------------------------------------

Be sure to use the actual ellipsis character (…) rather than three consecutive period (.) characters.

## Naming Menu Items {#naming-menu-items}

Menu items should have names that are either actions or locations, never descriptions. Make sure menu items are concise, but also fully describe the action that will be performed when they are clicked.

"Find in Page..." is acceptable as it clearly describes the action that will be performed when the item is clicked. "Software Up to Date" is not acceptable. What happens if I click this item? Where will it take me? What will it do? The outcome is uncertain.
