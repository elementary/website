<?php
    $header_scripts = '';
    $footer_scripts = '<script src="https://checkout.stripe.com/checkout.js"></script> <script src="js/homepage.js"></script>';
    include '_templates/sitewide.php';
    include '_templates/header.php';
?>
            <div class="row">
                <img alt="elementary OS" id="logotype" src="images/logotype.svg">
                <h2>A fast and open replacement for Windows and OS X</h2>
                <div class="row">
                    <button id="amount-ten" value="10" class="small-button payment-button target-amount">10</button>
                    <button id="amount-twenty-five" value="25" class="small-button payment-button target-amount checked">25</button>
                    <button  id="amount-fifty" value="50" class="small-button payment-button target-amount">50</button>
                    <div class="column">
                        <sup class="pre-amount" style="margin-left: 10px; margin-right: -18px;">$</sup>
                        <input type="number" step="0.01" min="0" max="999999.99" id="amount-custom" class="button small-button target-amount" placeholder="Custom">
                        <p class="small-label focus-reveal text-center">Enter any dollar amount.</p>
                    </div>
                </div>
                <button id="download" class="suggested-action" onclick="download_clicked();")>Download Freya Beta</button>
                <p class="small-label">886.0 MB (64 bit PC or Mac)</p>
                <p class="small-label"><a href="alternative-downloads">Alternative Downloads</a></p>
            </div>
            <div class="row">
                <div class="column third">
                    <h1>Wired</h1>
                    <p>"elementary OS is different… a beautiful and powerful operating system that will run well even on old PCs"</p>
                </div>
                <div class="column third">
                    <h1>Mac Life</h1>
                    <p>"a fast, low-maintenance platform that can be installed virtually anywhere"</p>
                </div>
                <div class="column third">
                    <h1>Lifehacker</h1>
                    <p>“Lightweight and fast… Completely community-based, and has a real flair for design and appearances.”</p>
                </div>
            </div>
<?php
    include '_templates/footer.html';
?>