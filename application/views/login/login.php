<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?= title; ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?= base_url(); ?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url(); ?>assets/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?= base_url(); ?>assets/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url(); ?>assets/dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/iCheck/square/blue.css">
  <link rel="stylesheet" href="<?= base_url(); ?>assets/custom_css/custom.css">


  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <style type="text/css">
    .wallpaper{
    background-image: url('<?= base_url(); ?>assets/images/index3.jpg');
    /*background-position: center;*/
    /*background-repeat: no-repeat; */
    background-size: cover;
    }
  </style>
</head>
<!-- <body class="hold-transition login-page"> -->
<body class="hold-transition wallpaper">
<div class="login-box">
  <div class="login-logo">
    <a href="javascript:void(0)"><b><?= title; ?> Admin</b></a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="text-center text-primary">Sign In</p>
    <div class="error text-center text-danger" id="errmsg">&nbsp;</div>
    <!-- <p class="login-box-msg">Sign in to start your session</p> -->

   <!--  <form action="" method="post"> -->
      <div class="form-group has-feedback">
        <input type="email" class="form-control" name="email" id="email" placeholder="Please enter your email">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" name="password" id="password" placeholder="Please enter your password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-12">
          <input type="hidden" name="site_url" id="site_url" value="<?= site_url(); ?>">
          <input type="hidden" name="loginAction" id="loginAction" value="<?= site_url(LOGINACTION); ?>">
          <input type="hidden" name="dashboard" id="dashboard" value="<?= site_url(DASHBOARD); ?>">
          <button type="button" class="btn btn-primary btn-block btn-flat" onclick="return login_validate();">Sign In</button>
        </div>
        <!-- /.col -->
      </div>
    <!-- </form> -->
    <!-- <div class="social-auth-links text-center">
      <p>- OR -</p>
      <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using
        Facebook</a>
      <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using
        Google+</a>
    </div> -->
    <!-- /.social-auth-links -->

    <!-- <a href="#">I forgot my password</a><br> -->
    <!-- <a href="register.html" class="text-center">Register a new membership</a> -->

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="<?= base_url(); ?>assets/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?= base_url(); ?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="<?= base_url(); ?>assets/plugins/iCheck/icheck.min.js"></script>
<script src="<?= base_url(); ?>assets/custom_js/login.js"></script>
<script type="text/javascript">
  var csrfName = '<?php echo $this->security->get_csrf_token_name(); ?>'
  var csrfHash = '<?php echo $this->security->get_csrf_hash(); ?>';
</script>
</body>
</html>
