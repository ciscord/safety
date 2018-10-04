<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

      <div class="row">
         <div class="col-md-12">
            <div class="box box-danger login_form" >
               <div class="box-header with-border">
                   
               </div>
               <!-- /.box-header -->
               <!-- form start -->
           
               <div class="box-body">
                   <h4 class="box-title text-center"  id="error_message_box"  ><?php  echo $this->lang->line('login_password_reset_failed')  ?> </h4> 
                   <h5 class="box-title text-center"  ><?php echo $this->lang->line('login_password_reset_failed_error')  ?> </h5> 
                  <h6 class="text-center" > <?php echo $this->lang->line('login_password_reset_failed_message')  ?>  <a  class="text-center" href="<?php echo site_url("login/forget_password"); ?>"   ><?php echo $this->lang->line('login_click_here')  ?> </a>	</h6>
				   
				  
               </div>
               <!-- /.box-body -->
               <div class="box-footer">
 
               
                   
               </div>
			  
              
            </div>
         </div>
      </div>
     