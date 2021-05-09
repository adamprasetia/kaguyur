<!DOCTYPE html>
<html>
<head>
  <!-- Global site tag (gtag.js) - Google Analytics -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-196226270-1"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-196226270-1');
  </script>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name='robots' content='noindex,follow' />
  <title>Kaguyur CMS</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="<?php echo config_item('assets_editor').'css/bootstrap.min.css'; ?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo config_item('assets_editor').'css/font-awesome/css/font-awesome.min.css'; ?>">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo config_item('assets_editor').'css/Ionicons/css/ionicons.min.css'; ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo config_item('assets_editor').'css/select2.min.css'?>">
  <link rel="stylesheet" href="<?php echo config_item('assets_editor').'css/AdminLTE.min.css'; ?>">
  <link rel="stylesheet" href="<?php echo config_item('assets_editor').'css/skins/skin-yellow.min.css'; ?>">

  <link rel="stylesheet" href="<?php echo config_item('assets_editor').'plugins/sweetalert/css/sweetalert.css'; ?>">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="<?php echo config_item('assets_editor').'css/jquery-ui-timepicker-addon.min.css'?>">

  <?php echo isset($css)?$css:'' ?>

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <!-- jQuery 3 -->
  <script src="<?php echo config_item('assets_editor').'js/jquery.min.js';?>"></script>
</head>
  <body class="skin-yellow fixed sidebar-mini">
    <div class="wrapper">

      <!-- Main Header -->
      <header class="main-header">

        <!-- Logo -->
        <a href="<?php echo base_url(); ?>" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>KAGUYUR</b>CMS</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>KAGUYUR</b>CMS</span>
        </a>

        <!-- Header Navbar -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- User Account Menu -->
              <li class="dropdown user user-menu">
                <!-- Menu Toggle Button -->
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <!-- The user image in the navbar-->
                  <!-- hidden-xs hides the username on small devices so only the image appears. -->
                  <img src="<?php echo gen_thumb($this->session->userdata('user_login')['logo'],'100x100') ?>" class="user-image" alt="User Image">
                  <span><?php echo $this->session->userdata('user_login')['name'] ?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- The user image in the menu -->
                  <li class="user-header">
                    <img src="<?php echo gen_thumb($this->session->userdata('user_login')['logo'],'300x300') ?>" class="img-circle" alt="User Image">
                    <p>
                      <?php echo $this->session->userdata('user_login')['name'] ?>
                    </p>
                  </li>
                  <!-- Menu Body -->
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="<?php echo base_url('login/change_password'); ?>" class="btn btn-default btn-flat">Change Password</a>
                    </div>
                    <div class="pull-right">
                      <a href="<?php echo base_url('login/logout'); ?>" class="btn btn-default btn-flat">Sign out</a>
                    </div>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">

        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">

          <!-- Sidebar Menu -->
          <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MENU</li>
            <!-- Optionally, you can add icons to the links -->
            <li class="<?php echo ($this->uri->segment(1)=='' || $this->uri->segment(1)=='dashboard'?'active':''); ?>"><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> <span>Beranda</span></a></li>
            <?php if(in_array(1, $_SESSION['user_login']['module']) || in_array(2, $_SESSION['user_login']['module'])): ?>
            <li class="<?php echo ($this->uri->segment(1)=='member'?'active':''); ?>"><a href="<?php echo base_url('member'); ?>"><i class="fa fa-user"></i> <span>Anggota</span></a></li>
            <?php endif ?>
            <?php if(in_array(1, $_SESSION['user_login']['module']) || in_array(4, $_SESSION['user_login']['module'])): ?>
            <li class="<?php echo ($this->uri->segment(1)=='article'?'active':''); ?>"><a href="<?php echo base_url('article'); ?>"><i class="fa fa-newspaper-o"></i> <span>Artikel</span></a></li>
            <?php endif ?>
            <?php if(in_array(1, $_SESSION['user_login']['module']) || in_array(5, $_SESSION['user_login']['module'])): ?>
            <li class="<?php echo ($this->uri->segment(1)=='gallery'?'active':''); ?>"><a href="<?php echo base_url('gallery'); ?>"><i class="fa fa-image"></i> <span>Gallery</span></a></li>
            <?php endif ?>
            <?php if(in_array(1, $_SESSION['user_login']['module']) || in_array(6, $_SESSION['user_login']['module'])): ?>
            <li class="<?php echo ($this->uri->segment(1)=='product'?'active':''); ?>"><a href="<?php echo base_url('product'); ?>"><i class="fa fa-product-hunt"></i> <span>Produk</span></a></li>
            <?php endif ?>
            <li class="<?php echo ($this->uri->segment(1)=='photo'?'active':''); ?>"><a href="<?php echo base_url('photo'); ?>"><i class="fa fa-image"></i> <span>Photo</span></a></li>
            <li class="<?php echo ($this->uri->segment(1)=='video'?'active':''); ?>"><a href="<?php echo base_url('video'); ?>"><i class="fa fa-video-camera"></i> <span>Video</span></a></li>
            <?php if(in_array(1, $_SESSION['user_login']['module'])): ?>
            <li class="header">ADMIN</li>
            <li class="<?php echo ($this->uri->segment(1)=='privilege'?'active':''); ?>"><a href="<?php echo base_url('privilege'); ?>"><i class="fa fa-cog"></i> <span>Privilege</span></a></li>
            <li class="<?php echo ($this->uri->segment(1)=='module'?'active':''); ?>"><a href="<?php echo base_url('module'); ?>"><i class="fa fa-cog"></i> <span>Module</span></a></li>
            <?php endif ?>
          </ul>
          <!-- /.sidebar-menu -->
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper" style="min-height: 449px;">
        <!-- Main content -->
        <section class="content container-fluid">
          <?php echo isset($content)?$content:''; ?>
        </section>
      </div>
      <!-- /.content-wrapper -->

      <!-- Main Footer -->
      <footer class="main-footer">
        <!-- To the right -->
        <div class="pull-right hidden-xs">
          #Kaguyur
        </div>
        <!-- Default to the left -->
        <strong>Copyright &copy; <?php echo date('Y'); ?> <a href="http://www.kaguyur.com">Kaguyur</a>. </strong> All rights reserved.
      </footer>

      <!-- Modal -->
      <div class="modal fade" id="general-modal">
          <div class="modal-dialog modal-lg">
              <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span></button>
                      <h4 id="general-modal-title" class="modal-title">Default Modal</h4>
                  </div>
                  <div class="modal-body">
                      <iframe id="general-modal-iframe" frameBorder="0" width="100%" height="480px"></iframe>
                  </div>
              </div>
          </div>
      </div>

    </div>
    <!-- ./wrapper -->

  <script type="text/javascript">
   var base_url = "<?php echo base_url(); ?>";
   var base_domain = "<?php echo config_item('base_domain') ?>";
  </script>
  <script src="<?php echo config_item('assets_editor').'js/jquery.slimscroll.min.js';?>"></script>
  <script type="text/javascript" src="<?php echo config_item('assets_editor'); ?>js/jquery-ui.min.js"></script>
  <script type="text/javascript" src="<?php echo config_item('assets_editor'); ?>js/jquery-ui-timepicker-addon.min.js"></script>
  <!-- Bootstrap 3.3.7 -->
  <script src="<?php echo config_item('assets_editor').'js/bootstrap.min.js';?>"></script>
  <!-- AdminLTE App -->
  <script src="<?php echo config_item('assets_editor').'js/adminlte.min.js';?>"></script>
  <!-- SweetAlert -->
  <script src="<?php echo config_item('assets_editor').'plugins/sweetalert/js/sweetalert.min.js';?>"></script>

  <script src="<?php echo config_item('assets_editor').'js/select2.min.js';?>"></script>
  <!-- custom js general -->
  <?php $this->load->view('script/general') ?>
  <?php echo isset($script)?$script:'' ?>
  </body>
</html>
