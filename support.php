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
    <img width="64" height="64" src="images/thirdparty-icons/apps/64/appcenter.svg" alt="AppCenter"/>
    <span>AppCenter</span>
  </a>

  <a class="app" href="https://github.com/elementary/calendar/discussions" target="_blank" rel="noopener">
    <img width="64" height="64" src="images/thirdparty-icons/apps/64/calculator.svg" alt="Calendar"/>
    <span>Calculator</span>
  </a>

  <a class="app" href="https://github.com/elementary/calendar/discussions" target="_blank" rel="noopener">
    <img width="64" height="64" src="images/thirdparty-icons/apps/64/calendar.svg" alt="Calendar"/>
    <span>Calendar</span>
  </a>

  <a class="app" href="https://github.com/elementary/camera/discussions" target="_blank" rel="noopener">
    <img width="64" height="64" src="images/thirdparty-icons/apps/64/camera.svg" alt="Camera"/>
    <span>Camera</span>
  </a>

  <a class="app" href="https://github.com/elementary/code/discussions" target="_blank" rel="noopener">
    <img width="64" height="64" src="images/thirdparty-icons/apps/64/code.svg" alt="Code"/>
    <span>Code</span>
  </a>

  <a class="app" href="https://github.com/elementary/files/discussions" target="_blank" rel="noopener">
    <img width="64" height="64" src="images/thirdparty-icons/apps/64/files.svg" alt="Files"/>
    <span>Files</span>
  </a>

  <a class="app" href="https://github.com/elementary/mail/discussions" target="_blank" rel="noopener">
    <img width="64" height="64" src="images/thirdparty-icons/apps/64/mail.svg" alt="Mail"/>
    <span>Mail</span>
  </a>

  <a class="app" href="https://github.com/elementary/music/discussions" target="_blank" rel="noopener">
    <img width="64" height="64" src="images/thirdparty-icons/apps/64/music.svg" alt="Music"/>
    <span>Music</span>
  </a>

  <a class="app" href="https://github.com/elementary/photos/discussions" target="_blank" rel="noopener">
    <img width="64" height="64" src="images/thirdparty-icons/apps/64/photos.svg" alt="Photos"/>
    <span>Photos</span>
  </a>

  <a class="app" href="https://github.com/elementary/terminal/discussions" target="_blank" rel="noopener">
    <img width="64" height="64" src="images/thirdparty-icons/apps/64/terminal.svg" alt="Terminal"/>
    <span>Terminal</span>
  </a>

  <a class="app" href="https://github.com/elementary/videos/discussions" target="_blank" rel="noopener">
    <img width="64" height="64" src="images/thirdparty-icons/apps/64/videos.svg" alt="Videos"/>
    <span>Videos</span>
  </a>

  <a class="app" href="https://github.com/elementary/browser/discussions" target="_blank" rel="noopener">
    <img width="64" height="64" src="images/thirdparty-icons/apps/64/web.svg" alt="Web"/>
    <span>Web</span>
  </a>
</div>

<section class="grid">
  <div class="two-thirds">
    <a href="https://github.com/orgs/elementary/discussions/categories/q-a" target="_blank" rel="noopener" class="read-more">Other Questions &amp; Help</a>
  </div>
</section>

<div class="row">
  <h2>Guides &amp; Documentation</h2>

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

