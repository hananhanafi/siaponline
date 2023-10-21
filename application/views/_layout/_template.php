<!DOCTYPE html>
<html>
  <head>
    <title>Sistem Informasi Aktif Pemilu</title>
    <!-- meta -->
    <?php echo @$_meta; ?>

    <!-- css --> 
    <?php echo @$_css; ?>

    <!-- jQuery 2.2.3 -->
    <script src="<?php echo base_url(); ?>assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
    <link href="https://sabaronline.com/assets/img/favicon.png" rel="icon" type="image/png" >
    <link href="https://sabaronline.com/assets/img/favicon.png" rel="favicon" type="image/png">
  </head>

  <body class="hold-transition sidebar-mini skin-blue">
    <div class="wrapper">
      <!-- header -->
      <?php echo @$_header; ?> <!-- nav -->
      
      <!-- sidebar -->
      <?php echo @$_sidebar; ?>
      
      <!-- content -->
      <?php echo @$_content; ?> <!-- headerContent --><!-- mainContent -->
    
      <!-- footer -->
      <?php echo @$_footer; ?>
    
      <div class="control-sidebar-bg"></div>
    </div>

    <!-- js -->
    <?php echo @$_js; ?>
  </body>
</html>