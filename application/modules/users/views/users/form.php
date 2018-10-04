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

<fieldset id="employee_permission_info">
<legend><?php echo $this->lang->line("profiles_avatar");?></legend>
<div class="field_row clearfix">	
<img class="profile-avatar"  src="<?php
$image_name=$user_info->profile_image;
$default_image_name="default.png";
$upload_path=site_url("uploads");
if($image_name!="")
 echo $upload_path."/".$image_name;
else
echo $upload_path."/".$default_image_name;?>?<?php echo time(); //to prevent browser image caching ?>" alt="avatar" height="150" >
</div>
 
 
   
   <legend class="profile-permission-header"><?php echo $this->lang->line("profiles_permission_info"); ?></legend>
   <p><?php echo $this->lang->line("profiles_permission_desc"); ?></p>

   <ul id="permission_list">
      <?php
         foreach($all_modules->result() as $module)
         {
         ?>
      <li>	
         <?php
            $js = 'id="'.$module->module_id.'"';
			if($module->module_id=="users" && $user_info->user_level==1) { //disable user permission delete option for admin
				$js = 'id="'.$module->module_id.' " disabled';
				echo form_hidden('permissions[]', $module->module_id);
			}
		    else {
				$js = 'id="'.$module->module_id.'"';
			}
             
			echo form_checkbox("permissions[]",$module->module_id,$this->User->has_permission($module->module_id,$user_info->user_id),$js);
						 ?>
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
     $("#country_list").on("change", function(event) {
         var country_name = $("#country_list option:selected").text();
         $("#country_name").val(country_name);
     });
     $('#employee_form').validate({
         submitHandler: function(form) {
             document.getElementById("submit").value = "Loading";
             document.getElementById("submit").disabled = true;
             $(form).ajaxSubmit({
                 success: function(response) {
                     var str = response.message;
                     var res = str.replace(/\\n/g, "\n");
                     jAlert(res, 'Confirmation Dialog', function(r) {
                         tb_remove();
                         post_person_form_submit(response);
                     });
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