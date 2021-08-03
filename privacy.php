<?php
  require_once __DIR__.'/_backend/preload.php';

  $page['title'] = 'Privacy &sdot; elementary';

  $page['styles'] = array(
    'styles/docs.css'
  );

  include $template['header'];
  include $template['alert'];
  
?>

<div class="grid">
  <div class="two-thirds">
    <h1>Privacy</h1>
    <p>Your data always belongs to you, and only you. We don’t make advertising deals or collect sensitive personal data. We’re funded directly by our users paying what they want for elementary OS and apps on AppCenter. And that’s how it should be.</p>
  </div>
</div>
<div class="row docs">
  <h2>elementary OS</h2>
  <p><strong>We do not collect any data from elementary OS.</strong> Your files, settings, and all other personal data remain on-device unless you explicitly share them with a third-party app or service.</p>
  <h3>Online Accounts</h3>
  <p>elementary OS optionally integrates with online accounts such as email and calendar providers via System Settings. Data from these providers may be retrieved by your local copy of elementary OS and stored locally on your device to be displayed in locally-installed apps such as Mail, Calendar, and Tasks. <strong>This data is not sent to elementary or shared with any third party.</strong></p>
  <h4>What Data is Collected</h4>
  <p>If you choose to add an online account, your local copy of elementary OS may collect and store your name, email address, avatar, email messages, calendar events, contacts, photos, and files from your connected accounts locally on your device. <strong>elementary does not collect any of this data.</strong></p>
  <h4>How Data is Used</h4>
  <p><strong>Your data is stored locally on your device and never sent to elementary servers or any third parties.</strong> It is used to populate your locally-installed apps such as Mail, Calendar, Tasks, Files, and Photos with your data so you can access it.</p>
  <h4>Sharing Data</h4>
  <p><strong>elementary OS does not share any data collected from your online accounts.</strong> The data is never sent to elementary or third-party servers.</p>
</div>
<div class="row docs">
  <h2>elementary.io</h2>
  <h3 data-l10n-off>Plausible Analytics</h3>
  <p>We use the open source Plausible Analytics routed through our <code>stats.elementary.io</code> domain to count website visits, downloads, etc. You can see the same data we can see on <a target="_blank" rel="noopener" href="https://plausible.io/elementary.io">the public dashboard</a>. No cookies are used and no personal data—not even an IP address or browser user agent—is stored. For more information, see the <a class="read-more" target="_blank" rel="noopener" href="https://plausible.io/data-policy">Plausible Data Policy</a></p>
  <h3>Cookies</h3>
  <p><strong>You can choose to disable or selectively turn off any cookies or third-party cookies in your browser settings.</strong></p>
  <p>This site uses cookies for incremental improvements. You may find the services function without them but at a reduced usability. For example, the site will not remember if you have previously paid for elementary OS; by default you will be asked to pay again.</p>
  <h5 data-l10n-off>Cloudflare</h5>
  <p>Stores cookies to log behavioral elements and analyze potential threats. For more information, see the <a class="read-more" target="_blank" rel="noopener" href="https://www.cloudflare.com/security-policy">Cloudflare Privacy &amp; Security Policy</a></p>
  <h5 data-l10n-off>Stripe</h5>
  <p>Uses cookies to remember your last order and your country so it knows what card types to offer for payments. For more information, see <a class="read-more" target="_blank" rel="noopener" href="https://stripe.com/privacy">Stripe's Privacy Policy</a></p>
  <h5>Manage Cookies</h5>
  <p>As you have already visited our site, you may wish to manage cookies already set in your browser. Links to the relevant instructions can be found below.</p>
  <a target="_blank" rel="noopener" href="https://support.google.com/chrome/answer/95647" class="column">
    <img src="images/privacy-policy/chrome_128x128.png" data-l10n-off alt="Google Chrome" class="browsers-list" />
    <h4 data-l10n-off>Chrome</h4>
  </a>
  <a target="_blank" rel="noopener" href="https://support.microsoft.com/en-us/microsoft-edge/delete-cookies-in-microsoft-edge-63947406-40ac-c3b8-57b9-2a946a29ae09" class="column">
    <img src="images/privacy-policy/edge_128x128.png" data-l10n-off alt="Edge" class="browsers-list" />
    <h4 data-l10n-off>Edge</h4>
  </a>
  <a target="_blank" rel="noopener" href="https://help.gnome.org/users/epiphany/stable/data-cookies.html" class="column">
    <img src="images/icons/apps/48/internet-web-browser.svg" data-l10n-off alt="Epiphany" class="browsers-list" />
    <h4 data-l10n-off>Epiphany</h4>
  </a>
  <a target="_blank" rel="noopener" href="https://support.mozilla.org/en-US/kb/delete-cookies-remove-info-websites-stored" class="column">
    <img src="images/privacy-policy/firefox_128x128.png" data-l10n-off alt="Firefox" class="browsers-list" />
    <h4 data-l10n-off>Firefox</h4>
  </a>
  <a target="_blank" rel="noopener" href="http://windows.microsoft.com/en-gb/internet-explorer/delete-manage-cookies" class="column">
    <img src="images/privacy-policy/internet-explorer_128x128.png" data-l10n-off alt="Internet Explorer" class="browsers-list" />
    <h4 data-l10n-off>IE</h4>
  </a>
  <a target="_blank" rel="noopener" href="http://midori-browser.org/faqs/#blacklist_cookies" class="column">
    <img src="images/privacy-policy/midori_256x256.png" data-l10n-off alt="Midori" class="browsers-list" />
    <h4 data-l10n-off>Midori</h4>
  </a>
  <a target="_blank" rel="noopener" href="https://www.opera.com/blogs/news/2015/08/how-to-manage-cookies-in-opera/" class="column">
    <img src="images/privacy-policy/opera_128x128.png" data-l10n-off alt="Opera" class="browsers-list" />
    <h4 data-l10n-off>Opera</h4>
  </a>
  <a target="_blank" rel="noopener" href="http://support.apple.com/kb/PH17191" class="column">
    <img src="images/privacy-policy/safari_128x128.png" data-l10n-off alt="Safari" class="browsers-list" />
    <h4 data-l10n-off>Safari</h4>
  </a>
</div>
<div class="row docs">
  <h2>Transparency</h2>
  <p>We have not placed any backdoors into our software and have not received any requests for doing so. We have also never received a National Security Letter, FISA order, or any other classified request for user information.</p>
</div>

<?php
  include $template['footer'];
?>
