# Our First App {#our-first-app}

In the previous chapter, we created a simple "Hello World!" app to show off our vala and Gtk skills. But what if we wanted to share our new app with a friend? They'd have to know which packages to include with the `valac` command we used to build our app, and after they'd built it they'd have to run it from the build directory like we did. Clearly, we need to do some more stuff to make our app fit for people to use, to make it a *real* app.

## Hello (again) World! {#hello-again-world}

To create our first real app, we're going to need all the old stuff that we used in the last example. But don't just copy and paste! Let's take this time to practice our skills and see if we can recreate the last example from memory. Additionally, now that you have the basics, we're going to get a little more complex and a little more organized:

1. Create a new folder in "~/Projects" called "hello-world" and put our last project in that folder. Now create a new folder inside "~/Projects/hello-world" called "hello-again". We're doing this because our first "gtk-hello" and "hello-again" are two branches of the same "hello-world" project. As you get more into collaborative development, you're going to have lots of branches. This method will help you stay organized.

2. Now go into "hello-again" and create our directory structure including the "src" folder.

3. Create "hello_again.vala" in the "src" folder.  This time we're going to prefix our file with a small legal header. More about legal stuff later. For now, just copy and paste this, changing out `YourName` for your actual name:

        /* Copyright 2013 YourName
        *
        * This file is part of Hello Again.
        *
        * Hello Again is free software: you can redistribute it
        * and/or modify it under the terms of the GNU General Public License as
        * published by the Free Software Foundation, either version 3 of the
        * License, or (at your option) any later version.
        *
        * Hello Again is distributed in the hope that it will be
        * useful, but WITHOUT ANY WARRANTY; without even the implied warranty of
        * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General
        * Public License for more details.
        *
        * You should have received a copy of the GNU General Public License along
        * with Hello Again. If not, see http://www.gnu.org/licenses/.
        */

4. Now, let's create our main function, a `Gtk.Window`, and set the window's default properties. Refer back to the last chapter if you need a refresher.

5. For the sake of time let's just put a `Gtk.Label` instead of a `Gtk.Button`. We don't need to try to make the label do anything when you click it.

        var label = new Gtk.Label ("Hello Again World!");

    Don't forget to add it to your window and show the window's contents:

        window.add (label);
        window.show_all ();

6. Build "hello-again.vala" just to make sure it all works. If something goes wrong here, feel free to refer back to the last chapter and remember to check your terminal output for any hints.

7. Initialize the branch, add your files to the project, and write a commit message using what you learned in the last chapter. Lastly, push your first revision with `bzr`:

        $ bzr push lp:~/+junk/hello-again

Everything working as expected? Good. Now, let's get our app ready for other people to use.

## The .desktop File {#the-desktop-file}

Every app comes with a .desktop file. This file contains all the information needed to display your app in the Applications menu and in the Dock. Let's go ahead and make one:

1. In your project's root, create a new folder called "data".

2. Create a new file in scratch and save it in the "data" folder as "hello.desktop".

3. Type the following into "hello.desktop". Like before, try to guess what each line does.

        [Desktop Entry]
        Name=Hello Again
        GenericName=Hello World App
        Comment=Proves that we can use Vala and Gtk
        Categories=GTK;Utility;
        Exec=hello-again
        Icon=application-default-icon
        Terminal=false
        Type=Application
        X-GNOME-Gettext-Domain=hello-again
        X-GNOME-Keywords=Hello;World;Example;

    The first line declares that this file is a "Desktop Entry" file. The next three lines are descriptions of our app: The branded name of our app, a generic name for our app, and a comment that describes our app's function. Next, we categorize our app. Then, we say what command will execute it. Finally, we give our app an icon (a generic one included in elementary OS) and let the OS know that this isn't a command line app. For more info about crafting .desktop files, check out [this HIG entry](/docs/human-interface-guidelines/app-launchers).

4. Finally, let's add this file to bzr and commit a revision:

        $ bzr add data/hello.desktop
        $ bzr commit -m "Added a .desktop file"
        $ bzr push

## Legal Stuff {#legal-stuff}

Since we're going to be putting our app out into the wild, we should include some information about who wrote it and the legal usage of its source code. For this we need two new files in our project's root folder: AUTHORS and COPYING.

### Authors {#legal-stuff}

The AUTHORS file is pretty straightforward. This file contains your name and email address along with the name and email address of anyone who helped you make your app. It typically looks like this:
 <!--email_off-->

        Your Name <you@emailaddress.com>
        Your Friend <friend@emailaddress.com>

<!--/email_off-->
### Copying {#copyright}

The COPYING file contains a copy of the license that your code is released under. For elementary apps this is typically the [GNU Public License](http://www.gnu.org/licenses/quick-guide-gplv3.html) (GPL). Remember the header we added to our source code? That header reminds people that your app is licensed and it belongs to you. You can choose other licenses like the MIT license as well, but for this example let's stick to the [GPL](http://www.gnu.org/licenses/gpl-3.0.txt).

## Mark Your Progress {#mark-your-progress}

Did you remember to add these files to bzr and commit a revision? Each time we add a new file or make a significant change it's a good idea to commit a new revision and push to Launchpad. Keep in mind that this acts as a backup system as well; when we push our work to Launchpad, we know it's safe and we can always revert to a known good revision if we mess up later.

Now that we've got all these swanky files laying around, we need a way to tell the computer what to do with them. Ready for the next chapter? Let's do this!

#### Next Page: [The Build System](/docs/code/the-build-system) {.text-right}