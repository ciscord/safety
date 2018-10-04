<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
 
 
      <!-- Main content -->
      <div class="row">
         <!-- Horizontal Form -->
         <div class="box box-danger registration_form" >
            <div class="box-header with-border">
               <h3 class="box-title"><?php echo $this->lang->line('login_register_form') ?> </h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
			  <div class="box-body">
            <?php
               echo form_open('login/save_user/-1',array('id'=>'registration_form'));
               ?>
			    <?php echo validation_errors(); ?>
            <div id="required_fields_message"><?php echo $this->lang->line('common_fields_required_message'); ?></div>
            <ul id="error_message_box"></ul>
            <div class="form-group">
               <?php echo form_label($this->lang->line('profiles_first_name').':', 'first_name',array('class'=>'required col-sm-4 control-label')); ?>
               <div class='col-sm-8'>
                  <?php echo form_input(array(
                     'name'=>'first_name',
                     'id'=>'first_name',
                     'class'=>'form-control', 
                     ));?>
               </div>
            </div>
            <div class="form-group">
               <?php echo form_label($this->lang->line('profiles_last_name').':', 'last_name',array('class'=>'col-sm-4 control-label')); ?>
               <div class='col-sm-8'>
                  <?php echo form_input(array(
                     'name'=>'last_name',
                     'id'=>'last_name',
                      'class'=>'form-control', 
                     ));?>
               </div>
            </div>

          
               <div class="form-group">
                  <?php echo form_label($this->lang->line('login_username').':', 'username',array('class'=>'required col-sm-4 control-label')); ?>
                  <div class="col-sm-8">
                     <?php echo form_input(array(
                        'name'=>'username', 
                        'class'=>'form-control', 
                        'size'=>'20')); ?> 
                  </div>
               </div>
               <div class="form-group">
                  <?php echo form_label($this->lang->line('login_password').':', 'password',array('class'=>'required col-sm-4 control-label')); ?>
                  <div class="col-sm-8">
                     <?php echo form_password(array(
                        'name'=>'password', 
                        'id'=>'password', 
                        'class'=>'form-control', 
                        'size'=>'20')); ?>
                  </div>
               </div>
               <div class="form-group">
                  <?php echo form_label($this->lang->line('login_repeat_password').':', 'repeat_password',array('class'=>'required col-sm-4 control-label')); ?>
                  <div class="col-sm-8">
                     <?php echo form_password(array(
                        'name'=>'repeat_password', 
                        'class'=>'form-control', 
                        'size'=>'20')); ?>
                  </div>
               </div>
               <div class="form-group">
                  <?php echo form_label($this->lang->line('profiles_dob').':', 'dob',array('class'=>'col-sm-4 control-label'));
                     $js = 'id="dobmonth" class="date_dropdown"';
                     $js = 'id="dobday" class="date_dropdown"';
                     $js = 'id="dobyear" class="date_dropdown"';
                      ?>
                  <div class="col-sm-8" id='report_date_range_complex'  >
                     <?php echo form_dropdown('dobmonth',$dmonths, $dselected_month, $js); ?>
                     <?php echo form_dropdown('dobday',$ddays, $dselected_day, $js); ?>
                     <?php echo form_dropdown('dobyear',$dyears, $dselected_year, $js); ?>
                  </div>
               </div>
               <div class="form-group">
                  <?php echo form_label($this->lang->line('profiles_marital_status').':', 'marital_status',array('class'=>'col-sm-4 control-label')); ?>
                  <div class='col-sm-8'  >
                     <?php
                        $marital_status="";
                        $data = array(
                          'name'        => 'marital_status',
                          'value'       => 'Single',
                          'id'=>'option1',
						  'checked'     => TRUE
                          );
                        
                        $data2 = array(
                          'name'        => 'marital_status',
                          'value'       => 'Married',
                          'id'=>'option2'
                          );
                        
                        echo "".form_radio($data)."<label for='option1'>".$this->lang->line('profiles_single')."</label> ";;
                        echo "".form_radio($data2)."<label for='option2' class='right_label'>".$this->lang->line('profiles_married')."</label> ";;
                        ;?>
                  </div>
               </div>
               <div class="form-group">
                  <?php echo form_label($this->lang->line('profiles_phone').':', 'phone_number',array('class'=>'col-sm-4 control-label')); ?>
                  <div class='col-sm-8'>
                     <?php echo form_input(array(
                        'name'=>'phone_number',
                        'id'=>'phone_number',
                         
                        ));?>
                  </div>
               </div>
               <div class="form-group">
                  <?php echo form_label($this->lang->line('profiles_email').':', 'email',array('class'=>'required col-sm-4 control-label')); ?>
                  <div class='col-sm-8'>
                     <?php echo form_input(array(
                        'name'=>'email',
                        'id'=>'email',
                         
                        ));?>
                  </div>
               </div>
               <div class="form-group">
                  <?php echo form_label($this->lang->line('profiles_country').':', 'country',array('class'=>'col-sm-4 control-label ')); ?>
                  <div class='col-sm-8'>
                     <?php 
                        $attr=array('id'=>'country_list');
                        $query =$this->User->get_country_list();
						
						 foreach($query->result_array() as $row)
                         {
                            $country_data[$row['country_name']]=$row['country_code'];
                         }
				
                        echo form_dropdown('country_code',$country_data, "US", $attr); ?>
                     <input type="hidden" name="country_name" value="US" id="country_name" /> <!-- to get country name --->
                  </div>
               </div>
               <hr>
           
			
			
			
			 <div class="form-group">
			 <?php echo form_label($this->lang->line('profiles_validation_code').':', 'validation_code',array('class'=>'required col-sm-4 control-label ')); ?>
			 <div class='col-sm-8'>
    <label for="captcha"><?php echo   $captcha['image'];  ?></label>
    <br>
    <br>
    <input type="text" autocomplete="off" name="userCaptcha" placeholder="Enter above text" value="<?php if(!empty($userCaptcha)){ echo $userCaptcha;} ?>" />
    <span class="required-server"><?php echo form_error('userCaptcha','<p style="color:#F83A18">','</p>'); ?></span>
	<br>
 </div>	</div>
 
 <!-- Set permissions for access profile on registration -->
 <input type="checkbox" name="permissions[]" value="profiles" checked="checked" class="hidden"  id="profiles">
 
  </div>



            <!-- /.box-body -->
            <div class="box-footer">
               <a  href="<?php echo site_url("login"); ?>"  class="btn btn-default"><?php echo $this->lang->line('login_login'); ?></a>
               <?php echo 
                  form_submit(array(
                  'name'=>'login_register', 
                  'class'=>'btn btn-danger pull-right', 
                  'id'=>'submit',
                  'name'=>'submit',
                  'value'=>$this->lang->line('login_register')));
                   ?>
            </div>
            <?php echo form_close(); ?>
         </div>
         <!-- /.box -->
      </div>
      <!-- /.row -->
      <div class="control-sidebar-bg"></div>
 
   <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
<script type='text/javascript'>
$(document).ready(function()
    {
	   	'use strict';
		
        $("#country_list").on("change",function( event ) {
            var country_name=$("#country_list option:selected").text();
            $("#country_name").val(country_name);
        });
      
       $('#registration_form').validate({
      		submitHandler:function(form)
      		{ 
			
				document.getElementById("submit").value = "Loading";
                document.getElementById("submit").disabled = true;
      			$(form).ajaxSubmit({
					
      			success:function(response)
      			{
      			
      				document.getElementById("submit").value = "<?php echo $this->lang->line('login_register');?>";
                    document.getElementById("submit").disabled = false;
					var success = response.success;
      				var str = response.message;
                    var res = str.replace(/\\n/g, "\n");
      		        jAlert(res, 'Confirmation Dialog', function(r) {
						if(success)
						window.location.replace("<?php echo site_url("login"); ?>");

                    });
      			
      			},
      			dataType:'json'
      		});
      
      		},
      		errorLabelContainer: "#error_message_box",
       		wrapper: "li",
      		rules: 
      		{
      		
 
				first_name:
      			{
      				required:true,
					maxlength: 250

      			},
				last_name:
      			{
					maxlength: 250

      			},
				username:
      			{
      				required:true,
      				minlength: 5,
      				maxlength: 250
      			},
      			
      			password:
      			{
      				 
      				required:true,
      				minlength: 8,
      				maxlength: 250
      			},	
      			repeat_password:
      			{
       				equalTo: "#password"
      			},
				phone_number:
      			{
					maxlength: 250

      			},
      			
      			email:
      			{
      				required:true,
					email:"email",
					maxlength: 250

      			},
      			
				userCaptcha: "required",
         	},
      		messages: 
      		{
      		
				first_name:
           		{
           			required: "<?php echo $this->lang->line('profiles_first_name_required'); ?>",
					maxlength: "<?php echo $this->lang->line('profiles_first_name_maxlength'); ?>"
           		},
				last_name:
           		{
					maxlength: "<?php echo $this->lang->line('profiles_last_name_maxlength'); ?>"
           		},
           		
           		email:
           		{
           			required: "<?php echo $this->lang->line('profiles_email_required'); ?>",
           			email: "<?php echo $this->lang->line('common_email_invalid_format'); ?>",
					maxlength: "<?php echo $this->lang->line('profiles_email_maxlength'); ?>"
           		},
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
      			},
      			repeat_password:
      			{
      				equalTo: "<?php echo $this->lang->line('login_password_must_match'); ?>"
           		} ,
				phone_number:
      			{
      				maxlength: "<?php echo $this->lang->line('profiles_phone_number_maxlength'); ?>"
           		} ,
				
				userCaptcha: "<?php echo $this->lang->line('profiles_captcha_required'); ?>"
      		}
      	});
      });
   </script>
