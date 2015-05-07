# Background Tasks {#background-tasks}

## Closing the App Window {#closing-the-app-window}

It is not desirable for an app window to simply minimize rather than close when the user attempts to close it. Instead, the app window should be "hidden". If it makes sense to continue a process in the background (such as downloading/transferring, playing music, or executing a terminal command) the app backend should continue with the task and close when the task is finished. If it's not immediately apparent that the process has completed (as with the file download/transfer or terminal command), the app may show a notification informing the user that the process has completed. If it is apparent, as with the music, no notification is necessary.

## Re-Opening the App Window {#re-opening-the-app-window}

If the user re-opens the app while the background process is still executing, the app should be exactly where it would be if the window had been open the whole time. For example, the terminal should show any terminal output, the music player should be on the same page it was when closed, and the browser should come back to the page it was on previously. For more details, see the discussion of app state on a [Normal Launch](/docs/read/human-interface-guidelines/normal-launch).

---
See also: [That's It, We're Quitting](http://design.canonical.com/2011/03/quit/) by Matthew Paul Thomas

#### Next Page: [Always Saved](/docs/human-interface-guidelines/always-saved) {.text-right}