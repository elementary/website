# Translators

You can translate the website online on Transifex: https://www.transifex.com/projects/p/elementary-mvp/

You can propose new languages if they're not listed.

# Web developers

## Extracting translations from HTML files

Translations strings are extracted from HTML files. A little PHP script analyzes HTML files and exports strings to a JSON file: `/backend/extract-l10n.php?page=<page>`. You can change the `page` parameter to extract translations from another page (and set it to `layout` to translate the website layout). Translations are auto-updated on Transifex using this script.

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

## Pull translated files from Transifex

You will need first to install the Transifex client: http://docs.transifex.com/developer/client/setup

Then, run the following command: 
```shell
tx pull
```

To pull a new language:
```shell
tx pull -l <lang>
```