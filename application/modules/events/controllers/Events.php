<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once ("Secure_area.php");
require_once ("interfaces/Idata_controller.php");
class Events extends Secure_area implements iData_controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('eventtable');
		$this->load->helper('usertable');
	}
	
	public function index()
	{
		$config['base_url'] = site_url('events/events/index');
		$this->load->library('pagination'); 
		$config['total_rows'] = $this->Event_model->count_all();
		$config['per_page'] = $this->config->item('pagination_limit'); //Get page limit from config settings 
		$config['uri_segment'] = 4;
		$this->pagination->initialize($config);
		
		$data['controller_name']=strtolower(get_class());
		$data['controller_path']=$this->router->fetch_module()."/".$this->router->fetch_class();
		$data['form_width']=$this->get_form_width();
		$data['content_view']='companies/company_list';
 
		$data['manage_table']=get_event_manage_table( $this->Event_model->get_all( $config['per_page'], $this->uri->segment( $config['uri_segment'] ) ) );
		$this->load->module("template");
		$this->template->manage_tables_template($data);
 
	}
	
	/*
	Loads the company edit form
	*/
	public function view($company_id=-1)
	{
		$data['company_id']=$company_id;
		$data['company_info']=$this->Event_model->get_info($company_id);
		$data['count_of_users']=$this->Event_model->count_users($company_id);
		$data['content_view']='companies/company_form';
		$data['controller_name']=strtolower(get_class());
		$data['controller_path']=$this->router->fetch_module()."/".$this->router->fetch_class();
		
		$this->load->module("template");
		$this->template->manage_tables_template($data);//this can be used for company also

	}

	/*
	Loads the user edit form
	*/
	public function users($company_id=-1)
	{
		$config['base_url'] = site_url('companies/users/index');
		$this->load->library('pagination'); 
		$config['total_rows'] = $this->Event_model->count_all();
		$config['per_page'] = $this->config->item('pagination_limit'); //Get page limit from config settings 
		$config['uri_segment'] = 5;
		$this->pagination->initialize($config);
		
		$data['controller_name']=strtolower(get_class());
		$data['controller_path']=$this->router->fetch_module()."/".$this->router->fetch_class();
		$data['form_width']=$this->get_form_width();
		$data['content_view']='companies/user_list';
		
		$data['manage_table']=get_company_user_manage_table( $this->Event_model->get_companyusers( $config['per_page'], $this->uri->segment( $config['uri_segment'] ), $company_id ) );
		
		$this->load->module("template");
		$this->template->manage_tables_template($data);

	}

	public function userview($user_id=-1)
	{
		$data['user_id']=$user_id;
		$data['user_info']=$this->User_model->get_info($user_id);
		$data['companies']=$this->Event_model->get_all();
		if ($user_id==-1) {//new admin user form 
			$data['content_view']='companies/company_user_form';//this is for admin form
		}else {
		    $data['content_view']='companies/company_user_form';//this is for admin form
		}
		
		$data['controller_name']=strtolower(get_class());
		$data['controller_path']=$this->router->fetch_module()."/".$this->router->fetch_class();
		
		$this->load->module("template");
		$this->template->manage_user_template($data);

	}

	/*
	Loads the location edit form
	*/
	public function locations($company_id=-1)
	{
		$config['base_url'] = site_url('companies/users/index');
		$this->load->library('pagination'); 
		$config['total_rows'] = $this->Event_model->count_all();
		$config['per_page'] = $this->config->item('pagination_limit'); //Get page limit from config settings 
		$config['uri_segment'] = 5;
		$this->pagination->initialize($config);
		$data['company_id']=$company_id;
		$data['controller_name']=strtolower(get_class());
		$data['controller_path']=$this->router->fetch_module()."/".$this->router->fetch_class();
		$data['form_width']=$this->get_form_width();
		$data['content_view']='companies/location_list';
		
		$data['manage_table']=get_company_location_manage_table( $this->Event_model->get_companylocation( $config['per_page'], $this->uri->segment( $config['uri_segment'] ), $company_id ) );
		
		$this->load->module("template");
		$this->template->manage_tables_template($data);

	}

	public function locationview($company_id=-1, $location_id=-1)
	{
		$data['location_id']=$location_id;
		$data['location_info']= $this->Event_model->get_location_info($location_id);
		$data['emergency_list']= $this->Location_model->get_emergency_list($location_id);
		$data['assign_users']= $this->Location_model->get_assign_users($location_id);
		$data['companies']=$this->Event_model->get_all();
		$data['companyusers']=$this->Event_model->get_companyusers(-1, 0, $company_id);
		$data['content_view']='companies/company_location_form';//this is for admin form

		$data['controller_name']=strtolower(get_class());
		$data['controller_path']=$this->router->fetch_module()."/".$this->router->fetch_class();
		
		$this->load->module("template");
		$this->template->manage_user_template($data);

	}

	public function addemergencylocation()
	{
		//server side validation
		$this->form_validation->set_rules('emergency_location_name', $this->lang->line('common_add_emergency_location'), 'required|max_length[250]');
		$this->form_validation->set_rules('emergency_location_type', $this->lang->line('common_add_emergency_location'), 'required|max_length[250]');

		$usermailcount=0;
		$location_id = $this->input->post('location_id');

		if ($this->form_validation->run() == FALSE) {
		    $error_message="<ul><li>".form_error('emergency_location_name')."</li><li>".form_error('emergency_location_type')."</li></ul>";
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

			if ($this->Event_model->save($company_data, $company_id)) {
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
	// Inserts/updates an company
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
		    
			if ($this->Event_model->save($company_data, $company_id)) {
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
	// Inserts/updates an location
	// */
	public function addlocation()
	{
		//server side validation
		$this->form_validation->set_rules('location_name', $this->lang->line('profiles_company_name'), 'required|max_length[250]');
		
		$location_id = $this->input->post('location_id');
		
		if ($this->form_validation->run() == FALSE) {
		    $error_message="<ul><li>".form_error('location_name')."</li></ul>";
		    echo json_encode(array('success'=>false,'message'=>$error_message));
        }else {

			$location_data=array(
				'location_name'=>$this->input->post('location_name'),
				'location_company_id'=>$this->input->post('company_id'),
				'location_address'=>$this->input->post('location_address'),
				'location_address2'=>$this->input->post('location_address2'),
				'latitude'=>$this->input->post('latitude'),
				'longitude'=>$this->input->post('longitude'),
				'location_city'=>$this->input->post('location_city'),
				'location_state'=>$this->input->post('location_state'),
				'location_zip'=>$this->input->post('location_zip'),
				
			);

			$other_data = array (
				'emergency_locations'=>$this->input->post('emergency_locations'),
				'userids'=>$this->input->post('userids'),
			);

			if ($this->Location_model->save($location_data, $other_data, $location_id)) {
			//New user
				if ($location_id == -1) {
					echo json_encode(array('success'=>true,'message'=>$this->lang->line('profiles_successful_adding_company').' '.
					html_escape($this->security->xss_clean($location_data['location_name'])),'location_id'=>$location_id));	
				}
				else {  //previous user
					echo json_encode(array('success'=>true,'message'=>$this->lang->line('profiles_successful_updating_company').' '.
					html_escape($this->security->xss_clean($location_data['location_name'])),'location_id'=>$location_id));
				}
			}
			else {	 //failure
				echo json_encode(array('success'=>false,'message'=>$this->lang->line('profiles_error_adding_updating_company').' '.
				html_escape($this->security->xss_clean($location_data['location_name'])),'location_id'=>-1));
			}

		}
	}

	/*
	This deletes company user by id from the users table
	*/
	public function deletebyid($user_id=-1)
	{
		if ($this->User_model->delete($user_id)) {
			echo json_encode(array('success'=>true,'message'=>$this->lang->line('profiles_successful_deleted')));
		}
		else {
			echo json_encode(array('success'=>false,'message'=>$this->lang->line('profiles_cannot_be_deleted')));
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
