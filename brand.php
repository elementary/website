<?php
    include __DIR__.'/_templates/sitewide.php';

    $page['title'] = 'Brand &sdot; elementary';

    $page['styles'] = array(
        'styles/brand.css'
    );

    include $template['header'];
    include $template['alert'];
?>

<div class="row docs">
    <h1>Brand</h1>
    <p>The elementary brand is unique: technically it belongs to elementary LLC., the company that guides and supports development of elementary products. However, we have a great community and don’t want to be too overbearing with legal requirements and technicalities. As such, we have written up some guidelines to make it easier to understand when and how the elementary brand should be used.</p>

    <h2>Name</h2>
    <p>The word "elementary" refers to and is a trademark of elementary LLC. elementary is always lower-case, even when beginning sentences such as this. It is also used along with product names (i.e. "elementary OS") to refer to a specific product of elementary.</p>

    <h2>Brand Marks</h2>
    <p>elementary owns two marks: the "elementary" logotype and the "e" logomark. Both are considered trademarks and represent elementary—the company—and its products.</p>
    <p>Both should be used with the following in mind:</p>
    <ul>
        <li>Do not stretch, skew, rotate, flip, or otherwise alter the marks.</li>
        <li>Do not use the marks on an overly-busy background; solid colors work best.</li>
        <li>The marks should always be monochromatic; typically white if on a dark background, or black if on a light background.</li>
    </ul>

    <h3>Logotype</h3>
    <img src="<?=$sitewide['root'];?>images/brand/logotype.png" alt="elementary Logotype"/>
    <p>The logotype is to be used when space allows to refer to elementary the company. It can be used before a product name to refer to a specific product of elementary.</p>
    <p>The logotype should always be used under the following guidelines:</p>
    <ul>
        <li>Do not attempt to recreate the logotype. It is a meticulously-designed brand mark, not simply "elementary" written in a specific font.</li>
        <li>Do not use the logotype at small sizes; if it is not clear, use the logomark instead.</li>
    </ul>

    <h3>Logomark</h3>
    <img src="<?=$sitewide['root'];?>images/brand/logomark.png" alt="elementary Logomark"/>
    <p>The "e" logomark is to be used to refer to elementary the company when space is constrained or a square ratio is required.</p>

    <h2>Color</h2>
    <p>elementary employs the use of color combined with our name and marks to establish our brand. We use the following palette:</p>
    <div class="palette">
        <dl class="blue">
            <dt>Blueberry</dt>
            <dd class="hex" data-l10n-off="1">3892e0</dd>
        </dl>
        <dl class="red">
            <dt>Strawberry</dt>
            <dd class="hex" data-l10n-off="1">da4d45</dd>
        </dl>
        <dl class="orange">
            <dt >Orange</dt>
            <dd class="hex" data-l10n-off="1">f37329</dd>
        </dl>
        <dl class="yellow">
            <dt>Banana</dt>
            <dd class="hex" data-l10n-off="1">fbd25d</dd>
        </dl>
        <dl class="green">
            <dt>Lime</dt>
            <dd class="hex" data-l10n-off="1">93d844</dd>
        </dl>
        <dl class="purple">
            <dt>Grape</dt>
            <dd class="hex" data-l10n-off="1">8a4ebf</dd>
        </dl>
        <dl class="white">
            <dt>White</dt>
            <dd class="hex" data-l10n-off="1">ffffff</dd>
        </dl>
        <dl class="black">
            <dt>Black</dt>
            <dd class="hex" data-l10n-off="1">333333</dd>
        </dl>
    </div>

    <h2>Fonts</h2>
    <p>For web and print, we use Raleway for headings and Open Sans for body copy. For code blocks, we use Roboto Mono.</p>

    <h2>Third Parties</h2>
    <p>We encourage third party developers creating products for elementary OS to adopt certain elements of the elementary brand to achieve consistency:</p>
    <ul>
        <li>Color</li>
        <li>Fonts</li>
        <li>Voice/tone</li>
    </ul>
    <p>However, to avoid user confusion, we do restrict the usage of the elementary name and marks:</p>
    <ul>
        <li>You are encouraged to say that your app or service is designed for elementary OS, but please don't use the elementary name or marks as part of the name of your company, application, product, service, or in any logo you create.</li>
        <li>Only use the elementary name or marks to refer to elementary LLC. or its products (i.e. elementary OS).</li>
    </ul>

    <h2>Merchandise</h2>
    <p>We do not typically allow our branding (including our name or brand marks) to be used on third-party merchandise.</p>

    <h2>Assets &amp; More Info</h2>
    <a class="button suggested-action" href="https://github.com/elementary/brand"><i class="fa fa-github"></i> Download on GitHub</a>
    <p>For further information regarding the use of the elementary name, branding, and trademarks, please email <a href="mailto:brand@elementary.io">brand@elementary.io</a>.</p>
</div>

<?php
    include $template['footer'];
?>
