<?php
    include '_templates/sitewide.php';
    $page['title'] = 'Get Involved with elementary OS';
    $page['theme-color'] = '#3E4E54';
    $page['scripts'] = '<link rel="stylesheet" type="text/css" media="all" href="https://fonts.googleapis.com/css?family=Marck+Script">';
    $page['scripts'] .= '<link rel="stylesheet" type="text/css" media="all" href="styles/get-involved.css">';
    $page['scripts'] .= '<script src="scripts/Chart.custom.min.js"></script>';
    include $template['header'];
    include $template['alert'];
?>
<section class="hero">
    <div class="grid">
        <div class="two-thirds">
            <h1>Be a Part of Something Bigger</h1>
            <p>Everything that we make is 100% open source and developed collaboratively by people from all over the world. Even if you're not a programmer, you can get involved and help shape the course of elementary.</p>
        </div>

        <div class="whole" id="sections-menu">
            <a class="button flat" href="#funding">Funding</a>
            <a class="button flat" href="#translations">Translations</a>
            <a class="button flat" href="#support">Support</a>
            <a class="button flat" href="#web-development">Web</a>
            <a class="button flat" href="#desktop-development">Desktop</a>
            <a class="button flat" href="#design">Design</a>
        </div>
    </div>
</section>

<section id="funding">
    <div class="grid">
        <div class="two-thirds">
            <h1>Funding</h1>
            <p>The biggest way to help out elementary is with funding. With your help, we've been able to grow from a small group of passionate volunteers into a tiny company. Every little bit of help is one step closer to hiring another full-time developer.</p>
        </div>
        <div class="half">
            <h2>Bug Bounties</h2>
            <p>BountySource puts funds directly in the hands of developers by rewarding them for committing fixes or creating new features. Set a bounty on the issues that matter to you most or fund a specific app. You can also set up a recurring subscription. <a class="read-more" href="https://github.com/bountysource/frontend/wiki/Frequently-Asked-Questions" target="blank">Learn More</a></p>

            <div class="actions">
                <a class="button flat suggested-action" href="https://www.bountysource.com/teams/elementary">BountySource</a>
                <a class="button flat" href="https://bugs.launchpad.net/elementary/+bugs?orderby=-importance&field.status%3Alist=CONFIRMED&field.status%3Alist=TRIAGED&field.tag=bounty&field.omit_dupes=on&field.has_branches=on&field.has_no_branches=on&field.has_blueprints=on&field.has_no_blueprints=on&search=Search">Bountied Bugs</a>
            </div>
        </div>
        <div class="half">
            <h2>General Funding</h2>
            <p>Patreon works like an ongoing crowdfunding campaign. Choose an amount, get rewards, and help us reach our goals. <a class="read-more" href="https://www.patreon.com/" target="blank">Learn More</a></p>
            <p>PayPal is a quick and easy solution. Choose a one-time amount or set up a subscription.</p>

            <div class="actions">
                <a class="button flat suggested-action" href="https://www.patreon.com/elementary" target="_blank">Patreon</a>
                <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
                <input type="hidden" name="cmd" value="_s-xclick">
                <input type="hidden" name="hosted_button_id" value="LG382EHQVTDYN">
                <input type="submit" value="PayPal" name="submit" title="PayPal - The safer, easier way to pay online!" class="button flat">
                <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
                </form>
            </div>
        </div>
    </div>
</section>

<section id="translations">
    <div class="grid">
        <div class="whole">
            <h1>Translations</h1>
        </div>
        <div class="half">
            <p>elementary OS is created and used by people from all around the World; help us make the experience even better by translating it into more languages.</p>
            <p>elementary OS uses an open, collaborative translation tool on Launchpad called Rosetta. <a href="/docs/translation-guide#translating-applications" class="read-more">Learn More</a></p>
            <p>Our website is also openly translated using an online platform called Transifex. <a href="/docs/translation-guide#translating-our-website" class="read-more">Learn More</a></p>

            <div class="actions">
                <a class="button flat suggested-action" href="https://translations.launchpad.net/elementary" target="_blank">Translate elementary OS</a>
                <a class="button flat" href="https://www.transifex.com/projects/p/elementary-mvp/" target="_blank">Translate This Website</a>
            </div>
        </div>
        <div class="half">
            <img src="images/get-involved/translations.svg" alt="World map">
        </div>
    </div>
</section>

<section id="support">
    <div class="grid">
        <div class="two-thirds">
            <h1>Support</h1>
            <p></p>
        </div>
        <div class="half">
            <h2>Question & Answer</h2>
            <p>StackExchange is a Q&A website built around finding the best answers to common questions. Anyone can create an account to start asking and answering.</p>

            <div class="actions">
                <a class="button flat suggested-action" href="https://elementaryos.stackexchange.com/unanswered">Unanswered Questions</a>
                <a class="button flat" href="https://elementaryos.stackexchange.com/questions?sort=newest">New Questions</a>
            </div>
        </div>
        <div class="half">
            <h2>Documentation</h2>
            <p>elementary provides basic documentation for both users and developers. All of our documentation is written in Markdown and hosted on GitHub, so submitting a change or a new section is a piece of cake.</p>

            <div class="actions">
                <a class="button flat suggested-action" href="https://github.com/elementary/mvp/blob/master/docs/learning-the-basics.md" target="_blank">Learning The Basics Guide</a>
                <a class="button flat" href="https://github.com/elementary/mvp/blob/master/docs/code/getting-started.md" target="_blank">Developer Docs</a>
            </div>
        </div>
    </div>
</section>

<section id="web-development">
    <div class="web-browser">
        <div id="toolbar">
            <img src="images/get-involved/browser-left.svg">
            <div id="search-bar"></div>
            <img src="images/get-involved/browser-right.svg">
        </div>
        <h1>Web Development</h1>
        <p>Our website is built using HTML, CSS, PHP, and JavaScript. We're always looking for people experienced in those areas who would like to contribute and make it even better.</p>
        <div class="actions">
            <a class="button flat suggested-action" href="https://github.com/elementary/mvp" target="_blank">Fork Our Website on GitHub</a>
            <a class="button flat" href="https://github.com/elementary/mvp/issues" target="_blank">Report a Website Issue</a>
        </div>
    </div>
</section>

<section id="desktop-development">
    <div class="grid">
        <div class="two-thirds">
            <h1>Desktop Development</h1>
            <p>Our desktop environment and all its apps are built using Vala, GTK+, Granite, and a number of other open libraries. We host our desktop code on Launchpad.net, a free service for open source projects. If you've never developed for elementary OS before, we recommend you check out our Getting Started guide. <a href="/docs/code/getting-started" class="read-more">Learn More</a></p>
        </div>
        <div class="whole">
            <h2>Our Progress for The Loki Alpha 1 Milestone:</h2>
            <div class="charts">
                <div class="barchart-ctn">
                    <canvas width="750" height="400"></canvas>
                </div>
                <div class="doughnuts-ctn">
                    <div id="date"></div>
                    <div class="doughnut fixed">
                        <canvas id="fixed-chart" width="90" height="90"></canvas>
                        <div class="doughnut-label">
                            <span class="doughnut-count">0</span><br>
                            Fixed
                        </div>
                    </div>
                    <div class="doughnut in-progress">
                        <canvas id="in-progress-chart" width="90" height="90"></canvas>
                        <div class="doughnut-label">
                            <span class="doughnut-count">0</span><br>
                            In Progress
                        </div>
                    </div>
                    <div class="doughnut created">
                        <canvas id="created-chart" width="90" height="90"></canvas>
                        <div class="doughnut-label">
                            <span class="doughnut-count">0</span><br>
                            Unfixed
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="whole">
            <div class="actions">
                <a class="button flat suggested-action" href="https://code.launchpad.net/~elementary-pantheon" target="_blank">Browse Our Desktop Code</a>
                <a class="button flat" href="https://code.launchpad.net/~elementary-apps" target="_blank">Browse Our Apps' Code</a>
                <a class="button flat" href="https://bugs.launchpad.net/elementary/+bugs?field.tag=bitesize" target="_blank">Bitesized Bugs</a>
                <a class="button flat" href="https://bugs.launchpad.net/elementary/+bugs?orderby=-importance&field.status%3Alist=CONFIRMED&field.status%3Alist=TRIAGED&field.tag=bounty&field.omit_dupes=on&field.has_branches=on&field.has_no_branches=on&field.has_blueprints=on&field.has_no_blueprints=on&search=Search">Bountied Bugs</a>
            </div>
        </div>
    </div>
</section>

<section id="design">
    <div class="grid">
        <div class="two-thirds">
            <h1>Design</h1>
            <p>Every project begins with an idea. Our Design Team takes these and turns them into clear blueprints and bug reports. We break up design into two main components:</p>
        </div>
        <div class="half">
            <h2>Visual Design</h2>
            <p>A great place for visual designers to get started is by sharing mockups with <a href="https://plus.google.com/communities/104613975513761463450/stream/856346d7-1c23-4912-9549-bcfc76b32937" class="read-more">our Google+ Community</a></p>

            <div class="actions">
                <a class="button flat suggested-action" href="/docs/human-interface-guidelines" target="_blank">Read the Interface Guidelines</a>
                <a class="button flat" href="https://github.com/elementary/mockups">See Our Mockups</a>
            </div>
        </div>
        <div class="half">
            <h2>Interaction Design</h2>
            <p>We use a system on Launchpad called Blueprints to create detailed explanations of new features.</p>

            <div class="actions">
                <a class="button flat suggested-action" href="/docs/code/reference#proposing-design-changes" target="_blank">Read About Our Workflow</a>
                <a class="button flat" href="https://blueprints.launchpad.net/elementary" target="_blank">Browse Our Blueprints</a>
            </div>
        </div>
    </div>
</section>

<script src="scripts/get-involved.js"></script>
<?php
    include $template['footer'];
?>
