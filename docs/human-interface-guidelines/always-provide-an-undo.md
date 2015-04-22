# Always Provide An Undo {#always-provide-an-undo}

Sometimes a user will perform an action which could possibly be destructive or traditionally irreversible. Rather than present the user with a warning, apps should allow the user to undo the action for an appropriate amount of time. Some prime examples of when this behavior is useful are:

* **Closing an app**. Rather than warning the user, automatically save their work and the app's state so they can return exactly where they left off. See [Closing](/docs/human-interface-guidelines/closing).

* **Deleting an item**. Instead of asking the user if they are sure, make the item "disappear" from the app, but provide an easy and intuitive way to undo the delete.

* **Sending an email**. Rather than asking the user if they want to send an email, allow them to undo or edit the message a short time after "sending."

* **Editing a photo**. Instead of asking the user if they want to destructively apply an edit, allow them to undo the edit and always keep the original backed up.

This behavior should only as a last resort be implemented by providing a buffer time between when the app shows the user what happened and actually performing the action. To keep the experience responsive, the app should always look as if it performed the action as soon as the user initiates it. 

This behavior strikes the best balance of keeping out of the user's way while making sure they don't do something unintended. It's important to keep the undo action unobtrusive yet simple and intuitive; a common way of doing so is by using an info bar, though other methods may also be appropriate.

-----
See also: [Never Use a Warning When you Mean Undo](http://www.alistapart.com/articles/neveruseawarning/ "Read the article on A List Apart") by Aza Raskin

#### Next Page: [First-Launch Experience](/docs/human-interface-guidelines/first-launch-experience) {.text-right}