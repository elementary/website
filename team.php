<?php
    include '_templates/sitewide.php';
    $page['description'] = 'Meet the people behind elementary.';
    $page['title'] = 'Team &sdot; elementary';
    // $page['theme-color'] = '#226BB3';
    $page['scripts'] = '<link rel="stylesheet" type="text/css" media="all" href="styles/team.css">';
    include $template['header'];
    include $template['alert'];
    require_once __DIR__.'/backend/config.loader.php';

    $apiUrl = "https://slack.com/api/users.list?presence=1&token={$config['slack_token']}";
    $apiContent = file_get_contents($apiUrl);
    $apiResponse = json_decode($apiContent, true);

    $apiFilter = array( // Filter certain member IDs from showing up on the page
        "USLACKBOT", // slackbot
        "U0299PY5U", // David Gomes (Fix title!)
        "U0299C8QT", // teemperor (Fix title!)
        "U02RCLE6C", // Gero (Remove "Elementary" from title)
        "U028XTDHM", // Kiran (inactive)
        "U02AEMYH1", // Tom (inactive)
        "U02AENUA1", // Mario (inactive)
    );

    $apiCommunity = array( // List of community members and collaborators
        "U02CH39T2", // nathandyer
        "U0J4L6LLB", // bflo
        "U02DCH8AF", // ikey
        "U043P7SCH", // debarshi.ray
        "U02RZBX56", // sri
        "U0R3F5GUC", // linusbobcat
        "U098RCR0U", // gandalfn
        "U15815M6C", // decathorpe
        "U02C59PF7", // ochosi
        "U1DTKMUK1", // jancborchardt
        "U1E0QSPB2", // mhall119
    );

?>

<section class="grid">
    <div class="two-thirds">
        <h2>We believe in the unique combination of top-notch UX and the world-changing power of Open Source.</h2>
        <p>elementary was founded in 2007 by a small group of passionate volunteers. Over the years, we&rsquo;ve been able to grow into a tiny company and fund the development of open source software. We&rsquo;re a dedicated team of developers, designers, writers, and everyday computer users crafting an incredible open computing experience. We are elementary.</p>
    </div>
</section>
<section class="grid">
    <div class="whole">

        <?php
            if ($apiResponse['ok']) {
        ?>

        <div class="team-directory">

            <?php
                $members = array_filter( $apiResponse['members'], function($member) use ($apiFilter, $apiCommunity) {
                    if ( in_array( $member['id'], $apiFilter ) ) return false;
                    if ( in_array( $member['id'], $apiCommunity ) ) return false;
                    if ( $member['deleted'] ) return false;
                    if ( !isset($member['profile']['title']) || $member['profile']['title'] == '' ) return false;
                    if ( $member['is_bot'] ) return false;

                    return true;
                });

                foreach ( $members as $key => $member ) {
                    // Because some people just want to see the page burn
                    if ( !empty($member['real_name']) ) {
                        $members[$key]['name'] = htmlspecialchars($member['real_name']);
                    } else {
                        $members[$key]['name'] = htmlspecialchars($member['name']);
                    }
                    $members[$key]['profile']['title'] = htmlspecialchars($member['profile']['title']);
                }

                usort( $members, function($a, $b) {
                    if ( $a['id'] == 'U029601AF' ) return -1; // "I'm #1!" ~ Dan
                    if ( $b['id'] == 'U029601AF' ) return 1;

                    if ( $a['is_admin'] && !$b['is_admin'] ) return -1; // Admin's first
                    if ( $b['is_admin'] && !$a['is_admin'] ) return 1;

                    if ( $a['presence'] == 'active' && $b['presence'] != 'active') return -1; // Online people first
                    if ( $b['presence'] == 'active' && $a['presence'] != 'active') return 1;

                    return strcasecmp( $a['name'], $b['name'] ); // Sort alphabetically
                });

                foreach( $members as $member ) {
            ?>

            <div class="member">
                <div class="member_photo" style="background-image:url(<?=$member['profile']['image_192']?>)"></div>
                <h5 class="member_name"><?=$member['name']?><?php if ($member['presence'] == 'active') { ?><img class="member_status" title="Online" src="<?=$sitewide['root'];?>images/team/user-available.svg"><?php } ?></h5>
                <span class="member_title"><?=$member['profile']['title']?></span>
                <span class="member_time"><?=$member['tz_label']?></span>
            </div>

            <?php
                }
            ?>

        </div>
    </div>
</section>
<section class="grid">
    <div class="two-thirds">
        <h2>Community &amp; Collaborators</h2>
        <p>elementary would not exist without the involvement of dedicated community members and collaborators from other free and open source projects.</p>
    </div>
    <div class="whole">
        <div class="team-directory">

            <?php
                $community_members = array_filter( $apiResponse['members'], function($community_member) use ($apiCommunity) {
                    if ( !isset($community_member['profile']['title']) || $community_member['profile']['title'] == '' ) return false;
                    if ( in_array( $community_member['id'], $apiCommunity ) ) return true;
                    return false;
                });

                foreach ( $community_members as $key => $community_member ) {
                    // Because some people just want to see the page burn
                    if ( !empty($community_member['real_name']) ) {
                        $community_members[$key]['name'] = htmlspecialchars($community_member['real_name']);
                    } else {
                        $community_members[$key]['name'] = htmlspecialchars($community_member['name']);
                    }
                    $community_members[$key]['profile']['title'] = htmlspecialchars($community_member['profile']['title']);
                }

                usort( $community_members, function($a, $b) {
                    if ( $a['presence'] == 'active' && $b['presence'] != 'active') return -1; // Online people first
                    if ( $b['presence'] == 'active' && $a['presence'] != 'active') return 1;

                    return strcasecmp( $a['name'], $b['name'] ); // Sort alphabetically
                });

                foreach( $community_members as $community_member ) {
            ?>

            <div class="member">
                <div class="member_photo" style="background-image:url(<?=$community_member['profile']['image_192']?>)"></div>
                <h5 class="member_name"><?=$community_member['name']?><?php if ($community_member['presence'] == 'active') { ?><img class="member_status" title="Online" src="<?=$sitewide['root'];?>images/team/user-available.svg"><?php } ?></h5>
                <span class="member_title"><?=$community_member['profile']['title']?></span>
                <span class="member_time"><?=$community_member['tz_label']?></span>
            </div>

            <?php
                }
            ?>

        </div>

        <?php
            }
        ?>

        <a class="button suggested-action" href="get-involved">Get Involved</a>
        <p class="small-label"><i class="fa fa-slack"></i> Powered by Slack</p>
    </div>
</section>

<?php
    include $template['footer'];
?>
