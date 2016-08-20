<?php
    include '_templates/sitewide.php';
    $page['description'] = 'Meet the people behind elementary.';
    $page['title'] = 'Team &sdot; elementary';
    $page['styles'] = array(
        'styles/team.css'
    );
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
        "U0886H1TM", // robert.ancell
    );

    function getMembers ($raw, $list) {
        global $apiFilter;
        global $apiCommunity;

        $members = array_filter($raw, function($member) use ($list, $apiFilter, $apiCommunity) {
            if ( in_array( $member['id'], $apiFilter ) ) return false;
            if ( $member['deleted'] ) return false;
            if ( !isset($member['profile']['title']) || $member['profile']['title'] == '' ) return false;
            if ( $member['is_bot'] ) return false;

            if ($list === 'team') {
                if ( in_array( $member['id'], $apiCommunity ) ) return false;
            } else if ($list === 'community') {
                if (! in_array( $member['id'], $apiCommunity ) ) return false;
            }

            return true;
        });

        foreach ( $members as $key => $member ) {
            // Because some people just want to see the page burn
            if ( !empty($member['real_name']) ) {
                $members[$key]['name'] = htmlspecialchars($member['real_name']);
            } else {
                $members[$key]['name'] = htmlspecialchars($member['name']);
            }

            $members[$key]['profile']['title'] = htmlspecialchars($members[$key]['profile']['title']);

            // The magical transformation of dirty http links to clean hrefs
            $members[$key]['profile']['title'] = preg_replace("/(https?):\/\/(.*)\.([^\.\s]*)/mi",
                                                              '<a href="$1://$2.$3">$2</a>',
                                                              $members[$key]['profile']['title']);
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

        return $members;
    }
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
                $members = getMembers($apiResponse['members'], 'team');
                foreach( $members as $member ) {
            ?>

            <div class="member">
                <div class="member_photo" style="background-image:url(<?=$member['profile']['image_192']?>)"></div>
                <h5 class="member_name" data-l10n-off="1"><?=$member['name']?><?php if ($member['presence'] == 'active') { ?><img class="member_status" title="Online" src="<?=$sitewide['root'];?>images/team/user-available.svg"><?php } ?></h5>
                <span class="member_title" data-l10n-off="1"><?=$member['profile']['title']?></span>
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
                $community_members = getMembers($apiResponse['members'], 'community');
                foreach( $community_members as $community_member ) {
            ?>

            <div class="member">
                <div class="member_photo" style="background-image:url(<?=$community_member['profile']['image_192']?>)"></div>
                <h5 class="member_name" data-l10n-off="1"><?=$community_member['name']?><?php if ($community_member['presence'] == 'active') { ?><img class="member_status" title="Online" src="<?=$sitewide['root'];?>images/team/user-available.svg"><?php } ?></h5>
                <span class="member_title" data-l10n-off="1"><?=$community_member['profile']['title']?></span>
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
