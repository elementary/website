# elementary OS Development

Want to contribute code to elementary OS itself? Here are some tips.

## Install `elementary-sdk`

First, install `elementary-sdk` from the Terminal:

```bash
sudo apt install elementary-sdk
```

This is a metapackage that depends on several tools we use for development.

## dconf Editor

dconf Editor is an invaluable tool for seeing and modifying settings. It's installed along with `elementary-sdk`.

## Vala linting

To make it easier to follow the [elementary Code-Style guidelines](https://elementary.io/docs/code/reference#code-style) you can use [vala-lint](https://github.com/elementary/vala-lint).

## GtkInspector

The GTK [Inspector](https://wiki.gnome.org/Projects/GTK+/Inspector) is similar to a web browser's inspector, but for GTK apps. Using the Inspector can greatly speed up development, and allows you view and to test out changing properties without recompiling your app. You can also test out temporary in-app CSS.

First, make sure you have the `elementary-sdk` installed. Then enable the Inspector keybinding:

```bash
gsettings set org.gtk.Settings.Debug enable-inspector-keybinding true
```

Focus your app, then launch the Inspector by pressing <kbd>Ctrl</kbd>+<kbd>Shift</kbd>+<kbd>I</kbd> to inspect the widget beaneath your cursoe, or <kbd>Ctrl</kbd>+<kbd>Shift</kbd>+<kbd>D</kbd> to open the inspector without a widget selected.

You can also run it temporarily together with your app by running:

```bash
GTK_DEBUG=interactive your-app
```

## Build dependencies

You can quickly install all known dependencies for a project with `build-dep`:

```bash
sudo apt build-dep <packagename>
```

This installs the dependencies for the currently-released version, so it may miss dependencies for unreleased updates. In those cases, refer to the project's README.

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

## WingPanel

When developing the Panel (codenamed WingPanel) or panel-related packages like the Applications Menu and indicators, you want to start WingPanel from the command line to view logs. WingPanel is automatically started and restarted by Cerbere. To remove WingPanel from its monitored applications:

1. In dconf Editor, browse to `/io/elementary/desktop/cerbere/monitored-processes`
2. Disable "Use default value"
3. Change the "Custom value" to `['plank']`
4. In Terminal run `killall wingpanel` to stop the current WingPanel
5. Start wingpanel by running `wingpanel`

To restore normal behavior simply enable "Use default value" in dconf Editor. Cerbere will notice this and start to monitor WingPanel again.

## Gala

Gala is the window manager of elementary OS. If it crashes or freezes during development, it can be nonobvious how to recover. Here's how to do it:

1. Go to one of the virtual consoles by pressing: <kbd>Ctrl</kbd>+<kbd>Alt</kbd>+<kbd>F1</kbd>
2. Log in
3. If Gala didn't crash but froze, you can kill it by running `killall gala`
4. Restart Gala by running `DISPLAY=:0 gala --replace &`
5. Switch back to the graphical session by pressing <kbd>Ctrl</kbd>+<kbd>Alt</kbd>+<kbd>F7</kbd>

If Gala doesn't start, you can reinstall the latest stable version by running `sudo apt install --reinstall gala`.
