# Avoid Configuration {#avoid-configuration}

If possible, completely avoid presenting any settings or configuration in your app. Providing settings is usually an easy way out of making design decisions about an app's behavior. But just like with problems of feature bloat, settings mean more code, more bugs, more testing, more documentation, and more complexity.

## Build for the "Out of The Box" Experience {#build-for-the-out-of-the-box-experience}

Design with sane defaults in mind. elementary apps put strong emphasis on the out of the box experience. If your app has to be configured before a user is comfortable using it, they may not take the time to configure it at all and simply use another app instead.

## Ask the Operating System {#ask-the-operating-system}

Get as much information automatically as possible. Instead of asking a user for their name or their location, ask the system for this information. This cuts down on the amount of things a user has to do before they are able to actually do anything and makes your app look intelligent and integrated.

## Do You Really Need It? {#do-you-really-need-it}

Ask yourself if the configuration option you are adding is really necessary or makes sense to a user. Don't ever ask users to make engineering or design decisions. Configuration should be strictly regulated to either set-up or personal preference.

## When You Absolutely Have To {#when-you-absolutely-have-to}

Keep things contextual. Instead of tucking away preferences in a configuration dialog, think about displaying them in context with the objects they affect (much like how shuffle and repeat options appear near your music library).

If your app needs to be configured before it can be used (like a mail client), present this configuration inside the main window much like a [Welcome Screen](/docs/human-interface-guidelines/welcome-screen). Once again, make sure this is really necessary set-up. Adding unnecessary configuration screens stops users from doing what they wanted to do when they opened your app in the first place.

---------------------------
See Also:

1. [Checkboxes That Kill Your Product](http://limi.net/checkboxes-that-kill) by Alex Limi
2. [Don't Give Your Users Shit Work](http://zachholman.com/posts/shit-work/) by Zach Holman

#### Next Page: [Minimal Documentation](/docs/human-interface-guidelines/minimal-documentation) {.text-right}