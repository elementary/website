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

        <?php include __DIR__.'/legacy.php'; ?>
    </body>
</html>
<?php
$l10n->end_html_translation();
