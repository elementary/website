# Functionality in Gtk.Grid {#functionality-in-gtk-grid}

Okay, so you know all about using a `Gtk.Grid` to pack multiple children into a Window. What about using it to lay out some functionality in our app? Let’s try building an app that shows a message when we click a button. Remember in our first “Hello World” how we changed the label of the button with `button.clicked.connect`? Let’s use that method again, but instead of just changing the label of the button, we’re going to use it to change an empty label to a message.

Let’s create a Window with a vertical Grid that contains a Button and a Label:

    var grid = new Gtk.Grid ();
    grid.orientation = Gtk.Orientation.VERTICAL;
    grid.row_spacing = 6;

    var button = new Gtk.Button.with_label ("Click me!");
    var label = new Gtk.Label (null);

    grid.add (button);
    grid.add (label);

    this.add (grid);

This time when we created our grid, we gave it another property: `row_spacing`. We can also add `column_spacing`, but since we’re stacking widgets vertically we’ll only see the effect of `row_spacing`. Notice how we can create new widgets outside the grid and then pack them into the grid by name. This is really helpful when you start using different methods to change the properties of your widgets.

Now, let’s hook up the button to change that label. To keep our code logically separated, we’re going to add it below `this.add (grid);`. In this way, the first portion of our code defines the UI and the next portion defines the functions that we associated with the UI:

    button.clicked.connect (() => {
        label.label = "Hello World!";
        button.sensitive = false;
    });

Remember, we set the button as insensitive here because clicking it again has no effect. Now compile your app and marvel at your newfound skills. Play around with orientation and spacing until you feel comfortable.

#### Next Page: [The Attach Method](/docs/code/the-attach-method) {.text-right}