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

## Debian Control {#packaging}

Now it's time to create the rules that will allow your app to be built as a .deb package. Let's dive right in:

1. Like CMake, elementary maintaines a simple version of the "debian" folder that contains all the files we need for packaging. Let's grab a copy of that with bzr:

        $ bzr branch lp:~elementary-apps/+junk/debian-template

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
                       valac-0.16 | valac (>= 0.16)
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

3. When you get down to a set of checkboxes with the header "Default distribution series", make sure you select "Precise". elementary OS Luna shares it's core with Ubuntu Precise, so packages built on Precise will also work on Luna.

4. For recipe text, we're going to change it ever so slightly to conform better with the official Debian rules. Change out the first line for this one:

        # bzr-builder format 0.3 deb-version {debupstream}+r{revno}-0

    Notice that this is ever so slightly different from the default line which includes `{debupstream}-0~{revno}` instead of `{debupstream}+r{revno}-0`.

5. When you're happy with the options you've chosen, select **Create Recipe**.

Now that you've created a recipe, you only have to wait until Launchpad finishes the build! If everything goes as planned, your new PPA will contain a packaged app which other people can install and run with ease. Additionally, anyone using your PPA will be able to get updates for your app if you upload a new version. We'll talk more about how to do that later.

#### Next Page: [Creating Layouts](/docs/code/creating-layouts) {.text-right}