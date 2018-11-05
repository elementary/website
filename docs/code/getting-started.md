# Getting Started {#getting-started}

Welcome to the elementary developer guide! This book was created to teach you all about creating and distributing apps for elementary OS. The introduction will make sure that you have all the tools for the job and a solid understanding of what this book is about. Some of you may feel confident enough to jump straight into coding. If that's the case, you might want to skip ahead and start writing your first app.

However, we strongly recommend to at least skim through this preparation step. Having the right setup is going to help you reach your goals faster, and having a solid foundation is going to help you throughout the rest of this book.

## What We Will And Won't Cover {#what-we-will-and-wont-cover}

We're going to assume that you have absolutely no experience in writing apps for elementary OS. But we will assume some basic programming knowledge, and hopefully a little experience in Vala or at least similarly syntaxed languages. If you're not familiar with Vala, we highly encourage you to brush up on it before coming here.

We’re also not covering design too much in this guide; that’s what the [Human Interface Guidelines](/docs/human-interface-guidelines) (HIG) are for, and you’re highly encouraged to take a look there before beginning your app. We're going to assume you have a basic knowledge of (or at least a quick link to) the HIG and focus on coding. However, elementary OS is all about great design and stellar consistency. It’s important you grasp these concepts before moving on.

In this book, we're going to talk about building apps using GTK+, Granite, and other tech available in elementary OS, setting up a build system, hosting your code for collaborative development, working with translations, a few other bits and pieces, and finally packaging and distributing your new app.

# The Basic Setup {#the-basic-setup}

Before we even think about writing code, you'll need a certain basic setup. This chapter will walk you through the process of getting set up. We will cover the following topics:

* Creating an account on GitHub and importing an SSH key
* Setting up the Git revision control system
* Getting and using the elementary developer "SDK"

We’re going to assume that you’re working from a clean installation of elementary OS Juno Beta or later. This is important as the instructions you’re given may reference apps that are not present (or even available) in other GNU/Linux based operating systems like Ubuntu. It is possible to apply the principles of this guide to Ubuntu development, but it may be more difficult to follow along.

## GitHub {#github}

GitHub is an online platform for hosting code, reporting issues, tracking milestones, making releases, and more. If you're planning to publish your app through AppCenter, you'll need a GitHub account. If you already have an account, feel free to move on to the next section. Otherwise, [sign up for a GitHub account](https://github.com/join) and return when you're finished.

## Git {#git}

To download and upload to GitHub, you'll need the Terminal program `git`. Git is a type of [revision control system](https://en.wikipedia.org/wiki/Version_control) that allows multiple developers to collaboratively develop and maintain code while keeping track of each revision along the way.

If you're ready, let's get you set up to use Git:

1. Open the Terminal and install Git

    ```bash
    sudo apt install git
    ```

2. We need to inform Git who we are so that when we upload code it is attributed correctly. Inform Git of your identity with the following commands


    ```bash
    git config --global user.name "Your Name"
    git config --global user.email "You@email.com"
    ```

3. To authenticate and transfer code securely, you’ll need to generate an [SSH](https://en.wikipedia.org/wiki/Secure_Shell) key pair (a kind of fingerprint for your computer) and import your public key to GitHub. Type the following in Terminal:

    ```bash
    ssh-keygen -t rsa
    ```
4. When prompted, press <kbd>Enter</kbd> to accept the default file name for your key. You can choose to protect your key with a password or press <kbd>Enter</kbd> again to use no password when pushing code.

5. Now we're going to import your public key to GitHub. View your public SSH key with the following command, then copy the text that appears

    ```bash
    cat ~/.ssh/id_rsa.pub
    ```
6. Visit [your SSH keys page](https://github.com/settings/keys) and click the green button in the upper right-hand corner that says "New SSH key". Paste your key in the "Key" box and give it a title.

We're all done! Now you can download source code hosted on GitHub and upload your own code. We'll revisit using `git` in a bit, but for now you're set up. For a more in-depth intro to Git, we recommend [Codecademy's course on Git](https://www.codecademy.com/learn/learn-git).

## Developer "SDK" {#developer-sdk}

At the time of this writing, elementary OS doesn't have a full SDK like Android or iOS. But luckily, we only need a couple simple apps to get started writing code.

### Code {#code}

![](images/thirdparty-icons/apps/128/io.elementary.code.svg)

The first piece of our simple "SDK" is Code. This comes by default with elementary OS. It comes with some helpful features like syntax highlighting, auto-save, and a Folder Manager. There are other extensions for Code as well, like the Outline, Terminal, Word Completion, or Devhelp extensions. Play around with what works best for you.

### Terminal {#terminal}

![](images/icons/apps/128/utilities-terminal.svg)

We’re going to use Terminal in order to compile our code, push revisions to GitHub (using `git`), and other good stuff. Throughout this guide, we’ll be issuing Terminal commands. You should assume that any command is executed from the directory “Projects” in your home folder unless otherwise stated. Since elementary OS doesn’t come with that folder by default, you’ll need to create it.

Open Terminal and issue the following command:

```bash
mkdir Projects
```

### Development Libraries {#development-libraries}

![](images/icons/apps/128/application-default-icon.svg)

In order to build apps you're going to need their development libraries. We can fetch a basic set of libraries and other development tools with the following terminal command:

```bash
sudo apt install elementary-sdk
```

And with that, we're ready to dive into development! Let's move on!

# Hello World {#hello-world}

The first app we’ll create will be a basic and generic “Hello World”. We’ll walk through the steps of creating folders to store our source code, compiling our first app, and pushing the project to a Git branch. Let’s begin.

## Setting Up {#setting-up}

Apps on elementary OS are organized into standardized directories contained in your project's "root" folder. Let's create a couple of these to get started:

1. Create your root folder called "gtk-hello"
2. Create a folder inside that one called "src". This folder will contain all of our source code.

Later on, We'll talk about adding other directories like "po" and "data". For now, this is all we need.

## Gtk.Application {#gtk-application}

Now what you've been waiting for! We're going to create a window that contains a button. When pressed, the button will display the text "Hello World!" To do this, we're going to use a widget toolkit called GTK+ and the programming language Vala. Before we begin, we highly recommend that you do not copy and paste. Typing each section manually will help you to practice and remember. Let's get started:

1. Create a new file in Code and save it as "Application.vala" inside your "src" folder

2. First we create a special class called a `Gtk.Application`. `Gtk.Application` is a class that handles many important aspects of a Gtk+ app like uniqueness and the ID you need to identify your app to the notifications server. If you want some more details about `Gtk.Application`, [check out Valadoc](https://valadoc.org/gtk+-3.0/Gtk.Application). For now, type the following in your "Application.vala".

        public class MyApp : Gtk.Application {

            public MyApp () {
                Object (
                    application_id: "com.github.yourusername.yourrepositoryname",
                    flags: ApplicationFlags.FLAGS_NONE
                );
            }

            protected override void activate () {
                var main_window = new Gtk.ApplicationWindow (this);
                main_window.default_height = 300;
                main_window.default_width = 300;
                main_window.title = "Hello World";
                main_window.show_all ();
            }

            public static int main (string[] args) {
                var app = new MyApp ();
                return app.run (args);
            }
        }

    You'll notice that most of these property names are pretty straightforward. Inside `MyApp ()` we set a couple of properties for our `Gtk.Application` object, namely our app's ID and [flags](https://valadoc.org/gio-2.0/GLib.ApplicationFlags.html). The first line inside the `activate` method creates a new `Gtk.ApplicationWindow` called `main_window`. The fourth line sets the window title that you see at the top of the window. We also must give our window a default size so that is does not appear too small for the user to interact with it. Then in our `main ()` method we create a new instance of our `Gtk.Application` and run it.

    Ready to test it out? Fire up your terminal and make sure you're in "~/Projects/gtk-hello/src". Then execute the following commands to compile and run your first Gtk+ app:

    ```bash
    valac --pkg gtk+-3.0 Application.vala
    ./Application
    ```

    Do you see a new, empty window called "Hello World"? If so, congratulations! If not, read over your source code again and look for errors. Also check the output of your terminal. Usually there is helpful output that will help you track down your mistake.

3. Now that we've defined a nice window, let's put a button inside of it. Add the following to your application at the beginning of the `activate ()` function:

        var button_hello = new Gtk.Button.with_label ("Click me!");
        button_hello.margin = 12;
        button_hello.clicked.connect (() => {
            button_hello.label = "Hello World!";
            button_hello.sensitive = false;
        });

    Then add this line right before `main_window.show_all ()`:

        main_window.add (button_hello);

    Any ideas about what happened here? We've created a new `Gtk.Button` with the label "Click me!". Then we add a margin to the button so that it doesn't bump up against the sides of the window. We've said that if this button is clicked, we want to change the label to say "Hello World!" instead. We've also said that we want to make the button insensitive after it's clicked; We do this because clicking the button again has no visible effect. Finally, we add the button to our `Gtk.ApplicationWindow` and declare that we want to show all of the window's contents.

    Compile and run your application one more time and test it out. Nice job! You've just written your first Gtk+ app!

## Pushing to GitHub {#pushing-to-github}

After we do anything significant, we must remember to push our code. This is especially important in collaborative development where not pushing your code soon enough can lead to unintentional forks and pushing too much code at once can make it hard to track down any bugs introduced by your code.

1. First we need to create a new repository on GitHub. Visit [the new repository page](https://github.com/new) and create a new repository for your code.

2. Open Terminal and make sure you're in your project's root directory "~Projects/gtk-hello", then issue the following commands

```bash
git init
git add src/Application.vala
git commit -m "Create initial structure. Create window with button."
git remote add origin git@github.com:yourusername/yourrepositoryname.git
git push -u origin master
```

Remember to replace `yourusername` with your GitHub username and `yourrepositoryname` with the name of the new repository you created.

With these commands, we've told `git` to track revisions in this folder, that we'd like to track revisions on the file "Application.vala" specifically, we've committed our first revision and explained what we did in the revision, and then we've told `git` to push your code to GitHub.

## Victory! {#victory}

Let's recap what we've learned to do in this first section:

* We created a new project containing a "src" folder
* We created our main vala file and inside it we created a new `Gtk.Window` and `Gtk.Button`
* We built and ran our app to make sure that everything worked properly
* Finally, we commited our first revision and pushed code to GitHub

Feel free to play around with this example. Make the window a different size, set different margins, make the button say other things. When you're comfortable with what you've learned, go on to the next section.

## A Note About Libraries {#a-note-about-libraries}

Remember how when we compiled our code, we used the `valac` command and the argument `--pkg gtk+-3.0`? What we did there was make use of a "library". If you're not familiar with the idea of libraries, a library is a collection of methods that your program can use. So this argument tells `valac` to include the GTK+ library (version 3.0) when compiling our app.

In our code, we've used the `Gtk` "Namespace" to declare that we want to use methods from GTK+ (specifically, `Gtk.Window` and `Gtk.Button.with_label`). Notice that there is a hierarchy at play. If you want to explore that hierarchy in more detail, you can [check out Valadoc](https://valadoc.org/gtk+-3.0/Gtk.Button).

# Our First App {#our-first-app}

In the previous chapter, we created a simple "Hello World!" app to show off our vala and Gtk skills. But what if we wanted to share our new app with a friend? They'd have to know which packages to include with the `valac` command we used to build our app, and after they'd built it they'd have to run it from the build directory like we did. Clearly, we need to do some more stuff to make our app fit for people to use, to make it a *real* app.

## Hello (again) World! {#hello-again-world}

To create our first real app, we're going to need all the old stuff that we used in the last example. But don't just copy and paste! Let's take this time to practice our skills and see if we can recreate the last example from memory. Additionally, now that you have the basics, we're going to get a little more complex and a little more organized:

1. Create a new folder inside "~/Projects" called "hello-again".Then, go into "hello-again" and create our directory structure including the "src" folder.

2. Create "Application.vala" in the "src" folder.  This time we're going to prefix our file with a small legal header. More about legal stuff later. For now you can copy [the GPL header from our reference documentation](https://elementary.io/docs/code/reference#gpl-header). Be sure to assign the copyright to yourself at the top of the header and change the author to you at the bottom of the header.

3. Now, let's create a `Gtk.Application`, a `Gtk.ApplicationWindow`, and set the window's default properties. Refer back to the last chapter if you need a refresher.

4. For the sake of time let's just put a `Gtk.Label` instead of a `Gtk.Button`. We don't need to try to make the label do anything when you click it.

        var label = new Gtk.Label ("Hello Again World!");

    Don't forget to add it to your window and show the window's contents:

        main_window.add (label);
        main_window.show_all ();

5. Build "Application.vala" just to make sure it all works. If something goes wrong here, feel free to refer back to the last chapter and remember to check your terminal output for any hints.

6. Initialize the branch, add your files to the project, and write a commit message using what you learned in the last chapter. Lastly, make sure you've created a new repository for your project on GitHub push your first revision with `git`:

    ```bash
    git remote add origin git@github.com:yourusername/yourrepositoryname.git
    git push -u origin master
    ```

Everything working as expected? Good. Now, let's get our app ready for other people to use.

## The .desktop File {#the-desktop-file}

Every app comes with a .desktop file. This file contains all the information needed to display your app in the Applications Menu and in the Dock. Let's go ahead and make one:

1. In your project's root, create a new folder called "data".

2. Create a new file in Code and save it in the "data" folder as "com.github.yourusername.yourrepositoryname.desktop". This naming scheme is called [Reverse Domain Name Notation](https://en.wikipedia.org/wiki/Reverse_domain_name_notation) and will ensure that your .desktop file has a unique file name.

3. Type the following into your .desktop file. Like before, try to guess what each line does.

        [Desktop Entry]
        Name=Hello Again
        GenericName=Hello World App
        Comment=Proves that we can use Vala and Gtk
        Categories=Utility;Education;
        Exec=com.github.yourusername.yourrepositoryname
        Icon=application-default-icon
        Terminal=false
        Type=Application
        Keywords=Hello;World;Example;

    The first line declares that this file is a "Desktop Entry" file. The next three lines are descriptions of our app: The branded name of our app, a generic name for our app, and a comment that describes our app's function. Next, we categorize our app. Then, we say what command will execute it. Finally, we give our app an icon (a generic one included in elementary OS) and let the OS know that this isn't a command line app. For more info about crafting .desktop files, check out [this HIG entry](/docs/human-interface-guidelines#app-launchers).

4. Finally, let's add this file to `git` and commit a revision:

    ```bash
    git add data/com.github.yourusername.yourrepositoryname.desktop
    git commit -am "Add a .desktop file"
    git push
    ```

## AppData.xml {#appdata}

Every app also comes with an .appdata.xml file. This file contains all the information needed to list your app in AppCenter.

1. In your data folder, create a new file called "com.github.yourusername.yourrepositoryname.appdata.xml". Just like with the .desktop file, we use RDNN to avoid file naming collisions.

2. Type the following into your .appdata.xml file

        <?xml version="1.0" encoding="UTF-8"?>
        <!-- Copyright 2018 Your Name <you@email.com> -->
        <component type="desktop">
          <id>com.github.yourusername.yourrepositoryname</id>
          <metadata_license>CC0</metadata_license>
          <name>Your App's Name</name>
          <summary>A Catchy Tagline</summary>
          <description>
            <p>A quick summary of your app's main selling points and features. Just a couple sentences per paragraph is best.</p>
          </description>
        </component>

These are all the mandatory fields for displaying your app in AppCenter. There are plenty of other optional fields that you can read about [here](https://www.freedesktop.org/software/appstream/docs/chap-Metadata.html).

There are also some special custom fields for AppCenter to further brand your listing. Specifically, you can set a background color and a text color for your app's header and banner. You can do so by adding the following keys inside the `component` tag:

      <custom>
         <value key="x-appcenter-color-primary">#603461</value>
         <value key="x-appcenter-color-primary-text">rgb(255, 255, 255)</value>
         <value key="x-appcenter-suggested-price">5</value>
      </custom>

You can specificy colors here in either Hexidecimal or RGB. The background color will automatically be given a slight gradient in your app's banner.

You can also specify a suggested price in whole USD. Remember though that AppCenter is a pay-what-you-want store. This is not a price floor. Users will still be able to choose any price they like, including 0.

## Legal Stuff {#legal-stuff}

Since we're going to be putting our app out into the wild, we should include some information about who wrote it and the legal usage of its source code. For this we need a new file in our project's root folder: COPYING.

The COPYING file contains a copy of the license that your code is released under. For elementary OS apps this is typically the [GNU General Public License](http://www.gnu.org/licenses/quick-guide-gplv3.html) (GPL). Remember the header we added to our source code? That header reminds people that your app is licensed and it belongs to you. You can choose other licenses like the MIT license as well, but for this example let's stick to the [GPL](http://www.gnu.org/licenses/gpl-3.0.txt).

## Mark Your Progress {#mark-your-progress}

Did you remember to add these files to `git` and commit a revision? Each time we add a new file or make a significant change it's a good idea to commit a new revision and push to GitHub. Keep in mind that this acts as a backup system as well; when we push our work to GitHub, we know it's safe and we can always revert to a known good revision if we mess up later.

Now that we've got all these swanky files laying around, we need a way to tell the computer what to do with them. Ready for the next chapter? Let's do this!

# The Build System {#the-build-system}

The next thing we need is a build system. The build system that we're going to be using is called [Meson](http://mesonbuild.com/). We already installed the `meson` program at the beginning of this book when we installed `elementary-sdk`. What we're going to do in this step is create the files that tell Meson how to install your program. This includes all the rules for building your source code as well as correctly installing your .desktop and appdata files and the binary app that results from the build process.

Create a new file in your project's root folder called "meson.build". We've included some comments along the way to explain what each section does. You don't have to copy those, but type the rest into that file:

        # project name and programming language
        project('com.github.yourusername.yourrepositoryname', 'vala', 'c')

        # Create a new executable, list the files we want to compile, list the dependencies we need, and install
        executable(
            meson.project_name(),
            'src/Application.vala',
            dependencies: [
                dependency('gtk+-3.0')
            ],
            install: true
        )

        #Install our .desktop file so the Applications Menu will see it
        install_data(
            join_paths('data', meson.project_name() + '.desktop'),
            install_dir: join_paths(get_option('datadir'), 'applications')
        )

        #Install our .appdata.xml file so AppCenter will see it
        install_data(
            join_paths('data', meson.project_name() + '.appdata.xml'),
            install_dir: join_paths(get_option('datadir'), 'metainfo')
        )

And you're done! Your app now has a real build system. Don't forget to add these files to `git` and push to GitHub. This is a major milestone in your app's development!

## Building and Installing with Meson {#building-and-installing-with-meson}

Now that we have a build system, let's try it out:

1. Configure the build directory using Meson:

    ```bash
    meson build --prefix=/usr
    ```

    This command tells Meson to get ready to build our app using the prefix "/usr" and that we want to build our app in a clean directory called "build". The `meson` command defaults to installing our app locally, but we want to install our app for all users on the computer.

2. Change into the build directory and use `ninja` to build. Then, if the build is successful, install with `sudo ninja install`:

    ```bash
    cd build
    ninja
    sudo ninja install
    ```

If all went well, you should now be able to open your app from the Applications Menu and pin it to the Dock.  If you were about to add the "build" folder to your `git` repository and push it, stop! This binary was built for your computer and we don't want to redistribute it. In fact, we built your app in a separate folder like this so that we can easily delete or ignore the "build" folder and it won't mess up our app's source code.

We'll revisit Meson again later to add some more complicated behavior, but for now this is all you need to know to give your app a proper build system. If you want to explore Meson a little more on your own, you can always check out [Meson's documentation](http://mesonbuild.com/Manual.html).

## Review {#the-build-system-review}

Let's review all we've learned to do:

* Create a new Gtk app using `Gtk.Window`, `Gtk.Button`, and `Gtk.Label`
* Keep our projects organized into branches
* License our app under the GPL and declare our app's authors in a standardized manner
* Create a .desktop file using RDNN that tells the computer how to display our app in the Applications Menu and the Dock
* Set up a Meson build system that contains all the rules for building our app and installing it cleanly

That's a lot! You're well on your way to becoming a bonified app developer for elementary OS. Give yourself a pat on the back, then take some time to play around with this example. Change the names of files and see if you can still build and install them properly. Ask another developer to clone your repo from GitHub and see if it builds and installs cleanly on their computer. If so, you've just distributed your first app! When you're ready, we'll move onto the next section: Translations.

# Adding Translations {#Adding-Translations}

Now that you've learned about Meson, the next step is to make your app able to be translated to different languages. The first thing you need to know is how to convert strings in your code into translatable strings. Here's an example:

        stdout.printf ("Not Translatable string");
        stdout.printf (_("Translatable string!"));

        string normal = "Another non-translatable string";
        string translated = _("Another translatable string");

See the difference? We just added `_()` around the string! Well, that was easy! Go back to your project and make all your strings translatable by adding `_()`.

Now we have to make some changes to our Meson build system and add a couple new files to describe which files we want to translate and which languages we want to translate into.

1. Open up your "meson.build" file and add these lines below your project declaration:

        # Include the translations module
        i18n = import('i18n')

        # Set our translation domain
        add_global_arguments('-DGETTEXT_PACKAGE="@0@"'.format (meson.project_name()), language:'c')

2. Remove the lines that install your .desktop and appdata files and replace them with the following:

        #Translate and install our .desktop file
        i18n.merge_file(
            input: join_paths('data', meson.project_name() + '.desktop.in'),
            output: meson.project_name() + '.desktop',
            po_dir: join_paths(meson.source_root(), 'po'),
            type: 'desktop',
            install: true,
            install_dir: join_paths(get_option('datadir'), 'applications')
        )

        #Translate and install our .appdata file
        i18n.merge_file(
            input: join_paths('data', meson.project_name() + '.appdata.xml.in'),
            output: meson.project_name() + '.appdata.xml',
            po_dir: join_paths(meson.source_root(), 'po'),
            install: true,
            install_dir: join_paths(get_option('datadir'), 'metainfo')
        )

    The `merge_file` method combines translating and installing files, similarly to how the `executable` method combines building and installing your app.

3. Still in this file, add the following as the last line:

        subdir('po')

4. You might have noticed in step 2 that the `merge_file` method has an `input` and `output`. We're going to append the additional extension `.in` to our .desktop and .appdata.xml files so that this method can take the untranslated files and produce translated files with the correct names.

    ```bash
    git mv data/com.github.yourusername.yourrepositoryname.desktop data/com.github.yourusername.yourrepositoryname.desktop.in
    git mv data/com.github.yourusername.yourrepositoryname.appdata.xml data/com.github.yourusername.yourrepositoryname.appdata.xml.in
    ```

   We use the `git mv` command here instead of renaming in the file manager or with `mv` so that `git` can keep track of the file rename as part of our revision history.

5. Now, Create a directory named "po" in the root folder of your project. Inside of your po directory you will need to create another "meson.build" file. This time, its contents will be:

        i18n.gettext(meson.project_name(),
          args: [
            '--directory=' + meson.source_root(),
            '--from-code=UTF-8'
          ]
        )

6. Inside of "po" create another file called "POTFILES" that will contain paths to all of the files you want to translate. For us, this looks like:

        src/Application.vala
        data/com.github.yourusername.yourrepositoryname.desktop.in
        data/com.github.yourusername.yourrepositoryname.appdata.xml.in

7. We have one more file to create in the "po" directory. This file will be named "LINGUAS" and it should contain the two-letter language codes for all languages you want to provide translations for. As an example, let's add German and Spanish

        de
        es

8. Now it's time to go back to your build directory and generate some new files! The first one is our translation template or `.pot` file:

        ninja com.github.yourusername.yourrepositoryname-pot

    After running this command you should notice a new file in the po directory containing all of the translatable strings for your app.

9. Now we can use this template file to generate translation files for each of the languages we listed in the LINGUAS file with the following command:

        ninja com.github.yourusername.yourrepositoryname-update-po

    You should notice two new files in your po directory called `de.po` and `es.po`. These files are now ready for translaters to localize your app!

10. Last step. Don't forget to add all of the new files we created in the po directory to git:

    ```bash
    git add src/Application.vala meson.build po/ data/
    git commit -am "Add translations"
    git push
    ```

That's it! Your app is now fully ready to be translated. Remember that each time you add new translatable strings or change old ones, you should regenerate your .pot and po files using the `-pot` and `-update-po` build targets from the previous two steps. If you want to support more languages, just list them in the LINGUAS file and generate the new po file with the `-update-po` target. Don't forget to add any new po files to git!

# Packaging {#packaging}

While having a build system is great, our app still isn't ready for regular users. We want to make sure our app can be built and installed without having to use Terminal. What we need to do is package our app. To do this, we use the Debian packaging format (.deb) on elementary OS. This section will teach you how to package your app as a .deb file, which is required to publish apps in AppCenter. This will allow normal people to install your app and even get updates for it when you publish them.

## Practice Makes Perfect {#practice-makes-perfect}

If you want to get really good really fast, you're going to want to practice. Repetition is the best way to commit something to memory. So let's recreate our entire Hello World app again *from scratch*:

1. Create a new branch folder "hello-packaging"
2. Set up our directory structure including the "src" and "data" folders.
3. Add your Copying, .desktop, .appdata.xml, and source code.
4. Now set up the Meson build system and translations.
5. Test everything!

Did you commit and push to GitHub for each step? Keep up these good habits and let's get to packaging this app!

## Debian Control {#debian-control}

Now it's time to create the rules that will allow your app to be built as a .deb package. Let's dive right in:

1. elementary maintains a simple version of the "debian" folder that contains all the files we need for packaging. Let's grab a copy of that with `git`:

    ```bash
    git clone git@github.com:elementary/debian-template.git
    ```

2. Copy the "debian" folder from that branch into your "hello-packaging" folder.

3. Use the tool `dch -i` to update your changelog. It should automatically generate something like below:

        com.github.yourusername.yourrepositoryname (0.1) bionic; urgency=medium

          * Initial Release.

         -- Your Name <you@emailaddress.com>  Friday, 20 Apr 2018 04:53:39 -0500

     The first line contains your app's binary name, version, OS codename, and how urgently your package should be built. After the `*` is a list of your changes. Finally, you include your name, email address, and the date. For more information about the debian changelog, make sure to read the [documentation](https://www.debian.org/doc/debian-policy/#document-ch-source).

4. Open the file called "control" and make it look like below:

        Source: com.github.yourusername.yourrepositoryname
        Section: x11
        Priority: extra
        Maintainer: Your Name <you@emailaddress.com>
        Build-Depends: debhelper (>= 10.5.1),
                       gettext,
                       libgtk-3-dev (>= 3.10),
                       meson,
                       valac (>= 0.28.0)
        Standards-Version: 4.1.1

        Package: com.github.yourusername.yourrepositoryname
        Architecture: any
        Depends: ${misc:Depends}, ${shlibs:Depends}
        Description: Hey young world
         This is a Hello World written in Vala using Meson build system.

5. Open the file called "copyright". We only need to edit what's up top:

        Format: http://dep.debian.net/deps/dep5
        Upstream-Name: hello-packaging
        Source: https://github.com/yourusername/yourrepositoryname

        Files: src/* data/* debian/*
        Copyright: 2018 Your Name <you@emailaddress.com>
        License: GPL-3.0+

That wasn't too bad right? We'll set up more complicated packaging in the future, but for now this is all you need. If you'd like you can always read [more about Debian packaging](https://www.debian.org/doc/debian-policy/).

Note that Debian packaging is _very_ picky about whitespace, so if you're running into errors, make sure you're not adding, changing, or removing whitespace from the original template files.

If you're packaging your app for elementary OS 0.4 Loki, you will also need to update the "rules" file to work with Meson. You can see an example [here](https://github.com/cassidyjames/principles/blob/ef84ed129bdeaec613b0c457c766cb9aa9ac1bfb/debian/rules). If you are targeting elementary OS 5.0 Juno or newer, this is not necessary.

# Creating Layouts {#creating-layouts}

Now that you know how to code, build, and package an app using Vala, Gtk, Meson, and Debian packaging, it’s time to learn a little bit more about how to build out your app into something really useful. The first thing we need to learn is how to lay out widgets in our window. But we have a fundamental problem: We can only add one widget (one “child”) to `Gtk.Window`. So how do we get around that to create complex layouts in a Window? We have to add a widget that can contain multiple children. One of those widgets is `Gtk.Grid`.

## Widgets as Subclasses of Other Widgets {#widgets-as-subclasses-of-other-widgets}

Before we get into `Gtk.Grid`, let’s stop for a second and take some time to understand Gtk a little better. At the lower level, Gtk has classes that define some pretty abstract traits of widgets such as [`Gtk.Container`](https://valadoc.org/gtk+-3.0/Gtk.Container) and [`Gtk.Orientable`](https://valadoc.org/gtk+-3.0/Gtk.Orientable). These aren’t widgets that we’re going to use directly in our code, but they’re used as building blocks to create the widgets that we do use. It’s important that we understand this, because it means that when we understand how to add children to a `Gtk.Container` like `Gtk.Grid`, we also understand how to add children to a `Gtk.Container` like `Gtk.Toolbar`. Both Grid and Toolbar are widgets that are subclasses of the more abstract class `Gtk.Container`.

If you want to understand more about these widgets and the parts of Gtk that they subclass, jump over to [Valadoc](https://valadoc.org/) and search for a widget like `Gtk.Grid`. See that big tree at the top of the page? It shows you every component of Gtk that `Gtk.Grid` subclasses and even what those components subclass. Having a lower level knowledge of Gtk will help you to implement widgets you haven’t worked with before since you will understand how their parent classes work.

## Gtk.Grid {#gtk-grid}

Now that we’ve gotten that out of the way, let’s get back to our Window and `Gtk.Grid`. Since you’re a master developer now, you can probably set up a new project complete with Meson, push it to GitHub, and set up Debian Packaging in your sleep. If you want the practice, go ahead and do all of that again. Otherwise, it’s probably convenient for our testing purposes to just play around locally and build from Terminal. So code up a nice `Gtk.Window` without anything in it and make sure that builds. Ready? Let’s add a Grid.

Just like when we add a Button or Label, we need to create our `Gtk.Grid`. As always, don’t copy and paste! Practice makes perfect. We create a new Gtk.Grid like this:

    var grid = new Gtk.Grid ();
    grid.orientation = Gtk.Orientation.VERTICAL;

Remember that Button and Label accepted an argument (a String) in the creation method (that’s the stuff in parentheses and quotes). As shown above, `Gtk.Grid` doesn’t accept any arguments in the creation method. However, you can still change the grid’s properties (like [orientation](https://valadoc.org/gtk+-3.0/Gtk.Orientation)) as we did on the second line. Here, we’ve declared that when we add widgets to our grid, they should stack vertically.

Let’s add some stuff to the Grid:

    grid.add (new Gtk.Label (_("Label 1")));
    grid.add (new Gtk.Label (_("Label 2")));

Super easy stuff, right? We can add the grid to our window using the same method that we just used to add widgets to our grid:

    main_window.add (grid);

Now build your app and see what it looks like. Since we’ve given our grid a `Gtk.Orientation` of `VERTICAL` the labels stack up on top of each other. Try creating a `Gtk.Grid` without giving it an orientation. By default, `Gtk.Grid`’s orientation is horizontal. You really only ever have to give it an orientation if you need it to be vertical.

## Functionality in Gtk.Grid {#functionality-in-gtk-grid}

Okay, so you know all about using a `Gtk.Grid` to pack multiple children into a Window. What about using it to lay out some functionality in our app? Let’s try building an app that shows a message when we click a button. Remember in our first “Hello World” how we changed the label of the button with `button.clicked.connect`? Let’s use that method again, but instead of just changing the label of the button, we’re going to use it to change an empty label to a message.

Let’s create a Window with a vertical Grid that contains a Button and a Label:

    var grid = new Gtk.Grid ();
    grid.orientation = Gtk.Orientation.VERTICAL;
    grid.row_spacing = 6;

    var button = new Gtk.Button.with_label (_("Click me!"));
    var label = new Gtk.Label (null);

    grid.add (button);
    grid.add (label);

    main_window.add (grid);

This time when we created our grid, we gave it another property: `row_spacing`. We can also add `column_spacing`, but since we’re stacking widgets vertically we’ll only see the effect of `row_spacing`. Notice how we can create new widgets outside the grid and then pack them into the grid by name. This is really helpful when you start using different methods to change the properties of your widgets.

Now, let’s hook up the button to change that label. To keep our code logically separated, we’re going to add it below `main_window.add (grid);`. In this way, the first portion of our code defines the UI and the next portion defines the functions that we associated with the UI:

    button.clicked.connect (() => {
        label.label = _("Hello World!");
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

    main_window.add (layout);

Notice that the attach method takes 5 arguments:

1. The widget that you want to attach to the grid.
2. The column number to attach to starting at 0.
3. The row number to attach to starting at 0.
4. The number of columns the widget should span.
5. The number of rows the widget should span.

You can also use `attach_next_to` to place a widget next to another one on [all four sides](https://valadoc.org/gtk+-3.0/Gtk.PositionType). Don’t forget to add the functionality associated with our buttons:

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

Now that you understand more about Gtk, Grids, and using Buttons to alter the properties of other widgets, try packing other kinds of widgets into a window like a Toolbar and changing other properties of [Labels](https://valadoc.org/gtk+-3.0/Gtk.Label) like `width_chars` and `ellipsize`. Don’t forget to play around with the attach method and widgets that span across multiple rows and columns. Remember that Valadoc is super helpful for learning more about the methods and properties associated with widgets.

# Notifications {#notifications}

By now you've probably already seen the white notification bubbles that appear on the top right of the screen. Notifications are a simple way to notify a user about the state of your app. For example, they can inform the user that a long process has been completed or a new message has arrived. In this section we are going to show you just how to get them to work in your app. Let's begin by making a new project!

## Making Preparations {#making-preparations}

1. Create a new folder inside of  "~/Projects" called "notifications-app"
2. Create a new folder inside of that folder called "src" and add a file inside of it called ```Application.vala ```
3. Create a `meson.build` file. If you don't remember how to set up Meson, go back to the [previous section](#building-and-installing-with-meson) and review.
4. Remember how to [make a .desktop file](#the-desktop-file)? Excellent! Make one for this project, but this time, since your app will be displaying notifications, add `X-GNOME-UsesNotifications=true` to the end of the file. This is needed so that users will be able to set notification preferences for your app in the system's notification settings.

When using notifications, it's important that your desktop file has the same name as your application's ID. This is because elementary OS uses desktop files to find extra information about the app who sends the notification such as a default icon, or the name of the app. If you don't have a desktop file whose name matches the application id, your notification might not be displayed. To keep things simple, we'll be using the same RDNN everywhere.

## Yet Another Application {#yet-another-application}

In order to display notifications, you're going to need another `Gtk.Application` with a `Gtk.ApplicationWindow`. Remember what we learned in the last few sections and set up a new `Gtk.Application`!

Now that we have a simple window, let's use what we learned in [creating layouts](#gtk-grid) and make a grid containing one button that will show a notification.

In between `var main_window...` and `main_window.show ();`, write the folowing lines of code:

    var grid = new Gtk.Grid ();
    grid.orientation = Gtk.Orientation.VERTICAL;
    grid.row_spacing = 6;

    var title_label = new Gtk.Label (_("Notifications"));
    var show_button = new Gtk.Button.with_label (_("Show"));

    grid.add (title_label);
    grid.add (show_button);

    main_window.add (grid);
    main_window.show_all ();

Since we're adding translatable strings, don't forget to update your translation template by running `make pot`.

## Sending Notifications {#sending-notifications}

Now that we have a Gtk.Application we can send notifications. Let's connect a function to the button we created and use it to send a notification:

    show_button.clicked.connect (() => {
        var notification = new Notification (_("Hello World"));
        notification.set_body (_("This is my first notification!"));
        this.send_notification ("notify.app", notification);
    });

Okay, now compile your new app. if everything works, you should see your new app. Click the "Send" button. Did you see the notification? Great! Don't forget to commit and push your project in order to save your branch for later.

## Additional Features {#Additional-features}

Now that you know how to send basic notifications, let's talk about a couple of ways to make your notifications better. Notifications are most useful when users can identify where they came from and they contain relevant information. In order to make sure your notifications are useful, there are three important features you should know about: setting an icon, replacing a notification, and setting priority.

### Icons {#icons}

In order to make sure users can easily recognize a notification, we should set a relevant icon. Right after the `var notification = New Notification` line, add:

	var icon = new GLib.ThemedIcon ("dialog-warning");
	notification.set_icon (icon);

That's it. Compile your app again, and press the "Send" button. As you can see, the notification now has an icon. Using this method, you can set the icon to anything you'd like. You can use ```gtk3-icon-browser``` to see what system icons are available.

### Replace {#replace}

We now know how to send a notification, but what if you need to update it with new information? Thanks to the notification ID, we can easily replace a notification. The notification ID should be the same as the app ID that we set in `Gtk.Application`.

Let's make the replace button. This button will replace the current notification with one with different information. Let's create a new button for it, and add it to the grid:

	var replace_button = new Gtk.Button.with_label (_("Replace"));
	grid.add (replace_button);

	replace_button.clicked.connect (() => {
		var notification = new Notification (_("Hello Again"));
		notification.set_body (_("This is my second Notification!"));

		var icon = new GLib.ThemedIcon ("dialog-warning");
		notification.set_icon (icon);

		this.send_notification ("com.github.yourusername.yourrepositoryname", notification);
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

`URGENT` notifications should really only be used on the most extreme cases. There are also [other notification priorities](https://valadoc.org/gio-2.0/GLib.NotificationPriority).

## Review {#notifications-review}

Let's review what all we've learned:

- We learned what `Gtk.Application` is and how to make a subclass of it.
- We built an app that sends and updates notifications.
- We also learned about other notification features like setting an icon and a notification's priority.

As you could see, sending notifications is very easy thanks to `Gtk.Application`. If you need some further reading on notifications, Check out the page about `Glib.Notification` in [Valadoc](https://valadoc.org/gio-2.0/GLib.Notification).

# System Integration {#system-integration}

Applications can show additional information in the dock as well as
the application menu. This makes the application feel more integrated into the
system and give user it's status at a glance. See [HIG for Dock integration](https://elementary.io/docs/human-interface-guidelines#dock-integration)
for what you should do and what you shouldn't.

For this integration you can use [Unity's Launcher API](https://valadoc.org/unity/Unity.LauncherEntry.html).
This API is used accross many different distributions and is widely supported by third party applications.

The [Launcher API documentation](https://wiki.ubuntu.com/Unity/LauncherAPI) also provides how the library works internally as well as implementation
examples for Python and C if you wish to use any other language for your application than Vala.

Current Launcher API support:

| Service          | Badge Counter    | Progress Bar    | Static Quicklist    | Dynamic Quicklist |
| ---------------- | :--------------: | :-------------: | :-----------------: | :---------------: |
| Application menu | Yes              | No              | Yes                 | No                |
| Dock             | Yes              | Yes             | Yes                 | Yes               |

## Setting Up {#system-integration-setting-up}

Before writing the code, you must first install the `libunity` library, you can do it by executing the following command in Terminal:

```
sudo apt install libunity-dev
```

Now let's add the Unity library to your build system. Open your meson.build file and add the new dependency to the `executable` method.

        executable(
            meson.project_name(),
            'src/Application.vala',
            dependencies: [
                dependency('gtk+-3.0'),
                dependency('unity')
            ],
            install: true
        )

  Though we haven't made any changes to our source code yet, change into your build directory and run `ninja` to build your project. It should still build without any errors. If you do encounter errors, double check your changes and resolve them before continuing.

## Using the Launcher API {#using-launcher-api}

Once you've set up `libunity` in your build system it's time to write some code.

The first thing you'll need to use the API is your application desktop ID.
This is usually the filename of your application entry that is installed in the `/usr/share/applications`
directory like: `com.github.username.application.desktop`. Keep in mind that if you're generating the desktop file with a build system, the **desktop ID is the final
basename of the file generated by your build system** and not a string ending with `.in` or any other type of extension.

You can retrieve a new [Unity.LauncherEntry](https://valadoc.org/unity/Unity.LauncherEntry.html) instance by calling a static `Unity.LauncherEntry.get_for_desktop_id` function:
```
var entry = Unity.LauncherEntry.get_for_desktop_id ("my-desktop-id.desktop");
```

This entry instance allows you to modify your entry so that it shows additional information e.g: on the dock. It is up to you, where in the code you want to retrieve this entry, the function is static so there is no problem accessing it. Usually it's your application or main window class.

Showing a `12` number in the badge is as easy as:
```vala
entry.count_visible = true;
entry.count = 12;
```

Keep in mind you have to set the `count_visible` property to true, and use an int64 type for the `count` property.

The same goes for showing a progress bar, here we show a progress bar showing 20% progress:
```vala
entry.progress_visible = true;
entry.progress = 0.2f;
```

As you can see the type of `progress` property is `double` and is a range between `0` and `1`: from 0% to 100%.

## Dynamic Quicklists {#dynamic-quicklists}

Dynamic quicklists are a way to provide the user with dynamic quick menu entries to access some kind of
feature in your app. These are shown e.g: right-clicking an open instance of the settings app in the dock. Note that dynamic menu entries can be only provided by a **running** application or processes. **If you always want to expose quick actions in e.g: the Applications Menu**, see [Static Quicklists](#static-quicklists).

Here's a simple example of how to make use of dynamic quicklists in Vala:
```
// Create a root quicklist
var quicklist = new Dbusmenu.Menuitem ();

// Create root's children
var item1 = new Dbusmenu.Menuitem ();
item1.property_set (Dbusmenu.MENUITEM_PROP_LABEL, "Item 1");
item1.item_activated.connect (() => {
    message ("Item 1 activated");
});

var item2 = new Dbusmenu.Menuitem ();
item2.property_set (Dbusmenu.MENUITEM_PROP_LABEL, "Item 2");
item2.item_activated.connect (() => {
    message ("Item 2 activated");
});

// Add children to the quicklist
quicklist.child_append (item1);
quicklist.child_append (item2);

// Finally, tell libunity to show the desired quicklist
entry.quicklist = quicklist;
```
Please see the [Dbusmenu.Menuitem API](https://valadoc.org/dbusmenu-glib-0.4/Dbusmenu.Menuitem.html) for more details and features.

## Static Quicklists {#static-quicklists}

The main difference between dynamic and static quicklists is that static ones cannot be changed at runtime. Static quicklists do not involve writing any code or using any external dependencies.

Static quicklists are stored within your `.desktop` file. These are so called "actions".
You can define many actions in your desktop file that will always show as an action in the
application menu as well as in the dock.

The format is as follows:
```
[Desktop Action ActionID]
Name=The name of the action
Icon=The icon of the action (optional)
Exec=The path to application executable and it's command line arguments (optional)
```

Let's take a look at an example of an action that will open a new window of your application:

```
[Desktop Entry]
Name=Application name
Exec=application-executable
...

[Desktop Action NewWindow]
Name=New Window
Exec=application-executable -n
```

Note that adding `-n` or any other argument will not make your application magically open a new window. It is up to your application to handle and interpret command line arguments. The [GLib.Application API](https://valadoc.org/gio-2.0/GLib.Application.html) provides many examples and an extensive documentation on how to handle these arguments, particularly the [command_line signal](https://valadoc.org/gio-2.0/GLib.Application.command_line.html).

Please take a look at a [freedesktop.org Additional applications actions section](https://standards.freedesktop.org/desktop-entry-spec/latest/ar01s10.html) for a
detailed description of what keys are supported and what they do.

#### Next Page: [Reference](/docs/code/reference) {.text-right}

