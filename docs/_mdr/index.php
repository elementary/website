<?php

require_once __DIR__.'/settings.php';

if (
    is_readable($Request['Directory']) ||
    is_readable($Request['Markdown'])
) {
    if ( is_dir($Request['Directory']) ) {
        // List pages

        // Load `index.md` instead if available
        $Request['Index'] = $Request['Directory'].'/index.md';
        if ( is_readable($Request['Index']) ) {
            require_once $MDR['Core'].'/function.render_markdown.php';
            Render_Markdown($Request['Index']);
        } else {
            // Header
            require_once $MDR['Core'].'/function.url_to_title.php';
            $page['title'] = url_to_title(basename($Request['Directory']));
            include $Templates['Header'];

            // Breadcrumbs
            require_once $MDR['Core'].'/function.render_breadcrumbs.php';
            Render_Breadcrumbs($Request['Trimmed']);

            echo '<div class="row docs-index">';

            // Heading
            require_once $MDR['Core'].'/function.url_to_title.php';
            $Title = $page['title'];
            if ( !empty($Title) ) {
                echo '<h1>'.$Title.'</h1>';
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
        }

    } else {
        // Render the file

        if ( is_readable($Request['Directory']) ) {
            // Apparently this isn't a directory, just a poorly named file.
            $Source = $Request['Directory'];
        } else {
            $Source = $Request['Markdown'];
        }
        $Request['Source'] = str_replace($MDR['Root'], '', $Source);

        require_once $MDR['Core'].'/function.render_markdown.php';
        Render_Markdown($Source);
    }
} else {
    // Page not found
    header($_SERVER['SERVER_PROTOCOL'].' 404 Not Found');
    include $MDR['Root'].'/404.php';
}