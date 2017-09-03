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
		<p>Some places that share Internet access, (like coffee shops,) often present a login page first. When elementary OS is able to log in anyway, this window will appear, which is safe to close.</p>
</div>

<?php
    include $template['footer'];
?>
