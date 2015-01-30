<?php
    include '_templates/sitewide.php';
    $page['title'] = 'Develop Apps for elementary OS';
    $page['theme-color'] = '#226BB3';
    $page['scripts'] .= '<link rel="stylesheet" type="text/css" media="all" href="styles/developer.css">';
    include '_templates/header.php';
?>
            <div class="row">
                <div class="column half developer-sum">
                    <h1>Develop</h1>
                    <h2>Your ideas into code</h2>
                    <p>Built on the best open source technology, elementary is an extremely developer-friendly platform. We provide existing and prospective developers the best available resources and documentation to ensure that your apps really shine.</p>
                </div>
                <div class="column half developer-sections">
                    <div id="dev-section-1" class="dev-section">
                        <a href="http://elementaryos.org/docs/human-interface-guidelines" title="Design" target="_blank">
                            <h5>Design</h5>
                            <p>Read the Human Interface Guidelines (HIG) and learn how to make your app a first-class experience.</p>
                        </a>
                    </div>
                    <div id="dev-section-2" class="dev-section">
                        <a href="http://elementaryos.org/docs/code" title="Code" target="_blank">
                            <h5>Code</h5>
                            <p>Learn about our Application Programming Interface (APIs), and discover all the built-in technologies available to you.</p>
                        </a>
                    </div>
                    <div id="dev-section-3" class="dev-section">
                        <a href="https://launchpad.net/elementary" title="Manage" target="_blank">
                            <h5>Manage</h5>
                            <p>Use Launchpad to manage bug reports and collaborate with other developers.</p>
                        </a>
                    </div>
                    <div id="dev-section-4" class="dev-section">
                        <a href="http://developer.ubuntu.com/publish" title="Distribute" target="_blank">
                            <h5>Distribute</h5>
                            <p>Set up an Ubuntu My Apps account and publish your apps into the Software Center.</p>
                        </a>
                    </div>
                </div>
            </div>
<?php
    include '_templates/footer.html';
?>
