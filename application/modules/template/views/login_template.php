<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php $this->load->view("partial/header");?>
<?php $this->load->view("partial/alert_header"); ?> 
 
</head>
<body class="login-section"  >
   <div class="wrapper container-fluid">
    <?php $this->load->view($content_view); ?>
   </div>
   <!-- ./wrapper -->
</body>
</html>