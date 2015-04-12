# The Attach Method {#the-attach-method}

While we can use `Gtk.Grid` simply to create single row or single column layouts with the add method, we can also use it to create row-and-column-based layouts with the `attach` method. First we’re going to create a new `Gtk.Grid` and set both column and row spacing, then we’ll create all the widgets we want to attach to our grid, and finally we’ll attach them.

    var layout = new Gtk.Grid ();
    layout.column_spacing = 6;
    layout.row_spacing = 6;

    var hello_button = new Gtk.Button.with_label ("Say Hello");
    var hello_label = new Gtk.Label (null);

    var rotate_button = new Gtk.Button.with_label ("Rotate");
    var rotate_label = new Gtk.Label ("Horizontal");

Make sure to give the Grid, Buttons, and Labels unique names that you’ll remember. It’s best practice to use descriptive names so that people who are unfamiliar with your code can understand what a widget is for without having to know your app inside and out.

    // add first row of widgets
    layout.attach (hello_button, 0, 0, 1, 1);
    layout.attach_next_to (hello_label, hello_button, Gtk.PositionType.RIGHT, 1, 1);

    // add second row of widgets
    layout.attach (rotate_button, 0, 1, 1, 1);
    layout.attach_next_to (rotate_label, rotate_button, Gtk.PositionType.RIGHT, 1, 1);

    this.add (layout);

Notice that the attach method takes 5 arguments:

1. The widget that you want to attach to the grid.
2. The column number to attach to starting at 0.
3. The row number to attach to starting at 0.
4. The number of columns the widget should span.
5. The number of rows the widget should span.

You can also use `attach_next_to` to place a widget next to another one on [all four sides](http://references.valadoc.org/#!api=gtk+-3.0/Gtk.PositionType). Don’t forget to add the functionality associated with our buttons:

    hello_button.clicked.connect (() => {
        hello_label.label = "Hello World!";
        hello_button.sensitive = false;
    });

    rotate_button.clicked.connect (() => {
        rotate_label.angle = 90;
        rotate_label.label = "Vertical";
        rotate_button.sensitive = false;
    });

You’ll notice in the example code above that we’ve created a 2 x 2 grid with buttons on the left and labels on the right. The top label goes from blank to “Hello World!” and the button label is rotated 90 degrees. Notice how we gave the buttons labels that directly call out what they do to the other labels.

## Review {#review}

Let’s recap what we learned in this section:

* We learned about the building blocks of Gtk and the importance of subclasses
* We packed multiple children into a Window using `Gtk.Grid`
* We set the properties of `Gtk.Grid` including its orientation and spacing
*  We added multiple widgets into a single Gtk.Grid using the attach method to create complex layouts containing Buttons and Labels that did cool stuff.

Now that you understand more about Gtk, Grids, and using Buttons to alter the properties of other widgets, try packing other kinds of widgets into a window like a Toolbar and changing other properties of [Labels](http://valadoc.org/#!api=gtk+-3.0/Gtk.Label) like `width_chars` and `ellipsize`. Don’t forget to play around with the attach method and widgets that span across multiple rows and columns. Remember that Valadoc is super helpful for learning more about the methods and properties associated with widgets.

#### Next Page: [Reference](/docs/code/reference) {.text-right}