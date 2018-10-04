<?php
   defined('BASEPATH') OR exit('No direct script access allowed');
   ?>
<?php
   echo form_open('users/users/save/'.$user_info->user_id,array('id'=>'employee_form'));
   ?>
<div id="required_fields_message"><?php echo $this->lang->line('common_fields_required_message'); ?></div>
<ul id="error_message_box"></ul>
<fieldset id="user_basic_info">
   <legend><?php echo $this->lang->line("profiles_basic_information"); ?></legend>
   <?php $this->load->view("users/users/form_basic_info"); ?>
</fieldset>
<fieldset id="employee_login_info">
   <legend><?php echo $this->lang->line("profiles_login_info"); ?></legend>
   
   
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
   <?php
      $password_label_attributes = $user_info->user_id == "" ? array('class'=>'required wide'):array();
      ?>
   <div class="field_row clearfix">
      <?php echo form_label($this->lang->line('login_password').':', 'password',$password_label_attributes); ?>
      <div class='form_field'>
         <?php echo form_password(array(
            'name'=>'password',
            'id'=>'password'
            ));?>
      </div>
   </div>
   <div class="field_row clearfix">
      <?php echo form_label($this->lang->line('login_repeat_password').':', 'repeat_password',$password_label_attributes); ?>
      <div class='form_field'>
         <?php echo form_password(array(
            'name'=>'repeat_password',
            'id'=>'repeat_password'
            ));?>
      </div>
   </div>
</fieldset>
<fieldset id="employee_permission_info">
   <legend><?php echo $this->lang->line("profiles_permission_info"); ?></legend>
   <p><?php echo $this->lang->line("profiles_permission_desc"); ?></p>
   <ul id="permission_list">
      <?php
         foreach($all_modules->result() as $module)
         {
         ?>
      <li>	
         <?php
            $js = 'id="'.$module->module_id.'"';
             echo form_checkbox("permissions[]",$module->module_id,$this->User->has_permission($module->module_id,$user_info->user_id),$js); ?>
         <label for="<?php echo $module->module_id ?>"></label>
         <span class="medium"><?php echo $this->lang->line('module_'.$module->module_id);?>:</span>
         <span class="small"><?php echo $this->lang->line('module_'.$module->module_id.'_desc');?></span>
      </li>
      <?php
         }
         ?>
   </ul>
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
<style>
   /* for prevent auto scroll of checkbox )*/
   input[type="checkbox"]
   {
   display: none;
   }
</style>
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
      $('input[type="checkbox"]').addClass("filled-in");
      $("#country_list").on("change", function(event) {
          var country_name = $("#country_list option:selected").text();
          $("#country_name").val(country_name);
      });
      $('#employee_form').validate({
          submitHandler: function(form) {
              $(form).ajaxSubmit({
                  success: function(response) {
                      var str = response.message;
                      var success = response.success;
                      var res = str.replace(/\\n/g, "\n");
                      jAlert(res, 'Confirmation Dialog', function(r) {
                          post_person_form_submit(response);
                      });
                  },
                  dataType: 'json'
              });
          },
          errorLabelContainer: "#error_message_box",
          wrapper: "li",
          rules: {
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
					maxlength: 250

      			},
				phone_number:
      			{
      				maxlength: 250
      			},
      			city:
      			{
      				maxlength: 250
      			},	
      			state:
      			{
       				maxlength: 250
      			},
				comments:
      			{
					maxlength: 2000

      			},
      			address:
      			{
					maxlength: 2000

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
           		} ,
			state:
      			{
      				maxlength: "<?php echo $this->lang->line('profiles_state_maxlength'); ?>"
           		} ,
			city:
      			{
      				maxlength: "<?php echo $this->lang->line('profiles_city_maxlength'); ?>"
           		} ,
			address:
      			{
      				maxlength: "<?php echo $this->lang->line('profiles_address_maxlength'); ?>"
           		} ,
			comments:
      			{
      				maxlength: "<?php echo $this->lang->line('profiles_comments_maxlength'); ?>"
           		} 
          }
      });
  });
</script>