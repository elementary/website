<?php

function Render_Markdown($Source) {

    global $Lang, $Libraries, $MDR, $Request, $Settings, $Templates;
    global $sitewide, $page;

    require_once $MDR['Core'].'/function.url_to_title.php';
    $page['title'] = url_to_title(basename($Request['Directory']));

    $Request['Source'] = $Source;
    $Request['Source'] = str_replace($MDR['Root'], '', $Request['Source']);
    include $Templates['Header'];

    // Breadcrumbs
    require_once $MDR['Core'].'/function.render_breadcrumbs.php';
    Render_Breadcrumbs($Request['Trimmed']);

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