<?php
    include __DIR__.'/_backend/preload.php';

    $page['name'] = 'capnet-assist';
    $page['title'] = 'You\'re connected! &sdot; elementary';

    $page['styles'] = array(
        'styles/capnet-assist.css'
    );

    include $template['header'];
    include $template['alert'];
?>

<div class="row">
		<h1>You're connected!</h1>
		<p>Your Internet connection appears to be working. You can safely close this window and continue using your device.</p>
		<h2>Why is this window appearing?</h2>
		<p>elementary OS automatically checks your Internet connection when you connect to a new WiFi network. If it detects there is not an Internet connection (i.e. if you are connecting to a captive portal at a coffee shop or other public location), this window will appear and display the login page.</p>
		<p>Some networks can appear to be a captive portal at first, triggering this window, then actually end up connecting. In those cases, you'll see this message and can safely close the window.</p>
</div>

<?php
    include $template['footer'];
?>
