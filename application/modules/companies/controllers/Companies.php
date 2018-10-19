<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once ("Secure_area.php");
require_once ("interfaces/Idata_controller.php");
class Companies extends Secure_area implements iData_controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('companytable');
	}
	
	public function index()
	{
		$config['base_url'] = site_url('companies/companies/index');
		$this->load->library('pagination'); 
		$config['total_rows'] = $this->Company_model->count_all();
		$config['per_page'] = $this->config->item('pagination_limit'); //Get page limit from config settings 
		$config['uri_segment'] = 4;
		$this->pagination->initialize($config);
		
		$data['controller_name']=strtolower(get_class());
		$data['controller_path']=$this->router->fetch_module()."/".$this->router->fetch_class();;
		$data['form_width']=$this->get_form_width();
		$data['content_view']='users/users/manage';
 
		$data['manage_table']=get_company_manage_table( $this->Company_model->get_all( $config['per_page'], $this->uri->segment( $config['uri_segment'] ) ), $this );
		$this->load->module("template");
		$this->template->manage_tables_template($data);
 
	}
	
	public function view($user_id=-1)
	{
		
	}
	// /*
	// Inserts/updates an user
	// */
	public function save($user_id=-1)
	{
		
	}
	
	// /*
	// This deletes users from the users table
	// */
	public function delete()
	{
		
	}
	// /*
	// get the width for the add/edit form
	// */
	public function get_form_width()
	{
		return 650;
	}
}
