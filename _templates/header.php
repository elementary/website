<!doctype html>
<html>
    <head>

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=0">

        <meta name="description" content="<?php echo !empty($page['description']) ? $page['description'] : $sitewide['description']; ?>">
        <meta name="author" content="<?php echo !empty($page['author']) ? $page['author'] : $sitewide['author']; ?>">
        <meta name="theme-color" content="<?php echo !empty($page['theme-color']) ? $page['theme-color'] : $sitewide['theme-color']; ?>">

        <meta name="twitter:card" value="summary">
        <meta name="twitter:title" value="<?php echo !empty($page['title']) ? $page['title'] : $sitewide['title']; ?>">
        <meta name="twitter:description" value="<?php echo !empty($page['description']) ? $page['description'] : $sitewide['description']; ?>">
        <meta name="twitter:site" content="@elementary">
        <meta name="twitter:creator" content="@elementary">

        <meta property="og:title" content="<?php echo !empty($page['title']) ? $page['title'] : $sitewide['title']; ?>" />
        <meta property="og:description" content="<?php echo !empty($page['description']) ? $page['description'] : $sitewide['description']; ?>" />

        <meta name="apple-mobile-web-app-title" content="elementary">
        <link rel="manifest" href="/manifest.json">

        <title><?php echo !empty($page['title']) ? $page['title'] : $sitewide['title']; ?></title>

        <link rel="shortcut icon" href="favicon.ico">
        <link rel="apple-touch-icon" href="images/launcher-icons/apple-touch-icon.png">
        <link rel="stylesheet" type="text/css" media="all" href="http://fonts.googleapis.com/css?family=Open+Sans:400,600,300">
        <link rel="stylesheet" type="text/css" media="all" href="http://fonts.googleapis.com/css?family=Raleway:100">
        <link rel="stylesheet" type="text/css" media="all" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" media="all" href="styles/main.css">

        <script>
            <?php include './scripts/jql.min.js'; ?>
            jQl.loadjQ('//cdn.jsdelivr.net/g/jquery');
            <?php include './scripts/smooth-scrolling.js'; ?>
        </script>

        <?php echo !empty($page['scripts']) ? $page['scripts'] : false; ?>

        <?php if ( $trackme ) { ?>
        <script>
            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
            ga('create', 'UA-19280770-1', 'auto');
            ga('set', 'forceSSL', true);
            ga('set', 'anonymizeIp', true);
            ga('require', 'displayfeatures');
            ga('send', 'pageview');
        </script>
        <?php } ?>

    </head>
    <body class="page-<?php echo basename($_SERVER['PHP_SELF'], ".php"); ?>">
        <nav>
            <ul class="left">
                <li><a href="/"><span class="logomark"></span></a></li>
                <li><a href="http://blog.elementaryos.org" target="_blank">Blog</a></li>
                <li><a href="http://elementaryos.org/support" target="_blank">Support</a></li>
                <li><a href="/store">Store</a></li>
            </ul>
            <ul class="right">
                <li><a href="/developer">Developer</a></li>
                <li><a href="/get-involved">Get Involved</a></li>
            </ul>
        </nav>

        <div id="content-container">