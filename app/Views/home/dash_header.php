<?php $uri = service('uri'); ?>
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <link rel="shortcut icon" href="<?= base_url(); ?>/public/dist/img/fav96X96.png" type="image/x-icon">
  <title>Monjin Call | <?= ($uri->getSegment(1) == 'home' ? 'Home' : null)?> <?= ($uri->getSegment(1) == 'user' ? 'Users' : null)?> <?= ($uri->getSegment(1) == 'campaign' ? 'Campaign' : null)?> <?= ($uri->getSegment(1) == 'programs' ? 'Programs' : null)?></title>

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="<?= base_url(); ?>/public/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url(); ?>/public/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="<?= base_url(); ?>/public/plugins/toastr/toastr.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <style type="text/css">
    .container{
      max-width: 100%;
    }
    .layout-top-nav .wrapper .main-header .brand-image {
      margin-top: 0rem;
      margin-right: .2rem;
      height: 33px;
    }
    .navbar-brand .img-circle {
      border-radius: 0px; 
    }
    .elevation-3{
      box-shadow: none !important;
    }
    .navbar-light .navbar-nav .nav-link.active{
      color: rgb(247 153 43);
      font-weight: bold;
    }
    .navbar-light .navbar-nav .nav-link:hover{
      color: rgb(247 153 43);
      font-weight: 600;
    }
    .navbar-light .navbar-nav .nav-link{
      font-weight: 600;
      color: #000000;
    }
    .navbar-nav>.user-menu>.dropdown-menu>li.user-header {
      height: 150px;
      font-weight: bold;
    }
    .card-primary .card-header, .btn-primary{
      background-color: #f7992b !important;
      border-color: #f7992b !important;
    }
    .mandatory{
      color: red;
    }
    .dropdown-toggle::after{
      vertical-align: middle;
      border-top: .4em solid;
    }
    .btn-icon{
      background-color: #5b76d7;
      color: #ffffff;
    }
    .main-footer{
      padding: 5px 9px;
    }
    .hidden {
      display: none;
    }
    .loader {
      position: fixed;
      left: 0px;
      top: 0px;
      width: 100%;
      height: 100%;
      z-index: 9999;
      background: url('<?=base_url()?>/public/dist/img/loader.gif') 50% 50% no-repeat rgb(249,249,249);
      opacity: .8;
    }
  </style>
</head>
<body class="hold-transition layout-top-nav">
  <div class="loader"></div>
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
      <div class="container">
        <a href="" class="navbar-brand">
          <img src="<?= base_url(); ?>/public/dist/img/Monjin-Logo.png" alt="Monjin Logo" class="brand-image img-circle elevation-3">
          <!-- <span class="brand-text font-weight-light">AdminLTE 3</span> -->
        </a>

        <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse order-3" id="navbarCollapse">
          <!-- Left navbar links -->
          <ul class="navbar-nav">
           <!--  <li class="nav-item">
              <a href="<?= site_url('home');?>" class="nav-link <?= ($uri->getSegment(1) == 'home' ? 'active' : null)?>">Home</a>
            </li> -->
            <?php if(session()->get('role_id') == '1'){ ?>
            <li class="nav-item dropdown">
              <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle <?= ($uri->getSegment(1) == 'user' ? 'active' : null)?>">User Profiles</a>
              <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                <?php if(session()->get('role_id') == '1'){ ?>
                  <li><a href="<?= site_url('user/create_user');?>" class="dropdown-item">Create Profiles </a></li>
                <?php } ?>
                <!-- <li><a href="<?= site_url('user/import_users'); ?>" class="dropdown-item">Import Profiles</a></li> -->
              </ul>
            </li>
            <?php } ?>
            <?php if(session()->get('role_id') == '1' || session()->get('role_id') == '2'){ ?>
            <li class="nav-item dropdown">
              <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle <?= ($uri->getSegment(1) == 'campaign' ? 'active' : null)?>">Campaign</a>
              <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
               <!--  <li><a href="<?= site_url('assignment/stage_details');?>" class="dropdown-item">Create Campaign </a></li> -->
                <li><a href="<?= site_url('campaign/campaign_details');?>" class="dropdown-item">Campaign Details </a></li>
               <!--  <li><a href="<?= site_url('assignment/topic_details'); ?>" class="dropdown-item">Import Campaign Data</a></li> -->
              </ul>
            </li>
            <?php } ?>
          </ul>

        </div>

        <!-- Right navbar links -->
        <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
          <!-- Messages Dropdown Menu -->
          <li class="nav-item dropdown">
          <!-- <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="fas fa-comments"></i>
            <span class="badge badge-danger navbar-badge">3</span>
          </a> -->
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <a href="#" class="dropdown-item">
              <!-- Message Start -->
              <div class="media">
                <img src="<?= base_url(); ?>/public/dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                <div class="media-body">
                  <h3 class="dropdown-item-title">
                    Brad Diesel
                    <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                  </h3>
                  <p class="text-sm">Call me whenever you can...</p>
                  <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                </div>
              </div>
              <!-- Message End -->
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <!-- Message Start -->
              <div class="media">
                <img src="<?= base_url(); ?>/public/dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
                <div class="media-body">
                  <h3 class="dropdown-item-title">
                    John Pierce
                    <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                  </h3>
                  <p class="text-sm">I got your message bro</p>
                  <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                </div>
              </div>
              <!-- Message End -->
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <!-- Message Start -->
              <div class="media">
                <img src="<?= base_url(); ?>/public/dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
                <div class="media-body">
                  <h3 class="dropdown-item-title">
                    Nora Silvester
                    <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                  </h3>
                  <p class="text-sm">The subject goes here</p>
                  <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                </div>
              </div>
              <!-- Message End -->
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
          </div>
        </li>
        <!-- Notifications Dropdown Menu -->
        <!-- <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-bell"></i>
            <span class="badge badge-warning navbar-badge">15</span>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <span class="dropdown-header">15 Notifications</span>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-envelope mr-2"></i> 4 new messages
              <span class="float-right text-muted text-sm">3 mins</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-users mr-2"></i> 8 friend requests
              <span class="float-right text-muted text-sm">12 hours</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-file mr-2"></i> 3 new reports
              <span class="float-right text-muted text-sm">2 days</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
          </div>
        </li> -->
        <li class="nav-item dropdown user-menu">
          <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
            <img src="<?= base_url(); ?>/public/dist/img/profile_logo.png" class="user-image img-circle elevation-2" alt="User Image">
            <span class="d-none d-md-inline"><?= $user[0]['user_firstName']." ".$user[0]['user_lastName']; ?></span>
          </a>
          <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <!-- User image -->
            <li class="user-header bg-primary" style="background-color: #ffffff!important;color: #f7992b!important">
              <img src="<?= base_url(); ?>/public/dist/img/profile_logo.png" class="img-circle elevation-2" alt="User Image">
              <p>
                <?= $user[0]['user_firstName']." ".$user[0]['user_lastName']; ?>
              </p>
            </li>
            <!-- Menu Footer-->
            <li class="user-footer" style="background-color: #f7992b!important;">
              <?php if(session()->get('role_id') == '5'){ ?>
                <a href="#" class="btn btn-default btn-flat">User Profile</a>
              <?php } ?>
              <a href="<?= site_url('logout'); ?>" class="btn btn-default btn-flat float-right">Sign out</a>
            </li>
          </ul>
        </li>
        <!-- <li class="nav-item">
          <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button"><i
              class="fas fa-th-large"></i></a>
            </li> -->
          </ul>
        </div>
      </nav>
  <!-- /.navbar -->