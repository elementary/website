# Reporting Bugs {#reporting-bugs}

One of the big advantages of being an openly developed project is being able to take part in public bug tracking. However, if you're new to working with public bug tracking, it can be difficult to understand how to report bugs The Right Way™. So let's find out how:

1. In order to file reports, you must be signed up as a member of Launchpad. If you've been through our [development guide](/docs/code/the-basic-setup), you already have this covered.
2. Find the "Report a Bug" page for the app in question. Often times you can right-click the app in the dock, select "About", and then select "Report a Problem". Otherwise, you can search for the app on Launchpad, select the "Bugs" tab, and then "Report a Bug" on the right side of the page.
3. When filing a new report, launchpad will automatically check for duplicates. However, it's still a good idea to search the bug list to make sure your report hasn't been filed already. If your report has already been filed by someone else, you can mark the report as affecting you using the link on the top left of the report's page. Only comment on the report if you can provide additional useful information that may help track down the source of the issue. Do not comment things like, "I have this problem too" or "This is a really important issue".
5. If your report has not already been filed by someone else and you've reached the "Report a Bug" page, type in a summary and description of the issue and select "Submit". Keep in mind the following information while filing your report:

## Be Specific In The Summary {#be-specific-in-the-summary}
This will be the title of the issue in the bug tracker. It's very important to be specific because it makes it much easier for a developer or bug manager to search the issue list and helps avoid duplicate reports. A summary such as "App Crashes" is not good and vague requests like "Increase Performance" are not helpful. A good summary is something like "Notification is not sent when process finishes".

## Avoid Subjective or Ambiguous Adjectives {#avoid-subjective-or-ambiguous-adjectives}
This may sound like a repeat of the first heading, but it's important when you want someone to confirm your report. Don't say that something is "jarring" or "unintuitive". Instead describe what happened and contrast it with what you expected to happen. "The panel suddenly appeared instead of being animated in," describes the problem in a way that is actionable and objective.

## Be Concise, But Explain The Issue {#be-concise-but-explain-the-issue}
First of all, it's important to mention that bug reports should be written in English and you should, if possible, watch out for your language and grammar.

The most important thing for a report is that the developer must be able to reproduce the issue. If necessary, include exact numbered steps to reproduce the issue. Include relevant information like your OS version, any modifications you've made to the system (like changing your window manager or kernel), or the version numbers of relevant libraries like Gtk or WebKit. If you're reporting a crash, make sure to [include a backtrace](https://wiki.debian.org/HowToGetABacktrace).

## Be Prepared To Provide More Information {#be-prepared-to-provide-more-information}
If your report does not contain enough information for the developer to reproduce the issue, it may be marked as "Incomplete". Oftentimes, a developer will make a comment requesting additional specific information. If you do not provide that information, your report will eventually expire.

If you've reported your issue against the wrong app, a developer may mark it as "Invalid". If the developer knows which app you meant to report against, they may re-assign the issue. However, if they do not you must find the correct app and re-assign the report yourself.

If you're reporting a "Wishlist" issue, like a feature request, a developer may mark your bug as "Opinion" or "Won't Fix". Developers are often open to discussion about these kinds of issues, but please do not harass a developer for marking your report this way.

## You Can Get a Bit of Help {#you-can-get-a-bit-of-help}
If you're not sure about anything above, you are always welcome to our development IRC channel: #elementary-dev on irc.freenode.net. We might be able to help you track down the actual project where you should report the issue, or perhaps even aid you with any English language issue you might come across. Most developers want to help you make good bug reports.

## Don't Confirm Reports for Other People's Apps {#dont-confirm-reports-for-other-peoples-apps}
If a report affects you, mark it using the link. Do not confrim your own reports. Even if you are 100% sure that you are right, just don't do it. It's not good bug tracker etiquette. A bug manager or developer for the app will confirm the report when they are able to review it.

## Don't Make "Me Too" Comments {#dont-make-me-too-comments}
We mentioned this earlier, but it's worth mentioning again. Do not make comments that simply say "This issue affects me as well". This clutters up the tracker. Only comment if you are providing additional information that helps find the source of the issue. If you only want to let a developer know that you are affected, use the green link that says, "Does this bug affect you?" under the report's title.
