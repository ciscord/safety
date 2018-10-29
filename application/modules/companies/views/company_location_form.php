
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
    <section class="content-header">
        <div id="page_title">
            <?php  echo $this->lang->line("common_location");
            echo str_repeat('&nbsp;', 3);
            $title = ($location_id == -1) ? $this->lang->line("common_add") : $this->lang->line("common_edit");

            echo $title;?> 
        </div>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-tachometer-alt"></i> <?php  echo $this->lang->line("common_home");?></a></li>
            <li class="active"><?php  echo $this->lang->line("common_companies");?></li>
            <li class="active"> <?php 
                echo $title;
            ?></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
    
    <?php
        echo form_open('companies/addlocation' ,array('id'=>'add_user_form'));
    ?>
     <input type="hidden" id="location_id" name="location_id" value=<?php echo $location_id?>>

    <div class="row">
        <div class="col-lg-8 col-sm-8">        
            <div class="row">
                <div class="col-lg-6 col-sm-6">        
                    <div class='form-group'>
                    <?php echo form_label($this->lang->line('common_name').'*', 'location_name',array('class'=>'wide')); ?>
                        <?php echo form_input(array(
                            'name'=>'location_name',
                            'class' => 'form-control',
                            'id'=>'location_name',
                            'value'=>$location_info->location_name));?>
                    </div>
                </div>

                <div class="col-lg-6 col-sm-6">                
                    <div class='form-group'>
                    <?php echo form_label($this->lang->line('common_company').'*', 'company',array('class'=>'wide')); ?>
                        <?php 
                        $options = array();

                        foreach ($companies->result() as $data_row) {
                            $options[$data_row->company_id]  = $data_row->name ;
                        }
                        
                        $js = 'id="shirts" class="form-control" ';

                        echo form_dropdown('company', $options, $location_info->location_company_id, $js);
                        ?>
                    </div>
                    
                </div>
            </div>

            <!-- second row -->
            <div class="row">
                <div class="col-lg-6 col-sm-6">        
                    <div class='form-group'>
                    <?php echo form_label($this->lang->line('common_address').'*', 'location_address',array('class'=>'wide')); ?>
                        <?php echo form_input(array(
                            'name'=>'location_address',
                            'class' => 'form-control',
                            'id'=>'location_address',
                            'value'=>$location_info->location_address));?>
                    </div>
                </div>

                <div class="col-lg-6 col-sm-6">        
                    <div class='form-group'>
                    <?php echo form_label($this->lang->line('common_address_2').'*', 'location_address2',array('class'=>'wide')); ?>
                        <?php echo form_input(array(
                            'name'=>'location_address2',
                            'class' => 'form-control',
                            'id'=>'location_address2',
                            'value'=>$location_info->location_address2));?>
                    </div>
                </div>
            </div>

            <!-- third row -->
            <div class="row">
                <div class="col-lg-4 col-sm-4">                
                    <div class='form-group'>
                    <?php echo form_label($this->lang->line('profiles_city'), 'location_city',array('class'=>'wide')); ?>
                        <?php echo form_input(array(
                            'name'=>'location_city',
                            'class' => 'form-control',
                            'id'=>'location_city',
                            'value'=>$location_info->location_city));?>
                    </div>
                    
                </div>

                <div class="col-lg-2 col-sm-2">                
                    <div class='form-group'>
                    <?php echo form_label($this->lang->line('profiles_state'), 'location_state',array('class'=>'wide')); ?>
                        <?php echo form_input(array(
                            'name'=>'location_state',
                            'class' => 'form-control',
                            'id'=>'location_state',
                            'value'=>$location_info->location_state));?>
                    </div>
                    
                </div>

                <div class="col-lg-2 col-sm-2">                
                    <div class='form-group'>
                    <?php echo form_label($this->lang->line('profiles_zip'), 'location_zip',array('class'=>'wide')); ?>
                        <?php echo form_input(array(
                            'name'=>'location_zip',
                            'class' => 'form-control',
                            'id'=>'location_zip',
                            'value'=>$location_info->location_zip));?>
                    </div>
                    
                </div>

                <div class="col-lg-2 col-sm-2">                
                    <div class='form-group'>
                    <?php echo form_label($this->lang->line('common_latitude'), 'latitude',array('class'=>'wide')); ?>
                        <?php echo form_input(array(
                            'name'=>'latitude',
                            'class' => 'form-control',
                            'id'=>'latitude',
                            'value'=>$location_info->latitude));?>
                    </div>
                    
                </div>

                <div class="col-lg-2 col-sm-2">                
                    <div class='form-group'>
                    <?php echo form_label($this->lang->line('common_longitude'), 'longitude',array('class'=>'wide')); ?>
                        <?php echo form_input(array(
                            'name'=>'longitude',
                            'class' => 'form-control',
                            'id'=>'longitude',
                            'value'=>$location_info->longitude));?>
                    </div>
                    
                </div>

            </div>
            <!-- // assign users -->
            <div class="row">
                <div class="col-lg-12 col-sm-12">                
                  
                    <div class="form-group">

                        <?php echo form_label($this->lang->line('common_assign_users'), 'location_city',array('class'=>'wide')); ?>
                        <div class="controls">
                            <select name="categoryid[]" multiple="multiple" id="categoryid" class="form-control">                              
                            <?php 
                            $options = array();
                            $selected = false;    
                            $selectedUsers = array();    
                            foreach ($companyusers->result() as $data_row) {
                                array_push($options, $data_row);//->user_id]  = $data_row->first_name.' '. $data_row->last_name;
                            }
                            foreach($options as $companyuser):?>                                              
                                <?php $selected = in_array($companyuser->user_id, $selectedUsers) ? " selected " : null;?>
                                    <option value="<?=$companyuser->user_id?>"
                                        <?=$selected?> ><?=$companyuser->first_name.' '.$companyuser->last_name?>
                                    </option>                              
                            <?php endforeach?>
                            </select>                                           
                        </div>
                    </div>  
                    
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-sm-4">                
            <!-- map -->
        </div>
                         

    </div>

    <div id="new_button">
    <?php
        $buttonTitle = ($location_id == -1) ? $this->lang->line('profiles_submit') : $this->lang->line('common_update');
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
$(document).ready(function() {
        $('#example-getting-started').multiselect();
    });
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