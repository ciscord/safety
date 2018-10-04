<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Userinfo extends CI_Model 
{
	/*Determines whether the given user exists*/
	public function exists($user_id)
	{
		$this->db->from('userinfo');	
		$this->db->where('userinfo.user_id',$user_id);
		$query = $this->db->get();
		return ($query->num_rows()==1);
	}
	
	/*Gets all userinfo*/
	public function get_all($limit=10000, $offset=0)
	{
		$this->db->from('userinfo');
		$this->db->order_by("first_name", "asc");
		$this->db->limit($limit);
		$this->db->offset($offset);
		return $this->db->get();		
	}
	
	public function count_all()
	{
		$this->db->from('userinfo');
		$this->db->where('deleted',0);
		return $this->db->count_all_results();
	}
	
	/*
	Gets information about a person as an array.
	*/
	public function get_info($user_id)
	{
		$query = $this->db->get_where('userinfo', array('user_id' => $user_id), 1);
		
		if ($query->num_rows()==1) {
			return $query->row();
		}
		else {
			//create object with empty properties.
			$fields = $this->db->list_fields('userinfo');
			$person_obj = new stdClass;
			
			foreach ($fields as $field) {
				$person_obj->$field='';
			}
			
			return $person_obj;
		}
	}
	
	/*
	Get userinfo with specific ids
	*/
	public function get_multiple_info($user_ids)
	{
		$this->db->from('userinfo');
		$this->db->where_in('user_id',$user_ids);
		$this->db->order_by("last_name", "asc");
		return $this->db->get();		
	}
	
	/*
	Inserts or updates a person
	*/

	public function save(&$userinfo_data, &$userinfo,&$permission_data,$user_id=false)
	{		
		if (!$user_id or !$this->exists($user_id)) {
			if ($this->db->insert('userinfo',$userinfo_data)) {
				$userinfo_data['user_id']=$this->db->insert_id();
				return true;
			}
			return false;
		}
		
		$this->db->where('user_id', $user_id);
		return $this->db->update('userinfo',$userinfo_data);
	}
	
	/*
	Deletes one User (doesn't actually do anything)
	*/
	public function delete($user_id)
	{
		return true;; 
	}
	
	/*
	Deletes a list of userinfo_data (doesn't actually do anything)
	*/
	public function delete_list($user_ids)
	{	
		return true;	
 	}
	
}

