<?php
   defined('BASEPATH') OR exit('No direct script access allowed');
   ?>
 
      <div class="content-wrapper">
         <!-- Content Header (Page header) -->
         <section class="content-header">
        <div id="page_title">
            <?php  echo $this->lang->line("common_admin");
            echo str_repeat('&nbsp;', 3);
            $title = ($user_id == -1) ? $this->lang->line("common_add") : $this->lang->line("common_edit");

            echo $title;?> 
        </div>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-tachometer-alt"></i> Home</a></li>
            <li class="active">Admin</li>
            <li class="active"> <?php 
                echo $title;
            ?></li>
        </ol>
    </section>
         <!-- Main content -->
         <section class="content">
            <!--     custom  content   -->																						
            <div id="page_title"><?php echo $this->lang->line('profiles_profile'); ?></div>
            
            <?php
               echo form_open('users/profiles/save/'.$user_id,array('id'=>'config_form'));
               ?>
            <?php echo validation_errors(); ?>
            <div id="config_wrapper">
               <fieldset id="config_info">
                  <div class="col-md-12 user_profile">
                     <div class="box box-info profile_form"  >
                        
                        <ul id="error_message_box"></ul>
                          
                        <div class="row">
                        <div class='col-sm-4'>
                            <div class="form-group">
                                <?php echo form_label($this->lang->line('profiles_first_name').':', 'first_name',array('class'=>'col-sm-12 control-label')); ?>
                        
                                <?php echo form_input(array(
                                    'name'=>'first_name',
                                    'id'=>'first_name',
                                    'class'=>'form-control', 
                                    'value'=>$user_info->first_name
                                    ));?>
                            
                            </div>
                        </div>
                        
                        <div class='col-sm-4'>
                            <div class="form-group">
                            <?php echo form_label($this->lang->line('profiles_last_name').':', 'last_name',array('class'=>'col-sm-12 control-label')); ?>
                           
                            <?php echo form_input(array(
                                'name'=>'last_name',
                                'id'=>'last_name',
                                'class'=>'form-control', 
                                'value'=>$user_info->last_name
                                ));?>
                        
                            </div>
                        </div>
                        </div>

                        <div class="row">
                            <div class='col-sm-4'>
                            <div class="form-group">
                            <?php echo form_label($this->lang->line('profiles_phone').':', 'phone_number',array('class'=>'col-sm-12 control-label')); ?>
                            
                                <?php echo form_input(array(
                                    'name'=>'phone_number',
                                    'id'=>'phone_number',
                                    'class'=>'form-control', 
                                    'value'=>$user_info->phone_number
                                    ));?>
                            </div>
                            </div>

                            <div class='col-sm-4'>
                            <div class="form-group">
                            <?php echo form_label($this->lang->line('profiles_email').':', 'email',array('class'=>'col-sm-12 control-label')); ?>
                            
                                <?php echo form_input(array(
                                    'name'=>'email',
                                    'id'=>'email',
                                    'class'=>'form-control', 
                                    'value'=>$user_info->email
                                    ));?>
                            </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class='col-sm-4'>
                            <div class="form-group">
                            <?php echo form_label($this->lang->line('profiles_password').':', 'password',array('class'=>'col-sm-12 control-label')); ?>
                            
                                <?php echo form_input(array(
                                    'name'=>'password',
                                    'id'=>'password',
                                    'class'=>'form-control'
                                    ));?>
                            </div>
                            </div>

                            <div class='col-sm-4'>
                            <div class="form-group">
                            <?php echo form_label($this->lang->line('confirmpassword').':', 'email',array('class'=>'col-sm-12 control-label')); ?>
                            
                                <?php echo form_input(array(
                                    'name'=>'confirmpassword',
                                    'id'=>'confirmpassword',
                                    'class'=>'form-control'
                                    ));?>
                            </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class='col-sm-4'>
                            <div class="form-group">
                            <?php 
                                 echo form_submit(array(
                                 	'name'=>'submit',
                                 	'id'=>'submit',
                                 	'class'=>'btn btn-primary', 
                                 	'value'=>$this->lang->line('common_submit'),
                                 	)
                                 );
                                 ?>
                            </div>
                            </div>
                        </div>
                        
                     </div>
                  </div>
               </fieldset>
            </div>
            <?php
               echo form_close();
               ?>
            <script type='text/javascript'>				
               //validation and submit handling
    $(document).ready(function() {
     
        $('#config_form').validate({
            submitHandler: function(form) {
                // document.getElementById("submit").value = "Loading";
                // document.getElementById("submit").disabled = true;
                $(form).ajaxSubmit({
                    success: function(response) {
                        // document.getElementById("submit").value = "<?php echo $this->lang->line('common_submit'); ?>";
                        // document.getElementById("submit").disabled = false;
                    },
                dataType: 'json'
            });
        },
        errorLabelContainer: "#error_message_box",
        wrapper: "li",
        rules: {
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
            email:
            {
                required:true,
                maxlength: 250

            },
            phone_number:
            {
                required:true,
                maxlength: 250
            }

         },
         messages: {
             first_name:
           		{
           			required: "<?php echo $this->lang->line('profiles_first_name_required'); ?>",
					maxlength: "<?php echo $this->lang->line('profiles_first_name_maxlength'); ?>"
           		},
			last_name:
           		{
                    required: "<?php echo $this->lang->line('profiles_last_name_required'); ?>",
					maxlength: "<?php echo $this->lang->line('profiles_last_name_maxlength'); ?>"
           		},
			phone_number:
      			{
                    required: "<?php echo $this->lang->line('profiles_phone_required'); ?>",
      				maxlength: "<?php echo $this->lang->line('profiles_phone_number_maxlength'); ?>"
                },
            email:
      			{
                    required: "<?php echo $this->lang->line('profiles_email_required'); ?>",
      				maxlength: "<?php echo $this->lang->line('profiles_phone_number_maxlength'); ?>"
           		}           
         }
     });

     function post_form_submit(response) {
         if (!response.success) {
             set_feedback("<?php echo $this->lang->line('error_error_adding_updating'); ?>", 'error_message', false);
         } else {
             tb_remove();
             //This is an update, just update one row
             if (jQuery.inArray(response.user_id, get_visible_checkbox_ids()) != -1) {
                 set_feedback(response.message, 'success_message', false);
             } else //refresh entire table
             {
                 set_feedback(response.message, 'success_message', false);
                 location.reload();
             }
         }
     }
 });
            </script>
            <div id="feedback_bar"></div>
         </section>
         <!-- /.content -->
      </div>
      <!-- /.content-wrapper -->
      