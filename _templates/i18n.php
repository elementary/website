<?php
// Index French strings for testing purposes
$translations = array(
    'A fast and open replacement for Windows and OS X' => 'Un remplaçant rapide et ouvert pour Windows et OS X',
    'Download Freya Beta' => 'Télécharger Freya Beta',
    'Custom' => 'Personnalisé',
    'Enter any dollar amount.' => 'Entrez une somme.',
    '886.0 MB (for PC or Mac)' => '886.0 Mio (pour PC ou Mac)',
    'Choose a Download' => 'Choisissez un Téléchargement',
    'We recommend 64-bit for most modern computers. For help and more info, see the ' => 'Nous recommendons 64-bits pour les ordinateurs modernes. Pour de l\'aide ou plus d\'informations, voir le ',
    'installation guide' => 'guide d\'installation'
);

/**
 * Translate a string. Returns the original string if no translation was found.
 */
function translate($string) {
    global $translations;

    if (isset($translations[$string])) {
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
                $text = $translate($text);
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
function begin_html_i18n() {
    ob_start(function ($input) {
        return translate_html($input);
    });
}
/**
 * End outputted HTML translation.
 */
function end_html_i18n() {
    ob_end_flush();
}