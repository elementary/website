<?php
    include '_templates/sitewide.php';
    $page['title'] = 'Brand &sdot; elementary';
    include $template['header'];
    include $template['alert'];
?>

<div class="row docs">
    <h1>Brand</h1>
    <p>The elementary brand is unique: technically it belongs to elementary LLC., the company that guides and supports development of elementary products. However, we have a great community and don’t want to be too overbearing with legal requirements and such. As such, we have written up some guidelines to make it easier to understand when and how the elementary brand should be used.</p>

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
    <p>The logotype is to be used when space allows to refer to elementary the company. It can be used before a product name to refer to a specific product of elementary.</p>
    <p>The logotype should always be used under the following guidelines:</p>
    <ul>
        <li>Do not attempt to recreate the logotype. It is a meticulously-designed brand mark, not simply "elementary" written in a specific font.</li>
        <li>Do not use the logotype at small sizes; if it is not clear, use the logomark instead.</li>
    </ul>

    <h3>Logomark</h3>
    <p>The "e" logomark is to be used to refer to elementary the company when space is constrained or a square ratio is required.</p>

    <h2>Color</h2>
    <p>elementary employs the use of color combined with our name and marks to establish our brand. We use the following palette:</p>
    <div class="palette">
        <dl class="blue">
            <dt>Blueberry</dt>
            <dd class="hex">3892e0</dd>
        </dl>
        <dl class="red">
            <dt>Strawberry</dt>
            <dd class="hex">da4d45</dd>
        </dl>
        <dl class="orange">
            <dt >Orange</dt>
            <dd class="hex">f37329</dd>
        </dl>
        <dl class="yellow">
            <dt>Banana</dt>
            <dd class="hex">fbd25d</dd>
        </dl>
        <dl class="green">
            <dt>Lime</dt>
            <dd class="hex">93d844</dd>
        </dl>
        <dl class="purple">
            <dt>Grape</dt>
            <dd class="hex">904c9b</dd>
        </dl>
        <dl class="white">
            <dt>White</dt>
            <dd class="hex">ffffff</dd>
        </dl>
        <dl class="black">
            <dt>Black</dt>
            <dd class="hex">333333</dd>
        </dl>
    </div>

</div>

<style>
    .hex {
        font-family: mono;
    }

    .hex::before {
        content: "#"
    }

    dl {
        position: relative;
        display: inline-block;
        width: 128px;
        height: 128px;
        margin: 24px;
        border-radius: 50%;
        border: none;
        box-shadow: inset 0 0 0 1px rgba(0,0,0, 0.35), inset 0 0 0 2px rgba(255,255,255, 0.10), inset 0 2px 0 0 rgba(255,255,255, 0.45), inset 0 -2px 0 0 rgba(255,255,255, 0.15), 0 1px 3px 0 rgba(0,0,0,0.12), 0 1px 2px 0 rgba(0,0,0,0.24);
    }

    .blue {
        background-color: #3892e0;
        color: #fff;
    }

    .red {
        background-color: #da4d45;
        color: #fff;
    }

    .orange {
        background-color: #f37329;
        color: #fff;
    }

    .yellow {
        background-color: #fbd25d;
    }

    .green {
        background-color: #93d844;
    }

    .purple {
        background-color: #904c9b;
        color: #fff;
    }

    .white {
        background-color: #fff;
    }

    .black {
        background-color: #333;
        color: #fff;
    }
    
    dt,
    dd {
        display: block;
        width: 100%;
        text-align: center;
        position: absolute;
        top: 50%;
        left: 50%;
        margin: 0;
        padding: 0;
    }

    dt {
        transform: translate(-50%, -100%);
    }

    dd {
        transform: translate(-50%, 0%);
    }
</style>


<?php
    include $template['footer'];
?>
