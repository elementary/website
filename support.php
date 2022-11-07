<?php

require_once __DIR__.'/_backend/preload.php';

$page['title'] = 'Support &sdot; elementary';

$page['styles'] = array(
  'styles/support.css'
);

include $template['header'];
include $template['alert'];
?>

<section class="grid">
  <div class="two-thirds">
    <h1>Community-Powered Support</h1>
    <p>Reach out to and participate in our global community. Search for questions, ask your own, or help out by sharing your knowledge. Pick an app or component below to view its specific discussions.</p>
  </div>
</section>

<div class="row apps">
  <a class="app" href="https://github.com/elementary/appcenter/discussions" target="_blank" rel="noopener">
    <img width="64" height="64" src="images/icons/apps/64/system-software-install.svg" alt="AppCenter"/>
    <span>AppCenter</span>
  </a>

  <a class="app" href="https://github.com/elementary/calendar/discussions" target="_blank" rel="noopener">
    <img width="64" height="64" src="images/icons/apps/64/accessories-calculator.svg" alt="Calendar"/>
    <span>Calculator</span>
  </a>

  <a class="app" href="https://github.com/elementary/calendar/discussions" target="_blank" rel="noopener">
    <img width="64" height="64" src="images/icons/apps/64/office-calendar.svg" alt="Calendar"/>
    <span>Calendar</span>
  </a>

  <a class="app" href="https://github.com/elementary/camera/discussions" target="_blank" rel="noopener">
    <img width="64" height="64" src="images/icons/apps/64/accessories-camera.svg" alt="Camera"/>
    <span>Camera</span>
  </a>

  <a class="app" href="https://github.com/elementary/code/discussions" target="_blank" rel="noopener">
    <img width="64" height="64" src="images/thirdparty-icons/apps/64/io.elementary.code.svg" alt="Code"/>
    <span>Code</span>
  </a>

  <a class="app" href="https://github.com/elementary/files/discussions" target="_blank" rel="noopener">
    <img width="64" height="64" src="images/icons/apps/64/system-file-manager.svg" alt="Files"/>
    <span>Files</span>
  </a>

  <a class="app" href="https://github.com/elementary/mail/discussions" target="_blank" rel="noopener">
    <img width="64" height="64" src="images/icons/apps/64/internet-mail.svg" alt="Mail"/>
    <span>Mail</span>
  </a>

  <a class="app" href="https://github.com/elementary/music/discussions" target="_blank" rel="noopener">
    <img width="64" height="64" src="images/icons/apps/64/multimedia-audio-player.svg" alt="Music"/>
    <span>Music</span>
  </a>

  <a class="app" href="https://github.com/elementary/photos/discussions" target="_blank" rel="noopener">
    <img width="64" height="64" src="images/icons/apps/64/multimedia-photo-manager.svg" alt="Photos"/>
    <span>Photos</span>
  </a>

  <a class="app" href="https://github.com/elementary/terminal/discussions" target="_blank" rel="noopener">
    <img width="64" height="64" src="images/icons/apps/64/utilities-terminal.svg" alt="Terminal"/>
    <span>Terminal</span>
  </a>

  <a class="app" href="https://github.com/elementary/videos/discussions" target="_blank" rel="noopener">
    <img width="64" height="64" src="images/icons/apps/64/multimedia-video-player.svg" alt="Videos"/>
    <span>Videos</span>
  </a>

  <a class="app" href="https://github.com/elementary/browser/discussions" target="_blank" rel="noopener">
    <img width="64" height="64" src="images/icons/apps/64/web-browser.svg" alt="Web"/>
    <span>Web</span>
  </a>
</div>

<div class="row">
  <h2>User Guides &amp; Documentation</h2>

  <a class="column third" href="/docs/installation">
    <i class="fa fa-download"></i>
    <h3>Installation</h3>
    <p>Get help installing elementary OS with our step-by-step guide.</p>
  </a>

  <a class="column third" href="/docs/learning-the-basics">
    <i class="fa fa-book"></i>
    <h3>Learning the Basics</h3>
    <p>Walk through the desktop, multi-tasking, keyboard shortcuts and more.</p>
  </a>
</div>

<section class="grid">
  <div class="two-thirds">
    <h2>Payment &amp; Download Support</h2>
    <p>If you need help with your purchase of elementary OS—for example, downloading your copy or requesting a refund—please reply to your email receipt and a team member will contact you as soon as possible.</p>
  </div>
</div>

<?php
include $template['footer'];
?>
