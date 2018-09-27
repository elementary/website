<?php
    require_once __DIR__.'/_backend/classify.current.php';
    require_once __DIR__.'/_backend/preload.php';
    require_once __DIR__.'/_backend/os-payment.php';

    $tagline = 'The fast, open, and privacy-respecting replacement for Windows and macOS';

    $page['title'] = $tagline + ' &sdot; elementary OS';

    $page['scripts'] = array(
        'scripts/slingshot.js',
        'scripts/download.js',
        'scripts/showcase.run.js'
    );

    $page['styles'] = array(
        'styles/home.css',
        'styles/pantheon.css'
    );

    include $template['header'];
    include $template['alert'];
?>

        <section class="section--hero section--stretched">
            <div class="section__detail grid">
                <div class="whole">
                    <div id="logotype"><?php include __DIR__.'/images/logotype-os.svg'; ?></div>
                    <h4><?php echo $tagline; ?></h4>
                </div>
            </div>

            <div class="section__showcase"></div>

            <div class="section__detail grid">
                <div class="whole">
                    <div id="amounts">
                        <?php
                            $already_paid = (os_payment_getcookie($config['release_version']) > 0);
                            if ($already_paid) {
                        ?>
                        <div id="choice-buttons">
                            <input type="hidden" id="amount-ten" value="0">
                        </div>
                        <?php } else { ?>
                        <h4 id="pay-what-you-want">Pay What You Want:</h4>
                        <div id="choice-buttons">
                            <button id="amount-five"        value="5"  class="small-button payment-button target-amount">5</button>
                            <button id="amount-ten"         value="10" class="small-button payment-button target-amount checked">10</button>
                            <button id="amount-twenty-five" value="25" class="small-button payment-button target-amount">25</button>
                            <div>
                                <span class="pre-amount">$</span>
                                <input type="number" step="0.01" min="0" max="999999.99" id="amount-custom" class="button small-button target-amount" placeholder="Custom">
                                <p class="small-label focus-reveal text-center">Enter any dollar amount.</p>
                            </div>
                        </div>
                        <?php } ?>
                        <div class="column">
                            <button type="submit" id="download" class="suggested-action"><?php echo ($already_paid) ? "Download elementary OS" : "Purchase elementary OS"; ?></button>
                            <p class="small-label"><?php echo $config['release_version'] . ' ' . $config['release_title']; ?> | 1.50 GB (for PC or Mac)</p>
                        </div>
                        <div style="clear:both;"></div>
                    </div>
                </div>
            </div>
        </section>
        <section class="grid" id="the-press">
            <div class="third">
                <a href="https://www.wired.com/2013/11/elementaryos/" target="_blank" rel="noopener"><?php include __DIR__.'/images/thirdparty-logos/wired.svg'; ?></a>
                <a class="inline-tweet" href="https://twitter.com/home/?status=&ldquo;elementary OS is different… a beautiful and powerful operating system that will run well even on old PCs&rdquo; — @WIRED https://elementary.io" data-tweet-suffix=" — @WIRED https://elementary.io" target="_blank" rel="noopener">&ldquo;elementary OS is different… a beautiful and powerful operating system that will run well even on old PCs&rdquo;</a>
            </div>
            <div class="third">
                <a href="https://web.archive.org/web/20150312112222/http://www.maclife.com/article/columns/future_os_x_may_be_more_elementary_ios_7" target="_blank" rel="noopener"><?php include __DIR__.'/images/thirdparty-logos/maclife.svg'; ?></a>
                <a class="inline-tweet" href="http://twitter.com/home/?status=&ldquo;a fast, low-maintenance platform that can be installed virtually anywhere&rdquo; —@MacLife https://elementary.io" data-tweet-suffix=" — @MacLife https://elementary.io" target="_blank" rel="noopener">&ldquo;a fast, low-maintenance platform that can be installed virtually anywhere&rdquo;</a>
            </div>
            <div class="third">
                <a href="https://lifehacker.com/how-to-move-on-after-windows-xp-without-giving-up-your-1556573928" target="_blank" rel="noopener"><?php include __DIR__.'/images/thirdparty-logos/lifehacker.svg'; ?></a>
                <a class="inline-tweet" href="https://twitter.com/home/?status=&ldquo;Lightweight and fast… Completely community-based, and has a real flair for design and appearances.&rdquo; —@lifehacker https://elementary.io" data-tweet-suffix=" — @lifehacker https://elementary.io" target="_blank" rel="noopener">&ldquo;Lightweight and fast… Completely community-based, and has a real flair for design and appearances.&rdquo;</a>
            </div>
        </section>
        <section id="appcenter">
            <div class="app-display app-display--overflow">
                <img class="app-display__image" src="images/screenshots/appcenter.png" srcset="images/screenshots/appcenter@2x.png 2x" alt="elementary OS AppCenter categories"/>
                <div class="app-display__description">
                    <img src="images/icons/apps/128/system-software-install.svg" />
                    <h1>Get it on <span>AppCenter</span></h1>
                    <p>Get free and paid apps on AppCenter, the open, pay-what-you-want app store for indie developers. Each has been reviewed and curated by elementary to ensure a native, privacy-respecting, and secure experience.</p>
                    <p><a href="https://appcenter.elementary.io" target="_blank" rel="noopener" class="read-more">Discover AppCenter Apps</a>
                    <p><a href="https://medium.com/elementaryos/tagged/appcenter-spotlight" target="_blank" rel="noopener" class="read-more">Read AppCenter Spotlight</a>
                    <p><a href="developer" class="read-more">Become a Developer</a></p>
                </div>
            </div>
        </section>
        <section class="grid">
            <div class="third">
                <h2>Open Source</h2>
                <p>We respect the rights of our users. Our code is available for review, scrutiny, modification, and redistribution by anyone. <a class="read-more" href="/open-source">Learn More</a></p>
            </div>
            <div class="third">
                <h2>No Ads. No Spying.</h2>
                <p>Unlike other platforms, we don’t make advertising deals or collect sensitive personal data. Our only income is directly from our users. <a class="read-more" href="/privacy-policy">Privacy Policy</a></p>
            </div>
            <div class="third">
                <h2>Safe &amp; Secure</h2>
                <p>We’re built on GNU/Linux, one of the most secure systems in the world. It’s the same software powering the U.S Department of Defense, the Bank of China, and more. <a class="read-more" href="https://usn.ubuntu.com/releases/ubuntu-18.04-lts/">Security Notices</a></p>
            </div>
        </section>
        <section>
            <div id="showcase" class="row grey">
                <div class="pantheon" style="display:none;">
                    <div id="notification-container">
                        <div class="window" type="notification">
                            <div><span class="icon" icon="apps/48/utilities-terminal"><?php include('images/icons/apps/48/utilities-terminal.svg'); ?></span></div>
                            <div>
                                <h3>Task finished</h3>
                                <p data-l10n-off>git clone https://github.com/elementary/website</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="showcase-index">
                    <div>
                        <h2>Apps You Need, Without Ones You Don’t.</h2>
                        <p>elementary OS comes with a carefully considered set of apps that cater to every day needs so you can spend more time using your computer and less time cleaning up bloatware. And when you need something more, just open AppCenter for tons of quality apps made just for elementary OS.</p>
                    </div>
                    <ul id="showcase-grid">
                        <a href="#showcase-music"><li class="read-more"><img src="images/icons/apps/64/multimedia-audio-player.svg" />Music</li></a>
                        <a href="#showcase-epiphany"><li class="read-more"><img src="images/icons/apps/64/internet-web-browser.svg" />Epiphany</li></a>
                        <a href="#showcase-mail"><li class="read-more"><img src="images/icons/apps/64/internet-mail.svg" />Mail</li></a>
                        <a href="#showcase-photos"><li class="read-more"><img src="images/icons/apps/64/multimedia-photo-manager.svg" />Photos</li></a>
                        <a href="#showcase-videos"><li class="read-more"><img src="images/icons/apps/64/multimedia-video-player.svg" />Videos</li></a>
                        <a href="#showcase-calendar"><li class="read-more"><img src="images/icons/apps/64/office-calendar.svg" />Calendar</li></a>
                        <a href="#showcase-files"><li class="read-more"><img src="images/icons/apps/64/system-file-manager.svg" />Files</li></a>
                        <a href="#showcase-terminal"><li class="read-more"><img src="images/icons/apps/64/utilities-terminal.svg" />Terminal</li></a>
                        <a href="#showcase-code"><li class="read-more"><img src="images/thirdparty-icons/apps/64/io.elementary.code.svg" />Code</li></a>
                        <a href="#showcase-camera"><li class="read-more"><img src="images/icons/apps/64/accessories-camera.svg" />Camera</li></a>
                    </ul>
                </div>
                <div class="showcase-tab" id="showcase-music">
                    <div class="app-display">
                        <img class="app-display__image" src="images/screenshots/music.png" srcset="images/screenshots/music@2x.png 2x" alt="music screenshot" />
                        <div class="app-display__description">
                            <img src="images/icons/apps/64/multimedia-audio-player.svg" alt="music icon" />
                            <div>
                                <h2>Music</h2>
                                <p>Organize and listen to your music. Browse by album, use lightning-fast search, and build playlists of your favorites.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="showcase-tab" id="showcase-epiphany">
                    <div class="app-display">
                        <img class="app-display__image" src="images/screenshots/epiphany.png" srcset="images/screenshots/epiphany@2x.png 2x" alt="epiphany screenshot" />
                        <div class="app-display__description">
                            <img src="images/icons/apps/64/internet-web-browser.svg" alt="epiphany icon" />
                            <div>
                                <h2>Epiphany</h2>
                                <p>Surf the web with a fast &amp; lightweight web browser. Epiphany lets you use modern websites and web apps while being lighter on battery life.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="showcase-tab" id="showcase-mail">
                    <div class="app-display">
                        <img class="app-display__image" src="images/screenshots/mail.png" alt="mail screenshot" />
                        <div class="app-display__description">
                            <img src="images/icons/apps/64/internet-mail.svg" alt="mail icon" />
                            <div>
                                <h2>Mail</h2>
                                <p>Manage multiple accounts quickly and effortlessly with conversation-based email, fast-as-you-type search, new email notifications, and more.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="showcase-tab" id="showcase-photos">
                    <div class="app-display">
                        <img class="app-display__image" src="images/screenshots/photos.png" srcset="images/screenshots/photos@2x.png 2x" alt="photos screenshot" />
                        <div class="app-display__description">
                            <img src="images/icons/apps/64/multimedia-photo-manager.svg" alt="photos icon" />
                            <div>
                                <h2>Photos</h2>
                                <p>Import, organize, and edit photos. Make a slideshow. Share with Facebook or Flickr.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="showcase-tab" id="showcase-videos">
                    <div class="app-display">
                        <img class="app-display__image" src="images/screenshots/videos.png" srcset="images/screenshots/videos@2x.png 2x" alt="videos screenshot" />
                        <div class="app-display__description">
                            <img src="images/icons/apps/64/multimedia-video-player.svg" alt="videos icon" />
                            <div>
                                <h2>Videos</h2>
                                <p>Smart and simple video viewing with a library, thumbnail previews on the seekbar, playlists, subtitle support, smart fullscreen, and the ability to resume what was last playing.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="showcase-tab" id="showcase-calendar">
                    <div class="app-display">
                        <img class="app-display__image" src="images/screenshots/calendar.png" alt="calendar screenshot" />
                        <div class="app-display__description">
                            <img src="images/icons/apps/64/office-calendar.svg" alt="calendar icon" />
                            <div>
                                <h2>Calendar</h2>
                                <p>Easily view and create events. Sync with Online Accounts like Google.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="showcase-tab" id="showcase-files">
                    <div class="app-display">
                        <img class="app-display__image" src="images/screenshots/files.png" srcset="images/screenshots/files@2x.png 2x" alt="files screenshot" />
                        <div class="app-display__description">
                            <img src="images/icons/apps/64/system-file-manager.svg" alt="files icon" />
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
                            <img class="pantheon--fallback" src="images/screenshots/terminal.png" alt="terminal screenshot" />
                            <div class="pantheon" style="display:none;">
                                <div class="window dark active" type="terminal">
                                    <div class="titlebar">
                                        <span class="icon control" icon="actions/window-close"><?php include('images/pantheon/actions/window-close.svg'); ?></span>
                                        <span class="title">Home</span>
                                        <div>
                                            <span class="icon search" icon="actions/system-search"><?php include('images/pantheon/actions/system-search.svg'); ?></span>
                                            <span class="icon control" icon="actions/window-maximize"><?php include('images/pantheon/actions/window-maximize.svg'); ?></span>
                                        </div>
                                    </div>
                                    <div class="tabbar">
                                        <span class="icon" icon="actions/tab-new"><?php include('images/pantheon/actions/tab-new.svg'); ?></span>
                                        <div class="tabs">
                                            <div class="tab active">
                                                <span class="icon" icon="actions/close"><?php include('images/pantheon/actions/close.svg'); ?></span>
                                                <span class="title">Home</span>
                                            </div>
                                            <div class="tab">
                                                <span class="title">Home</span>
                                            </div>
                                        </div>
                                        <span class="icon" icon="actions/document-open-recent"><?php include('images/pantheon/actions/document-open-recent.svg'); ?></span>
                                    </div>
                                    <div class="input"></div>
                                </div>
                            </div>
                        </div>
                        <div class="app-display__description">
                            <img src="images/icons/apps/64/utilities-terminal.svg" alt="terminal icon" />
                            <div>
                                <h2>Terminal</h2>
                                <p>Switchable color schemes designed to prevent eye strain, browser-class tabs with history and smart naming, task-completion notifications, natural copy &amp; paste, backlog search, paste protection, and more. Who says you can’t teach an old app new tricks?</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="showcase-tab" id="showcase-code">
                    <div class="app-display">
                        <img class="app-display__image" src="images/screenshots/code.png" srcset="images/screenshots/code@2x.png 2x" alt="Code screenshot" />
                        <div class="app-display__description">
                            <img src="images/thirdparty-icons/apps/64/io.elementary.code.svg" alt="Code icon" />
                            <div>
                                <h2>Code</h2>
                                <p>Tailor-made with autosaving, project folders, Git integration, multiple panes, smart whitespace, EditorConfig support, Mini Map, Vala symbols, and extensions like Terminal, Web Preview, and Vim Emulation. Code will be the last editor you’ll ever need.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="showcase-tab" id="showcase-camera">
                    <div class="app-display">
                        <img class="app-display__image" src="images/screenshots/camera.png" srcset="images/screenshots/camera@2x.png 2x" alt="camera screenshot" />
                        <div class="app-display__description">
                            <img src="images/icons/apps/64/accessories-camera.svg" alt="camera icon" />
                            <div>
                                <h2>Camera</h2>
                                <p>Easily snap pictures or video from your webcam.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section id="slingshot">
            <div class="app-display app-display--horizontal">
                <div class="app-display__image">
                    <div id="slingshot-label" data-l10n-off>
                        <?php include('images/pantheon/actions/system-search.svg'); ?>
                        Applications
                    </div>
                    <div id="slingshot-arrow"><img src='images/slingshot/arrow.svg'></div>
                    <div class="slingshot">
                        <div class="linked">
                            <div id="slingshot-grid-button" class="button active">
                                <?php include('images/icons/actions/symbolic/view-grid-symbolic.svg'); ?>
                            </div>
                            <div id="slingshot-categories-button" class="button">
                                <?php include('images/icons/actions/symbolic/view-filter-symbolic.svg'); ?>
                            </div>
                        </div>
                        <div class="entry">
                            <?php include('images/icons/actions/symbolic/edit-find-symbolic.svg'); ?>
                            <span class="search-term inactive" data-l10n-off>dat</span>
                            <span class="cursor" data-l10n-off>|</span>
                            <span class="clear-icon inactive"><?php include('images/icons/actions/symbolic/edit-clear-symbolic.svg'); ?></span>
                        </div>
                        <div id="slingshot-grid" class="active view">
                            <div class="slingshot-grid">
                            </div>
                            <div id="slingshot-pager">
                                <div class="switcher-checked" data-l10n-off><?php include('images/bullet.svg'); ?></div>
                                <div class="switcher" data-l10n-off><?php include('images/bullet.svg'); ?></div>
                            </div>
                        </div>
                        <div id="slingshot-categories" class="next view">
                            <div class="slingshot-categories-sidebar">
                                <span class="slingshot-category active" data-l10n-off>Accessories</span>
                                <span class="slingshot-category" data-l10n-off>Graphics</span>
                                <span class="slingshot-category" data-l10n-off>Internet</span>
                                <span class="slingshot-category" data-l10n-off>Office</span>
                                <span class="slingshot-category" data-l10n-off>Other</span>
                                <span class="slingshot-category" data-l10n-off>Sound &amp; Video</span>
                                <span class="slingshot-category" data-l10n-off>System Tools</span>
                            </div>
                            <div class="slingshot-categories">
                            </div>
                        </div>
                        <div id="slingshot-search" class="next view">
                            <div class="searchone inactive"></div>
                            <div class="searchtwo inactive"></div>
                            <div class="searchthree inactive"></div>
                        </div>
                    </div>
                </div>
                <div class="app-display__description">
                    <h2>3 Ways to Explore</h2>
                    <?php include('images/icons/actions/symbolic/view-grid-symbolic.svg'); ?><h4>Grid</h4>
                    <p>Display all your apps in an alphabetized grid. Flick through and find the one you want.</p>
                    <?php include('images/icons/actions/symbolic/view-filter-symbolic.svg'); ?><h4>Categories</h4>
                    <p>View your apps automatically organized into categories. Perfect for large collections.</p>
                    <?php include('images/icons/actions/symbolic/edit-find-symbolic.svg'); ?><h4>Search</h4>
                    <p>Launch apps, open settings panes, run commands, and more from the lightning fast search view.</p>
                </div>
            </div>
        </section>
        <section class="cta grey">
            <img src="images/icons/places/128/distributor-logo.svg">
            <h2>Download elementary OS</h2>
            <h4><?php echo $tagline; ?></h4>

            <a class="button suggested-action" href="#">Pay What You Want</a>
        </section>
        <span id="translate-download" style="display:none;" hidden>Download elementary OS</span>
        <span id="translate-purchase" style="display:none;" hidden>Purchase elementary OS</span>
        <div id="download-modal" class="dialog modal">
            <img alt="Download elementary OS icon" src="images/icons/apps/48/ubiquity.svg">
            <div class="content-area">
                <p class="primary">Choose a Download</p>
                <p>Download from a localized server or by magnet link. For help and more info, see the <a class="read-more" href="docs/installation" target="_blank" rel="noopener">installation guide</a></p>
            </div>
            <div class="action-area">
                <a class="button clickable close-modal">Cancel</a>
                <div class="linked">
                    <a class="button suggested-action close-modal download-link http" href="<?php echo $download_link.$config['release_filename']; ?>">Download</a>
                    <a class="button suggested-action close-modal download-link magnet" title="Torrent Magnet Link" href="<?php echo 'magnet:?xt=urn:btih:'.$config['release_magnet'].'&dn='.$config['release_filename']; ?>&tr=https%3A%2F%2Fashrise.com%3A443%2Fphoenix%2Fannounce&tr=udp%3A%2F%2Fopen.demonii.com%3A1337%2Fannounce&tr=udp%3A%2F%2Ftracker.ccc.de%3A80%2Fannounce&tr=udp%3A%2F%2Ftracker.openbittorrent.com%3A80%2Fannounce&tr=udp%3A%2F%2Ftracker.publicbt.com%3A80%2Fannounce&ws=http:<?php echo $download_link.$config['release_filename']; ?>"><i class="fa fa-magnet"></i></a>
                </div>
            </div>
        </div>
        <a style="display:none;" class="open-modal" href="#download-modal"></a>
        <!--[if lt IE 10]><script type="text/javascript" src="https://cdn.jsdelivr.net/gh/eligrey/classList.js@1.1.20170427/classList.min.js"></script><![endif]-->
<?php
    include $template['footer'];
?>
