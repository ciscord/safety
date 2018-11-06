<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
Gets the html table to manage people.
*/
function get_event_manage_table($events)
{
	$CI =& get_instance();
	$table='<table class="tablesorter" id="sortable_table">';
	
	$headers = array(
	$CI->lang->line('common_name'),
	$CI->lang->line('profiles_status'),
	$CI->lang->line('common_actions'),
	 
	);
	
	$table.='<thead><tr>';
	foreach ($headers as $header) {
		$table.="<th>$header</th>";
	}
	$table.='</tr></thead><tbody>';
	$table.=get_event_manage_table_data_rows($events);
	$table.='</tbody></table>';
	return $table;
}

/*
Gets the html data rows for the people.
*/
function get_event_manage_table_data_rows($events)
{
	$CI =& get_instance();
	$table_data_rows='';
	
	foreach ($events->result() as $data_row) {
		$table_data_rows.=get_event_data_row($data_row);
	}
	
	if ($events->num_rows()==0) {
		$table_data_rows.="<tr><td colspan='10'><div class='warning_message' style='padding:7px;'>".$CI->lang->line('profiles_no_employee_to_display')."</div></tr></tr>";
	}
	
	return $table_data_rows;
}

function get_event_data_row($data_row)
{
	$CI =& get_instance();
	$controller_path=$CI->router->fetch_module()."/".$CI->router->fetch_class();
	  
	$table_data_row='<tr>';	
	// $table_data_row.="<td width='5%'><input type='checkbox' id='user_$data_row->user_id' value='".$data_row->user_id."'/></td>";

	// Apply the xss_clean() of "security" library, which filtered data from passing through <script> tag.
	$table_data_row.='<td width="10%">'.character_limiter(html_escape($CI->security->xss_clean($data_row->name)),10).'</td>';
	
    if($data_row->company_active==0)
	$table_data_row.='<td width="15%"><span class="label label-success">'.$CI->lang->line('profiles_active').'</span></td>';	
    else
	$table_data_row.='<td width="10%"><span class="label label-danger">'.$CI->lang->line('profiles_deactivated').'</span></td>';	

	$table_data_row.='<td width="10%">'.anchor($controller_path."/view/$data_row->company_id", $CI->lang->line('icon_edit'),array('class'=>'','title'=>$CI->lang->line('common_edit'))).'</td>';		
	$table_data_row.='</tr>';
	
	return $table_data_row;
}

