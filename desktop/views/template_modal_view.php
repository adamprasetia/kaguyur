<!DOCTYPE html>
<html class="no-js" lang="">
  <head>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-196226270-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-196226270-1');
    </script>

    <meta charset="utf-8" />
    <title><?php echo isset($meta['title']) ? $meta['title'] : 'Kaguyur Offical Website'; ?></title>
    <meta name="description" content="<?php echo isset($meta['description']) ? $meta['description'] : 'Fancy Guppy Cianjur'; ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <meta property="og:title" content="<?php echo isset($meta['title']) ? $meta['title'] : 'Kaguyur Offical Website'; ?>" />
    <meta property="og:type" content="<?php echo isset($meta['type']) ? $meta['type'] : ''; ?>" />
    <meta property="og:url" content="<?php echo isset($meta['url']) ? $meta['url'] : current_url(); ?>" />
    <meta property="og:image" content="<?php echo config_item('assets'); ?>images/logo.jpg" />
    <meta property="og:site_name" content="-" />
    <meta property="og:description" content="<?php echo isset($meta['description'])?$meta['description']:'Fancy Guppy Cianjur' ?>" />

    <!-- S:tweeter card -->
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:site" content="@kaguyur" />
    <meta name="twitter:creator" content="@kaguyur">
    <meta name="twitter:title" content="<?php echo isset($meta['title'])?$meta['title']:'Kaguyur' ?>" />
    <meta name="twitter:description" content="<?php echo isset($meta['description'])?$meta['description']:'Komunitas Guppy Cianjur' ?>" />
    <meta name="twitter:image" content="<?php echo config_item('assets'); ?>images/logo2.jpg" />
    <!-- E:tweeter card -->

    <link rel="apple-touch-icon" href="<?php echo config_item('assets'); ?>images/favicon.ico"/>
    <link rel="shortcut icon" href="<?php echo config_item('assets'); ?>images/favicon.ico"/>

    <!-- css -->
    <link rel="stylesheet" href="<?php echo config_item('assets'); ?>css/tailwind.css?v=2" />
    <link rel="stylesheet" href="<?php echo config_item('assets'); ?>css/styles.css?v=5" />
    <link rel="stylesheet" href="<?php echo config_item('assets').'plugins/sweetalert/css/sweetalert.css'; ?>">

    <!-- font -->
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@400;500;600;900&display=swap" rel="stylesheet"/>
    <style>
    .header, .header.scroller {
      color:white;
      background:black;
    }
    @media (max-width: 768px){
      .header, .header.scroller {
      color:black;
      }
    }
    </style>
  </head>

  <body>
    <?php echo $content; ?>

    <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
    <?php $this->load->view('script/general') ?>
    <script>
      var base_url = '<?php echo base_url() ?>';
    </script>
    <?php echo isset($script)?$script:''; ?>
    <script src="<?php echo config_item('assets').'plugins/sweetalert/js/sweetalert.min.js'; ?>"></script>
    <script type="text/javascript" src="https://unpkg.com/micromodal/dist/micromodal.min.js"></script>
    <script type="text/javascript" src="<?php echo config_item('assets'); ?>js/main.js?v=5"></script>
    <script type="text/javascript">
      function fb_share(e,o){return u=o,t=e,window.open("http://www.facebook.com/sharer.php?u="+encodeURIComponent(u)+"&t="+encodeURIComponent(t),"sharer","toolbar=0,status=0,width=626,height=436"),!1}function tweet_share(t){return u=t,window.open("https://twitter.com/intent/tweet?text="+encodeURIComponent(u),"sharer","toolbar=0,status=0,width=626,height=436"),!1}
    </script>
  </body>
</html>