# Reference {#reference}

# Code Style

Code style documentation has moved. You can now find updated docs [here](https://docs.elementary.io/develop/writing-apps/code-style)

# Logging {#logging}

There are various logging methods to use and here are some sample references for you.

## Critical {#critical}

Critical log level is used when there is a severe application failure that should be investigated immediately.

```vala
public static int main (string[] args) {
    // Use "G_DEBUG=fatal-warnings ./test" to abort the program
    // at the first call to GLib.warning() or GLib.critical().

    // Use "G_DEBUG=fatal-criticals ./test" to abort the program
    // at the first call to GLib.critical().

    // Output: `** (process:<PID>): CRITICAL **: <FILENAME>:<LINE>: my 10. critical`
    critical ("my %d. %s", 10, "critical");
    return 0;
}
```

## Debug {#debug}

Debug logs usually give detailed information on the flow through the system.

```vala
public static int main (string[] args) {
    // Use "G_MESSAGES_DEBUG=all ./test" to print debug messages.

    // Output: `** (process:<PID>): DEBUG: <FILENAME>:<LINE>: my 10. debug message`
    debug ("my %d. %s", 10, "debug message");
    return 0;
}
```

## Error {#error}

Error log level includes logs for runtime errors or unexpected conditions. These errors are immediately visible on a status console and causes premature termination.

```vala
public static int main (string[] args) {
    // Output:
    //   `** (process:<PID>): ERROR **: <FILENAME>:<LINE>: my 10. error`
    //   `Trace/breakpoint trap`

    // Terminate calling process & log an error:
    error ("my %d. %s", 10, "error");
}
```

## Info {#info}

Use info log level to log informational messages as well as interesting runtime events. These logs are also immediately visible on a status console, and should be kept to a minimum.

```vala
public static int main (string[] args) {
    // Output: `** (process:<PID>): INFO: <FILENAME>:<LINE>: my 10. info message`
    info ("my %d. %s", 10, "info message");
}
```

## Message {#message}

Use the message log level to output a message.

```vala
public static int main (string[] args) {
    // Output: `** Message: <FILENAME>:<LINE>: my 10. message`
    message ("my %d. %s", 10, "message");
    return 0;
}
```

## Warning {#warning}

The warn log level outputs messages that warns of, for example, use of deprecated APIs, 'almost' errors, or runtime situations that are undesirable or unexpected, but not necessarily "wrong". These logs are immediately visible on a status console.

```vala
public static int main (string[] args) {
    // Use "G_DEBUG=fatal-warnings ./test" to abort the program at the first
    // call to GLib.warning() or GLib.critical().

    // Output: `** (process:<PID>): WARNING **: <FILENAME>:<LINE>: my 10. warning`
    warning ("my %d. %s", 10, "warning");
    return 0;
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

If you're not sure about anything above, you are always welcome to chat with community members and developers in the [Community Slack](https://community-slack.elementary.io/). We might be able to help you track down the actual project where you should report the issue, or perhaps even aid you with any English language issue you might come across. Most developers want to help you make good bug reports.

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
