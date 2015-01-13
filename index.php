<?php
    include '_templates/sitewide.php';
    include '_templates/header.php';
?>
            <div class="row">
                <img alt="elementary OS" id="logotype" src="images/logotype.svg">
                <h2>A fast and open replacement for Windows and OS X</h2>
                <button id="download" class="suggested-action" onclick=window.open("http://downloads.sourceforge.net/project/elementaryos/unstable/elementaryos-unstable-amd64.20140810.iso")>Download Freya Beta</button>
                <p class="small-label">886.0 MB (64 bit PC or Mac)</p>
            </div>
            <div id="overlay"></div>
            <div id="overlay-content">
                <label>Download elementary OS</label>
                <form action="">
                    <input type="radio" name="bit" value="32">32Bit or
                    <input type="radio" name="bit" value="64" checked="checked">64Bit
                </form>
                <button id="overlay-download" class="suggested-action">Download Freya Beta</button>
                <p><a href="#">Download Freya using Torrent</a></p>
            </div>
<?php
    include '_templates/footer.html';
?>