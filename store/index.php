<?php
    require_once __DIR__.'/../_backend/preload.php';
    require_once __DIR__.'/../_backend/config.loader.php';
    require_once __DIR__.'/../_backend/store/product.php';

    $page['title'] = 'Store &sdot; elementary';

    $page['styles'] = array(
        'styles/store.css'
    );

    $page['script-plugins'] = array(
        'https://cdn.jsdelivr.net/g/jquery.leanmodal2@2.5'
    );

    $page['scripts'] = array(
        'scripts/store/index.js' => array(
            'async' => false
        ),
    );

    include $template['header'];
    include $template['alert'];
?>

<section class="grid">
    <div class="two-thirds">
        <h2>Support Development. Get Swag. Win Win.</h2>
        <p>Every purchase goes towards developing elementary OS, its apps, and its services. We're a small <a href="/team">team</a>, mostly volunteer, working constantly to make elementary better. Every little bit of help is one step closer to hiring another full-time developer.</p>
    </div>
</section>

<?php foreach (\Store\Product\get_types() as $type => $groups) { ?>

<div class="grid grid--product">
    <h3 class="grid__title"><?php echo $type ?></h3>

    <?php foreach ($groups as $group) { ?>

        <div class="grid__item" id="group-<?php echo $group['group'] ?>-item" data-product-name="<?php echo $group['name']; ?>">
            <img src="<?php echo $group['image'] ?>"/>
            <h4><?php echo $group['name'] ?></h4>
            <?php if ($group['min_price'] !== $group['max_price']) { ?>
                <p data-l10n-off="1" class="text-center">$<?php echo number_format($group['min_price'], 2) ?> - $<?php echo number_format($group['max_price'], 2) ?></p>
            <?php } else { ?>
                <p data-l10n-off="1" class="text-center">$<?php echo number_format($group['min_price'], 2) ?></p>
            <?php } ?>
            <a style="display:none;" class="open-modal" href="#group-<?php echo $group['group'] ?>-overview"></a>
        </div>

    <?php } ?>

</div>

<?php
}

foreach (\Store\Product\get_groups() as $group) {
    $first = $group['products'][0];
?>

<div class="modal modal--product" id="group-<?php echo $group['group'] ?>-overview" data-product-name="<?php echo $group['name']; ?>">
    <i class="fa fa-close close-modal"></i>
    <div class="grid">
        <div class="half">
            <img src="<?php echo $first['image'] ?>"/>
        </div>
        <form action="<?php echo $sitewide['root'] ?>api/cart" method="POST" class="half">
            <h2><?php echo $first['long_name'] ?></h2>
            <h4 class="modal__price" data-l10n-off="1">$<?php echo number_format($first['price'], 2) ?></h4>
            <p><?php echo $first['description'] ?></p>

            <input type="hidden" name="id" value="<?php echo $first['id'] ?>">
            <input type="hidden" name="group" value="<?php echo $first['group'] ?>">
            <input type="hidden" name="math" value="add">

            <div>
                <?php if (count($group['colors']) > 1) { ?>
                    <h4 class="label">Color</h4>
                    <select name="color" required>
                        <?php foreach ($group['colors'] as $value) { ?>
                            <option value="<?php echo $value ?>"><?php echo $value ?></option>
                        <?php } ?>
                    </select>
                <?php } ?>

                <?php if (count($group['sizes']) > 1) { ?>
                    <h4 class="label">Size</h4>
                    <div class="size-select">
                        <input type="hidden" name="size" value="<?php echo $first['size'] ?>">
                        <?php
                            foreach ($group['sizes'] as $value) {
                                $o = ($value === $first['size']) ? 'checked' : '';
                        ?>
                            <button type="button" value="<?php echo $value ?>"  class="small-button target-amount <?php echo $o ?>"><?php echo $value ?></button>
                        <?php } ?>
                    </div>
                <?php } ?>

                <h4 class="label">Quantity</h4>
                <input type="number" step="1" min="1" value="1" name="quantity">
            </div>

            <span class="alert--error"></span>

            <input type="submit" class="button small-button suggested-action" value="Add to Cart">
        </form>
    </div>
</div>

<?php } ?>

<script>window.products = <?php echo json_encode(\Store\Product\get_products()) ?></script>

<?php
    include $template['footer'];
?>
