# Concision {#concision}

Always work to make your app instantly understandable. The main function of your app should be immediately apparent. You can do this in a number of ways, but one of the best ways is by sticking to a principal of concision.

## Avoid Feature Bloat {#avoid-feature-bloat}

It's often very tempting to continue adding more and more features into your application. However, it is important to recognize that every new feature has a price. Specifically, every time you add a new feature:

* Your application gets slower, consumes more resources, and takes up more disk space.
* Your application's interface becomes more cluttered and thus harder to use.
* More time is spent implementing this new feature, rather than perfecting an old feature.
* More code can often mean a greater possibility for bugs.
* More features means more work on documentation, translations, etc.

## Think in Modules {#think-in-modules}

Build small, modular apps that communicate well. elementary apps avoid feature overlap and make their functions available to other apps either through [Contractor](./contractor) or over [D-Bus](http://www.freedesktop.org/wiki/Software/dbus "View D-Bus docs from FreeDesktop.Org"). This both saves you time as a developer (by other apps making their functions available to you), and is a courteous gesture towards other developers (by making your app's functions available to them).

#### Next Page: [Avoid Configuration](/docs/human-interface-guidelines/avoid-configuration) {.text-right}