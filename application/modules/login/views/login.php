<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
 
      <!-- Main content -->
      <div class="row">
         <div class="col-md-12">
            <div class="box box-danger login_form" >
               <div class="box-header with-border">
                  <h3 class="box-title"><?php $this->lang->line('login_login');  ?> </h3>    <a   href="<?php echo site_url("login/forget_password"); ?>"  class="pull-right"><?php echo $this->lang->line('login_forget');  ?></a>	
				  <a  href="<?php echo site_url("login/user_register"); ?>"  class="pull-left" ><?php echo $this->lang->line('login_register'); ?> </a>
               </div>
               <!-- /.box-header -->
               <!-- form start -->
               <?php echo form_open('login',array('id'=>'login_form'));  ?>
               <?php echo validation_errors(); ?>
			   <?php echo "<h5 align='center' style='color: #DA1111;'>".$error_messages."</h5>"; ?>
               <div class="box-body">
			    <ul id="error_message_box"></ul>
                  <div class="form-group">
                     <label class="col-sm-2 "><?php echo $this->lang->line('login_username');  ?></label>
                     <div class="col-sm-10">
                        <?php echo form_input(array(
                           'name'=>'username', 
                           'class'=>'form-control', 
                           'placeholder'=>'Username or Email',
                           'size'=>'20')); ?> 
                     </div>
                  </div>
                  <div class="form-group">
                     <label   class="col-sm-2"><?php echo $this->lang->line('login_password');  ?></label>
                     <div class="col-sm-10">
                        <?php echo form_password(array(
                           'name'=>'password', 
                           'class'=>'form-control', 
                           'placeholder'=>'Password',
                           'size'=>'20')); ?>
                     </div>
                  </div>
                  <div class="form-group remember-me">
                     <div class="col-sm-offset-2 col-sm-10">
                        <div class="checkbox">
                           <input type="checkbox" id="remember_me" name="remember_me" value="7" class="filled-in">
                           <label for='remember_me'></label>	<span> <?php echo $this->lang->line('login_remember_me');  ?></span>	
                        </div>
                     </div>
                  </div>
				  
				  						  
				  
				   
				  
               </div>
               <!-- /.box-body -->
               <div class="box-footer">
                  <?php echo 
                     form_submit(array(
                     'name'=>'loginButton', 
                     'class'=>'btn btn-danger', 
                     'id'=>'submit',
                     'name'=>'submit',
                     'style'=>'width:100%;',
                     'value'=>$this->lang->line('login_login')));
                      ?>
					   
               </div>
			  
               <?php echo form_close(); ?>
    
 <?php 

 $count=0;
 $rows=4;
 if($this->config->item('twitter_login')==0 ) //Check if twitter enabled
 {
	 $count++;
 }
 if ($this->config->item('facebook_login')==0) //Check if facebook enabled
 {
	 $count++;
 }
 if ($this->config->item('google_login')==0) //Check if google enabled
 {
	 $count++;
 }
$rows = ($count == 1 ? 12 : $rows);
$rows = ($count == 2 ? 6 : $rows);
$rows = ($count == 3 ? 4 : $rows);
		 if($count>0)
		 {
			 echo  "<h5 align='center'>OR</h5>";
		 }
 ?>
			<div class="row social-buttons">
			 
         
		 <?php  if($this->config->item('twitter_login')==0 )
            {
			 echo  "<div class='col-md-$rows'><a class='btn btn-block btn-social btn-twitter' href='".base_url('login/social_login/Twitter')."'>
             <span class='fa fa-twitter'></span>Twitter</a></div>";		
			}
			if($this->config->item('facebook_login')==0 && $this->config->item('facebook_appid')!="" && $this->config->item('facebook_secret')!="" )
			{   
            require_once (Hybrid_Auth::$config["path_libraries"] . "Facebook/php-graph-sdk-5.0.0/src/Facebook/autoload.php");
            $fb = new Facebook\Facebook([
            'app_id' => $this->config->item('facebook_appid'),
            'app_secret' =>  $this->config->item('facebook_secret'),
            'default_graph_version' => 'v2.5',
            ]);
             

           $helper = $fb->getRedirectLoginHelper();
           $url=site_url('login/facebook_login');
           $loginUrl = $helper->getLoginUrl($url);

				 echo  "<div class='col-md-$rows'><a class='btn btn-block btn-social btn-facebook' href='".$loginUrl."'>
    <span class='fa fa-facebook'></span>Facebook</a></div>";		
                
                
			}
			if($this->config->item('google_login')==0)
			{
				 echo  "<div class='col-md-$rows'><a class='btn btn-block btn-social btn-google' href='".base_url('login/social_login/Google')."'>
    <span class='fa fa-google'></span>Google</a></div>";		
			}
  ?>
  
 </div>

   

  
  </div>

  </div>
				 
         </div>
     
   
   <script type='text/javascript'>
$(document).ready(function()
    {
	   	'use strict';
		
         
       $('#login_form').validate({
      		submitHandler:function(form)
      		{ 
			
				 
      			$(form).ajaxSubmit({
					
      			success:function(response)
      			{
      			
      				var str = response.message;
                    var res = str.replace(/\\n/g, "\n");
      		        jAlert(res, 'Confirmation Dialog', function(r) {
 
				
					
                    });
      			
      			},
      			dataType:'json'
      		});
      
      		},
      		errorLabelContainer: "#error_message_box",
       		wrapper: "li",
      		rules: 
      		{
      		 
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
      			}
      			 
         	},
      		messages: 
      		{
      		
           		
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
      			}
      		}
      	});
      });
   </script>
 