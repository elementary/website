<?php
    include __DIR__.'/../_templates/sitewide.php';
    $page['title'] = 'Web Team';
    include $template['header'];

    ?>
            <section>
                <div class="row">
                    <h1>Web Team</h1>
                    <div class="actions float-right">
                        <!-- TODO integrate with classes on /get-involved -->
                        <a class="button flat suggested-action" style="background:#d53c12;border:#d53c12;" href="https://github.com/elementary/mvp" target="_blank">Fork Us on GitHub</a>
                        <a class="button flat" href="https://github.com/elementary/mvp/issues" target="_blank">See Our Open Bug Reports</a>
                    </div>
                    <p>Our website is built using HTML, CSS, PHP and JavaScript. We're always looking for people experienced in those areas who would like to contribute and make it even better. Most of the design work is done by our Design Team, but we love design ideas and feedback for our Web Team. This site is developed on <a href="https://github.com/elementary/mvp" target="_blank">GitHub</a> and licensed under <a href="https://github.com/elementary/mvp/blob/LICENSE.md" target="_blank">the MIT License</a>, making it completely open-source. You can even view the <a href="https://github.com/elementary/mvp/blob/teams/web.php" target="_blank">source code of this page</a>, or the how we <a href="https://github.com/elementary/mvp/blob/backend/contributors.php" target="_blank">fetch</a> all the data.</p>

    <?php

    $Contributors = file_get_contents(__DIR__.'/../backend/contributors.json');
    $Contributors = json_decode($Contributors, true);
    // The highest contributor is first.
    $Contributions_Max = $Contributors[0]['contributions'];
    $Row = 0;

    foreach ( $Contributors as $Value ) {

        if ( $Row % 3 == 0 ) {
            echo '
                </div>
                <div class="row">';
        }
        $Row++;

        // TODO Move styles to classes.
        echo '
                    <div class="column third rank-'.$Row.'">
                        <h2 class="text-left"><img src="'.$Value['avatar_url'].'" class="float-left" style="max-width:48px;border-radius:3px;">&emsp;<a href="'.$Value['html_url'].'" target="_blank">'.$Value['login'].'</a></h2>
                        <div style="background:#ecf0f1;height:2rem;margin-bottom:-2rem;width:100%;border-radius:3px;"></div>';
        $Contributions_Percentage = ceil(($Value['contributions']/$Contributions_Max)*100);
        if ( $Contributions_Percentage > 50 ) {
            echo '
                        <div style="border-box;background:#08c;color:#fff;text-align:right;padding:0 .3rem;font-size:1.4em;height:2rem;border-radius:3px;width:'.$Contributions_Percentage.'%;">'.$Value['contributions'].'</div>';
        } else {
            echo '
                        <div style="background:#08c;padding:0;height:2rem;border-radius:3px;width:'.$Contributions_Percentage.'%;"></div>
                        <span class="float-left" style="color:#08c;padding:0 .3rem;font-size:1.4em;height:2rem;margin-top:-2rem;margin-left:'.$Contributions_Percentage.'%;">'.$Value['contributions'].'</span>';
        }
        echo '
                    </div>';

    }

    echo '
                </div>';

    include $template['footer'];