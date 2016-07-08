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
            <script src="scripts/slider.js"></script>
            <script>var stripe_key = '<?php include __DIR__.'/backend/payment.php'; ?>';</script>
            <script>var release_title = '<?php echo $config['release_title']; ?>';</script>
            <script>var release_version = '<?php echo $config['release_version']; ?>';</script>
            <script>var download_region = '<?php echo $region; ?>';</script>
            <script>
                jQl.loadjQdep('scripts/jQuery.leanModal2.js');
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
                <p class="small-label">0.3 Freya | 1.15 GB (for PC or Mac)</p>
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
            <div id="carousel" class="light">
                <div class="row choices-container">
                    <h1>Meet Our Apps</h1>
                    <div id="carousel-choices" class="column linked">
                        <a class="button flat photos active" href="#photos"><?php include('images/icons/folder-pictures-symbolic.svg');?><span class="label">Photos</span></a>
                        <a class="button flat music" href="#music"><?php include('images/icons/folder-music-symbolic.svg');?><span class="label">Music</span></a>
                        <a class="button flat videos" href="#videos"><?php include('images/icons/folder-videos-symbolic.svg');?></i><span class="label">Videos</span></a>
                        <a class="button flat midori" href="#midori"><?php include('images/icons/web-browser-symbolic.svg');?></i><span class="label">Midori</span></a>
                    </div>
                </div>
                <div class="slide-container">
                    <div id="photos" class="slide">
                        <div class="row">
                            <div class="column">
                                <img src="images/screenshots/photos.png" />
                            </div>
                            <div class="column">
                                <div class="column alert">
                                    <img src="images/icons/multimedia-photo-manager.svg" />
                                </div>
                                <div class="column alert">
                                    <h3>Photos</h3>
                                    <p>Import, organize, and edit photos. Make a slideshow. Share with Facebook or Flickr.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="music" class="slide">
                        <div class="row">
                          <div class="column">
                              <img src="images/screenshots/music.png" />
                          </div>
                          <div class="column">
                              <div class="column alert">
                                  <img src="images/icons/multimedia-audio-player.svg" />
                              </div>
                              <div class="column alert">
                                  <h3>Music</h3>
                                  <p>Organize and listen to your music. Browse by albums, use lightning-fast search, and build playlists of your favorites.</p>
                              </div>
                          </div>
                        </div>
                    </div>
                    <div id="videos" class="slide">
                        <div class="row">
                            <div class="column">
                                <img src="images/screenshots/videos.png" />
                            </div>
                            <div class="column">
                                <div class="column alert">
                                    <img src="images/icons/multimedia-video-player.svg" />
                                </div>
                                <div class="column alert">
                                    <h3>Videos</h3>
                                    <p>Watch movies and videos with a minimal interface. The slim, dark frame fades away so you can see more of your movie.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="midori" class="slide">
                        <div class="row">
                            <div class="column">
                                <img src="images/screenshots/midori.png" />
                            </div>
                            <div class="column">
                                <div class="column alert">
                                    <img src="images/icons/midori.svg" />
                                </div>
                                <div class="column alert">
                                    <h3>Midori</h3>
                                    <p>Surf the web with a fast &amp; lightweight web browser. Midori lets you use HTML5 websites and web apps while being lighter on battery life. <a class="read-more" href="http://midori-browser.org">Learn More</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
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
