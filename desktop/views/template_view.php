<!DOCTYPE html>
<html class="no-js" lang="">
  <head>
    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-T3JZFTZ');</script>
    <!-- End Google Tag Manager -->
    <meta charset="utf-8" />
    <title><?php echo isset($meta['title']) ? $meta['title'] : 'Komunitas Guppy Cianjur (KAGUYUR) Offical Website'; ?></title>
    <meta name="description" content="<?php echo isset($meta['description']) ? $meta['description'] : 'Wadah untuk membangun kekompakan dan kebersamaan serta berbagi ilmu pengetahuan seputar ikan guppy'; ?>" />
    <meta name="keywords" content="<?php echo isset($meta['keywords']) ? $meta['keywords'] : 'budidaya, ikan guppy, komunitas, hobby, black moscow, afr, prtde, lace, mozaik, jual guppy, sharing, guppy kualitas, finroot, white spot, sisik nanas, sipon, amoniak, obat biru, ketapang, aquarium,ember, bak kulkas'; ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <meta property="og:title" content="<?php echo isset($meta['title']) ? $meta['title'] : 'Komunitas Guppy Cianjur (KAGUYUR) Offical Website'; ?>" />
    <meta property="og:type" content="<?php echo isset($meta['type']) ? $meta['type'] : ''; ?>" />
    <meta property="og:url" content="<?php echo isset($meta['url']) ? $meta['url'] : current_url(); ?>" />
    <meta property="og:image" content="<?php echo isset($meta['image'])?$meta['image']:config_item('assets').'images/logo.jpg'; ?>" />
    <meta property="og:site_name" content="-" />
    <meta property="og:description" content="<?php echo isset($meta['description'])?$meta['description']:'Wadah untuk membangun kekompakan dan kebersamaan serta berbagi ilmu pengetahuan seputar ikan guppy' ?>" />

    <!-- S:tweeter card -->
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:site" content="@kaguyur" />
    <meta name="twitter:creator" content="@kaguyur">
    <meta name="twitter:title" content="<?php echo isset($meta['title'])?$meta['title']:'Komunitas Guppy Cianjur (KAGUYUR) Offical Website' ?>" />
    <meta name="twitter:description" content="<?php echo isset($meta['description'])?$meta['description']:'Wadah untuk membangun kekompakan dan kebersamaan serta berbagi ilmu pengetahuan seputar ikan guppy' ?>" />
    <meta name="twitter:image" content="<?php echo isset($meta['image'])?$meta['image']:config_item('assets').'images/logo2.jpg'; ?>" />
    <!-- E:tweeter card -->

    <link rel="canonical" href="<?php echo isset($meta['canonical'])?$meta['canonical']:current_url(); ?>" />
    <link rel="apple-touch-icon" href="<?php echo config_item('assets'); ?>images/favicon.ico"/>
    <link rel="shortcut icon" href="<?php echo config_item('assets'); ?>images/favicon.ico"/>

    <!-- css -->
    <link rel="stylesheet" href="<?php echo config_item('assets'); ?>css/tailwind.css?v=8" />
    <link rel="stylesheet" href="<?php echo config_item('assets'); ?>css/styles.css?v=17" />
    <link rel="stylesheet" href="<?php echo config_item('assets').'plugins/sweetalert/css/sweetalert.css'; ?>">

    <!-- font -->
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@400;500;600;900&display=swap" rel="stylesheet"/>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">

  </head>

  <body>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-T3JZFTZ"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    <?php $s1 = $this->uri->segment(1); ?>
    <div class="header">
      <div class="container px-5 mx-auto">
        <div class="grid grid-cols-6 relative">
          <div class="header__mobile lg:hidden mt-5">
            <img src="<?php echo config_item('assets'); ?>images/menuwhite.svg" alt="" />
          </div>
          <a class="col-span-1" href="<?php echo base_url(); ?>">
            <img src="<?php echo config_item('assets'); ?>images/logo.jpg" alt="" style="width:50px"/>
          </a>
          <div class="header__menu__general header__menu hidden lg:flex col-span-4 justify-end items-center">
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
                <a class="<?php echo $s1=='forum'?'active':''; ?> uppercase py-5 pl-5 font-semibold text-sm" href="<?php echo base_url('forum'); ?>"> FORUM </a>
              </li>
              <li>
                <a class="<?php echo $s1=='galeri'?'active':''; ?> uppercase py-5 pl-5 font-semibold text-sm" href="<?php echo base_url('galeri'); ?>"> GALERI </a>
              </li>
              <li>
                <a class="<?php echo $s1=='produk'?'active':''; ?> uppercase py-5 pl-5 font-semibold text-sm" href="<?php echo base_url('produk'); ?>"> PRODUK </a>
              </li>
            </ul>
          </div>
          <div class="flex col-span-4 lg:col-span-1 justify-end items-center">
            <div class="header__user__wrap">
              <?php if(!empty($this->user_login['name'])){ ?>
                  <a class="header__user uppercase py-5 pl-5 font-semibold text-sm" href="javascript:void(0)"> 
                    <img style="margin-top:-5px" width="30px" class="inline" src="<?php echo gen_thumb($this->user_login['logo'],'100x100') ?>" alt="">
                    <!-- <span><?php echo $this->user_login['name'] ?></span> -->
                    <?php $check_notif = check_notif(); ?>
                    <?php if($check_notif):?>
                    <span style="top:10px;left:40px" class="jerawat"></span>
                    <?php endif ?>
                  </a>
              <?php }else{ ?>  
                  <a class="uppercase py-5 pl-5 font-semibold text-sm" href="javascript:void(0)" data-micromodal-trigger="modal-login"> 
                    LOGIN
                  </a>
              <?php } ?>
            </div>
          </div>
          <div class="header__menu__user header__menu hidden lg:hidden lg:flex col-span-5 justify-end items-center">
            <ul>
              <li>
                <a class="uppercase py-5 pl-5 font-semibold text-sm" href="<?php echo base_url('profile'); ?>"> PROFIL </a>
              </li>
              <?php if(check_login(true)): ?>
              <li>
                <a class="uppercase py-5 pl-5 font-semibold text-sm" href="<?php echo base_url().'login/reset_password/'.$this->user_login['id'].'/'.md5($this->user_login['id'].'hs^35shKjsdh()'); ?>"> GANTI PASSWORD </a>
              </li>
              <?php endif ?>
              <li style="position: relative;">
                <a class="uppercase py-5 pl-5 font-semibold text-sm" href="<?php echo base_url('notifikasi'); ?>"> NOTIFIKASI </a>
                <?php if($check_notif):?>
                  <span style="top:10px;left:100px" class="jerawat"></span>
                <?php endif ?>
              </li>
              <li>
                <a class="uppercase py-5 pl-5 font-semibold text-sm" href="<?php echo base_url('login/logout'); ?>"> LOGOUT </a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>

    <?php echo $content; ?>

    <div class="footer bg-black text-white">
      <div class="container px-5 mx-auto py-10">
        <div class="grid grid-cols-6">
          <div class="col-span-6 md:col-span-3 flex justify-center md:justify-start md:mb-0">
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
    
    <?php echo isset($modals)?$modals:''; ?>
    <?php $this->load->view('content/login_modal_view') ?>

    <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
    <?php $this->load->view('script/general') ?>
    <script>
      var base_url = '<?php echo base_url() ?>';
    </script>
    <?php echo isset($script)?$script:''; ?>
    <script src="<?php echo config_item('assets').'plugins/sweetalert/js/sweetalert.min.js'; ?>"></script>
    <script type="text/javascript" src="https://unpkg.com/micromodal/dist/micromodal.min.js"></script>
    <script type="text/javascript" src="<?php echo config_item('assets'); ?>js/main.js?v=7"></script>
    <script type="text/javascript">
      function fb_share(e,o){return u=o,t=e,window.open("http://www.facebook.com/sharer.php?u="+encodeURIComponent(u)+"&t="+encodeURIComponent(t),"sharer","toolbar=0,status=0,width=626,height=436"),!1}function tweet_share(t){return u=t,window.open("https://twitter.com/intent/tweet?text="+encodeURIComponent(u),"sharer","toolbar=0,status=0,width=626,height=436"),!1}
    </script>
  </body>
</html>