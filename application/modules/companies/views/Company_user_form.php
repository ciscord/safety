
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
    <section class="content-header">
        <div id="page_title">
            <?php  echo $this->lang->line("common_user");
            echo str_repeat('&nbsp;', 3);
            $title = ($user_id == -1) ? $this->lang->line("common_add") : $this->lang->line("common_edit");

            echo $title;?> 
        </div>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-tachometer-alt"></i> <?php  echo $this->lang->line("common_home");?></a></li>
            <li class="active"><?php  echo $this->lang->line("common_company");?></li>
            <li class="active"> <?php 
                echo $title;
            ?></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
    
    <?php
        echo form_open('users/users/addadmin' ,array('id'=>'add_user_form'));
    ?>
     <input type="hidden" id="user_id" name="user_id" value=<?php echo $user_id?>>

    <div class="row">
        <div class="col-lg-4 col-sm-4">                
            <div class='form-group'>
            <?php echo form_label($this->lang->line('profiles_first_name').'*', 'first_name',array('class'=>'wide')); ?>
                <?php echo form_input(array(
                    'name'=>'first_name',
                    'class' => 'form-control',
                    'id'=>'first_name',
                    'value'=>$user_info->first_name));?>
            </div>
            
        </div>

        <div class="col-lg-4 col-sm-4">                
            <div class='form-group'>
            <?php echo form_label($this->lang->line('profiles_last_name').'*', 'last_name',array('class'=>'wide')); ?>
                <?php echo form_input(array(
                    'name'=>'last_name',
                    'class' => 'form-control',
                    'id'=>'last_name',
                    'value'=>$user_info->last_name));?>
            </div>
            
        </div>

        <div class="col-lg-4 col-sm-4">                
            <div class='form-group'>
            <?php echo form_label($this->lang->line('common_company').'*', 'company',array('class'=>'wide')); ?>
                <?php 
                $options = array();

                foreach ($companies->result() as $data_row) {
                    $options[$data_row->company_id]  = $data_row->name ;
                }
                
                $js = 'id="shirts" class="form-control" ';

                echo form_dropdown('company', $options, $user_info->user_company_id, $js);
                ?>
            </div>
            
        </div>

    </div>

    <div class="row">
        <div class="col-lg-4 col-sm-4">                
            <div class='form-group'>
            <?php echo form_label($this->lang->line('profiles_phone').'*', 'phone_number',array('class'=>'wide')); ?>
                <?php echo form_input(array(
                    'name'=>'phone_number',
                    'class' => 'form-control',
                    'id'=>'phone_number',
                    'value'=>$user_info->phone_number));?>
            </div>
            
        </div>

        <div class="col-lg-4 col-sm-4">                
            <div class='form-group'>
            <?php echo form_label($this->lang->line('profiles_email').'*', 'email',array('class'=>'wide')); ?>
                <?php echo form_input(array(
                    'name'=>'email',
                    'class' => 'form-control',
                    'id'=>'email',
                    'value'=>$user_info->email));?>
            </div>
            
        </div>

        <div class="col-lg-4 col-sm-4">                
            <div class='form-group'>
            <?php echo form_label($this->lang->line('profiles_user_level').'*', 'userlevel',array('class'=>'wide')); ?>
                <?php 
                $options = array();
                $options['2'] = "Owner";
                $options['3'] = "Manager";
                $options['4'] = "Technician/Engineer";

                $js = 'id="userlevel" class="form-control" ';

                echo form_dropdown('userlevel', $options, $user_info->user_level, $js);
                ?>
            </div>
            
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4 col-sm-4">                
            <div class='form-group'>
            <?php echo form_label($this->lang->line('login_password').'*', 'password',array('class'=>'wide')); ?>
                <?php echo form_password(array(
                    'name'=>'password',
                    'class' => 'form-control',
                    'id'=>'password'
                ));?>
            </div>
            
        </div>

        <div class="col-lg-4 col-sm-4">                
            <div class='form-group'>
            <?php echo form_label($this->lang->line('confirmpassword').'*', 'repeat_password',array('class'=>'wide')); ?>
                <?php echo form_password(array(
                    'name'=>'repeat_password',
                    'class' => 'form-control',
                    'id'=>'repeat_password'
                ));?>
            </div>
            
        </div>

        <div class="col-lg-4 col-sm-4">                
            <div class='form-group'>
            <?php echo form_label($this->lang->line('profile_assign_location').'*', 'assign_location',array('class'=>'wide')); ?>
            <?php echo form_input(array(
                    'name'=>'assign_location',
                    'class' => 'form-control',
                    'id'=>'assign_location',
                    'value'=>$user_info->address));?>
            </div>
            
        </div>
    </div>

    <div id="new_button">
    <?php
        $buttonTitle = ($user_id == -1) ? $this->lang->line('profiles_submit') : $this->lang->line('common_update');
        echo form_submit(array(
            'name'=>'submit',
            'id'=>'submit',
            'value'=> $buttonTitle,
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
      				minlength: 3,
      				maxlength: 250
      			},
      			
      			password:
      			{
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