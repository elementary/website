# Search Fields {#search-fields}

Apps that support the searching or filtering of content should include a search field on the right side of the app's toolbar (to the left of the AppMenu). This gives users a predictable place to see whether or not an app supports searching, and a consistent location from which to search. Gtk+ provides a convenient complex widget for this purpose called [Gtk.SearchEntry](http://valadoc.org/#!api=gtk+-3.0/Gtk.SearchEntry).

![](http://elementaryos.org/uploads/content/page/36--5178e401b5771.png)

## Behavior {#behavior}

If it is possible to include search functionality within your app, it is best to do so. Any list or representation of multiple pieces of data should be searchable using a search field that follows these rules:

* Results should be instantly shown as you type. This helps your app to appear faster and is more useful than having to hit "Enter" and wait. Exceptions may be made if the data is not stored locally.
* In most cases, the search should be case-insensitive; users should not be expected to provide the exact capitalization. A good compromise is "smart case" where case is respected whenever the user intentionally types lower and upper case letters.

## Labeling {#labeling}

Search fields should contain hint text that describes what will be search. You can set this using the entry property ["placeholder_text"](http://www.valadoc.org/#!api=gtk+-3.0/Gtk.Entry.placeholder_text).

Most search fields should use the format "Search OBJECTS" where OBJECTS is something to be searched, like Contacts, Accounts, etc.

If the search field interacts with a search service, the hint text should be the name of that service such as "Google" or "Yahoo!".

#### Next Page: [Windows](/docs/human-interface-guidelines/windows) {.text-right}