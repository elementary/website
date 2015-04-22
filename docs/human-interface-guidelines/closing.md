# Closing {#closing}

When a user closes an app, it's typically because they're done using it for now and they want to get it out of the way.

## Background Tasks {#background-tasks}

If it makes sense for an app to complete background tasks after the window is closed, the tasks should be completed soon after the window is closed. If the app performs repeat background tasks (such as a mail client), the background tasks should be handled by a separate daemon that does not rely on the app itself being open.

## Saving State {#saving-state}

Apps should save their current state when closed so they can be reopened right to where the user left off. Ideally closing and reopening an app should be indistinguishable from the traditional concept of minimizing and unminimizing an app; that is, all elements should be saved including open documents, scroll position, undo history, etc.

---
See also: [That's It, We're Quitting](http://design.canonical.com/2011/03/quit/) by Matthew Paul Thomas

#### Next Page: [Background Tasks](/docs/human-interface-guidelines/background-tasks) {.text-right}