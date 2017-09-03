<?php
    require_once __DIR__.'/_backend/preload.php';

    $page['name'] = 'capnet-assist';
    $page['title'] = 'You\'re connected! &sdot; elementary';

    $page['styles'] = array(
        'styles/capnet-assist.css'
    );

    $scriptless = true;
    include $template['header'];
?>

<div class="row">
		<h1>You're connected!</h1>
		<p>Your Internet connection appears to be working. No need to log in.</p>
		<h2>Why does this window appear?</h2>
		<p>When connecting to a Wi-Fi network with its own login page, (in places like coffee shops,) elementary OS automatically checks to see if a connection to the Internet can be established without logging in. If so, this window will appear, which is safe to close.</p>
</div>

<?php
    include $template['footer'];
?>
