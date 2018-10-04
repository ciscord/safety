<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once ("Secure_area.php");
require_once ("interfaces/Idata_controller.php");
class User_reports extends Secure_area implements iData_controller
{
	public function __construct()
	{
		parent::__construct('user_reports');
		$this->load->helper('report');
	}
	
	public function index()
	{
	    $this->date_input();
	}
	
	public function user_all_report()
	{
		$this->load->model('reports/User_report');
	    $model = $this->User_report;
	
		$config['base_url'] = site_url('reports/user_reports/user_all_report');
		$this->load->library('pagination'); 
		$config['total_rows'] = $model->count_all();
		$config['per_page'] = $this->config->item('pagination_limit'); //Get page limit from config settings 
		$config['uri_segment'] = 4;
		$this->pagination->initialize($config);
		
		$data['controller_name']=strtolower(get_class());
		$data['controller_path']=$this->router->fetch_module()."/".$this->router->fetch_class();
		$data['form_width']=$this->get_form_width();
		$data['report_function']='user_all_report';
		$data['content_view']='reports/user_reports/manage';
		$data['manage_table']=get_people_manage_report_table( $model->get_all( $config['per_page'], $this->uri->segment( $config['uri_segment'] ) ), $this );
		$this->load->module("template");
		$this->template->manage_tables_template($data);
	}
	
	public function user_active_report()
	{
		$this->load->model('reports/User_report');
	    $model = $this->User_report;
		$config['base_url'] = site_url('reports/user_reports/user_active_report');
		$this->load->library('pagination'); 
		$config['total_rows'] = $model->count_totalActiveUsers();
		$config['per_page'] = $this->config->item('pagination_limit'); //Get page limit from config settings 
		$config['uri_segment'] = 4;
		$this->pagination->initialize($config);
		
		$data['controller_name']=strtolower(get_class());
		$data['controller_path']=$this->router->fetch_module()."/".$this->router->fetch_class();
		$data['report_function']='user_active_report';
		$data['form_width']=$this->get_form_width();
		$data['manage_table']=get_people_manage_report_table( $model->totalActiveUsers( $config['per_page'], $this->uri->segment( $config['uri_segment'] ) ), $this );
		$data['content_view']='reports/user_reports/manage';
		$this->load->module("template");
		$this->template->manage_tables_template($data);
	}
	
	public function user_deactvated_report()
	{
		$this->load->model('reports/User_report');
	    $model = $this->User_report;
		$config['base_url'] = site_url('reports/user_reports/user_deactvated_report');
		$this->load->library('pagination'); 
		$config['total_rows'] = $model->count_totalDeactivatedUsers();
		$config['per_page'] = $this->config->item('pagination_limit'); //Get page limit from config settings ;
		$config['uri_segment'] = 4;
		$this->pagination->initialize($config);
		
		$data['controller_name']=strtolower(get_class());
		$data['controller_path']=$this->router->fetch_module()."/".$this->router->fetch_class();
		$data['report_function']='user_deactvated_report';
		$data['form_width']=$this->get_form_width();
		$data['manage_table']=get_people_manage_report_table( $model->totalDeactivatedUsers( $config['per_page'], $this->uri->segment( $config['uri_segment'] ) ), $this );
			$data['content_view']='reports/user_reports/manage';
		$this->load->module("template");
		$this->template->manage_tables_template($data);
	}
	
	public function user_deleted_report()
	{
		$this->load->model('reports/User_report');
	    $model = $this->User_report;
		$config['base_url'] = site_url('reports/user_reports/user_deleted_report');
		$this->load->library('pagination'); 
		$config['total_rows'] = $model->count_totalDeletedUsers();
		$config['per_page'] = $this->config->item('pagination_limit'); //Get page limit from config settings 
		$config['uri_segment'] = 4;
		$this->pagination->initialize($config);
		
		$data['controller_name']=strtolower(get_class());
		$data['controller_path']=$this->router->fetch_module()."/".$this->router->fetch_class();
		$data['report_function']='user_deleted_report';
		$data['form_width']=$this->get_form_width();
		$data['manage_table']=get_people_manage_report_table( $model->totalDeletedUsers( $config['per_page'], $this->uri->segment( $config['uri_segment'] ) ), $this );
			$data['content_view']='reports/user_reports/manage';
		$this->load->module("template");
		$this->template->manage_tables_template($data);
	}
	
	public function date_input()
	{
		$data = $this->_get_common_report_data();
		$data['controller_name']=strtolower(get_class());
		$data['controller_path']=$this->router->fetch_module()."/".$this->router->fetch_class();
		$data['content_view']='reports/user_reports/date_input';
		$this->load->module("template");
		$this->template->manage_tables_template($data);
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
	
	public function get_dob_date($data,$selected_month="",$selected_day="",$selected_year="")
	{
		//$data = array();
		
		$months = array();
	    for ($k=1;$k<=12;$k++) {
		    $cur_month = mktime(0, 0, 0, $k, 1, 2000);
		    $months[date("m", $cur_month)] = date("M",$cur_month);
	    }
		$days = array();
	    for ($k=1;$k<=31;$k++) {
		    $cur_day = mktime(0, 0, 0, 1, $k, 2000);
		    $days[date('d',$cur_day)] = date('j',$cur_day);
	    }
	    $years = array();	
	    for ($k=0;$k<70;$k++){
           $y=date("Y");
		   $years[$y-$k] = $y-$k;
	    }
		$months['00'] = "00";
	    $days['00'] = "00";
     	$years['00'] = "0000";
		$data['dmonths'] = $months;
		$data['ddays'] = $days;
		$data['dyears'] = $years;
		if ($selected_month=="") {
		   $data['dselected_month']=date('n');
		   $data['dselected_day']=date('d');
		   $data['dselected_year']=date('Y');
		}
		else {
		   $data['dselected_month']=$selected_month;
		   $data['dselected_day']=$selected_day;
		   $data['dselected_year']=$selected_year;
		}
		return $data;
	}
	
	
	public function get_registration_date($data,$selected_month="",$selected_day="",$selected_year="")
	{
		$months = array();
	    for ($k=1;$k<=12;$k++) {
		    $cur_month = mktime(0, 0, 0, $k, 1, 2000);
		    $months[date("m", $cur_month)] = date("M",$cur_month);
	    }
		$days = array();
	    for($k=1;$k<=31;$k++){
		    $cur_day = mktime(0, 0, 0, 1, $k, 2000);
		    $days[date('d',$cur_day)] = date('j',$cur_day);
	    }
	    $years = array();
	    for($k=0;$k<20;$k++) {
            $y=date("Y");
	        $y=$y+5;
		$years[$y-$k] = $y-$k;
	    }
			
		$data['rmonths'] = $months;
		$data['rdays'] = $days;
		$data['ryears'] = $years;	
		if ($selected_month=="") {
		    $data['rselected_month']=date('n');
		    $data['rselected_day']=date('d');
		    $data['rselected_year']=date('Y');
		}
		else {
		    $selected_month;
		    $data['rselected_month']=$selected_month;
		    $data['rselected_day']=$selected_day;
		    $data['rselected_year']=$selected_year;
		}
		
		return $data;
	}
	
	
	/*
	Returns user table data rows. This will be called with AJAX.
	*/
	public function search()
	{
		$this->load->model('reports/User_report');
	    $model = $this->User_report;
		$search=$this->input->post('search');
		$data_rows=get_people_manage_report_table_data_rows($model->search($search),$this);
		echo $data_rows;
	}
	
	public function search_active()
	{
		$this->load->model('reports/User_report');
	    $model = $this->User_report;
		$search=$this->input->post('search');
		$data_rows=get_people_manage_report_table_data_rows($model->search_active($search),$this);
		echo $data_rows;
	}
	
	public function search_deactvated()
	{
		$this->load->model('reports/User_report');
	    $model = $this->User_report;
		$search=$this->input->post('search');
		$data_rows=get_people_manage_report_table_data_rows($model->search_deactvated($search),$this);
		echo $data_rows;
	}
	
	public function search_deleted()
	{
		$this->load->model('reports/User_report');
	    $model = $this->User_report;
		$search=$this->input->post('search');
		$data_rows=get_people_manage_report_table_data_rows($model->search_deleted($search),$this);
		echo $data_rows;
	}
	
	/*
	Gives search suggestions based on what is being searched for
	*/
	public function suggest()
	{
		$this->load->model('reports/User_report');
	    $model = $this->User_report;
		$suggestions = $model->get_search_suggestions($this->input->post('q'),$this->input->post('limit'));
		echo implode("\n",$suggestions);
	}
	
	public function suggest_active()
	{
		$this->load->model('reports/User_report');
	    $model = $this->User_report;
		$suggestions = $model->get_active_search_suggestions($this->input->post('q'),$this->input->post('limit'));
		echo implode("\n",$suggestions);
	}
	
	public function suggest_deactvated()
	{
		$this->load->model('reports/User_report');
	    $model = $this->User_report;
		$suggestions = $model->get_deactvated_search_suggestions($this->input->post('q'),$this->input->post('limit'));
		echo implode("\n",$suggestions);
	}
 
	public function suggest_deleted()
	{
		$this->load->model('reports/User_report');
	    $model = $this->User_report;
		$suggestions = $model->get_deleted_search_suggestions($this->input->post('q'),$this->input->post('limit'));
		echo implode("\n",$suggestions);
	}
	
	/*
	Loads the user edit form
	*/
	public function view($user_id=-1)
	{
		// get all user details by user id
	    $data['user_info']=$this->User->get_info($user_id);
		// dob of user
	    $dob=$data['user_info']->dob;
	    if ($dob=="0000-00-00" || $dob==""){
	        $d_o_b="0000-00-00";
	    }
	    else {
            $d_o_b= date("Y-m-d", strtotime($dob));
	    }
	   
	    $split_date = explode("-", $d_o_b);
	    $year = $split_date[0];
	    $month = $split_date[1];
	    $day = $split_date[2];
	    $data=$this->get_dob_date($data,$month,$day,$year);

	    // registration date of user account
	    $dateofregistration=$data['user_info']->register_date;
	    if ($dateofregistration==""){
	        $date_of_registration= date("Y-m-d");
	    }
	    else {
	        $date_of_registration= date("Y-m-d", strtotime($dateofregistration));
	    }
	 
		$split_date = explode("-", $date_of_registration);
		$cyear = $split_date[0];
		$cmonth = $split_date[1];
		$cday = $split_date[2];
		$data=$this->get_registration_date($data,$cmonth,$cday,$cyear);
		
		$data['all_modules']=$this->Module->get_editable_modules();
		$this->load->view("reports/user_reports/form",$data);
	}
	
	/*
	 abstract method
	*/
	public function save($user_id=-1)
	{

	}
	
	/*
	 abstract method
	*/
	public function delete()
	{
		
	}
	/*
	get the width for the add/edit form
	*/
	public function get_form_width()
	{
		return 650;
	}
}
