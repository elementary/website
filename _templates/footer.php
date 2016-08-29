<?php
$l10n->set_domain('layout');
?>
        </div>
        <footer>
            <div>
                <p>
                    Copyright &copy; <?php echo date('Y'); ?> elementary LLC.
                    <a href="<?php echo $sitewide['root'].'team'; ?>">Team</a>
                    <a href="<?php echo $sitewide['root'].'brand'; ?>">Brand</a>
                    <a href="<?php echo $sitewide['root'].'privacy-policy'; ?>">Privacy Policy</a>
                </p>
                <div class="popover">
                    <a href="#"><i class="fa fa-language"></i> Language</a>
                    <div class="popover-content">
                        <strong>Change Site Language</strong>
                        <ul>
                        <?php
                        foreach ($l10n->list_langs() as $langCode => $langName) {
                            $path = $sitewide['root'].$langCode.$page['path'];
                            ?>
                            <li><a href="<?php echo $path; ?>" rel="alternate" hreflang="<?php echo str_replace('_', '-', $langCode); ?>" data-l10n-off>
                                <?php echo $langName; ?>
                            </a></li>
                            <?php
                            if ($langCode == 'en') {
                                ?>
                                <hr>
                                <?php
                            }
                        }
                        ?>
                        </ul>
                    </div>
                </div>
            </div>
            <ul>
                <li><a href="https://twitter.com/elementary" target="_blank" data-l10n-off title="Twitter"><i class="fa fa-twitter"></i></a></li>
                <li><a href="https://www.reddit.com/r/elementaryos" target="_blank" data-l10n-off title="Reddit"><i class="fa fa-reddit"></i></a></li>
                <li><a href="https://elementaryos.stackexchange.com" target="_blank" data-l10n-off title="StackExchange"><i class="fa fa-stack-exchange"></i></i></a></li>
                <li><a href="https://plus.google.com/+elementary" target="_blank" data-l10n-off title="Google+"><i class="fa fa-google-plus"></i></a></li>
                <li><a href="https://www.facebook.com/elementaryos" target="_blank" data-l10n-off title="Facebook"><i class="fa fa-facebook"></i></a></li>
            </ul>
        </footer>

        <!--[if IE]>
            <div id="legacy-warning">
                <h1>The elementary OS website is built on modern web technologies your browser doesn&rsquo;t support.</h1>
                <p>This version of Internet Explorer is out of date and may contain bugs or security vulnerabilities. Please <a href="http://browsehappy.com/">upgrade</a> to IE 11 or an alternative web browser.</p>
                <div id="legacy-warning-buttons">
                    <a href="#" onClick="document.getElementById('legacy-warning').style.display = 'none';">Dismiss</a>
                    <a class="suggested-action" href="http://browsehappy.com/" target="_blank">Learn More</a>
                </div>
            </div>
        <![endif]-->

        <?php
            // Load all non async javascript tags at the end of page
            foreach ($page['scripts'] as $one => $two) {
                $src = (!is_string($one)) ? $two : $one;
                $atr = (is_array($two)) ? $two : array();

                if (!isset($atr['async'])) $atr['async'] = true;
                if ($atr['async'] === true) continue;

                $atr_string = "";
                foreach ($atr as $name => $setting) {
                    if (is_bool($setting) && $setting === true) {
                        $atr_string .= ' ' . $name;
                    } else if (!is_bool($setting)) {
                        $atr_string .= ' ' . $name . '="' . $setting . '"';
                    }
                }
        ?>
        <script src="<?php echo $src ?>"<?php echo $atr_string ?>></script>
        <?php } ?>

    </body>
</html>
<?php
$l10n->end_html_translation();
?>
