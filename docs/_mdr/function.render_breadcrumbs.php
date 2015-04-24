<?php

function Render_Breadcrumbs($Breadcrumbs) {

    global $Lang, $Libraries, $MDR, $Request, $Settings, $Templates;

    require_once $MDR['Core'].'/function.breadcrumbs.php';
    require_once $MDR['Core'].'/function.url_to_title.php';
    $Crumbs = Breadcrumbs($Breadcrumbs);
    array_shift($Crumbs); // Remove "MDR" from list
    if ( count($Crumbs) > 1 ) {
        echo '<div class="row breadcrumbs"><p>';
        $First = true;
        foreach ( $Crumbs as $Crumb => $URL ) {
            if ( $First ) {
                $First = false;
            } else {
                echo ' > ';
            }
            echo '<a href="'.$URL.'">'.url_to_title($Crumb, $Settings['Capitalize']['Breadcrumbs']).'</a>';
        }
        echo '</p></div>';
    }

}