<?php
    $page['title'] = "Download elementary OS";
    $page['scripts'] = '<script src="https://checkout.stripe.com/checkout.js"></script>';
    include '_templates/sitewide.php';
    include '_templates/header.php';
?>
            <script>
                jQl.loadjQdep('scripts/jQuery.leanModal2.js');
                jQl.loadjQdep('scripts/homepage.js');
            </script>

            <div class="row">
                <img alt="elementary OS" id="logotype" src="images/logotype.svg">
                <h4>A fast and open replacement for Windows and OS X</h4>
            </div>
            <img class="hero" src="images/notebook.png">
            <div class="row">
                <?php
                    if ( isset($_COOKIE['has_paid_freya']) && $_COOKIE['has_paid_freya'] ) {
                        ?>
                <input type="hidden" id="amount-twenty-five" value="0">
                        <?php
                    } else {
                        ?>
                <button id="amount-ten" value="10" class="small-button payment-button target-amount">10</button>
                <button id="amount-twenty-five" value="25" class="small-button payment-button target-amount checked">25</button>
                <button id="amount-fifty" value="50" class="small-button payment-button target-amount">50</button>
                <div class="column">
                    <sup class="pre-amount">$</sup>
                    <input type="number" step="0.01" min="0" max="999999.99" id="amount-custom" class="button small-button target-amount" placeholder="Custom">
                    <p class="small-label focus-reveal text-center">Enter any dollar amount.</p>
                </div>
                <div style="clear:both;"></div>
                        <?php
                    }
                ?>
                <button type="submit" id="download" class="suggested-action">Download Freya Beta</button>
                <p class="small-label">886.0 MB (for PC or Mac)</p>
            </div>
            <div class="row">
                <div class="column third">
                    <a href="http://www.wired.com/2013/11/elementaryos/" target="_blank"><img class="h1" src="images/thirdparty-logos/wired.svg" alt="WIRED" /></a>
                    <a class="inline-tweet" href="http://twitter.com/home/?status=&ldquo;elementary OS is different… a beautiful and powerful operating system that will run well even on old PCs&rdquo; —@WIRED elementaryos.org" target="_blank">&ldquo;elementary OS is different… a beautiful and powerful operating system that will run well even on old PCs&rdquo;</a>
                </div>
                <div class="column third">
                    <a href="http://www.maclife.com/article/columns/future_os_x_may_be_more_elementary_ios_7" target="_blank"><img class="h1" src="images/thirdparty-logos/maclife.svg" alt="Mac|Life" /></a>
                    <a class="inline-tweet" href="http://twitter.com/home/?status=&ldquo;a fast, low-maintenance platform that can be installed virtually anywhere&rdquo; —@MacLife elementaryos.org" target="_blank">&ldquo;a fast, low-maintenance platform that can be installed virtually anywhere&rdquo;</a>
                </div>
                <div class="column third">
                    <a href="http://lifehacker.com/how-to-move-on-after-windows-xp-without-giving-up-your-1556573928" target="_blank"><img class="h1" src="images/thirdparty-logos/lifehacker.svg" alt="Lifehacker" /></a>
                    <a class="inline-tweet" href="http://twitter.com/home/?status=&ldquo;Lightweight and fast… Completely community-based, and has a real flair for design and appearances.&rdquo; —@lifehacker elementaryos.org" target="_blank">&ldquo;Lightweight and fast… Completely community-based, and has a real flair for design and appearances.&rdquo;</a>
                </div>
            </div>
            <div id="download-modal" class="modal">
                <h3>Choose a Download</h3>
                <p>We recommend 64-bit for most modern computers. For help and more info, see the <a class="read-more" href="installation" target="_blank">installation guide</a></p>
                <div class="row actions">
                    <div class="column linked">
                        <a class="button close-modal" target="_blank" href="http://downloads.sourceforge.net/project/elementaryos/unstable/elementaryos-unstable-i386.20140810.iso">Freya Beta 32-bit</a>
                        <a class="button close-modal" href="magnet:?xt=urn:btih:3dbed253ea2f8d23d8098bc7214f53c4c1201924&dn=elementaryos-unstable-i386.20140810.iso&tr=https%3A%2F%2Fashrise.com%3A443%2Fphoenix%2Fannounce&tr=udp%3A%2F%2Fopen.demonii.com%3A1337%2Fannounce&tr=udp%3A%2F%2Ftracker.ccc.de%3A80%2Fannounce&tr=udp%3A%2F%2Ftracker.openbittorrent.com%3A80%2Fannounce&tr=udp%3A%2F%2Ftracker.publicbt.com%3A80%2Fannounce&xs=http%3A%2F%2Felementaryos.org%2Fdownloads%2Felementaryos-unstable-i386.20140810.iso.torrent&ws=http%3A%2F%2Fsuberb-sea2.dl.sourceforge.net%2Fproject%2Felementaryos%2Funstable%2Felementaryos-unstable-i386.20140810.iso&ws=http%3A%2F%2Fignum.dl.sourceforge.net%2Fproject%2Felementaryos%2Funstable%2Felementaryos-unstable-i386.20140810.iso&ws=http%3A%2F%2Fheanet.dl.sourceforge.net%2Fproject%2Felementaryos%2Funstable%2Felementaryos-unstable-i386.20140810.iso&ws=http%3A%2F%2Fcitylan.dl.sourceforge.net%2Fproject%2Felementaryos%2Funstable%2Felementaryos-unstable-i386.20140810.iso"><i class="fa fa-magnet"></i></a>
                    </div>
                    <div class="column linked">
                        <a class="button suggested-action close-modal" target="_blank" href="http://downloads.sourceforge.net/project/elementaryos/unstable/elementaryos-unstable-amd64.20140810.iso">Freya Beta 64-bit</a>
                        <a class="button suggested-action close-modal" href="magnet:?xt=urn:btih:5d3dd0d33aef66d1683cc9f7fac321ce04e93cdd&dn=elementaryos-unstable-amd64.20140810.iso&tr=https%3A%2F%2Fashrise.com%3A443%2Fphoenix%2Fannounce&tr=udp%3A%2F%2Fopen.demonii.com%3A1337%2Fannounce&tr=udp%3A%2F%2Ftracker.ccc.de%3A80%2Fannounce&tr=udp%3A%2F%2Ftracker.openbittorrent.com%3A80%2Fannounce&tr=udp%3A%2F%2Ftracker.publicbt.com%3A80%2Fannounce&xs=http%3A%2F%2Felementaryos.org%2Fdownloads%2Felementaryos-unstable-amd64.20140810.iso.torrent&ws=http%3A%2F%2Fsuberb-sea2.dl.sourceforge.net%2Fproject%2Felementaryos%2Funstable%2Felementaryos-unstable-amd64.20140810.iso&ws=http%3A%2F%2Fignum.dl.sourceforge.net%2Fproject%2Felementaryos%2Funstable%2Felementaryos-unstable-amd64.20140810.iso&ws=http%3A%2F%2Fheanet.dl.sourceforge.net%2Fproject%2Felementaryos%2Funstable%2Felementaryos-unstable-amd64.20140810.iso&ws=http%3A%2F%2Fcitylan.dl.sourceforge.net%2Fproject%2Felementaryos%2Funstable%2Felementaryos-unstable-amd64.20140810.iso"><i class="fa fa-magnet"></i></a>
                    </div>
                </div>
            </div>
            <a style="display:none;" class="open-modal" href="#download-modal"></a>
<?php
    include '_templates/footer.html';
?>
