<?php

    include '_templates/sitewide.php';
    $page['title'] = 'Alternative Downloads';
    include '_templates/header.php';

    /*
        Magnet URL Template
        magnet:?
        xt=urn:btih:HEXHASHHERE&
        dn=elementaryos-unstable-amd64.20140810.iso&
        tr=https%3A%2F%2Fashrise.com%3A443%2Fphoenix%2Fannounce&
        tr=udp%3A%2F%2Fopen.demonii.com%3A1337%2Fannounce&
        tr=udp%3A%2F%2Ftracker.ccc.de%3A80%2Fannounce&
        tr=udp%3A%2F%2Ftracker.openbittorrent.com%3A80%2Fannounce&
        tr=udp%3A%2F%2Ftracker.publicbt.com%3A80%2Fannounce&
        xs=http%3A%2F%2Felementaryos.org%2Fdownloads%2Felementaryos-unstable-amd64.20140810.iso.torrent&
        ws=http%3A%2F%2Fsuberb-sea2.dl.sourceforge.net%2Fproject%2Felementaryos%2Funstable%2Felementaryos-unstable-amd64.20140810.iso&
        ws=http%3A%2F%2Fignum.dl.sourceforge.net%2Fproject%2Felementaryos%2Funstable%2Felementaryos-unstable-amd64.20140810.iso&
        ws=http%3A%2F%2Fheanet.dl.sourceforge.net%2Fproject%2Felementaryos%2Funstable%2Felementaryos-unstable-amd64.20140810.iso&
        ws=http%3A%2F%2Fcitylan.dl.sourceforge.net%2Fproject%2Felementaryos%2Funstable%2Felementaryos-unstable-amd64.20140810.iso
    */

?>
            <div class="row">
                <span class="text-left"><a href="/"><img alt="elementary OS" id="logotype" src="images/logotype.svg"></a></span>
            </div>
            <div class="row">
                <h1>Alternative Downloads</h1>
                <h2>64-bit direct download not doing it for you? Grab elementary OS Freya Beta in another format.</h2>
            </div>
            <div class="row">
                <div class="column linked">
                    <a class="button" href="http://downloads.sourceforge.net/project/elementaryos/unstable/elementaryos-unstable-i386.20140810.iso">Freya Beta 32-bit</a>
                    <a class="button" href="magnet:?xt=urn:btih:3dbed253ea2f8d23d8098bc7214f53c4c1201924&dn=elementaryos-unstable-i386.20140810.iso&tr=https%3A%2F%2Fashrise.com%3A443%2Fphoenix%2Fannounce&tr=udp%3A%2F%2Fopen.demonii.com%3A1337%2Fannounce&tr=udp%3A%2F%2Ftracker.ccc.de%3A80%2Fannounce&tr=udp%3A%2F%2Ftracker.openbittorrent.com%3A80%2Fannounce&tr=udp%3A%2F%2Ftracker.publicbt.com%3A80%2Fannounce&xs=http%3A%2F%2Felementaryos.org%2Fdownloads%2Felementaryos-unstable-i386.20140810.iso.torrent&ws=http%3A%2F%2Fsuberb-sea2.dl.sourceforge.net%2Fproject%2Felementaryos%2Funstable%2Felementaryos-unstable-i386.20140810.iso&ws=http%3A%2F%2Fignum.dl.sourceforge.net%2Fproject%2Felementaryos%2Funstable%2Felementaryos-unstable-i386.20140810.iso&ws=http%3A%2F%2Fheanet.dl.sourceforge.net%2Fproject%2Felementaryos%2Funstable%2Felementaryos-unstable-i386.20140810.iso&ws=http%3A%2F%2Fcitylan.dl.sourceforge.net%2Fproject%2Felementaryos%2Funstable%2Felementaryos-unstable-i386.20140810.iso"><i class="fa fa-magnet"></i></a>
                </div>
                <div class="column linked">
                    <a class="button suggested-action" href="http://downloads.sourceforge.net/project/elementaryos/unstable/elementaryos-unstable-amd64.20140810.iso">Freya Beta 64-bit</a>
                    <a class="button suggested-action" href="magnet:?xt=urn:btih:5d3dd0d33aef66d1683cc9f7fac321ce04e93cdd&dn=elementaryos-unstable-amd64.20140810.iso&tr=https%3A%2F%2Fashrise.com%3A443%2Fphoenix%2Fannounce&tr=udp%3A%2F%2Fopen.demonii.com%3A1337%2Fannounce&tr=udp%3A%2F%2Ftracker.ccc.de%3A80%2Fannounce&tr=udp%3A%2F%2Ftracker.openbittorrent.com%3A80%2Fannounce&tr=udp%3A%2F%2Ftracker.publicbt.com%3A80%2Fannounce&xs=http%3A%2F%2Felementaryos.org%2Fdownloads%2Felementaryos-unstable-amd64.20140810.iso.torrent&ws=http%3A%2F%2Fsuberb-sea2.dl.sourceforge.net%2Fproject%2Felementaryos%2Funstable%2Felementaryos-unstable-amd64.20140810.iso&ws=http%3A%2F%2Fignum.dl.sourceforge.net%2Fproject%2Felementaryos%2Funstable%2Felementaryos-unstable-amd64.20140810.iso&ws=http%3A%2F%2Fheanet.dl.sourceforge.net%2Fproject%2Felementaryos%2Funstable%2Felementaryos-unstable-amd64.20140810.iso&ws=http%3A%2F%2Fcitylan.dl.sourceforge.net%2Fproject%2Felementaryos%2Funstable%2Felementaryos-unstable-amd64.20140810.iso"><i class="fa fa-magnet"></i></a>
                </div>
            </div>
<?php
    include '_templates/footer.html';
?>
