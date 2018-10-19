<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once ("Secure_area.php");
class Dashboards extends Secure_area 
{
	public function __construct()
	{
		parent::__construct("dashboards");	
		$this->load->helper('report');	
		$this->load->helper('usertable');	
	}
	
	public function index()
	{
		$config['base_url'] = site_url('users/users/index');
		$this->load->library('pagination'); 
		$config['total_rows'] = $this->User_model->count_all();
		$config['per_page'] = $this->config->item('pagination_limit'); //Get page limit from config settings 
		$config['uri_segment'] = 4;
		$this->pagination->initialize($config);

    	$data=array();
		$data['total_companies']=$this->Dashboard_model->totalCompanies();
		$data['total_admins']=$this->Dashboard_model->total_admins();
		$data['deactive_users']=$this->Dashboard_model->totalDeactivatedUsers();
		$data['total_users']=$this->Dashboard_model->totalUsers();
		$data['country_name']=$this->Dashboard_model->totalCountryList();
		$cmonth=date("m");  
		$cyear=date("Y"); 
		$cmonth = sprintf("%02d", $cmonth);
		$dates=$cyear."-".$cmonth;
		$data['total_reg_for_month']=$this->Dashboard_model->totalRegForMonth($dates);
		$data['controller_name']=strtolower(get_class());
		$data['manage_table']=get_user_manage_table( $this->User_model->get_all_admin( $config['per_page'], $this->uri->segment( $config['uri_segment'] ) ), $this );
		$data['manage_company_table']=get_company_manage_table( $this->Company_model->get_all( $config['per_page'], $this->uri->segment( $config['uri_segment'] ) ), $this );
		
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
		$this->User_model->logout();
	}
	public function get_form_width()
	{
		return 650;
	}
}
