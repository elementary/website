<?php
    require_once __DIR__.'/_backend/preload.php';

    $page['title'] = 'Privacy Policy &sdot; elementary';

    include $template['header'];
    include $template['alert'];
?>
            <div class="row">
                <h1>Privacy Policy</h1>
                <h3>Do Not Track</h3>
                <p>This site honors the do-not-track setting found in most modern browsers and disables Google Analytics when it is present. We cannot automatically remove other tracking methods without severely impacting the use of the site. Should you wish to manually manage these tracking methods, reference the section on disabling cookies.</p>
                <h3>Cookies</h3>
                <p class="text-center"><strong>You can choose to disable or selectively turn off any cookies or third-party cookies in your browser settings.</strong></p>
                <p>This site uses cookies for incremental improvements. You may find the services function without them but at a reduced usability. For example, the site will not remember if you have previously paid for elementary OS; by default you will be asked to pay again.</p>
                <h5 data-l10n-off>CloudFlare</h5>
                <p>Stores cookies to log behavioral elements and analyze potential threats. For more information, see the <a class="read-more" target="_blank" rel="noopener" href="https://www.cloudflare.com/security-policy">CloudFlare Privacy &amp; Security Policy</a></p>
                <h5 data-l10n-off>Google Analytics</h5>
                <p>Stores cookies to collect information—including the number of visitors to this site, from where they were referred, and the pages they visit—in an anonymous form. This information is used to help improve the site. For more information, see Google's article on <a class="read-more" target="_blank" rel="noopener" href="https://support.google.com/analytics/answer/6004245">Safeguarding Your Data</a></p>
                <h5 data-l10n-off>Stripe</h5>
                <p>Uses cookies to remember your last order and your country so it knows what card types to offer for payments. For more information, see <a class="read-more" target="_blank" rel="noopener" href="https://stripe.com/privacy">Stripe's Privacy Policy</a></p>
                <h5>Manage Cookies</h5>
                <p>As you have already visited our site, you may wish to manage cookies already set in your browser. Links to the relevant instructions can be found below.</p>
                <a target="_blank" rel="noopener" href="https://support.google.com/chrome/answer/95647" class="column">
                    <img src="images/privacy-policy/chrome_128x128.png" data-l10n-off alt="Google Chrome" class="browsers-list" />
                    <h4 data-l10n-off>Chrome</h4>
                </a>
                <a target="_blank" rel="noopener" href="https://support.mozilla.org/en-US/kb/delete-cookies-remove-info-websites-stored" class="column">
                    <img src="images/privacy-policy/firefox_128x128.png" data-l10n-off alt="Firefox" class="browsers-list" />
                    <h4 data-l10n-off>Firefox</h4>
                </a>
                <a target="_blank" rel="noopener" href="http://windows.microsoft.com/en-gb/internet-explorer/delete-manage-cookies" class="column">
                    <img src="images/privacy-policy/internet-explorer_128x128.png" data-l10n-off alt="Internet Explorer" class="browsers-list" />
                    <h4 data-l10n-off>IE</h4>
                </a>
                <a target="_blank" rel="noopener" href="https://www.opera.com/blogs/news/2015/08/how-to-manage-cookies-in-opera/" class="column">
                    <img src="images/privacy-policy/opera_128x128.png" data-l10n-off alt="Opera" class="browsers-list" />
                    <h4 data-l10n-off>Opera</h4>
                </a>
                <a target="_blank" rel="noopener" href="http://support.apple.com/kb/PH17191" class="column">
                    <img src="images/privacy-policy/safari_128x128.png" data-l10n-off alt="Safari" class="browsers-list" />
                    <h4 data-l10n-off>Safari</h4>
                </a>
                <a target="_blank" rel="noopener" href="http://midori-browser.org/faqs/#blacklist_cookies" class="column">
                    <img src="images/privacy-policy/midori_256x256.png" data-l10n-off alt="Midori" class="browsers-list" />
                    <h4 data-l10n-off>Midori</h4>
                </a>
                <a target="_blank" rel="noopener" href="https://help.gnome.org/users/epiphany/stable/data-cookies.html" class="column">
                    <img src="images/icons/apps/48/internet-web-browser.svg" data-l10n-off alt="Epiphany" class="browsers-list" />
                    <h4 data-l10n-off>Epiphany</h4>
                </a>
                <h3>Transparency</h3>
                <p>We have not placed any backdoors into our software and have not received any requests for doing so. We have also never received a National Security Letter, FISA order, or any other classified request for user information.</p>
            </div>
<?php
    include $template['footer'];
?>
