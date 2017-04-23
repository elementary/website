<?php

/**
 * _backend/Lib/L10n.php
 * All of the main translation logic
 */

namespace App\Lib;

class L10n
{

    /**
     * directory
     * The directory that holds all translation files
     *
     * @var string
     */
    public static $directory = __DIR__ . '/../../_lang';

    /**
     * blacklistedPages
     * A list of basic regex functions used for black listing translatble pages
     *
     * @var array
     */
    public static $blacklistedPages = array(
        '/LICENSE.md/',
        '/README.md/',
        '/router.php/',
        '/TRANSLATE.md/',
        '/inventory.php/',
    );

    /**
     * languages
     * Returns a list of all langauges the website currently has.
     * NOTE: this does not return a list of enabled languages.
     *
     * @return array A list of languages we currently have
     */
    public static function languages()
    {
        $languages = array();

        foreach (glob(static::$directory . '/*/', GLOB_ONLYDIR) as $path) {
            $languages[] = basename($path);
        }

        return $languages;
    }

    /**
     * pages
     * Returns a list of pages that we can translate.
     *
     * @return array A list of pages we can translate
     */
    public static function pages()
    {
        $rootDirectory = static::$directory . '/..';

        $files = array_merge(
            glob($rootDirectory . '/*.{php,md}', GLOB_BRACE),
            glob($rootDirectory . '/docs/*.md'),
            glob($rootDirectory . '/docs/code/*.md'),
            glob($rootDirectory . '/store/*.php')
        );

        $pages = array();

        foreach ($files as $file) {
            $blacklisted = false;

            foreach (static::$blacklistedPages as $reg) {
                if (preg_match($reg, $file)) {
                    $blacklisted = true;
                }
            }

            if ($blacklisted === false) {
                $pages[] = $file;
            }
        }

        return $pages;
    }

    /**
     * languageDirectory
     * Returns the directory for a language
     *
     * @param  string $lang The language code
     * @return string       Directory the language files are in
     */
    public static function languageDirectory($lang)
    {
        return realpath(static::$directory . '/' . $lang);
    }

    protected $available_langs = array(
        'af' => 'Afrikaans',
        'ar' => 'العَرَبِيَّة‎‎',
        'ca' => 'català',
        'cs_CZ' => 'čeština',
        'de' => 'Deutsch',
        'en' => 'English',
        'es' => 'Español',
        'fi' => 'Finnish',
        'fr' => 'Français',
        'it' => 'Italiano',
        'ja' => '日本語',
        'kr' => '한국어',
        'lt' => 'Lietuvių kalba',
        'ms' => 'bahasa Melayu',
        'nb' => 'Bokmål',
        'nl' => 'Nederlands',
        'pl' => 'Polski',
        'pt_BR' => 'Português (Brasil)',
        'pt_PT' => 'Português (Portugal)',
        'ru' => 'Русский',
        'th' => 'Thai',
        'sk' => 'Slovak',
        'sv' => 'Swedish',
        'tr_TR' => 'Türkçe',
        'zh_CN' => '简体中文',
        'zh_TW' => '繁體中文',
    );

    protected $lang = 'en';

    protected $domain = null;

    public function __construct($lang = null) {
        if (empty($lang)) {
            $lang = $this->get_page_lang();
        }
        $this->lang = $lang;
    }

    public function init() {
        global $sitewide, $page; // Global site variables

        if (defined('HTML_I18N')) {
            return;
        }

        // Redirect the user if we are translating the page
        if ((isset($_GET['lang']) || isset($_COOKIE['language']))
            && (isset($_GET['lang']) ? $_GET['lang'] : 'en') != $this->lang
            && $this->lang != 'en') {

            $url = $sitewide['root'];
            $url .= $this->lang.$page['path'];
            $url = '/'.ltrim($url, '/'); // Make sure there is a / at the begining
            header('Location: '.$url);
            exit();
        }

        // Set cookie if the user has chosen the current language
        if (isset($_GET['lang'])) {
            setcookie('language', $this->lang,  time() + 60*60*24*30, '/'); // 30 days
        }
    }

    public function list_langs() {
        return $this->available_langs;
    }

    // DEPRECATED: use the static function instead
    public function lang_dir($lang) {
        return static::languageDirectory($lang);
    }

    public function is_lang($lang) {
        if (!is_string($lang)) {
            return false;
        }
        if (!preg_match('#^[a-z]{2}(_([A-Z]{2}|[A-Z][a-z]+))?$#', $lang)) {
            return false;
        }
        if ($lang == 'en') {
            return true;
        }

        return is_dir($this->lang_dir($lang));
    }

    public function user_lang() {
        if (isset($_COOKIE['language']) && $this->is_lang($_COOKIE['language'])) {
            return $_COOKIE['language'];
        }

        if (empty($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
            return null;
        }

        $languages = explode(',', $_SERVER['HTTP_ACCEPT_LANGUAGE']);
        foreach ($languages as $locale_str) {
            $split = array_map('trim', explode(';', $locale_str, 2));
            $lang_tag = $split[0];
            $lang_tag = str_replace('-*', '', $lang_tag);

            if (function_exists('locale_parse')) {
                $locale = locale_parse($lang_tag);
            } else {
                $locale = array('language' => substr($lang_tag, 0, 2));
            }

            if (!empty($locale['region'])) {
                $lang = $locale['language'].'_'.$locale['region'];
                if ($this->is_lang($lang)) {
                    return $lang;
                }
            }

            if (!empty($locale['language']) && $this->is_lang($locale['language'])) {
                return $locale['language'];
            }
        }

        return null;
    }

    public function load_translations($index) {
        $lang = $this->lang;

        if (!$this->is_lang($lang)) {
            return false;
        }

        $langFile = $this->lang_dir($lang).'/'.$index.'.json';
        if (!file_exists($langFile)) {
            return false;
        }

        $json = file_get_contents($langFile);
        return json_decode($json, true);
    }

    protected function load_domain($domain) {
        $this->translations[$domain] = $this->load_translations($domain);
    }

    public function set_domain($domain) {
        if (ob_get_level()) {
            ob_flush(); // Flush output buffer
        }

        $this->domain = $domain;

        if (!isset($this->translations[$domain])) {
            $this->load_domain($domain);
        }
    }

    /**
     * Translate a string. Returns the original string if no translation was found.
     */
    public function translate($id, $domain = null, $string = null) {
        if (empty($domain)) {
            $domain = $this->domain;
        }
        if (empty($string)) {
            $string = $id;
        }
        if (!isset($this->translations[$domain])) {
            $this->load_domain($domain);
        }

        if (isset($this->translations[$domain][$id]) &&
            is_string($this->translations[$domain][$id]) &&
            ($this->translations[$domain][$id] !== "")) {
            return $this->translations[$domain][$id];
        } else {
            return $string;
        }
    }

    /**
     * Translate a HTML string. This includes a minimalist XML parser.
     * Can be provided a $translate callback to override default behaviour.
     * (Useful to extract strings from a file for instance.)
     */
    public function translate_html($input, $translate = null) {
        if (empty($translate)) {
            $translate = array($this, 'translate');
        }

        $output = ''; // Output HTML string

        // Tags that doesn't contain translatable text
        $tagsBlacklist = array('script', 'style', 'kbd', 'code');

        // Attributes that can be translated
        $attrsWhitelist = array(
            'input' => array('placeholder'),
            'a' => array('title'),
            'img' => array('alt')
        );

        // Tags included in translation strings when used in <p>, <hX> or <li>
        $ignoredTags = array('a', 'kbd', 'strong', 'em', 'code', 'sup', 'sub');

        // Begin parsing input HTML
        $i = 0;
        $tagName = '';
        $l10nId = '';
        $l10nDisabled = false;
        while ($i < strlen($input)) {
            $char = $input[$i]; // Current char

            if ($char == '<') { // Tag node (<HERE>)
                $next = strpos($input, '>', $i);
                $tag = substr($input, $i + 1, $next - $i - 1);

                // Parse <tag>
                $attrsStart = strpos($tag, ' ');
                if ($attrsStart !== false) { // There are attributes specified
                    $tagName = substr($tag, 0, $attrsStart);
                    $attrs = substr($tag, $attrsStart + 1);

                    // Parse attributes only if it's interesting
                    // (translatable attributes or data-l10n-* attributes)
                    if (isset($attrsWhitelist[$tagName]) || strpos($attrs, 'data-l10n-') !== false) {
                        // Attributes that can be translated in this tag
                        if (isset($attrsWhitelist[$tagName])) {
                            $allowedAttrs = $attrsWhitelist[$tagName];
                        } else {
                            $allowedAttrs = array();
                        }

                        $tag = substr($tag, 0, $attrsStart + 1);

                        // Parse attributes
                        $j = 0;
                        while ($j < strlen($attrs)) {
                            $char = $attrs[$j];

                            if ($j == 0 || $char == ' ') {
                                if ($char == ' ') {
                                    $j++;
                                }

                                // Extract attribute name and value
                                $nameEnd = strpos($attrs, '=', $j);
                                if ($nameEnd === false) {
                                    // In case the last attribute is a boolean one (without value, e.g. <input disabled>)
                                    $boolAttrName = substr($attrs, $j);
                                    if (preg_match('#^[a-zA-Z0-9-]+$#', $boolAttrName)) {
                                        $valueEnd = $j + strlen($boolAttrName);
                                        $name = $boolAttrName;
                                        $value = true;
                                    } else {
                                        break;
                                    }
                                } else {
                                    $valueEnd = strpos($attrs, '"', $nameEnd + 2);
                                    if ($valueEnd === false) {
                                        break;
                                    }

                                    $name = substr($attrs, $j, $nameEnd - $j);
                                    $value = substr($attrs, $nameEnd + 2, $valueEnd - ($nameEnd + 2));
                                }

                                if ($name == 'data-l10n-id') { // Set translation ID for this tag
                                    $l10nId = $value;
                                }
                                if ($name == 'data-l10n-off') { // Disable translation for this tag
                                    $l10nDisabled = true;
                                }
                                if (in_array($name, $allowedAttrs) && !$l10nDisabled) { // Translate attribute
                                    $tag .= ' '.$name.'="'.$translate($value, $this->domain, $value).'"';
                                } else {
                                    $tag .= ' '.substr($attrs, $j, $valueEnd - $j + 1);
                                }
                                $j = $valueEnd + 1;
                            } else {
                                break;
                            }
                        }
                        if ($j < strlen($attrs)) { // Broke inside the loop, append the remaining chars
                            $tag .= substr($attrs, $j);
                        }
                    }
                } elseif (rtrim($tag, '/ ') != 'br') {
                    // No attributes in this tag
                    // Set current tag, if not a line break
                    $tagName = $tag;
                }

                $output .= '<'.$tag.'>';
            } else { // Text node (<tag>HERE</tag>)
                $next = strpos($input, '<', $i);
                if ($next === false) { // End Of File
                    $next = strlen($input);
                } elseif ($tagName == 'p' || $tagName == 'li' || preg_match('#^h[1-6]$#', $tagName)) {
                    // Do not process ignored tags in <p>, <hX> and <li>
                    $originalNext = $next;
                    $ignoredCount = 0;
                    do {
                        $found = false;
                        foreach ($ignoredTags as $ignoredTag) {
                            if (substr($input, $next + 1, strlen($ignoredTag)) == $ignoredTag) {
                                $nextChar = $input[$next + strlen($ignoredTag) + 1];
                                if ($nextChar == '>' || $nextChar == ' ') {
                                    $tagEnd = strpos($input, '</'.$ignoredTag.'>', $next);
                                    $next = strpos($input, '<', $tagEnd + 1);
                                    $ignoredCount++;
                                    $found = true;
                                    break;
                                }
                            }
                        }
                    } while ($found);

                    // Just one link in the <p> ? Don't ignore it.
                    if ($ignoredCount == 1 && substr($input, $originalNext, 3) == '<a ' && substr($input, $next - 4, 4) == '</a>') {
                        $next = $originalNext;
                    }
                } elseif (in_array($tagName, $tagsBlacklist)) {
                    // Avoid some bugs when < and > are present in script/style tags
                    $closeTag = '</'.$tagName.'>';
                    while (substr($input, $next, strlen($closeTag)) != $closeTag) {
                        $next = strpos($input, '<', $next + 1);
                    }
                }

                // Extract text to translate
                $text = substr($input, $i + 1, $next - $i - 1);
                if ((!in_array($tagName, $tagsBlacklist) || !empty($l10nId)) && !$l10nDisabled) {
                    $cleanedText = trim($text);
                    if (!empty($cleanedText) || !empty($l10nId)) {
                        if (empty($l10nId)) { // data-l10n-id attribute not set, use text as ID
                            $l10nId = $cleanedText;
                        }

                        // Properly re-inject whitespaces
                        $text = substr($text, 0, strpos($text, $cleanedText[0])) .
                            $translate($l10nId, $this->domain, $cleanedText) .
                            substr($text, strrpos($text, substr($cleanedText, -1)) + 1);
                    }
                }

                $output .= $text; // Append text to output

                // Reset per-tag vars
                $l10nId = '';
                $l10nDisabled = false;
            }

            $i = $next; // Jump to next interesting char
        }

        return $output;
    }

    /**
     * Begin to translate outputted HTML.
     */
    public function begin_html_translation() {
        if (defined('HTML_I18N')) { // Do not allow nested output buffering
            return;
        }
        define('HTML_I18N', 1);

        ob_start(function ($input) {
            return $this->translate_html($input);
        });
    }

    /**
     * End outputted HTML translation.
     */
    public function end_html_translation() {
        if (!ob_get_level()) {
            return;
        }

        ob_end_flush();
    }

    public function get_page_lang() {
        if (isset($_GET['lang'])) {
            $lang = $_GET['lang'];
        } else {
            $lang = $this->user_lang();
        }
        if (!$this->is_lang($lang)) {
            $lang = 'en';
        }
        return $lang;
    }

    public function lang() {
        return $this->lang;
    }
}
