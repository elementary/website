# Reference {#reference}

Now that you've stepped through the developer guide like a champ, we have some reference materials for you. This would be a great place to bookmark and refer back to when you have questions about elementary development.

# Code Style {#code-style}

The purpose of this guide is to provide clean and accurate instructions on
writing good code across all elementary projects. This guideline is to be
followed on every file, in order to keep our code consistent and readable. We
are also inheriting some of the GNOME's Vala guidelines to keep our code
consistent with other Vala programs.

If the guidelines here proposed are followed, newcomers to elementary
development will be more easily able to join the development and
understand code. Besides, it'll make it easier for all developers to work on
applications that they don't usually work on, because the code will be
consistent. Finally, as Guido Van Rossum said - "Code is much more often read
than written", so having nicely written code is crucial.

## Whitespace {#whitespace}

There is no trailing whitespace at the end of a line, whether it's empty or
not. There is also no empty line after declaring a function:


    public string get_text () {
        string text = search_entry.get_text ();
        return text;
    }

White space comes before opening parentheses:


    public string get_text () {}
    if (a == 5) {
        return 4;
    }

    for (i = 0; i < maximum; i++) {}
    my_function_name ();
    Object my_instance = new Object ();

Whitespace goes in all maths-related code, between numbers and operators.


    c = n * 2 + 4;

Lines consisting of closing brackets (`}` or `)`) should be followed by an empty 
line, except when followed by another closing bracket or an `else` statement.


    if (condition) {
        // ...
    } else {
        // ...
    }

    // other code


## Indentation {#indentation}

### Vala {#indentation-vala}

Vala code is indented using 4 spaces for consistency and readability.

In classes, functions, loops and general flow control, the first parentheses
is on the end of the first line ("One True Brace Style"), followed by the
indented code, and a line closing the function with a curly bracket:


    public int my_function (int a, string b, long c, int d, int e) {
        if (a == 5) {
            b = 3;
            c += 2;
            return d;
        }

        return e;
    }

On conditionals and loops, always use braces even if there's only one line of code:


    if (my_var > 2) {
        print ("hello\n");
    }

Cuddled else and else if:


    if (a == 4) {
        b = 1;
        print ("Yay");
    } else if (a == 3) {
        b = 3;
        print ("Not so good");
    }

If you are checking the same variable more than twice, use switch/case instead of multiple else/if:

    switch (week_day) {
       case "Monday":
           message ("Let's work!");
           break;
       case "Tuesday":
       case "Wednesday":
           message ("What about watching a movie?");
           break;
       default:
           message ("You don't have any recommendation.");
           break;
    }

### Markup {#indentation-markup}

Markup languages like HTML, XML, and YML should use two-space indentation since they are much more verbose and likely to hit line-length issues sooner.

## Classes and files {#classes-and-files}

Only having one class per file is recommended.

All files have the same name of the class in them.

Separate code into classes for easier extensibility.

## Comments {#comments}

Comments are either on the same line as the code or in a special line.

Comments are indented alongside the code, and obvious comments do more harm
than good.


    /* User chose number five */
    if (a == 5) {
        B = 4;           // Update value of b
        c = 0;           // No need for c to be positive
        l = n * 2 + 4;   // Clear l variable
    }

## Variable names, class names, function names {#variable-names-class-names-function-names}


    my_variable = 5;     // Variable names
    MyClass              // Class names
    my_function_name (); // Type/Function/Method names
    MY_C     // Constants are all caps with underscores

    /* For enum members, all uppercase and underscores */
    enum OperatingSystem { // An enum name is the same as ClassesNames
        UBUNTU,
        ELEMENTARY_OS,
        VERY_LONG_OS_NAME
    }

Also worth referring that there should be no Hungarian notation, and no mix of
any kinds of notations.

## Casting {#casting}

Avoid using `as` keyword when casting as it might give `null` as result, which could be easily forgotten to check.


    /* OK */
    ((Gtk.Entry) widget).max_width_chars

    /* NOT OK as this approach requires a check for null */
    (widget as Gtk.Entry).max_width_chars

## Use of '=' in place of 'set' {#equals-in-place-of-set}

In places or operations where you would otherwise use `set` , you should make use of `=` instead.

For example, instead of using

         set_can_focus (false);

you should use

         can_focus = false;

## Vala namespaces {#vala-namespaces}

Referring to GLib is not necessary. If you want to print something:

    GLib.print ("Hello World");
    print ("Hello World");

Opt for the second one, it's much cleaner.

## GTK events {#gtk-events}

Gtk widgets are intended to respond to click events that can be described
as "press + release" instead of "press". Use `toggle` and `release` events
instead of `press`.

## Columns per line {#columns-per-line}

Ideally, lines should have no more than 80 characters per line, because this
is the default terminal size. However, as an exception, more characters could
be added, because most people have wide-enough monitors nowadays. The hard
limit is 120 characters.

## GPL Header {#gpl-header}

    /*
    * Copyright (c) 2011-2018 Your Organization (https://yourwebsite.com)
    *
    * This program is free software; you can redistribute it and/or
    * modify it under the terms of the GNU General Public
    * License as published by the Free Software Foundation; either
    * version 2 of the License, or (at your option) any later version.
    *
    * This program is distributed in the hope that it will be useful,
    * but WITHOUT ANY WARRANTY; without even the implied warranty of
    * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
    * General Public License for more details.
    *
    * You should have received a copy of the GNU General Public
    * License along with this program; if not, write to the
    * Free Software Foundation, Inc., 51 Franklin Street, Fifth Floor,
    * Boston, MA 02110-1301 USA
    *
    * Authored by: Author <author@example.com>
    */

## EditorConfig {#editorconfig}

If your code editor supports [EditorConfig](https://editorconfig.org/), you can use this as a default `.editorconfig` file in your projects:

```ini
# EditorConfig <https://EditorConfig.org>
root = true

# elementary defaults
[*]
charset = utf-8
end_of_line = lf
indent_size = tab
indent_style = space
insert_final_newline = true
max_line_length = 80
tab_width = 4

# Markup files
[{*.html,*.xml,*.xml.in,*.yml}]
tab_width = 2

```

## Saving Window State {#saving-window-state}

Saving window state (i.e. size and position) should be done consistently across apps. Use the following GSchema keys:

```xml
<key name="window-maximized" type="b">
  <default>false</default>
  <summary>Maximized</summary>
  <description>Whether the window is maximized</description>
</key>
<key name="window-position" type="(ii)">
  <default>(1024, 750)</default>
  <summary>Window position</summary>
  <description>Most recent window position (x, y)</description>
</key>
<key name="window-size" type="(ii)">
  <default>(-1, -1)</default>
  <summary>Window size</summary>
  <description>Most recent window size (width, height)</description>
</key>
```

In your Application.vala, create an instance of `GLib.Settings` to use:

```vala
public static GLib.Settings settings;
static construct {
    settings = new GLib.Settings ("io.elementary.mail");
}
```

Where you define your main window, load your settings:

```vala
main_window = new MainWindow ();

int window_x, window_y;
var rect = Gtk.Allocation ();

settings.get ("window-position", "(ii)", out window_x, out window_y);
settings.get ("window-size", "(ii)", out rect.width, out rect.height);

if (window_x != -1 ||  window_y != -1) {
    main_window.move (window_x, window_y);
}

main_window.set_allocation (rect);

if (settings.get_boolean ("window-maximized")) {
    main_window.maximize ();
}

main_window.show_all ();
```

In your app's window, override its `configure_event` and be sure to throttle writing to GSettings to avoid thrashing the disk:

```vala
public override bool configure_event (Gdk.EventConfigure event) {
    if (configure_id != 0) {
        GLib.Source.remove (configure_id);
    }

    configure_id = Timeout.add (100, () => {
        configure_id = 0;

        if (is_maximized) {
            App.settings.set_boolean ("window-maximized", true);
        } else {
            Mail.Application.settings.set_boolean ("window-maximized", false);

            Gdk.Rectangle rect;
            get_allocation (out rect);
            App.settings.set ("window-size", "(ii)", rect.width, rect.height);

            int root_x, root_y;
            get_position (out root_x, out root_y);
            App.settings.set ("window-position", "(ii)", root_x, root_y);
        }

        return false;
    });

    return base.configure_event (event);
}
```

# Reporting Bugs {#reporting-bugs}

One of the big advantages of being an openly developed project is being able to take part in public bug tracking. However, if you're new to working with public bug tracking, it can be difficult to understand how to report bugs The Right Way™. So let's find out how:

1. Find the "Issues" page for the app in question on [GitHub](https://github.com/elementary). If you open System Settings, select "About" and "Report a Problem", you can select the app to submit an issue. Otherwise, you can search for the app on GitHub, select the "Issues" tab, and then "New Issue" on the right side of the page.
2. When filing a new report, it's a good idea to search the issue list to make sure your report hasn't been filed already. If your report has already been filed by someone else, you should add the <i class="far fa-thumbs-up" title="thumbs up"></i> reaction to the report to indicate that you are also affected. Only comment on the report if you can provide additional useful information that may help track down the source of the issue. Do not comment things like, "I have this problem too" or "This is a really important issue".
3. If your report has not already been filed by someone else and you've reached the "New Issue" page, type in a summary and description of the issue and select "Submit new issue". Keep in mind the following information while filing your report:

## Be Specific In The Summary {#be-specific-in-the-summary}

This will be the title of the issue in the bug tracker. It's very important to be specific because it makes it much easier for a developer or bug manager to search the issue list and helps avoid duplicate reports. A summary such as "App Crashes" is not good and vague requests like "Increase Performance" are not helpful. A good summary is something like "Notification is not sent when process finishes".

## Avoid Subjective or Ambiguous Adjectives {#avoid-subjective-or-ambiguous-adjectives}

This may sound like a repeat of the first heading, but it's important when you want someone to confirm your report. Don't say that something is "jarring" or "unintuitive". Instead describe what happened and contrast it with what you expected to happen. "The panel suddenly appeared instead of being animated in," describes the problem in a way that is actionable and objective.

## Be Concise, But Explain The Issue {#be-concise-but-explain-the-issue}

First of all, it's important to mention that bug reports should be written in English and you should, if possible, watch out for your language and grammar.

The most important thing for a report is that the developer must be able to reproduce the issue. If necessary, include exact numbered steps to reproduce the issue. Include relevant information like your OS version, any modifications you've made to the system (like changing your window manager or kernel), or the version numbers of relevant libraries like Gtk or WebKit. If you're reporting a crash, make sure to [include a backtrace](https://wiki.debian.org/HowToGetABacktrace).

## Be Prepared To Provide More Information {#be-prepared-to-provide-more-information}

If your report does not contain enough information for the developer to reproduce the issue, it may be marked as "Incomplete". Oftentimes, a developer will make a comment requesting additional specific information. If you do not provide that information, your report will eventually be closed.

If you've reported your issue against the wrong app, a developer may mark it as "Invalid". If the developer knows which app you meant to report against, they may ask you to re-file against the correct app. However, if they do not you must find the correct app and re-file the report yourself.

If you're reporting a "Wishlist" issue, like a feature request, a developer may mark your bug as "Opinion" or "Won't Fix". Developers are often open to discussion about these kinds of issues, but please do not harass a developer for marking your report this way.

## You Can Get a Bit of Help {#you-can-get-a-bit-of-help}

If you're not sure about anything above, you are always welcome to chat with community members and developers in the [Community Slack](https://join.slack.com/t/elementarycommunity/shared_invite/enQtMzU1NDU4OTE1MjY2LWUyOTBkZGNkZGM4MDgzZjE2ZjRiZDgwMDQ1ZTA0MzcxYjI0MDUyNGRlNDI5ZWViNDkwMzMwYzczMDY2ZjA0MTc). We might be able to help you track down the actual project where you should report the issue, or perhaps even aid you with any English language issue you might come across. Most developers want to help you make good bug reports.

## Don't Make "Me Too" Comments {#dont-make-me-too-comments}

We mentioned this earlier, but it's worth mentioning again. Do not make comments that simply say "This issue affects me as well". This clutters up the tracker and can make it difficult to find important information that may solve the issue. Only comment if you are providing additional information that helps find the source of the issue. If you only want to let a developer know that you are affected, use the reactions system to add a <i class="far fa-thumbs-up" title="thumbs up"></i>.

# Proposing Design Changes {#proposing-design-changes}

elementary has always been known for its strong focus on great design, but if you’re an up and coming designer you might not know how to get developers to pay attention to you. This reference guide is about how to effectively propose a design change in a way that makes it more likely for your design to become implemented.

## Don't Make Demands {#dont-make-demands}

Let’s say you spent the last few hours re-designing the Search Engine Manager dialog in Midori and you want to bring this work to the attention of Midori’s developers. You could file a bug report something like “Search engine popup sucks” and paste your mockup and be done. But that approach isn’t going to win you any friends and your report will probably be marked “opinion” or “invalid”. Instead, we should consider the amount of work it will take to implement the new design and try to present it in a way that gets developers excited about the overall vision without demanding 1,000 lines of code in one shot.

<span id="use-blueprints"></span>

## Open a GitHub Issue {#open-github-issue}

If you have an idea for a new design that you think would improve a project, file an issue on the respective GitHub repository with your proposal. This will get a response from a team member and will start the design process. Name your issue something explicit and try to avoid titles that marginalize developer’s existing work. Something like “search engine manager redesign” works just fine. In this issue we want to describe our motivations for the redesign. What are the problems with the current design and what does our new design aim to solve? Common reasons for a redesign can include minimizing window chrome, taking advantage of new toolkit elements, making the UI more consistent with other apps, etc. This is also a good place to link to or attach that mockup we were talking about earlier. If your design is really involved, you can even link to an external specification—Google Docs work great for getting feedback, or you can use the GitHub Wiki for the repository—where you have a chance to really get into the nitty gritty of your idea. If you make a good case for your proposal, the team will tag your issue with `Needs Design` and `Confirmed` labels, plus possibly assign the UX team for a review.

Keep in mind many aspects of a design in elementary OS have had years of thought and iteration behind them, so contributors may be hesitant to sweeping redesigns. Small, more iterative improvements are often much easier to come to a conclusion on and implement if apprvoed.

Need help opening an issue? Take a look at [Reporting Bugs](#reporting-bugs)

## Create Concise Work Items {#create-concise-work-items}

Now that you’ve laid out the motivations for your design and explained the overall vision, you should break it up into small, actionable work items (these can be included as subtasks on your issue or as separate issues). To continue our example, I would have issues like “Change Search Engine Manager Dialog to Popover”, “Re-order Search Engines with Drag and Drop”, “Open Search Engine Manager by clicking Search icon in URL Bar”, “Show edit and remove buttons next to engine in Search Engine Manager”, etc. Each issue should describe just one small change. We do this for several reasons:

* It allows developers to deny one request without denying all of them. Face it: your design isn’t perfect and it’s very possible that a developer isn’t going to like part of it. By breaking up your design into little pieces, it allows a developer to incorporate the changes they like and ignore the ones they don’t.
* It makes your design less intimidating. A big redesign means lots of lines of code. If your changes look like too much of a hassle, you’re going to have a hard time getting a developer to work on them. But if you present small changes that can be incorporated a bit at a time, there’s a bigger chance that your whole design will eventually be implemented.
* It allows developers to track their progress. Once again, big designs take time to implement. Even if a developer wants to implement the whole thing right away, they might not be able to. Giving them a way to “check off” pieces as they go makes it more likely that a part of your design won’t be forgotten about when it’s translated into code.

## File Compelling Reports {#file-compelling-reports}

Don’t forget to make your reports compelling. It’s up to you to sell the merits of each change. Cite the HIG, prior-art, user complaints, articles by other designers, and present your changes in a logical, non-opinionated, and concise manner. It also doesn’t hurt to speak in developer terms. Brush up on the names of widgets in Gtk and Granite, get familiar with available libraries like Zeitgeist and Unity, and don’t forget about system components like PulseAudio or Contractor. Also, whatever you do, don’t be presumptuous and confirm your own bug reports. You wouldn’t ask a friend for a favor and then answer yourself for them, so don’t do it here either. See [the above section](#reporting-bugs) for a refresher on filing good bug reports.

## Be Prepared to Iterate {#be-prepared-to-iterate}

Don’t be upset if a developer plainly states that they don’t want to implement your idea. Remember that they have plans too. You might have to go back to the drawing board a bit. Listen to their feedback. Your design might be a little over-engineered, it might conflict with other designs being worked on, or maybe it’s just in conflict with the goals and scope of the app. Remember that you’re in the position of requesting someone to devote their time to something. You’re asking for a favor. Don’t be afraid to argue a position within polite reason, but remember to stay humble.

## Tracking Proposals {#tracking-proposals}

Lets say you've convinced the developers of the merits of your new design, how do you keep track of the progress? GitHub has a projects feature for tracking isssues and their progress as apart of larger initiaves. Projects are managed on a per-repository basis at each individual GitHub repository (check out the projects board for this website [here](https://github.com/elementary/website/projects)) and by the elementary organization (check out elementary's projects [here](https://github.com/orgs/elementary/projects)) to track initiaves across projects. Projects are maintained by the owner of the GitHub repo or by elementary and link back to the issues you've created.

