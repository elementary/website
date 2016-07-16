<?php
$l10n->set_domain('layout');
if (getenv('PHPENV') && getenv('PHPENV') !== 'production'):
?>
        <div class="row alert warning">
            <div class="column alert">
                <div class="icon">
                    <i class="warning fa fa-warning"></i>
                </div>
                <div class="icon-text">
                    <h3>This is a development site.</h3>
                    <p>You are viewing a development version of our site. Some pages here may not work or act as you expect. If you got here by accident please go to <a href="http://elementary.io">elementary.io</a>, our actual website address.</p>
                </div>
            </div>
        </div>
<?php
endif;
$l10n->set_domain($page['name']);
