<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once ("Secure_area.php");
require_once ("interfaces/Idata_controller.php");
class Users extends Secure_area implements iData_controller
{
	public function __construct()
	{
		parent::__construct('users');
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
		
		$data['controller_name']=strtolower(get_class());
		$data['controller_path']=$this->router->fetch_module()."/".$this->router->fetch_class();;
		$data['form_width']=$this->get_form_width();
		$data['content_view']='users/users/user_list';
 
		$data['manage_table']=get_user_manage_table( $this->User_model->get_all( $config['per_page'], $this->uri->segment( $config['uri_segment'] ) ), $this );
		$this->load->module("template");
		$this->template->manage_tables_template($data);
 
	}

	/*
	Returns user table data rows. This will be called with AJAX.
	*/
	public function search()
	{
		$search=$this->input->post('search');
		$data_rows=get_people_manage_table_data_rows($this->User_model->search($search),$this);
		echo $data_rows;
	}
	
	public function get_row()
	{
		$user_id = $this->input->post('row_id');
		$data_row=get_people_data_row($this->User_model->get_info($user_id),$this);
		echo $data_row;
	}
	/*
	Gives search suggestions based on what is being searched for
	*/
	public function suggest()
	{
		$suggestions = $this->User_model->get_search_suggestions($this->input->post('q'),$this->input->post('limit'));
		echo implode("\n",$suggestions);
	}
	
		
	public function get_dob_date($data,$selected_month="",$selected_day="",$selected_year="")
	{

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
	Loads the user edit form
	*/
	public function view($user_id=-1)
	{
		$data['user_info']=$this->User_model->get_info($user_id);
		$data['all_modules']=$this->Module_model->get_editable_modules();
		if ($user_id==-1) {//new admin user form 
			$data['content_view']='users/users/admin_user_form';//this is for admin form
		}
	    else {
		    $data['content_view']='users/users/form';
		}
		
		$config['base_url'] = site_url('users/users/index');
		$this->load->library('pagination'); 
		$config['total_rows'] = $this->User_model->count_all();
		$config['per_page'] = $this->config->item('pagination_limit'); //Get page limit from config settings 
		$config['uri_segment'] = 4;
		$this->pagination->initialize($config);
		
		$data['controller_name']=strtolower(get_class());
		$data['controller_path']=$this->router->fetch_module()."/".$this->router->fetch_class();;
		$data['form_width']=$this->get_form_width();
		
 
		$data['manage_table']=get_user_manage_table( $this->User_model->get_all( $config['per_page'], $this->uri->segment( $config['uri_segment'] ) ), $this );
		$this->load->module("template");
		$this->template->manage_user_template($data);

	}
	
	public function edit_profile_image($user_id=-1)
	{
		$data['user_id']=$user_id;
		$data['user_info']=$this->User_model->get_info($user_id);
		$this->load->view("users/users/edit_profile_image",$data);
	}
	
	public function save_profile_pic($user_id=-1)
	{
 
		if (isset($GLOBALS["HTTP_RAW_POST_DATA"])) {
			// Get the data
			$imageData=$GLOBALS['HTTP_RAW_POST_DATA'];

			$filter_filename=substr($imageData,0, strpos($imageData, ","));
			$filteredData=substr($imageData, strrpos($imageData, ",")+1);
			$targetDir = './uploads/'.$user_id;
			
			$userinfo_data = array
			(
				'profile_image'=>$user_id.".png"
			);
			if ($this->User_model->update_user_info($userinfo_data,$user_id)) {
				
				$filePath = $targetDir ;
				$unencodedData=base64_decode($filteredData);

				if ($this->is_writable_r('./uploads/')) {
				$fp = fopen($filePath.'.png', 'w' );
				fwrite( $fp, $unencodedData);
				fclose( $fp );
				
				 echo json_encode(array('success'=>true,'message'=>$this->lang->line('profiles_avatar_updated')));
				}
				else{
					 echo json_encode(array('success'=>false,'message'=>$this->lang->line('profiles_avatar_not_writable'))); 
				}
			}
		}
		
		
	}
	
	public function is_writable_r($dir)
	{
		if (is_dir($dir)) {
            if(is_writable($dir)){
                $objects = scandir($dir);
                foreach ($objects as $object) {
                    if ($object != "." && $object != "..") {
                        if (!$this->is_writable_r($dir."/".$object)) return false;
                        else continue;
                    }
                }    
                return true;    
              }else{
              return false;
        }
        
       }
	   else if(file_exists($dir)){
           return (is_writable($dir));
        
       }
	}
	
	public function change_password($user_id=-1)
	{
	    
		// get all user details by user id
	    $data['user_info']=$this->User_model->get_info($user_id);
		$this->load->view("users/users/login_info",$data);
	}
	public function addadmin() {
		$this->save(-1, 1);
	}
	/*
	Inserts/updates an user
	*/
	public function save($user_id=-1, $user_level=0)//user_level=0 : undefined, 1: admin
	{
		$this->load->library('bcrypt');
	    //server side validation
		$this->form_validation->set_rules('first_name', $this->lang->line('profiles_first_name'), 'required|max_length[250]');
		$this->form_validation->set_rules('last_name',  $this->lang->line('profiles_last_name'), 'max_length[250]');
		$this->form_validation->set_rules('phone_number',  $this->lang->line('profiles_phone'), 'max_length[250]');
		$this->form_validation->set_rules('email',  $this->lang->line('profiles_email'), 'max_length[250]');
		
		$usermailcount=0;
		
		if($user_id==-1) {
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email|max_length[250]');
		    $this->form_validation->set_rules('password', 'Password', 'required|min_length[8]|max_length[250]');
		}
		if ($this->form_validation->run() == FALSE) {
		    $error_message="<ul><li>".form_error('first_name')."</li><li>".form_error('last_name')."</li><li>".form_error('phone_number')."</li><li>".form_error('password')."</li><li>".form_error('email')."</li></ul>";
		    echo json_encode(array('success'=>false,'message'=>$error_message));
        }else {
		    $userinfo_data = array(
				'first_name'=>$this->input->post('first_name'),
				'last_name'=>$this->input->post('last_name'),
				'phone_number'=>$this->input->post('phone_number'),
				'employee'=>$this->input->post('employee'),
				'pin'=>$this->input->post('pin'),
		  
		    );
			if($user_id == -1){
				$userinfo_data['email'] = $email = $this->input->post('email');
				$usermailcount=$this->User_model->check_email($email,$user_id);
			}			
		   
		    if ($this->input->post('password')!='') {
			    $userlog_data=array(
			    'username'=>$this->input->post('email'),
				'password'=>($this->bcrypt->hash_password($this->input->post('password'))),
				'active'=>'0',
				'user_level'=>$user_level
			    );
		    }
					
			if($user_id ==-1 && $usermailcount != 0){//new user but email exist on database
				echo json_encode(array('success'=>false,'message'=>$this->lang->line('profiles_email_exist')));
			}else {

		       if ($this->User_model->save($userinfo_data,$userlog_data,$user_id)) {
			    //New user
			        if ($user_id==-1) {
				        echo json_encode(array('success'=>true,'message'=>$this->lang->line('profiles_successful_adding').' '.
						html_escape($this->security->xss_clean($userinfo_data['first_name'])).' '.html_escape($this->security->xss_clean($userinfo_data['last_name'])),'user_id'=>$userlog_data['user_id']));	
					}
					else {  //previous user
						echo json_encode(array('success'=>true,'message'=>$this->lang->line('profiles_successful_updating').' '.
						html_escape($this->security->xss_clean($userinfo_data['first_name'])),'user_id'=>$user_id));
					}
		        }
		        else {	 //failure
					echo json_encode(array('success'=>false,'message'=>$this->lang->line('profiles_error_adding_updating').' '.
					html_escape($this->security->xss_clean($userinfo_data['first_name'])).' '.$this->security->xss_clean($userinfo_data['last_name']),'user_id'=>-1));
		        }
		
		    }
		}
	}
	
	public function save_password($user_id=-1)
	{
		$this->load->library('bcrypt');
		//Password has been changed 
		$login_user_id=$this->User_model->get_logged_in_user_info()->user_id;
		
		//server side validation
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|max_length[250]');
		$this->form_validation->set_rules('username', 'Username', 'required|min_length[5]|max_length[250]');
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[8]|max_length[250]');
		$this->form_validation->set_rules('current_password', 'Current Password', 'required|min_length[8]|max_length[250]');
		
		if ($this->form_validation->run() == FALSE) {
			$error_message="<ul><li>".form_error('email')."</li><li>".form_error('username')."</li><li>".form_error('password')."</li><li>".form_error('current_password')."</li></ul>";
			echo json_encode(array('success'=>false,'message'=>$error_message));
		}
        else {
			$password =  $this->input->post('password');
			$email =  $this->input->post('email');
			$username = $this->input->post('username');
			$userlog_data=array(
			'username'=>$username,
			'password'=>($this->bcrypt->hash_password($password))
			);
			 $userinfo_data = array(
		    'email'=>$this->input->post('email'),
		    );
			$user=$this->input->post('username');
			$current_password=$this->input->post('current_password');
			$usermailcount=$this->User_model->check_email($email,$user_id);
			$usercount=$this->User_model->check_username($user,$user_id);
			
		
			$password_match=$this->User_model->check_password($current_password,$login_user_id);
			if ($password_match==0) {
				echo json_encode(array('success'=>false,'message'=>$this->lang->line('profiles_password_missmatch')));
			}
			else if ($usermailcount!=0) {
				echo json_encode(array('success'=>false,'message'=>$this->lang->line('profiles_email_exist')));
			}
			else if ($usercount!=0) {
				echo json_encode(array('success'=>false,'message'=>$this->lang->line('profiles_username_exist')));
			}
			else {
				if ($this->User_model->update_password( $userlog_data,$userinfo_data,$user_id)) {
				    echo json_encode(array('success'=>true,'message'=>$this->lang->line('profiles_successful_updating').' ','user_id'=>$user_id));
				}
				else {	 //failure
					echo json_encode(array('success'=>false,'message'=>$this->lang->line('profiles_error_adding_updating').' ','user_id'=>$user_id));
				}
			}
		
		}
	}
	
	/*
	This deletes users from the users table
	*/
	public function delete()
	{
		$users_to_delete=$this->input->post('ids');
		if ($this->User_model->delete_list($users_to_delete)) {
			echo json_encode(array('success'=>true,'message'=>$this->lang->line('profiles_successful_deleted').' '.
			count($users_to_delete).' '.$this->lang->line('profiles_one_or_multiple')));
		}
		else {
			echo json_encode(array('success'=>false,'message'=>$this->lang->line('profiles_cannot_be_deleted')));
		}
	}

	/*
	This deletes user by id from the users table
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
	/*
	get the width for the add/edit form
	*/
	public function get_form_width()
	{
		return 650;
	}
}
