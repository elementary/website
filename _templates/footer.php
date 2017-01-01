<?php $l10n->set_domain('layout'); ?>
        </div>
        <footer>
            <div>
                <p>
                    Copyright &copy; <?php echo date('Y'); ?> elementary LLC.
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
                <li><a href="<?php echo $sitewide['root'].'brand'; ?>">Brand</a></li>
                <li><a href="<?php echo $sitewide['root'].'privacy-policy'; ?>">Privacy Policy</a></li>
                <li><a href="<?php echo $sitewide['root'].'team'; ?>">Team</a></li>
            </ul>
        </footer>
        <?php
            include $template['legacy'];
            $l10n->set_domain('layout');
        ?>
    </body>
</html>
<?php $l10n->end_html_translation();
