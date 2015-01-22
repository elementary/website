<?php
    include '_templates/sitewide.php';
    include '_templates/header.php';
?>
            <div class="row">
                <img alt="elementary OS" id="logotype" src="images/logotype.svg">
                <h2>A fast and open replacement for Windows and OS X</h2>
            </div>
                <img class="hero" src="images/notebook.png">
            <div class="row">
                <button id="download" class="suggested-action" onclick=window.open("http://downloads.sourceforge.net/project/elementaryos/unstable/elementaryos-unstable-amd64.20140810.iso")>Download Freya Beta</button>
                <p class="small-label">886.0 MB (64-bit PC or Mac)</p>
                <p class="small-label"><a href="alternative-downloads">Alternative Downloads</a></p>
            </div>
            <div class="row">
                <div class="column third">
                    <h1>Wired</h1>
                    <p>"elementary OS is different… a beautiful and powerful operating system that will run well even on old PCs"</p>
                </div>
                <div class="column third">
                    <h1>Mac|Life</h1>
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
