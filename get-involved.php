<?php
    include '_templates/sitewide.php';
    $page['title'] = 'Get Involved';
    $page['scripts'] = '<link rel="stylesheet" type="text/css" media="all" href="http://fonts.googleapis.com/css?family=Satisfy">';
    $page['scripts'] .= '<link rel="stylesheet" type="text/css" media="all" href="styles/get-involved.css">';
    include '_templates/header.php';
?>
            <script>
                var jQl={q:[],dq:[],gs:[],ready:function(a){'function'==typeof a&&jQl.q.push(a);return jQl},getScript:function(a,c){jQl.gs.push([a,c])},unq:function(){for(var a=0;a<jQl.q.length;a++)jQl.q[a]();jQl.q=[]},ungs:function(){for(var a=0;a<jQl.gs.length;a++)jQuery.getScript(jQl.gs[a][0],jQl.gs[a][1]);jQl.gs=[]},bId:null,boot:function(a){'undefined'==typeof window.jQuery.fn?jQl.bId||(jQl.bId=setInterval(function(){jQl.boot(a)},25)):(jQl.bId&&clearInterval(jQl.bId),jQl.bId=0,jQl.unqjQdep(),jQl.ungs(),jQuery(jQl.unq()), 'function'==typeof a&&a())},booted:function(){return 0===jQl.bId},loadjQ:function(a,c){setTimeout(function(){var b=document.createElement('script');b.src=a;document.getElementsByTagName('head')[0].appendChild(b)},1);jQl.boot(c)},loadjQdep:function(a){jQl.loadxhr(a,jQl.qdep)},qdep:function(a){a&&('undefined'!==typeof window.jQuery.fn&&!jQl.dq.length?jQl.rs(a):jQl.dq.push(a))},unqjQdep:function(){if('undefined'==typeof window.jQuery.fn)setTimeout(jQl.unqjQdep,50);else{for(var a=0;a<jQl.dq.length;a++)jQl.rs(jQl.dq[a]); jQl.dq=[]}},rs:function(a){var c=document.createElement('script');document.getElementsByTagName('head')[0].appendChild(c);c.text=a},loadxhr:function(a,c){var b;b=jQl.getxo();b.onreadystatechange=function(){4!=b.readyState||200!=b.status||c(b.responseText,a)};try{b.open('GET',a,!0),b.send('')}catch(d){}},getxo:function(){var a=!1;try{a=new XMLHttpRequest}catch(c){for(var b=['MSXML2.XMLHTTP.5.0','MSXML2.XMLHTTP.4.0','MSXML2.XMLHTTP.3.0','MSXML2.XMLHTTP','Microsoft.XMLHTTP'],d=0;d<b.length;++d){try{a= new ActiveXObject(b[d])}catch(e){continue}break}}finally{return a}}};if('undefined'==typeof window.jQuery){var $=jQl.ready,jQuery=$;$.getScript=jQl.getScript};
                jQl.loadjQ('//cdn.jsdelivr.net/g/jquery');
                jQl.loadjQdep('scripts/get-involved.js');
            </script>

            <section class="row hero">
                <!-- Not ready yet -->
                <!-- <h1>Get Involved</h1> -->
                <!-- <h2>Check out our progress for Freya Beta 2</h2> -->

                <!-- <img src="images/get-involved/stats.svg" alt="Chart"> -->

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
                        <h1><a class="inline-tweet" href="http://twitter.com/home/?status=&ldquo;A different language is a different vision of life.&rdquo; —Federico Fellini elementaryos.org/get-involved" target="_blank">&ldquo;A different language is a different vision of life.&rdquo;</a></h1>
                        <p class="small-label">Federico Fellini</p>
                    </div>
                </div>

                <div class="row">
                    <div class="column">
                        <h2>Translations</h2>
                        <p>elementary OS is created and used by people from all around the World; help us make the experience even better by translating it into more languages. Launchpad has a built-in tool called Rosetta that enables collaborative translations online.</p>

                        <div class="actions">
                            <a class="button flat suggested-action" href="https://translations.launchpad.net/elementary" target="_blank">View Our Translations Page</a>
                            <a class="button flat" href="https://help.launchpad.net/Translations" target="_blank">Get More Info About Rosetta</a>
                        </div>
                    </div>
                    <div class="column">
                        <img src="images/get-involved/translations.svg" alt="World map">
                    </div>
                </div>
            </section>

            <section id="web-development" class="dark">
                <div class="heading">
                    <div class="row">
                        <h1><a class="inline-tweet" href="http://twitter.com/home/?status=&ldquo;Websites should look good from the inside and out&rdquo; —Paul Cookson elementaryos.org/get-involved" target="_blank">&ldquo;Websites should look good from the inside and out&rdquo;</a></h1>
                        <p class="small-label">Paul Cookson</p>
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
                        <h1><a class="inline-tweet" href="http://twitter.com/home/?status=&ldquo;Great design is making something memorable and meaningful.&rdquo; —Dieter Rams elementaryos.org/get-involved" target="_blank">&ldquo;Great design is making something memorable and meaningful.&rdquo;</a></h1>
                        <p class="small-label">Dieter Rams</p>
                    </div>
                </div>

                <div class="row">
                    <div class="column">
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
                            <a class="button flat suggested-action" href="http://elementaryos.org/docs/human-interface-guidelines" target="_blank">Read the Interface Guidelines</a>
                            <a class="button flat" href="https://blueprints.launchpad.net/elementary" target="_blank">Browse Our Blueprints</a>
                            <a class="button flat" href="http://blog.elementaryos.org/post/107662321291/so-you-fancy-yourself-a-designer" target="_blank">Read About Our Workflow</a>
                        </div>
                    </div>
                    <div class="column">
                        <img src="images/get-involved/design.svg" alt="Application wire frame">
                    </div>
                </div>
            </section>

            <section id="desktop-development" class="dark">
                <div class="heading">
                    <div class="row">
                        <h1><a class="inline-tweet" href="http://twitter.com/home/?status=&ldquo;Before software can be reusable it first has to be usable&rdquo; —Ralph Johnson elementaryos.org/get-involved" target="_blank">&ldquo;Before software can be reusable it first has to be usable&rdquo;</a></h1>
                        <p class="small-label">Ralph Johnson</p>
                    </div>
                </div>

                <div class="row">
                    <div class="column">
                        <h2>Desktop Development</h2>
                        <p>Our desktop environment and all its apps are built using Vala, GTK+, Clutter, Cairo, Granite and a number of other free libraries. All of our code is hosted on Launchpad.net, a free service for open source projects. We're always looking for contributors of all skill levels.</p>

                        <div class="actions">
                            <a class="button flat suggested-action" href="https://code.launchpad.net/~elementary-pantheon" target="_blank">Browse Our Desktop Code</a>
                            <a class="button flat" href="https://code.launchpad.net/~elementary-apps" target="_blank">Browse Our Apps' Code</a>
                            <a class="button flat" href="https://bugs.launchpad.net/elementary" target="_blank">See Our Open Bug Reports</a>
                        </div>
                    </div>
                    <div class="column">
                        <img src="images/get-involved/desktop-development.svg" alt="Scratch text editor">
                    </div>
                </div>
            </section>
<?php
    include '_templates/footer.html';
?>
