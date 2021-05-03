<!DOCTYPE html>
<html lang="en">
<head>
    <?php
        $meta['site_name'] = 'home';
        $meta['title'] = 'Halaman tidak ditemukan - Kompas.com' ; 
        include_once('../data/general/header_meta.php');
    ?>
    <link rel="stylesheet" href="https://asset.kompas.com/data/2017/wp/css/kcm2017-404.min.css" type="text/css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Fjalla+One">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto+Condensed:200,300,700|Roboto:100,300,300i,400,400i,500,700,700i">
    <script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o)
    ,m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-8183126-2', 'auto');
    ga('set', 'title', '<?php echo $_SERVER['HTTP_HOST']."-".$_SERVER['SERVER_ADDR'] ?>');
    ga('send', 'pageview');
    </script>
</head>
<body class="theme--news">
    <?php include_once('../data/general/header_menu.php') ?>

    <!-- container-->
    <div class="container clearfix">
        <?php echo gen_404_json(0,0); ?>
    </div>

    <!-- footer-->
    <?php include_once('../data/general/footer_menu.php') ?>
    <?php include_once('../data/general/footer_meta.php') ?>
</body>
</html>