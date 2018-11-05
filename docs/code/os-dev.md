# elementary OS Development
Want to contribute code to elementary OS itself? Here are some tips.

## GtkInspector
Use the [GtkInspector](https://wiki.gnome.org/Projects/GTK+/Inspector) to make development easier.

## Build dependencies
Instead of manually installing all dependencies mentioned in a package's readme you can install them by running:
```bash
sudo apt build-dep <packagename>
```
This doesn't work when changed dependencies have not been released yet.

## Wingpanel
When developing *Wingpanel* or *Wingpanel* related packages like the *Applications menu* and indicators you want to start the *Wingpanel* from the command line to view logs. *Wingpanel* is automatically started and restarted by *Cerbere*. To remove *Wingpanel* from it's monitored applications follow these steps:
1. Install the *Dconf Editor* using the *AppCenter*.
1. Go to: `/io/elementary/desktop/cerbere/monitored-processes`
1. Disable "Use default value",
1. Change the "Custom value" to: `['plank']`
1. In Terminal run: `killall wingpanel` to stop the current Wingpanel
1. Start wingpanel by running: `wingpanel`

To restore normal behavior simply enable "Use default value" again. *Cerbere* will notice this and start to monitor *Wingpanel* again.

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
