<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
 
      <!-- Main content -->
  <div class="row">
      <div class="col-md-12">
            <div class="box login_form" >
            <?php echo form_open('login',array('id'=>'login_form'));  ?>
               <?php echo validation_errors(); ?>
            
               <?php echo "<h5 align='center' style='color: #DA1111;'>".$error_messages."</h5>"; ?>
               
               <div class="box-body">
                  <ul id="error_message_box"></ul>
                  <img class="main-logo img-responsive " src="assets/images/logo.png" alt="">
                  
                  <p class="main-title">SAFETY & ENVIRONMENTAL TRACKER</p>
                  <div class="form-group">
                     <div class="col-sm-12">
                        <?php echo form_input(array(
                           'name'=>'username', 
                           'class'=>'form-control', 
                           'placeholder'=>'Email',
                           'size'=>'20')); ?> 
                     </div>
                     <div class="col-sm-12">
                        <?php echo form_password(array(
                           'name'=>'password', 
                           'class'=>'form-control', 
                           'placeholder'=>'Password',
                           'size'=>'20')); ?>
                     </div>
                  </div>
                  
                  <div class="form-group">
                     <div class="col-sm-10">
                        <div class="checkbox text-center">
                           <input type="checkbox" id="remember_me" name="remember_me" value="7" class="filled-in">
                           <label for='remember_me'></label>	<span> <?php echo $this->lang->line('login_remember_me');  ?></span>	
                        </div>
                     </div>
                  </div>
				  
               </div>
               <!-- /.box-body -->
               <div class="box-footer">
                  <?php echo 
                     form_submit(array(
                     'name'=>'loginButton', 
                     'class'=>'btn btn-primary', 
                     'id'=>'submit',
                     'name'=>'submit',
                     'style'=>'width:100%;',
                     'value'=>$this->lang->line('login_login')));
                      ?>
					   
               </div>
			  
            <?php echo form_close(); ?>
            </div>
      </div>
</div>
   
   <script type='text/javascript'>
$(document).ready(function()
    {
	   	'use strict';
		
            $('#login_form').validate({
      		submitHandler:function(form)
      		{ 
			
      			$(form).ajaxSubmit({
					
                              success:function(response)
                              {
                              
                                    var str = response.message;
                                    var res = str.replace(/\\n/g, "\n");
                                    jAlert(res, 'Confirmation Dialog', function(r) {});
                              
                              },
                              dataType:'json'
      		      });
      
      		},
      		errorLabelContainer: "#error_message_box",
       		wrapper: "li",
      		rules: 
      		{
      		 
      			username:
      			{
      				required:true,
      				minlength: 3,
      				maxlength: 250
      			},
      			
      			password:
      			{
      				 
      				required:true,
      				minlength: 8,
      				maxlength: 250
      			}
      			 
         	},
      		messages: 
      		{
      			username:
           		{
           			required: "<?php echo $this->lang->line('login_username_required'); ?>",
           			minlength: "<?php echo $this->lang->line('login_username_minlength'); ?>",
           			maxlength: "<?php echo $this->lang->line('login_username_maxlength'); ?>"
           		},
           		
      			password:
      			{	
      				required:"<?php echo $this->lang->line('login_password_required'); ?>",
      				minlength: "<?php echo $this->lang->line('login_password_minlength'); ?>",
      				maxlength: "<?php echo $this->lang->line('login_password_maxlength'); ?>"
      			}
      		}
      	});
      });
   </script>
 