<?php

function Title_Files($Files, $Recursive = true)
{

    global $MDR;

    foreach ($Files as $File => $Title) {
        if (is_array($Title) &&
            (
                !$Recursive ||
                empty($Title)
            )
        ) {
            unset($Files[$File]);
        } elseif (is_array($Title)) {
            $Files[$File] = Title_Files($Title, $Recursive);
        } elseif (empty($Title)) {
            require_once $MDR['Core'].'/function.url_to_title.php';
            $Files[$File] = url_to_title($File);
        }
    }

    return $Files;
}
