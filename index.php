<?php
    $page['title'] = 'A fast and open replacement for Windows and OS X &sdot; elementary OS';

    $page['script-plugins'] = array(
        'https://cdn.jsdelivr.net/g/jquery.leanmodal2@2.5,bluebird@3.4.1'
    );

    $page['scripts'] = array(
        'https://checkout.stripe.com/checkout.js' => array(
            'data-alipay' => 'auto',
            'data-locale' => 'auto'
        ),
        'scripts/slingshot.js',
        'scripts/download.js',
        'scripts/showcase.js' => array(
            'async' => false
        ),
        'scripts/terminal.js' => array(
            'async' => false
        ),
        'scripts/showcase.run.js' => array(
            'async' => false
        )
    );

    $page['styles'] = array(
        'styles/home.css',
        'styles/pantheon.css'
    );

    include __DIR__.'/_templates/sitewide.php';

    include $template['header'];
    include $template['alert'];

    require_once __DIR__.'/backend/config.loader.php';
    require_once __DIR__.'/backend/classify.current.php';
?>
        <script>var stripeKey = '<?php include __DIR__.'/backend/payment.php'; ?>'</script>
        <script>var releaseTitle = '<?php echo $config['release_title']; ?>'</script>
        <script>var releaseVersion = '<?php echo $config['release_version']; ?>'</script>
        <script>var downloadRegion = '<?php echo $region; ?>'</script>

        <section class="grid">
            <div class="whole">
                <div id="logotype">

                    <?php
                        // Embed the SVG to fix scaling in WebKit 1.x,
                        // while preserving CSS options for the image.
                        include('images/logotype-os.svg');
                    ?>

                </div>
                <h4>A fast and open replacement for Windows and OS X</h4>
            </div>
        </section>
        <div class="hero"></div>
        <section class="grid">
            <div class="whole">
                <h4 id="pay-what-you-want">Pay What You Want</h4>
                <div id="amounts">
                    <?php
                        $paidString = 'has_paid_'.$config['release_title'].'_'.$config['release_version'];
                        $disallowed = [' ', '.'];
                        $encoded = urlencode(str_replace($disallowed, '_', $paidString));
                        if ( isset($_COOKIE[$encoded]) && $_COOKIE[$encoded] > 0 ) {
                            ?>
                    <input type="hidden" id="amount-ten" value="0">
                            <?php
                        } else {
                            ?>
                    <button id="amount-five"        value="5"  class="small-button payment-button target-amount">5</button>
                    <button id="amount-ten"         value="10" class="small-button payment-button target-amount checked">10</button>
                    <button id="amount-twenty-five" value="25" class="small-button payment-button target-amount">25</button>
                    <div class="column">
                        <span class="pre-amount">$</span>
                        <input type="number" step="0.01" min="0" max="999999.99" id="amount-custom" class="button small-button target-amount" placeholder="Custom">
                        <p class="small-label focus-reveal text-center">Enter any dollar amount.</p>
                    </div>
                    <div style="clear:both;"></div>
                            <?php
                        }
                    ?>
                </div>
                <button type="submit" id="download" class="suggested-action">Purchase elementary OS</button>
                <p class="small-label"><?php echo $config['release_version'] . ' ' . $config['release_title']; ?> | 1.31 GB (for PC or Mac)</p>
            </div>
        </section>
        <section class="grid">
            <h4 id="the-press">What the press is saying about elementary OS:</h4>
            <div class="third">
                <a href="http://www.wired.com/2013/11/elementaryos/" target="_blank"><img class="h1" src="images/thirdparty-logos/wired.svg" data-l10n-off alt="WIRED" /></a>
                <a class="inline-tweet" href="http://twitter.com/home/?status=&ldquo;elementary OS is different… a beautiful and powerful operating system that will run well even on old PCs&rdquo; — @WIRED http://elementary.io" data-tweet-suffix=" — @WIRED http://elementary.io" target="_blank">&ldquo;elementary OS is different… a beautiful and powerful operating system that will run well even on old PCs&rdquo;</a>
            </div>
            <div class="third">
                <a href="https://web.archive.org/web/20150312112222/http://www.maclife.com/article/columns/future_os_x_may_be_more_elementary_ios_7" target="_blank"><img class="h1" src="images/thirdparty-logos/maclife.svg" data-l10n-off alt="Mac|Life" /></a>
                <a class="inline-tweet" href="http://twitter.com/home/?status=&ldquo;a fast, low-maintenance platform that can be installed virtually anywhere&rdquo; —@MacLife http://elementary.io" data-tweet-suffix=" — @MacLife http://elementary.io" target="_blank">&ldquo;a fast, low-maintenance platform that can be installed virtually anywhere&rdquo;</a>
            </div>
            <div class="third">
                <a href="http://lifehacker.com/how-to-move-on-after-windows-xp-without-giving-up-your-1556573928" target="_blank"><img class="h1" src="images/thirdparty-logos/lifehacker.svg" data-l10n-off alt="Lifehacker" /></a>
                <a class="inline-tweet" href="http://twitter.com/home/?status=&ldquo;Lightweight and fast… Completely community-based, and has a real flair for design and appearances.&rdquo; —@lifehacker http://elementary.io" data-tweet-suffix=" — @lifehacker http://elementary.io" target="_blank">&ldquo;Lightweight and fast… Completely community-based, and has a real flair for design and appearances.&rdquo;</a>
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
                                <p>git clone https://github.com/elementary/mvp</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="showcase-index">
                    <div>
                        <h2>Apps You Need, Without Ones You Don't.</h2>
                        <p>elementary OS ships with a carefully curated selection of apps that cater to every day needs so you can spend more time using your computer and less time cleaning up bloatware.</p>
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
                        <a href="#showcase-scratch"><li class="read-more"><img src="images/icons/apps/64/accessories-text-editor.svg" />Scratch</li></a>
                        <a href="#showcase-camera"><li class="read-more"><img src="images/icons/apps/64/accessories-camera.svg" />Camera</li></a>
                    </ul>
                </div>
                <div class="showcase-tab" id="showcase-music">
                    <div class="app-display">
                        <img class="app-display__image" src="images/screenshots/music.png" alt="music screenshot" />
                        <div class="app-display__description">
                            <img src="images/icons/apps/64/multimedia-audio-player.svg" alt="music icon" />
                            <div>
                                <h2>Music</h2>
                                <p>Organize and listen to your music. Browse by albums, use lightning-fast search, and build playlists of your favorites.</p>
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
                                <p>Surf the web with a fast & lightweight web browser. Epiphany lets you use HTML5 websites and web apps while being lighter on battery life.</p>
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
                                <p>Manage multiple accounts quickly and effortlessly with conversation-based mail, fast-as-you-type search, new mail notifications, and more.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="showcase-tab" id="showcase-photos">
                    <div class="app-display">
                        <img class="app-display__image" src="images/screenshots/photos.png" alt="photos screenshot" />
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
                                <p>Smart and simple video viewing with thumbnail previews on the seekbar, playlists, subtitle support, and even the ability to resume what was last playing.</p>
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
                                <p>With a color scheme designed to prevent eye strain, browser-class tabs with history and smart naming, task-completion notifications, natural copy & paste, backlog search and more, who says you can't teach an old app new tricks?</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="showcase-tab" id="showcase-scratch">
                    <div class="app-display">
                        <img class="app-display__image" src="images/screenshots/scratch.png" srcset="images/screenshots/scratch@2x.png 2x" alt="scratch screenshot" />
                        <div class="app-display__description">
                            <img src="images/icons/apps/64/accessories-text-editor.svg" alt="scratch icon" />
                            <div>
                                <h2>Scratch</h2>
                                <p>With a folder sidebar, multiple panes, and extensions like Terminal, Web Preview, Indentation Detection, and Vim Emulation, Scratch will be the last text editor you'll ever need.</p>
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
                                <p>Easily snap pictures or video from a built-in webcam.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section id="appcenter">
            <div class="app-display app-display--overflow">
                <img class="app-display__image" src="images/screenshots/appcenter.png" srcset="images/screenshots/appcenter@2x.png 2x" alt="elementary appcenter categories"/>
                <div class="app-display__description">
                    <img src="images/icons/apps/128/system-software-install.svg" />
                    <h2>The Indie, Open Source App Store</h2>
                    <p>AppCenter brings handcrafted apps and extensions directly to your desktop. Quickly discover new apps and easily update the ones you already have. No license keys, no subscriptions, no trial periods.</p>
                    <a href="developer" class="read-more">Become a Developer</a>
                </div>
            </div>
        </section>
        <section id="slingshot" class="grey">
            <div class="app-display app-display--horizontal">
                <div class="app-display__image">
                    <div id="slingshot-label">Applications</div>
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
                            <span class="search-term inactive">dat</span>
                            <span class="cursor">|</span>
                            <span class="clear-icon inactive"><?php include('images/icons/actions/symbolic/edit-clear-symbolic.svg'); ?></span>
                        </div>
                        <div id="slingshot-grid" class="active view">
                            <div class="slingshot-grid">
                            </div>
                            <div id="slingshot-pager">
                                <div class="button active">1</div>
                                <div class="button">2</div>
                            </div>
                        </div>
                        <div id="slingshot-categories" class="next view">
                            <div class="slingshot-categories-sidebar">
                                <span class="slingshot-category active">Accessories</span>
                                <span class="slingshot-category">Graphics</span>
                                <span class="slingshot-category">Internet</span>
                                <span class="slingshot-category">Office</span>
                                <span class="slingshot-category">Other</span>
                                <span class="slingshot-category">Sound &amp; Video</span>
                                <span class="slingshot-category">System Tools</span>
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
        <section class="grid">
            <div class="third">
                <h2>Open Source</h2>
                <p>Our code is available for review, scrutiny, modification, and redistribution by anyone. <a class="read-more" href="/open-source">Learn More</a></p>
            </div>
            <div class="third">
                <h2>No Ads. No Spying.</h2>
                <p>We don't make advertising deals and we don't collect sensitive personal data. Our only income is directly from our users.</p>
            </div>
            <div class="third">
                <h2>Safe &amp; Secure</h2>
                <p>We're built on Linux: the same software powering the U.S Department of Defense, the Bank of China, and more. <a class="read-more" href="http://www.ubuntu.com/usn/xenial/">Security Notices</a></p>
            </div>
        </section>
        <span id="translate-download" style="display:none;" hidden>Download elementary OS</span>
        <span id="translate-purchase" style="display:none;" hidden>Purchase elementary OS</span>
        <div id="download-modal" class="modal">
            <h3>Choose a Download</h3>
            <p>For help and more info, see the <a class="read-more" href="docs/installation" target="_blank">installation guide</a></p>
            <div class="row actions">
                <div class="column">
                    <a class="button close-modal" style="margin:0;" href="#">Cancel</a>
                </div>
                <div class="column linked">
                    <a class="button suggested-action close-modal download-link http" href="<?php echo $download_link.$config['release_filename']; ?>">Download <?php echo $config['release_title']; ?></a>
                    <a class="button suggested-action close-modal download-link magnet" title="Torrent Magnet Link" href="<?php echo 'magnet:?xt=urn:btih:'.$config['release_magnet'].'&dn='.$config['release_filename']; ?>&tr=https%3A%2F%2Fashrise.com%3A443%2Fphoenix%2Fannounce&tr=udp%3A%2F%2Fopen.demonii.com%3A1337%2Fannounce&tr=udp%3A%2F%2Ftracker.ccc.de%3A80%2Fannounce&tr=udp%3A%2F%2Ftracker.openbittorrent.com%3A80%2Fannounce&tr=udp%3A%2F%2Ftracker.publicbt.com%3A80%2Fannounce&ws=http:<?php echo $download_link.$config['release_filename']; ?>"><i class="fa fa-magnet"></i></a>
                    <a class="button suggested-action close-modal download-link magnet" title="Torrent Magnet Link" href="magnet:?xt=urn:btih:535c241c5b14fdfe47bec6cbaac4a39cd41c719e&dn=<?php echo $config['release_filename']; ?>&tr=https%3A%2F%2Fashrise.com%3A443%2Fphoenix%2Fannounce&tr=udp%3A%2F%2Fopen.demonii.com%3A1337%2Fannounce&tr=udp%3A%2F%2Ftracker.ccc.de%3A80%2Fannounce&tr=udp%3A%2F%2Ftracker.openbittorrent.com%3A80%2Fannounce&tr=udp%3A%2F%2Ftracker.publicbt.com%3A80%2Fannounce&ws=http:<?php echo $download_link.$config['release_filename']; ?>"><i class="fa fa-magnet"></i></a>
                </div>
            </div>
        </div>
        <a style="display:none;" class="open-modal" href="#download-modal"></a>
        <!--[if lt IE 10]><script type="text/javascript" src="https://cdn.jsdelivr.net/g/classlist"></script><![endif]-->
<?php
    include $template['footer'];
?>
