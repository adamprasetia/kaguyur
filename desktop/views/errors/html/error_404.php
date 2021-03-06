<?php $ci =& get_instance() ?>
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
    <title><?php echo isset($meta['title']) ? $meta['title'] : 'Kaguyur'; ?></title>
    <meta name="description" content="<?php echo isset($meta['description']) ? $meta['description'] : 'Komunitas Guppy Cianjur'; ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <meta property="og:title" content="<?php echo isset($meta['title']) ? $meta['title'] : 'Kaguyur'; ?>" />
    <meta property="og:type" content="<?php echo isset($meta['type']) ? $meta['type'] : ''; ?>" />
    <meta property="og:url" content="<?php echo isset($meta['url']) ? $meta['url'] : current_url(); ?>" />
    <meta property="og:image" content="<?php echo config_item('assets'); ?>images/logo.jpg" />
    <meta property="og:site_name" content="-" />
    <meta property="og:description" content="<?php echo isset($meta['description'])?$meta['description']:'Komunitas Guppy Cianjur' ?>" />

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
    <link rel="stylesheet" href="<?php echo config_item('assets'); ?>css/styles.css?v=2" />
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
    <div class="header">
      <div class="container px-5 mx-auto">
        <div class="grid grid-cols-6 relative">
          <a class="col-span-2 md:col-span-1" href="<?php echo base_url(); ?>">
            <img src="<?php echo config_item('assets'); ?>images/logo.jpg" alt="" style="width:50px"/>
          </a>
          <div class="flex lg:hidden col-span-4 md:col-span-5 justify-end items-center">
            <div class="header__mobile">
              <img src="<?php echo config_item('assets'); ?>images/menuwhite.svg" alt="" />
            </div>
          </div>
          <div class="header__menu hidden lg:flex col-span-5 justify-end items-center">
            <?php $s1 = $ci->uri->segment(1); ?>
            <ul>
              <li>
                <a class="<?php echo $s1==''?'active':''; ?> uppercase py-5 pl-5 font-semibold text-sm" href="<?php echo base_url(); ?>"> BERANDA </a>
              </li>
              <li>
                <a class="<?php echo $s1=='tentang'?'active':''; ?> uppercase py-5 pl-5 font-semibold text-sm" href="<?php echo base_url('tentang'); ?>"> TENTANG </a>
              </li>
              <li>
                <a class="<?php echo $s1=='anggota'?'active':''; ?> uppercase py-5 pl-5 font-semibold text-sm" href="<?php echo base_url('anggota'); ?>"> ANGGOTA </a>
              </li>
              <li>
                <a class="<?php echo $s1=='artikel'?'active':''; ?> uppercase py-5 pl-5 font-semibold text-sm" href="<?php echo base_url('artikel'); ?>"> ARTIKEL </a>
              </li>
              <li>
                <a class="<?php echo $s1=='galeri'?'active':''; ?> uppercase py-5 pl-5 font-semibold text-sm" href="<?php echo base_url('galeri'); ?>"> GALERI </a>
              </li>
              <li>
                <a class="<?php echo $s1=='produk'?'active':''; ?> uppercase py-5 pl-5 font-semibold text-sm" href="<?php echo base_url('produk'); ?>"> PRODUK </a>
              </li>
              <?php if(!empty($this->user_login['name'])){ ?>
                <li>
                  <a class="<?php echo $s1=='profile'?'active':''; ?> uppercase py-5 pl-5 font-semibold text-sm" href="<?php echo base_url('profile') ?>"> 
                  <?php echo $this->user_login['name'] ?>
                  </a>
                </li>
              <?php }else{ ?>  
                <li>
                  <a class="uppercase py-5 pl-5 font-semibold text-sm" href="<?php echo base_url('login') ?>"> 
                    MASUK
                  </a>
                </li>
              <?php } ?>
            </ul>
          </div>
        </div>
      </div>
    </div>

    <div class="section py-20 bg-cover bg-no-repeat mt-10">
    <!-- section -->
    <div class="container px-5 mx-auto">
    <h1>404</h1>
    <h1>Halaman tidak ditemukan</h1>
    </div>
    </div>

    <div class="footer bg-black text-white">
      <div class="container px-5 mx-auto py-10">
        <div class="grid grid-cols-6">
          <div class="col-span-6 md:col-span-3 flex items-end justify-center md:justify-start md:mb-0">
            <div class="w-32">
              <img src="<?php echo config_item('assets'); ?>images/logo.jpg" alt="" />
            </div>
          </div>  
          <?php 
          $members = @json_decode(file_get_contents('./assets/json/member.json'));
          $members = gen_random($members);
          if(!empty($members)){ ?>
          <div class="col-span-6 md:col-span-3">
            <p class="text-center md:text-left px-3">
              Website ini hasil kerja sama dari
            </p>
            <ul class="flex flex-wrap content-start">
              <?php foreach ($members as $row) { ?>
              <li>
                <a href="<?php echo base_url('profile/'.$row->id.'/'.url_title($row->farm,'-',true)) ?>">
                  <img src="<?php echo gen_thumb($row->logo,'100x100'); ?>" alt="<?php echo htmlentities($row->farm) ?>" title="<?php echo htmlentities($row->farm) ?>" />
                </a>
              </li>
              <?php } ?>
            </ul>
          </div>
          <?php } ?>
        </div>
      </div>
    </div>
    <div id="overlay"></div>
    
    <script type="text/javascript" src="<?php echo config_item('assets'); ?>js/main.js?v=4"></script>
  </body>
</html>