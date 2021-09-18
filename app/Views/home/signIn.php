<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Monjin eLearning </title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Favicons -->
  <link rel="shortcut icon" href="<?= base_url(); ?>/public/dist/img/fav96X96.png" type="image/x-icon">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url(); ?>/public/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?= base_url(); ?>/public/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  
  <link rel="stylesheet" href="<?= base_url(); ?>/public/plugins/toastr/toastr.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url(); ?>/public/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="<?= base_url(); ?>/public/dist/css/style.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <style type="text/css">
    .input__text {
        padding-right: 0.5rem;
        padding-left: 0.5rem;
        padding-top: 0.95rem;
        padding-bottom: 0.95rem;
        border: none;
        box-shadow: 0 3px 1px -2px rgba(0, 0, 0, 0.2), 0 2px 2px 0 rgba(0, 0, 0, 0.14), 0 1px 5px 0 rgba(0, 0, 0, 0.12);
        color: #888888;
    }
    .login__form-input {
        margin-top: 0.5rem;
        box-sizing: border-box;
        width: 100%;
    }
    .login__form-label {
        color: #2E2E2E;
        font-weight: 500 !important;
        width: 100%;
        font-size: larger;
    }
    .login__forgot-link {
        float: right;
        color: #888888;
        text-decoration: underline;
        cursor: pointer;
    }
    .btn-primary,.btn-primary:hover,.btn-primary:active{
      background-color: #f7992b !important;
      border-color: #f7992b !important;
      border-radius: 2px;
    }
    .input-group>.form-control:focus {
        border: 2px solid #000000;
    }
    .img-panel{
      background-image: url(<?= base_url(); ?>/public/dist/img/login-page-prototype.png);
      background-size: contain;
      background-repeat: no-repeat;
      background-color: #cccccc3b;
    }
    .login-panel{
      padding: 5%;padding-top: 10%;
    }
    .login__box{
      margin: 0px;
      height: 730px ;
    }
    @media only screen and (max-width: 600px) {
    .img-panel {
      display: none !important;
    }
    .title-icon{
      width: 10% !important;
      padding: 1.9% !important;
      margin: 2%;
    }
    .login__box{
      height: auto;
      width: 100%;
    }
  }
  </style>
</head>
<body class="hold-transition">
  <div class="row" style="border-bottom: 1px solid #cccccc;vertical-align: middle;margin: 0px;">
    <div class="col-sm-12 col-lg-12 col-md-12 col-xs-12">
      <img class="title-icon" src="<?= base_url(); ?>/public/dist/img/Monjin-Logo.png" style="width: 9%;padding: 0.9%;">
      <i class="fa fa-angle-right fa-lg"></i>
      <span style="font-size: large;font-weight: 600;padding-left: 1%;">Login</span>
    </div>
  </div>
  <div class="row login__box">
    <div class="col-sm-8 col-lg-8 col-md-8 col-xs-8 img-panel">
      
    </div>
    <div class="col-sm-4 col-lg-4 col-md-4 col-xs-4 login-panel">
      <form class="form-horizontal" id="apply_for_course" action="<?php echo site_url('login') ?>" method="post">
          <div class="input-group">
            <label class="login__form-label">Email</label>
          </div>
          <div class="input-group mb-3">
            <input type="email" class="form-control input__text .login__form-label" placeholder="example@domain.com" name="user_email" required="" value="<?= set_value('user_email') ?>">
          </div>
          <div class="input-group mb-3"></div>
          <div class="input-group">
            <label class="login__form-label">Password <span class="login__forgot-link">Forgot?</span></label>
          </div>
          <div class="input-group mb-3">
            <input type="password" class="form-control input__text" name="user_password" required="">
          </div>
          <div class="row">
            <div class="form-group col-sm-12"> 
              
            </div>
          </div>
          <div class="row">
            <div class="col-8">
              
            </div>
            <!-- /.col -->
            <div class="col-4">
              <button type="submit" class="btn btn-primary btn-block">Sign In</button>
            </div>
            <!-- /.col -->
          </div>
        </form>
    </div>
  </div>
</div>
<!-- /.login-card-body -->
</div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="<?= base_url(); ?>/public/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url(); ?>/public/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url(); ?>/public/dist/js/adminlte.min.js"></script>

<script src="<?= base_url(); ?>/public/plugins/toastr/toastr.min.js"></script>

<script type="text/javascript">
  <?php if(isset($validation)): ?>
    toastr.error("Email or Password don't match");
  <?php endif; ?>
  <?php if(isset($info)): ?>
    toastr.info("<?php echo $info; ?>");
  <?php endif; ?>
  <?php if(isset($error)): ?>
    toastr.error("<?php echo $error; ?>");
  <?php endif; ?>
</script>
</body>
</html>
