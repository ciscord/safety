<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Company_model  extends CI_Model
{
	/*
	Determines if a given user_id is exist
	*/
	public function exists($company_id)
	{
		$this->db->from('companies');	
		$this->db->where('companies.company_id',$company_id);
		$query = $this->db->get();
		
		return ($query->num_rows()==1);
	}	
	
	public function count_all()
	{
		$this->db->from('companies');
		$this->db->where('deleted',0);
		return $this->db->count_all_results();
	}

	/*
	Returns all the users
	*/
	public function get_all($limit=10000, $offset=0)
	{
		$sql = "SELECT unf_companies.*,COUNT(".$this->db->dbprefix."userinfo.user_company_id) as number_of_users FROM ".$this->db->dbprefix."companies
		LEFT JOIN ".$this->db->dbprefix."userinfo ON ".$this->db->dbprefix."userinfo.user_company_id=".$this->db->dbprefix."companies.company_id GROUP BY " .$this->db->dbprefix."companies.company_id";
		return $this->db->query($sql);
			
	}

	/*
	Gets information about a particular user
	*/
	public function get_info($company_id)
	{
		$sql = "SELECT *,COUNT(".$this->db->dbprefix."userinfo.user_company_id) as number_of_users FROM ".$this->db->dbprefix."companies
		LEFT JOIN ".$this->db->dbprefix."userinfo ON ".$this->db->dbprefix."userinfo.user_company_id=".$this->db->dbprefix."companies.company_id where unf_companies.company_id=".$company_id." GROUP BY " .$this->db->dbprefix."companies.company_id";
		$query = $this->db->query($sql);

		if ($query->num_rows() > 0) {
			return $row = $query->first_row();
		}else {//Get empty 
			//create object with empty properties.
			$fields = $this->db->list_fields('companies');
			$person_obj = new stdClass;
			
			foreach ($fields as $field) {
				$person_obj->$field='';
			}
			$person_obj->number_of_users=0;
			return $person_obj;
			
		}

	}

	/*
	Inserts or updates an user
	*/
	public function save(&$company_data, $company_id=-1)
	{
		$success=false;
		//Run these queries as a transaction, we want to make sure we do all or nothing
		$this->db->trans_start();	
		if (!empty($company_data)) {
			
			if ($company_id == -1 or !$this->exists($company_id)) {
				$success = $this->db->insert('companies',$company_data);
			}
			else {
				$this->db->where('company_id', $company_id);
				$success = $this->db->update('companies',$company_data);		
			}
			
			
		}
		else {
			$success=true;
		}
		
		$this->db->trans_complete();		
		return $success;
	}


	public function count_users($company_id)
	{
		$sql = "SELECT COUNT(".$this->db->dbprefix."userinfo.user_company_id) as number_of_users FROM ".$this->db->dbprefix."companies
		LEFT JOIN ".$this->db->dbprefix."userinfo ON ".$this->db->dbprefix."userinfo.user_company_id=".$this->db->dbprefix."companies.company_id where unf_companies.company_id=".$company_id." GROUP BY " .$this->db->dbprefix."companies.company_id";
		$query = $this->db->query($sql);

		if ($query->num_rows() > 0) {
			return $row = $query->first_row()->number_of_users;
		}else {
			return false;
		}
	}
	
	/////////////////////////////////-----------------------------/////////////////////////////////
	public function check_active_email($email)
	{
	    $this->db->from('companies');	
		$this->db->join('userinfo', 'userinfo.user_id = companies.user_id');
	    $this->db->where('email',$email);
	    $this->db->where('deleted',0);
	    $this->db->where('active',0);
	    return $this->db->count_all_results();
	}
	
	public function check_active($user_id)
	{

	    $this->db->from('companies');
	    $this->db->where('user_id',$user_id);
	    $this->db->where('deleted',0);
	    $this->db->where('active',0);
	    return $this->db->count_all_results();
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
  
		$this->db->from('companies');
		$this->db->where('email_verification_code',$verificationcode);
		if($this->db->count_all_results()==1) {
			$this->db->where('email_verification_code', $verificationcode);
	        return ($this->db->update('companies', array('active' => 0,'email_verification_code'=>''))); 
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
			$success = $this->db->update('companies', array('active' => 1));
			
			$this->db->where('user_id', $users_id);
			$success = $this->db->update('companies', array('deleted' => 1));
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
	

}

