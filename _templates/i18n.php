<?php
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

function translate($string) {
    global $translations;

    if (isset($translations[$string])) {
        return $translations[$string];
    } else {
        return $string;
    }
}

function translate_html($input, $translate = 'translate') {
    $output = '';

    $tagsBlacklist = array('script', 'kbd');

    $attrsWhitelist = array(
        array('input', 'placeholder'),
        array('a', 'title'),
        array('img', 'alt')
    );

    $inTag = false;
    $tagContents = '';
    $inTagName = false;
    $tagName = '';
    $inAttrName = false;
    $attrName = '';
    $inAttrValue = false;
    $attrValue = '';
    for ($i = 0; $i < strlen($input); $i++) {
        $char = $input[$i];

        if (!$inTag && $char == '<') {
            $tagContents = trim($tagContents);
            if (!empty($tagContents) && !in_array($tagName, $tagsBlacklist)) {
                $output .= $translate($tagContents);
            }

            $inTag = true;
            $inTagName = true;
            $tagName = '';
            $tagContents = '';
        }
        if ($inTag && $char == '>') {
            $inTag = false;
            $inTagName = false;
            $inAttrName = false;
            $attrName = '';
            $tagContents = '';
        }
        if ($inTag && !$inAttrValue && $char == ' ') {
            $inTagName = false;
            $inAttrName = true;
            $attrName = '';
        }
        if ($inTag && $inAttrName && $char == '=') {
            $inAttrName = false;
            $inAttrValue = true;
            $attrValue = '';
        }
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

        if ($inTagName && $char != '<') {
            $tagName .= $char;
        }
        if ($inAttrName && $char != ' ') {
            $attrName .= $char;
        }
        if ($inAttrValue && $char != '=' && $char != '"') {
            $attrValue .= $char;
        } elseif (!$inTag && $char != '>') {
            $tagContents .= $char;
        } else {
            $output .= $char;
        }
    }

    return $output;
}

function begin_html_i18n() {
    ob_start(function ($input) {
        return translate_html($input);
    });
}
function end_html_i18n() {
    ob_end_flush();
}