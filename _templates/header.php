<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <meta name="description" content="<?php echo !empty($page['description']) ? $page['description'] : $sitewide['description']; ?>">
        <meta name="author" content="<?php echo !empty($page['author']) ? $page['author'] : $sitewide['author']; ?>">

        <meta name="twitter:card" value="summary">
        <meta name="twitter:title" value="<?php echo !empty($page['title']) ? $page['title'] : $sitewide['title']; ?>">
        <meta name="twitter:description" value="<?php echo !empty($page['description']) ? $page['description'] : $sitewide['description']; ?>">
        <meta name="twitter:site" content="@elementary">
        <meta name="twitter:creator" content="@elementary">

        <meta property="og:title" content="<?php echo !empty($page['title']) ? $page['title'] : $sitewide['title']; ?>" />
        <meta property="og:description" content="<?php echo !empty($page['description']) ? $page['description'] : $sitewide['description']; ?>" />

        <title><?php echo !empty($page['title']) ? $page['title'] : $sitewide['title']; ?></title>

        <link rel="shortcut icon" href="favicon.ico">
        <link rel="stylesheet" type="text/css" media="all" href="http://fonts.googleapis.com/css?family=Open+Sans:400,300">
        <link rel="stylesheet" type="text/css" media="all" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" media="all" href="styles/main.css">
    </head>
    <body>
        <div id="content-container">
