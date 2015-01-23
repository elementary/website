<?php
    $page['scripts'] = '<script src="https://checkout.stripe.com/checkout.js"></script>';
    include '_templates/sitewide.php';
    include '_templates/header.php';
?>
            <script>
                var jQl={q:[],dq:[],gs:[],ready:function(a){'function'==typeof a&&jQl.q.push(a);return jQl},getScript:function(a,c){jQl.gs.push([a,c])},unq:function(){for(var a=0;a<jQl.q.length;a++)jQl.q[a]();jQl.q=[]},ungs:function(){for(var a=0;a<jQl.gs.length;a++)jQuery.getScript(jQl.gs[a][0],jQl.gs[a][1]);jQl.gs=[]},bId:null,boot:function(a){'undefined'==typeof window.jQuery.fn?jQl.bId||(jQl.bId=setInterval(function(){jQl.boot(a)},25)):(jQl.bId&&clearInterval(jQl.bId),jQl.bId=0,jQl.unqjQdep(),jQl.ungs(),jQuery(jQl.unq()), 'function'==typeof a&&a())},booted:function(){return 0===jQl.bId},loadjQ:function(a,c){setTimeout(function(){var b=document.createElement('script');b.src=a;document.getElementsByTagName('head')[0].appendChild(b)},1);jQl.boot(c)},loadjQdep:function(a){jQl.loadxhr(a,jQl.qdep)},qdep:function(a){a&&('undefined'!==typeof window.jQuery.fn&&!jQl.dq.length?jQl.rs(a):jQl.dq.push(a))},unqjQdep:function(){if('undefined'==typeof window.jQuery.fn)setTimeout(jQl.unqjQdep,50);else{for(var a=0;a<jQl.dq.length;a++)jQl.rs(jQl.dq[a]); jQl.dq=[]}},rs:function(a){var c=document.createElement('script');document.getElementsByTagName('head')[0].appendChild(c);c.text=a},loadxhr:function(a,c){var b;b=jQl.getxo();b.onreadystatechange=function(){4!=b.readyState||200!=b.status||c(b.responseText,a)};try{b.open('GET',a,!0),b.send('')}catch(d){}},getxo:function(){var a=!1;try{a=new XMLHttpRequest}catch(c){for(var b=['MSXML2.XMLHTTP.5.0','MSXML2.XMLHTTP.4.0','MSXML2.XMLHTTP.3.0','MSXML2.XMLHTTP','Microsoft.XMLHTTP'],d=0;d<b.length;++d){try{a= new ActiveXObject(b[d])}catch(e){continue}break}}finally{return a}}};if('undefined'==typeof window.jQuery){var $=jQl.ready,jQuery=$;$.getScript=jQl.getScript};
                jQl.loadjQ('//cdn.jsdelivr.net/g/jquery,jquery.leanmodal2');
                jQl.loadjQdep('js/homepage.js');
            </script>
            <div class="row">
                <img alt="elementary OS" id="logotype" src="images/logotype.svg">
                <h2>A fast and open replacement for Windows and OS X</h2>
            </div>
            <img class="hero" src="images/notebook.png">
            <div class="row">
                <button id="amount-ten" value="10" class="small-button payment-button target-amount">10</button>
                <button id="amount-twenty-five" value="25" class="small-button payment-button target-amount checked">25</button>
                <button  id="amount-fifty" value="50" class="small-button payment-button target-amount">50</button>
                <div class="column">
                    <sup class="pre-amount">$</sup>
                    <input type="number" step="0.01" min="0" max="999999.99" id="amount-custom" class="button small-button target-amount" placeholder="Custom">
                    <p class="small-label focus-reveal text-center">Enter any dollar amount.</p>
                </div>
                <div style="clear:both;"></div>
                <button id="download" class="suggested-action" onclick="download_clicked();">Download Freya Beta</button>
                <p class="small-label">886.0 MB (for PC or Mac)</p>
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
            <div id="download-modal" class="modal">
                <h1>Choose a Download</h1>
                <h2>We recommend 64-bit for most modern computers.</h2>
                <div class="row actions">
                    <div class="column linked">
                        <a class="button close-modal" href="http://downloads.sourceforge.net/project/elementaryos/unstable/elementaryos-unstable-i386.20140810.iso">Freya Beta 32-bit</a>
                        <a class="button close-modal" href="magnet:?xt=urn:btih:3dbed253ea2f8d23d8098bc7214f53c4c1201924&dn=elementaryos-unstable-i386.20140810.iso&tr=https%3A%2F%2Fashrise.com%3A443%2Fphoenix%2Fannounce&tr=udp%3A%2F%2Fopen.demonii.com%3A1337%2Fannounce&tr=udp%3A%2F%2Ftracker.ccc.de%3A80%2Fannounce&tr=udp%3A%2F%2Ftracker.openbittorrent.com%3A80%2Fannounce&tr=udp%3A%2F%2Ftracker.publicbt.com%3A80%2Fannounce&xs=http%3A%2F%2Felementaryos.org%2Fdownloads%2Felementaryos-unstable-i386.20140810.iso.torrent&ws=http%3A%2F%2Fsuberb-sea2.dl.sourceforge.net%2Fproject%2Felementaryos%2Funstable%2Felementaryos-unstable-i386.20140810.iso&ws=http%3A%2F%2Fignum.dl.sourceforge.net%2Fproject%2Felementaryos%2Funstable%2Felementaryos-unstable-i386.20140810.iso&ws=http%3A%2F%2Fheanet.dl.sourceforge.net%2Fproject%2Felementaryos%2Funstable%2Felementaryos-unstable-i386.20140810.iso&ws=http%3A%2F%2Fcitylan.dl.sourceforge.net%2Fproject%2Felementaryos%2Funstable%2Felementaryos-unstable-i386.20140810.iso"><i class="fa fa-magnet"></i></a>
                    </div>
                    <div class="column linked">
                        <a class="button suggested-action close-modal" href="http://downloads.sourceforge.net/project/elementaryos/unstable/elementaryos-unstable-amd64.20140810.iso">Freya Beta 64-bit</a>
                        <a class="button suggested-action close-modal" href="magnet:?xt=urn:btih:5d3dd0d33aef66d1683cc9f7fac321ce04e93cdd&dn=elementaryos-unstable-amd64.20140810.iso&tr=https%3A%2F%2Fashrise.com%3A443%2Fphoenix%2Fannounce&tr=udp%3A%2F%2Fopen.demonii.com%3A1337%2Fannounce&tr=udp%3A%2F%2Ftracker.ccc.de%3A80%2Fannounce&tr=udp%3A%2F%2Ftracker.openbittorrent.com%3A80%2Fannounce&tr=udp%3A%2F%2Ftracker.publicbt.com%3A80%2Fannounce&xs=http%3A%2F%2Felementaryos.org%2Fdownloads%2Felementaryos-unstable-amd64.20140810.iso.torrent&ws=http%3A%2F%2Fsuberb-sea2.dl.sourceforge.net%2Fproject%2Felementaryos%2Funstable%2Felementaryos-unstable-amd64.20140810.iso&ws=http%3A%2F%2Fignum.dl.sourceforge.net%2Fproject%2Felementaryos%2Funstable%2Felementaryos-unstable-amd64.20140810.iso&ws=http%3A%2F%2Fheanet.dl.sourceforge.net%2Fproject%2Felementaryos%2Funstable%2Felementaryos-unstable-amd64.20140810.iso&ws=http%3A%2F%2Fcitylan.dl.sourceforge.net%2Fproject%2Felementaryos%2Funstable%2Felementaryos-unstable-amd64.20140810.iso"><i class="fa fa-magnet"></i></a>
                    </div>
                </div>
            </div>
            <a style="display:none;" class="open-modal" href="#download-modal"></a>
<?php
    include '_templates/footer.html';
?>