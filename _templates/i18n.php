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
        array('input', 'placeholder'),
        array('a', 'title'),
        array('img', 'alt')
    );

    $inTag = false; // Are we in a <tag [here]>?
    $tagContents = ''; // The tag contents: <tag>contents[here]</tag>
    $inTagName = false; // Are we in a <ta[here]g> ?
    $tagName = ''; // The current tag name
    $inAttrName = false; // Are we in a <tag attr[here]="blah">?
    $attrName = ''; // The current attribute name
    $inAttrValue = false; // Are we in a <tag attr="blah[here]">?
    $attrValue = ''; // The current attribute value

    // Begin parsing input HTML
    for ($i = 0; $i < strlen($input); $i++) {
        $char = $input[$i]; // Current char

        if (!$inTag && $char == '<') { // Begins a <tag>
            // Ouput the last tag contents, translate it if possible
            $tagContents = trim($tagContents);
            if (!empty($tagContents) && !in_array($tagName, $tagsBlacklist)) {
                $output .= $translate($tagContents);
            }

            $inTag = true;
            $inTagName = true;
            $tagName = '';
            $tagContents = '';
        }
        if ($inTag && $char == '>') { // Ends a <tag>
            $inTag = false;
            $inTagName = false;
            $inAttrName = false;
            $attrName = '';
            $tagContents = '';
        }
        if ($inTag && !$inAttrValue && $char == ' ') { // Begins an attribute name
            $inTagName = false;
            $inAttrName = true;
            $attrName = '';
        }
        if ($inTag && $inAttrName && $char == '=') { // Begins an attribute value
            $inAttrName = false;
            $inAttrValue = true;
            $attrValue = '';
        }
        // Ends an attribute value
        if ($inTag && $inAttrValue && $char == '"' && $input[$i-1] != '=') {
            $inAttrValue = false;

            // Translatable attributes
            $attrTranslated = false;
            foreach ($attrsWhitelist as $attrData) {
                if ($tagName == $attrData[0] && $attrName == $attrData[1]) {
                    $output .= $translate($attrValue);
                    $attrTranslated = true;
                }
            }
            if (!$attrTranslated) {
                $output .= $attrValue;
            }
        }

        // Append char

        // In a tag name or in an attribute name
        if ($inTagName && $char != '<') {
            $tagName .= $char;
        }
        if ($inAttrName && $char != ' ') {
            $attrName .= $char;
        }

        if ($inAttrValue && $char != '=' && $char != '"') {
            // In an attribute value, buffer it
            $attrValue .= $char;
        } elseif (!$inTag && $char != '>') {
            // In a tag contents, buffer it
            $tagContents .= $char;
        } else { // Otherwise, just append it to the output
            $output .= $char;
        }
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