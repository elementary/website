<?php $l10n->setDomain('layout'); ?>
        </div>
        <footer>
            <div>
                <p>
                    Copyright &copy; <?php echo date('Y'); ?> <?php echo $sitewide['author']; ?>
                </p>
                <div class="popover">
                    <a href="#"><i class="far fa-language"></i> Language</a>
                    <div class="popover-content">
                        <strong>Change Site Language</strong>
                        <ul>
                        <?php
                        foreach ($l10n->listLangs() as $langCode => $langName) {
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
                <li><a href="<?php echo $sitewide['root'].'press'; ?>">Press</a></li>
                <li><a href="<?php echo $sitewide['root'].'brand'; ?>">Brand</a></li>
                <li><a href="<?php echo $sitewide['root'].'oem'; ?>">OEMs</a></li>
                <li><a href="<?php echo $sitewide['root'].'privacy'; ?>">Privacy</a></li>
                <li><a href="https://github.com/orgs/elementary/people">Team</a></li>
                <li><a href="<?php echo $sitewide['root'].'open-source'; ?>">Open Source</a></li>
            </ul>
        </footer>
        <?php
            include $template['legacy'];
            $l10n->setDomain('layout');
        ?>
    </body>
</html>
<?php $l10n->endHtmlTranslation();
