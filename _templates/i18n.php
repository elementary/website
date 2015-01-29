<?php
$translations = array(
    'A fast and open replacement for Windows and OS X' => 'Un remplaçant rapide et ouvert pour Windows et OS X',
    'Download Freya Beta' => 'Télécharger Freya Beta',
    'Custom' => 'Personnalisé'
);

function translate($string) {
    global $translations;

    if (isset($translations[$string])) {
        return $translations[$string];
    } else {
        return $string;
    }
}

function translate_html($input) {
    $output = '';

    $translatableAttrs = array(
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
            $inTag = true;
            $inTagName = true;
            $tagName = '';

            $output .= translate($tagContents);

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
            foreach ($translatableAttrs as $attrData) {
                if ($tagName == $attrData[0] && $attrName == $attrData[1]) {
                    $output .= translate($attrValue);
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