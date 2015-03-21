<?php
function list_langs() {
    return array(
        'en' => 'English',
        'bg' => 'български език',
        'cs_CZ' => 'čeština',
        'de' => 'Deutsch',
        'es' => 'Español',
        'et' => 'Eesti',
        'fr' => 'Français',
        'id_ID' => 'Bahasa Indonesia',
        'it_IT' => 'Italiano',
        'lt' => 'Lietuvių kalba',
        'nl' => 'Nederlands',
        'nb' => 'Bokmål',
        'no' => 'Norsk',
        'pt_PT' => 'Português',
        'ro_RO' => 'Română',
        'ru' => 'Русский',
        'sr' => 'Српски',
        'sr_Ijekavian' => 'Српски (ијекавица)',
        'tr_TR' => 'Türkçe',
        'uk' => 'Мова',
        'zh_CN' => '國語'
    );
}

function lang_dir($lang) {
    return dirname(__FILE__).'/../lang/'.$lang;
}

function is_lang($lang) {
    if (!is_string($lang)) {
        return false;
    }
    if (!preg_match('#^[a-z]{2}(_([A-Z]{2}|[A-Z][a-z]+))?$#', $lang)) {
        return false;
    }

    return is_dir(lang_dir($lang));
}

function user_lang() {
    if (isset($_COOKIE['language']) && is_lang($_COOKIE['language'])) {
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
            if (is_lang($lang)) {
                return $lang;
            }
        } elseif (is_lang($locale['language'])) {
            return $locale['language'];
        }
    }

    return null;
}

function load_translations($index, $lang) {
    if (!is_lang($lang)) {
        return false;
    }

    $langFile = lang_dir($lang).'/'.$index.'.json';
    if (!file_exists($langFile)) {
        return false;
    }

    $json = file_get_contents($langFile);
    return json_decode($json, true);
}

$l10nDomain = null;
$translations = array();
function set_l10n_domain($domain) {
    global $lang, $l10nDomain, $translations;

    if (ob_get_level()) {
        ob_flush(); // Flush output buffer
    }

    $l10nDomain = $domain;

    if (!isset($translations[$domain])) {
        $translations[$domain] = load_translations($domain, $lang);
    }
}

/**
 * Translate a string. Returns the original string if no translation was found.
 */
function translate($id, $domain, $string) {
    global $translations;

    if (isset($translations[$domain][$id]) &&
        is_string($translations[$domain][$id])) {
        return $translations[$domain][$id];
    } else {
        return $string;
    }
}

/**
 * Translate a HTML string. This includes a minimalist XML parser.
 * Can be provided a $translate callback to override default behaviour.
 * (Useful to extract strings from a file for instance.)
 */
function translate_html($input, $translate = 'translate') {
    global $l10nDomain;

    $output = ''; // Output HTML string

    // Tags that doesn't contain translatable text
    $tagsBlacklist = array('script', 'style', 'kbd');

    // Attributes that can be translated
    $attrsWhitelist = array(
        'input' => array('placeholder'),
        'a' => array('title'),
        'img' => array('alt')
    );

    // Tags included in translation strings when used in <p> or <li>
    $ignoredTags = array('a', 'kbd');

    // Begin parsing input HTML
    $i = 0;
    $tagName = '';
    $l10nId = '';
    $l10nDisabled = false;
    while ($i < strlen($input)) {
        $char = $input[$i]; // Current char
        $next = $i + 1;

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
                                break;
                            }
                            $valueEnd = strpos($attrs, '"', $nameEnd + 2);
                            if ($valueEnd === false) {
                                break;
                            }

                            $name = substr($attrs, $j, $nameEnd - $j);
                            $value = substr($attrs, $nameEnd + 2, $valueEnd - ($nameEnd + 2));

                            if ($name == 'data-l10n-id') { // Set translation ID for this tag
                                $l10nId = $value;
                            }
                            if ($name == 'data-l10n-off') { // Disable translation for this tag
                                $l10nDisabled = true;
                            }
                            if (in_array($name, $allowedAttrs)) { // Translate attribute
                                $tag .= ' '.$name.'="'.$translate($value, $l10nDomain, $value).'"';
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
            } else { // No attributes in this tag
                $tagName = $tag;
            }

            $output .= '<'.$tag.'>';
        } else { // Text node (<tag>HERE</tag>)
            $next = strpos($input, '<', $i);
            if ($next === false) { // End Of File
                $next = strlen($input);
            } elseif ($tagName == 'p' || $tagName == 'li') {
                // Do not process ignored tags in <p> and <li>
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
                        $translate($l10nId, $l10nDomain, $cleanedText) .
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
function begin_html_l10n() {
    if (defined('HTML_I18N')) { // Do not allow nested output buffering
        return;
    }
    define('HTML_I18N', 1);

    ob_start(function ($input) {
        return translate_html($input);
    });
}
/**
 * End outputted HTML translation.
 */
function end_html_l10n() {
    if (!ob_get_level()) {
        return;
    }

    ob_end_flush();
}

// Set page language
if (isset($_GET['lang'])) {
    $lang = $_GET['lang'];
} else {
    $lang = user_lang();
}
if (!is_lang($lang)) {
    $lang = 'en';
}
$page['lang'] = $lang; // Set page variable

// Autoredirection
if ((isset($_GET['lang']) || isset($_COOKIE['language'])) && $_GET['lang'] != $page['lang'] && $page['lang'] != 'en') {
    $url = $sitewide['root'];
    $url .= $page['lang'].'/';
    if ($page['name'] != 'index') {
        $url .= $page['name'];
    }
    header('Location: '.$url);
    exit();
}
if (isset($_GET['lang'])) {
    setcookie('language', $lang,  time() + 60*60*24*30, '/'); // 30 days
}
