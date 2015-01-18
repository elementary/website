<?php
    $header_scripts = '';
    $footer_scripts = '<script src="https://checkout.stripe.com/checkout.js"></script> <script src="js/homepage.js"></script>';
    include '_templates/sitewide.php';
    include '_templates/header.php';
?>
            <div class="row">
                <img alt="elementary OS" id="logotype" src="images/logotype.svg">
                <h2>A fast and open replacement for Windows and OS X</h2>
                <input type="text" id="payment" value="$10.00">
                <button id="download" class="suggested-action" onclick="download_clicked();")>Download Freya Beta</button>
                <p class="small-label">886.0 MB (64 bit PC or Mac)</p>
                <p class="small-label"><a href="alternative-downloads">Alternative Downloads</a></p>
            </div>
<?php
    include '_templates/footer.html';
?>
