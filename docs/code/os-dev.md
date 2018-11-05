# elementary OS Development
Want to contribute code to elementary OS itself? Here are some tips.

## Vala linting
To make it easier to follow the [elementary Code-Style guidelines](https://elementary.io/docs/code/reference#code-style) you can use [Vala-lint](https://github.com/elementary/vala-lint).

## GtkInspector
Use the [GtkInspector](https://wiki.gnome.org/Projects/GTK+/Inspector) to make development easier.

## Build dependencies
Instead of manually installing all dependencies mentioned in a package's readme you can install them by running:
```bash
sudo apt build-dep <packagename>
```
This doesn't work when changed dependencies have not been released yet.

## Restoring original packages
You can audit your system for files that have been changed from their originally installed packages:
```bash
sudo apt install debsums
sudo debsums_init
```
View changed files:
```bash
sudo debsums -cs
```
View which packages those files belong to:
```bash
sudo debsums -c | xargs -rd '\n' -- dpkg -S | cut -d : -f 1 | sort -u
```
Assuming that you've used `--prefix=/usr` when installing custom version you can restore them using:
```bash
sudo apt install appname --reinstall
```

## Wingpanel
When developing *Wingpanel* or *Wingpanel* related packages like the *Applications menu* and indicators you want to start the *Wingpanel* from the command line to view logs. *Wingpanel* is automatically started and restarted by *Cerbere*. To remove *Wingpanel* from it's monitored applications follow these steps:
1. Install the *Dconf Editor* using the *AppCenter*.
1. Go to: `/io/elementary/desktop/cerbere/monitored-processes`
1. Disable "Use default value",
1. Change the "Custom value" to: `['plank']`
1. In Terminal run: `killall wingpanel` to stop the current Wingpanel
1. Start wingpanel by running: `wingpanel`

To restore normal behavior simply enable "Use default value" again. *Cerbere* will notice this and start to monitor *Wingpanel* again.

## Gala
*Gala* is the window manager of elementary OS. When it crashes or freezes it can be difficult to get going again. Here's how to do it:
1. Go to one of the virtual consoles by pressing: <kbd>Ctrl</kbd> + <kbd>Alt</kbd> + <kbd>F1</kbd>.
2. Login.
3. If *Gala* didn't crash but froze, you can kill it by running `killall gala`.
4. You unfortunatly can't start *Gala* from here, so we start a *Terminal* by running: `DISPLAY=:0 io.elementary.terminal`.
5. Switch back to the graphical session by pressing: <kbd>Ctrl</kbd> + <kbd>Alt</kbd> + <kbd>F7</kbd>.
6. In the newly opened *Terminal* restart *Gala* by running: `(gala -r &) &`.

*Gala* should start and you can close the *Terminal*. If *Gala* can't start, you can reinstall the latest stable version by running: `sudo apt install --reinstall gala`.
