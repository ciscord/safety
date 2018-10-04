<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php $this->load->view("partial/header");?>
<?php $this->load->view("partial/alert_header"); ?> 
<?php $this->load->view("partial/tableHeader"); ?>
</head>
<body class="registration-section"   >
   <div class="wrapper" >
    <?php $this->load->view($content_view); ?>
   </div>
   <!-- ./wrapper -->
</body>
</html>