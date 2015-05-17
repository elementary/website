<?php
    include '_templates/sitewide.php';
    $page['title'] = 'Store &sdot; elementary';
    include $template['header'];
?>
            <style>
                .store-product img{
                    width: 100%;
                    margin-bottom: 2em;
                }
            </style>
            <div class="row">
                <h1>International Store</h1>
                <h4>This store is only for non-US orders.</h4>
                <h4>In the US? Check out our <a href="store">US store</a>.</h4>
            </div>
            <div class="row">
                <div class="column half store-product">
                    <img src="http://placehold.it/600&text=Logomark Stickers" />
                    <h5>Logomark Stickers (set of 3)</h5>
                    <span class="price">$1.50 USD</span>
                    <select>
                        <option disabled="disabled" selected="selected" value="0">Quantity</option>
                        <option value="0">None</option>
                        <option value="1">1 set</option>
                        <option value="2">2 sets</option>
                        <option value="3">3 sets</option>
                        <option value="4">4 sets</option>
                        <option value="5">5 sets</option>
                        <option value="6">6 sets</option>
                        <option value="7">7 sets</option>
                        <option value="8">8 sets</option>
                        <option value="9">9 sets</option>
                        <option value="10">10 sets</option>
                    </select>
                    <p class="desc">Set of blue 2-inch (5 cm) circle stickers with the elementary "e" logomark in white. Silkscreened on premium vinyl and layered with three coats of 100% UV protection meaning your stickers will stick for several years without fading.</p>
                </div>
                <div class="column half store-product">
                    <img src="http://placehold.it/600&text=Logotype Sticker" />
                    <h5>Logotype Sticker</h5>
                    <span class="price">$3.00 USD</span>
                    <select>
                        <option disabled="disabled" selected="selected" value="0">Quantity</option>
                        <option value="0">None</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                    </select>
                    <p class="desc">elementary logotype in white on a transparent vinyl sticker; perfect for your laptop or car window. Measures approximately 8 × 2" (20 × 5 cm). Silkscreened on premium vinyl and layered with three coats of 100% UV protection meaning your stickers will stick for several years without fading.</p>
                </div>
            </div>
            <div class="row">
                <a href="#" class="button suggested-action">Checkout</a>
            </div>

<?php
    include $template['footer'];
?>