
    <div class="content-wrapper">
         <!-- Content Header (Page header) -->
        <section class="content-header">
            <div id="page_title"><?php  echo $this->lang->line("module_admin_add");  ?> </div>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-tachometer-alt"></i> Home</a></li>
                    <li class="active">Admin</li>
                    <li class="active">Add</li>
                </ol>
        </section>

         <!-- Main content -->
         <section class="content">
            
            <?php
            echo form_open('users/users/addadmin' ,array('id'=>'add_user_form'));
            ?>
            <div class="row">
                <div class="col-lg-6 col-sm-6">                
                    <div class='form-group'>
                    <?php echo form_label($this->lang->line('profiles_employee').'#*', 'employee',array('class'=>'wide')); ?>
                        <?php echo form_input(array(
                            'name'=>'employee',
                            'class' => 'form-control',
                            'id'=>'employee',
                            'value'=>$user_info->email));?>
                    </div>
                    
                </div>

                <div class="col-lg-6 col-sm-6">                
                    <div class='form-group'>
                    <?php echo form_label($this->lang->line('profiles_pin').'#*', 'pin',array('class'=>'wide')); ?>
                        <?php echo form_input(array(
                            'name'=>'pin',
                            'class' => 'form-control',
                            'id'=>'pin',
                            'value'=>$user_info->email));?>
                    </div>
                    
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6 col-sm-6">                
                    <div class='form-group'>
                    <?php echo form_label($this->lang->line('profiles_first_name').'*', 'first_name',array('class'=>'wide')); ?>
                        <?php echo form_input(array(
                            'name'=>'first_name',
                            'class' => 'form-control',
                            'id'=>'first_name',
                            'value'=>$user_info->email));?>
                    </div>
                    
                </div>

                <div class="col-lg-6 col-sm-6">                
                    <div class='form-group'>
                    <?php echo form_label($this->lang->line('profiles_last_name').'*', 'last_name',array('class'=>'wide')); ?>
                        <?php echo form_input(array(
                            'name'=>'last_name',
                            'class' => 'form-control',
                            'id'=>'last_name',
                            'value'=>$user_info->email));?>
                    </div>
                    
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6 col-sm-6">                
                    <div class='form-group'>
                    <?php echo form_label($this->lang->line('profiles_phone').'*', 'phone_number',array('class'=>'wide')); ?>
                        <?php echo form_input(array(
                            'name'=>'phone_number',
                            'class' => 'form-control',
                            'id'=>'phone_number',
                            'value'=>$user_info->email));?>
                    </div>
                    
                </div>

                <div class="col-lg-6 col-sm-6">                
                    <div class='form-group'>
                    <?php echo form_label($this->lang->line('profiles_email').'*', 'email',array('class'=>'wide')); ?>
                        <?php echo form_input(array(
                            'name'=>'email',
                            'class' => 'form-control',
                            'id'=>'email',
                            'value'=>$user_info->email));?>
                    </div>
                    
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6 col-sm-6">                
                    <div class='form-group'>
                    <?php echo form_label($this->lang->line('login_password').'*', 'password',array('class'=>'wide')); ?>
                        <?php echo form_password(array(
                            'name'=>'password',
                            'class' => 'form-control',
                            'id'=>'password'
                        ));?>
                    </div>
                    
                </div>

                <div class="col-lg-6 col-sm-6">                
                    <div class='form-group'>
                    <?php echo form_label($this->lang->line('confirmpassword').'*', 'repeat_password',array('class'=>'wide')); ?>
                        <?php echo form_password(array(
                            'name'=>'repeat_password',
                            'class' => 'form-control',
                            'id'=>'repeat_password'
                        ));?>
                    </div>
                    
                </div>
            </div>

            <div id="new_button">
            <?php
                echo form_submit(array(
                    'name'=>'submit',
                    'id'=>'submit',
                    'value'=>$this->lang->line('profiles_submit'),
                    'class'=>'big_button float_left')
                );
                
            ?>

            </div>

   
</fieldset>
<?php 
   echo form_close();
   ?>
         </section>
         <!-- /.content-wrapper -->
    </div>   
 
<script type='text/javascript'>
   //validation and submit handling
    $(document).ready(function() {
      var csfrData = {};
      csfrData['<?php echo $this->security->get_csrf_token_name(); ?>'] = '<?php echo $this->security->get_csrf_hash(); ?>';
      $(function() {
          // Attach csfr data token
          $.ajaxSetup({
              data: csfrData
          });
      });

      $('#add_user_form').validate({
          submitHandler: function(form) {
              $(form).ajaxSubmit({
                  success: function(response) {
                      var str = response.message;
                      var success = response.success;
                      var res = str.replace(/\\n/g, "\n");
                      jAlert(res, 'Confirmation Dialog', function(r) {
                        window.history.back();

                      });
                  },
                  dataType: 'json'
              });
          },
          errorLabelContainer: "#error_message_box",
          wrapper: "li",
          rules: {
                employee:
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
				email:
      			{
      				required:true,
					email:"email",
					maxlength: 250

      			},
				first_name:
      			{
      				required:true,
					maxlength: 250

      			},
				last_name:
      			{
                    required:true,
					maxlength: 250

      			},
				phone_number:
      			{
                    required:true,
      				maxlength: 250
      			},
      			pin:
      			{
                    required:true,
      				maxlength: 250
      			},
			  
          },
          messages: {
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
				first_name:
           		{
           			required: "<?php echo $this->lang->line('profiles_first_name_required'); ?>",
					maxlength: "<?php echo $this->lang->line('profiles_first_name_maxlength'); ?>"
           		},
			    last_name:
           		{
					maxlength: "<?php echo $this->lang->line('profiles_last_name_maxlength'); ?>"
           		},
			    phone_number:
      			{
      				maxlength: "<?php echo $this->lang->line('profiles_phone_number_maxlength'); ?>"
           		}
          }
      });
  });
</script>