<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once ("Secure_area.php");
require_once ("interfaces/Idata_controller.php");
class Profiles extends Secure_area implements iData_controller 
{
	public function __construct()
	{
		parent::__construct('profiles');
	}
	
	public function index()
	{
		$user_id=	 $this->User->get_logged_in_user_info()->user_id;
		$data['user_info']=$this->Profile->get_info($user_id);
	
		$dob=$data['user_info']->dob;
	    if ($dob=="0000-00-00" || $dob=="") {
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

		$data['user_id']=$user_id;
		$data['controller_name']=strtolower(get_class());
		$data['content_view']='users/profiles/manage';
		$this->load->module("template");
		$this->template->manage_tables_template($data);
	}
	
	public function get_dob_date($data,$selected_month="",$selected_day="",$selected_year="")
	{
		$months = array();
	    for ($k=1;$k<=12;$k++){
		    $cur_month = mktime(0, 0, 0, $k, 1, 2000);
		    $months[date("m", $cur_month)] = date("M",$cur_month);
	    }
		$days = array();
		
	    for ($k=1;$k<=31;$k++){
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
		if($selected_month==""){
		    $data['dselected_month']=date('n');
		    $data['dselected_day']=date('d');
		    $data['dselected_year']=date('Y');
		}
		else{
		    $data['dselected_month']=$selected_month;
		    $data['dselected_day']=$selected_day;
		    $data['dselected_year']=$selected_year;
		}
		return $data;
	}
	public function edit_profile_image($user_id=-1)
	{
		$data['user_id']=$user_id;
		$data['user_info']=$this->User->get_info($user_id);
		$this->load->view("users/profiles/edit_profile_image",$data);
	}
	
	public function save_profile_pic($user_id=-1)
	{

			if (isset($GLOBALS["HTTP_RAW_POST_DATA"]))
			
			{
			// Get the data
			$imageData=$GLOBALS['HTTP_RAW_POST_DATA'];

			$filter_filename=substr($imageData,0, strpos($imageData, ","));
			$filteredData=substr($imageData, strrpos($imageData, ",")+1);
			$targetDir = './uploads/'.$user_id;
			
			 
			
			$userinfo_data = array
			(
				'profile_image'=>$user_id.".png"
			);
			if ($this->User->update_user_info($userinfo_data,$user_id)) {
				
				$filePath = $targetDir ;
				$unencodedData=base64_decode($filteredData);

				if ($this->is_writable_r('./uploads/')) {
				$fp = fopen($filePath.'.png', 'w' );
				fwrite( $fp, $unencodedData);
				fclose( $fp );
				
				 echo json_encode(array('success'=>true,'message'=>$this->lang->line('profiles_avatar_updated'),'new_image'=>$user_id.".png"));
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
	    $empty_password=$this->User->check_empty_password($user_id);
		// get all user details by user id
	    $data['user_info']=$this->User->get_info($user_id);
	    $data['empty_password']=$empty_password;
		$this->load->view("profiles/login_info",$data);
	}
		
	/*
	Inserts/updates a user
	*/
	public function save_password($user_id=-1)
	{
		$this->load->library('bcrypt');
		$empty_password=$this->User->check_empty_password($user_id);
		//server side validation
		$this->form_validation->set_rules('email', $this->lang->line('profiles_email'), 'required|valid_email|max_length[250]');
		if(!$empty_password)
		{
			$this->form_validation->set_rules('current_password',  $this->lang->line('login_current_password'), 'required|max_length[250]');
		}
		$this->form_validation->set_rules('username',$this->lang->line('login_username'), 'required|min_length[5]|max_length[250]');
		$this->form_validation->set_rules('password', $this->lang->line('login_password'), 'required|min_length[8]|max_length[250]');

		if ($this->form_validation->run() == FALSE) {
		    $error_message="<ul><li>".form_error('email')."</li><li>".form_error('current_password')."</li><li>".form_error('username')."</li><li>".form_error('password')."</li><li>"."</li></ul>";
		    echo json_encode(array('success'=>false,'message'=>$error_message));
        }
        else {
		    $permission_data=array();

			$userlog_data=array(
			'username'=>$this->input->post('username'),
			'password'=>$this->bcrypt->hash_password($this->input->post('password'))
			);
			
			$userinfo_data = array(
		    'email'=>$this->input->post('email'),
		    );
			
		    
			$user=$this->input->post('username');
			$email =  $this->input->post('email');
		    $current_password =$this->input->post('current_password');
		
		    $usermailcount=$this->User->check_email($email,$user_id);
			$usercount=$this->User->check_username($user,$user_id);
		    $password_match=$this->User->check_password($current_password,$user_id);
			if($empty_password)
		    {
			    $password_match=true;
		    }

		    if (!$password_match) {
		        echo json_encode(array('success'=>false,'message'=>$this->lang->line('profiles_password_missmatch')));
		    }
			else if ($usermailcount!=0) {
				echo json_encode(array('success'=>false,'message'=>$this->lang->line('profiles_email_exist')));
			}
		    else if ($usercount!=0) {
		        echo json_encode(array('success'=>false,'message'=>$this->lang->line('profiles_username_exist')));
		    }
		    else {
		        if ($this->User->update_password( $userlog_data,$userinfo_data,$user_id)) {
				    echo json_encode(array('success'=>true,'message'=>$this->lang->line('profiles_successful_updating').' '));
		        }
		        else {	 //failure
			        echo json_encode(array('success'=>false,'message'=>$this->lang->line('profiles_error_adding_updating').' '));
		        }
		
		    }
		}
	}
	
	/*
	Inserts/updates an user
	*/
	public function save($user_id=-1)
	{
	    $this->form_validation->set_rules('first_name', $this->lang->line('profiles_first_name'), 'required|max_length[250]');
		$this->form_validation->set_rules('last_name',  $this->lang->line('profiles_last_name'), 'max_length[250]');
		$this->form_validation->set_rules('phone_number',  $this->lang->line('profiles_phone'), 'max_length[250]');
		$this->form_validation->set_rules('state',  $this->lang->line('profiles_state'), 'max_length[250]');
		$this->form_validation->set_rules('city',  $this->lang->line('profiles_city'), 'max_length[250]');
		$this->form_validation->set_rules('address',  $this->lang->line('profiles_address'), 'max_length[2000]');
		$this->form_validation->set_rules('comments',  $this->lang->line('profiles_comments'), 'max_length[2000]');
		$this->form_validation->set_error_delimiters('<div class="error" ><h5 align="center" style="color: #DA1111;">', '</h5></div>');
		
		if ($this->form_validation->run() == FALSE) {
		   $this->index();
        }
        else {
		    $dobmonth=$this->input->post('dobmonth');
	        $dobday=$this->input->post('dobday');
	        $dobyear=$this->input->post('dobyear');
	        $dob= date("Y-m-d", strtotime("$dobyear-$dobmonth-$dobday")); 
	        $person_data = array(
		    'first_name'=>$this->input->post('first_name'),
		    'last_name'=>$this->input->post('last_name'),
		    'phone_number'=>$this->input->post('phone_number'),
		    'city'=>$this->input->post('city'),
		    'state'=>$this->input->post('state'),
		    'dob'=>$dob,
		    'country_code'=>$this->input->post('country'),
		    'country_name'=>$this->input->post('country_name'),
		    'marital_status'=>$this->input->post('marital_status'),
		    'comments'=>$this->input->post('comments'),
		    'address'=>$this->input->post('address')
		    );
			if($user_id==-1){
			    $userinfo_data['email'] = $this->input->post('email');
			}

		    $userlog_data=array();
		    $permission_data=array();
		

		
		    if ($this->Userinfo->save($person_data,$userlog_data,$permission_data,$user_id)) {
		    echo json_encode(array('success'=>true,'message'=>$this->lang->line('profiles_successful_updating').' '.
		    $person_data['first_name'],'user_id'=>$user_id));
		    }
		    else //failure
		    {	
			    echo json_encode(array('success'=>false,'message'=>$this->lang->line('profiles_error_adding_updating').' '.
			    $person_data['first_name'].' '.$person_data['last_name'],'person_id'=>-1));
		    }
		
		}
		
		
	}
	
	// abstract method
	public function view($user_id=-1)
	{
		
	}
	
	// abstract method
	public function delete($user_id=-1)
	{
		
	}
  
}
