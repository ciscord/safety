<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Model 
{
	/* Determines whether the given User exists */
	public function exists($user_id)
	{
		$this->db->from('userinfo');	
		$this->db->where('userinfo.user_id',$user_id);
		$query = $this->db->get();
		return ($query->num_rows()==1);
	}
	
	/* Gets all userinfo */
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
		$this->db->from('userinfo');	
		$this->db->join('users', 'users.user_id = userinfo.user_id');
		$this->db->where('users.user_id',$user_id);
		$query = $this->db->get();
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
	
	
}

