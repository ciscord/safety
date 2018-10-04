<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
Gets the html table to manage people.
*/
function get_people_manage_table($people,$controller)
{
	$CI =& get_instance();
	$table='<table class="tablesorter" id="sortable_table">';
	
	$headers = array('<input type="checkbox" id="select_all" />', 
	$CI->lang->line('profiles_first_name'),
	$CI->lang->line('profiles_last_name'),
	$CI->lang->line('login_username'),
	$CI->lang->line('profiles_phone'),
	$CI->lang->line('profiles_country'),
	$CI->lang->line('profiles_user_level'),
	$CI->lang->line('profiles_status'),
	$CI->lang->line('profiles_avatar'),
	$CI->lang->line('common_edit'),
	$CI->lang->line('profiles_edit_password_short'),
	 
	);
	
	$table.='<thead><tr>';
	foreach ($headers as $header) {
		$table.="<th>$header</th>";
	}
	$table.='</tr></thead><tbody>';
	$table.=get_people_manage_table_data_rows($people,$controller);
	$table.='</tbody></table>';
	return $table;
}

/*
Gets the html data rows for the people.
*/
function get_people_manage_table_data_rows($people,$controller)
{
	$CI =& get_instance();
	$table_data_rows='';
	
	foreach ($people->result() as $data_row) {
		$table_data_rows.=get_people_data_row($data_row,$controller);
	}
	
	if ($people->num_rows()==0) {
		$table_data_rows.="<tr><td colspan='10'><div class='warning_message' style='padding:7px;'>".$CI->lang->line('profiles_no_employee_to_display')."</div></tr></tr>";
	}
	
	return $table_data_rows;
}

function get_people_data_row($data_row,$controller)
{
	$CI =& get_instance();
	$controller_path=$CI->router->fetch_module()."/".$CI->router->fetch_class();
	$width = $controller->get_form_width();
    if ($data_row->user_level==1) {  //disable checkbox for admin
	    $table_data_row='<tr class="disabled_row">';
	    $table_data_row.="<td width='5%'><input type='checkbox'  disabled='disabled' id='user_$data_row->user_id' value='".$data_row->user_id."'/></td>";
	}
    else {
	    $table_data_row='<tr>';	
	    $table_data_row.="<td width='5%'><input type='checkbox' id='user_$data_row->user_id' value='".$data_row->user_id."'/></td>";
	}
	// Apply the xss_clean() of "security" library, which filtered data from passing through <script> tag.
	$table_data_row.='<td width="10%">'.character_limiter(html_escape($CI->security->xss_clean($data_row->first_name)),10).'</td>';
	$table_data_row.='<td width="15%">'.character_limiter(html_escape($CI->security->xss_clean($data_row->last_name)),10).'</td>';
	$table_data_row.='<td width="15%">'.character_limiter(html_escape($CI->security->xss_clean($data_row->username)),10).'</td>';
	$table_data_row.='<td width="20%">'.character_limiter(html_escape($CI->security->xss_clean($data_row->phone_number)),22).'</td>';
	$table_data_row.='<td width="10%">'.character_limiter(html_escape($CI->security->xss_clean($data_row->country_name)),13).'</td>';		
	if($data_row->user_level==1)
	$table_data_row.='<td width="15%">'.$CI->lang->line('profiles_user_level_admin').'</td>';	
    else 
	$table_data_row.='<td width="10%">'.$CI->lang->line('profiles_user_level_user').'</td>';	
 
    if($data_row->active==0)
	$table_data_row.='<td width="15%"><span class="label label-success">'.$CI->lang->line('profiles_active').'</span></td>';	
    else
	$table_data_row.='<td width="10%"><span class="label label-danger">'.$CI->lang->line('profiles_deactivated').'</span></td>';	

  
	$table_data_row.='<td width="10%">'.anchor($controller_path."/edit_profile_image/$data_row->user_id/width:$width", $CI->lang->line('icon_image'),array('class'=>'thickbox','title'=>$CI->lang->line('common_edit'))).'</td>';		
	$table_data_row.='<td width="10%">'.anchor($controller_path."/view/$data_row->user_id/width:$width", $CI->lang->line('icon_edit'),array('class'=>'thickbox','title'=>$CI->lang->line('common_edit'))).'</td>';		
	$table_data_row.='<td width="15%">'.anchor($controller_path."/change_password/$data_row->user_id/width:360", $CI->lang->line('icon_lock'),array('class'=>'thickbox','title'=>$CI->lang->line('profiles_edit_password'))).'</td>';		
	$table_data_row.='</tr>';
	
	return $table_data_row;
}

/*
Gets the html table to manage people.
*/
function get_people_manage_report_table($people,$controller)
{
	$CI =& get_instance();
	$table='<table class="tablesorter" id="sortable_table">';
	
	$headers = array('<input type="checkbox" id="select_all" />', 
	$CI->lang->line('profiles_first_name'),
	$CI->lang->line('profiles_last_name'),
	$CI->lang->line('login_username'),
	$CI->lang->line('profiles_phone'),
	$CI->lang->line('profiles_country'),
	$CI->lang->line('profiles_user_level'),
	$CI->lang->line('common_view')
	);
	
	$table.='<thead><tr>';
	foreach ($headers as $header) {
		$table.="<th>$header</th>";
	}
	$table.='</tr></thead><tbody>';
	$table.=get_people_manage_report_table_data_rows($people,$controller);
	$table.='</tbody></table>';
	return $table;
}

/*
Gets the html data rows for the people report.
*/
function get_people_manage_report_table_data_rows($people,$controller)
{
	$CI =& get_instance();
	$table_data_rows='';
	
	foreach ($people->result() as $data_row) {
		$table_data_rows.=get_people_report_data_row($data_row,$controller);
	}
	
	if($people->num_rows()==0) {
		$table_data_rows.="<tr><td colspan='8'><div class='warning_message' style='padding:7px;'>".$CI->lang->line('profiles_no_user_to_display')."</div></tr></tr>";
	}
	
	return $table_data_rows;
}

function get_people_report_data_row($data_row,$controller)
{
	$CI =& get_instance();
	$controller_path=$CI->router->fetch_module()."/".$CI->router->fetch_class();
	$width = $controller->get_form_width();

	$table_data_row='<tr>';
	$table_data_row.="<td width='5%'><input type='checkbox' id='user_$data_row->user_id' value='".$data_row->user_id."'/></td>";
	$table_data_row.='<td width="20%">'.character_limiter(html_escape($CI->security->xss_clean($data_row->first_name)),13).'</td>';
	$table_data_row.='<td width="20%">'.character_limiter(html_escape($CI->security->xss_clean($data_row->last_name)),13).'</td>';
	$table_data_row.='<td width="15%">'.character_limiter(html_escape($CI->security->xss_clean($data_row->username)),10).'</td>';
	$table_data_row.='<td width="20%">'.character_limiter(html_escape($CI->security->xss_clean($data_row->phone_number)),22).'</td>';
	$table_data_row.='<td width="10%">'.character_limiter(html_escape($CI->security->xss_clean($data_row->country_name)),13).'</td>';		
	if($data_row->user_level==1)
	$table_data_row.='<td width="15%">'.$CI->lang->line('profiles_user_level_admin').'</td>';	
    else 
	$table_data_row.='<td width="10%">'.$CI->lang->line('profiles_user_level_user').'</td>';	

	$table_data_row.='<td width="5%">'.anchor($controller_path."/view/$data_row->user_id/width:$width", $CI->lang->line('icon_user_view'),array('class'=>'thickbox','title'=>$CI->lang->line('common_view'))).'</td>';		
	$table_data_row.='</tr>';
	
	return $table_data_row;
}
