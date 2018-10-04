<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once ("Secure_area.php");
class Dashboards extends Secure_area 
{
	public function __construct()
	{
		parent::__construct("dashboards");	
		$this->load->helper('report');	
	}
	
	public function index()
	{
    	$data=array();
		$data['total_users']=$this->Dashboard->totalUsers();
		$data['active_users']=$this->Dashboard->totalActiveUsers();
		$data['deactive_users']=$this->Dashboard->totalDeactivatedUsers();
		$data['deleted_users']=$this->Dashboard->totalDeletedUsers();
		$data['country_name']=$this->Dashboard->totalCountryList();
		$cmonth=date("m");  
		$cyear=date("Y"); 
		$cmonth = sprintf("%02d", $cmonth);
		$dates=$cyear."-".$cmonth;
		$data['total_reg_for_month']=$this->Dashboard->totalRegForMonth($dates);
		$data['controller_name']=strtolower(get_class());
		
		$data['content_view']='dashboard/dashboard';
		$this->load->module("template");
		$this->template->home_template($data);
	}
	
	public function _get_common_report_data()
	{
		$data = array();
		$data['report_date_range_simple'] = get_simple_date_ranges();
		$data['months'] = get_months();
		$data['days'] = get_days();
		$data['years'] = get_years();
		$data['selected_month']=date('n');
		$data['selected_day']=date('d');
		$data['selected_year']=date('Y');	
		return $data;
	}
 
	public function logout()
	{
		$this->User->logout();
	}
}
