<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Appconfig extends CI_Model 
{
	public function exists($key)
	{
		$this->db->from('app_config');	
		$this->db->where('app_config.key',$key);
		$query = $this->db->get();
		
		return ($query->num_rows()==1);
	}
	
	public function get_all()
	{
		$this->db->from('app_config');
		$this->db->order_by("key", "asc");
		return $this->db->get();		
	}
	
	public function get($key)
	{
		$query = $this->db->get_where('app_config', array('key' => $key), 1);
		
		if ($query->num_rows()==1) {
			return $query->row()->value;
		}
		return "";
		
	}
	
	public function save($key,$value)
	{
		$config_data=array(
		'key'=>$key,
		'value'=>$value
		);
				
		if (!$this->exists($key)) {
			return $this->db->insert('app_config',$config_data);
		}
		
		$this->db->where('key', $key);
		return $this->db->update('app_config',$config_data);		
	}
	
	public function batch_save($data)
	{
		$success=true;
		
		//Run these queries as a transaction, we want to make sure we do all or nothing
		$this->db->trans_start();
		foreach($data as $key=>$value)
		{
			if (!$this->save($key,$value)) {
				$success=false;
				break;
			}
		}
		
		$this->db->trans_complete();		
		return $success;
		
	}
		
	public function delete($key)
	{
		return $this->db->delete('app_config', array('key' => $key)); 
	}
	
	public function delete_all()
	{
		return $this->db->empty_table('app_config'); 
	}
}
