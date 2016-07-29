<?php
    include '_templates/sitewide.php';
    $page['name'] = 'capnet-assist';
    $page['title'] = 'You\'re connected! &sdot; elementary';
		$page['scripts'] .= '<link rel="stylesheet" type="text/css" media="all" href="styles/capnet-assist.css">';
    include $template['header'];
    include $template['alert'];
?>

<div class="row">
		<h1>You're connected!</h1>
		<p>Your Internet connection appears to be working. You can safely close this window and continue using your device.</p>
		<h2>Why is this window appearing?</h2>
		<p>elementary OS automatically checks your Internet connection when you connect to a new WiFi network. If it detects there is not an Internet connection (i.e. if you are connecting to a captive portal at a coffee shop or other public location), this window will appear and display the login page.</p>
</div>

<?php
    include $template['footer'];
?>
