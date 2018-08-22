<?php

namespace App\Service;

class Slack
{
    /**
     * The slack API endpoint.
     *
     * @var string
     */
    protected static $url = 'https://slack.com/api';

    /**
     * All of the users we will filter out of the active users.
     *
     * @var string[]
     */
    protected static $filterHiddenUsers = array(
        'USLACKBOT', // slackbot
        'U0299PY5U', // David Gomes (Fix title!)
        'U0299C8QT', // teemperor (Fix title!)
        'U028XTDHM', // Kiran (inactive)
    );

    /**
     * All of the community users.
     *
     * @var string[]
     */
    protected static $filterCommunityUsers = array(
        'U02CH39T2', // nathandyer
        'U0J4L6LLB', // bflo
        'U02DCH8AF', // ikey
        'U043P7SCH', // debarshi.ray
        'U02RZBX56', // sri
        'U0R3F5GUC', // linusbobcat
        'U098RCR0U', // gandalfn
        'U15815M6C', // decathorpe
        'U02C59PF7', // ochosi
        'U1DTKMUK1', // jancborchardt
        'U1E0QSPB2', // mhall119
        'U0886H1TM', // robert.ancell
        'U9VND281F', // sarahpandabeara
        'U9M4H3N9K', // shpurk
        'U9W6C2SJF', // Carl Richell
        'UBQ57D4LQ', // TingPing
        'U9ECVDM9V', // mmstick
        'U4N9FC7KN', // jeremys
        'U7B902Y6S', // popey
        'U7MM8V79U', // esodan
        'U02BZA3JZ', // isantop
        'U21C19CEN', // wimpress
        'U2ASB5ABU', // ryansipes
    );

    /**
     * The API key to use when talking to slack.
     *
     * @var string
     */
    protected $key;

    /**
     * Sanatizes member fields.
     *
     * @param array $member
     *
     * @return array
     */
    protected static function sanatizeMember(array $member)
    {
        // Because some people just want to see the page burn
        if (empty($member['real_name']) === false) {
            $member['name'] = htmlspecialchars($member['real_name']);
        } else {
            $member['name'] = htmlspecialchars($member['name']);
        }

        if (isset($member['profile']['title']) === true) {
            $member['profile']['title'] = htmlspecialchars($member['profile']['title']);

            // The magical transformation of dirty http links to clean hrefs
            $linkRegex = '/(https?):\/\/(.*)\.([^\.\s]*)/mi';
            $linkReplace = '<a href="$1://$2.$3">$2</a>';

            $member['profile']['title'] = preg_replace($linkRegex, $linkReplace, $member['profile']['title']);
        }

        return $member;
    }

    /**
     * Filters users based on having properties and being defined lists.
     *
     * @param array $members
     *
     * @return array
     */
    protected static function filterUsers(array $members)
    {
        return array_filter($members, function ($member) {
            if ($member['deleted'] === true) {
                return false;
            }

            if ($member['is_bot'] === true) {
                return false;
            }

            if (in_array($member['id'], static::$filterHiddenUsers)) {
                return false;
            }

            if (isset($member['profile']['title']) === false || trim($member['profile']['title']) == '') {
                return false;
            }

            return true;
        });
    }

    /**
     * Sorts users based on activity and name.
     *
     * @param array $members
     *
     * @return array
     */
    protected static function sortUsers(array $members)
    {
        usort($members, function ($a, $b) {
            // "I'm #1!" ~ Dan
            if ($a['id'] == 'U029601AF') {
                return -1;
            }
            if ($b['id'] == 'U029601AF') {
                return 1;
            }

            // Admin's first
            if ($a['is_admin'] && ! $b['is_admin']) {
                return -1;
            }
            if ($b['is_admin'] && ! $a['is_admin']) {
                return 1;
            }

            // Online people first
            if ($a['presence'] == 'active' && $b['presence'] != 'active') {
                return -1;
            }
            if ($b['presence'] == 'active' && $a['presence'] != 'active') {
                return 1;
            }

            // Sort alphabetically
            return strcasecmp($a['name'], $b['name']);
        });

        return $members;
    }

    /**
     * Creates a new Slack service class.
     *
     * @param string $key The API key to use
     */
    public function __construct($key)
    {
        $this->key = $key;
    }

    /**
     * Grabs the API response.
     *
     * @param string $url
     *
     * @return array
     */
    public function response($url)
    {
        $fullUrl = static::$url.$url.(strpos($url, '?') ? '&' : '?').'token='.$this->key;

        $apiContent = file_get_contents($fullUrl);
        $apiResponse = json_decode($apiContent, true);

        if ($apiResponse['ok'] !== true) {
            // TODO: Log some error here
        }

        return $apiResponse;
    }

    /**
     * Returns a list of all non-blacklisted members in slack.
     *
     * @return array
     */
    public function members()
    {
        $res = $this->response('/users.list?presence=1');

        if (isset($res['members']) === false) {
            return array();
        }

        $members = $res['members'];
        $members = array_map(array(static::class, 'sanatizeMember'), $members);
        $members = static::filterUsers($members);
        $members = static::sortUsers($members);

        return $members;
    }

    /**
     * Returns a list of users in the slack channel.
     *
     * @return array
     */
    public function users()
    {
        return array_filter($this->members(), function ($member) {
            return in_array($member['id'], static::$filterCommunityUsers) === false;
        });
    }

    /**
     * Returns a list of community members in the slack channel.
     *
     * @return array
     */
    public function community()
    {
        return array_filter($this->members(), function ($member) {
            return in_array($member['id'], static::$filterCommunityUsers);
        });
    }
}
