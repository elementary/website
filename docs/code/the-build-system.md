# The Build System {#the-build-system}

The next thing we need is a build system. The build system that we're going to be using is called [CMake](http://www.cmake.org). We already installed the `cmake` program at the beginning of this book when we got the build dependencies for Granite Demo. What we're going to do in this step is get a copy of some additional modules for Cmake (support for Vala, translations, etc), and create the files that tell Cmake how to install your program. This includes all the rules for building your source code as well as correctly installing your .desktop file and the binary app that results from the build process.

1. The elementary apps team maintains a copy of the CMake modules that we're going to need. Make sure you're in "~/Projects" (not in your hello-again folder) and then grab the latest copy of those modules with bzr. Notice that we're not in "~/Projects/hello-world". This is because our cmake modules are not a branch of our Hello World app:

        $ bzr branch  lp:~elementary-apps/+junk/cmake-modules

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

        $ cmake -DCMAKE_INSTALL_PREFIX=/usr ../

    This command tells cmake to get ready to build our app using the prefix "/usr". The `cmake` command defaults to installing our app locally, but we want to install our app for all users on the computer.

3. Build your app with `make` and if successful install it with `sudo make install`:

        $ make
        $ sudo make install

If all went well, you should now be able to open your app from the Applications menu and pin it to the Dock.  If you were about to add the "build" folder to your bzr branch and push it, stop! This binary was built for your computer and we don't want to redistribute it. In fact, we built your app in a separate folder like this so that we can easily delete or ignore the "build" folder and it won't mess up our app's source code.

We'll revisit CMake again later to add some more complicated behavior, but for now this is all you need to know to give your app a proper build system. If you want to explore CMake a little more on your own, you can always check out [CMake's documentation](http://www.cmake.org/cmake/help/documentation.html).

## Review {#review}
Let's review what all we've learned to do:

* Create a new Gtk app using `Gtk.Window`, `Gtk.Button`, and `Gtk.Label`
* Keep our projects organized into branches
* License our app under the GPL and declare our app's authors in a standardized manner
* Create a .desktop file that tells the computer how to display our app in the Applications menu and the Dock
* Set up a CMake build system that contains all the rules for building our app and installing it cleanly

That's a lot! You're well on your way to becoming a bonified app developer for elementary OS. Give yourself a pat on the back, then take some time to play around with this example. Change the names of files and see if you can still build and install them properly. Ask another developer to branch your project from launchpad and see if it builds and installs cleanly on their computer. If so, you've just distributed your first app! When you're ready, we'll move onto the next section: Packaging.

#### Next Page: [Packaging](/docs/code/packaging) {.text-right}