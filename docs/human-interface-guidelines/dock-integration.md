# Dock Integration {#dock-integration}

By integration with Pantheon's dock, apps are able to communicate their status to the user at a glance.

![](/images/docs/human-interface-guidelines/dock-integration/dock.png)

## Progressbars {#progressbars}

A progressbar must be unambiguous in it's use, referring to a single specific task. For example, a progressbar can be used to indicate the status of a file transfer or of a lengthy process like encoding. A progressbar should not be used to compound the progress of multiple types of actions.

* **Good Example**: Installation progress in Software Center
* **Bad Example**: Combined progress of downloading an album, burning a CD, and syncing a mobile device in Noise

## Badges {#badges}

A badge shows a count of actionable items which your app manages. It's purpose is to inform the user that there are items that require user attention or action without being obtrusive. This is a passive notification. A badge should not show totals or rarely changing counters. If the badge is not easily dismissed when the user views your app, it is likely that this is not a good use of a badge.

* **Good Example**: Unread messages in Geary
* **Bad Example**: Total number of Photos in Shotwell

#### Next Page: [System Indicators](/docs/human-interface-guidelines/system-indicators) {.text-right}