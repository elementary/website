<?php
    include '_templates/sitewide.php';
    $page['title'] = 'Store &sdot; elementary';
    $page['scripts'] = '<link rel="stylesheet" type="text/css" media="all" href="styles/store/index.css">';
    include $template['header'];
    include $template['alert'];
?>
            <div class="row">
                <h1>Store</h1>
            </div>
            <div class="row category">
                <h2>Apparel</h2>
                <div>
                    <div class="product">
                        <img src="/images/store/apparel/logotype-small.png"/>
                        <h2>Logotype</h2>
                        <h3>$20</h3>
                        <p>something something cool about this awesome shirt</p>
                        <div class="popup">
                            <h1>Logotype Tee</h1>
                            <div class="grid">
                                <img class="half" src="/images/store/apparel/logotype-large.png"/>
                                <div class="half">
                                    <h2>$20</h2>
                                    <p>something something cool about this awesome shirt</p>
                                    <form>
                                        <input type="hidden", name="product", value="apparel-logotype"></input>
                                        <label for="quantity">Qty</label>
                                        <input type="number", name="quantity", min="1", value="1"></input>
                                        <input type="submit", value="Add to Cart"></input>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="product">
                        <img src="/images/store/apparel/music-small.png"/>
                        <h2>Music</h2>
                        <h3>$20</h3>
                        <p>something something cool about this awesome shirt</p>
                        <div class="popover">
                        </div>
                    </div>
                    <div class="product">
                        <img src="/images/store/apparel/terminal-small.png"/>
                        <h2>Terminal</h2>
                        <h3>$20</h3>
                        <p>something something cool about this awesome shirt</p>
                        <div class="popover">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row category">
                <h2>Stickers</h2>
                <div>
                    <div class="product">
                        <img src="/images/store/stickers/logomark-small.png"/>
                        <h2>Terminal</h2>
                        <h3>$20</h3>
                        <p>something something cool about this awesome shirt</p>
                        <div class="popover">
                        </div>
                    </div>
                    <div class="product">
                        <img src="/images/store/stickers/logotype-small.png"/>
                        <h2>Terminal</h2>
                        <h3>$20</h3>
                        <p>something something cool about this awesome shirt</p>
                        <div class="popover">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <h4>All apparel is in US sizes. Tees run a bit snug; for sizing details, see American Apparel&rsquo;s <a href="http://www.americanapparel.net/sizing/default.asp?chart=mu.shirts" target="_blank">sizing chart</a>.</h4>
            </div>

<?php
    include $template['footer'];
?>
