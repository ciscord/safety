<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?> 
<ul id="error_message_box"></ul>
<fieldset id="user_basic_info">
<legend><?php echo $this->lang->line("profiles_basic_information"); ?></legend>
<?php $this->load->view("trashes/form_basic_info"); ?>
</fieldset>

<fieldset id="employee_login_info">
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
<legend><?php echo $this->lang->line("profiles_login_info"); ?></legend>
<div class="field_row clearfix">	
<?php echo form_label($this->lang->line('login_username').':', 'username',array('class'=>'')); ?>
	<div class='form_field'>
	<?php  echo form_label($user_info->username, '',array('class'=>'report_value'));   ?>
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
$js = 'id="'.$module->module_id.'" disabled';
 echo form_checkbox("permissions[]",$module->module_id,$this->User->has_permission($module->module_id,$user_info->user_id),$js); ?>
<label for="<?php echo $module->module_id ?>"></label>
<span class="medium"><?php echo $this->lang->line('module_'.$module->module_id);?>:</span>
<span class="small"><?php echo $this->lang->line('module_'.$module->module_id.'_desc');?></span>
</li>
<?php
}
?>
</ul>
 
</fieldset>
 