
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
    <section class="content-header">
        <div id="page_title">
            <?php  echo $this->lang->line("common_company");
            echo str_repeat('&nbsp;', 3);
            $title = ($company_id == -1) ? $this->lang->line("common_add") : $this->lang->line("common_edit");

            echo $title;?> 
        </div>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-tachometer-alt"></i> Home</a></li>
            <li class="active"><?php echo $this->lang->line("module_companies") ?></li>
            <li class="active"> <?php 
                echo $title;
            ?></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
    
    <?php
        echo form_open('companies/companies/save/'.$company_id ,array('id'=>'add_company_form'));
    ?>
     <input type="hidden" id="company_id" name="company_id" value=<?php echo $company_id?>>

    <div class="row">
        <div class="col-lg-6 col-sm-6">                
            <div class='form-group'>
            <?php echo form_label($this->lang->line('profiles_company_name').'#*', 'company_name',array('class'=>'wide')); ?>
                <?php echo form_input(array(
                    'name'=>'company_name',
                    'class' => 'form-control',
                    'id'=>'company_name',
                    'disable' => "true",
                    'value'=>$company_info->name));?>
            </div>
            
        </div>

        <div class="col-lg-6 col-sm-6">                
            <div class='form-group'>
            <?php echo form_label($this->lang->line('profiles_numberof_users').'#*', 'number_of_users',array('class'=>'wide')); ?>
                <?php echo form_input(array(
                    'name'=>'number_of_users',
                    'class' => 'form-control',
                    'id'=>'number_of_users',
                    'readonly'=>TRUE,
                    'value'=>$company_info->number_of_users));?>
            </div>
            
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6 col-sm-6">                
            <div class='form-group'>
            <?php echo form_label($this->lang->line('profiles_contact')."&nbsp".$this->lang->line('profiles_first_name').'*', 'firstname',array('class'=>'wide')); ?>
                <?php echo form_input(array(
                    'name'=>'firstname',
                    'class' => 'form-control',
                    'id'=>'firstname',
                    'value'=>$company_info->firstname));?>
            </div>
            
        </div>

        <div class="col-lg-6 col-sm-6">                
            <div class='form-group'>
            <?php echo form_label($this->lang->line('profiles_contact')."&nbsp".$this->lang->line('profiles_last_name').'*', 'lastname',array('class'=>'wide')); ?>
                <?php echo form_input(array(
                    'name'=>'lastname',
                    'class' => 'form-control',
                    'id'=>'lastname',
                    'value'=>$company_info->lastname));?>
            </div>
            
        </div>
    </div>
<!-- // phone cell email -->
    <div class="row">
        <div class="col-lg-4 col-sm-4">                
            <div class='form-group'>
            <?php echo form_label($this->lang->line('profiles_phone').'*', 'company_phone_number',array('class'=>'wide')); ?>
                <?php echo form_input(array(
                    'name'=>'company_phone_number',
                    'class' => 'form-control',
                    'id'=>'company_phone_number',
                    'value'=>$company_info->company_phone_number));?>
            </div>
            
        </div>

        <div class="col-lg-4 col-sm-4">                
            <div class='form-group'>
            <?php echo form_label($this->lang->line('profiles_cell').'*', 'company_cell',array('class'=>'wide')); ?>
                <?php echo form_input(array(
                    'name'=>'company_cell',
                    'class' => 'form-control',
                    'id'=>'company_cell',
                    'value'=>$company_info->company_cell));?>
            </div>
            
        </div>

        <div class="col-lg-4 col-sm-4">                
            <div class='form-group'>
            <?php echo form_label($this->lang->line('profiles_email').'*', 'company_email',array('class'=>'wide')); ?>
                <?php echo form_input(array(
                    'name'=>'company_email',
                    'class' => 'form-control',
                    'id'=>'email',
                    'value'=>$company_info->company_email));?>
            </div>
            
        </div>
    </div>

<!-- // address -->
    <div class="row">
        <div class="col-lg-6 col-sm-6">                
            <div class='form-group'>
            <?php echo form_label($this->lang->line('profiles_address'), 'company_address',array('class'=>'wide')); ?>
                <?php echo form_input(array(
                    'name'=>'company_address',
                    'class' => 'form-control',
                    'id'=>'company_address',
                    'value'=>$company_info->company_address));?>
            </div>
            
        </div>

        <div class="col-lg-6 col-sm-6">                
            <div class='form-group'>
            <?php echo form_label($this->lang->line('profiles_address2'), 'company_address2',array('class'=>'wide')); ?>
                <?php echo form_input(array(
                    'name'=>'company_address2',
                    'class' => 'form-control',
                    'id'=>'company_address2',
                    'value'=>$company_info->company_address2));?>
            </div>
            
        </div>
    </div>
    <!-- // city state zip -->
    <div class="row">
        <div class="col-lg-4 col-sm-4">                
            <div class='form-group'>
            <?php echo form_label($this->lang->line('profiles_city'), 'company_city',array('class'=>'wide')); ?>
                <?php echo form_input(array(
                    'name'=>'company_city',
                    'class' => 'form-control',
                    'id'=>'company_city',
                    'value'=>$company_info->company_city));?>
            </div>
            
        </div>

        <div class="col-lg-4 col-sm-4">                
            <div class='form-group'>
            <?php echo form_label($this->lang->line('profiles_state'), 'company_state',array('class'=>'wide')); ?>
                <?php echo form_input(array(
                    'name'=>'company_state',
                    'class' => 'form-control',
                    'id'=>'company_state',
                    'value'=>$company_info->company_state));?>
            </div>
            
        </div>

        <div class="col-lg-4 col-sm-4">                
            <div class='form-group'>
            <?php echo form_label($this->lang->line('profiles_zip'), 'company_zip',array('class'=>'wide')); ?>
                <?php echo form_input(array(
                    'name'=>'company_zip',
                    'class' => 'form-control',
                    'id'=>'company_zip',
                    'value'=>$company_info->company_zip));?>
            </div>
            
        </div>
    </div>
    <!-- // comments -->
    <div class="row">
        <div class="col-lg-12 col-sm-12">                
            <div class='form-group'>
            <?php echo form_label($this->lang->line('profiles_comments'), 'comments',array('class'=>'wide')); ?>
            <?php echo form_textarea(array(
                'name'=>'comments',
                'id'=>'comments',
                'class' => 'form-control',
                'value'=>$company_info->comments,
                'rows'=>'5',
                // 'readonly'=>TRUE,
                'cols'=>'24')		
            );?>
            
        </div>

    </div>
    <div id="new_button">
    <?php
        $buttonTitle = ($company_id == -1) ? $this->lang->line('profiles_submit') : $this->lang->line('common_update');
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

    $('#add_company_form').validate({
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
            company_name:
            {
                required:true,
                minlength: 1,
                maxlength: 250
            },
            
            company_email:
            {
                required:true,
                email:"email",
                maxlength: 250

            },
            firstname:
            {
                required:true,
                maxlength: 250

            },
            lastname:
            {
                required:true,
                maxlength: 250

            },
            company_phone_number:
            {
                required:true,
                maxlength: 250
            },
            company_cell:
            {
                required:true,
                maxlength: 250
            },
            
        },
        messages: {
            company_email:
            {
                email: "<?php echo $this->lang->line('common_email_invalid_format'); ?>",
                maxlength: "<?php echo $this->lang->line('profiles_email_maxlength'); ?>"
            },
            company_name:
            {
                maxlength: "<?php echo $this->lang->line('profiles_first_name_maxlength'); ?>"
            },  
            firstname:
            {
                maxlength: "<?php echo $this->lang->line('profiles_first_name_maxlength'); ?>"
            },
            lastname:
            {
                maxlength: "<?php echo $this->lang->line('profiles_last_name_maxlength'); ?>"
            },
            company_phone_number:
            {
                maxlength: "<?php echo $this->lang->line('profiles_phone_number_maxlength'); ?>"
                },
                company_cell:
            {
                maxlength: "<?php echo $this->lang->line('profiles_phone_number_maxlength'); ?>"
            }
        }
    });
});
</script>