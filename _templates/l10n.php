<?php
function user_lang() {
    if (!isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
        return null;
    }
    if (isset($_GET['lang'])) {
        return strtolower(substr($_GET['lang'], 0, 2));
    }

    return strtolower(substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2));
}

function lang_dir($lang) {
    return dirname(__FILE__).'/../lang/'.$lang;
}

function is_lang($lang) {
    if (!preg_match('#^[a-z]{2}$#', $lang)) {
        return false;
    }

    return is_dir(lang_dir($lang));
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
    $tagsBlacklist = array('script', 'kbd');

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
    while ($i < strlen($input)) {
        $char = $input[$i]; // Current char
        $next = $i + 1;

        if ($char == '<') {
            $next = strpos($input, '>', $i);
            $tag = substr($input, $i + 1, $next - $i - 1);

            // Parse <tag>
            $attrsStart = strpos($tag, ' ');
            if ($attrsStart !== false) {
                $tagName = substr($tag, 0, $attrsStart);
                $attrs = substr($tag, $attrsStart + 1);

                if (isset($attrsWhitelist[$tagName]) || strpos($attrs, 'data-l10n-') !== false) {
                    if (isset($attrsWhitelist[$tagName])) {
                        $allowedTags = $attrsWhitelist[$tagName];
                    } else {
                        $allowedTags = array();
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

                            if ($name == 'data-l10n-id') {
                                $l10nId = $value;
                            }
                            if (in_array($name, $allowedTags)) {
                                $tag .= ' '.$name.'="'.$translate($value, $l10nDomain, $value).'"';
                            } else {
                                $tag .= ' '.substr($attrs, $j, $valueEnd - $j + 1);
                            }
                            $j = $valueEnd + 1;
                        } else {
                            break;
                        }
                    }
                    if ($j < strlen($attrs)) {
                        $tag .= substr($attrs, $j);
                    }
                }
            } else {
                $tagName = $tag;
            }

            $output .= '<'.$tag.'>';
        } else {
            $next = strpos($input, '<', $i);
            if ($next === false) {
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
            }

            $text = substr($input, $i + 1, $next - $i - 1);
            if (!in_array($tagName, $tagsBlacklist) || !empty($l10nId)) {
                $cleanedText = trim($text);
                if (!empty($cleanedText) || !empty($l10nId)) {
                    if (empty($l10nId)) {
                        $l10nId = $cleanedText;
                    }

                    // Properly re-inject whitespaces
                    $text = substr($text, 0, strpos($text, $cleanedText[0])) .
                        $translate($l10nId, $l10nDomain, $cleanedText) .
                        substr($text, strrpos($text, substr($cleanedText, -1)) + 1);
                }
            }
            $output .= $text;
            $l10nId = '';
        }

        $i = $next;
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
if (isset($_GET['lang']) && $_GET['lang'] != $page['lang'] && $page['lang'] != 'en') {
    $url = $sitewide['root'];
    $url .= $page['lang'].'/';
    if ($page['name'] != 'index') {
        $url .= $page['name'];
    }
    header('Location: '.$url);
    exit();
}