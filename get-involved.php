<?php
    include '_templates/sitewide.php';
    $page['title'] = 'Get Involved';
    $page['scripts'] = '<link rel="stylesheet" type="text/css" media="all" href="http://fonts.googleapis.com/css?family=Satisfy">';
    $page['scripts'] .= '<link rel="stylesheet" type="text/css" media="all" href="styles/get-involved.css">';
    include '_templates/header.php';
?>
            <section class="row hero">
                <h1>Get Involved</h1>
                <h2>Check out our progress for Freya Beta 2</h2>

                <img src="images/get-involved/stats.svg" alt="">

                <h3>Contribute by doing these things</h3>

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
                        <h1><a class="inline-tweet" href="http://twitter.com/home/?status=“A different language is a different vision of life.” — Federico Fellini elementaryos.org/get-involved" target="_blank">“A different language is a different vision of life.”</a></h1>
                        <p class="small-label">Federico Fellini</p>
                    </div>
                </div>

                <div class="row">
                    <div class="column">
                        <h2>Translations</h2>
                        <p>elementary OS is created and used by people from around the entire world; help us make peoples' experiences even better by translating it to more languages. Launchpad has a built-in tool called Rosetta that enables collaborative translations online.</p>

                        <div class="actions">
                            <a class="button flat suggested-action" href="https://translations.launchpad.net/elementary" target="_blank">View Our Translations Page</a>
                            <a class="button flat" href="https://help.launchpad.net/Translations" target="_blank">Get More Info About Rosetta</a>
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
                        <h1><a class="inline-tweet" href="http://twitter.com/home/?status=“Websites should look good from the inside and out” — Paul Cookson elementaryos.org/get-involved" target="_blank">“Websites should look good from the inside and out”</a></h1>
                        <p class="small-label">Paul Cookson</p>
                    </div>
                </div>

                <div class="web-browser">
                    <h2>Web Development</h2>
                    <p>Our website is built using HTML, CSS, PHP, and JavaScript. We're always looking for people experienced in those areas who would like to contribute and make it even better. Most of the design work is done by our design team, but we love design ideas and feedback from our web team.</p>

                    <div class="actions">
                        <a class="button flat suggested-action" href="https://github.com/elementary/mvp" target="_blank">Fork Us on GitHub</a>
                    </div>
                </div>
            </section>

            <section id="design" class="light">
                <div class="heading">
                    <div class="row">
                        <h1><a class="inline-tweet" href="http://twitter.com/home/?status=“Great design is making something memorable and meaningful.” — Dieter Rams elementaryos.org/get-involved" target="_blank">“Great design is making something memorable and meaningful.”</a></h1>
                        <p class="small-label">Dieter Rams</p>
                    </div>
                </div>

                <div class="row">
                    <div class="column">
                        <h2>Design</h2>
                        <p>Every project begins with an idea. Our Design Team takes ideas and turns them into road maps. We break up design into two components:</p>

                        <p>
                            <strong>Visual Design</strong><br>
                            A great place for visual designers to get started is by sharing mockups with <a href="https://plus.google.com/communities/104613975513761463450/stream/856346d7-1c23-4912-9549-bcfc76b32937" class="read-more">our Google+ Community</a>
                        </p>

                        <p>
                            <strong>Interactive Design</strong><br>
                            We use a system on Launchpad called Blueprints to create detailed explanations of new features.
                        </p>

                        <div class="actions">
                            <a class="button flat suggested-action" href="http://elementaryos.org/docs/human-interface-guidelines" target="_blank">Read the HIG</a>
                            <a class="button flat" href="https://blueprints.launchpad.net/elementary" target="_blank">Browse Our Blueprints</a>
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
                        <h1><a class="inline-tweet" href="http://twitter.com/home/?status=“Before software can be reusable it first has to be usable” — Ralph Johnson elementaryos.org/get-involved" target="_blank">“Before software can be reusable it first has to be usable”</a></h1>
                        <p class="small-label">Ralph Johnson</p>
                    </div>
                </div>

                <div class="row">
                    <div class="column">
                        <h2>Desktop Development</h2>
                        <p>Our desktop environment and all it's apps are built using Vala, GTK+, Clutter, Cairo, Granite, and a number of other free libraries. All of our code is hosted on Launchpad.net, a free service for open source projects. We're always looking for contributors of all skill.</p>

                        <div class="actions">
                            <a class="button flat suggested-action" href="https://code.launchpad.net/~elementary-pantheon" target="_blank">Browse Our Desktop Code</a>
                            <a class="button flat" href="https://code.launchpad.net/~elementary-apps" target="_blank">Browse Our Apps' Code</a>
                            <a class="button flat" href="https://bugs.launchpad.net/elementary" target="_blank">See Our Open Bug Reports</a>
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
