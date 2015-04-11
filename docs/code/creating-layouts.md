# Creating Layouts {#creating-layouts}

Now that you know how to code, build, and distribute an app using Vala, Gtk, CMake, and Launchpad PPAs, it’s time to learn a little bit more about how to build out your app into something really useful. The first thing we need to learn is how to lay out widgets in our window. But we have a fundamental problem: We can only add one widget (one “child”) to `Gtk.Window`. So how do we get around that to create complex layouts in a Window? We have to add a widget that can contain multiple children. One of those widgets is `Gtk.Grid`.

## Widgets as Subclasses of Other Widgets {#widgets-as-subclasses-of-other-widgets}

Before we get into `Gtk.Grid`, let’s stop for a second and take some time to understand Gtk a little better. At the lower level, Gtk has classes that define some pretty abstract traits of widgets such as [`Gtk.Container`](http://valadoc.org/#!api=gtk+-3.0/Gtk.Container) and [`Gtk.Orientable`](http://valadoc.org/#!api=gtk+-3.0/Gtk.Orientable). These aren’t widgets that we’re going to use directly in our code, but they’re used as building blocks to create the widgets that we do use. It’s important that we understand this, because it means that when we understand how to add children to a `Gtk.Container` like `Gtk.Grid`, we also understand how to add children to a `Gtk.Container` like `Gtk.Toolbar`. Both Grid and Toolbar are widgets that are subclasses of the more abstract class `Gtk.Container`.

If you want to understand more about these widgets and the parts of Gtk that they subclass, jump over to [Valadoc](http://valadoc.org/) and search for a widget like `Gtk.Grid`. See that big tree at the top of the page? It shows you every component of Gtk that `Gtk.Grid` subclasses and even what those components subclass. Having a lower level knowledge of Gtk will help you to implement widgets you haven’t worked with before since you will understand how their parent classes work.

## Gtk.Grid {#gtk-grid}

Now that we’ve gotten that out of the way, let’s get back to our Window and `Gtk.Grid`. Since you’re a master developer now, you can probably set up a new project complete with CMake, push it to Launchpad, and build a PPA in your sleep. If you want the practice, go ahead and do all of that again. Otherwise, it’s probably convenient for our testing purposes to just play around locally and build from Terminal. So code up a nice `Gtk.Window` without anything in it and make sure that builds. Ready? Let’s add a Grid.

Just like when we add a Button or Label, we need to create our `Gtk.Grid`. As always, don’t copy and paste! Practice makes perfect. We create a new Gtk.Grid like this:

    var grid = new Gtk.Grid ();
    grid.orientation = Gtk.Orientation.VERTICAL;

Remember that Button and Label accepted an argument (a String) in the creation method (that’s the stuff in parentheses and quotes). As shown above, `Gtk.Grid` doesn’t accept any arguments in the creation method. However, you can still change the grid’s properties (like [orientation](http://valadoc.org/#!api=gtk+-3.0/Gtk.Orientation)) as we did on the second line. Here, we’ve declared that when we add widgets to our grid, they should stack vertically.

Let’s add some stuff to the Grid:

    grid.add (new Gtk.Label ("Label 1"));
    grid.add (new Gtk.Label ("Label 2"));

Super easy stuff, right? We can add the grid to our window using the same method that we just used to add widgets to our grid:

    this.add (grid);

Now build your app and see what it looks like. Since we’ve given our grid a `Gtk.Orientation` of `VERTICAL` the labels stack up on top of each other. Try creating a `Gtk.Grid` without giving it an orientation. By default, `Gtk.Grid`’s orientation is horizontal. You really only ever have to give it an orientation if you need it to be vertical.

#### Next Page: [Functionality in Gtk.Grid](/docs/code/functionality-in-gtkgrid) {.text-right}