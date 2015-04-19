<?php
    include __DIR__.'/../_templates/sitewide.php';
    $page['title'] = 'Desktop Team';
    include $template['header'];

    ?>
            <section>
                <div class="row">
                    <h1>Desktop Team</h1>

    <?php

    $Contributors = file_get_contents(__DIR__.'/../backend/contributors/desktop.json');
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

        $Login = $Value['login'];
        $Login = (strlen($Login) > 14) ? substr($Login, 0, 12)."&hellip;" : $Login;

        // TODO Move styles to classes.
        echo '
                    <div class="column third rank-'.$Row.'">
                        <h2 class="text-left"><img src="'.$Value['avatar_url'].'" class="float-left" style="max-width:48px;border-radius:3px;">&emsp;<a href="'.$Value['html_url'].'" target="_blank">'.$Login.'</a></h2>
                        <div style="background:#ecf0f1;height:2rem;margin-bottom:-2rem;width:100%;border-radius:3px;"></div>';
        $Contributions_Percentage = ceil(($Value['contributions']/$Contributions_Max)*100);
        if ( $Contributions_Percentage > 50 ) {
            echo '
                        <div style="border-box;background:#08c;color:#fff;text-align:right;padding:0 .3rem;font-size:1.4em;height:2rem;border-radius:3px;width:'.$Contributions_Percentage.'%;">'.number_format($Value['contributions']).'</div>';
        } else {
            echo '
                        <div style="background:#08c;padding:0;height:2rem;border-radius:3px;width:'.$Contributions_Percentage.'%;"></div>
                        <span class="float-left" style="color:#08c;padding:0 .3rem;font-size:1.4em;height:2rem;margin-top:-2rem;margin-left:'.$Contributions_Percentage.'%;">'.number_format($Value['contributions']).'</span>';
        }
        echo '
                    </div>';

    }

    echo '
                </div>';

    include $template['footer'];