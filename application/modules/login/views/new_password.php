<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
 
      <div class="row">
         <div class="col-md-12">
            <div class="box box-danger login_form" >
               <div class="box-header with-border">
                  <h3 class="box-title"><?php $this->lang->line('login_login');  ?> </h3>   
				  
               </div>
               <!-- /.box-header -->
               <!-- form start -->
               <?php echo form_open('login/new_password',array('id'=>'login_form'));  ?>
               <?php echo validation_errors(); ?>
			  
               <div class="box-body">
			    <ul id="error_message_box"></ul>
                  <div class="form-group">
				       <?php echo form_label($this->lang->line('profiles_email').':', 'profiles_email',array('class'=>'required col-sm-4 control-label')); ?>
                     <div class="col-sm-8">
                        <?php echo form_input(array(
                           'name'=>'email', 
                           'class'=>'form-control', 
                           'placeholder'=>'Enter Email',
                           'size'=>'20')); ?> 
                     </div>
                  </div>
                  <div class="form-group">
					  <?php echo form_label($this->lang->line('login_password').':', 'login_password',array('class'=>'required col-sm-4 control-label')); ?>
                     <div class="col-sm-8">
                        <?php echo form_password(array(
                           'name'=>'password', 
                           'class'=>'form-control', 
                           'placeholder'=>'Enter Password',
                           'size'=>'20')); ?>
                     </div>
                  </div>
				  
				  <div class="form-group">
                      <?php echo form_label($this->lang->line('login_repeat_password').':', 'repeat_password',array('class'=>'required col-sm-4 control-label')); ?>
                     <div class="col-sm-8">
                     <?php echo form_password(array(
                        'name'=>'repeat_password', 
                        'class'=>'form-control', 
						'placeholder'=>$this->lang->line('login_repeat_password'),
                        'size'=>'20')); ?>
                  </div>
                  </div>
				 
				   
				  
               </div>
               <!-- /.box-body -->
               <div class="box-footer">
                
                 <a  href="<?php echo site_url("login"); ?>"  class="btn btn-default">Login</a>
                  <?php echo 
                     form_submit(array(
                     'name'=>'loginButton', 
                     'class'=>'btn btn-danger pull-right', 
                     'id'=>'submit',
                     'name'=>'submit',
                     'value'=>'Submit'));
                      ?>
					   
               </div>
			   <?php echo form_hidden('code', $code) ; ?>
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
      		        jAlert(res, 'Confirmation Dialog', function(r) {
					
                    });
      			
      			},
      			dataType:'json'
      		});
      
      		},
      		errorLabelContainer: "#error_message_box",
       		wrapper: "li",
      		rules: 
      		{
      		 
      			email:
      			{
      				required:true,
					email:"email",
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
      		
           		
      			email:
           		{
           			required: "<?php echo $this->lang->line('profiles_email_required'); ?>",
           			email: "<?php echo $this->lang->line('common_email_invalid_format'); ?>",
					maxlength: "<?php echo $this->lang->line('profiles_email_maxlength'); ?>"
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
 