<?php
ini_set('memory_limit', '-1');

$session = $this->session->userdata(SESSION_NAME);

if (empty($session)) {
	redirect(LOGIN);
}

$getProfile = $this->Crud_model->GetData("admin_login", 'image', 'id="' . $_SESSION[SESSION_NAME]['id'] . '"', '', '', '', '1');

//$withraw_list=$this->Crud_model->multijoin('user_details u',"u.user_name,u.id","rr.betAmount!='0' ",'u.id','created','',array('user_account rr'),array('rr.userId=u.id'),array('left'));
?>
<!DOCTYPE html>
<html>
<head>

 </style>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?=title;?> | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?=base_url();?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?=base_url();?>assets/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?=base_url();?>assets/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="<?=base_url();?>assets/bower_components/select2/dist/css/select2.min.css">
  <!-- /.Select2 -->
  <!-- Theme style -->
  <link rel="stylesheet" href="<?=base_url();?>assets/dist/css/AdminLTE.min.css">
  <!-- Custom CSS -->
  <link rel="stylesheet" href="<?=base_url();?>assets/custom_css/custom.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?=base_url();?>assets/dist/css/skins/_all-skins.min.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="<?=base_url();?>assets/bower_components/morris.js/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="<?=base_url();?>assets/bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="<?=base_url();?>assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- Bootstrap time Picker -->
  <!-- <link rel="stylesheet" href="<?=base_url();?>assets/plugins/timepicker/bootstrap-timepicker.min.css"> -->
  <link href="https://cdn.jsdelivr.net/bootstrap.timepicker/0.2.6/css/bootstrap-timepicker.min.css" rel="stylesheet" />
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?=base_url();?>assets/bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="<?=base_url();?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

  <!-- DataTables -->
   <link rel="stylesheet" href="<?=base_url();?>assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">

  <!-- toastr css -->
  <link rel="stylesheet" href="<?=base_url();?>assets/dist/css/toastr.css">

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <!-- Jquery Datepicker CSS -->

  <!-- <link rel="stylesheet" type="text/css" href="<?=base_url();?>assets/dist/css/jquery.datetimepicker.css"/ > -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/jquery-ui.css">

  <style type="text/css">

      #blink {
      animation: blinker 1.5s linear infinite;
      color: #ffff;
      font-size: 15px;
      font-weight: bold;
      font-family: sans-serif;
      }
      @keyframes blinker {
      50% { opacity: 0; }
      }

      .bShow{
       box-shadow: 5px 5px 5px 5px gray;
     }
     .dataTables_wrapper .dataTables_length, .dataTables_wrapper .dataTables_filter, .dataTables_wrapper .dataTables_info, .dataTables_wrapper .dataTables_processing, .dataTables_wrapper .dataTables_paginate {
    color: #333;
    margin-right: 20px !important;
}

  </style>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
  <div class="preloader" style="display: none;"></div>
  <header class="main-header">
    <!-- Logo -->
    <a href="javascript:void(0)" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b><?=title;?></b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b><?=title;?></b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="javascript:void(0)" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account: style can be found in dropdown.less -->

          <li class="dropdown user user-menu">
            <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">
              <?php
$image = $getProfile->image;
$path = "assets/images/profile/";
$file = FCPATH . $path . $image;
if (file_exists($file) && !empty($image)) {
	$img = base_url() . $path . $image;
} else {
	$img = base_url() . $path . "profile.png";
}
?>

              <img src="<?=$img;?>" class="user-image" alt="User Image">
              <span class="hidden-xs"><?=$_SESSION[SESSION_NAME]['name'];?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?=$img;?>" class="img-circle" alt="User Image">

                <p>
                  Welcome
                  <small><?=$_SESSION[SESSION_NAME]['name'];?></small>
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="<?php echo site_url(PROFILE) ?>" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="<?=site_url(LOGOUT);?>" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>
