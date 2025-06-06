# Translators

You can translate the website online on the elementary Weblate instance: https://l10n.elementaryos.org/projects/website/. Please don't update directly files in `_lang/` on Github as they'll be overridden when pulling new translations.

You can propose new languages if they're not listed. Make sure to avoid requesting languages that already exist, for instance adding _Russian (Russia)_ when _Russian_ is available.

## Reviewing

It's not a good practice to review strings translated by ourselves. Instead, find someone else speaking your language and ask them to join the reviewers team (you can send a message to [the i18n team](mailto:i18n@elementary.io?subject=Review%20Team%20Request) to ask this).

## Updating

Languages are updated automatically when code is changed. This may take time to update, so please be patient.

# Web developers

## Extracting translations from HTML files

Translations strings are extracted from HTML files. A little command line PHP file is included to make this easier. Just run `php _backend/Console/Translation.php` to update the translation files. You can use `--help` for more options.

### Command Line Options

The translation tool supports the following command line options:

* `--language`, `-l` - Extract translations for a specific language only
   * Example: `php _backend/Console/Translation.php --language fr`

* `--page`, `-p` - Extract translations for a specific page only 
   * Example: `php _backend/Console/Translation.php --page code-of-conduct`

* `--verbose`, `-v` - Show more detailed output during the extraction process
   * Example: `php _backend/Console/Translation.php --verbose`

* `--help` - Display help information about the command

You can combine multiple options:
```sh
php _backend/Console/Translation.php --language ar --page code-of-conduct --verbose
```

## Changing a translation key

If you want to change a translation key for an element, just add a `data-l10n-id` attribute:

```html
<p data-l10n-id="mylongparagraph">Blablabla</p>
```

## Disabling a translation

To ignore a translation string, set it to `false` in `/_lang/en/<page>.json`:

```js
{
    "elementary OS": false // Can't be translated
}
```

Alternatively, you can add the `data-l10n-off` attribute to a tag:
```html
<p data-l10n-off="1">I'm ignored.</p>
```

## Adding a new language to the list on the website

The list of available languages is hard-coded in [`_backend/Lib/L10n.php`](https://github.com/elementary/website/blob/master/_backend/Lib/L10n.php). If a new language is complete, you can add it by appending it to the list. Languages are sorted by index (see [ISO 639-1](https://en.wikipedia.org/wiki/List_of_ISO_639-1_codes)) and are localized.
