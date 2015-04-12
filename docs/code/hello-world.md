# Hello World {#hello-world}

The first app we’ll create will be a basic and generic “Hello World”. We’ll walk through the steps of creating folders to store our source code, compiling our first app, and pushing the project to a bzr branch. Let’s begin.

## Setting Up {#setting-up}
Apps on elementary OS are organized into standardized directories contained in your project's "root" folder. Let's create a couple of these to get started:

1. Create your root folder called "gtk-hello"
2. Create a folder inside that one called "src". This folder will contain all of our source code.

Later on, We'll talk about adding other directories like "po" and "data". For now, this is all we need.

## Gtk.Window and Gtk.Button {#gtk-window-and-gtk-button}
Now what you've been waiting for! We're going to create a window that contains a button. When pressed, the button will display the text "Hello World!" To do this, we're going to use a widget toolkit called GTK+ and the programming language Vala. Before we begin, we highly recommend that you do not copy and paste. Typing each section manually will help you to practice and remember. Let's get started:

1. Create a new file in Scratch and save it as "gtk-hello.vala" inside your "src" folder

2. First we must create the main function of our new GTK app. Type the following in your "gtk-hello.vala".

        int main (string[] args) {
            Gtk.init (ref args);
        }

3. Now, that we've initialized Gtk, we'll create a new window and declare a few properties of this window. You'll notice that most of these property names are pretty straightforward. Try to guess what each one does and we'll explain in a second. Type the following after the `Gtk.init` line, but before the last bracket:

        var window = new Gtk.Window ();
        window.title = "Hello World!";
        window.set_border_width (12);
        window.set_position (Gtk.WindowPosition.CENTER);
        window.set_default_size (350, 70);
        window.destroy.connect (Gtk.main_quit);

        Gtk.main ();
        return 0;

    The first line creates a new `Gtk.Window` called "window". The second line sets the window title that you see at the top of the window. next, we create a margin inside that window so that widgets don't bump up against the window's edge. Then we tell the window manager that we want to place this window in the center of the screen instead of in the default position (which is usually the top left). We also must give our window a default size so that is does not appear too small for the user to interact with it. Finally, we explain what to do with this process if the main window is closed; In our case, we want to quit.

4. Now that we've defined a nice window, let's put a button inside of it. After our window stuff (but before `Gtk.main` line), leave a new line and then type the following:

        var button_hello = new Gtk.Button.with_label ("Click me!");
        button_hello.clicked.connect (() => {
            button_hello.label = "Hello World!";
            button_hello.set_sensitive (false);
        });

        window.add (button_hello);
        window.show_all ();

    Any ideas about what happened here? We've created a new `Gtk.Button` with the label "Click me!". Then we've said that if this button is clicked, we want to change the label to say "Hello World!" instead. We've also said that we want to make the button insensitive; We do this because clicking the button again has no visible effect. Finally, we add the button to our `Gtk.Window` and declare that we want to show all of the window's contents.

## Compiling and Running your code {#compiling-and-running-your-code}
Ready to test it out? Fire up your terminal and make sure you're in "~/Projects/gtk-hello/src". Then execute the following commands to compile and run your first Gtk app:

    $ valac --pkg gtk+-3.0 gtk-hello.vala
    $ ./gtk-hello

Did it work? If so, congratulations! If not, read over your source code again and look for errors. Also check the output of your terminal. Usually there is helpful output that will help you track down your mistake.

## Pushing to Launchpad {#pushing-to-launchpad}

After we do anything significant, we must remember to push our code. This is especially important in collaborative development where not pushing your code soon enough can lead to unintentional forks and pushing too much code at once can make it hard to track down any bugs introduced by your code. So let's take a minute to revisit our friend `bzr`:

Open Terminal and make sure you're in your project's root directory "~Projects/gtk-hello"

    $ bzr init
    $ bzr add src/gtk-hello.vala
    $ bzr commit -m "Create initial structure. Create window with button."
    $ bzr push lp:~/+junk/gtk-hello

With these commands, we've told `bzr` to track this folder as a branch, that we'd like to track revisions on the file "gtk-hello.vala", we've committed our first revision and explained what we did in the revision, and then we've told `bzr` to push your code to Launchpad in your [junk folder](https://code.launchpad.net/people/+me/).

## Victory! {#victory}

Let's recap what we've learned to do in this first section:

* We created a new project containing a "src" folder
* We created our main vala file and inside it we created a new `Gtk.Window` and `Gtk.Button`
* We built and ran our app to make sure that everything worked properly
* Finally, we commited our first revision and pushed code to Launchpad

Feel free to play around with this example. Make the window a different size, set different margins, make the button say other things. When you're comfortable with what you've learned, go on to the next section.

## A Note About Libraries {#a-note-about-libraries}

Remember how when we compiled our code, we used the `valac` command and the argument `--pkg gtk+-3.0`? What we did there was make use of a "library". If you're not familiar with the idea of libraries, a library is a collection of methods that your program can use. So this argument tells `valac` to include the GTK+ library (version 3.0) when compiling our app.

In our code, we've used the `Gtk` "Namespace" to declare that we want to use methods from GTK+ (specifically, `Gtk.Window` and `Gtk.Button.with_label`). Notice that there is a hierarchy at play. If you want to explore that hierarchy in more detail, you can [check out Valadoc](http://www.valadoc.org/#!api=gtk+-3.0/Gtk.Button).

#### Next Page: [Our First App](/docs/code/our-first-app) {.text-right}