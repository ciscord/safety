<?php
   defined('BASEPATH') OR exit('No direct script access allowed');
   ?>
 
      <div class="content-wrapper">
         <!-- Content Header (Page header) -->
         <section class="content-header">
            <h1>
               <br>
               <small><br></small>
            </h1>
         </section>
         <!-- Main content -->
         <section class="content">
            <!--     custom  content   -->																						
            <div id="page_title"><?php echo $this->lang->line('profiles_Info'); ?></div>
            <?php
               echo form_open('users/profiles/save/'.$user_id,array('id'=>'config_form'));
               ?>
            <?php echo validation_errors(); ?>
            <div id="config_wrapper">
               <fieldset id="config_info">
                  <div class="col-md-12 user_profile">
                     <div class="box box-info profile_form"  >
                        <div id="required_fields_message"><?php echo $this->lang->line('common_fields_required_message'); ?></div>
                        <br>
                        <br>
                        <ul id="error_message_box"></ul>
						  <div class="field_row clearfix profile-avatar-container" >	

<img class="profile-avatar" id="profile_avatar"  src="<?php
$image_name=$user_info->profile_image;
$default_image_name="default.png";
$upload_path=site_url("uploads");
if($image_name!="")
 echo $upload_path."/".$image_name;
else
echo $upload_path."/".$default_image_name;
 ?>?<?php echo time();//to prevent browser image caching ?>" alt="profile avatar" height="150" >

</div>
 
 
                        <div class="form-group">
                           <?php echo form_label($this->lang->line('profiles_first_name').':', 'first_name',array('class'=>'col-sm-5 control-label required')); ?>
                           <div class='col-sm-7'>
                              <?php echo form_input(array(
                                 'name'=>'first_name',
                                 'id'=>'first_name',
                                 'class'=>'form-control', 
                                 'value'=>$user_info->first_name
                                 ));?>
                           </div>
                        </div>
                        <div class="form-group">
                           <?php echo form_label($this->lang->line('profiles_last_name').':', 'last_name',array('class'=>'col-sm-5 control-label')); ?>
                           <div class='col-sm-7'>
                              <?php echo form_input(array(
                                 'name'=>'last_name',
                                 'id'=>'last_name',
                                 'class'=>'form-control', 
                                 'value'=>$user_info->last_name
                                 ));?>
                           </div>
                        </div>
						
						<div class="form-group">
                           <?php echo form_label($this->lang->line('profiles_avatar').':', 'last_name',array('class'=>'col-sm-5 control-label')); ?>
                           <div class='col-sm-7'>
                              <?php echo anchor("users/profiles/edit_profile_image/$user_id/width:620", $this->lang->line('profiles_edit_avatar'),array('class'=>'thickbox','title'=>$this->lang->line('profiles_edit_avatar')))?>
                           </div>
                        </div>
                        <div class="form-group">
                           <?php echo form_label($this->lang->line('profiles_edit_password').':', 'username',array('class'=>'col-sm-5 control-label')); ?>
                           <div class='col-sm-7'>
                              <?php echo anchor("users/profiles/change_password/$user_info->user_id/width:360", $this->lang->line('common_edit'),array('class'=>'thickbox','title'=>$this->lang->line('profiles_edit_password'))); ?>
                           </div>
                        </div>
                        <div class="form-group">
                           <?php echo form_label($this->lang->line('profiles_phone').':', 'phone_number',array('class'=>'col-sm-5 control-label')); ?>
                           <div class='col-sm-7'>
                              <?php echo form_input(array(
                                 'name'=>'phone_number',
                                 'id'=>'phone_number',
                                 'class'=>'form-control', 
                                 'value'=>$user_info->phone_number
                                 ));?>
                           </div>
                        </div>
                        <div class="form-group">
                           <?php echo form_label($this->lang->line('profiles_country').':', 'country',array('class'=>'col-sm-5 control-label')); ?>
                           <div class='col-sm-7 '>
                               <?php 
                        $attr=array('id'=>'country_list');
                        $query =$this->User->get_country_list();
						
						 foreach($query->result_array() as $row)
                         {
                            $country_data[$row['country_name']]=$row['country_code'];
                         }
				
                        echo form_dropdown('country',$country_data, $user_info->country_code, $attr);
                                 ?>
                              <input type="hidden" name="country_name" value="<?php echo $user_info->country_code; ?>" id="country_name" /> <!-- to get country name --->
                           </div>
                        </div>
                        <div class="form-group">
                           <?php echo form_label($this->lang->line('profiles_state').':', 'state',array('class'=>'col-sm-5 control-label ')); ?>
                           <div class='col-sm-7'>
                              <?php echo form_input(array(
                                 'name'=>'state',
                                 'id'=>'state',
                                 'class'=>'form-control', 
                                 'value'=>$user_info->state
                                 ));?>
                           </div>
                        </div>
                        <div class="form-group">
                           <?php echo form_label($this->lang->line('profiles_city').':', 'city',array('class'=>'col-sm-5 control-label ')); ?>
                           <div class='col-sm-7'>
                              <?php echo form_input(array(
                                 'name'=>'city',
                                 'id'=>'city',
                                 'class'=>'form-control', 
                                 'value'=>$user_info->city
                                 ));?>
                           </div>
                        </div>
                        <div class="form-group">
                           <?php echo form_label($this->lang->line('profiles_marital_status').':', 'website',array('class'=>'col-sm-5 control-label')); ?>
                           <div class='col-sm-7'>
                              <?php
                                 $marital_status=$user_info->marital_status;
                                      if($marital_status=="Single")
                                   {
                                 $data = array(
                                   'name'        => 'marital_status',
                                   'value'       => 'Single',
                                   'id'=>'option1',
                                 'checked'     => TRUE,
                                   );
                                 
                                 $data2 = array(
                                   'name'        => 'marital_status',
                                   'value'       => 'Married',
                                 'id'=>'option2',
                                   );
                                 }
                                 else
                                 {
                                 $data = array(
                                   'name'        => 'marital_status',
                                   'value'       => 'Single',
                                 'id'=>'option1',
                                   );
                                 
                                 $data2 = array(
                                   'name'        => 'marital_status',
                                   'value'       => 'Married',
                                 'id'=>'option2',
                                 'checked'     => TRUE,
                                   );
                                 }
                                 
                                 echo "".form_radio($data)."<label for='option1'>".$this->lang->line('profiles_single')."</label> ";;
                                 echo "".form_radio($data2)."<label for='option2'>".$this->lang->line('profiles_married')."</label> ";;
                                 ;?>
                           </div>
                        </div>
                        <div class="form-group">
                           <?php echo form_label($this->lang->line('profiles_dob').':', 'dob',array('class'=>' col-sm-5 control-label'));
                              $js = 'id="dobmonth" class="date_dropdown"';
                              $js = 'id="dobday" class="date_dropdown"';
                              $js = 'id="dobyear" class="date_dropdown"';
                               ?>
                           <div  class='col-sm-7'>
                              <?php echo form_dropdown('dobmonth',$dmonths, $dselected_month, $js); ?>
                              <?php echo form_dropdown('dobday',$ddays, $dselected_day, $js); ?>
                              <?php echo form_dropdown('dobyear',$dyears, $dselected_year, $js); ?>
                           </div>
                        </div>
                        <div class="form-group">
                           <?php echo form_label($this->lang->line('profiles_address').':', 'address',array('class'=>' col-sm-5 control-label')); ?>
                           <div class='col-sm-7'>
                              <?php echo form_textarea(array(
                                 'name'=>'address',
                                 'id'=>'address',
                                 'rows'=>'4',
                                 'cols'=>'27',
                                 'value'=>$user_info->address
                                 ));?>
                           </div>
                        </div>
                        <div class="form-group">
                           <?php echo form_label($this->lang->line('profiles_comments').':', 'comments',array('class'=>'col-sm-5 control-label')); ?>
                           <div class='col-sm-7'>
                              <?php echo form_textarea(array(
                                 'name'=>'comments',
                                 'id'=>'comments',
                                 'rows'=>'4',
                                 'cols'=>'27',
                                 'value'=>$user_info->comments
                                 ));?>
                           </div>
                        </div>
                        <div class="form-group">
                           <div class='col-sm-5'>
                           </div>
                           <div class='col-sm-7'>
                              <?php 
                                 echo form_submit(array(
                                 	'name'=>'submit',
                                 	'id'=>'submit',
                                 	'class'=>'btn btn-info pull-right', 
                                 	'value'=>$this->lang->line('common_submit'),
                                 	'class'=>'submit_button float_right')
                                 );
                                 ?>
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
     $("#country_list").on("change", function(event) {
         var country_name = $("#country_list option:selected").text();
         $("#country_name").val(country_name);
     });
     $('#config_form').validate({
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
                         post_form_submit(response);
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
           		} ,
				
            
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
      