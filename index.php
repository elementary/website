<?php
    $page['title'] = 'Download elementary OS';
    $page['scripts'] = '<script src="https://checkout.stripe.com/checkout.js" data-alipay="auto" data-locale="auto"></script>';
    $page['scripts'] .= '<link rel="stylesheet" type="text/css" media="all" href="styles/home.css">';
    include __DIR__.'/_templates/sitewide.php';
    include $template['header'];
    include $template['alert'];
    require_once __DIR__.'/backend/config.loader.php';
    require_once __DIR__.'/backend/classify.current.php';
?>
            <script src="scripts/showcase.js"></script>
            <script>var stripe_key = '<?php include __DIR__.'/backend/payment.php'; ?>';</script>
            <script>var release_title = '<?php echo $config['release_title']; ?>';</script>
            <script>var release_version = '<?php echo $config['release_version']; ?>';</script>
            <script>var download_region = '<?php echo $region; ?>';</script>
            <script>
                jQl.loadjQdep('scripts/jQuery.leanModal2.js');
                jQl.loadjQdep('scripts/bluebird.min.js');
                jQl.loadjQdep('scripts/terminal.js');
                jQl.loadjQdep('scripts/homepage.js');
            </script>

            <div class="row">
                <div id="logotype">

                    <?php
                        // Embed the SVG to fix scaling in WebKit 1.x,
                        // while preserving CSS options for the image.
                        include('images/logotype-os.svg');
                    ?>

                </div>
                <h4>A fast and open replacement for Windows and OS X</h4>
            </div>

            <div class="hero"></div>

            <div class="row">
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
                <p class="small-label">1.15 GB (for PC or Mac)</p>
            </div>
            <div class="row">
                <h4 id="the-press">What the press is saying about elementary OS:</h4>
                <div class="column third">
                    <a href="http://www.wired.com/2013/11/elementaryos/" target="_blank"><img class="h1" src="images/thirdparty-logos/wired.svg" data-l10n-off alt="WIRED" /></a>
                    <a class="inline-tweet" href="http://twitter.com/home/?status=&ldquo;elementary OS is different… a beautiful and powerful operating system that will run well even on old PCs&rdquo; — @WIRED http://elementary.io" data-tweet-suffix=" — @WIRED http://elementary.io" target="_blank">&ldquo;elementary OS is different… a beautiful and powerful operating system that will run well even on old PCs&rdquo;</a>
                </div>
                <div class="column third">
                    <a href="https://web.archive.org/web/20150312112222/http://www.maclife.com/article/columns/future_os_x_may_be_more_elementary_ios_7" target="_blank"><img class="h1" src="images/thirdparty-logos/maclife.svg" data-l10n-off alt="Mac|Life" /></a>
                    <a class="inline-tweet" href="http://twitter.com/home/?status=&ldquo;a fast, low-maintenance platform that can be installed virtually anywhere&rdquo; —@MacLife http://elementary.io" data-tweet-suffix=" — @MacLife http://elementary.io" target="_blank">&ldquo;a fast, low-maintenance platform that can be installed virtually anywhere&rdquo;</a>
                </div>
                <div class="column third">
                    <a href="http://lifehacker.com/how-to-move-on-after-windows-xp-without-giving-up-your-1556573928" target="_blank"><img class="h1" src="images/thirdparty-logos/lifehacker.svg" data-l10n-off alt="Lifehacker" /></a>
                    <a class="inline-tweet" href="http://twitter.com/home/?status=&ldquo;Lightweight and fast… Completely community-based, and has a real flair for design and appearances.&rdquo; —@lifehacker http://elementary.io" data-tweet-suffix=" — @lifehacker http://elementary.io" target="_blank">&ldquo;Lightweight and fast… Completely community-based, and has a real flair for design and appearances.&rdquo;</a>
                </div>
            </div>
            <div id="showcase" class="row grey">
                <div id="notification-container">
                    <div class="window" type="notification">
                        <div><span class="icon" icon="apps/utilities-terminal"><?php include('images/icons/utilities-terminal.svg'); ?></span></div>
                        <div>
                            <h3>Task finished</h3>
                            <p>git clone https://github.com/elementary/mvp</p>
                        </div>
                    </div>
                </div>
                <div id="showcase-index">
                    <h2>Full Of Style And Content.</h2>
                    <p>We have apps. We have the best apps. Our apps have won awards. Take a look at our binder of awards.</p>
                    <ul id="showcase-grid">
                        <a href="#showcase-music"><li class="read-more"><img src="images/icons/multimedia-audio-player.svg" />Music</li></a>
                        <a href="#showcase-midori"><li class="read-more"><img src="images/icons/midori.svg" />Midori</li></a>
                        <a href="#showcase-mail"><li class="read-more"><img src="images/icons/internet-mail.svg" />Mail</li></a>
                        <a href="#showcase-photos"><li class="read-more"><img src="images/icons/multimedia-photo-manager.svg" />Photos</li></a>
                        <a href="#showcase-videos"><li class="read-more"><img src="images/icons/multimedia-video-player.svg" />Videos</li></a>
                        <a href="#showcase-calendar"><li class="read-more"><img src="images/icons/office-calendar.svg" />Calendar</li></a>
                        <a href="#showcase-files"><li class="read-more"><img src="images/icons/system-file-manager.svg" />Files</li></a>
                        <a href="#showcase-terminal"><li class="read-more"><img src="images/icons/utilities-terminal.svg" />Terminal</li></a>
                        <a href="#showcase-scratch"><li class="read-more"><img src="images/icons/accessories-text-editor.svg" />Scratch</li></a>
                        <a href="#showcase-camera"><li class="read-more"><img src="images/icons/accessories-camera.svg" />Camera</li></a>
                    </ul>
                </div>
                <div class="showcase-tab" id="showcase-music">
                    <div><img src="images/screenshots/music.png" alt="music screenshot" /></div>
                    <div>
                        <div class="column">
                            <img src="images/icons/multimedia-audio-player.svg" alt="music icon" />
                        </div>
                        <div class="column">
                            <h2>Music</h2>
                            <p>Organize and listen to your music. Browse by albums, use lightning-fast search, and build playlists of your favorites.</p>
                        </div>
                    </div>
                </div>
                <div class="showcase-tab" id="showcase-midori">
                    <div><img src="images/screenshots/midori.png" alt="midori screenshot" /></div>
                    <div>
                        <div class="column">
                            <img src="images/icons/midori.svg" alt="midori icon" />
                        </div>
                        <div class="column">
                            <h2>Midori</h2>
                            <p>Surf the web with a fast & lightweight web browser. Midori lets you use HTML5 websites and web apps while being lighter on battery life. <a href="https://midori-browser.org" class="read-more">Learn More</a></p>
                        </div>
                    </div>
                </div>
                <div class="showcase-tab" id="showcase-mail">
                    <div><img src="images/screenshots/mail.png" alt="mail screenshot" /></div>
                    <div>
                        <div class="column">
                            <img src="images/icons/internet-mail.svg" alt="mail icon" />
                        </div>
                        <div class="column">
                            <h2>Mail</h2>
                            <p>Who says email has to be boring? Mail puts everything you need front and center, without all the clutter, so you can get back to doing what you want.</p>
                        </div>
                    </div>
                </div>
                <div class="showcase-tab" id="showcase-photos">
                    <div><img src="images/screenshots/photos.png" alt="photos screenshot" /></div>
                    <div>
                        <div class="column">
                            <img src="images/icons/multimedia-photo-manager.svg" alt="photos icon" />
                        </div>
                        <div class="column">
                            <h2>Photos</h2>
                            <p>Import, organize, and edit photos. Make a slideshow. Share with Facebook or Flickr.</p>
                        </div>
                    </div>
                </div>
                <div class="showcase-tab" id="showcase-videos">
                    <div><img src="images/screenshots/videos.png" alt="videos screenshot" /></div>
                    <div>
                        <div class="column">
                            <img src="images/icons/multimedia-video-player.svg" alt="videos icon" />
                        </div>
                        <div class="column">
                            <h2>Videos</h2>
                            <p>Watch movies and videos with a minimal interface. The slim, dark frame fades away so you can see more of your movie.</p>
                        </div>
                    </div>
                </div>
                <div class="showcase-tab" id="showcase-calendar">
                    <div><img src="images/screenshots/calendar.png" alt="calendar screenshot" /></div>
                    <div>
                        <div class="column">
                            <img src="images/icons/office-calendar.svg" alt="calendar icon" />
                        </div>
                        <div class="column">
                            <h2>Calendar</h2>
                            <p>Calendar can create events on the fly, and sync them with services like Google, so you can stay punctual.</p>
                        </div>
                    </div>
                </div>
                <div class="showcase-tab" id="showcase-files">
                    <div><img src="images/screenshots/files.png" alt="files screenshot" /></div>
                    <div>
                        <div class="column">
                            <img src="images/icons/system-file-manager.svg" alt="files icon" />
                        </div>
                        <div class="column">
                            <h2>Files</h2>
                            <p>With support for ftp, samba, and WebDAV, files will never be out of reach.</p>
                        </div>
                    </div>
                </div>
                <div class="showcase-tab" id="showcase-terminal">
                    <div>
                        <div class="window dark" type="terminal">
                            <div class="titlebar">
                                <button class="control">
                                    <span class="icon" icon="actions/window-close"><?php include('images/pantheon/actions/window-close.svg'); ?></span>
                                </button>
                                <span class="title">Home</span>
                                <div>
                                    <button class="search">
                                        <span class="icon" icon="actions/system-search"><?php include('images/pantheon/actions/system-search.svg'); ?></span>
                                    </button>
                                    <button class="control">
                                        <span class="icon" icon="actions/window-maximize"><?php include('images/pantheon/actions/window-maximize.svg'); ?></span>
                                    </button>
                                </div>
                            </div>
                            <div class="tabbar">
                                <button>
                                    <span class="icon" icon="actions/tab-new"><?php include('images/pantheon/actions/tab-new.svg'); ?></span>
                                </button>
                                <div class="tabs">
                                    <div class="tab active">
                                        <button>
                                            <span class="icon" icon="actions/close"><?php include('images/pantheon/actions/close.svg'); ?></span>
                                        </button>
                                        <span class="title">Home</span>
                                    </div>
                                </div>
                                <button disabled>
                                    <span class="icon" icon="actions/document-open-recent"><?php include('images/pantheon/actions/document-open-recent.svg'); ?></span>
                                </button>
                            </div>
                            <div class="input"></div>
                        </div>
                    </div>
                    <div>
                        <div class="column">
                            <img src="images/icons/utilities-terminal.svg" alt="terminal icon" />
                        </div>
                        <div class="column">
                            <h2>Terminal</h2>
                            <p>A good Terminal is a developer's best friend. With a color scheme designed to prevent eye strain, browser-class tabs with history and smart naming, task-completion notifications, natural copy & paste, backlog search and more, who says you can't teach an old app new tricks?</p>
                        </div>
                    </div>
                </div>
                <div class="showcase-tab" id="showcase-scratch">
                    <div><img src="images/screenshots/scratch.png" alt="scratch screenshot" /></div>
                    <div>
                        <div class="column">
                            <img src="images/icons/accessories-text-editor.svg" alt="scratch icon" />
                        </div>
                        <div class="column">
                            <h2>Scratch</h2>
                            <p>With it's great looks, and extensive plugin support, Scratch will be the last text editor you will ever need.</p>
                        </div>
                    </div>
                </div>
                <div class="showcase-tab" id="showcase-camera">
                    <div><img src="images/screenshots/camera.png" alt="camera screenshot" /></div>
                    <div>
                        <div class="column">
                            <img src="images/icons/accessories-camera.svg" alt="camera icon" />
                        </div>
                        <div class="column">
                            <h2>Camera</h2>
                            <p>Something about you being beautiful and something.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div id="appcenter" class="row">
                <div class="column">
                    <img src="images/screenshots/appcenter.png" alt="elementary appcenter categories"/>
                </div>
                <div class="column text-left">
                    <img src="images/icons/system-software-install.svg" />
                    <h2>Closer to the Apps</h2>
                    <p>App Center brings handcrafted applications directly to your desktop, and with faster updates, you will always be closer to new features, without compromising security or stability.</p>
                </div>
            </div>
            <div id="slingshot" class="row">
                <div class="column vertical-top">
                    <div id="slingshot-arrow"><img src='images/slingshot/arrow.svg'></div>
                    <div class="slingshot">
                        <div class="linked">
                            <div id="slingshot-grid-button" class="button active">
                                <?php include('images/icons/view-grid-symbolic.svg'); ?>
                            </div>
                            <div id="slingshot-categories-button" class="button">
                                <?php include('images/icons/view-filter-symbolic.svg'); ?>
                            </div>
                        </div>
                        <div class="entry">
                            <?php include('images/icons/edit-find-symbolic.svg'); ?>
                            <span class="search-term inactive">dat</span>
                            <span class="cursor">|</span>
                            <span class="clear-icon inactive"><?php include('images/icons/edit-clear-symbolic.svg'); ?></span>
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
                            <span class="results-title">Applications</span>
                            <div class="slingshot-search-results searchone inactive">
                            </div>
                            <div class="slingshot-search-results searchtwo inactive">
                            </div>
                            <div class="slingshot-search-results searchthree inactive">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="column half vertical-top text-left">
                    <h2>3 Ways to Explore</h2>
                    <?php include('images/icons/view-grid-symbolic.svg'); ?><h4>Grid</h4>
                    <p>Display all your apps in an alphabetized grid. Flick through and find the one you want.</p>
                    <?php include('images/icons/view-filter-symbolic.svg'); ?><h4>Categories</h4>
                    <p>View your apps automatically organized into categories. Perfect for large collections.</p>
                    <?php include('images/icons/edit-find-symbolic.svg'); ?><h4>Search</h4>
                    <p>Launch apps, open settings panes, run commands, and more from the lightning fast search view.</p>
                </div>
            </div>
            <div class="row">
                <div class="column third">
                    <h2>Open Source</h2>
                    <p>Our code is available for review, scrutiny, modification, and redistribution by anyone. <a class="read-more" href="/get-involved#desktop-development">Learn More</a></p>
                </div>
                <div class="column third">
                    <h2>No Ads. No Spying.</h2>
                    <p>We don't make advertising deals and we don't collect sensitive personal data. Our only income is directly from our users.</p>
                </div>
                <div class="column third">
                    <h2>Safe &amp; Secure</h2>
                    <p>We're built on Linux: the same software powering the U.S Department of Defense, the Bank of China, and more. <a class="read-more" href="http://www.ubuntu.com/usn/trusty/">Security Notices</a></p>
                </div>
            </div>
            <span id="translate-download" style="display:none;" hidden>Download elementary OS</span>
            <span id="translate-purchase" style="display:none;" hidden>Purchase elementary OS</span>
            <div id="download-modal" class="modal">
                <i class="fa fa-close close-modal"></i>
                <h3>Choose a Download</h3>
                <p>We recommend 64-bit for most modern computers. For help and more info, see the <a class="read-more" href="docs/installation" target="_blank">installation guide</a></p>
                <div class="row actions">
                    <div class="column linked">
                        <a class="button close-modal" href="<?php echo $download_link; ?>elementaryos-0.3.2-stable-i386.20151209.iso">Freya 32-bit</a>
                        <a class="button close-modal" title="Torrent Magnet Link" href="magnet:?xt=urn:btih:001b104e49d517cf7a41593a73c3861b7c8e34f8&dn=elementaryos-0.3.2-stable-i386.20151209.iso&tr=https%3A%2F%2Fashrise.com%3A443%2Fphoenix%2Fannounce&tr=udp%3A%2F%2Fopen.demonii.com%3A1337%2Fannounce&tr=udp%3A%2F%2Ftracker.ccc.de%3A80%2Fannounce&tr=udp%3A%2F%2Ftracker.openbittorrent.com%3A80%2Fannounce&tr=udp%3A%2F%2Ftracker.publicbt.com%3A80%2Fannounce&ws=http:<?php echo $download_link; ?>elementaryos-0.3.2-stable-i386.20151209.iso"><i class="fa fa-magnet"></i></a>
                    </div>
                    <div class="column linked">
                        <a class="button suggested-action close-modal" href="<?php echo $download_link; ?>elementaryos-0.3.2-stable-amd64.20151209.iso">Freya 64-bit</a>
                        <a class="button suggested-action close-modal" title="Torrent Magnet Link" href="magnet:?xt=urn:btih:fce720af722a813a184c5550a924aaa60a8d9af1&dn=elementaryos-0.3.2-stable-amd64.20151209.iso&tr=https%3A%2F%2Fashrise.com%3A443%2Fphoenix%2Fannounce&tr=udp%3A%2F%2Fopen.demonii.com%3A1337%2Fannounce&tr=udp%3A%2F%2Ftracker.ccc.de%3A80%2Fannounce&tr=udp%3A%2F%2Ftracker.openbittorrent.com%3A80%2Fannounce&tr=udp%3A%2F%2Ftracker.publicbt.com%3A80%2Fannounce&ws=http:<?php echo $download_link; ?>elementaryos-0.3.2-stable-amd64.20151209.iso"><i class="fa fa-magnet"></i></a>
                    </div>
                </div>
            </div>
            <a style="display:none;" class="open-modal" href="#download-modal"></a>
            <!--[if lt IE 10]><script type="text/javascript" src="https://cdn.jsdelivr.net/g/classlist"></script><![endif]-->
<?php
    include $template['footer'];
?>
