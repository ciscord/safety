<?php
   defined('BASEPATH') OR exit('No direct script access allowed');
   ?>
      <!-- Main content -->
      <div class="row">
         <div class="col-md-12">
            <div class="box box-danger login_form" >
               <div class="box-header with-border">
                  <h3 class="box-title"><?php  echo $this->lang->line('login_forget');  ?> </h3>
                  <a   href="<?php echo site_url("login"); ?>"  class="pull-right"><?php echo $this->lang->line('login_login')  ?>  </a>	
               </div>
               <!-- /.box-header -->
               <!-- form start -->
               <?php  echo  form_open('login/reset_forgot_password') ?>
               <?php echo validation_errors(); ?>
               <div class="box-body">
                  <div class="form-group">
                     <label class="col-sm-2 "><?php echo $this->lang->line('profiles_email'); ?></label>
                     <div class="col-sm-10">
                        <?php echo form_input(array(
                           'name'=>'email', 
                           'class'=>'form-control', 
                           'placeholder'=>'email'
                            )); ?> 
                     </div>
                  </div>
               </div>
               <!-- /.box-body -->
               <div class="box-footer">
                  <?php echo 
                     form_submit(array(
                     'name'=>'loginButton', 
                     'class'=>'btn btn-danger pull-right', 
                     'id'=>'submit',
                     'name'=>'submit',
                     'value'=>$this->lang->line('login_password_send')));
                      ?>
               </div>
               <?php echo form_close(); ?>
            </div>
         </div>
      </div>
    