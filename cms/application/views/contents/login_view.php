<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Kaguyur CMS | Log in</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Tell the browser to be responsive to screen width -->
  <link rel="stylesheet" href="<?php echo config_item('assets_editor').'css/bootstrap.min.css'; ?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo config_item('assets_editor').'css/font-awesome/css/font-awesome.min.css'; ?>">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo config_item('assets_editor').'css/Ionicons/css/ionicons.min.css'; ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo config_item('assets_editor').'css/AdminLTE.min.css'; ?>">
  <link rel="stylesheet" href="<?php echo config_item('assets_editor').'plugins/sweetalert/css/sweetalert.css'; ?>">
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="http://www.visiblestory.id"><b>Kaguyur </b><br/>CMS</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>

    <form id="form_data" action="<?php echo base_url('login'); ?>" method="post">

      <div class="form-group">
        <div class="input-group">
          <div class="input-group-addon">
            <i class="fa fa-user"></i>
          </div>
          <input type="text" id="username" name="username" class="form-control" placeholder="Username">
        </div>
      </div>

      <div class="form-group">
        <div class="input-group">
          <div class="input-group-addon">
            <i class="fa fa-lock"></i>
          </div>
          <input type="password" id="password" name="password" class="form-control" placeholder="Password">
        </div>
      </div>

      <div class="row">
        <!-- /.col -->
        <div class="col-xs-4 pull-left" >
          <a class="btn btn-default btn-block btn-flat" href="http:///www.terhubungdarirumah.com"><< Back</a>
        </div>
        <div class="col-xs-4 pull-right" >
          <button type="button" class="btn btn-warning btn-block btn-flat btn_action" data-idle="Sign In" data-process="Login..." data-form="#form_data" data-redirect="<?php echo base_url(); ?>">Sign In</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="<?php echo config_item('assets_editor').'js/jquery.min.js';?>"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo config_item('assets_editor').'js/bootstrap.min.js';?>"></script>
<!-- AdminLTE App -->
<script src="<?php echo config_item('assets_editor').'js/adminlte.min.js';?>"></script>
<!-- SweetAlert -->
<script src="<?php echo config_item('assets_editor').'plugins/sweetalert/js/sweetalert.min.js';?>"></script>
<!-- custom js general -->
<?php $this->load->view('script/general') ?>
<script type="text/javascript">
  $('#password').keypress(function (e) {
   var key = e.which;
   if(key == 13)
    {
      $('.btn_action').click();
      return false;
    }
  });
</script>
</body>
</html>
