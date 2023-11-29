<?php

require_once __DIR__.'/settings.php';

use ParsedownExtra;

if (is_readable($Request['Directory']) ||
    is_readable($Request['Markdown'])
) {
    if (is_dir($Request['Directory'])) {
        // List pages

        // Header
        require_once $MDR['Core'].'/function.url_to_title.php';
        $page['title'] = url_to_title(basename($Request['Directory']));
        include $Templates['Header'];
        echo '<div class="row docs-index">';
        require_once $MDR['Core'].'/function.url_to_title.php';
        $Title = url_to_title($Request['Trimmed']);
        if (!empty($Title)) {
            echo '<h2>'.$Title.'</h2>';
        }

        // Find Suitable Files
        require_once $MDR['Core'].'/function.find_files.php';
        $Files = Find_Files($Request['Directory']);
        ksort($Files);

        require_once $MDR['Core'].'/function.title_files.php';
        $Files = Title_Files($Files);

        // List suitable files, or error accordingly.
        if (empty($Files)) {
            // Don't 404, because the directory does exist.
            echo '<h3>'.$Lang['en']['NO_FILES_IN_DIRECTORY'].'</h3>';
        } else {
            require_once $MDR['Core'].'/function.list_files.php';
            echo List_Files($Files);
        }

        // Footer
        echo '</div>';
        include $Templates['Footer'];
    } else {
        // Render the file

        if (is_readable($Request['Directory'])) {
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

        // Syntax highlighting
        $page['scripts'] = array(
            'scripts/docs/main.js'
        );

        $page['styles'] = array(
            'styles/solarized_light.css',
            'styles/solarized_dark_bash.css',
            'styles/docs.css'
        );

        $page['theme-color'] = '#403757';

        include $Templates['Header'];
        echo '<div class="row docs">';
        include $Templates['Alert'];

        $Parsedown = new ParsedownExtra();
        $Content = $Parsedown->text($Content);
        $Content = str_replace('⌘', '&#8984;', $Content);
        $Content = str_replace('{#release_filename}', $config['release_filename'], $Content);
        $Content = str_replace('{#release_sha256}', $config['release_sha256'], $Content);
        $Content = str_replace('{#release_faq}', $config['release_faq'], $Content);

        // Replace any of the scripts specified in the markdown with our cache-busted versions
        // from the manifest
        $scriptPattern = '/src\s*=\s*"(scripts.*.js)"/';
        $Content = preg_replace_callback($scriptPattern, function ($match) use ($scriptsManifest) {
            return str_replace($match[1], $scriptsManifest[$match[1]], $match[0]);
        }, $Content);

        $Content = $l10n->translateHtml($Content);
        echo $Content;

        echo '</div>';
        include $Templates['Footer'];
    }
} else {
    // Page not found
    header($_SERVER['SERVER_PROTOCOL'].' 404 Not Found');
    include $MDR['Root'].'/404.php';
}
