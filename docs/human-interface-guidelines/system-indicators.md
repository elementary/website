# System Indicators {#system-indicators}

Indicators are small icons that live on the top panel. They give users a place to glance for a quick indication of various settings or events. Clicking the icon shows a small menu with related actions available to the user.

![](/images/docs/human-interface-guidelines/system-indicators/systray.png)

## Does Your App Need An Indicator? {#does-your-app-need-an-indicator}

The indicator area is notorious for becoming cluttered and having inconsistent behavior. Given that users will probably install many third party apps, we need to be careful about how many indicators we're showing and how they behave. Keep in mind that not every application needs an indicator. Only a very small set of apps will benefit from one. You do not need an indicator if:

* **The indicator will only appear while your app's main window is open.** LibUnity already provides a great API for showing application statuses on your app's icon in the dock. Only use an indicator if it will show while your app's main window is closed.

* **You want a persistent/smaller launcher.** ​Launchers are already stored in the dock in a way that gives the user control over persistence and size. The indicator area should never be used for an app launcher. If you want to add special actions to your launcher, Quicklists should be used, not an indicator.

* **The application is for IM, IRC, e-mail, news-reading, or music playback.** Instead, integrate the application with the existing messaging or sound menus.

---
See also: [Farewell To The Notification Area](http://design.canonical.com/2010/04/notification-area/) by Matthew Paul Thomas

#### Next Page: [UI Toolkit Elements](/docs/human-interface-guidelines/ui-toolkit-elements) {.text-right}