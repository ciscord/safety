<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="field_row clearfix">	
<?php echo form_label($this->lang->line('profiles_first_name').':', 'first_name',array('class'=>'required')); ?>
	<div class='form_field'>
	<?php echo form_input(array(
		'name'=>'first_name',
		'id'=>'first_name',
		'readonly'=>TRUE,
		'value'=>$user_info->first_name)
	);?>
	</div>
</div>
<div class="field_row clearfix">	
<?php echo form_label($this->lang->line('profiles_last_name').':', 'last_name',array('class'=>'')); ?>
	<div class='form_field'>
	<?php echo form_input(array(
		'name'=>'last_name',
		'id'=>'last_name',
		'readonly'=>TRUE,
		'value'=>$user_info->last_name)
	);?>
	</div>
</div>

<div class="field_row clearfix">	
<?php echo form_label($this->lang->line('profiles_phone').':', 'phone_number'); ?>
	<div class='form_field'>
	<?php echo form_input(array(
		'name'=>'phone_number',
		'id'=>'phone_number',
		'readonly'=>TRUE,
		'value'=>$user_info->phone_number)
	);?>
	</div>
</div>



<div class="field_row clearfix">	
<?php echo form_label($this->lang->line('profiles_email').':', 'email',array('class'=>'required')); ?>
	<div class='form_field'>
	<?php echo form_input(array(
		'name'=>'email',
		'id'=>'email',
		'readonly'=>TRUE,
		'value'=>$user_info->email));?>
	</div>
</div>



<div class="field_row clearfix">	
<?php echo form_label($this->lang->line('profiles_country').':', 'country'); ?>
	<div class='form_field'>
	  <?php 
                        $attr = 'id="country_list"   disabled   ';
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



<div class="field_row clearfix">	
<?php echo form_label($this->lang->line('profiles_city').':', 'city'); ?>
	<div class='form_field'>
	<?php echo form_input(array(
		'name'=>'city',
		'id'=>'city',
		'readonly'=>TRUE,
		'value'=>$user_info->city));?>
	</div>
</div>

<div class="field_row clearfix">	
<?php echo form_label($this->lang->line('profiles_state').':', 'state'); ?>
	<div class='form_field'>
	<?php echo form_input(array(
		'name'=>'state',
		'id'=>'state',
		'readonly'=>TRUE,
		'value'=>$user_info->state));?>
	</div>
</div>


<div class="field_row clearfix radio_option"><br>
<?php echo form_label($this->lang->line('profiles_status').':', 'profile_status'); ?>
	<div class='form_field1 inlin_row'   >
		<?php
		$_status=$user_info->active;
       if($_status==1)
	   {
		$data = array(
    'name'        => '_status',
	 'id'        => 'status1',
    'value'       => '0',
    'disabled'=>'disabled',
    );
	
	 $data2 = array(
    'name'        => '_status',
	 'id'        => 'status2',
    'value'       => '1',
    'disabled'=>'disabled',
	 'checked'     => TRUE,
    );
	
	}
	else  if($_status==0)
	{
	$data = array(
    'name'        => '_status',
	 'id'        => 'status1',
    'value'       => '0',
	 'disabled'=>'disabled',
    'checked'     => TRUE,
    );
	
	 $data2 = array(
    'name'        => '_status',
	 'id'        => 'status2',
    'value'       => '1',
	 'disabled'=>'disabled',
    );
 
	}

echo "".form_radio($data)."<label for='status1' class='profile_status'>Active</label> ";
echo "".form_radio($data2)."<label for='status2'  class='profile_status'>Deactive</label> ";
?>
	</div>
	</div>
	
<div class="field_row clearfix radio_option">	<br>
<?php echo form_label($this->lang->line('profiles_marital_status').':', 'marital_status'); ?>
	<div class='form_field1 inlin_row' >
		<?php
		$marital_status=$user_info->marital_status;
       if($marital_status=="Single")
	   {
		$data = array(
    'name'        => 'marital_status',
    'value'       => 'Single',
    'id'=>'option1',
	'disabled'=>'disabled',
	'checked'     => TRUE,
    );
	
	 $data2 = array(
    'name'        => 'marital_status',
    'value'       => 'Married',
	'id'=>'option2',
	'disabled'=>'disabled',
    );
	}
	else
	{
	$data = array(
    'name'        => 'marital_status',
    'value'       => 'Single',
	'id'=>'option1',
	'disabled'=>'disabled',
    );
	
	 $data2 = array(
    'name'        => 'marital_status',
    'value'       => 'Married',
	'id'=>'option2',
	'disabled'=>'disabled',
	'checked'     => TRUE,
    );
	}

echo "".form_radio($data)."<label for='option1' class='profile_status'>".$this->lang->line('profiles_single')."</label> ";;
echo "".form_radio($data2)."<label for='option2' class='profile_status'>".$this->lang->line('profiles_married')."</label> ";;
;?>
	</div>
</div>

<div class="field_row clearfix">	
<?php echo form_label($this->lang->line('profiles_date_of_registration').':', 'date_of_joining');
$js = 'id="rmonth" class="date_dropdown" disabled';
$js2 = 'id="rday" class="date_dropdown" disabled';
$js3 = 'id="ryear" class="date_dropdown" disabled';
 ?>
<div class="inlin_row">
	
		<?php echo form_dropdown('rmonth',$rmonths, $rselected_month,  $js); ?>
		<?php echo form_dropdown('rday',$rdays, $rselected_day,  $js2); ?>
		<?php echo form_dropdown('ryear',$ryears, $rselected_year,  $js3); ?>
		
	</div>
	
</div>
 
<div class="field_row clearfix">	
<?php echo form_label($this->lang->line('profiles_dob').':', 'dob');
$js = 'id="dobmonth" class="date_dropdown" disabled';
$js = 'id="dobday" class="date_dropdown" disabled';
$js = 'id="dobyear" class="date_dropdown" disabled';
 ?>
	<div  class="inlin_row">
	
		<?php echo form_dropdown('dobmonth',$dmonths, $dselected_month, $js); ?>
		<?php echo form_dropdown('dobday',$ddays, $dselected_day, $js); ?>
		<?php echo form_dropdown('dobyear',$dyears, $dselected_year, $js); ?>
		
	</div>
</div>

 
<div class="field_row clearfix">	
<?php echo form_label($this->lang->line('profiles_address').':', '	address'); ?>
	<div class='form_field'>
	<?php echo form_textarea(array(
		'name'=>'address',
		'id'=>'address',
		'readonly'=>TRUE,
		'value'=>$user_info->address,
		'rows'=>'5',
		'cols'=>'24')		
	);?>
	 
	</div>
</div>
 
<div class="field_row clearfix">	
<?php echo form_label($this->lang->line('profiles_comments').':', 'comments'); ?>
	<div class='form_field'>
	<?php echo form_textarea(array(
		'name'=>'comments',
		'id'=>'comments',
		'readonly'=>TRUE,
		'value'=>$user_info->comments,
		'rows'=>'5',
		'cols'=>'24')		
	);?>
	</div>
</div>