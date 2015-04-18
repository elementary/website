<?php
/**
 * Fetch tweets favorited & retweeted by @elementary and
 * put them in tweets.json file
 * access tokens should be stored in twitter-tokens.php
 */

require_once(dirname(__FILE__) . '/config.php');

if (php_sapi_name() != 'cli') {
    die('This script can only be run from command line');
}

function log_info($msg) { // Basic logger
    echo $msg . PHP_EOL;
}

class TwApi {
    protected $consumer_key;
    protected $consumer_secret;
    protected $access_token;
    protected $access_secret;
    protected $oauth;

    function TwApi($token, $secret) {
        global $config;

        $this->access_token = $token;
        $this->access_secret = $secret;

        $this->consumer_key = $config['twitter_consumer_key'];
        $this->consumer_secret = $config['twitter_consumer_secret'];

        $this->oauth = array(
            'oauth_consumer_key' => $this->consumer_key,
            'oauth_token' => $this->access_token,
            'oauth_signature_method' => 'HMAC-SHA1',
            'oauth_timestamp' => time(),
            'oauth_nonce' => time(),
            'oauth_version' => '1.0'
            );
    }

    function build_url($request, $params) {
        $url = 'https://api.twitter.com/1.1/' . $request;

        if(count($params)) {
            $query = array();

            foreach($params as $key=>$value) {
                $query[] = $key . '=' . rawurlencode($value);
            }
            $url .= '?' . implode('&', $query);
        }

        return $url;
    }

    function build_base_string($request, $method, $params) {
        $r = array();
        ksort($params);
        foreach($params as $key=>$value) {

            if($key == 'oauth_signature') {
                continue;
            }

            $r[] = $key . '=' . rawurlencode($value);
        }

        return $method.'&'.rawurlencode('https://api.twitter.com/1.1/' . $request).'&'.
            rawurlencode(implode('&', $r)); //return complete base string
    }

    function build_authorization_header() {
        $r = 'Authorization: OAuth ';
        $values = array();
        foreach($this->oauth as $key=>$value) {
            $values[] = $key . '=' . rawurlencode($value);
        }

        $r .= implode(', ', $values);
        return $r;
    }

    function build_signature($request, $params) {
        $all_params = array_merge($params, $this->oauth);
        $base_info = $this->build_base_string($request, 'GET', $all_params);

        $composite_key = rawurlencode($this->consumer_secret) . '&' .
            rawurlencode($this->access_secret);

        $oauth_signature = base64_encode(hash_hmac('sha1', $base_info,
                                                   $composite_key, true));

        $this->oauth['oauth_signature'] = $oauth_signature;
    }

    function send_request($request, $params) {
        $url = $this->build_url($request, $params);
        $this->build_signature($request, $params);

        $header = array($this->build_authorization_header(), 'Expect:');
        $options = array(
            CURLOPT_HTTPHEADER => $header,
            CURLOPT_HEADER => false,
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => false);

        $feed = curl_init();
        curl_setopt_array($feed, $options);
        $json = curl_exec($feed);
        curl_close($feed);

        $twitter_data = json_decode($json);
        return $twitter_data;
    }

    function verify_credentials() {
        $request = 'account/verify_credentials.json';
        $params = array();

        $result = $this->send_request($request, $params);
        return $result;
    }

    function user_lookup($list) {
        $request = 'users/lookup.json';
        $params = array('user_id'=>$list);

        $result = $this->send_request($request, $params);
        return $result;
    }

    function get_favorites($user_id, $count = 10) {
        $request = 'favorites/list.json';
        $params = array('user_id' => $user_id,
                        'count' => $count);

        $result = $this->send_request($request, $params);

        return $result;

    }
}

$api = new TwApi($config['twitter_access_token'],
                 $config['twitter_access_secret']);

log_info('Fetching tweets.');
$favs = $api->get_favorites('elementary');
log_info('Fetched tweets');

$tweets = array();

foreach($favs as $fav) {
    $tweet = array();

    // only add tweets if they were retweeted & favorited
    if ($fav->retweeted == 1) {
        $tweet['name'] = $fav->user->name;
        $tweet['handle'] = $fav->user->screen_name;
        $tweet['text'] = $fav->text;
        $tweet['timestamp'] = $fav->created_at;

        array_push($tweets, $tweet);
    }
}

log_info('Writing tweets to file.');
file_put_contents(dirname(__FILE__) . '/tweets.json',
                  json_encode($tweets, JSON_PRETTY_PRINT));
log_info('Done.');
?>
