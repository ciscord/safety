<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
Gets the html table to manage people.
*/
function get_company_manage_table($companies)
{
	$CI =& get_instance();
	$table='<table class="tablesorter" id="sortable_table">';
	
	$headers = array(
	$CI->lang->line('profiles_company'),
	$CI->lang->line('profiles_contact').' '.$CI->lang->line('profiles_first_name'),
	$CI->lang->line('profiles_contact').' '.$CI->lang->line('profiles_last_name'),
	$CI->lang->line('profiles_numberofuser'),
	$CI->lang->line('profiles_status'),
	$CI->lang->line('common_actions'),
	 
	);
	
	$table.='<thead><tr>';
	foreach ($headers as $header) {
		$table.="<th>$header</th>";
	}
	$table.='</tr></thead><tbody>';
	$table.=get_company_manage_table_data_rows($companies);
	$table.='</tbody></table>';
	return $table;
}

/*
Gets the html data rows for the people.
*/
function get_company_manage_table_data_rows($companies)
{
	$CI =& get_instance();
	$table_data_rows='';
	
	foreach ($companies->result() as $data_row) {
		$table_data_rows.=get_company_data_row($data_row);
	}
	
	if ($companies->num_rows()==0) {
		$table_data_rows.="<tr><td colspan='10'><div class='warning_message' style='padding:7px;'>".$CI->lang->line('profiles_no_employee_to_display')."</div></tr></tr>";
	}
	
	return $table_data_rows;
}

function get_company_data_row($data_row)
{
	$CI =& get_instance();
	$controller_path=$CI->router->fetch_module()."/".$CI->router->fetch_class();
	  
	$table_data_row='<tr>';	
	// $table_data_row.="<td width='5%'><input type='checkbox' id='user_$data_row->user_id' value='".$data_row->user_id."'/></td>";

	// Apply the xss_clean() of "security" library, which filtered data from passing through <script> tag.
	$table_data_row.='<td width="10%">'.character_limiter(html_escape($CI->security->xss_clean($data_row->name)),10).'</td>';
	$table_data_row.='<td width="15%">'.character_limiter(html_escape($CI->security->xss_clean($data_row->firstname)),10).'</td>';
	$table_data_row.='<td width="20%">'.character_limiter(html_escape($CI->security->xss_clean($data_row->lastname)),22).'</td>';
	$table_data_row.='<td width="10%">'.character_limiter(html_escape($CI->security->xss_clean($data_row->number_of_users)),13).'</td>';		
	
	
    if($data_row->company_active==0)
	$table_data_row.='<td width="15%"><span class="label label-success">'.$CI->lang->line('profiles_active').'</span></td>';	
    else
	$table_data_row.='<td width="10%"><span class="label label-danger">'.$CI->lang->line('profiles_deactivated').'</span></td>';	

	$table_data_row.='<td width="10%">'.anchor($controller_path."/users/$data_row->company_id", $CI->lang->line('icon_user'),array('class'=>'','title'=>$CI->lang->line('common_edit'))).str_repeat('&nbsp;', 5).anchor($controller_path."/locations/$data_row->company_id", $CI->lang->line('icon_location'),array('class'=>'','title'=>$CI->lang->line('common_edit'))).str_repeat('&nbsp;', 5).anchor($controller_path."/view/$data_row->company_id", $CI->lang->line('icon_edit'),array('class'=>'','title'=>$CI->lang->line('common_edit'))).'</td>';		
	$table_data_row.='</tr>';
	
	return $table_data_row;
}

//get company location table

function get_company_location_manage_table($locations)
{
	$CI =& get_instance();
	$table='<table class="tablesorter" id="sortable_table">';
	
	$headers = array(
	$CI->lang->line('profiles_company'),
	$CI->lang->line('common_name'),
	$CI->lang->line('common_address'),
	$CI->lang->line('common_latitude'),
	$CI->lang->line('common_longitude'),
	$CI->lang->line('profiles_status'),
	$CI->lang->line('common_actions'),
	 
	);
	
	$table.='<thead><tr>';
	foreach ($headers as $header) {
		$table.="<th>$header</th>";
	}
	$table.='</tr></thead><tbody>';
	$table.=get_company_location_manage_table_data_rows($locations);
	$table.='</tbody></table>';
	return $table;
}

/*
Gets the html data rows for the people.
*/
function get_company_location_manage_table_data_rows($locations)
{
	$CI =& get_instance();
	$table_data_rows='';
	
	foreach ($locations->result() as $data_row) {
		$table_data_rows.=get_company_location_data_row($data_row);
	}
	
	if ($locations->num_rows()==0) {
		$table_data_rows.="<tr><td colspan='10'><div class='warning_message' style='padding:7px;'>".$CI->lang->line('profiles_no_employee_to_display')."</div></tr></tr>";
	}
	
	return $table_data_rows;
}

function get_company_location_data_row($data_row)
{
	$CI =& get_instance();
	$controller_path=$CI->router->fetch_module()."/".$CI->router->fetch_class();
	  
	$table_data_row='<tr>';	
	// $table_data_row.="<td width='5%'><input type='checkbox' id='user_$data_row->user_id' value='".$data_row->user_id."'/></td>";

	// Apply the xss_clean() of "security" library, which filtered data from passing through <script> tag.
	$table_data_row.='<td width="10%">'.character_limiter(html_escape($CI->security->xss_clean($data_row->name)),10).'</td>';
	$table_data_row.='<td width="10%">'.character_limiter(html_escape($CI->security->xss_clean($data_row->location_name)),10).'</td>';
	$table_data_row.='<td width="15%">'.character_limiter(html_escape($CI->security->xss_clean($data_row->location_address)),10).'</td>';
	$table_data_row.='<td width="20%">'.character_limiter(html_escape($CI->security->xss_clean($data_row->latitude)),22).'</td>';
	$table_data_row.='<td width="10%">'.character_limiter(html_escape($CI->security->xss_clean($data_row->longitude)),13).'</td>';		
		
    if($data_row->company_active==0)
	$table_data_row.='<td width="15%"><span class="label label-success">'.$CI->lang->line('profiles_active').'</span></td>';	
    else
	$table_data_row.='<td width="10%"><span class="label label-danger">'.$CI->lang->line('profiles_deactivated').'</span></td>';	

	$table_data_row.='<td width="10%">'.anchor($controller_path."/locationview/$data_row->location_company_id/$data_row->location_id", $CI->lang->line('icon_edit'),array('class'=>'','title'=>$CI->lang->line('common_edit'))).'</td>';		
	$table_data_row.='</tr>';
	
	return $table_data_row;
}
