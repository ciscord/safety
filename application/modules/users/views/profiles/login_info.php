<?php
   defined('BASEPATH') OR exit('No direct script access allowed');
   ?>
<fieldset id="user_login_info">
   <div id="required_fields_message"><?php echo $this->lang->line('common_fields_required_message'); ?></div>
   <?php
      echo form_open('users/profiles/save_password/'.$user_info->user_id,array('id'=>'login_form'));
      ?>
   <ul id="popup_error_message_box"></ul>
   
   <div class="field_row clearfix">
   <?php echo form_label($this->lang->line('profiles_email').':', 'email',array('class'=>'required wide')); ?>
   <div class='form_field'>
      <?php echo form_input(array(
         'name'=>'email',
         'id'=>'email',
         'value'=>$user_info->email));?>
   </div>
   </div>

   <div class="field_row clearfix">
      <?php echo form_label($this->lang->line('login_username').':', 'username',array('class'=>'required wide')); ?>
      <div class='form_field'>
         <?php echo form_input(array(
            'name'=>'username',
            'id'=>'username',
            'value'=>$user_info->username));?>
      </div>
   </div>
   <div class="field_row clearfix">
      <?php echo form_label($this->lang->line('login_new_password').':', 'password',array('class'=>'required wide')); ?>
      <div class='form_field'>
         <?php echo form_password(array(
            'name'=>'password',
            'id'=>'password'
            ));?>
      </div>
   </div>
   <div class="field_row clearfix">
      <?php echo form_label($this->lang->line('login_repeat_password').':', 'repeat_password',array('class'=>'required wide')); ?>
      <div class='form_field'>
         <?php echo form_password(array(
            'name'=>'repeat_password',
            'id'=>'repeat_password'
            ));?>
      </div>
   </div>
   <div class="field_row clearfix">
      <?php if(!$empty_password) echo form_label($this->lang->line('login_current_password').':', 'repeat_password',array('class'=>'required wide')); ?>
      <div class='form_field'>
         <?php if(!$empty_password) echo form_password(array(
            'name'=>'current_password',
            'id'=>'current_password'
            ));?>
      </div>
   </div>
   <br>
   <?php
      echo form_submit(array(
      	'name'=>'submit',
      	'id'=>'submit',
      	'value'=>$this->lang->line('common_submit'),
      	'class'=>'submit_button float_right')
      );
      
      ?>
</fieldset>
<?php 
   echo form_close();
   ?>
<script type='text/javascript'>
   //validation and submit handling
$(document).ready(function() {
    $("#login_submit").on("click", function() {
        $("#user_login_info").fadeOut(500);
        setTimeout(
            function() {
                $("#login_info_submit").fadeIn(500);
            }, 500);
    });

    $("#country_list").on("change", function(event) {
        var country_name = $("#country_list option:selected").text();
        $("#country_name").val(country_name);
    });
	
    $('#login_form').validate({
        submitHandler: function(form) {
            document.getElementById("submit").value = "Loading";
            document.getElementById("submit").disabled = true;
            $(form).ajaxSubmit({
                success: function(response) {
                    var str = response.message;
                    var res = str.replace(/\\n/g, "\n");
                    jAlert(res, 'Confirmation Dialog', function(r) {
                        tb_remove();
                    });
                },
                dataType: 'json'
            });
        },
        errorLabelContainer: "#popup_error_message_box",
        wrapper: "li",
        rules: {
			email:
      			{
      				required:true,
					email:"email",
					maxlength: 250
      			},
            username: {
                    required: true,
                    minlength: 5,
				    maxlength: 250
            },
			 current_password: {
                    required: true,
				    maxlength: 250
            },
            password: {
                    required: true,
                    minlength: 8,
				    maxlength: 250
            },
            repeat_password: {
                    equalTo: "#password"
            }
        },
        messages: {
			email:
           		{
           			required: "<?php echo $this->lang->line('profiles_email_required'); ?>",
           			email: "<?php echo $this->lang->line('common_email_invalid_format'); ?>",
					maxlength: "<?php echo $this->lang->line('profiles_email_maxlength'); ?>"
           		},
            username: {
                    required: "<?php echo $this->lang->line('login_username_required'); ?>",
                    minlength: "<?php echo $this->lang->line('login_username_minlength'); ?>",
				    maxlength: "<?php echo $this->lang->line('login_username_maxlength'); ?>"
            },
            current_password: {
                    required: "<?php echo $this->lang->line('login_current_password_required'); ?>",
				    maxlength: "<?php echo $this->lang->line('login_password_maxlength'); ?>"
            },
            password: {
                   required: "<?php echo $this->lang->line('login_password_required'); ?>",
                   minlength: "<?php echo $this->lang->line('login_password_minlength'); ?>",
				   maxlength: "<?php echo $this->lang->line('login_password_maxlength'); ?>"
            },
            repeat_password: {
                   equalTo: "<?php echo $this->lang->line('login_password_must_match'); ?>"
            }
        }
    });
});
</script>