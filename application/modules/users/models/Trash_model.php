<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//class User extends Userinfo_model
class Trash_model extends CI_Model   
{
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
		$this->db->join('userinfo','users.user_id=userinfo.user_id');			
		$this->db->order_by("first_name", "asc");
        $this->db->where('users.deleted',1);	
		$this->db->limit($limit);
		$this->db->offset($offset);
		return $this->db->get();
		
	}
	
	public function count_all()
	{
		$this->db->from('users');
		$this->db->where('deleted',1);
		return $this->db->count_all_results();
	}
	
	public function checkUsername($username,$user_id)
	{
	    $this->db->from('users');
	    $this->db->where('username',$username);
	    $this->db->where_not_in('user_id',$user_id);
	    return $this->db->count_all_results();
	}
	
	public function checkPassword($password,$user_id)
	{
	    $this->db->from('users');
	    $this->db->where('password',$password);
	    $this->db->where('user_id',$user_id);
	    return $this->db->count_all_results();
	}
	
	/*
	Gets information about a particular user
	*/
	public function get_info($user_id)
	{
		$this->db->from('users');	
		$this->db->join('userinfo', 'userinfo.user_id = users.user_id');
		$this->db->where('users.user_id',$user_id);
		$query = $this->db->get();
		
		if ($query->num_rows()==1) {
			return $query->row();
		}
		else {
			//Get empty Userinfo table object
			$person_obj=$this->Userinfo_model->get_info(-1);
			//Get all the fields from user table
			$fields = $this->db->list_fields('users');
			//append those fields to base parent object, we we have a complete empty object
			foreach ($fields as $field) {
				$person_obj->$field='';
			}
			return $person_obj;
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
	Deletes one user
	*/
	public function delete($user_id)
	{
		$success=false;
		
		//Don't let user delete their self
		if ($user_id==$this->get_logged_in_user_info()->user_id){
			return false;
		}
		//Run these queries as a transaction, we want to make sure we do all or nothing
		$this->db->trans_start();
		
		//Delete permissions
		if ($this->db->delete('permissions', array('user_id' => $user_id))) {	
			$this->db->where('user_id', $user_id);
			$success = $this->db->update('users', array('active' => 1));
			
			$this->db->where('user_id', $user_id);
			$success = $this->db->update('users', array('deleted' => 1));
		}
		$this->db->trans_complete();		
		return $success;
	}
	
	public function undo_deleted_list($user_ids)
	{
		$success=false;
		 
		//Don't let user delete their self
		if(in_array($this->get_logged_in_user_info()->user_id,$user_ids))
			return false;

		//Run these queries as a transaction, we want to make sure we do all or nothing
		    $this->db->where_in('user_id',$user_ids);
			$success = $this->db->update('users', array('deleted' => 0));

		return $success;
 	}
	
	
	/*
	Deletes a list of users
	*/
	public function delete_list($user_ids)
	{
		$success=false;
		foreach ($user_ids as $user_id) {
            $profile_image=$this->get_info($user_id)->profile_image;
		    if (is_writable('./uploads/'.$profile_image) && file_exists ('./uploads/'.$profile_image) && $profile_image!="") {
				'./uploads/'.$profile_image;
				unlink('./uploads/'.$profile_image);
			}
			$this->db->trans_start();
		    $this->db->where('user_id',$user_id);
	        if ($this->db->delete('permissions')) { //Delete permissions
		
			$this->db->where('user_id',$user_id);
			$this->db->delete('users');
			
			$this->db->where('user_id',$user_id);  
			$success=$this->db->delete('userinfo');
			 }
		   $this->db->trans_complete();	
		   
         }
		 
		 
        
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
	    ) and deleted=1");		
		$this->db->order_by("first_name", "asc");
		
		$by_name = $this->db->get();
		foreach ($by_name->result() as $row) {
			$suggestions[]=$row->first_name;		
		}

		$this->db->select('email');
		$this->db->from('users');
		$this->db->join('userinfo','users.user_id=userinfo.user_id');		
		$this->db->where("(	email LIKE '%".$this->db->escape_like_str($search)."%'
	    ) and deleted=1");		
		$this->db->order_by("email", "asc");
		
		$email = $this->db->get();
		foreach ($email->result() as $row) {
			$suggestions[]=$row->email;		
		}
		
		$this->db->select('phone_number');
		$this->db->from('users');
		$this->db->join('userinfo','users.user_id=userinfo.user_id');		
		$this->db->where("(	phone_number LIKE '%".$this->db->escape_like_str($search)."%'
	    ) and deleted=1");		
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
		phone_number LIKE '%".$this->db->escape_like_str($search)."%'  ) and  deleted=1");		
		$this->db->order_by("first_name", "asc");
		return $this->db->get();		
	}
	
	/*
	Attempts to login user and set session. Returns boolean based on outcome.
	*/
	public function login($username, $password)
	{
		//$query = $this->db->get_where('users', array('username' => $username,'password'=>md5($password), 'deleted'=>0), 1);
		$query = $this->db->get_where('users', array('username' => $username,'password'=>$password, 'deleted'=>0), 1);
		if ($query->num_rows() ==1) {
			$row=$query->row();
			$this->session->set_userdata('user_id', $row->user_id);
			return true;
		}
		return false;
	}
	
	/*
	Logs out a user by destorying all session data and redirect to login
	*/
	public function logout()
	{
		$this->load->helper('cookie'); 
        $cookie1= array(
        'name'   => 'unf_username',
        'value'  => '',
        );
		
        $cookie2= array(
        'name'   => 'unf_password',
        'value'  => '',
        );
        delete_cookie($cookie);
        delete_cookie($cookie2);
		$this->session->sess_destroy();
		redirect('login');
	}
	
	/*
	Determins if a user is logged in
	*/
	public function is_logged_in()
	{
		return $this->session->userdata('user_id')!=false;
		return false;
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

