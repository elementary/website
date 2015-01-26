<?php
    include '_templates/sitewide.php';
    $page['title'] = 'Get Involved';
    $page['scripts'] = '<link rel="stylesheet" type="text/css" media="all" href="styles/get-involved.css">';
    include '_templates/header.php';
?>
            <section class="row hero">
                <h1>Get Involved</h1>
                <h2>Check out our progress for Freya Beta 2</h2>

                <img src="images/get-involved/stats.svg" alt="">

                <h3>Contribute by doing these things</h3>

                <div class="actions">
                    <a class="button" href="#translations">Translations</a>
                    <a class="button" href="#web-development">Web Development</a>
                    <a class="button" href="#design">Design</a>
                    <a class="button" href="#desktop-development">Desktop Development</a>
                </div>
            </section>

            <section id="translations" class="light">
                <div class="heading">
                    <div class="row">
                        <h1>“A different language is a different vision of life.”</h1>
                        <p class="small-label">Federico Fellini</p>
                    </div>
                </div>

                <div class="row">
                    <div class="column">
                        <h2>Translations</h2>
                        <p>elementary is created and used by people from around the entire world; help us make peoples' experiences even better by translating it to more languages. Launchpad has a built-in tool called Rosetta that enables collaborative translations online.</p>

                        <div class="actions">
                            <a class="button suggested-action" href="https://translations.launchpad.net/elementary">View our translations page</a>
                            <a class="button" href="https://help.launchpad.net/Translations">Get more info about Rosetta</a>
                        </div>
                    </div>
                    <div class="column">
                        <img src="images/get-involved/translations.svg" alt="">
                    </div>
                </div>
            </section>

            <section id="web-development" class="dark">
                <div class="heading">
                    <div class="row">
                        <h1>“Websites should look good from the inside and out”</h1>
                        <p class="small-label">Paul Cookson</p>
                    </div>
                </div>

                <div class="row">
                    <div class="web-browser">
                        <h2>Web Development</h2>
                        <p>Our website is built using HTML, CSS, PHP, MySQL, and JavaScript. We're always looking for people experienced in those areas who would like to contribute and make it even better. Most of the design work is done by our design team, but we love design ideas and feedback from our web team.</p>

                        <div class="actions">
                            <a class="button suggested-action" href="#">Hello</a>
                        </div>
                    </div>
                </div>
            </section>

            <section id="design" class="light">
                <div class="heading">
                    <div class="row">
                        <h1>“Great design is making something memorable and meaningful.”</h1>
                        <p class="small-label">Dieter Rams</p>
                    </div>
                </div>

                <div class="row">
                    <div class="column">
                        <h2>Design</h2>
                        <p>Every project begins with an idea. Our Design Team takes ideas and turns them into road maps. We break up design into two components:</p>

                        <p>
                            <strong>Visual Design</strong><br>
                            A great place for visual designers to get started is by sharing mockups with <a href="https://plus.google.com/communities/104613975513761463450/stream/856346d7-1c23-4912-9549-bcfc76b32937">our Google+ Community</a>.
                        </p>

                        <p>
                            <strong>Interactive Design</strong><br>
                            We use a system on Launchpad called Blueprints to create detailed explanations of new features.
                        </p>

                        <div class="actions">
                            <a class="button suggested-action" href="http://elementaryos.org/docs/human-interface-guidelines">Read the HIG</a>
                            <a class="button" href="https://blueprints.launchpad.net/elementary">Browse our Blueprints</a>
                        </div>
                    </div>
                    <div class="column">
                        <img src="images/get-involved/design.svg" alt="">
                    </div>
                </div>
            </section>

            <section id="desktop-development" class="dark">
                <div class="heading">
                    <div class="row">
                        <h1>“Before software can be reusable it first has to be usable”</h1>
                        <p class="small-label">Ralph Johnson</p>
                    </div>
                </div>

                <div class="row">
                    <div class="column">
                        <h2>Desktop Development</h2>
                        <p>Our desktop environment and all it's apps are built using Vala, GTK+, Clutter, Cairo, Granite, and a number of other free libraries. All of our code is hosted on Launchpad.net, a free service for open source projects. We're always looking for contributors of all skill.</p>

                        <div class="actions">
                            <a class="button suggested-action" href="https://code.launchpad.net/~elementary-pantheon">Browse our desktop code</a>
                            <a class="button" href="https://code.launchpad.net/~elementary-apps">Browse our apps' code</a>
                            <a class="button" href="https://bugs.launchpad.net/elementary">See our open bug reports</a>
                        </div>
                    </div>
                    <div class="column">
                        <img src="images/get-involved/desktop-development.svg" alt="">
                    </div>
                </div>
            </section>
<?php
    include '_templates/footer.html';
?>
