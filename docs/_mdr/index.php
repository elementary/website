<?php

require_once __DIR__.'/settings.php';

if (
    is_readable($Request['Directory']) ||
    is_readable($Request['Markdown'])
) {
    if ( is_dir($Request['Directory']) ) { // List pages
        // Index Header
        include $Templates['Header'];
        echo '<div class="row">';
        require_once $MDR['Core'].'/function.url_to_title.php';
        $Title = url_to_title($Request['Trimmed']);
        if ( !empty($Title) ) {
            echo '<h2>'.$Title.'</h2>';
        }

        // Find Suitable Files
        require_once $MDR['Core'].'/function.find_files.php';
        $Files = Find_Files($Request['Directory']);
        ksort($Files);

        require_once $MDR['Core'].'/function.title_files.php';
        $Files = Title_Files($Files);

        // List suitable files, or error accordingly.
        if ( empty($Files) ) {
            // Don't 404, because the directory does exist.
            echo '<h3>'.$Lang['en']['NO_FILES_IN_DIRECTORY'].'</h3>';
        } else {
            require_once $MDR['Core'].'/function.list_files.php';
            echo List_Files($Files);
        }

        // Footer
        echo '</div>';
        include $Templates['Footer'];
    } else { // Render the file
        if ( is_readable($Request['Directory']) ) {
            // Apparently this isn't a directory, just a poorly named file.
            $Content = file_get_contents($Request['Directory']);
            $Request['Source'] = $Request['Directory'];
        } else {
            $Content = file_get_contents($Request['Markdown']);
            $Request['Source'] = $Request['Markdown'];
        }
        $Request['Source'] = str_replace($MDR['Root'], '', $Request['Source']);

        require_once $MDR['Core'].'/function.url_to_title.php';
        $page['title'] = url_to_title(basename($Request['Source'], '.md'));
        include $Templates['Header'];
        echo '<div class="row">';

        set_l10n_domain(trim($sitewide['path'], '/'));

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
} else { // File not found
    header($_SERVER['SERVER_PROTOCOL'].' 404 Not Found');
    include $MDR['Root'].'/404.php';
}
