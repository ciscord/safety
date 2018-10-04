<?php
   defined('BASEPATH') OR exit('No direct script access allowed');
   ?>
 
      <!-- Content Wrapper. Contains page content -->
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
            <div id="page_title"><?php echo $this->lang->line('module_config'); ?></div>
            <?php
               echo form_open('config/save/',array('id'=>'config_form'));
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
                        <div class="form-group">
                           <?php echo form_label($this->lang->line('config_company').':', 'company',array('class'=>'col-sm-5 control-label required required')); ?>
                           <div class='col-sm-7'>
                              <?php echo form_input(array(
                                 'name'=>'company',
                                 'id'=>'company',
                                 'class'=>'form-control', 
                                 'value'=>$this->config->item('company')));?>
                           </div>
                        </div>
                        <div class="form-group">
                           <?php echo form_label($this->lang->line('config_phone').':', 'phone',array('class'=>'col-sm-5 control-label required required')); ?>
                           <div class='col-sm-7'>
                              <?php echo form_input(array(
                                 'name'=>'phone',
                                 'id'=>'phone',
                                 'class'=>'form-control', 
                                 'value'=>$this->config->item('phone')));?>
                           </div>
                        </div>
                        <div class="form-group">
                           <?php echo form_label($this->lang->line('common_email').':', 'email',array('class'=>'col-sm-5 control-label required')); ?>
                           <div class='col-sm-7'>
                              <?php echo form_input(array(
                                 'name'=>'email',
                                 'id'=>'email',
                                 'class'=>'form-control', 
                                 'value'=>$this->config->item('email')));?>
                           </div>
                        </div>
						
						 <div class="form-group"  >
                           <?php echo form_label($this->lang->line('config_logo').':', 'logo',array('class'=>'col-sm-5 control-label')); ?>
                           <div class='col-sm-7'>
                               <?php echo anchor("config/config/edit_logo/width:650", $this->lang->line('common_edit'),array('class'=>'thickbox','title'=>$this->lang->line('config_logo_desc'))); ?>
                           </div>
                        </div>
						
						
                        <div class="form-group"  >
                           <?php echo form_label($this->lang->line('config_website').':', 'website',array('class'=>'col-sm-5 control-label')); ?>
                           <div class='col-sm-7'>
                              <?php echo form_input(array(
                                 'name'=>'website',
                                 'id'=>'website',
                                 'class'=>'form-control', 
                                 'value'=>$this->config->item('website')));?>
                           </div>
                        </div>
						
						 <div class="form-group"  >
                           <?php echo form_label($this->lang->line('config_pagination').':', 'pagination',array('class'=>'col-sm-5 control-label')); ?>
                           <div class='col-sm-7'>
                              <?php echo form_input(array(
                                 'name'=>'pagination_limit',
                                 'id'=>'pagination_limit',
                                 'class'=>'form-control', 
                                 'value'=>$this->config->item('pagination_limit')));?> <span class="info-small" >(<?php echo $this->lang->line('config_pagination_desc');?>)</span>
                           </div><br>
                        </div>
						
		

                        <div class="form-group">
                           <?php echo form_label($this->lang->line('config_language').':', 'language',array('class'=>'col-sm-5 control-label')); ?>
                           <div class='col-sm-7'>
                              <?php
                                 $js = 'style="width:180px"';
                                 echo form_dropdown('language', array(
                                 'english'  => 'English'
                                 ), $this->config->item('language'),$js );
                                 ?>
                           </div>
                        </div>
						
										<div class="form-group  radio_option">
  
   <?php echo form_label($this->lang->line('config_confirm_mail_status').':', 'profile_status',array('class'=>'col-sm-5 control-label')); ?>
   <div class='col-sm-7'   style="display:inline">
      <?php
         $_status=$this->config->item('reg_mail_send');
              if($_status==1)
           {
         $data = array(
           'name'        => '_status',
           'id'        => 'status1',
           'value'       => '0',
           );
         
         $data2 = array(
           'name'        => '_status',
           'id'        => 'status2',
           'value'       => '1',
         'checked'     => TRUE,
           );
         
         }
         else  if($_status==0)
         {
         $data = array(
           'name'        => '_status',
           'id'        => 'status1',
           'value'       => '0',
           'checked'     => TRUE,
           );
         
         $data2 = array(
           'name'        => '_status',
           'id'        => 'status2',
           'value'       => '1',
           );
         
         }
         
         echo "".form_radio($data)."<label for='status1' class='profile_status'>".$this->lang->line('profiles_active')."</label> ";
         echo "".form_radio($data2)."<label for='status2'  class='profile_status'>".$this->lang->line('profiles_deactivated')."</label> ";
         ?>
   </div>
</div>


						<div class="form-group">
                           <?php echo form_label($this->lang->line('config_address').':', 'address',array('class'=>'col-sm-5 control-label')); ?>
                           <div class='col-sm-7'>
                              <?php echo form_textarea(array(
                                 'name'=>'address',
                                 'id'=>'address',
                                 'rows'=>4,
                                 'cols'=>27,
                                 'value'=>$this->config->item('address')));?>
                           </div>
                        </div>
                  
 

						<div  class="social-data-toggle"  >
						<a href="javascript:void(0)"   class="collapsed" data-toggle="collapse" data-target="#social_wrapper"><h4 class="social_header" ><?php echo  $this->lang->line('config_social_login'); ?></h4>
					   <h4    class="social-button" ></h4></a>
					   </div>
						 <div  id="social_wrapper" class="collapse"  >
						<h4><?php echo  $this->lang->line('config_facebook'); ?></h4>
									<div class="form-group  radio_option">
  
   <?php echo form_label($this->lang->line('config_enable_facebook_login').':', 'facebook_status',array('class'=>'col-sm-5 control-label')); ?>
   <div class='col-sm-7 '   style="display:inline" >
      <?php
         $fb_staus=$this->config->item('facebook_login');
              if($fb_staus==1) //Deactivated
           {
         $data = array(
           'name'        => 'fb_status',
           'id'        => 'fb_status1',
           'value'       => '0',
           'data-toggle' => 'collapse',
           'data-target' => '#fb_app_data',
           );
         
         $data2 = array(
           'name'        => 'fb_status',
           'id'        => 'fb_status2',
           'value'       => '1',
           'checked'     => TRUE,
		   'data-toggle' => 'collapse',
           'data-target' => '#fb_app_data',
           );
         
         }
         else  if($fb_staus==0)
         {
         $data = array(
           'name'        => 'fb_status',
           'id'        => 'fb_status1',
           'value'       => '0',
           'checked'     => TRUE,
		   'data-toggle' => 'collapse',
           'data-target' => '#fb_app_data',
           );
         
         $data2 = array(
           'name'        => 'fb_status',
           'id'        => 'fb_status2',
           'value'       => '1',
		   'data-toggle' => 'collapse',
           'data-target' => '#fb_app_data',
           );
         
         }
         
         echo "".form_radio($data)."<label for='fb_status1'  >".$this->lang->line('config_active')."</label> ";
         echo "".form_radio($data2)."<label for='fb_status2'  >".$this->lang->line('config_deactivated')."</label> ";
         ?>
		 
		 <div  class="social_login collapse <?php if($fb_staus==0) echo "in"; ?>" id="fb_app_data"  >
 
		  <?php echo form_label($this->lang->line('config_appid')); ?>
		  <?php echo form_input(array(
                                 'name'=>'facebook_appid',
                                 'id'=>'facebook_appid',
                                 'class'=>'form-control', 
                                 'value'=>$this->config->item('facebook_appid')));?>
								  <br>
	       <?php echo form_label($this->lang->line('config_secret')); ?>
		   <?php echo form_password(array(
                                 'name'=>'facebook_secret',
                                 'id'=>'facebook_secret',
                                 'class'=>'form-control', 
                                 'value'=>$this->config->item('facebook_secret')));?>
								 
         </div>
   </div>
</div>

<h4><?php echo  $this->lang->line('config_twitter'); ?></h4>
									<div class="form-group  radio_option">
  
   <?php echo form_label($this->lang->line('config_enable_twitter_login').':', 'facebook_status',array('class'=>'col-sm-5 control-label')); ?>
   <div class='col-sm-7 '    style="display:inline"  >
      <?php
         $twitter_status=$this->config->item('twitter_login');
              if($twitter_status==1)
           {
         $data = array(
           'name'        => 'twitter_status',
           'id'        => 'twitter_status1',
           'value'       => '0',
		   'data-toggle' => 'collapse',
           'data-target' => '#twitter_app_data',
           );
         
         $data2 = array(
           'name'        => 'twitter_status',
           'id'        => 'twitter_status2',
           'value'       => '1',
           'checked'     => TRUE,
		   'data-toggle' => 'collapse',
           'data-target' => '#twitter_app_data',
           );
         
         }
         else  if($twitter_status==0)
         {
         $data = array(
           'name'        => 'twitter_status',
           'id'        => 'twitter_status1',
           'value'       => '0',
           'checked'     => TRUE,
		   'data-toggle' => 'collapse',
           'data-target' => '#twitter_app_data',
           );
         
         $data2 = array(
           'name'        => 'twitter_status',
           'id'        => 'twitter_status2',
           'value'       => '1',
		   'data-toggle' => 'collapse',
           'data-target' => '#twitter_app_data',
           );
         
         }
         
         echo "".form_radio($data)."<label for='twitter_status1'  >".$this->lang->line('config_active')."</label> ";
         echo "".form_radio($data2)."<label for='twitter_status2'  >".$this->lang->line('config_deactivated')."</label> ";
         ?>
		 
		 <div  class="social_login collapse <?php if($twitter_status==0) echo "in"; ?>" id="twitter_app_data"  >
 
		  <?php echo form_label($this->lang->line('config_appid')); ?>
		  <?php echo form_input(array(
                                 'name'=>'twitter_appid',
                                 'id'=>'twitter_appid',
                                 'class'=>'form-control', 
                                 'value'=>$this->config->item('twitter_appid')));?>
								  <br>
	       <?php echo form_label($this->lang->line('config_secret')); ?>
		   <?php echo form_password(array(
                                 'name'=>'twitter_secret',
                                 'id'=>'twitter_secret',
                                 'class'=>'form-control', 
                                 'value'=>$this->config->item('twitter_secret')));?>
								 
         </div>
   </div>
</div>


<h4><?php echo  $this->lang->line('config_google'); ?></h4>
									<div class="form-group  radio_option">
  
   <?php echo form_label($this->lang->line('config_enable_google_login').':', 'google_status',array('class'=>'col-sm-5 control-label')); ?>
   <div class='col-sm-7 '   style="display:inline"   >
      <?php
         $google_status=$this->config->item('google_login');
              if($google_status==1)
           {
         $data = array(
           'name'        => 'google_status',
           'id'        => 'google_status1',
           'value'       => '0',
		   'data-toggle' => 'collapse',
           'data-target' => '#google_app_data',
           );
         
         $data2 = array(
           'name'        => 'google_status',
           'id'        => 'google_status2',
           'value'       => '1',
           'checked'     => TRUE,
		   'data-toggle' => 'collapse',
           'data-target' => '#google_app_data',
           );
         
         }
         else  if($google_status==0)
         {
         $data = array(
           'name'        => 'google_status',
           'id'        => 'google_status1',
           'value'       => '0',
           'checked'     => TRUE,
		   'data-toggle' => 'collapse',
           'data-target' => '#google_app_data',
           );
         
         $data2 = array(
           'name'        => 'google_status',
           'id'        => 'google_status2',
           'value'       => '1',
		   'data-toggle' => 'collapse',
           'data-target' => '#google_app_data',
           );
         
         }
         
         echo "".form_radio($data)."<label for='google_status1'  >".$this->lang->line('config_active')."</label> ";
         echo "".form_radio($data2)."<label for='google_status2'  >".$this->lang->line('config_deactivated')."</label> ";
         ?>
		 
		 <div  class="social_login collapse <?php if($google_status==0) echo "in"; ?>"  id="google_app_data" >
 
		  <?php echo form_label($this->lang->line('config_appid')); ?>
		  <?php echo form_input(array(
                                 'name'=>'google_appid',
                                 'id'=>'google_appid',
                                 'class'=>'form-control', 
                                 'value'=>$this->config->item('google_appid')));?>
								  <br>
	       <?php echo form_label($this->lang->line('config_secret')); ?>
		   <?php echo form_password(array(
                                 'name'=>'google_secret',
                                 'id'=>'google_secret',
                                 'class'=>'form-control', 
                                 'value'=>$this->config->item('google_secret')));?>
								 
         </div>
   </div>
</div>
</div>


                        <hr style="width:95%">
                        <br>
                        <?php 
                           echo form_submit(array(
                           	'name'=>'submit',
                           	'id'=>'submit',
                           	'value'=>$this->lang->line('common_submit'),
                           	'class'=>'submit_button float_right')
                           );
                           ?>
                     </div>
                  </div>
               </fieldset>
            </div>
            <?php
               echo form_close();
               ?>
<script>
$(document).ready(function(){
	  $(".social-button").html('<i class="fa fa-arrow-circle-down" aria-hidden="true"></i> ');
  $("#demo").on("hide.bs.collapse", function(){
    $(".social-button").html('<i class="fa fa-arrow-circle-down" aria-hidden="true"></i> ');
  });
  $("#demo").on("show.bs.collapse", function(){
    $(".social-button").html('<i class="fa fa-arrow-circle-up" aria-hidden="true"></i> ');
  });
});
</script>
            <script type='text/javascript'>
             
  $(document).ready(function() {
      $('#config_form').validate({    //validation and submit handling
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
 
 
			   company:
      			{
      				required:true,
      				minlength: 1,
      				maxlength: 250
      			},
      			
      			phone:
      			{
      				required:true,
      				maxlength: 250
      			},	
				email:
      			{
      				required:true,
					email:email,
					maxlength: 250

      			},
				website:
      			{
      				url:true,
					maxlength: 250

      			},
				mail_server:
      			{
					maxlength: 250

      			},
				address:
      			{
					maxlength: 2000

      			},
          },
          messages: {
 
			   
      			company:
           		{
           			required: "<?php echo $this->lang->line('config_company_required'); ?>",
           			maxlength: "<?php echo $this->lang->line('config_company_maxlength'); ?>"
           		},
           		
      			phone_number:
      			{
      				maxlength: "<?php echo $this->lang->line('profiles_phone_number_maxlength'); ?>"
           		},
				
				email:
           		{
           			required: "<?php echo $this->lang->line('profiles_email_required'); ?>",
           			email: "<?php echo $this->lang->line('common_email_invalid_format'); ?>",
					maxlength: "<?php echo $this->lang->line('profiles_email_maxlength'); ?>"
           		},
      			 
				website:
           		{
					url: "<?php echo $this->lang->line('config_company_website_url'); ?>",
					maxlength: "<?php echo $this->lang->line('config_company_website_maxlength'); ?>"
           		},
			    mail_server:
           		{
					maxlength: "<?php echo $this->lang->line('config_mail_server_maxlength'); ?>"
           		},
			    address:
      			{
      				maxlength: "<?php echo $this->lang->line('profiles_address_maxlength'); ?>"
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
                  //update_row(response.user_id,'<?php echo site_url("$controller_name/get_row")?>');
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
      