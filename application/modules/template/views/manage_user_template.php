<?php
   defined('BASEPATH') OR exit('No direct script access allowed');
   ?>
<?php $this->load->view("partial/header"); ?>
<?php $this->load->view("partial/alert_header"); ?>
<?php  $this->load->view("partial/tableHeader"); ?>
<?php  $this->load->view("partial/cropper"); ?>
 
<body class="skin-black">
   <div class="wrapper">
      <?php $this->load->view("partial/header_bar"); ?>
      <aside class="main-sidebar">
         <?php $this->load->view("partial/sidebar"); ?>
      </aside>
      <?php $this->load->view($content_view); ?>
      <?php $this->load->view("partial/footer"); ?>
   </div>
   <!-- end wrapper -->
   <?php  $this->load->view("partial/footer_links"); ?>
</body>
</html>