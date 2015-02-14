<?php
    include '_templates/sitewide.php';
    $page['title'] = 'Get Involved with elementary OS';
    $page['theme-color'] = '#3E4E54';
    $page['scripts'] = '<link rel="stylesheet" type="text/css" media="all" href="http://fonts.googleapis.com/css?family=Satisfy">';
    $page['scripts'] .= '<link rel="stylesheet" type="text/css" media="all" href="styles/get-involved.css">';
    $page['scripts'] .= '<script src="scripts/Chart.custom.min.js"></script>';
    include $template['header'];
?>
            <section class="row hero">
                <h1>Check out our progress for Freya Beta 2</h1>
                <div class="charts">
                    <div class="barchart-ctn">
                        <canvas width="750" height="400"></canvas>
                    </div>
                    <div class="doughnuts-ctn">
                        <div class="doughnut fix-committed">
                            <canvas id="fix-committed-chart" width="90" height="90"></canvas>
                            <div class="doughnut-label">
                                <span class="doughnut-count">133</span><br>
                                Fixed
                            </div>
                        </div>
                        <div class="doughnut in-progress">
                            <canvas id="in-progress-chart" width="90" height="90"></canvas>
                            <div class="doughnut-label">
                                <span class="doughnut-count">40</span><br>
                                In Progress
                            </div>
                        </div>
                        <div class="doughnut created">
                            <canvas id="created-chart" width="90" height="90"></canvas>
                            <div class="doughnut-label">
                                <span class="doughnut-count">87</span><br>
                                Unfixed
                            </div>
                        </div>
                    </div>
                </div>
                <div class="actions">
                    <a class="button flat" href="#translations">Translations</a>
                    <a class="button flat" href="#web-development">Web Development</a>
                    <a class="button flat" href="#design">Design</a>
                    <a class="button flat" href="#desktop-development">Desktop Development</a>
                </div>
            </section>

            <section id="translations" class="light">
                <div class="heading">
                    <div class="row">
                        <q><a class="inline-tweet" href="http://twitter.com/home/?status=&ldquo;A different language is a different vision of life.&rdquo; —Federico Fellini elementary.io/get-involved" target="_blank">&ldquo;A different language is a different vision of life.&rdquo;</a></q>
                        <p class="small-label"><a href="https://en.wikipedia.org/wiki/Federico_Fellini" target="_blank">Federico Fellini</a></p>
                    </div>
                </div>

                <div class="row">
                    <div class="column half">
                        <h2>Translations</h2>
                        <p>elementary OS is created and used by people from all around the World; help us make the experience even better by translating it into more languages. Launchpad has a built-in tool called Rosetta that enables collaborative translations online.</p>

                        <div class="actions">
                            <a class="button flat suggested-action" href="https://translations.launchpad.net/elementary" target="_blank">View Our Translations Page</a>
                            <a class="button flat" href="https://help.launchpad.net/Translations" target="_blank">Get More Info About Rosetta</a>
                        </div>
                    </div>
                    <div class="column half">
                        <img src="images/get-involved/translations.svg" alt="World map">
                    </div>
                </div>
            </section>

            <section id="web-development" class="dark">
                <div class="heading">
                    <div class="row">
                        <q><a class="inline-tweet" href="http://twitter.com/home/?status=&ldquo;Websites should look good from the inside and out&rdquo; —Paul Cookson elementary.io/get-involved" target="_blank">&ldquo;Websites should look good from the inside and out&rdquo;</a></q>
                        <p class="small-label"><a href="https://twitter.com/paulcookson" target="_blank">Paul Cookson</a></p>
                    </div>
                </div>

                <div class="web-browser">
                    <h2>Web Development</h2>
                    <p>Our website is built using HTML, CSS, PHP and JavaScript. We're always looking for people experienced in those areas who would like to contribute and make it even better. Most of the design work is done by our Design Team, but we love design ideas and feedback for our Web Team.</p>

                    <div class="actions">
                        <a class="button flat suggested-action" href="https://github.com/elementary/mvp" target="_blank">Fork Us on GitHub</a>
                        <a class="button flat" href="https://github.com/elementary/mvp/issues" target="_blank">See Our Open Bug Reports</a>
                    </div>
                </div>
            </section>

            <section id="design" class="light">
                <div class="heading">
                    <div class="row">
                        <q><a class="inline-tweet" href="http://twitter.com/home/?status=&ldquo;Great design is making something memorable and meaningful.&rdquo; —Dieter Rams elementary.io/get-involved" target="_blank">&ldquo;Great design is making something memorable and meaningful.&rdquo;</a></q>
                        <p class="small-label"><a href="https://en.wikipedia.org/wiki/Dieter_Rams" target="_blank">Dieter Rams</a></p>
                    </div>
                </div>

                <div class="row">
                    <div class="column half">
                        <h2>Design</h2>
                        <p>Every project begins with an idea. Our Design Team takes these and turns them into road maps. We break up design into two components:</p>

                        <p>
                            <strong>Visual Design</strong><br>
                            A great place for visual designers to get started is by sharing mockups with <a href="https://plus.google.com/communities/104613975513761463450/stream/856346d7-1c23-4912-9549-bcfc76b32937" class="read-more">our Google+ Community</a>
                        </p>

                        <p>
                            <strong>Interactive Design</strong><br>
                            We use a system on Launchpad called Blueprints to create detailed explanations of new features.
                        </p>

                        <div class="actions">
                            <a class="button flat suggested-action" href="http://elementary.io/docs/human-interface-guidelines" target="_blank">Read the Interface Guidelines</a>
                            <a class="button flat" href="https://blueprints.launchpad.net/elementary" target="_blank">Browse Our Blueprints</a>
                            <a class="button flat" href="http://blog.elementary.io/post/107662321291/so-you-fancy-yourself-a-designer" target="_blank">Read About Our Workflow</a>
                        </div>
                    </div>
                    <div class="column half">
                        <img src="images/get-involved/design.svg" alt="Application wire frame">
                    </div>
                </div>
            </section>

            <section id="desktop-development" class="dark">
                <div class="heading">
                    <div class="row">
                        <q><a class="inline-tweet" href="http://twitter.com/home/?status=&ldquo;Before software can be reusable it first has to be usable&rdquo; —Ralph Johnson elementary.io/get-involved" target="_blank">&ldquo;Before software can be reusable it first has to be usable&rdquo;</a></q>
                        <p class="small-label"><a href="https://twitter.com/RalphJohnson" target="_blank">Ralph Johnson</a></p>
                    </div>
                </div>

                <div class="row">
                    <div class="column half">
                        <h2>Desktop Development</h2>
                        <p>Our desktop environment and all its apps are built using Vala, GTK+, Clutter, Cairo, Granite and a number of other free libraries. All of our code is hosted on Launchpad.net, a free service for open source projects. We're always looking for contributors of all skill levels.</p>

                        <div class="actions">
                            <a class="button flat suggested-action" href="https://code.launchpad.net/~elementary-pantheon" target="_blank">Browse Our Desktop Code</a>
                            <a class="button flat" href="https://code.launchpad.net/~elementary-apps" target="_blank">Browse Our Apps' Code</a>
                            <a class="button flat" href="https://bugs.launchpad.net/elementary" target="_blank">See Our Open Bug Reports</a>
                        </div>
                    </div>
                    <div class="column half">
                        <img src="images/get-involved/desktop-development.svg" alt="Scratch text editor">
                    </div>
                </div>
            </section>

            <script src="scripts/get-involved.js"></script>
<?php
    include $template['footer'];
?>
