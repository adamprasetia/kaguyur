<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Dashboard - Kompas Gramedia CMS</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="<?php echo config_item('assets_editor').'css/bootstrap.min.css'; ?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo config_item('assets_editor').'css/font-awesome/css/font-awesome.min.css'; ?>">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo config_item('assets_editor').'css/Ionicons/css/ionicons.min.css'; ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo config_item('assets_editor').'css/AdminLTE.min.css'; ?>">
  <link rel="stylesheet" href="<?php echo config_item('assets_editor').'css/skins/skin-blue.min.css'; ?>">
  <link rel="stylesheet" href="<?php echo config_item('assets_editor').'plugins/sweetalert/css/sweetalert.css'; ?>">
  <?php echo isset($css)?$css:'' ?>
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <!-- jQuery 3 -->
  <script src="<?php echo config_item('assets_editor').'js/jquery.min.js';?>"></script>
</head>
  <body class="hold-transition skin-blue sidebar-mini">
  <?php echo isset($content)?$content:'' ?>
  <!-- Bootstrap 3.3.7 -->
  <script src="<?php echo config_item('assets_editor').'js/bootstrap.min.js';?>"></script>
  <!-- AdminLTE App -->
  <script src="<?php echo config_item('assets_editor').'js/adminlte.min.js';?>"></script>
  <!-- SweetAlert -->
  <script src="<?php echo config_item('assets_editor').'plugins/sweetalert/js/sweetalert.min.js';?>"></script>
  <?php echo isset($script)?$script:'' ?>
  </body>
</html>