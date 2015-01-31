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

$pageName = basename($_SERVER['PHP_SELF'], '.php');
$lang = user_lang();
if (!is_lang($lang)) {
    $lang = 'en';
}
$translations = load_translations($pageName, $lang);

/**
 * Translate a string. Returns the original string if no translation was found.
 */
function translate($string) {
    global $translations;

    if (isset($translations[$string]) && is_string($translations[$string])) {
        return $translations[$string];
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
    $output = ''; // Output HTML string

    // Tags that doesn't contain translatable text
    $tagsBlacklist = array('script', 'kbd');

    // Attributes that can be translated
    $attrsWhitelist = array(
        'input' => array('placeholder'),
        'a' => array('title'),
        'img' => array('alt')
    );

    // Begin parsing input HTML
    $i = 0;
    $tagName = '';
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

                if (isset($attrsWhitelist[$tagName])) {
                    $allowedTags = $attrsWhitelist[$tagName];

                    $attrsString = substr($tag, $attrsStart + 1);
                    $tag = substr($tag, 0, $attrsStart + 1);

                    $attrs = $attrsString;

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

                            if (in_array($name, $allowedTags)) {
                                $value = substr($attrs, $nameEnd + 2, $valueEnd - ($nameEnd + 2));

                                $tag .= ' '.$name.'="'.$translate($value).'"';
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
            }
            $text = substr($input, $i + 1, $next - $i - 1);
            if (!in_array($tagName, $tagsBlacklist)) {
                $cleanedText = trim($text);
                if (!empty($cleanedText)) {
                    $text = $translate($cleanedText);
                }
            }
            $output .= $text;
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