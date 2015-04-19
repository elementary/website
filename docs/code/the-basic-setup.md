# The Basic Setup {#the-basic-setup}

Before we even think about writing code, you'll need a certain basic setup. This chapter will walk you through the process of getting set up. We will cover the following topics:

* Creating an account in launchpad.net and importing an SSH key in Launchpad
* Setting up the Bazaar revision control system
* Getting and using the elementary developer "SDK"

We’re going to assume that you’re working from a clean installation of elementary OS Luna or later. This is important as the instructions you’re given may reference apps that are not present (or even available) in other Linux based operating systems like Ubuntu. It is possible to apply the principles of this guide to Ubuntu development, but it may be more difficult to follow along.

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

        $ sudo apt-get install bzr

3. To authenticate and transfer code securely, you’ll need to generate an [SSH](http://en.wikipedia.org/wiki/Secure_Shell) key pair (a kind of fingerprint for your computer) and import the public key in Launchpad. Type the following in terminal:

        $ sudo apt-get install openssh-client
        $ ssh-keygen -t rsa

4. When prompted, press Enter to accept the default file name for your key.

5. Next, enter a password to protect your SSH key. You’ll be asked to enter it again, just to make sure you didn’t make any typos. You'll need to enter this password any time you try to push code to launchpad so don't forget it! Optionally, you can just press enter and use no password, but this is obviously less secure.

6. Now, we're going to tell Launchpad about your SSH key. Open your SSH key with the following command, then copy the text from the file that opens in Scratch:

        $ scratch-text-editor ~/.ssh/id_rsa.pub

7. Visit [your SSH keys page](https://launchpad.net/people/+me/+editsshkeys). Paste the text in the textbox and click **Import public key**.

8. Now you can connect bzr to your Launchpad account. You'll need your launchpad id, which you can look up at [your launchpad page](https://launchpad.net/people/+me).

        $ bzr launchpad-login your-launchpad-id

Done! Now you can download source code hosted on Launchpad and upload your own code. We'll revisit using bzr in a minute, but for now you're logged in. For a more in-depth introduction to bzr, you can also check the complete [Bazaar User Guide](http://doc.bazaar.canonical.com/latest/en/user-guide) provided by Canonical.

## Developer "SDK" {#developer-sdk}

At the time of this writing, elementary doesn't have a full SDK like Android or iOS. But luckily, we only need a couple simple apps to get started writing code.

### Scratch {#scrath}

![](images/docs/code/the-basic-setup/scratch.png)

The first piece of our simple "SDK" is the text editor Scratch. This comes by default with elementary OS. You may find it helpful to enable the File Manager extension by doing the following:

1. Open Scratch
2. Open the Menu in the top right corner (the gear icon)
3. Choose **Preferences**
4. Choose the tab **Extensions**
5. Check the box for **Folder Manager**

There are other extensions for Scratch as well, like the Outline, Terminal or Devhelp extensions. Play around with what works best for you.

### Terminal {#terminal}

![](images/docs/code/the-basic-setup/terminal.svg)

We’re going to use Terminal in order to compile our code, push revisions to Bazaar (bzr), and other good stuff. Throughout this guide, we’ll be issuing Terminal commands. You should assume that any command is executed from the directory “Projects” in your home folder unless otherwise stated. Since elementary doesn’t come with that folder by default, you’ll need to create it.

Open Terminal and issue the following command:

    $ mkdir Projects

### Development Libraries {#development-libraries}

![](images/docs/code/the-basic-setup/development.png)

In order to build apps you're going to need their development libraries. We can fetch a basic set of libraries with the following terminal command:

    $ sudo apt-get build-dep granite-demo

The command `apt-get build-dep` installs the build dependencies of an app in the repositories. In this case, we're fetching the development libraries needed to build Granite Demo, an example app. We'll talk more about Granite later, but keep in mind that if you want to build an app from source, you can usually get its build dependencies easily by using `apt-get build-dep`.

And with that, we're ready to dive into development! Let's move on!

#### Next Page: [Hello World](/docs/code/hello-world) {.text-right}
