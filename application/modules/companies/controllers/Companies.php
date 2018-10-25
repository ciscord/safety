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
		$data['content_view']='users/users/user_list';
 
		$data['manage_table']=get_company_manage_table( $this->Company_model->get_all( $config['per_page'], $this->uri->segment( $config['uri_segment'] ) ), $this );
		$this->load->module("template");
		$this->template->manage_tables_template($data);
 
	}
	
	/*
	Loads the user edit form
	*/
	public function view($company_id=-1)
	{
		$data['company_id']=$company_id;
		$data['company_info']=$this->Company_model->get_info($company_id);
		$data['count_of_users']=$this->Company_model->count_users($company_id);
		$data['content_view']='companies/company_form';
		$data['controller_name']=strtolower(get_class());
		$data['controller_path']=$this->router->fetch_module()."/".$this->router->fetch_class();;
		
		$this->load->module("template");
		$this->template->manage_user_template($data);//this can be used for company also

	}
	// /*
	// Inserts/updates an user
	// */
	public function save($company_id=-1)
	{
		//server side validation
		$this->form_validation->set_rules('company_name', $this->lang->line('profiles_company_name'), 'required|max_length[250]');
		$this->form_validation->set_rules('firstname', $this->lang->line('profiles_first_name'), 'required|max_length[250]');
		$this->form_validation->set_rules('lastname', $this->lang->line('profiles_first_name'), 'required|max_length[250]');
		$this->form_validation->set_rules('company_cell', $this->lang->line('profiles_cell'), 'required|max_length[250]');
		$this->form_validation->set_rules('company_phone_number',  $this->lang->line('profiles_phone'), 'max_length[250]');
		$this->form_validation->set_rules('company_email',  $this->lang->line('profiles_email'), 'max_length[250]');
		
		$usermailcount=0;
		
		if($company_id == -1) {
			$this->form_validation->set_rules('company_email', 'Email', 'required|valid_email|max_length[250]');
		}
		if ($this->form_validation->run() == FALSE) {
		    $error_message="<ul><li>".form_error('firstname')."</li><li>".form_error('lastname')."</li><li>".form_error('company_phone_number')."</li><li>".form_error('company_cell')."</li><li>".form_error('company_email')."</li></ul>";
		    echo json_encode(array('success'=>false,'message'=>$error_message));
        }else {
					
			$company_data=array(
				'name'=>$this->input->post('company_name'),
				'firstname'=>$this->input->post('firstname'),
				'lastname'=>$this->input->post('lastname'),
				'company_phone_number'=>$this->input->post('company_phone_number'),
				'company_cell'=>$this->input->post('company_cell'),
				'company_email'=>$this->input->post('company_email'),
				'company_address'=>$this->input->post('company_address'),
				'company_address2'=>$this->input->post('company_address2'),
				'company_city'=>$this->input->post('company_city'),
				'company_state'=>$this->input->post('company_state'),
				'company_zip'=>$this->input->post('company_zip'),
				'comments'=>$this->input->post('comments'),
			);
		    
			if ($this->Company_model->save($company_data, $company_id)) {
			//New user
				if ($company_id == -1) {
					echo json_encode(array('success'=>true,'message'=>$this->lang->line('profiles_successful_adding_company').' '.
					html_escape($this->security->xss_clean($company_data['name'])),'company_id'=>$company_id));	
				}
				else {  //previous user
					echo json_encode(array('success'=>true,'message'=>$this->lang->line('profiles_successful_updating_company').' '.
					html_escape($this->security->xss_clean($company_data['name'])),'company_id'=>$company_id));
				}
			}
			else {	 //failure
				echo json_encode(array('success'=>false,'message'=>$this->lang->line('profiles_error_adding_updating_company').' '.
				html_escape($this->security->xss_clean($company_data['name'])),'user_id'=>-1));
			}
	
		
		}
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
