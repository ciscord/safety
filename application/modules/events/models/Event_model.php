<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Event_model  extends CI_Model
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
		$sql = "SELECT A.*,COUNT(B.user_company_id) as number_of_users FROM ".$this->db->dbprefix."companies as A 
		LEFT JOIN ".$this->db->dbprefix."userinfo as B ON B.user_company_id=A.company_id GROUP BY A.company_id";
		return $this->db->query($sql);
			
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
	
	public function count_all_companyusers()
	{
		$this->db->from('users');
		$this->db->where('deleted',0);
		return $this->db->count_all_results();
	}
	
	/*
	Returns all the users
	*/
	public function get_companyusers($limit=10000, $offset=0, $company_id)
	{
		$this->db->from('users');
		$this->db->join('userinfo','users.user_id=userinfo.user_id');
		$this->db->where('users.deleted',0);
		$this->db->where('userinfo.user_company_id',$company_id);		
			
		$this->db->join('companies','companies.company_id=userinfo.user_company_id');			
		$this->db->order_by("first_name", "asc");
		if ($limit != -1) {
			$this->db->limit($limit);
			$this->db->offset($offset);
		}
		
		
		return $this->db->get();
	}

	/*
	Returns all the users
	*/
	public function get_companylocation($limit=10000, $offset=0, $company_id)
	{
		$this->db->from('locations');
		$this->db->where('locations.location_delete',0);
		$this->db->where('locations.location_company_id',$company_id);		
			
		$this->db->join('companies','companies.company_id=locations.location_company_id');			
		$this->db->order_by("location_name", "asc");
		$this->db->limit($limit);
		$this->db->offset($offset);
		return $this->db->get();
	}

	/*
	Returns location by location id
	*/
	public function get_location_info($location_id)
	{
		$this->db->from('locations');
		$this->db->where('locations.location_delete',0);
		$this->db->where('locations.location_id',$location_id);		
			
		$this->db->join('companies','companies.company_id=locations.location_company_id');			
	
		$query = $this->db->get();

		if ($query->num_rows()==1) {
			return $query->row();
		}
		else {
			//create object with empty properties.
			$fields = $this->db->list_fields('locations');
			$location_obj = new stdClass;
			
			foreach ($fields as $field) {
				$location_obj->$field='';
			}
			return $location_obj;
		}

	}

	/*
	Gets information about a particular user
	*/
	public function get_info($company_id)
	{
		$sql = "SELECT A.*,COUNT(B.user_company_id) as number_of_users FROM ".$this->db->dbprefix."companies as A 
		LEFT JOIN ".$this->db->dbprefix."userinfo as B ON B.user_company_id=A.company_id where A.company_id=".$company_id." GROUP BY A.company_id";
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

