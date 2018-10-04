<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div id="required_fields_message"><?php echo $this->lang->line('common_fields_required_message'); ?></div>
<fieldset >
<legend><?php echo $this->lang->line("profiles_login_info"); ?></legend>
<?php
echo form_open('users/users/save_password/'.$user_info->user_id,array('id'=>'login_form'));
?>
<ul id="popup_error_message_box"></ul>	
<div id="user_login_info">

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
<?php echo form_label($this->lang->line('profiles_new_password').':', 'password',array('class'=>'required wide')); ?>
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

 </div>
 
<div id="login_info_submit"  >
<?php echo form_label($this->lang->line('profiles_edit_user_login').'', 'username',array('class'=>'required wide')); ?>
<div class="field_row clearfix">	

	<div class='form_field'>
	<?php echo form_password(array(
		'name'=>'current_password',
		'id'=>'current_password',
		));?>
	</div>
</div>

<?php
echo form_submit(array(
	'name'=>'submit',
	'id'=>'submit',
	'value'=>$this->lang->line('common_submit'),
	'class'=>'submit_button float_right')
);

?>
</div>
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
    $("#login_submit").on("click", function() {
        $("#user_login_info").fadeOut(500);
        setTimeout(
            function() {
                $("#login_info_submit").fadeIn(500);
            }, 500);
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
                        document.getElementById("submit").value = "<?php echo $this->lang->line('common_submit'); ?>";
                        document.getElementById("submit").disabled = false;
                        post_person_form_submit(response);
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
                minlength: 5
            },
            password: {
                required: true,
                minlength: 8
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
                minlength: "<?php echo $this->lang->line('login_username_minlength'); ?>"
            },
            password: {
                required: "<?php echo $this->lang->line('login_password_required'); ?>",
                minlength: "<?php echo $this->lang->line('login_password_minlength'); ?>"
            },
            repeat_password: {
                equalTo: "<?php echo $this->lang->line('login_password_must_match'); ?>"
            }
        }
    });
});
</script>