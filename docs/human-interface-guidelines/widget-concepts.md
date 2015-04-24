# Widget Concepts {#widget-concepts}

Before we get into all the widgets available in elementary OS, we need to cover some basic concepts that apply to all widgets. Employing these concepts correctly will create a more seamless experience for your users and help you avoid sifting through bug reports!

## Controls That Do Nothing {#controls-that-do-nothing}

A very common mistake for developers to make is creating controls that seemingly do nothing. Keep in mind that we want to present an environment where users feel comfortable exploring. A curious user will interact with a control expecting there to be some immediate reaction. When a control seemingly does nothing, this creates confusion and can be scary (Think,  "uh-oh I don't know what happened!"). In some cases, controls that do nothing are simply clutter and add unnecessary complexity to your UI.

Consider the "clear" button present in search fields. This button only appears when it is relevant and needed. Clicking this button when the field is already clear essentially does nothing. 

## Sensitivity {#sensitivity}

Sometimes it doesn't make sense for a user to interact with a widget until some pre-requisite is fulfilled. For example, It doesn't make sense to allow a user to click the "Forward" button in a browser unless there is forward history available. In this case, you should make the "Forward" button insensitive or a user may click it, expecting a result, and be confused when nothing happens.

It's usually better to make a widget insensitive than to hide it altogether. Making a widget insensitive informs the user that the functionality is available, but only after a certain condition is met. Hiding the widget gives the impression that the functionality is not available at all or can leave a user wondering why a feature has suddenly "disappeared".

## Hidden Widgets {#hidden-widgets}

When a widget only makes sense in a certain context (not as an indicator of an action to be performed) sometimes it does make more sense to hide it. Take hardware requirements for example: It may not make sense to show multi-display options if the system only has a single display. Making multi-display options insensitive is not really a helpful hint on this system. Another exemption to this rule is a widget that a user will only look for in context, like the clear button example above. Finally, Keep in mind that insensitive items will still be recognized by screen readers and other assistive tech, while hidden widgets will not.

## Spacing {#spacing}

* Windows should have a 12px (minimum) space between any widgets and the window's border.
* Labels should be 12px (minimum) from their widgets.
* If there are section headers present, labels should be indented.
* Horizontal spacing between buttons is 6px.

## Alignment {#alignment}

* Widgets should be "Justified" so that they align on both the left and right sides. Do not include "descriptor" widgets such as icons or labels in this justification.
* Labels should be right aligned with respect to each other when possible.
* Section headers should be left aligned with respect to each other.

---
See also: [Form Label Proximity: Right Aligned is Easier to Scan](http://uxmovement.com/forms/form-label-proximity-right-aligned-is-easier-to-scan) by UX Movement

#### Next Page: [Infobars](/docs/human-interface-guidelines/infobars) {.text-right}