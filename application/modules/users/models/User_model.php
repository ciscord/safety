<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class User_model  extends Userinfo_model
{
	/*
	Gets information about a particular user
	*/
	public function get_info($users_id)
	{
		$this->db->from('users');	
		$this->db->join('userinfo', 'userinfo.user_id = users.user_id');
		$this->db->where('users.user_id',$users_id);
		$query = $this->db->get();
		
		if ($query->num_rows()==1) {
			return $query->row();
		}
		else {
			//Get empty base parent object
			$person_obj=parent::get_info(-1);
			//Get all the fields from user table
			$fields = $this->db->list_fields('users');
			//append those fields to base parent object, we we have a complete empty object
			foreach ($fields as $field) {
				$person_obj->$field='';
			}
			return $person_obj;
		}
	}
	/*
	Determines if a given user_id is exist
	*/
	public function exists($user_id)
	{
		$this->db->from('users');	
		$this->db->join('userinfo', 'userinfo.user_id = users.user_id');
		$this->db->where('users.user_id',$user_id);
		$query = $this->db->get();
		
		return ($query->num_rows()==1);
	}	
	
	/*
	Returns all the users
	*/
	public function get_all($limit=10000, $offset=0)
	{
		$this->db->from('users');
		$this->db->where('users.deleted',0);		
		$this->db->join('userinfo','users.user_id=userinfo.user_id');			
		$this->db->order_by("first_name", "asc");
		$this->db->limit($limit);
		$this->db->offset($offset);
		return $this->db->get();
		
	}
	

	public function get_all_admin($limit=10000, $offset=0)
	{
		$this->db->from('users');
		$this->db->where('users.deleted',0);
		$this->db->where('users.user_level',1);		
		$this->db->join('userinfo','users.user_id=userinfo.user_id');			
		$this->db->order_by("first_name", "asc");
		$this->db->limit($limit);
		$this->db->offset($offset);
		return $this->db->get();
		
	}
	public function get_country_list()
	{
		$this->db->select('country_code,country_name');
		$this->db->from('country_list');
 
        return $this->db->get();
	}
	
	public function count_all()
	{
		$this->db->from('users');
		$this->db->where('users.deleted',0);
		return $this->db->count_all_results();
	}
	
	public function check_username($username,$user_id)
	{
	    $this->db->from('users');
	    $this->db->where('username',$username);
	    $this->db->where_not_in('user_id',$user_id);
	    return $this->db->count_all_results();
	}
	
	public function check_email($email,$user_id)
	{
	    $this->db->from('userinfo');
	    $this->db->where('email',$email);
		$this->db->where_not_in('user_id',$user_id);
	    return $this->db->count_all_results();
	}
	public function check_social($provider,$identifier)
	{
	    $this->db->from('userinfo');
	    $this->db->where('social_provider',$provider);
	    $this->db->where('social_identifier',$identifier);
	    return $this->db->count_all_results();
	}
	
	public function check_active_email($email)
	{
	    $this->db->from('users');	
		$this->db->join('userinfo', 'userinfo.user_id = users.user_id');
	    $this->db->where('email',$email);
	    $this->db->where('users.deleted',0);
	    $this->db->where('active',0);
	    return $this->db->count_all_results();
	}
	
	public function check_active($user_id)
	{

	    $this->db->from('users');
	    $this->db->where('user_id',$user_id);
	    $this->db->where('users.deleted',0);
	    $this->db->where('active',0);
	    return $this->db->count_all_results();
	}
	
	public function get_user_id($email)
	{
		$this->db->select('user_id');
        $this->db->from('userinfo');
        $this->db->where('email', $email);
		 $query = $this->db->get();
		$user_id=-1;
       if ($query->num_rows() > 0) {

        $result = $query->row_array();
        return $user_id=$result['user_id'];
	   }
	   else {
		    return -1;
	   }
		
	}
	
	public function get_user_id_byIdentifier($identifier)
	{
		$this->db->select('user_id');
        $this->db->from('userinfo');
        $this->db->where('social_identifier', $identifier);
		 $query = $this->db->get();
		$user_id=-1;
       if ($query->num_rows() > 0) {

        $result = $query->row_array();
        return $user_id=$result['user_id'];
	   }
	   else {
		    return -1;
	   }
		
	}
	
	public function get_username_user_id($username)
	{
		$this->db->select('user_id');
        $this->db->from('users');
        $this->db->where('username', $username);
		 $query = $this->db->get();
		$user_id=-1;
       if ($query->num_rows() > 0) {

        $result = $query->row_array();
        return $user_id=$result['user_id'];
	   }
	   else {
		    return -1;
	   }
		
	}
	
	public function update_forget_password($code,$email,$data)
	{
		$this->db->select('user_id');
        $this->db->from('userinfo');
        $this->db->where('email', $email);
		$query = $this->db->get();
		$user_id= $this->get_user_id($email);
        if ($query->num_rows() > 0) {
        $result = $query->row_array();
        $user_id=$result['user_id'];
        
        $this->db->where('user_id', $user_id);
        if ($this->db->update('users', $data)) {
          // Update okay, send email
		$subject=$this->lang->line('login_password_reset');
		$url =site_url('login/new_password')."/".$code;  
		$this->load->library('email'); 
        $from = Array(
		    'email' =>$this->email->smtp_user,
            'name' => $this->config->item('company').' Team'
        );
		$to = $email;
        $message="<h1>".$this->config->item('company')." Team </h1>Dear User,<br><br>Please click the following link to reset your password:<br><br> ".$url."/"."<br><br>Thanks<br>Admin";
		$this->email->set_newline("\r\n");
	    // Set email preferences
        $this->email->from($from['email'], $from['name']);
        $this->email->to($to);
        $this->email->subject($subject);
        $this->email->message($message);
        // Ready to send email and check whether the email was successfully sent
        if (!$this->email->send()) {
            // Raise error message
           // show_error($this->email->print_debugger());
		   return false;
        } else {
            // Show success notification or other things here
            return true;
        }
		
        } else {
          // Some sort of error happened
        }
	}
	}
	
	public function password_code_match($code, $email) {
		
		$user_id= $this->get_user_id($email);
		
      $this->db->where('user_id', $user_id);
      $this->db->where('forgot_password', $code);
      $this->db->from('users');
        $num_res = $this->db->count_all_results();

        if ($num_res == 1) {
          return TRUE;
      } else {
          return FALSE;
      }
    }
	
	public function check_password($password,$user_id)
	{
 
		$this->load->library('bcrypt');
		$this->db->where('user_id',$user_id);
    	$query = $this->db->get('users');

		if ($query->num_rows() > 0) {

			$result = $query->row_array();

			if ($this->bcrypt->check_password($password, $result['password'])) {
				//We're good
				return true;
			} else {
				//Wrong password
				return false;
			}

		} else {
			return false;
		}
	}
	
	public function check_empty_password($user_id)
	{
 
	$this->db->where('user_id',$user_id);
	$this->db->where('password',"");
    $query = $this->db->get('users');

    if ($query->num_rows() > 0) {
		return true;
    } else {
        return false;
    }
	}
	
	
	
	public function get_first_name($users_id)
	{
		$this->db->select('first_name');	
		$this->db->from('users');	
		$this->db->join('userinfo', 'userinfo.user_id = users.user_id');
		$this->db->where('users.user_id',$users_id);
		return $this->db->get();
	}
	
	/*
	Gets information about multiple users
	*/
	public function get_multiple_info($users_id)
	{
		$this->db->from('users');
		$this->db->join('userinfo', 'userinfo.user_id = users.user_id');		
		$this->db->where_in('users.user_id',$users_id);
		$this->db->order_by("first_name", "asc");
		return $this->db->get();		
	}
	
	/*
	Inserts or updates an user
	*/
	public function save(&$userinfo_data, &$userlog_data,$user_id=-1)
	{
		$success=false;
		//Run these queries as a transaction, we want to make sure we do all or nothing
		$this->db->trans_start();
		if (parent::save($userinfo_data,$userlog_data,$user_id))
		{
			if (!empty($userlog_data)) {
				
				if ($user_id == -1 or !$this->exists($user_id)) {
					$userlog_data['user_id'] = $user_id = $userinfo_data['user_id'];
					$success = $this->db->insert('users',$userlog_data);
			    }
			    else {
					$this->db->where('user_id', $user_id);
					$success = $this->db->update('users',$userlog_data);		
			    }
				
			}
			else {
				$success=true;
			}
						
		}
		$this->db->trans_complete();		
		return $success;
	}
	
	public function update_user_info($userinfo_data,$user_id)
	{
		$this->db->where('user_id', $user_id);
        if ($this->db->update('userinfo', $userinfo_data)) {
			return true;
		}
	}
	
	public function update_password( &$userlog_data,$userinfo_data,$user_id=false)
	{
		$success=false;
		$this->db->where('user_id', $user_id);
		$success = $this->db->update('users',$userlog_data);
		if (!empty($userinfo_data)) {
		    $this->db->where('user_id', $user_id);
		    $success = $this->db->update('userinfo',$userinfo_data);
		}
 

		
 
		return $success;
	}
	
	function sendVerificationEmail($user_id,$email,$verificationText)
	{
        $this->db->where('user_id', $user_id);
        $this->db->update('unf_users', array('email_verification_code' => $verificationText));
		
		$this->load->library('email'); 
        $from = Array(
		    'email' =>$this->email->smtp_user,
            'name' => $this->config->item('company').' Team'
        );
		$to = $email;
		$subject=$this->lang->line('login_email_verification');
        $message="<h1>".$this->config->item('company')." Team </h1>Dear User,<br><br>Please click on below URL or paste into your browser to verify your Email Address<br><br> ".site_url('login/verify')."/".$verificationText."<br><br>Thanks<br>Admin";
	    $this->email->set_newline("\r\n");
        // Set email preferences
        $this->email->from($from['email'], $from['name']);
        $this->email->to($to);
        $this->email->subject($subject);
        $this->email->message($message);
        // Ready to send email and check whether the email was successfully sent
        if (!$this->email->send()) {
            // Raise error message
           // show_error($this->email->print_debugger());
		   return false;
        } else {
            // Show success notification or other things here
            return true;
        }
    }
	
	function verifyEmailAddress($verificationcode)
	{  
  
		$this->db->from('users');
		$this->db->where('email_verification_code',$verificationcode);
		if($this->db->count_all_results()==1) {
			$this->db->where('email_verification_code', $verificationcode);
	        return ($this->db->update('users', array('active' => 0,'email_verification_code'=>''))); 
		}
	    return false;

         
    }
	
	/*
	Deletes one user
	*/
	public function delete($users_id)
	{
		$success=false;
		
		//Don't let user delete their self
		if ($users_id==$this->get_logged_in_user_info()->user_id){
			return false;
		}
		//Run these queries as a transaction, we want to make sure we do all or nothing
		$this->db->trans_start();
		
		//Delete permissions
		if ($this->db->delete('permissions', array('user_id' => $users_id))) {	
			$this->db->where('user_id', $users_id);
			$success = $this->db->update('users', array('active' => 1));
			
			$this->db->where('user_id', $users_id);
			$success = $this->db->update('users', array('deleted' => 1));

			$this->db->where('user_id', $users_id);
			$success = $this->db->update('userinfo', array('deleted' => 1));

			$this->db->where('user_id', $users_id);
			$success = $this->db->update('userinfo', array('user_company_id' => -1));
		}
		$this->db->trans_complete();		
		return $success;
	}
	
	/*
	Deletes a list of users
	*/
	public function delete_list($user_ids)
	{
		$success=false;
		 
		//Don't let user delete their self
		if(in_array($this->get_logged_in_user_info()->user_id,$user_ids))
			return false;

		//Run these queries as a transaction, we want to make sure we do all or nothing
		$this->db->trans_start();

		$this->db->where_in('user_id',$user_ids);
		if ($this->db->delete('permissions')) {       //Delete permissions
		    $this->db->where_in('user_id',$user_ids);
			$success = $this->db->update('unf_users', array('deleted' => 1));
		}
		$this->db->trans_complete();		
		return $success;
 	}
	
	/*
	Get search suggestions to find users
	*/
	public function get_search_suggestions($search,$limit=5)
	{
		$suggestions = array();
		
		$this->db->select('first_name');
		$this->db->from('users');
		$this->db->join('userinfo','users.user_id=userinfo.user_id');		
		$this->db->where("(	first_name LIKE '%".$this->db->escape_like_str($search)."%'
	    ) and deleted=0");		
		$this->db->order_by("first_name", "asc");
		
		$by_name = $this->db->get();
		foreach ($by_name->result() as $row) {
			$suggestions[]=$row->first_name;		
		}

		$this->db->select('email');
		$this->db->from('users');
		$this->db->join('userinfo','users.user_id=userinfo.user_id');		
		$this->db->where("(	email LIKE '%".$this->db->escape_like_str($search)."%'
	    ) and users.deleted=0");		
		$this->db->order_by("email", "asc");
		
		$email = $this->db->get();
		foreach ($email->result() as $row) {
			$suggestions[]=$row->email;		
		}
		
		$this->db->select('phone_number');
		$this->db->from('users');
		$this->db->join('userinfo','users.user_id=userinfo.user_id');		
		$this->db->where("(	phone_number LIKE '%".$this->db->escape_like_str($search)."%'
	    ) and deleted=0");		
		$this->db->order_by("phone_number", "asc");
		
		$phone_number = $this->db->get();
		foreach ($phone_number->result() as $row) {
			$suggestions[]=$row->phone_number;		
		}
		return $suggestions;
	
	}
	
	/*
	Preform a search on users
	*/
	public function search($search)
	{	
	    $this->db->from('users');
		$this->db->join('userinfo','users.user_id=userinfo.user_id');		
		$this->db->where("(	first_name LIKE '%".$this->db->escape_like_str($search)."%' or 
		email LIKE '%".$this->db->escape_like_str($search)."%' or 
		phone_number LIKE '%".$this->db->escape_like_str($search)."%'  ) and  deleted=0");		
		$this->db->order_by("first_name", "asc");
		return $this->db->get();		
	}
	
	/*
	Attempts to login user and set session. Returns boolean based on outcome.
    */
	public function login($username, $password)
	{
		$this->load->library('bcrypt');

		$this->db->join('userinfo', 'userinfo.user_id = users.user_id');
		$this->db->where('active',0);
	    $this->db->where('users.deleted',0);
		$this->db->group_start();
	    $this->db->where('username',$username);
	    $this->db->or_where('email',$username);
		$this->db->group_end();
	    
        $query = $this->db->get('users');

        if ($query->num_rows() > 0) {

            $result = $query->row_array();

			if ($this->bcrypt->check_password($password, $result['password'])) {
				
				$this->session->set_userdata('user_id', $result['user_id']) ;
				//We're good
				return $result;
			} else {
				//Wrong password
				return false;
			}

		} else {
			return false;
		}
    }
	
	public function is_login_exist($username, $password)
	{

		$this->load->library('bcrypt');
		$this->db->join('userinfo', 'userinfo.user_id = users.user_id');
		$this->db->group_start();
	    $this->db->where('username',$username);
	    $this->db->or_where('email',$username);
		$this->db->group_end();
	    
        $query = $this->db->get('users');

        if ($query->num_rows() > 0) {
			 $result = $query->row_array();
            if ($this->bcrypt->check_password($password, $result['password'])) {
			    return true;
            }
			else {
                return false;
            }
		}
		return false;
       
    }

	
	/*
	Logs out a user by destorying all session data and redirect to login
	*/
	public function logout()
	{
		$this->load->helper('cookie'); 
		$this->load->helper('social');
		$config=load_social();
		$this->load->library('HybridAuthLib',$config);

		$this->session->sess_destroy();
		$query = $this->db->get_where('cicookies', array(
			'cookie_id' => $this->input->cookie('rmtoken_' . str_replace('.', '_', $_SERVER['SERVER_NAME']))
		));
		if (!$query->num_rows()) {
			// no cookie to destroy, return
			redirect('login');
		}
		$row = $query->row();
		
		$this->db->where('id', $row->id);
		$this->db->delete('cicookies');
		delete_cookie('rememberme_token');
		$this->hybridauthlib->logoutAllProviders();
		
		redirect('login');
	}
	
	/*
	Determins if a user is logged in
	*/
	public function is_logged_in()
	{
		if($this->session->userdata('user_id')){
			$user_id=$this->session->userdata('user_id');
			if($this->User_model->check_active($user_id)==1){
				return true;
			}
			else{
				return false;
			}
		}
		 
	}
	
	/*
	Gets information about the currently logged in user.
	*/
	public function get_logged_in_user_info()
	{ 
		if($this->is_logged_in()) {  
			return $this->get_info($this->session->userdata('user_id'));
		}
		
		return false;
	}
	
	/*
	Determins whether the user specified has access the specific module.
	*/
	public function has_permission($module_id,$user_id)
	{
		//if no module_id is null, allow access
		if($module_id==null) {
			return true;
		}
		
		$query = $this->db->get_where('permissions', array('user_id' => $user_id,'module_id'=>$module_id), 1);
		return $query->num_rows() == 1;
		return false;
	}

}

