<?php

require_once $MDR['Core'].'/function.url_to_title.php';

function Render_Markdown($Source) {

    global $Lang, $Libraries, $MDR, $Request, $Settings, $Templates;
    global $sitewide, $page, $lang;

    $page['title'] = url_to_title(basename($Request['Directory']));

    $Request['Source'] = $Source;
    $Request['Source'] = str_replace($MDR['Root'], '', $Request['Source']);
    include $Templates['Header'];

    // Breadcrumbs
    require_once $MDR['Core'].'/function.breadcrumbs.php';
    require_once $MDR['Core'].'/function.url_to_title.php';
    $Crumbs = Breadcrumbs($Request['Trimmed']);
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

    echo '<div class="row docs">';

    $Content = file_get_contents($Source);
    require_once $Libraries['Parsedown'];
    require_once $Libraries['ParsedownExtra'];
    $Parsedown = new ParsedownExtra();
    $Content = $Parsedown->text($Content);
    $Content = str_replace('⌘', '&#8984;', $Content);
    $Content = translate_html($Content);
    echo $Content;

    echo '</div>';
    include $Templates['Footer'];

}