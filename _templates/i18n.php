<?php
$translations = array(
    'A fast and open replacement for Windows and OS X' => 'Un remplaçant rapide et ouvert pour Windows et OS X',
    'Download Freya Beta' => 'Télécharger Freya Beta'
);

function translate_html($input) {
    global $translations;

    $output = '';

    $inTag = false;
    $tagContents = '';
    $inTagName = false;
    $tagName = '';
    for ($i = 0; $i < strlen($input); $i++) {
        $char = $input[$i];

        if ($inTag && $char == '>') {
            $inTag = false;
            $inTagName = false;
            $tagContents = '';
        }
        if (!$inTag && $char == '<') {
            $inTag = true;
            $inTagName = true;
            $tagName = '';

            if (isset($translations[$tagContents])) {
                $tagContents = $translations[$tagContents];
            }
            $output .= $tagContents;

            $tagContents = '';
        }
        if ($inTagName && $char == ' ') {
            $inTagName = false;
        }

        if ($inTagName && $char != '<') {
            $tagName .= $char;
        }
        if ($inTag || $char == '>') {
            $output .= $char;
        } else {
            $tagContents .= $char;
        }
    }

    return $output.implode(', ', $tags);
}