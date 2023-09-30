<?php
require_once __DIR__.'/_backend/classify.current.php';
require_once __DIR__.'/_backend/preload.php';
require_once __DIR__.'/_backend/os-payment.php';

$page['title'] = $sitewide['description'] . ' &sdot; elementary OS';

$page['scripts'] = array(
  'scripts/download.js',
  'scripts/blog.js',
  'scripts/showcase.run.js'
);

$page['styles'] = array(
  'styles/home.css',
  'styles/blog.css'
);

$already_paid = (os_payment_getcookie($config['release_version']) > 0);
$sendPaymentAnalytics = false;

$stripe = new \Stripe\StripeClient([
  "api_key" => $config['stripe_sk'],
  "stripe_version" => "2023-08-16"
]);

if (isset($_GET['checkout_session_id'])) {
    if ($already_paid) {
        header("Location: " . $sitewide['root']);
        die();
    }

    try {
        $session = $stripe->checkout->sessions->retrieve($_GET['checkout_session_id']);
    } catch (Exception $e) {
        header("Location: " . $sitewide['root']);
        die();
    }

    if ($session->status === "expired") {
        header("Location: " . $sitewide['root']);
        die();
    }

    $paymentAmount = $session->amount_total;
    $paid = false;

    if (!$already_paid) {
        $sendPaymentAnalytics = true;
    }

    if ($session->payment_status === "paid") {
        $paid = true;
        $already_paid = true;
        os_payment_setcookie($config['release_version'], $session->amount_total);
    }

    $page['scripts'][] = 'scripts/payment-complete.js';
}

include $template['header'];
include $template['alert'];
?>

    <script>
        <?php if ($sendPaymentAnalytics && $paid) {?>
            plausible('Payment', {
                props: {
                    Input: <?php echo($paymentAmount)?>,
                    Amount: <?php echo($paymentAmount)?>,
                    Action: 'Complete'
                }
            });
        <?php } elseif ($sendPaymentAnalytics) { ?>
            plausible('Payment', {
                props: {
                    Input: <?php echo($paymentAmount)?>,
                    Amount: 0,
                    Action: 'Failed'
                }
            });
        <?php }?>
    </script>

    <section class="section--hero section--stretched">
      <div class="section__detail grid">
        <div class="whole">
          <h1 id="logotype" alt="elementary OS"><?php include __DIR__.'/images/logotype-os.svg'; ?></h1>
          <p><?php echo $sitewide['description']; ?></p>
        </div>
      </div>

      <div class="section__showcase">
        <img class="bg" src="images/home/notebook.jpg" alt="Generic laptop computer" />
        <img src="images/screenshots/desktop.jpg" alt="elementary OS 7 Horus desktop" />
      </div>

      <div class="section__detail grid">
        <div class="whole">
          <div id="amounts">
            <?php
            if (!$already_paid) {
                ?>
            <h4 id="pay-what-you-want">Pay What You Can:</h4>
            <div id="choice-buttons">
              <button id="amount-ten"  value="10" class="small-button payment-button target-amount">10</button>
              <button id="amount-twenty" value="20" class="small-button payment-button target-amount checked">20</button>
              <button id="amount-thirty" value="30" class="small-button payment-button target-amount">30</button>
              <div>
                <span class="pre-amount">$</span>
                <input type="number" step="0.01" min="0" max="999999.99" id="amount-custom" class="button small-button target-amount" placeholder="Custom">
                <p class="small-label focus-reveal text-center">Enter any dollar amount.</p>
              </div>
            </div>
                <?php
            }
            ?>
            <div class="column">
              <form id="payment-form" action="<?php echo $sitewide['root']?>api/create-checkout-session" method="POST">
                <button type="submit" id="download" class="suggested-action"><?php echo ($already_paid) ? "Download elementary OS" : "Purchase elementary OS"; ?></button>
                <input type="hidden" name="amount" id="hidden-amount" value="2000"/>
                <input type="hidden" name="description" value="<?php echo ($config['release_title'] . ' ' . $config['release_version']); ?>"/>
              </form>
              <p class="small-label">
                <span data-l10n-off="1">elementary OS <?php echo $config['release_version'] . ' ' . $config['release_title']; ?> (<?php echo $config['release_size']; ?>)</span><br>
                <a href="docs/installation#recommended-system-specifications" target="_blank" rel="noopener">Recommended System Specs</a> |
                <a href="<?php echo $config['release_faq'] ?>" target="_blank" rel="noopener">FAQ</a>
              </p>
            </div>
            <div style="clear:both;"></div>

            <?php
            if ($already_paid) {
                ?>
            <div id="choice-buttons">
              <input type="hidden" id="amount-twenty" value="0">
            </div>
                <?php
            }
            ?>
          </div>
        </div>
      </div>
    </section>
    <section id="whats-new" class="grey">
      <div class="grid">
        <div class="two-thirds">
          <h2>What’s New in elementary OS 7</h2>
          <p>Forward thinking and designed for real life with an improved sideloading and alt store experience, power profiles management, and using a next generation UI toolkit. OS 7 Helps you get the apps you need, Empowers you with new features and settings, and evolves our developer platform.</p>
          <a href="https://blog.elementary.io/os-7-available-now/" target="_blank" rel="noopener" class="read-more">Read the Announcement</a>
        </div>
      </div>
    </section>
    <section id="appcenter">
      <div class="app-display app-display--overflow">
        <img class="app-display__image" src="images/screenshots/appcenter.png" width="1165" height="912" alt="elementary OS AppCenter home page"/>
        <div class="app-display__description">
          <img src="images/icons/apps/128/system-software-install.svg" alt="elementary AppCenter icon"/>
          <h2>Get it on <strong>AppCenter</strong></h2>
          <p>Get free and paid apps on AppCenter, the open, pay-what-you-can app store for indie developers. Each app has been reviewed and curated by elementary to ensure a native, privacy-respecting, and secure experience.</p>
          <div class="buttons">
            <a href="https://appcenter.elementary.io" target="_blank" rel="noopener" class="button flat">Discover AppCenter Apps</a>
            <a href="https://blog.elementary.io/tags#appcenter-spotlight" target="_blank" rel="noopener" class="button flat">Read AppCenter Spotlight</a>
            <a href="developer" class="button flat">Become a Developer</a>
          </div>
        </div>
      </div>
    </section>
    <section id="workflow" class="grey">
      <div class="grid">
        <div class="two-thirds">
          <h1>Get Work Done. Or Play.</h1>
          <p>Stay productive and focused with Multitasking View, Picture-in-Picture, Do Not Disturb, and more. Or keep work out of sight when watching videos or playing games.</p>
        </div>
      </div>
      <div class="grid">
        <div class="third">
          <figure class="multitasking">
            <div class="workspace"></div>
          </figure>
          <h4>Multitasking View</h4>
          <p>Workspaces help organize your work by task. Keep work and play separate, but just one swipe or tap away.</p>
        </div>
        <div class="third">
          <figure class="pip">
            <div class="workspace">
              <img class="window" src="images/screenshots/videos.png" width="1124" height="555" alt="Videos screenshot" />
            </div>
          </figure>
          <h4>Picture-in-Picture</h4>
          <p>Whether you’re watching a movie, game, or terminal process, Picture-in-Picture helps keep tabs on one thing while working on another. </p>
        </div>
        <div class="third">
          <figure class="dnd">
            <div class="workspace">
              <img class="window" src="images/screenshots/code.png" width="1174" height="703" alt="Code screenshot" />
              <div class="notification" type="notification">
                <img src="images/icons/apps/64/internet-mail.svg" />
              </div>
              <div class="notification" type="notification">
                <img src="images/icons/apps/64/internet-mail.svg" />
              </div>
              <div class="notification" type="notification">
                <img src="images/icons/apps/64/internet-mail.svg" />
              </div>
            </div>
          </figure>
          <h4>Do Not Disturb</h4>
          <p>Tune everything else out to stay focused on your work, or keep notifications at bay while watching a movie. Do Not Disturb stops notifications in their tracks.</p>
        </div>
      </div>
    </section>
    <section>
      <div id="showcase" class="row grey">
        <div id="showcase-index">
          <div>
            <h2>Apps You Need, Without Ones You Don’t.</h2>
            <p>elementary OS comes with a carefully considered set of apps that cater to everyday needs so you can spend more time using your computer and less time cleaning up bloatware.</p>
          </div>
          <ul id="showcase-grid">
            <a href="#showcase-music"><li class="read-more"><img src="images/thirdparty-icons/apps/64/music.svg" alt="Music app icon"/>Music</li></a>
            <a href="#showcase-epiphany"><li class="read-more"><img src="images/thirdparty-icons/apps/64/web.svg" alt="Browser app icon"/>Web</li></a>
            <a href="#showcase-mail"><li class="read-more"><img src="images/thirdparty-icons/apps/64/mail.svg" alt="Email app icon"/>Mail</li></a>
            <a href="#showcase-photos"><li class="read-more"><img src="images/thirdparty-icons/apps/64/photos.svg" alt="Photo app icon"/>Photos</li></a>
            <a href="#showcase-videos"><li class="read-more"><img src="images/thirdparty-icons/apps/64/videos.svg" alt="Video app icon"/>Videos</li></a>
            <a href="#showcase-calendar"><li class="read-more"><img src="images/thirdparty-icons/apps/64/calendar.svg" alt="Calendar app icon"/>Calendar</li></a>
            <a href="#showcase-files"><li class="read-more"><img src="images/thirdparty-icons/apps/64/files.svg" alt="File manager app icon"/>Files</li></a>
            <a href="#showcase-terminal"><li class="read-more"><img src="images/thirdparty-icons/apps/64/terminal.svg" alt="Terminal app icon"/>Terminal</li></a>
            <a href="#showcase-code"><li class="read-more"><img src="images/thirdparty-icons/apps/64/code.svg" alt="Code editor app icon"/>Code</li></a>
            <a href="#showcase-camera"><li class="read-more"><img src="images/thirdparty-icons/apps/64/camera.svg" alt="Camera app icon"/>Camera</li></a>
          </ul>
        </div>
        <div class="showcase-tab" id="showcase-music">
          <div class="app-display">
            <img class="app-display__image" src="images/screenshots/music.png" width="704" height="531" alt="Music screenshot" />
            <div class="app-display__description">
              <img src="images/thirdparty-icons/apps/64/music.svg" alt="Music icon" />
              <div>
                <h2>Music</h2>
                <p>Organize and listen to your music. Browse by album, use lightning-fast search, and build playlists of your favorites.</p>
              </div>
            </div>
          </div>
        </div>
        <div class="showcase-tab" id="showcase-epiphany">
          <div class="app-display">
            <img class="app-display__image" src="images/screenshots/web.png" alt="Web screenshot" />
            <div class="app-display__description">
              <img src="images/thirdparty-icons/apps/64/web.svg" alt="Web icon" />
              <div>
                <h2>Web</h2>
                <p>Surf the web with a fast &amp; lightweight web browser. Web lets you use modern sites and web apps while protecting your privacy and being lighter on battery life.</p>
              </div>
            </div>
          </div>
        </div>
        <div class="showcase-tab" id="showcase-mail">
          <div class="app-display">
            <img class="app-display__image" src="images/screenshots/mail.png" width="1127" height="716" alt="Mail screenshot" />
            <div class="app-display__description">
              <img src="images/thirdparty-icons/apps/64/mail.svg" alt="Mail icon" />
              <div>
                <h2>Mail</h2>
                <p>Manage multiple accounts quickly and effortlessly with conversation-based email, fast-as-you-type search, new email notifications, and more.</p>
              </div>
            </div>
          </div>
        </div>
        <div class="showcase-tab" id="showcase-photos">
          <div class="app-display">
            <img class="app-display__image" src="images/screenshots/photos.png" width="1174" height="730" alt="Photos screenshot" />
            <div class="app-display__description">
              <img src="images/thirdparty-icons/apps/64/photos.svg" alt="Photos icon" />
              <div>
                <h2>Photos</h2>
                <p>Import, organize, and edit photos. Make a slideshow. Share with online services.</p>
              </div>
            </div>
          </div>
        </div>
        <div class="showcase-tab" id="showcase-videos">
          <div class="app-display">
            <img class="app-display__image" src="images/screenshots/videos.png" width="1124" height="555" alt="Videos screenshot" />
            <div class="app-display__description">
              <img src="images/thirdparty-icons/apps/64/videos.svg" alt="Videos icon" />
              <div>
                <h2>Videos</h2>
                <p>Smart and simple video viewing with a library, thumbnail previews on the seekbar, playlists, subtitle support, smart fullscreen, and the ability to resume what was last playing.</p>
              </div>
            </div>
          </div>
        </div>
        <div class="showcase-tab" id="showcase-calendar">
          <div class="app-display">
            <img class="app-display__image" src="images/screenshots/calendar.png" width="1039" height="765" alt="Calendar screenshot" />
            <div class="app-display__description">
              <img src="images/thirdparty-icons/apps/64/calendar.svg" alt="calendar icon" />
              <div>
                <h2>Calendar</h2>
                <p>Easily view and create events. Sync with online accounts.</p>
              </div>
            </div>
          </div>
        </div>
        <div class="showcase-tab" id="showcase-files">
          <div class="app-display">
            <img class="app-display__image" src="images/screenshots/files.png" width="924" height="608" alt="Files screenshot" />
            <div class="app-display__description">
              <img src="images/thirdparty-icons/apps/64/files.svg" alt="Files icon" />
              <div>
                <h2>Files</h2>
                <p>The smart pathbar makes it easy to browse with breadcrumbs, search, or path completion. Quickly navigate with the column view and enjoy browser-class tabs with smart features like tab history.</p>
              </div>
            </div>
          </div>
        </div>
        <div class="showcase-tab" id="showcase-terminal">
          <div class="app-display">
            <div class="app-display__image">
              <img src="images/screenshots/terminal.png" width="789" height="557" alt="Terminal screenshot" />
            </div>
            <div class="app-display__description">
              <img src="images/thirdparty-icons/apps/64/terminal.svg" alt="Terminal icon" />
              <div>
                <h2>Terminal</h2>
                <p>Switchable color schemes designed to prevent eye strain, browser-class tabs with history and smart naming, task-completion notifications, natural copy &amp; paste, backlog search, paste protection, and more. Who says you can’t teach an old app new tricks?</p>
              </div>
            </div>
          </div>
        </div>
        <div class="showcase-tab" id="showcase-code">
          <div class="app-display">
            <img class="app-display__image" src="images/screenshots/code.png" width="1182" height="703" alt="Code screenshot" />
            <div class="app-display__description">
              <img src="images/thirdparty-icons/apps/64/code.svg" alt="Code icon" />
              <div>
                <h2>Code</h2>
                <p>Tailor-made with autosaving, project folders, Git integration, smart whitespace, EditorConfig support, Mini Map, Vala symbols, and extensions like Markdown shortcuts and Vim Emulation. Code will be the last editor you’ll ever need.</p>
              </div>
            </div>
          </div>
        </div>
        <div class="showcase-tab" id="showcase-camera">
          <div class="app-display">
            <img class="app-display__image" src="images/screenshots/camera.png" width="704" height="544" alt="Camera screenshot" />
            <div class="app-display__description">
              <img src="images/thirdparty-icons/apps/64/camera.svg" alt="Camera icon" />
              <div>
                <h2>Camera</h2>
                <p>Easily snap pictures or video from your built-in or USB webcam.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section id="parental-controls" class="grey">
      <div class="app-display app-display--overflow">
        <img class="app-display__image" src="images/screenshots/screen-time-limits.png" width="892" height="659" alt="elementary OS Screen Time &amp; Limits"/>
        <div class="app-display__description">
          <h2>
            <img src="images/icons/categories/64/preferences-system-parental-controls.svg" alt="Icon of an adult holding the hand of a child"/>
            Screen Time &amp; Limits
          </h2>
          <?php include('images/icons/actions/symbolic/appointment-symbolic.svg'); ?><h4>Screen Time</h4>
          <p>Set per-user time limits for weekdays, weekends, or both.</p>
          <?php include('images/icons/apps/symbolic/web-browser-symbolic.svg'); ?><h4>Internet Use</h4>
          <p>Manage allowed websites. Rules affect all apps for the chosen user, even if they use a different web browser.</p>
          <?php include('images/icons/actions/symbolic/view-grid-symbolic.svg'); ?><h4>Manage Apps</h4>
          <p>Choose just which apps are safe for you or your child to access. Plus, optionally allow access with your password.</p>
        </div>
      </div>
    </section>
    <section>
      <div class="grid">
        <div class="two-thirds">
          <h1>Everything We Do is Open&nbsp;Source</h1>
          <p>Our platform itself is entirely open source, and it’s built upon a strong foundation of Free &amp; Open Source software (like GNU/Linux). Plus, we actively collaborate within the ecosystem to improve it for everyone.</p>
          <a class="read-more" href="/open-source">Explore Our Stack</a>
        </div>
      </div>
      <div class="grid">
        <div class="half">
          <h2>Secure &amp; Privacy-respecting</h2>
          <p>When source code is available to audit, anyone—a security researcher, a concerned user, or an OEM shipping the OS on their hardware—can verify that the software is secure and not collecting or leaking personal information.</p>
          <a class="read-more" href="https://ubuntu.com/security/notices?release=focal">Security Notices</a>
        </div>
        <div class="half">
          <h2>Built for Developers</h2>
          <p>Whether your app could benefit from a new system feature or API or you’re curious as to how an existing feature or design pattern was built, you have complete access to our source code. Copy it, learn from it, remix it, modify it, and redistribute it.</p>
          <a class="read-more" href="get-involved#desktop-development">Get Involved</a>
        </div>
      </div>
    </section>
    <section id="shortcuts" class="grey">
      <div class="app-display app-display--horizontal">
        <img class="app-display__image" src="images/screenshots/shortcut-overlay.png" width="885" height="656" alt="elementary OS Keyboard Shortcuts"/>
        <div class="app-display__description">
          <h1>User Friendly. And Keyboard Friendly.</h1>
          <p>elementary OS is designed to be easy to understand and pick up as a new user. But that doesn’t mean it’s dumbed down; powerful, customizable keyboard shortcuts ensure you’ll stay productive whether it’s your first day or your thousandth.</p>
        </div>
      </div>
    </section>
    <section id="privacy">
      <div class="grid">
        <div class="two-thirds">
          <h1>Privacy-respecting. Through and through.</h1>
          <p>Your data always belongs to you, and only you. We don’t make advertising deals or collect sensitive personal data. We’re funded directly by our users paying what they want for elementary OS and apps on AppCenter. And that’s how it should be.</p>
          <a class="read-more" href="privacy">Our Privacy Policy</a>
        </div>
      </div>
      <div class="grid">
        <div class="third">
          <h4>
            <?php include('images/icons/devices/symbolic/audio-input-microphone-symbolic.svg'); ?>
            Tattle-Tale
          </h4>
          <p>elementary OS helps you keep tabs on what apps are up to. When an app is using your microphone, we display an indicator to let you know. When an app is using a lot of energy, we tell you in your power indicator.</p>
        </div>
        <div class="third">
          <h4>
            <?php include('images/icons/status/symbolic/changes-prevent-symbolic.svg'); ?>
            Permissions
          </h4>
          <p>When an app wants access to your data or devices, it has to ask up front. We review all AppCenter apps to ensure they’re properly using permissions—and you can always revoke them yourself in System Settings.</p>
        </div>
        <div class="third">
          <h4>
            <?php include('images/icons/actions/symbolic/edit-clear-all-symbolic.svg'); ?>
            Housekeeping
          </h4>
          <p>elementary OS automatically keeps your temporary and trashed files tidied up. Not only does this keep your device’s storage free, it can help ensure your private data doesn’t come back to haunt you.</p>
        </div>
      </div>
    </section>
    <section class="cta">
      <img src="images/icons/places/128/distributor-logo.svg" alt="elementary OS logo">
      <h1>Download elementary OS</h1>
      <p><?php echo $sitewide['description']; ?></p>

      <a class="button suggested-action" href="#">Pay What You Can</a>
    </section>

    <section class="grid" id="the-press">
      <div class="third">
        <a href="https://www.wired.com/2013/11/elementaryos/" target="_blank" rel="noopener"><?php include __DIR__.'/images/thirdparty-logos/wired.svg'; ?></a>
        <a class="inline-tweet" href="https://twitter.com/intent/tweet?original_referer=https://elementary.io&text=&ldquo;elementary OS is different… a beautiful and powerful operating system.&rdquo; –@WIRED https://elementary.io" target="_blank" rel="noopener">&ldquo;elementary OS is different… a beautiful and powerful operating system.&rdquo;</a>
      </div>
      <div class="third">
        <a href="https://arstechnica.com/gadgets/2018/12/a-tour-of-elementary-os-perhaps-the-linux-worlds-best-hope-for-the-mainstream/" target="_blank" rel="noopener"><?php include __DIR__.'/images/thirdparty-logos/ars.svg'; ?></a>
        <a class="inline-tweet" href="https://twitter.com/intent/tweet?original_referer=https://elementary.io&text=&ldquo;Gets out of the way and lets you focus on what you need to get done.&rdquo; –@arstechnica https://elementary.io" target="_blank" rel="noopener">&ldquo;Gets out of the way and lets you focus on what you need to get done.&rdquo;</a>
      </div>
      <div class="third">
        <a href="https://www.forbes.com/sites/jasonevangelho/2019/01/29/linux-distro-spotlight-what-i-love-about-elementary-os/" target="_blank" rel="noopener"><?php include __DIR__.'/images/thirdparty-logos/forbes.svg'; ?></a>
        <a class="inline-tweet" href="https://twitter.com/intent/tweet?original_referer=https://elementary.io&text=&ldquo;I've found myself more productive these past two weeks [using elementary OS] than in the last two months combined.&rdquo; –@forbes https://elementary.io"  target="_blank" rel="noopener">&ldquo;I've found myself more productive these past two weeks [using elementary OS] than in the last two months combined.&rdquo;</a>
      </div>
      <div class="third">
        <a href="https://web.archive.org/web/20150312112222/http://www.maclife.com/article/columns/future_os_x_may_be_more_elementary_ios_7" target="_blank" rel="noopener"><?php include __DIR__.'/images/thirdparty-logos/maclife.svg'; ?></a>
        <a class="inline-tweet" href="http://twitter.com/home/?status=&ldquo;A fast, low-maintenance platform that can be installed virtually anywhere.&rdquo; –@MacLife https://elementary.io" target="_blank" rel="noopener">&ldquo;A fast, low-maintenance platform that can be installed virtually anywhere.&rdquo;</a>
      </div>
      <div class="third">
        <a href="https://lifehacker.com/how-to-move-on-after-windows-xp-without-giving-up-your-1556573928" target="_blank" rel="noopener"><?php include __DIR__.'/images/thirdparty-logos/lifehacker.svg'; ?></a>
        <a class="inline-tweet" href="https://twitter.com/intent/tweet?original_referer=https://elementary.io&text=&ldquo;Lightweight and fast… and has a real flair for design and appearances.&rdquo; –@lifehacker https://elementary.io" target="_blank" rel="noopener">&ldquo;Lightweight and fast… and has a real flair for design and appearances.&rdquo;</a>
      </div>
    </section>

    <span id="translate-download" style="display:none;" hidden>Download elementary OS</span>
    <span id="translate-purchase" style="display:none;" hidden>Purchase elementary OS</span>
    <div id="download-modal" class="dialog modal">
      <img alt="Download elementary OS icon" src="images/icons/apps/48/system-os-installer.svg">
      <div class="content-area">
        <p class="primary">Choose a Download</p>
        <p>Download from a localized server or by magnet link. For help and more info, see the <a class="read-more" href="docs/installation" target="_blank" rel="noopener">installation guide</a></p>
      </div>
      <div class="action-area">
        <a class="button clickable close-modal">Close</a>
        <div class="linked">
          <a class="button suggested-action download-link http" href="<?php echo $download_link.$config['release_filename']; ?>">Download</a>
          <a class="button suggested-action download-link magnet" title="Torrent Magnet Link" href="<?php echo 'magnet:?xt=urn:btih:'.$config['release_magnet'].'&dn='.$config['release_filename']; ?>&tr=https%3A%2F%2Fashrise.com%3A443%2Fphoenix%2Fannounce&tr=udp%3A%2F%2Fopen.demonii.com%3A1337%2Fannounce&tr=udp%3A%2F%2Ftracker.openbittorrent.com%3A80%2Fannounce&ws=http%3A<?php echo urlencode($download_link.$config['release_filename']); ?>"><i class="fa fa-magnet"></i></a>
        </div>
      </div>
    </div>
    <a style="display:none;" class="open-modal" href="#download-modal"></a>
    <!--[if lt IE 10]><script type="text/javascript" src="https://cdn.jsdelivr.net/gh/eligrey/classList.js@1.1.20170427/classList.min.js"></script><![endif]-->
<?php
  include $template['footer'];
?>
