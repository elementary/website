# Getting Started {#getting-started}

Welcome to the elementary Developer Guide! This book was created to teach you all about creating and distributing apps for elementary OS. The introduction will make sure that you have all the tools for the job and a solid understanding of what this book is about. Some of you may feel confident enough to jump straight into coding. If that's the case, you might want to skip ahead and start writing your first app.

However, we strongly recommend to at least skim through this preparation step. Having the right setup is going to help you reach your goals faster, and having a solid foundation is going to help you throughout the rest of this book.

## What We Will And Won't Cover {#what-we-will-and-wont-cover}

We're going to assume that you have absolutely no experience in writing apps for elementary. But we will assume some basic programming knowledge, and hopefully a little experience in Vala or at least similarly syntaxed languages. If you're not familiar with Vala, we highly encourage you to brush up on it before coming here.

We’re also not covering design too much in this guide; that’s what the [Human Interface Guidelines](/docs/human-interface-guidelines) (HIG) are for, and you’re highly encouraged to take a look there before beginning your app. We're going to assume you have a basic knowledge of (or at least a quick link to) the HIG and focus on coding. However, elementary is all about great design and stellar consistency. It’s important you grasp these concepts before moving on.

In this book, we're going to talk about building apps using GTK+, Granite, and other tech available in elementary, setting up a build system, hosting your code for collaborative development, working with translations, a few other bits and pieces, and finally packaging and distributing your new app.

# The Basic Setup {#the-basic-setup}

Before we even think about writing code, you'll need a certain basic setup. This chapter will walk you through the process of getting set up. We will cover the following topics:

* Creating an account in launchpad.net and importing an SSH key in Launchpad
* Setting up the Bazaar revision control system
* Getting and using the elementary developer "SDK"

We’re going to assume that you’re working from a clean installation of elementary OS Freya or later. This is important as the instructions you’re given may reference apps that are not present (or even available) in other Linux based operating systems like Ubuntu. It is possible to apply the principles of this guide to Ubuntu development, but it may be more difficult to follow along.

## Launchpad {#launchpad}

Launchpad is a free online service provided by Canonical, the same people who brought you Ubuntu. It is used as a platform for hosting code, tracking milestones, tracking bugs, proposing designs, making translations, and more. Launchpad is a powerful resource, especially if you are a developer working with others. We're going to be using it for its various features throughout this book, so it's a good idea for you to sign up for an account. If you already have an account, feel free to move on to the next section.

To set up a Launchpad account:

1. Go to [Launchpad.net](https://launchpad.net). Click on **Log in/Register** in the top right corner of the page.

2. Select **I am a new Ubuntu One user** on the left side.

3. Enter your information and click **Create account**.

After you have verified your email your Launchpad account is ready, so let's move on to the next section. Remember, we're not going to go over all the little details in this book. We'll come back to Launchpad a few times later on to use specific features, but if you really want to learn everything there is to know about the website you should read their user guide. Onward!

## Bazaar {#bazaar}

elementary projects are hosted on Launchpad. To interact with the code on Launchpad, we use a distributed [revision control system](http://en.wikipedia.org/wiki/Revision_control) called Bazaar. This allows multiple developers to collaboratively develop and maintain the code while keeping track of each revision along the way.

If you're ready, let's get you set up to use Bazaar:

1. Open the Terminal. You'll be interacting with Bazaar through a simple terminal-based program called bzr.

2. You'll need to install bzr. Simply type the following into the Terminal:

    ```bash
    sudo apt-get install bzr
    ```

3. To authenticate and transfer code securely, you’ll need to generate an [SSH](http://en.wikipedia.org/wiki/Secure_Shell) key pair (a kind of fingerprint for your computer) and import the public key in Launchpad. Type the following in terminal:

    ```bash
    sudo apt-get install openssh-client
    ssh-keygen -t rsa
    ```

4. When prompted, press Enter to accept the default file name for your key.

5. Next, enter a password to protect your SSH key. You’ll be asked to enter it again, just to make sure you didn’t make any typos. You'll need to enter this password any time you try to push code to launchpad so don't forget it! Optionally, you can just press enter and use no password, but this is obviously less secure.

6. Now, we're going to tell Launchpad about your SSH key. Open your SSH key with the following command, then copy the text from the file that opens in Scratch:

    ```bash
    scratch-text-editor ~/.ssh/id_rsa.pub
    ```

7. Visit [your SSH keys page](https://launchpad.net/people/+me/+editsshkeys). Paste the text in the textbox and click **Import public key**.

8. Now you can connect bzr to your Launchpad account. You'll need your launchpad id, which you can look up at [your launchpad page](https://launchpad.net/people/+me).

    ```bash
    bzr launchpad-login your-launchpad-id
    ```

Done! Now you can download source code hosted on Launchpad and upload your own code. We'll revisit using bzr in a minute, but for now you're logged in. For a more in-depth introduction to bzr, you can also check the complete [Bazaar User Guide](http://doc.bazaar.canonical.com/latest/en/user-guide) provided by Canonical.

## Developer "SDK" {#developer-sdk}

At the time of this writing, elementary doesn't have a full SDK like Android or iOS. But luckily, we only need a couple simple apps to get started writing code.

### Scratch {#scrath}

![](images/docs/code/the-basic-setup/scratch.png)

The first piece of our simple "SDK" is the code editor Scratch. This comes by default with elementary OS. It comes with some helpful features like syntax highlighting, auto-save, and the Folder Manager extension. There are other extensions for Scratch as well, like the Outline, Terminal or Devhelp extensions. Play around with what works best for you.

### Terminal {#terminal}

![](images/docs/code/the-basic-setup/terminal.svg)

We’re going to use Terminal in order to compile our code, push revisions to Bazaar (bzr), and other good stuff. Throughout this guide, we’ll be issuing Terminal commands. You should assume that any command is executed from the directory “Projects” in your home folder unless otherwise stated. Since elementary doesn’t come with that folder by default, you’ll need to create it.

Open Terminal and issue the following command:

```bash
mkdir Projects
```

### Development Libraries {#development-libraries}

![](images/docs/code/the-basic-setup/development.png)

In order to build apps you're going to need their development libraries. We can fetch a basic set of libraries with the following terminal command:

```bash
sudo apt-get build-dep granite-demo
```

The command `apt-get build-dep` installs the build dependencies of an app in the repositories. In this case, we're fetching the development libraries needed to build Granite Demo, an example app. We'll talk more about Granite later, but keep in mind that if you want to build an app from source, you can usually get its build dependencies easily by using `apt-get build-dep`.

And with that, we're ready to dive into development! Let's move on!

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

```bash
valac --pkg gtk+-3.0 gtk-hello.vala
./gtk-hello
```

Did it work? If so, congratulations! If not, read over your source code again and look for errors. Also check the output of your terminal. Usually there is helpful output that will help you track down your mistake.

## Pushing to Launchpad {#pushing-to-launchpad}

After we do anything significant, we must remember to push our code. This is especially important in collaborative development where not pushing your code soon enough can lead to unintentional forks and pushing too much code at once can make it hard to track down any bugs introduced by your code. So let's take a minute to revisit our friend `bzr`:

Open Terminal and make sure you're in your project's root directory "~Projects/gtk-hello"

```bash
bzr init
bzr add src/gtk-hello.vala
bzr commit -m "Create initial structure. Create window with button."
bzr push lp:~/+junk/gtk-hello
```

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

# Our First App {#our-first-app}

In the previous chapter, we created a simple "Hello World!" app to show off our vala and Gtk skills. But what if we wanted to share our new app with a friend? They'd have to know which packages to include with the `valac` command we used to build our app, and after they'd built it they'd have to run it from the build directory like we did. Clearly, we need to do some more stuff to make our app fit for people to use, to make it a *real* app.

## Hello (again) World! {#hello-again-world}

To create our first real app, we're going to need all the old stuff that we used in the last example. But don't just copy and paste! Let's take this time to practice our skills and see if we can recreate the last example from memory. Additionally, now that you have the basics, we're going to get a little more complex and a little more organized:

1. Create a new folder in "~/Projects" called "hello-world" and put our last project in that folder. Now create a new folder inside "~/Projects/hello-world" called "hello-again". We're doing this because our first "gtk-hello" and "hello-again" are two branches of the same "hello-world" project. As you get more into collaborative development, you're going to have lots of branches. This method will help you stay organized.

2. Now go into "hello-again" and create our directory structure including the "src" folder.

3. Create "hello-again.vala" in the "src" folder.  This time we're going to prefix our file with a small legal header. More about legal stuff later. For now, just copy and paste this, changing out `YourName` for your actual name:

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

    ```bash
    bzr push lp:~/+junk/hello-again
    ```

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
        Keywords=Hello;World;Example;

    The first line declares that this file is a "Desktop Entry" file. The next three lines are descriptions of our app: The branded name of our app, a generic name for our app, and a comment that describes our app's function. Next, we categorize our app. Then, we say what command will execute it. Finally, we give our app an icon (a generic one included in elementary OS) and let the OS know that this isn't a command line app. For more info about crafting .desktop files, check out [this HIG entry](/docs/human-interface-guidelines/app-launchers).

4. Finally, let's add this file to bzr and commit a revision:

    ```bash
    bzr add data/hello.desktop
    bzr commit -m "Added a .desktop file"
    bzr push
    ```

## Legal Stuff {#legal-stuff}

Since we're going to be putting our app out into the wild, we should include some information about who wrote it and the legal usage of its source code. For this we need two new files in our project's root folder: AUTHORS and COPYING.

### Authors {#authors}

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

# The Build System {#the-build-system}

The next thing we need is a build system. The build system that we're going to be using is called [CMake](http://www.cmake.org). We already installed the `cmake` program at the beginning of this book when we got the build dependencies for Granite Demo. What we're going to do in this step is get a copy of some additional modules for Cmake (support for Vala, translations, etc), and create the files that tell Cmake how to install your program. This includes all the rules for building your source code as well as correctly installing your .desktop file and the binary app that results from the build process.

1. The elementary apps team maintains a copy of the CMake modules that we're going to need. Make sure you're in "~/Projects" (not in your hello-again folder) and then grab the latest copy of those modules with bzr. Notice that we're not in "~/Projects/hello-world". This is because our cmake modules are not a branch of our Hello World app:

    ```bash
    bzr branch lp:~elementary-os/+junk/cmake-modules
    ```

2. You'll see a folder called "cmake". Copy that into your "hello-again" folder. It's that easy.

3. Create a new file in your project's root folder called "CMakeLists.txt". Since this file is a bit long, we've included some comments along the way to explain each section. You don't have to copy those, but type the rest into that file:

        # project name
        project (hello-again)

        # the oldest stable cmake version we support
        cmake_minimum_required (VERSION 2.6)

        # tell cmake where its modules can be found in our project directory
        list (APPEND CMAKE_MODULE_PATH ${CMAKE_SOURCE_DIR}/cmake)

        # where we install data directory (if we have any)
        set (DATADIR "${CMAKE_INSTALL_PREFIX}/share")

        # what to call that directory where we install data too
        set (PKGDATADIR "${DATADIR}/hello-again")

        set (EXEC_NAME "hello-again")
        set (RELEASE_NAME "A hello world.")
        set (VERSION "0.1")
        set (VERSION_INFO "whats up world")

        # we're about to use pkgconfig to make sure dependencies are installed so let's find pkgconfig first
        find_package(PkgConfig)

        # now let's actually check for the required dependencies
        pkg_check_modules(DEPS REQUIRED gtk+-3.0)

        add_definitions(${DEPS_CFLAGS})
        link_libraries(${DEPS_LIBRARIES})
        link_directories(${DEPS_LIBRARY_DIRS})

        # make sure we have vala
        find_package(Vala REQUIRED)
        # make sure we use vala
        include(ValaVersion)
        # make sure it's the desired version of vala
        ensure_vala_version("0.16" MINIMUM)

        # files we want to compile
        include(ValaPrecompile)
        vala_precompile(VALA_C ${EXEC_NAME}
            src/hello-again.vala

        # tell what libraries to use when compiling
        PACKAGES
            gtk+-3.0
        )

        # tell cmake what to call the executable we just made
        add_executable(${EXEC_NAME} ${VALA_C})

        # install the binaries we just made
        install (TARGETS ${EXEC_NAME} RUNTIME DESTINATION bin)

        # install our .desktop file so the Applications menu will see it
        install (FILES ${CMAKE_CURRENT_SOURCE_DIR}/data/hello.desktop DESTINATION ${DATADIR}/applications/)

And you're done! Your app now has a real build system. Don't forget to add these files to bzr and push to launchpad. This is a major milestone in your app's development!

## Building and Installing with CMake {#building-and-installing-with-cmake}

Now that we have a build system, let's try it out:

1. Create a new folder in your project's root folder called "build"

2. Change into this directory in terminal and execute the following command:

    ```bash
    cmake -DCMAKE_INSTALL_PREFIX=/usr ../
    ```

    This command tells cmake to get ready to build our app using the prefix "/usr". The `cmake` command defaults to installing our app locally, but we want to install our app for all users on the computer.

3. Build your app with `make` and if successful install it with `sudo make install`:

    ```bash
    make
    sudo make install
    ```

If all went well, you should now be able to open your app from the Applications menu and pin it to the Dock.  If you were about to add the "build" folder to your bzr branch and push it, stop! This binary was built for your computer and we don't want to redistribute it. In fact, we built your app in a separate folder like this so that we can easily delete or ignore the "build" folder and it won't mess up our app's source code.

We'll revisit CMake again later to add some more complicated behavior, but for now this is all you need to know to give your app a proper build system. If you want to explore CMake a little more on your own, you can always check out [CMake's documentation](http://www.cmake.org/cmake/help/documentation.html).

## Review {#the-build-system-review}
Let's review what all we've learned to do:

* Create a new Gtk app using `Gtk.Window`, `Gtk.Button`, and `Gtk.Label`
* Keep our projects organized into branches
* License our app under the GPL and declare our app's authors in a standardized manner
* Create a .desktop file that tells the computer how to display our app in the Applications menu and the Dock
* Set up a CMake build system that contains all the rules for building our app and installing it cleanly

That's a lot! You're well on your way to becoming a bonified app developer for elementary OS. Give yourself a pat on the back, then take some time to play around with this example. Change the names of files and see if you can still build and install them properly. Ask another developer to branch your project from launchpad and see if it builds and installs cleanly on their computer. If so, you've just distributed your first app! When you're ready, we'll move onto the next section: Packaging.

# Adding Translations {#Adding-Translations}
Now that you've learned about CMake, the next step is to make your app able to be translated to different languages. The first thing you need to know is how to convert strings in your code into translatable strings. Here's an example:

        stdout.printf ("Not Translatable string");
        stdout.printf (_("Translatable string!"));
        
        string normal = "Another non-translatable string";
        string translated = _("Another translatable string");

See the difference? We just added `_()` around the string! Well, that was easy! 

1. Go back to your project and make all your strings translatable by adding `_()`

2. Add the following lines in the "CMakeLists.txt" file you created a moment ago:

        # Translation files
        set (GETTEXT_PACKAGE "${CMAKE_PROJECT_NAME}")
        add_definitions (-DGETTEXT_PACKAGE=\"${GETTEXT_PACKAGE}\")
        add_subdirectory (po)

3. Create a directory named "po" on the root folder of your project. Inside of your po directory you will need to create another CMakeLists.txt file. This time, it's contents will be:

        include (Translations)
            add_translations_directory(${GETTEXT_PACKAGE})
            add_translations_catalog(${GETTEXT_PACKAGE}
            ../src/
        )

4. On your build directory execute the following commands:

    ```bash
    cmake -DCMAKE_INSTALL_PREFIX=/usr ../
    make pot
    ```

5. Don't forget to add this new directory and it's contents to bzr

    ```bash 
    bzr add po/
    bzr commit -m "Added translation files"
    bzr push
    ```

That's it! CMake will automatically add all the string marked with `_()` into a .pot template file, and a file for each available language where you'll place the translatable strings.

# Packaging {#packaging}

While having a build system is great, our app still isn't ready for regular users. We want to make sure our app can be built and installed without having to use Terminal. What we need to do is package our app. To do this, we use the Debian packaging format (.deb) on elementary OS. This section will teach you how to package your app as a .deb file, hosted in a Personal Package Archive (PPA) on Launchpad. This will allow normal people to install your app and even get updates for it in Update Manager.

## Practice Makes Perfect {#practice-makes-perfect}

If you want to get really good really fast, you're going to want to practice. Repetition is the best way to commit something to memory. So let's recreate our entire Hello World app again *from scratch*:

1. Create a new branch folder "hello-packaging"
2. Set up our directory structure including the "src" and "data" folders.
3. Add your Authors, Copying, .desktop, and source code.
4. Now set up the CMake build system.
5. Test everything!

Did you commit and push to launchpad for each step? Keep up these good habits and let's get to packaging this app!

## Debian Control {#debian-control}

Now it's time to create the rules that will allow your app to be built as a .deb package. Let's dive right in:

1. Like CMake, elementary maintaines a simple version of the "debian" folder that contains all the files we need for packaging. Let's grab a copy of that with bzr:

    ```bash
    bzr branch lp:~elementary-apps/+junk/debian-template
    ```

2. Copy the "debian" folder from that branch into your "hello-packaging" folder.

3. Open the file called "changelog" and make it look like below:

        hello-packaging (0.1) precise; urgency=low

          * Initial Release.

         -- Your Name <you@emailaddress.com>  Tue, 9 Apr 2013 04:53:39 -0500

     The first line contains your app's binary name, version, OS codename, and how urgently your package should be built. Remember that your app's binary name is lowercase and does not contain spaces. After the `*` is a list of your changes. Finally, you include your name, email address, and the date. For more information about the debian changelog, make sure to read the [documentation](http://www.debian.org/doc/debian-policy/ch-source.html#s-dpkgchangelog).

4. Open the file called "control" and make it look like below:

        Source: hello-packaging
        Section: x11
        Priority: extra
        Maintainer: Your Name <you@emailaddress.com>
        Build-Depends: cmake (>= 2.8),
                       debhelper (>= 8.0.0),
                       valac-0.26 | valac (>= 0.26)
        Standards-Version: 3.9.3

        Package: hello-packaging
        Architecture: any
        Depends: ${misc:Depends}, ${shlibs:Depends}
        Description: Hey young world
         This is a Hello World written in Vala using CMake build system.

5. Open the file called "copyright". We only need to edit what's up top:

        Format: http://dep.debian.net/deps/dep5
        Upstream-Name: hello-packaging
        Source: https://code.launchpad.net/~your-launchpad-id/+junk/hello-packaging

        Files: src/* data/* cmake/* debian/*
        Copyright: 2013 Your Name <you@emailaddress.com>
        License: GPL-3.0+

That wasn't too bad right? We'll set up more complicated packaging in the future, but for now this is all you need. If you'd like you can always read [more about Debian packaging](http://www.debian.org/doc/debian-policy/).

## Launchpad Recipes {#launchpad-recipes}

Now that we have our "debian" folder in order, it's time to go to launchpad and create a recipe: instructions what code to build, how often to build it, and where to put the resulting packages.

1. [Click this link](https://code.launchpad.net/people/+me/+junk/hello-packaging/+new-recipe) or go to Launchpad, find your hello-packaging branch, then select **Create packaging recipe**.

2. Read through the options available to you. You can go ahead and keep the defaults for Name, Description (it's blank), Owner, Daily builds, and PPA but you can also customize a bit if you'd like.

3. When you get down to a set of checkboxes with the header "Default distribution series", make sure you select "Trusty". elementary OS Freya shares it's core with Ubuntu Trusty, so packages built on Trusty will also work on Freya.

4. For recipe text, we're going to change it ever so slightly to conform better with the official Debian rules. Change out the first line for this one:

        # bzr-builder format 0.3 deb-version {debupstream}+r{revno}-0

    Notice that this is ever so slightly different from the default line which includes `{debupstream}-0~{revno}` instead of `{debupstream}+r{revno}-0`.

5. When you're happy with the options you've chosen, select **Create Recipe**.

Now that you've created a recipe, you only have to wait until Launchpad finishes the build! If everything goes as planned, your new PPA will contain a packaged app which other people can install and run with ease. Additionally, anyone using your PPA will be able to get updates for your app if you upload a new version. We'll talk more about how to do that later.

# Creating Layouts {#creating-layouts}

Now that you know how to code, build, and distribute an app using Vala, Gtk, CMake, and Launchpad PPAs, it’s time to learn a little bit more about how to build out your app into something really useful. The first thing we need to learn is how to lay out widgets in our window. But we have a fundamental problem: We can only add one widget (one “child”) to `Gtk.Window`. So how do we get around that to create complex layouts in a Window? We have to add a widget that can contain multiple children. One of those widgets is `Gtk.Grid`.

## Widgets as Subclasses of Other Widgets {#widgets-as-subclasses-of-other-widgets}

Before we get into `Gtk.Grid`, let’s stop for a second and take some time to understand Gtk a little better. At the lower level, Gtk has classes that define some pretty abstract traits of widgets such as [`Gtk.Container`](http://valadoc.elementary.io/#!api=gtk+-3.0/Gtk.Container) and [`Gtk.Orientable`](http://valadoc.elementary.io/#!api=gtk+-3.0/Gtk.Orientable). These aren’t widgets that we’re going to use directly in our code, but they’re used as building blocks to create the widgets that we do use. It’s important that we understand this, because it means that when we understand how to add children to a `Gtk.Container` like `Gtk.Grid`, we also understand how to add children to a `Gtk.Container` like `Gtk.Toolbar`. Both Grid and Toolbar are widgets that are subclasses of the more abstract class `Gtk.Container`.

If you want to understand more about these widgets and the parts of Gtk that they subclass, jump over to [Valadoc](http://valadoc.elementary.io/) and search for a widget like `Gtk.Grid`. See that big tree at the top of the page? It shows you every component of Gtk that `Gtk.Grid` subclasses and even what those components subclass. Having a lower level knowledge of Gtk will help you to implement widgets you haven’t worked with before since you will understand how their parent classes work.

## Gtk.Grid {#gtk-grid}

Now that we’ve gotten that out of the way, let’s get back to our Window and `Gtk.Grid`. Since you’re a master developer now, you can probably set up a new project complete with CMake, push it to Launchpad, and build a PPA in your sleep. If you want the practice, go ahead and do all of that again. Otherwise, it’s probably convenient for our testing purposes to just play around locally and build from Terminal. So code up a nice `Gtk.Window` without anything in it and make sure that builds. Ready? Let’s add a Grid.

Just like when we add a Button or Label, we need to create our `Gtk.Grid`. As always, don’t copy and paste! Practice makes perfect. We create a new Gtk.Grid like this:

    var grid = new Gtk.Grid ();
    grid.orientation = Gtk.Orientation.VERTICAL;

Remember that Button and Label accepted an argument (a String) in the creation method (that’s the stuff in parentheses and quotes). As shown above, `Gtk.Grid` doesn’t accept any arguments in the creation method. However, you can still change the grid’s properties (like [orientation](http://valadoc.elementary.io/#!api=gtk+-3.0/Gtk.Orientation)) as we did on the second line. Here, we’ve declared that when we add widgets to our grid, they should stack vertically.

Let’s add some stuff to the Grid:

    grid.add (new Gtk.Label (_("Label 1")));
    grid.add (new Gtk.Label (_("Label 2")));

Super easy stuff, right? We can add the grid to our window using the same method that we just used to add widgets to our grid:

    window.add (grid);

Now build your app and see what it looks like. Since we’ve given our grid a `Gtk.Orientation` of `VERTICAL` the labels stack up on top of each other. Try creating a `Gtk.Grid` without giving it an orientation. By default, `Gtk.Grid`’s orientation is horizontal. You really only ever have to give it an orientation if you need it to be vertical.

## Functionality in Gtk.Grid {#functionality-in-gtk-grid}

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
        button.label = _("Hello World!");
        button.sensitive = false;
    });

Remember, we set the button as insensitive here because clicking it again has no effect. Now compile your app and marvel at your newfound skills. Play around with orientation and spacing until you feel comfortable.

## The Attach Method {#the-attach-method}

While we can use `Gtk.Grid` simply to create single row or single column layouts with the add method, we can also use it to create row-and-column-based layouts with the `attach` method. First we’re going to create a new `Gtk.Grid` and set both column and row spacing, then we’ll create all the widgets we want to attach to our grid, and finally we’ll attach them.

    var layout = new Gtk.Grid ();
    layout.column_spacing = 6;
    layout.row_spacing = 6;

    var hello_button = new Gtk.Button.with_label (_("Say Hello"));
    var hello_label = new Gtk.Label (null);

    var rotate_button = new Gtk.Button.with_label (_("Rotate"));
    var rotate_label = new Gtk.Label (_("Horizontal"));

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
        hello_label.label = _("Hello World!");
        hello_button.sensitive = false;
    });

    rotate_button.clicked.connect (() => {
        rotate_label.angle = 90;
        rotate_label.label = _("Vertical");
        rotate_button.sensitive = false;
    });

You’ll notice in the example code above that we’ve created a 2 x 2 grid with buttons on the left and labels on the right. The top label goes from blank to “Hello World!” and the button label is rotated 90 degrees. Notice how we gave the buttons labels that directly call out what they do to the other labels.

## Review {#the-attach-method-review}

Let’s recap what we learned in this section:

* We learned about the building blocks of Gtk and the importance of subclasses
* We packed multiple children into a Window using `Gtk.Grid`
* We set the properties of `Gtk.Grid` including its orientation and spacing
*  We added multiple widgets into a single Gtk.Grid using the attach method to create complex layouts containing Buttons and Labels that did cool stuff.

Now that you understand more about Gtk, Grids, and using Buttons to alter the properties of other widgets, try packing other kinds of widgets into a window like a Toolbar and changing other properties of [Labels](http://valadoc.elementary.io/#!api=gtk+-3.0/Gtk.Label) like `width_chars` and `ellipsize`. Don’t forget to play around with the attach method and widgets that span across multiple rows and columns. Remember that Valadoc is super helpful for learning more about the methods and properties associated with widgets.

# Notifications {#notifications}
By now you've probably already seen the white notification bubbles that appear on the top right of the screen. Notifications are a simple way to notify a user about the state of your app. For example, they can inform the user that a long process has been completed or a new message has arrived. In this section we are going to show you just how to get them to work in your app. Let's begin by making a new project!

## Making Preparations {#making-preparations}
1. Create a new folder inside of  "~/Projects" called "notifications-app"
2. Create a file inside called ```notify-app.vala ```
3. Re-create the `CMake` folder and `CMakeFiles.txt` file. If you don't remember how to set up CMake, go back to the [previous section](#building-and-installing-with-cmake) and review.
4. Remember how to [make a .desktop file](#the-desktop-file)? Excellent! Make one for this project, but this time, name it ```notify.app.desktop``` as ```notify.app ``` will be your app's ID. Since your app will be displaying notifications, add `X-GNOME-UsesNotifications=true` to the end of the file. This is needed so that users will be able to set notification preferences for your app in the system's notification settings. 

When using notifications, it's important that your desktop file has the same name as your application's ID. This is because elementary uses desktop files to find extra information about the app who sends the notification such as a default icon, or the name of the app. If you don't have a desktop file whose name matches the application id, your notification might not be displayed.

## Gtk.Application {#gtk-application}
In order to display notifications, you're going to need your app to subclass `Gtk.Application`. `Gtk.Application` is a class that handles many important aspects of a Gtk app like app uniqueness and the application ID you need to identify your app to the notifications server. If you want some more details about `Gtk.Application`, [check out Valadoc](http://valadoc.elementary.io/#!api=gtk+-3.0/Gtk.Application).

Now that you know what a `Gtk.Application` is, let's create one:

	public class MyApp : Gtk.Application {

		public MyApp () {
			Object (application_id: "notify.app",
			flags: ApplicationFlags.FLAGS_NONE);
		}
    
		protected override void activate () {
			var app_window = new Gtk.ApplicationWindow (this);
    
			app_window.show ();
		}
    
		public static int main (string[] args) {
			var app = new MyApp ();
			return app.run (args);
		}
	}
    
Initiating your app with Gtk.Application is a little different from what we did a few sections back. This time, in `main` you are starting your app with `app.run` and you have a new function called `activate` inside of your class; This `activate` function will be the one that executes when you invoke `app.run`. We are also creating a `Gtk.ApplicationWindow`, this is where you will place all the widgets your app needs. Now that we have a simple window, let's use what we learned in [creating layouts](#gtk-grid) and make a grid containing one button that will show a notification.

In between `var app_window...` and `app_window.show ();`, write the folowing lines of code:

    var grid = new Gtk.Grid ();
    grid.orientation = Gtk.Orientation.VERTICAL;
    grid.row_spacing = 6;

    var title_label = new Gtk.Label (_("Notifications"));
    var show_button = new Gtk.Button.with_label (_("Show"));
    
    grid.add (title_label);
    grid.add (show_button);
    
    app_window.add (grid);
    app_window.show_all ();

Since we're adding translatable strings, don't forget to update your translation template by running `make pot`.


## Sending Notifications {#sending-notifications}
Now that we have a Gtk.Application we can send notifications. Let's connect a function to the button we created and use it to send a notification:

    show_button.clicked.connect (() => {
        var notification = new Notification (_("Hello World"));
        notification.set_body (_("This is my first notification!"));
        this.send_notification ("notify.app", notification);
    });

Okay, now compile your new app. if everythink works, you should see your new app. Click the "Send" button. Did you see the notification? Great! Don't forget to commit and push your project in order to save your branch for later.

## Additional Features {#Additional-features}
Now that you know how to send basic notifications, lets talk about a couple ways to make your notifications better. Notifications are most useful when users can indentify where they came from and they contain relevant information. In order to make sure your notifications are useful, there are three important features you should know about: setting an icon, replacing a notification, and setting priority.

### Icons {#icons} 
In order to make sure users can easily recognize a notification, we should set a relevant icon. Right after the `var notification = New Notification` line, add:

	var image = new Gtk.Image.from_icon_name ("dialog-warning", Gtk.IconSize.DIALOG);
	notification.set_icon (image.gicon);

That's it. Compile your app again, and press the "Send" button. As you can see, the notification now has an icon. Using this method, you can set the icon to anything you'd like. You can use ```gtk3-icon-browser``` to see what system icons are available.

### Replace {#replace}
We now know how to send a notification, but what if you need to update it with new information? Thanks to the notification ID, we can easily replace a notification. The notification ID should be the same as the app ID that we set in `Gtk.Application`.

Let's make the replace button. This button will replace the current notification with one with different information. Let's create a new button for it, and add it to the grid:

	var replace_button = new Gtk.Button.with_label (_("Replace"));
	grid.add (update_button);

	replace_button.clicked.connect (() => {
		var notification = new Notification (_("Hello Again"));
		notification.set_body (_("This is my second Notification!"));

		var image = new Gtk.Image.from_icon_name ("dialog-warning", Gtk.IconSize.DIALOG);
		notification.set_icon (image.gicon);

		this.send_notification ("notify.app", notification);
	});
<!--
Now, let's do the withdraw button:

	var withdraw_button = new Gtk.Button.with_label (_("Withdraw"));
	grid.add (withdraw_button);

	withdraw_button.clicked.connect (() => {
		this.withdraw_notification ("notify-test");
	});
-->

Very easy right? Let's compile and run your app again. Click on the buttons, first on "Show", then "Replace". See how the text on your notification changes without making a new one appear?

### Priority  {#priority}
Notifications also have priority. When a notification is set as `URGENT` it will stay on the screen until either the user interacts with it, or you withdraw it. To make an urgent notification, add the following line before the `this.send_notification ()` function

	notification.set_priority (NotificationPriority.URGENT);

`URGENT` notifications should really only be used on the most extreme cases. There are also [other notification priorities](http://valadoc.elementary.io/#!api=gio-2.0/GLib.NotificationPriority); Notifications with `LOW` priority, for example, are skipped from the notifications indicator.

## Review {#notifications-review}
Let's review what all we've learned:

- We learned what `Gtk.Application` is and how to make a subclass of it. 
- We built an app that sends and updates notifications. 
- We also learned about other notification features like setting an icon and a notification's priority.

As you could see, sending notifications is very easy thanks to `Gtk.Application`. If you need some further reading on notifications, Check out the page about `Glib.Notification` in [Valadoc](http://valadoc.elementary.io/#!api=gio-2.0/GLib.Notification).

#### Next Page: [Reference](/docs/code/reference) {.text-right}
