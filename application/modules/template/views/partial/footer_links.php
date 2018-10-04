<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="<?php echo base_url();?>assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url();?>assets/adminlte/dist/js/app.js" type="text/javascript"></script>
	
	<script src="<?php echo base_url();?>assets/js/jquery.nicescroll.min.js" type="text/javascript"></script>
	 
	<script>
	$(document).ready(function() {
		init_niceScroll();
		$("#<?php echo $controller_name; ?>_menu_act").addClass( "active" );
        $("#<?php echo $controller_name; ?>_menu_act").closest('ul').closest('li').addClass( "active" );
 
	   $(window).resize(function() {
            init_niceScroll();
      
        });
	
	function init_niceScroll()
	{
		var win_width = $(window).width();  
		if (win_width < 1280)
               $("html").getNiceScroll().remove();
		else
		   {
			$("html").niceScroll({
            cursorcolor: "#333",
            cursoropacitymin: 0.3,
            background: "#bbb",
            cursorborder: "1px",
            autohidemode: false,
            cursorminheight: 30
            });
		   }
	}
	

});
</script>