<?php
$translations = array(
    'A fast and open replacement for Windows and OS X' => 'Un remplaçant rapide et ouvert pour Windows et OS X',
    'Download Freya Beta' => 'Télécharger Freya Beta'
);

function translate_html($input) {
    global $translations;

    $output = '';

    $inTagContents = false;
    $tagContents = '';
    for ($i = 0; $i < strlen($input); $i++) {
        $char = $input[$i];

        if (!$inTagContents && $char == '>') {
            $inTagContents = true;
            $tagContents = '';
        }
        if ($inTagContents && $char == '<') {
            $inTagContents = false;

            if (isset($translations[$tagContents])) {
                $tagContents = $translations[$tagContents];
            }
            $output .= $tagContents;

            $tagContents = '';
        }

        if (!$inTagContents || $char == '>') {
            $output .= $char;
        } else {
            $tagContents .= $char;
        }
    }

    return $output;
}