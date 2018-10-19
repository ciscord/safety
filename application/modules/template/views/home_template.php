<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php $this->load->view("partial/header"); ?>
    <!-- iCheck -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/adminlte/plugins/iCheck/flat/red.css">
    <!-- Morris chart -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/adminlte/plugins/morris/morris.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/adminlte/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
    <!-- Date Picker -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/adminlte/plugins/datepicker/datepicker3.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/adminlte/plugins/daterangepicker/daterangepicker-bs3.css">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
	<!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
	 <!-- jQuery UI 1.11.4 -->
    <script src="<?php echo base_url();?>assets/adminlte/dist/js/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
      $.widget.bridge('uibutton', $.ui.button);
    </script>
	</head>
	  <body class="hold-transition skin-black sidebar-mini">
		
		<div class="wrapper">

    <?php $this->load->view("partial/header_bar"); ?>
     
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
            <aside class="main-sidebar">
 <?php $this->load->view("partial/sidebar.php"); ?>
       
      </aside>
        <!-- /.sidebar -->
      </aside>


      <?php $this->load->view($content_view); ?>
      <?php $this->load->view("partial/footer"); ?>

      
      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>
    </div><!-- ./wrapper -->

	

   
	   
 
	  <?php  $this->load->view("partial/footer_links"); ?>
	</body>
</html>

 