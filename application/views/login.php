<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <!-- | Sistem Informasi Aktif Pemilu -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/eksternal/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/eksternal/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/iCheck/square/blue.css">


<!--   <link rel="icon" href="<?php // = base_url(); ?>assets/img/favicon.png" type="image/png">
  <link rel="shortcut icon" href="<?php // = base_url(); ?>assets/img/favicon.png" type="image/png"> -->
  <link rel="icon" href="<?= base_url(); ?>assets/img/favicon.png" type="image/png">
  <link rel="shortcut icon" href="<?= base_url(); ?>assets/img/favicon.png" type="image/png">
  <title>SIAP</title>
</head>

<body class="hold-transition login-page">
  <div class="login-box">
    <div class="login-logo"><img src="<?php // echo base_url(); ?>" width="70%"></b>
    </div>

    <!-- /.login-logo -->
    <div class="login-box-body">

      <p class="login-box-msg">
        Sistem Informasi Aktif Pemilu (SIAP)
      </p>

      <form action="<?php echo base_url('Auth/login'); ?>" method="post">
        <div class="form-group has-feedback">
          <input type="text" class="form-control" placeholder="Username" name="username">
          <span class="glyphicon glyphicon-user form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
          <input type="password" class="form-control" placeholder="Password" name="password">
          <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
        <div class="row">
          <div class="col-xs-offset-8 col-xs-4">
            <button type="submit" class="btn btn-primary btn-block btn-flat">Masuk</button>
          </div>
        </div>
      </form>


    </div>
    <!-- /.login-box-body -->

    <?php
    echo show_err_msg($this->session->flashdata('error_msg'));
    ?>

  </div>


  <!-- /.login-box -->

  <!-- jQuery 2.2.3 -->
  <script src="<?php echo base_url(); ?>assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
  <!-- Bootstrap 3.3.6 -->
  <script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js"></script>
  <!-- iCheck -->
  
</body>
<!-- REQUIRED JS SCRIPTS -->
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/select2/select2.full.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/iCheck/icheck.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url(); ?>assets/dist/js/app.min.js"></script>
<!-- Supersized 
<script src="<?php echo base_url('assets/plugins/supersized/supersized.3.2.7.min.js') ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/plugins/supersized/supersized-init.js') ?>" type="text/javascript"></script>
-->
<!-- My Ajax -->
<?php include './assets/js/ajax.php'; ?>

</html>