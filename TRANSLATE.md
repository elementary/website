# Translators

You can translate the website online on Transifex: https://www.transifex.com/projects/p/elementary-mvp/. Please don't update directly files in `lang/` on Github as they'll be overriden when pulling new translations from Transifex.

You can propose new languages if they're not listed. Make sure to avoid requesting languages that already exist, for instance adding _Russian (Russia)_ when _Russian_ is available.

Please read the [branding guidelines](http://blog.elementary.io/post/107640994166/the-importance-of-our-brand) before translating and pay attention to spelling mistakes.

## Reviewing

It's not a good practice to review strings translated by ourselves. Instead, find someone else speaking your language and ask him to join the reviewers team (you can send a message to [emersion](https://www.transifex.com/accounts/profile/emersion/) to ask this).

## Updating

Languages are manually updated, so you won't see your work published just after you submitted it (see [Pull translated files from Transifex](#pull-translated-files-from-transifex)).

# Web developers

## Script

The following script will update your local copy of master, push new strings to Transifex, then remove and re-download the translation files. Finally, it will check the translations and push the branch. You should then file a pull request against [that branch](https://github.com/elementary/website/compare/master...translations-update), including the check result.

```
git checkout master
git pull
.tx/prepush.sh
tx push -s
git checkout -b translations-update
rm lang/* -Rf
tx pull -a
php backend/translations-checker.php
git add -A
git commit -am "Update all Translations, even new ones"
git push --set-upstream origin translations-update
git checkout master
```

## Extracting translations from HTML files

Translations strings are extracted from HTML files. A little PHP script analyzes HTML files and exports strings to a JSON file: `/backend/extract-l10n.php?page=<page>`. You can change the `page` parameter to extract translations from another page (and set it to `layout` to translate the website layout). Translations are auto-updated on Transifex using this script.

You can add the `include_disabled=1` parameter to print disabled strings too. This behaviour is disabled by default because Transifex doesn't accept `false` values. See _Disabling a translation_ for more information.

## Changing a translation key

If you want to change a translation key for an element, just add a `data-l10n-id` attribute:

```html
<p data-l10n-id="mylongparagraph">Blablabla</p>
```

## Disabling a translation

To ignore a translation string, set it to `false` in `/lang/en/<page>.json`:

```js
{
    "elementary OS": false // Can't be translated
}
```

Alternatively, you can add the `data-l10n-off` attribute to a tag:
```html
<p data-l10n-off="1">I'm ignored.</p>
```

## Pull translated files from Transifex

You will need first to install the Transifex client: http://docs.transifex.com/developer/client/setup

Then, run the following command:

```bash
tx pull
```

To pull a new language:

```bash
tx pull -l <lang>
```

To pull **all** translations, even new ones:

```bash
tx pull -a
```

## Pushing new translation source files to Transifex

When creating or updating a source file, translations needs to be updated. You can run these commands to extract translations from source files and publish them on Transifex:

```bash
.tx/prepush.sh # Update translation source files
tx push -s # Push new translation source files to Transifex
```

If you know that you modified only one source file, it's better to push only this one:
```bash
tx push -s -r <page-name>
```

## Adding a new language to the list on the website

The list of available languages is hard-coded in [`_templates/l10n.php`](https://github.com/elementary/website/blob/master/_templates/l10n.php#L2). If a new language is complete, you can add it by appending it to the list. Languages are sorted by index (see [ISO 639-1](https://en.wikipedia.org/wiki/List_of_ISO_639-1_codes)) and are localized.
